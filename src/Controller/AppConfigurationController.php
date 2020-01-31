<?php
/**
 * Configuration Wizard controller actions
 */

namespace App\Controller;


use App\Helper\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;

class AppConfigurationController extends Controller
{
    use Utils;

    /**
     * @Route("/install", name="installconfig")
     */
    public function install() {
        if ($this->getParameter('need_update') == "no") {
            return $this->render("no_install.twig");
        } else {
            return $this->render("install.twig", ["error" => ""]);
        }
    }
    /**
     * @Route("/installsuccess")
     */
    public function installsuccess() {
        return $this->render("install_success.twig");
    }

    /**
     * @Route("/updateconfig", methods={"POST"})
     */
    public function updateconfig(Request $request) {
        $config = [];
        $config['parameters']['rdbms_user'] = $request->request->get('rdbms_user');
        $config['parameters']['rdbms_password'] = $request->request->get('rdbms_password');
        $config['parameters']['rdbms_dbname'] = $request->request->get('rdbms_dbname');
        $config['parameters']['rdbms_host'] = $request->request->get('rdbms_host');
        $config['parameters']['aws_credentials_key'] = $request->request->get('aws_credentials_key');
        $config['parameters']['aws_credentials_secret'] = $request->request->get('aws_credentials_secret');
        $config['parameters']['athena_directory'] = $request->request->get('athena_directory');
        $config['parameters']['athena_database'] = $request->request->get('athena_database');
        $config['parameters']['athena_input'] = "s3://".$request->request->get('s3_bucket').DIRECTORY_SEPARATOR;
        $config['parameters']['athena_output'] = "s3://".$request->request->get('s3_bucket').DIRECTORY_SEPARATOR."athena-output".DIRECTORY_SEPARATOR;
        $config['parameters']['sqs_notificationQueue'] = $request->request->get('sqs_notificationQueue');
        $config['parameters']['s3_bucket'] = $request->request->get('s3_bucket');
        $config['parameters']['need_update'] = "no";
        $config['parameters']['sns_general_topic'] = $request->request->get('sns_general_topic');


        $config_file_path = join(DIRECTORY_SEPARATOR, [$this->getParameter('kernel.project_dir'), "config", "install", "install.yaml"]);
        $aws_config_file_path = join(DIRECTORY_SEPARATOR, [$this->getParameter('kernel.project_dir'), "shell", ".aws_config"]);
        $backup_config_file_path = join(DIRECTORY_SEPARATOR, [$this->getParameter('kernel.project_dir'), "config", "install", $this->getParameter("install_config_file").".bak"]);

        // write to the .aws_config file
        $aws_credentials_output = array("#!/bin/bash", "", " export AWS_ACCESS_KEY_ID=".$config['parameters']['aws_credentials_key'], "export AWS_SECRET_ACCESS_KEY=".$config['parameters']['aws_credentials_secret']);
        file_put_contents($aws_config_file_path,join($aws_credentials_output, PHP_EOL));

        $shell = $this->getParameter('shell')['appSetupFile'];
        $log_file_name = "setup.".time().".log";

        $params = $config['parameters'];
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);

        // add whether to reset the database or not
        $params[] = $request->request->get('setupdb');

        // add config parameters for the cognito pools which are not sent to the script
        $config['parameters']['cognito_pool_id'] = '';
        $config['parameters']['cognito_pool_client_id'] = '';
        // add two blank parameters not to mess up the ordering of the params array after adding the config parameters for the user pools
        $params[] = '';
        $params[] = '';
        $params[] = $this->getParameter('cognito.userpool.groupname');
        $params[] = $this->getParameter('cognito.userpool.name');
        $params[] = $this->getParameter('cognito.userpool.iamrolename');
        $params[] = $this->getParameter('cognito.userpool.clientname');
        $params[] = $this->getParameter('cognito.userpool.defaultuserpassword');

        # write to the configuration file
        // bakup config file
        copy($config_file_path, $backup_config_file_path);
        // copy the config contents to the config file
        file_put_contents($config_file_path, Yaml::dump($config));

        $process =  $this->getShellScriptProcess($shell, $params, $log_file_name);
        $process->run();
        if ($process->isSuccessful()) {

            return $this->render("install_success.twig");
        } else {
            # roll back
            copy($backup_config_file_path, $config_file_path);
            return $this->render("install.twig", ["error" => $this->getShellScriptLogFileContents($log_file_name), "data" => $config['parameters']]);
        }

       return $this->redirect("setupconfiguration");

    }

}