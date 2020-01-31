<?php
/**
 *
 */

namespace App\Controller;

use App\Helper\Utils;
use App\Repository\TemplateRepository;
use Aws\S3\S3Client;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends BaseController {

    use Utils;

    /**
     * @Route("/tables", name="tables")
     */
    public function tables(Request $request, S3Client $s3Client, TemplateRepository $templateRepository) {
        $params[] = ""; // was aws_credentials_key
        $params[] = ""; // was aws_credentials_secret
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getLoggedInUsername($this->getUser());

        # execute the query to update file counts

        return $this->render("tables.twig",['tables'=> $templateRepository->getAll($this->getAccountId()), 'files' => []]);
    }

    /**
     * @Route("/tables/refresh")
     */
    public function refresh(TemplateRepository $templateRepository) {
        return $this->render("table_table.twig",['files' => [],  'tables'=> $templateRepository->getAll($this->getUser())]);
    }

    /**
     * @Route("/tables/searchforfiles")
     */
    public function search(Request $request, TemplateRepository $templateRepository) {
        $shell = $this->getParameter('shell')['tableSearchFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');

        if (empty($id)) {
            return new Response($translator->trans("table.search.noid"), 500);
        }
        $template = $templateRepository->find($id);
        $values = $template->toArray();

        $params[] = $id;
        $uuid = $values['uuid'];
        $params[] = $uuid;
        $params[] = $request->query->get('criteria');
        $params[] = ""; // was aws_credentials_key
        $params[] = ""; // was aws_credentials_secret
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.region');
        $params[] = $values['bucketinput'];
        $params[] = $this->getLoggedInUsername($this->getUser());
        $params[] = str_replace("s3://".$this->getParameter('s3_bucket')."/", "", $values['bucketinput']);

        $process =  $this->getShellScriptProcess($shell, $params, $uuid);
        $process->run();

        return $this->render("table_file_results.twig",['files' => json_decode(file_get_contents($this->getShellScriptLogFileAbsolutePath("search_".$uuid)), true)]);
    }

}