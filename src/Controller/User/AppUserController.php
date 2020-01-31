<?php

namespace App\Controller\User;


use App\Bridge\AwsCognitoClient;
use App\Controller\BaseController;
use App\Entity\User\AppUser;
use App\Form\User\ForgotPasswordType;
use App\Form\User\ResetPasswordType;
use App\Helper\Utils;
use App\Repository\AppUserRepository;
use Aws\Sqs\SqsClient;
use Doctrine\ORM\EntityManagerInterface;
use MsgPhp\User\Infra\Doctrine\Repository\RoleRepository;
use MsgPhp\User\UserId;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AppUserController extends BaseController {

    use Utils;

    /**
     * @Route("/users", name="users")
     */
    public function users(AppUserRepository $appUserRepository, RoleRepository $roleRepository) {
        $app_user = new AppUser(UserId::fromValue(null), "", "");
        return $this->render("user.twig",['users'=> $appUserRepository->getAll($this->getAccountId()), "user" => $app_user->toArray(), 'roles' => $roleRepository->findAll()]);
    }

    /**
     * @Route("/createuser", methods={"POST"})
     */
    public function create(Request $request, AppUserRepository $appUserRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['userCreateFile'];
        } else {
            $shell = $this->getParameter('shell')['userUpdateFile'];
            $message_code = "update";
        }

        $name = trim($request->request->get('firstname'))." ".trim($request->request->get('lastname'));
        $params['salutation'] = $request->request->get('salutation');
        $params['firstname'] = $request->request->get('firstname');
        $params['lastname'] = $request->request->get('lastname');
        $params['emailaddress'] = $request->request->get('emailaddress');
        $params['roles'] = $this->getSQLStatementForRoles($request->request->get('roles'));
        $params[] = $this->getAccountId();
        $params[] = $this->getS3FolderNameForAccount();

        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();
            // username and password are only for new - with username being a uuid
            $params['username'] = $this->removeAllNonAlphanumericCharacters(trim($request->request->get('firstname'))."-".trim($request->request->get('lastname')))."-".$uuid;
            $params[] = $request->request->get('password');

            $params[] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $appUserRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $log_file_name = $username.".".time().".".$message_code."user.".$uuid.".log";

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params['logfilename'] = $log_file_name;
        $params[] = $this->getParameter('sns_general_topic');
        $params[] = $this->getAccount()->getSNSTopic();
        if (empty($id)) {
            $params[] = $this->getParameter('sns_topic_prefix') . "user-" . $uuid;
        }

        # other user fields
        $params['initials']= $request->request->get('initials');
        $params['gender']= $request->request->get('gender');
        $params['jobtitle']= $request->request->get('jobtitle');
        $params['blccode']= $request->request->get('blccode');
        $params['jobcategory']= $request->request->get('jobcategory');
        $params['department']= $request->request->get('department');
        $params['joblocation']= $request->request->get('joblocation');
        $params['personalemailaddress']= $request->request->get('personalemailaddress');
        $params['usertype']= $request->request->get('usertype');
        $params['employeecategory']= $request->request->get('employeecategory');
        $params['status']= $request->request->get('status');
        $params['week_start']= $request->request->get('week_start');
        $params['hourlywage']= $request->request->get('hourlywage');
        $params['photo']= $request->request->get('photo');
        $params['onvacation']= $request->request->get('onvacation');
        $params['mobilenumber']= $request->request->get('mobilenumber');
        $params['homephone']= $request->request->get('homephone');
        $params['officeline1']= $request->request->get('officeline1');
        $params['faxnumber']= $request->request->get('faxnumber');
        $params['address1']= $request->request->get('address1');
        $params['address2']= $request->request->get('address2');
        $params['stateorprovince']= $request->request->get('stateorprovince');
        $params['postalcode']= $request->request->get('postalcode');
        $params['city']= $request->request->get('city');
        $params['country']= $request->request->get('country');
        $params['companyname']= $request->request->get('companyname');
        $params['companyaddress']= $request->request->get('companyaddress');
        $params['ssn']= $request->request->get('ssn');
        $params['ein']= $request->request->get('ein');
        $params['tsgbadgenumber']= $request->request->get('tsgbadgenumber');
        $params['employeetype']= $request->request->get('employeetype');
        $params['birthdate']= $this->formatDateValue($request->request->get('birthdate'));
        $params['hiredate']= $this->formatDateValue($request->request->get('hiredate'));
        $params['employeestartdate']= $this->formatDateValue($request->request->get('employeestartdate'));
        $params['employeeenddate']= $this->formatDateValue($request->request->get('employeeenddate'));
        $params['releasedate']= $this->formatDateValue($request->request->get('releasedate'));
        $params['lastreviewdate']= $this->formatDateValue($request->request->get('lastreviewdate'));
        $params['nextreviewdate']= $this->formatDateValue($request->request->get('nextreviewdate'));
        $params['supervisorname']= $request->request->get('supervisorname');
        $params['supervisoremail']= $request->request->get('supervisoremail');
        $params['supervisorofficeline']= $request->request->get('supervisorofficeline');
        $params['approver']= $request->request->get('approver');
        $params['approveremail']= $request->request->get('approveremail');
        $params['invoiceapprover']= $request->request->get('invoiceapprover');
        $params['invoiceapproveremail']= $request->request->get('invoiceapproveremail');
        $params['businessmeetingapprover']= $request->request->get('businessmeetingapprover');
        $params['businessmeetingapproveremail']= $request->request->get('businessmeetingapproveremail');
        $params['travelexpenseapprover']= $request->request->get('travelexpenseapprover');
        $params['travelexpenseapproveremail']= $request->request->get('travelexpenseapproveremail');
        $params['odcapprover']= $request->request->get('odcapprover');
        $params['odcapproveremail']= $request->request->get('odcapproveremail');
        $params['billsapprover']= $request->request->get('billsapprover');
        $params['billsapproveremail']= $request->request->get('billsapproveremail');
        $params['permissiontemplate']= $request->request->get('permissiontemplate');
        $params['canviewmployeeresources']= $request->request->get('canviewemployeeresources');
        $params['canviewpublicholidays']= $request->request->get('canviewpublicholidays');
        $params['canviewpayrolldates']= $request->request->get('canviewpayrolldates');
        $params['canviewtravelpolicy']= $request->request->get('canviewtravelpolicy');
        $params['canview401kinformation']= $request->request->get('canview401kinformation');
        $params['canviewreferenceinformation']= $request->request->get('canviewreferenceinformation');
        $params['payrollfrequency']= $request->request->get('payrollfrequency');
        $params['invoicecategory']= $request->request->get('invoicecategory');
        $params['maximumhoursperday']= $request->request->get('maximumhoursperday');
        $params['maximumhoursperweek']= $request->request->get('maximumhoursperweek');
        $params['vacationdaysallowed']= $request->request->get('vacationdaysallowed');
        $params['maximumvacationdays']= $request->request->get('maximumvacationdays');
        $params['personaldaysallowed']= $request->request->get('personaldaysallowed');
        $params['maximumpersonaldays']= $request->request->get('maximumpersonaldays');
        $params['paidholidaysallowed']= $request->request->get('paidholidaysallowed');
        $params['maximumpaidholidays']= $request->request->get('maximumpaidholidays');
        $params['sickdaysallowed']= $request->request->get('sickdaysallowed');
        $params['maximumsickdays']= $request->request->get('maximumsickdays');
        $params['saturdayworkallowed']= $request->request->get('saturdayworkallowed');
        $params['sundayworkallowed']= $request->request->get('sundayworkallowed');
        $params['publicholidayworkallowed']= $request->request->get('publicholidayworkallowed');
        $params['employeebenefitsbillable']= $request->request->get('employeebenefitsbillable');
        $params['maximumsocialsecurity']= $request->request->get('maximumsocialsecurity');
        $params['ec1_firstname']= $request->request->get('ec1_firstname');
        $params['ec1_lastname']= $request->request->get('ec1_lastname');
        $params['ec1_streetaddress']= $request->request->get('ec1_streetaddress');
        $params['ec1_city']= $request->request->get('ec1_city');
        $params['ec1_state']= $request->request->get('ec1_state');
        $params['ec1_zipcode']= $request->request->get('ec1_zipcode');
        $params['ec1_homephone']= $request->request->get('ec1_homephone');
        $params['ec1_workphone']= $request->request->get('ec1_workphone');
        $params['ec1_cellphone']= $request->request->get('ec1_cellphone');
        $params['ec1_relationship']= $request->request->get('ec1_relationship');
        $params['ec2_firstname']= $request->request->get('ec2_firstname');
        $params['ec2_lastname']= $request->request->get('ec2_lastname');
        $params['ec2_streetaddress']= $request->request->get('ec2_streetaddress');
        $params['ec2_city']= $request->request->get('ec2_city');
        $params['ec2_state']= $request->request->get('ec2_state');
        $params['ec2_zipcode']= $request->request->get('ec2_zipcode');
        $params['ec2_homephone']= $request->request->get('ec2_homephone');
        $params['ec2_workphone']= $request->request->get('ec2_workphone');
        $params['ec2_cellphone']= $request->request->get('ec2_cellphone');
        $params['ec2_relationship']= $request->request->get('ec2_relationship');
        $params['ec3_firstname']= $request->request->get('ec3_firstname');
        $params['ec3_lastname']= $request->request->get('ec3_lastname');
        $params['ec3_streetaddress']= $request->request->get('ec3_streetaddress');
        $params['ec3_city']= $request->request->get('ec3_city');
        $params['ec3_state']= $request->request->get('ec3_state');
        $params['ec3_zipcode']= $request->request->get('ec3_zipcode');
        $params['ec3_homephone']= $request->request->get('ec3_homephone');
        $params['ec3_workphone']= $request->request->get('ec3_workphone');
        $params['ec3_cellphone']= $request->request->get('ec3_cellphone');
        $params['ec3_relationship']= $request->request->get('ec3_relationship');
        $params['fileuploadlocation']= $request->request->get('fileuploadlocation');
        $params[] = $this->getParameter('cognito_pool_id');
        $params[] = $this->getParameter('cognito_pool_client_id');
        $params[] = $this->getParameter('cognito.userpool.groupname');

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("user.$message_code.success", ["%name%" => $name]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("user", json_encode(array_merge(['message' => $message, 'User' => $name], $this->getArrayWithoutNumericKeys($params) )), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("user_table.twig", ['users'=> $appUserRepository->getAll($this->getAccountId())]);
        } else {
            $message = $translator->trans("user.$message_code.fail", ["%name%" => $name])." ".$this->getShellScriptLogFileContents($log_file_name);
            return new Response($message, 500);
        }
    }

    private function getSQLStatementForRoles($roles) {
        $sql = "";
        foreach ($roles as $value) {
            $sql.= "INSERT INTO user_role(`user_id`, `role_name`) VALUES (@user_id, '".$value."'); ";
        }
        return $sql;
    }

    /**
     * @Route("/edituser", methods={"GET"})
     */
    public function edit(Request $request, AppUserRepository $appUserRepository, RoleRepository $roleRepository) {
        $app_user = $appUserRepository->find($request->query->get("id"));
        return $this->render("user_form.twig", ['user'=> $app_user->toArray(),  'roles' => $roleRepository->findAll()]);
    }

    /**
     * @Route("/blankuser", methods={"GET"})
     */
    public function blankuser(Request $request, AppUserRepository $appUserRepository, RoleRepository $roleRepository) {
        $app_user = new AppUser(UserId::fromValue(null), "", "");
        return $this->render("user_form.twig", ['user'=> $app_user->toArray(),  'roles' => $roleRepository->findAll()]);
    }

    /**
     * @Route("/deleteuser", methods={"GET"})
     */
    public function delete(Request $request, AppUserRepository $appUserRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['userDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getUserName();

        if (empty($id)) {
            throw new \Exception($translator->trans("user.delete.noid"));
        }

        $user = $appUserRepository->find($id);
        $values = $user->toArray();

        $params[] = $id;
        $uuid = $values['uuid'];
        $params[] = $uuid;
        $params[] = $values['username'];
        $params[] = $this->getS3FolderNameForAccount();
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');


        $log_file_name = $username.".".time().".deleteuser.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("user.delete.success", ['%category%' => $id]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("query", json_encode(['message' => $message, 'Query' => $id]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            $app_user = new AppUser(UserId::fromValue(null), "", "");

            return $this->render("user_table.twig", ['users'=> $appUserRepository->getAll($this->getAccountId()), "user" => $app_user->toArray()]);
        } else {
            $message = $translator->trans("user.delete.fail", ["%error%" => $this->getShellScriptLogFileContents($log_file_name)]);
            return new Response($message, 500);
        }
    }

    /**
     * @Route("/changepassword", methods={"POST"})
     */
    public function changePassword(Request $request, AppUserRepository $appUserRepository, SqsClient $queue, AwsCognitoClient $awsCognitoClient) {
        $shell = $this->getParameter('shell')['userChangePasswordFile'];
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $username = $this->getUserName();

        if (empty($id)) {
            return new Response("No user id provided for changing password ", 500);
        }

        $user = $appUserRepository->find($id);

        try {
            // check the old password credentials
            $awsCognitoClient->checkCredentials($user->getEmail(), $request->request->get('password'));
        } catch (AuthenticationException $ae) {
            return new Response("Provided password does not match the old password ". 500);
        }

        $values = $user->toArray();

        $params[] = $id;
        $uuid = $values['uuid'];
        $params[] = $uuid;
        $params[] = $request->request->get('password');
        $params[] = $request->request->get('newpassword');
        $params[] = $user->getEmail();
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('cognito_pool_id');
        $params[] = $this->getParameter('cognito_pool_client_id');

        $log_file_name = $username.".".time().".changepassword.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("user.changepassword.success");
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("query", json_encode(['message' => $message, 'Query' => $id]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            $app_user = new AppUser(UserId::fromValue(null), "", "");

            return $this->render("user_table.twig", ['users'=> $appUserRepository->getAll($this->getAccountId()), "user" => $app_user->toArray()]);
        } else {
            $message = $translator->trans("user.changepassword.fail", ["%error%" => $this->getShellScriptLogFileContents($log_file_name)]);
            return new Response($message, 500);
        }
    }

    /**
     * @Route("/forgot_password", name="forgot_password")
     */
    public function forgotpassword(FormFactoryInterface $formFactory) {
        return $this->render('user/forgot_password.html.twig', [
            'form' => $formFactory->createNamed('', ForgotPasswordType::class)->createView(),
        ]);
    }
    /**
     * @Route("/forgot-password", name="forgot-password", methods={"POST"})
     */
    public function processForgotPassword(Request $request, AppUserRepository $appUserRepository, SqsClient $queue, FlashBagInterface $flashBag, FormFactoryInterface $formFactory) {
        $shell = $this->getParameter('shell')['userForgotPasswordFile'];
        $translator = $this->get('translator');
        $reset_token = $request->request->get('nickname');

        $user = $appUserRepository->findUserByEmailorUsername($reset_token);

        if ($user == null) {
            $flashBag->add('reset_password_failure', sprintf('No username or email address has been found'));
            return $this->render('user/forgot_password.html.twig', [
                'form' => $formFactory->createNamed('', ForgotPasswordType::class)->createView(),
            ]);
        }

        $values = $user->toArray();

        $username = $values['username'];

        $params[] = $reset_token;
        $uuid = $values['uuid'];
        $params[] = $uuid;
        $params[] = $username;
        $params[] = $values['emailaddress'];
        $params[] = $this->getParameter('s3.region');
        $params[] = $values['snstopic'];
        $password_reset_hash = md5(time());
        $params[] = $password_reset_hash;
        $params[] = "Reset your password at ".$request->getSchemeAndHttpHost()."/reset-password/".$password_reset_hash;
        $params[] = "Application Password Reset";

        $log_file_name = $username.".".time().".forgotpassword.".$uuid.".log";

        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();


        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("forgotpassword", json_encode(['message' => "Sucessfully sent password reset ", 'Credential' => $reset_token]), $user, $uuid);
            $queue->sendMessage($queueData);

            $flashBag->add('success', sprintf('Hi %s, a password reset link has been sent to your email address.  Please follow the instructions to reset your password.', $username));

            return new RedirectResponse('/login');
        } else {
            $flashBag->add('reset_password_failure', $this->getShellScriptLogFileContents($log_file_name));
            return $this->render('user/forgot_password.html.twig', [
                'form' => $formFactory->createNamed('', ForgotPasswordType::class)->createView(),
            ]);
        }
    }

    public function showResetPassword(string $token, Request $request,EntityManagerInterface $em, FormFactoryInterface $formFactory) {
        $user = $em->getRepository(AppUser::class)->findOneBy(['passwordResetToken' => $token]);

        if (!$user instanceof AppUser) {
            throw new NotFoundHttpException();
        }
        $form = $formFactory->createNamed('', ResetPasswordType::class);
        return new Response($this->render('user/reset_password.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/reset-password/{token}", name="reset_password")
     */
    public function processResetPassword(string $token, Request $request, FormFactoryInterface $formFactory,FlashBagInterface $flashBag,EntityManagerInterface $em) {

        $shell = $this->getParameter('shell')['userChangePasswordFile'];
        $user = $em->getRepository(AppUser::class)->findOneBy(['passwordResetToken' => $token]);

        if (!$user instanceof AppUser) {
            return $this->render('user/reset_password.html.twig', [
                'form' => $formFactory->createNamed('', ResetPasswordType::class)->createView(), 'message' => "The password reset token is invalid or has already been used"
            ]);
        }

        $values = $user->toArray();

        $params[] = $values['uuid'];;
        $uuid = $values['uuid'];
        $params[] = $uuid;
        $params[] = $request->request->get('password');
        $params[] = $request->request->get('newpassword');
        $params[] = $user->getEmail();
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('cognito_pool_id');
        $params[] = $this->getParameter('cognito_pool_client_id');


    }
}