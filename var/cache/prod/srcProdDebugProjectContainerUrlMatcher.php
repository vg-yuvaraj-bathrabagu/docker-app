<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcProdDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = $allowSchemes = [];
        if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
            return $ret;
        }
        if ($allow) {
            throw new MethodNotAllowedException(array_keys($allow));
        }
        if (!in_array($this->context->getMethod(), ['HEAD', 'GET'], true)) {
            // no-op
        } elseif ($allowSchemes) {
            redirect_scheme:
            $scheme = $this->context->getScheme();
            $this->context->setScheme(key($allowSchemes));
            try {
                if ($ret = $this->doMatch($pathinfo)) {
                    return $this->redirect($pathinfo, $ret['_route'], $this->context->getScheme()) + $ret;
                }
            } finally {
                $this->context->setScheme($scheme);
            }
        } elseif ('/' !== $trimmedPathinfo = rtrim($pathinfo, '/') ?: '/') {
            $pathinfo = $trimmedPathinfo === $pathinfo ? $pathinfo.'/' : $trimmedPathinfo;
            if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
                return $this->redirect($pathinfo, $ret['_route']) + $ret;
            }
            if ($allowSchemes) {
                goto redirect_scheme;
            }
        }

        throw new ResourceNotFoundException();
    }

    private function doMatch(string $pathinfo, array &$allow = [], array &$allowSchemes = []): array
    {
        $allow = $allowSchemes = [];
        $pathinfo = rawurldecode($pathinfo) ?: '/';
        $trimmedPathinfo = rtrim($pathinfo, '/') ?: '/';
        $context = $this->context;
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        switch ($trimmedPathinfo) {
            default:
                $routes = [
                    '/createaccount' => [['_route' => 'app_account_create', '_controller' => 'App\\Controller\\AccountController::create'], null, ['POST' => 0], null, false],
                    '/accounts' => [['_route' => 'accounts', '_controller' => 'App\\Controller\\AccountController::index'], null, null, null, false],
                    '/account/refresh' => [['_route' => 'app_account_refresh', '_controller' => 'App\\Controller\\AccountController::refresh'], null, null, null, false],
                    '/editaccount' => [['_route' => 'app_account_edit', '_controller' => 'App\\Controller\\AccountController::edit'], null, ['GET' => 0], null, false],
                    '/viewaccount' => [['_route' => 'app_account_view', '_controller' => 'App\\Controller\\AccountController::view'], null, ['GET' => 0], null, false],
                    '/deleteaccount' => [['_route' => 'app_account_delete', '_controller' => 'App\\Controller\\AccountController::delete'], null, ['GET' => 0], null, false],
                    '/install' => [['_route' => 'installconfig', '_controller' => 'App\\Controller\\AppConfigurationController::install'], null, null, null, false],
                    '/installsuccess' => [['_route' => 'app_appconfiguration_installsuccess', '_controller' => 'App\\Controller\\AppConfigurationController::installsuccess'], null, null, null, false],
                    '/updateconfig' => [['_route' => 'app_appconfiguration_updateconfig', '_controller' => 'App\\Controller\\AppConfigurationController::updateconfig'], null, ['POST' => 0], null, false],
                    '/conversion' => [['_route' => 'conversion', '_controller' => 'App\\Controller\\ConversionController::conversion'], null, null, null, false],
                    '/conversion/refresh' => [['_route' => 'app_conversion_refresh', '_controller' => 'App\\Controller\\ConversionController::refresh'], null, null, null, false],
                    '/createconversion' => [['_route' => 'app_conversion_create', '_controller' => 'App\\Controller\\ConversionController::create'], null, ['POST' => 0], null, false],
                    '/editconversion' => [['_route' => 'app_conversion_edit', '_controller' => 'App\\Controller\\ConversionController::edit'], null, ['GET' => 0], null, false],
                    '/viewconversion' => [['_route' => 'app_conversion_view', '_controller' => 'App\\Controller\\ConversionController::view'], null, ['GET' => 0], null, false],
                    '/activateconversion' => [['_route' => 'app_conversion_activate', '_controller' => 'App\\Controller\\ConversionController::activate'], null, ['GET' => 0], null, false],
                    '/deleteconversion' => [['_route' => 'app_conversion_delete', '_controller' => 'App\\Controller\\ConversionController::delete'], null, ['GET' => 0], null, false],
                    '/' => [['_route' => 'homepage', '_controller' => 'App\\Controller\\DefaultController::index'], null, null, null, false],
                    '/dashboard' => [['_route' => 'dashboard', '_controller' => 'App\\Controller\\DefaultController::dashboard'], null, null, null, false],
                    '/reset' => [['_route' => 'reset', '_controller' => 'App\\Controller\\DefaultController::reset'], null, null, null, false],
                    '/sidebar' => [['_route' => 'sidebar', '_controller' => 'App\\Controller\\DefaultController::sidebar'], null, null, null, false],
                    '/resetdata' => [['_route' => 'app_default_resetdata', '_controller' => 'App\\Controller\\DefaultController::resetdata'], null, null, null, false],
                    '/activitycurrent' => [['_route' => 'activitycurrent', '_controller' => 'App\\Controller\\DefaultController::activityCurrent'], null, null, null, false],
                    '/activityhistory' => [['_route' => 'activityhistory', '_controller' => 'App\\Controller\\DefaultController::activityHistory'], null, null, null, false],
                    '/phpinfo' => [['_route' => 'phpinfo', '_controller' => 'App\\Controller\\DefaultController::info'], null, null, null, false],
                    '/upload' => [['_route' => 'upload', '_controller' => 'App\\Controller\\FileUploadController::upload'], null, null, null, false],
                    '/uploads' => [['_route' => 'uploads', '_controller' => 'App\\Controller\\FileUploadController::uploads'], null, null, null, false],
                    '/processs3' => [['_route' => 'app_fileupload_processs3upload', '_controller' => 'App\\Controller\\FileUploadController::processS3Upload'], null, null, null, false],
                    '/copyorc' => [['_route' => 'app_fileupload_copyorc', '_controller' => 'App\\Controller\\FileUploadController::copyORC'], null, null, null, false],
                    '/copypar' => [['_route' => 'app_fileupload_copyparquet', '_controller' => 'App\\Controller\\FileUploadController::copyParquet'], null, null, null, false],
                    '/deletefile' => [['_route' => 'app_fileupload_delete', '_controller' => 'App\\Controller\\FileUploadController::delete'], null, null, null, false],
                    '/restorefile' => [['_route' => 'app_fileupload_restore', '_controller' => 'App\\Controller\\FileUploadController::restore'], null, null, null, false],
                    '/copytosharedfolder' => [['_route' => 'app_fileupload_copytosharedfolder', '_controller' => 'App\\Controller\\FileUploadController::copyToSharedFolder'], null, null, null, false],
                    '/watcher' => [['_route' => 'watcher', '_controller' => 'App\\Controller\\FileWatcherController::watcher'], null, null, null, false],
                    '/filewatcher/refresh' => [['_route' => 'app_filewatcher_refresh', '_controller' => 'App\\Controller\\FileWatcherController::refresh'], null, null, null, false],
                    '/createfilewatcher' => [['_route' => 'app_filewatcher_create', '_controller' => 'App\\Controller\\FileWatcherController::create'], null, ['POST' => 0], null, false],
                    '/editfilewatcher' => [['_route' => 'app_filewatcher_edit', '_controller' => 'App\\Controller\\FileWatcherController::edit'], null, ['GET' => 0], null, false],
                    '/viewfilewatcher' => [['_route' => 'app_filewatcher_view', '_controller' => 'App\\Controller\\FileWatcherController::view'], null, ['GET' => 0], null, false],
                    '/deletefilewatcher' => [['_route' => 'app_filewatcher_delete', '_controller' => 'App\\Controller\\FileWatcherController::delete'], null, ['GET' => 0], null, false],
                    '/runfilewatcher' => [['_route' => 'app_filewatcher_run', '_controller' => 'App\\Controller\\FileWatcherController::run'], null, ['GET' => 0], null, false],
                    '/createhadoop' => [['_route' => 'app_hadoopstatus_createhadoop', '_controller' => 'App\\Controller\\HadoopStatusController::createHadoop'], null, ['POST' => 0], null, false],
                    '/hadoop' => [['_route' => 'hadoop', '_controller' => 'App\\Controller\\HadoopStatusController::index'], null, null, null, false],
                    '/hadoop/refresh' => [['_route' => 'app_hadoopstatus_refresh', '_controller' => 'App\\Controller\\HadoopStatusController::refresh'], null, null, null, false],
                    '/starthadoop' => [['_route' => 'app_hadoopstatus_starthadoop', '_controller' => 'App\\Controller\\HadoopStatusController::startHadoop'], null, null, null, false],
                    '/stophadoop' => [['_route' => 'app_hadoopstatus_stophadoop', '_controller' => 'App\\Controller\\HadoopStatusController::stopHadoop'], null, null, null, false],
                    '/creatempp' => [['_route' => 'app_mppstatus_creatempp', '_controller' => 'App\\Controller\\MPPStatusController::creatempp'], null, ['POST' => 0], null, false],
                    '/mpp' => [['_route' => 'mpp', '_controller' => 'App\\Controller\\MPPStatusController::index'], null, null, null, false],
                    '/mpp/refresh' => [['_route' => 'app_mppstatus_refresh', '_controller' => 'App\\Controller\\MPPStatusController::refresh'], null, null, null, false],
                    '/startmpp' => [['_route' => 'app_mppstatus_startmpp', '_controller' => 'App\\Controller\\MPPStatusController::startmpp'], null, null, null, false],
                    '/stopmpp' => [['_route' => 'app_mppstatus_stopmpp', '_controller' => 'App\\Controller\\MPPStatusController::stopmpp'], null, null, null, false],
                    '/nexusinitalize' => [['_route' => 'nexusinitalize', '_controller' => 'App\\Controller\\NexusController::initialize'], null, null, null, false],
                    '/nexusanalysis' => [['_route' => 'nexusanalysis', '_controller' => 'App\\Controller\\NexusController::analysis'], null, null, null, false],
                    '/dataprofile' => [['_route' => 'dataprofile', '_controller' => 'App\\Controller\\NexusController::dataprofile'], null, null, null, false],
                    '/runanalysis' => [['_route' => 'runanalysis', '_controller' => 'App\\Controller\\NexusController::runanalysis'], null, null, null, false],
                    '/rundataprofile' => [['_route' => 'rundataprofile', '_controller' => 'App\\Controller\\NexusController::rundataprofile'], null, null, null, false],
                    '/nexusreport' => [['_route' => 'nexusreport', '_controller' => 'App\\Controller\\NexusController::report'], null, null, null, false],
                    '/nexusmetadata' => [['_route' => 'nexusmetadata', '_controller' => 'App\\Controller\\NexusController::metadata'], null, null, null, false],
                    '/viewnexusmetadata' => [['_route' => 'app_nexus_view', '_controller' => 'App\\Controller\\NexusController::view'], null, ['GET' => 0], null, false],
                    '/nexusfileupload' => [['_route' => 'nexusfileupload', '_controller' => 'App\\Controller\\NexusController::upload'], null, null, null, false],
                    '/nexussetup' => [['_route' => 'nexussetup', '_controller' => 'App\\Controller\\NexusController::setup'], null, null, null, false],
                    '/notifications' => [['_route' => 'app_notification_notifications', '_controller' => 'App\\Controller\\NotificationController::notifications'], null, ['GET' => 0], null, false],
                    '/pushnotification' => [['_route' => 'app_notification_pushnotification', '_controller' => 'App\\Controller\\NotificationController::pushNotification'], null, ['POST' => 0], null, false],
                    '/markread' => [['_route' => 'app_notification_markread', '_controller' => 'App\\Controller\\NotificationController::markRead'], null, null, null, false],
                    '/projectassignment' => [['_route' => 'projectassignment', '_controller' => 'App\\Controller\\ProjectAssignmentController::projects'], null, null, null, false],
                    '/projectassignment/refresh' => [['_route' => 'app_projectassignment_refresh', '_controller' => 'App\\Controller\\ProjectAssignmentController::refresh'], null, null, null, false],
                    '/createprojectassignment' => [['_route' => 'app_projectassignment_create', '_controller' => 'App\\Controller\\ProjectAssignmentController::create'], null, ['POST' => 0], null, false],
                    '/editprojectassignment' => [['_route' => 'app_projectassignment_edit', '_controller' => 'App\\Controller\\ProjectAssignmentController::edit'], null, ['GET' => 0], null, false],
                    '/viewprojectassignment' => [['_route' => 'app_projectassignment_view', '_controller' => 'App\\Controller\\ProjectAssignmentController::view'], null, ['GET' => 0], null, false],
                    '/deleteprojectassignment' => [['_route' => 'app_projectassignment_delete', '_controller' => 'App\\Controller\\ProjectAssignmentController::delete'], null, ['GET' => 0], null, false],
                    '/project' => [['_route' => 'project', '_controller' => 'App\\Controller\\ProjectController::project'], null, null, null, false],
                    '/newproject' => [['_route' => 'app_project_new', '_controller' => 'App\\Controller\\ProjectController::new'], null, null, null, false],
                    '/project/refresh' => [['_route' => 'app_project_refresh', '_controller' => 'App\\Controller\\ProjectController::refresh'], null, null, null, false],
                    '/createproject' => [['_route' => 'app_project_create', '_controller' => 'App\\Controller\\ProjectController::create'], null, ['POST' => 0], null, false],
                    '/editproject' => [['_route' => 'app_project_edit', '_controller' => 'App\\Controller\\ProjectController::edit'], null, ['GET' => 0], null, false],
                    '/viewproject' => [['_route' => 'app_project_view', '_controller' => 'App\\Controller\\ProjectController::view'], null, ['GET' => 0], null, false],
                    '/deleteproject' => [['_route' => 'app_project_delete', '_controller' => 'App\\Controller\\ProjectController::delete'], null, ['GET' => 0], null, false],
                    '/projectrate' => [['_route' => 'projectrate', '_controller' => 'App\\Controller\\ProjectRateController::projectrate'], null, null, null, false],
                    '/newprojectrate' => [['_route' => 'app_projectrate_new', '_controller' => 'App\\Controller\\ProjectRateController::new'], null, null, null, false],
                    '/projectrate/refresh' => [['_route' => 'app_projectrate_refresh', '_controller' => 'App\\Controller\\ProjectRateController::refresh'], null, null, null, false],
                    '/editprojectrate' => [['_route' => 'app_projectrate_edit', '_controller' => 'App\\Controller\\ProjectRateController::edit'], null, ['GET' => 0], null, false],
                    '/viewprojectrate' => [['_route' => 'app_projectrate_view', '_controller' => 'App\\Controller\\ProjectRateController::view'], null, ['GET' => 0], null, false],
                    '/createprojectrate' => [['_route' => 'app_projectrate_create', '_controller' => 'App\\Controller\\ProjectRateController::create'], null, ['POST' => 0], null, false],
                    '/deleteprojectrate' => [['_route' => 'app_projectrate_delete', '_controller' => 'App\\Controller\\ProjectRateController::delete'], null, ['GET' => 0], null, false],
                    '/queries' => [['_route' => 'queries', '_controller' => 'App\\Controller\\QueryController::queries'], null, null, null, false],
                    '/queries/refresh' => [['_route' => 'app_query_refresh', '_controller' => 'App\\Controller\\QueryController::refresh'], null, null, null, false],
                    '/createquery' => [['_route' => 'app_query_createquery', '_controller' => 'App\\Controller\\QueryController::createQuery'], null, ['POST' => 0], null, false],
                    '/editquery' => [['_route' => 'app_query_edit', '_controller' => 'App\\Controller\\QueryController::edit'], null, ['GET' => 0], null, false],
                    '/viewquery' => [['_route' => 'app_query_view', '_controller' => 'App\\Controller\\QueryController::view'], null, ['GET' => 0], null, false],
                    '/deletequery' => [['_route' => 'app_query_delete', '_controller' => 'App\\Controller\\QueryController::delete'], null, ['GET' => 0], null, false],
                    '/runquery' => [['_route' => 'app_query_run', '_controller' => 'App\\Controller\\QueryController::run'], null, ['GET' => 0], null, false],
                    '/model' => [['_route' => 'model', '_controller' => 'App\\Controller\\SimulationController::simulator'], null, null, null, false],
                    '/model/refresh' => [['_route' => 'app_simulation_refresh', '_controller' => 'App\\Controller\\SimulationController::refresh'], null, null, null, false],
                    '/createmodel' => [['_route' => 'app_simulation_create', '_controller' => 'App\\Controller\\SimulationController::create'], null, ['POST' => 0], null, false],
                    '/editmodel' => [['_route' => 'app_simulation_edit', '_controller' => 'App\\Controller\\SimulationController::edit'], null, ['GET' => 0], null, false],
                    '/viewmodel' => [['_route' => 'app_simulation_view', '_controller' => 'App\\Controller\\SimulationController::view'], null, ['GET' => 0], null, false],
                    '/deletemodel' => [['_route' => 'app_simulation_delete', '_controller' => 'App\\Controller\\SimulationController::delete'], null, ['GET' => 0], null, false],
                    '/runmodel' => [['_route' => 'app_simulation_run', '_controller' => 'App\\Controller\\SimulationController::run'], null, ['GET' => 0], null, false],
                    '/sqs' => [['_route' => 'app_sqs_sqs', '_controller' => 'App\\Controller\\SqsController::sqs'], null, ['GET' => 0], null, false],
                    '/sqslist' => [['_route' => 'app_sqs_viewsqs', '_controller' => 'App\\Controller\\SqsController::viewSQS'], null, null, null, false],
                    '/tables' => [['_route' => 'tables', '_controller' => 'App\\Controller\\TableController::tables'], null, null, null, false],
                    '/tables/refresh' => [['_route' => 'app_table_refresh', '_controller' => 'App\\Controller\\TableController::refresh'], null, null, null, false],
                    '/tables/searchforfiles' => [['_route' => 'app_table_search', '_controller' => 'App\\Controller\\TableController::search'], null, null, null, false],
                    '/taskcategory' => [['_route' => 'taskcategory', '_controller' => 'App\\Controller\\TaskCategoryController::taskcategory'], null, null, null, false],
                    '/newtaskcategory' => [['_route' => 'app_taskcategory_new', '_controller' => 'App\\Controller\\TaskCategoryController::new'], null, null, null, false],
                    '/taskcategory/refresh' => [['_route' => 'app_taskcategory_refresh', '_controller' => 'App\\Controller\\TaskCategoryController::refresh'], null, null, null, false],
                    '/edittaskcategory' => [['_route' => 'app_taskcategory_edit', '_controller' => 'App\\Controller\\TaskCategoryController::edit'], null, ['GET' => 0], null, false],
                    '/viewtaskcategory' => [['_route' => 'app_taskcategory_view', '_controller' => 'App\\Controller\\TaskCategoryController::view'], null, ['GET' => 0], null, false],
                    '/createtaskcategory' => [['_route' => 'app_taskcategory_create', '_controller' => 'App\\Controller\\TaskCategoryController::create'], null, ['POST' => 0], null, false],
                    '/deletetaskcategory' => [['_route' => 'app_taskcategory_delete', '_controller' => 'App\\Controller\\TaskCategoryController::delete'], null, ['GET' => 0], null, false],
                    '/task' => [['_route' => 'task', '_controller' => 'App\\Controller\\TaskController::task'], null, null, null, false],
                    '/newtask' => [['_route' => 'app_task_new', '_controller' => 'App\\Controller\\TaskController::new'], null, null, null, false],
                    '/task/refresh' => [['_route' => 'app_task_refresh', '_controller' => 'App\\Controller\\TaskController::refresh'], null, null, null, false],
                    '/edittask' => [['_route' => 'app_task_edit', '_controller' => 'App\\Controller\\TaskController::edit'], null, ['GET' => 0], null, false],
                    '/blanktask' => [['_route' => 'app_task_blank', '_controller' => 'App\\Controller\\TaskController::blank'], null, ['GET' => 0], null, false],
                    '/viewtask' => [['_route' => 'app_task_view', '_controller' => 'App\\Controller\\TaskController::view'], null, ['GET' => 0], null, false],
                    '/createtask' => [['_route' => 'app_task_create', '_controller' => 'App\\Controller\\TaskController::create'], null, ['POST' => 0], null, false],
                    '/deletetask' => [['_route' => 'app_task_delete', '_controller' => 'App\\Controller\\TaskController::delete'], null, ['GET' => 0], null, false],
                    '/taskqueue' => [['_route' => 'taskqueue', '_controller' => 'App\\Controller\\TaskQueueController::taskqueue'], null, null, null, false],
                    '/newtaskqueue' => [['_route' => 'app_taskqueue_new', '_controller' => 'App\\Controller\\TaskQueueController::new'], null, null, null, false],
                    '/taskqueue/refresh' => [['_route' => 'app_taskqueue_refresh', '_controller' => 'App\\Controller\\TaskQueueController::refresh'], null, null, null, false],
                    '/edittaskqueue' => [['_route' => 'app_taskqueue_edit', '_controller' => 'App\\Controller\\TaskQueueController::edit'], null, ['GET' => 0], null, false],
                    '/viewtaskqueue' => [['_route' => 'app_taskqueue_view', '_controller' => 'App\\Controller\\TaskQueueController::view'], null, ['GET' => 0], null, false],
                    '/createtaskqueue' => [['_route' => 'app_taskqueue_create', '_controller' => 'App\\Controller\\TaskQueueController::create'], null, ['POST' => 0], null, false],
                    '/deletetaskqueue' => [['_route' => 'app_taskqueue_delete', '_controller' => 'App\\Controller\\TaskQueueController::delete'], null, ['GET' => 0], null, false],
                    '/tasktemplate' => [['_route' => 'tasktemplate', '_controller' => 'App\\Controller\\TaskTemplateController::tasktemplate'], null, null, null, false],
                    '/newtasktemplate' => [['_route' => 'app_tasktemplate_new', '_controller' => 'App\\Controller\\TaskTemplateController::new'], null, null, null, false],
                    '/tasktemplate/refresh' => [['_route' => 'app_tasktemplate_refresh', '_controller' => 'App\\Controller\\TaskTemplateController::refresh'], null, null, null, false],
                    '/edittasktemplate' => [['_route' => 'app_tasktemplate_edit', '_controller' => 'App\\Controller\\TaskTemplateController::edit'], null, ['GET' => 0], null, false],
                    '/viewtasktemplate' => [['_route' => 'app_tasktemplate_view', '_controller' => 'App\\Controller\\TaskTemplateController::view'], null, ['GET' => 0], null, false],
                    '/createtasktemplate' => [['_route' => 'app_tasktemplate_create', '_controller' => 'App\\Controller\\TaskTemplateController::create'], null, ['POST' => 0], null, false],
                    '/deletetasktemplate' => [['_route' => 'app_tasktemplate_delete', '_controller' => 'App\\Controller\\TaskTemplateController::delete'], null, ['GET' => 0], null, false],
                    '/createtemplate' => [['_route' => 'app_template_createtemplate', '_controller' => 'App\\Controller\\TemplateController::createTemplate'], null, ['POST' => 0], null, false],
                    '/templates' => [['_route' => 'templates', '_controller' => 'App\\Controller\\TemplateController::index'], null, null, null, false],
                    '/wizard' => [['_route' => 'app_template_wizard', '_controller' => 'App\\Controller\\TemplateController::wizard'], null, null, null, false],
                    '/templates/refresh' => [['_route' => 'app_template_refresh', '_controller' => 'App\\Controller\\TemplateController::refresh'], null, null, null, false],
                    '/edittemplate' => [['_route' => 'app_template_edit', '_controller' => 'App\\Controller\\TemplateController::edit'], null, ['GET' => 0], null, false],
                    '/blanktemplate' => [['_route' => 'app_template_blank', '_controller' => 'App\\Controller\\TemplateController::blank'], null, ['GET' => 0], null, false],
                    '/activatetemplate' => [['_route' => 'app_template_activate', '_controller' => 'App\\Controller\\TemplateController::activate'], null, null, null, false],
                    '/deactivatetemplate' => [['_route' => 'app_template_deactivate', '_controller' => 'App\\Controller\\TemplateController::deactivate'], null, null, null, false],
                    '/synctemplate' => [['_route' => 'app_template_sync', '_controller' => 'App\\Controller\\TemplateController::sync'], null, ['GET' => 0], null, false],
                    '/deletetemplate' => [['_route' => 'app_template_delete', '_controller' => 'App\\Controller\\TemplateController::delete'], null, ['GET' => 0], null, false],
                    '/getsamplerow' => [['_route' => 'app_template_samplerow', '_controller' => 'App\\Controller\\TemplateController::samplerow'], null, ['POST' => 0], null, false],
                    '/timesheet' => [['_route' => 'timesheet', '_controller' => 'App\\Controller\\TimesheetController::timesheet'], null, null, null, false],
                    '/newtimesheet' => [['_route' => 'app_timesheet_new', '_controller' => 'App\\Controller\\TimesheetController::new'], null, null, null, false],
                    '/timesheet/refresh' => [['_route' => 'app_timesheet_refresh', '_controller' => 'App\\Controller\\TimesheetController::refresh'], null, null, null, false],
                    '/edittimesheet' => [['_route' => 'app_timesheet_edit', '_controller' => 'App\\Controller\\TimesheetController::edit'], null, ['GET' => 0], null, false],
                    '/viewtimesheet' => [['_route' => 'app_timesheet_view', '_controller' => 'App\\Controller\\TimesheetController::view'], null, ['GET' => 0], null, false],
                    '/createtimesheet' => [['_route' => 'app_timesheet_create', '_controller' => 'App\\Controller\\TimesheetController::create'], null, ['POST' => 0], null, false],
                    '/deletetimesheet' => [['_route' => 'app_timesheet_delete', '_controller' => 'App\\Controller\\TimesheetController::delete'], null, ['GET' => 0], null, false],
                    '/users' => [['_route' => 'users', '_controller' => 'App\\Controller\\User\\AppUserController::users'], null, null, null, false],
                    '/createuser' => [['_route' => 'app_user_appuser_create', '_controller' => 'App\\Controller\\User\\AppUserController::create'], null, ['POST' => 0], null, false],
                    '/edituser' => [['_route' => 'app_user_appuser_edit', '_controller' => 'App\\Controller\\User\\AppUserController::edit'], null, ['GET' => 0], null, false],
                    '/blankuser' => [['_route' => 'app_user_appuser_blankuser', '_controller' => 'App\\Controller\\User\\AppUserController::blankuser'], null, ['GET' => 0], null, false],
                    '/deleteuser' => [['_route' => 'app_user_appuser_delete', '_controller' => 'App\\Controller\\User\\AppUserController::delete'], null, ['GET' => 0], null, false],
                    '/changepassword' => [['_route' => 'app_user_appuser_changepassword', '_controller' => 'App\\Controller\\User\\AppUserController::changePassword'], null, ['POST' => 0], null, false],
                    '/forgot_password' => [['_route' => 'forgot_password', '_controller' => 'App\\Controller\\User\\AppUserController::forgotpassword'], null, null, null, false],
                    '/forgot-password' => [['_route' => 'forgot-password', '_controller' => 'App\\Controller\\User\\AppUserController::processForgotPassword'], null, ['POST' => 0], null, false],
                    '/login' => [['_route' => 'login', '_controller' => 'App\\Controller\\User\\LoginController'], null, null, null, false],
                    '/profile' => [['_route' => 'profile', '_controller' => 'App\\Controller\\User\\ProfileController::profile'], null, null, null, false],
                    '/logout' => [['_route' => 'logout'], null, null, null, false],
                    '/monitor/health' => [['_route' => 'liip_monitor_health_interface', '_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::indexAction'], null, null, null, true],
                    '/monitor/health/checks' => [['_route' => 'liip_monitor_list_checks', '_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::listAction'], null, null, null, false],
                    '/monitor/health/all_checks' => [['_route' => 'liip_monitor_list_all_checks', '_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::listAllAction'], null, null, null, false],
                    '/monitor/health/groups' => [['_route' => 'liip_monitor_list_groups', '_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::listGroupsAction'], null, null, null, false],
                    '/monitor/health/http_status_checks' => [['_route' => 'liip_monitor_run_all_checks_http_status', '_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::runAllChecksHttpStatusAction'], null, null, null, false],
                    '/monitor/health/run' => [['_route' => 'liip_monitor_run_all_checks', '_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::runAllChecksAction'], null, null, null, false],
                ];

                if (!isset($routes[$trimmedPathinfo])) {
                    break;
                }
                list($ret, $requiredHost, $requiredMethods, $requiredSchemes, $hasTrailingSlash) = $routes[$trimmedPathinfo];
                if ('/' !== $pathinfo && $hasTrailingSlash === ($trimmedPathinfo === $pathinfo)) {
                    if ('GET' === $canonicalMethod && (!$requiredMethods || isset($requiredMethods['GET']))) {
                        return $allow = $allowSchemes = [];
                    }
                    break;
                }

                $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                    if ($hasRequiredScheme) {
                        $allow += $requiredMethods;
                    }
                    break;
                }
                if (!$hasRequiredScheme) {
                    $allowSchemes += $requiredSchemes;
                    break;
                }

                return $ret;
        }

        $matchedPathinfo = $pathinfo;
        $regexList = [
            0 => '{^(?'
                    .'|/download/([^/]++)/([^/]++)(*:34)'
                    .'|/reset\\-password/([^/]++)(*:66)'
                    .'|/monitor/health/(?'
                        .'|http_status_check/([^/]++)(*:118)'
                        .'|run/([^/]++)(*:138)'
                    .')'
                .')/?$}sD',
        ];

        foreach ($regexList as $offset => $regex) {
            while (preg_match($regex, $matchedPathinfo, $matches)) {
                switch ($m = (int) $matches['MARK']) {
                    default:
                        $routes = [
                            34 => [['_route' => 'download', '_controller' => 'App\\Controller\\DefaultController::download'], ['filename', 'downloadfilename'], null, null, false, true],
                            66 => [['_route' => 'reset_password', '_controller' => 'App\\Controller\\User\\AppUserController::processResetPassword'], ['token'], null, null, false, true],
                            118 => [['_route' => 'liip_monitor_run_single_check_http_status', '_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::runSingleCheckHttpStatusAction'], ['checkId'], null, null, false, true],
                            138 => [['_route' => 'liip_monitor_run_single_check', '_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::runSingleCheckAction'], ['checkId'], null, null, false, true],
                        ];

                        list($ret, $vars, $requiredMethods, $requiredSchemes, $hasTrailingSlash, $hasTrailingVar) = $routes[$m];

                        $hasTrailingVar = $trimmedPathinfo !== $pathinfo && $hasTrailingVar;
                        if ('/' !== $pathinfo && !$hasTrailingVar && $hasTrailingSlash === ($trimmedPathinfo === $pathinfo)) {
                            if ('GET' === $canonicalMethod && (!$requiredMethods || isset($requiredMethods['GET']))) {
                                return $allow = $allowSchemes = [];
                            }
                            break;
                        }
                        if ($hasTrailingSlash && $hasTrailingVar && preg_match($regex, rtrim($matchedPathinfo, '/') ?: '/', $n) && $m === (int) $n['MARK']) {
                            $matches = $n;
                        }

                        foreach ($vars as $i => $v) {
                            if (isset($matches[1 + $i])) {
                                $ret[$v] = $matches[1 + $i];
                            }
                        }

                        $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                        if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                            if ($hasRequiredScheme) {
                                $allow += $requiredMethods;
                            }
                            break;
                        }
                        if (!$hasRequiredScheme) {
                            $allowSchemes += $requiredSchemes;
                            break;
                        }

                        return $ret;
                }

                if (138 === $m) {
                    break;
                }
                $regex = substr_replace($regex, 'F', $m - $offset, 1 + strlen($m));
                $offset += strlen($m);
            }
        }
        if ('/' === $pathinfo && !$allow && !$allowSchemes) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        return [];
    }
}
