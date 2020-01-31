<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountType;
use App\Helper\Utils;
use App\Repository\AccountRepository;
use Aws\Sqs\SqsClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for managing accounts
 */

class AccountController extends BaseController {

    use Utils;

    /**
     * @Route("/createaccount", methods={"POST"})
     */
    public function create(Request $request, AccountRepository $accountRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['accountCreateFile'];

        } else {
            $shell = $this->getParameter('shell')['accountUpdateFile'];
            $message_code = "update";
        }

        $name = trim($request->request->get('name'));
        $params['name'] = $name;
        $params['description'] = $request->request->get('description');
        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();

            // username and email are only for new
            $params['username'] = $this->removeAllNonAlphanumericCharacters(trim($request->request->get('firstname'))."-".trim($request->request->get('lastname')))."-".$uuid; // username is now the uuid
            $params['email'] = $request->request->get('email');
            // plain text user password since the hashing will be done in Cognito
            $params[] = $request->request->get('password');
            $params['firstname'] = $request->request->get('firstname');
            $params['lastname'] = $request->request->get('lastname');
            $params['uuid'] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $accountRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $log_file_name = $username.".".time().".".$message_code."account.".$uuid.".log";

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params['logfilename'] = $log_file_name;
        $params['dashboardurl'] = addslashes($request->request->get('dashboardurl'));
        $params['currentactivityurl'] = addslashes($request->request->get('currentactivityurl'));
        $params['historyactivityurl'] = addslashes($request->request->get('historyactivityurl'));
        $params[] = $this->getParameter('sns_general_topic');
        $params[] = $this->getParameter('sns_topic_prefix');

        // Account topic name
        $params['accountsnstopic'] = $this->getParameter('sns_topic_prefix')."account-".$this->removeAllNonAlphanumericCharacters($name);
        if (empty($id)) {
            # user account SNS topic onl for new accounts
            $params['usersnstopic'] = $this->getParameter('sns_topic_prefix')."user-" . $uuid;
        }

        $params['accounts3folder'] = $this->getAccountS3FolderName($name);
        $params[] = $this->getUserId();
        $params['nexusreporturl'] = addslashes($request->request->get('nexusreporturl'));
        $params[] = $this->getParameter('cognito_pool_id');
        $params[] = $this->getParameter('cognito_pool_client_id');
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getParameter('cognito.userpool.groupname');

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("account.$message_code.success", ["%name%" => $name]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("account", json_encode(array_merge(['message' => $message, 'Account' => $name], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("account_table.twig", ['accounts'=> $accountRepository->getAll($this->getAccountId())]);
        } else {
            $message = $translator->trans("account.$message_code.fail", ["%name%" => $name, "%error%" => $this->getShellScriptLogFileContents($log_file_name)]);
            return new Response($message, 500);
        }


    }

    /**
     * @Route("/accounts", name="accounts")
     */
    public function index(AccountRepository $accountRepository) {
        $account = new Account();
        return $this->render("account.twig",
            ['accounts'=> $accountRepository->getAll($this->getAccountId()), 'account' => $account->toArray()]);
    }
    /**
     * @Route("/account/refresh")
     */
    public function refresh(AccountRepository $accountRepository) {
        $account = new Account();
        return $this->render("account_table.twig",
            ['accounts'=> $accountRepository->getAll($this->getAccountId()), 'account' => $account->toArray()]);
    }

    /**
     * @Route("/editaccount", methods={"GET"})
     */
    public function edit(Request $request) {
        $account = $this->getDoctrine()->getRepository(Account::class)->find($request->query->get("id"));

        return $this->render("account_form.twig", ['account'=> $account->toArray()]);
    }
    /**
     * @Route("/viewaccount", methods={"GET"})
     */
    public function view(Request $request) {
        $account = $this->getDoctrine()->getRepository(Account::class)->find($request->query->get("id"));

        return $this->render("account_view.twig", ['account'=> $account->toArray()]);
    }

    /**
     * @Route("/deleteaccount", methods={"GET"})
     */
    public function delete(Request $request, AccountRepository $accountRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['accountDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            throw new \Exception($translator->trans("account.delete.noid"));
        }

        $params[] = $id;
        $uuid = $accountRepository->getUuidFromId($id);
        $params[] = $uuid;

        $log_file_name = $username.".".time().".deleteaccount.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("account.delete.success");
        if (!$process->isSuccessful()) {
            $message = $translator->trans("account.delete.fail");
            throw new ProcessFailedException($process);
        }

        $queueData = $this->buildQueueData("account", json_encode(['message' => $message, 'Account' => $id]), $this->getUser(), $uuid);
        $queue->sendMessage($queueData);

        return $this->render("account_table.twig", ['accounts'=> $accountRepository->getAll($this->getUser())]);
    }
}