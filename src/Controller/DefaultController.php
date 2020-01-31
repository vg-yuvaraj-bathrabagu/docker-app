<?php
namespace App\Controller;

use App\Helper\Utils;
use App\Repository\TemplateRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends BaseController {

    use Utils;
    /**
     * @Route("/", name="homepage")
     */
    public function index() {
        return $this->redirectToRoute("dashboard");
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard() {
        return $this->render("dashboard.twig", ['account' => $this->getAccount()->toArray()]);
    }

    /**
     * @Route("/reset", name="reset")
     */
    public function reset() {
        return $this->render("reset.twig");
    }

    /**
     * @Route("/sidebar", name="sidebar")
     */
    public function sidebar() {
        return $this->render("sidebar.twig");
    }

    /**
     * @Route("/resetdata")
     */
    public function resetdata(TemplateRepository $templateRepository) {
        $shell = $this->getParameter('shell')['adminResetFile'];
        $file_name = $this->getUserName()."resetdata".$this->getAccountForLoggedInUser($this->getUser())->getUuid().time().".log";

        $params[] = $this->getParameter('athena_database');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getAccountId();
        $params[] = $this->getS3FolderNameForAccount();
        $params[] = $this->getSpaceDelimitedListOfTemplateTables($templateRepository->getAll($this->getAccountId()));
        $params[] = $this->getShellScriptLogFileAbsolutePath($file_name);

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $file_name);
        $process->run();

        return new Response($this->getShellScriptLogFileContents($file_name));
    }

    /**
     * @Route("activitycurrent", name="activitycurrent")
     */
    public function activityCurrent() {
        return $this->render("activity.current.twig", ['account' => $this->getAccount()->toArray()]);
    }
    /**
     * @Route("activityhistory", name="activityhistory")
     */
    public function activityHistory() {
        return $this->render("activity.history.twig", ['account' => $this->getAccount()->toArray()]);
    }

    private function getSpaceDelimitedListOfTemplateTables($templates)
    {
        $table_names = [];
        foreach ($templates as $value) {
            $table_names[] = $value['tablename']."_u";
            $table_names[] = $value['tablename']."_u_text";

            if ($value['type'] == "Core") {
                $table_names[] = $value['tablename'];
                $table_names[] = $value['tablename']."_text";
            }

        }

        return join(" ", $table_names);
        
    }

    /**
     * @Route("/download/{filename}/{downloadfilename}", name="download")
     */

    public function download($filename, $downloadfilename) {
        $file_absolute_path = join(array($this->getParameter("kernel.project_dir"), "var", "log", $filename), "/");

        if (empty($downloadfilename)) {
            $downloadfilename = $filename;
        }

        return $this->file($file_absolute_path, $downloadfilename);
    }

    /**
     * @Route("/phpinfo", name="phpinfo")
     */
    public function info() {
        ob_start();
        phpinfo();
        $str = ob_get_contents();
        ob_get_clean();

        return new Response($str);
    }

}