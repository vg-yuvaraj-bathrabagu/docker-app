<?php
/**
 * Controller for Conversion definitions 
 */

namespace App\Controller;

use App\Entity\Conversion;
use App\Helper\Utils;
use App\Repository\ConversionRepository;
use Aws\Sqs\SqsClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Routing\Annotation\Route;

class ConversionController extends Controller {

    use Utils;

    /**
     * @Route("/conversion", name="conversion")
     */
    public function conversion(ConversionRepository $conversionRepository) {
        $conversion = new Conversion();
        return $this->render("conversion.twig", ["conversions"=> $conversionRepository->getAll($this->getUser()), "conversion" => $conversion->toArray()]);
    }

    /**
     * @Route("/conversion/refresh")
     */
    public function refresh(ConversionRepository $conversionRepository) {
        $conversion = new Conversion();
        return $this->render("conversion_table.twig",['conversions'=> $conversionRepository->getAll($this->getUser()), "conversion" => $conversion->toArray()]);
    }
    /**
     * @Route("/createconversion", methods={"POST"})
     */
    public function create(Request$request, ConversionRepository $conversionRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['conversionCreateFile'];
        } else {
            $shell = $this->getParameter('shell')['conversionUpdateFile'];
            $message_code = "update";
        }

        $params['name'] = $request->request->get('name');
        $params['description'] = $request->request->get('description');
        $type = $request->request->get('type');
        $params['type'] = $type;
        $params['url'] = $request->request->get('url');
        $params['parameters'] = $request->request->get('parameters');
        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();
            $params[] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $conversionRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $log_file_name = $username.".".time().".".$message_code."conversion.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("conversion.".$message_code.".success", ["%type%" => $type]);
        if (!$process->isSuccessful()) {
            $message = $translator->trans("conversion.".$message_code.".fail", ["%type%" => $type]);
            throw new ProcessFailedException($process);
        }

        $queueData = $this->buildQueueData("conversion", json_encode(array_merge(['message' => $message, 'Conversion' => $type], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
        $queue->sendMessage($queueData);

        return $this->render("conversion_table.twig", ['conversions'=> $conversionRepository->getAll($this->getUser())]);
    }

    /**
     * @Route("/editconversion", methods={"GET"})
     */
    public function edit(Request $request) {
        $conversion = $this->getDoctrine()->getRepository(Conversion::class)->find($request->query->get("id"));

        return $this->render("conversion_form.twig", ['conversion'=> $conversion->toArray()]);
    }
    /**
     * @Route("/viewconversion", methods={"GET"})
     */
    public function view(Request $request) {
        $conversion = $this->getDoctrine()->getRepository(Conversion::class)->find($request->query->get("id"));

        return $this->render("conversion_view.twig", ['conversion'=> $conversion->toArray()]);
    }

    /**
     * @Route("/activateconversion", methods={"GET"})
     */
    public function activate(Request $request, ConversionRepository $conversionRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['conversionActivateFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $isactive = $request->query->get('isactive');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            throw new \Exception($translator->trans("conversion.activate.noid"));
        }

        $params['isactive'] = $isactive;
        $params[] = $id;
        $uuid = $conversionRepository->getUuidFromId($id);
        $params[] = $uuid;

        $log_file_name = $username.".".time().".activateconversion.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("conversion.activate.success", ['%status%' => $isactive]);
        if (!$process->isSuccessful()) {
            $message = $translator->trans("conversion.activate.fail", ['%status%' => $isactive]);
            throw new ProcessFailedException($process);
        }

        $queueData = $this->buildQueueData("conversion", json_encode(array_merge(['message' => $message, 'Conversion' => $id], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
        $queue->sendMessage($queueData);

        return $this->render("conversion_table.twig", ['conversions'=> $conversionRepository->getAll($this->getUser())]);
    }


    /**
     * @Route("/deleteconversion", methods={"GET"})
     */
    public function delete(Request $request, ConversionRepository $conversionRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['conversionDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            throw new \Exception($translator->trans("conversion.delete.noid"));
        }

        $params[] = $id;
        $uuid = $conversionRepository->getUuidFromId($id);
        $params[] = $uuid;

        $log_file_name = $username.".".time().".deleteconversion.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("conversion.delete.success", ['%type%' => $id]);
        if (!$process->isSuccessful()) {
            $message = $translator->trans("conversion.create.fail", ['%type%' => $id]);
            throw new ProcessFailedException($process);
        }

        $queueData = $this->buildQueueData("conversion", json_encode(['message' => $message, 'Conversion' => $id]), $this->getUser(), $uuid);
        $queue->sendMessage($queueData);

        return $this->render("conversion_table.twig", ['conversions'=> $conversionRepository->getAll($this->getUser())]);
    }

}