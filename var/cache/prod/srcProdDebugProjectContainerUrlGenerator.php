<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcProdDebugProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = [
        'app_account_create' => [[], ['_controller' => 'App\\Controller\\AccountController::create'], [], [['text', '/createaccount']], [], []],
        'accounts' => [[], ['_controller' => 'App\\Controller\\AccountController::index'], [], [['text', '/accounts']], [], []],
        'app_account_refresh' => [[], ['_controller' => 'App\\Controller\\AccountController::refresh'], [], [['text', '/account/refresh']], [], []],
        'app_account_edit' => [[], ['_controller' => 'App\\Controller\\AccountController::edit'], [], [['text', '/editaccount']], [], []],
        'app_account_view' => [[], ['_controller' => 'App\\Controller\\AccountController::view'], [], [['text', '/viewaccount']], [], []],
        'app_account_delete' => [[], ['_controller' => 'App\\Controller\\AccountController::delete'], [], [['text', '/deleteaccount']], [], []],
        'installconfig' => [[], ['_controller' => 'App\\Controller\\AppConfigurationController::install'], [], [['text', '/install']], [], []],
        'app_appconfiguration_installsuccess' => [[], ['_controller' => 'App\\Controller\\AppConfigurationController::installsuccess'], [], [['text', '/installsuccess']], [], []],
        'app_appconfiguration_updateconfig' => [[], ['_controller' => 'App\\Controller\\AppConfigurationController::updateconfig'], [], [['text', '/updateconfig']], [], []],
        'conversion' => [[], ['_controller' => 'App\\Controller\\ConversionController::conversion'], [], [['text', '/conversion']], [], []],
        'app_conversion_refresh' => [[], ['_controller' => 'App\\Controller\\ConversionController::refresh'], [], [['text', '/conversion/refresh']], [], []],
        'app_conversion_create' => [[], ['_controller' => 'App\\Controller\\ConversionController::create'], [], [['text', '/createconversion']], [], []],
        'app_conversion_edit' => [[], ['_controller' => 'App\\Controller\\ConversionController::edit'], [], [['text', '/editconversion']], [], []],
        'app_conversion_view' => [[], ['_controller' => 'App\\Controller\\ConversionController::view'], [], [['text', '/viewconversion']], [], []],
        'app_conversion_activate' => [[], ['_controller' => 'App\\Controller\\ConversionController::activate'], [], [['text', '/activateconversion']], [], []],
        'app_conversion_delete' => [[], ['_controller' => 'App\\Controller\\ConversionController::delete'], [], [['text', '/deleteconversion']], [], []],
        'homepage' => [[], ['_controller' => 'App\\Controller\\DefaultController::index'], [], [['text', '/']], [], []],
        'dashboard' => [[], ['_controller' => 'App\\Controller\\DefaultController::dashboard'], [], [['text', '/dashboard']], [], []],
        'reset' => [[], ['_controller' => 'App\\Controller\\DefaultController::reset'], [], [['text', '/reset']], [], []],
        'sidebar' => [[], ['_controller' => 'App\\Controller\\DefaultController::sidebar'], [], [['text', '/sidebar']], [], []],
        'app_default_resetdata' => [[], ['_controller' => 'App\\Controller\\DefaultController::resetdata'], [], [['text', '/resetdata']], [], []],
        'activitycurrent' => [[], ['_controller' => 'App\\Controller\\DefaultController::activityCurrent'], [], [['text', '/activitycurrent']], [], []],
        'activityhistory' => [[], ['_controller' => 'App\\Controller\\DefaultController::activityHistory'], [], [['text', '/activityhistory']], [], []],
        'download' => [['filename', 'downloadfilename'], ['_controller' => 'App\\Controller\\DefaultController::download'], [], [['variable', '/', '[^/]++', 'downloadfilename'], ['variable', '/', '[^/]++', 'filename'], ['text', '/download']], [], []],
        'phpinfo' => [[], ['_controller' => 'App\\Controller\\DefaultController::info'], [], [['text', '/phpinfo']], [], []],
        'upload' => [[], ['_controller' => 'App\\Controller\\FileUploadController::upload'], [], [['text', '/upload']], [], []],
        'uploads' => [[], ['_controller' => 'App\\Controller\\FileUploadController::uploads'], [], [['text', '/uploads']], [], []],
        'app_fileupload_processs3upload' => [[], ['_controller' => 'App\\Controller\\FileUploadController::processS3Upload'], [], [['text', '/processs3']], [], []],
        'app_fileupload_copyorc' => [[], ['_controller' => 'App\\Controller\\FileUploadController::copyORC'], [], [['text', '/copyorc']], [], []],
        'app_fileupload_copyparquet' => [[], ['_controller' => 'App\\Controller\\FileUploadController::copyParquet'], [], [['text', '/copypar']], [], []],
        'app_fileupload_delete' => [[], ['_controller' => 'App\\Controller\\FileUploadController::delete'], [], [['text', '/deletefile']], [], []],
        'app_fileupload_restore' => [[], ['_controller' => 'App\\Controller\\FileUploadController::restore'], [], [['text', '/restorefile']], [], []],
        'app_fileupload_copytosharedfolder' => [[], ['_controller' => 'App\\Controller\\FileUploadController::copyToSharedFolder'], [], [['text', '/copytosharedfolder']], [], []],
        'watcher' => [[], ['_controller' => 'App\\Controller\\FileWatcherController::watcher'], [], [['text', '/watcher']], [], []],
        'app_filewatcher_refresh' => [[], ['_controller' => 'App\\Controller\\FileWatcherController::refresh'], [], [['text', '/filewatcher/refresh']], [], []],
        'app_filewatcher_create' => [[], ['_controller' => 'App\\Controller\\FileWatcherController::create'], [], [['text', '/createfilewatcher']], [], []],
        'app_filewatcher_edit' => [[], ['_controller' => 'App\\Controller\\FileWatcherController::edit'], [], [['text', '/editfilewatcher']], [], []],
        'app_filewatcher_view' => [[], ['_controller' => 'App\\Controller\\FileWatcherController::view'], [], [['text', '/viewfilewatcher']], [], []],
        'app_filewatcher_delete' => [[], ['_controller' => 'App\\Controller\\FileWatcherController::delete'], [], [['text', '/deletefilewatcher']], [], []],
        'app_filewatcher_run' => [[], ['_controller' => 'App\\Controller\\FileWatcherController::run'], [], [['text', '/runfilewatcher']], [], []],
        'app_hadoopstatus_createhadoop' => [[], ['_controller' => 'App\\Controller\\HadoopStatusController::createHadoop'], [], [['text', '/createhadoop']], [], []],
        'hadoop' => [[], ['_controller' => 'App\\Controller\\HadoopStatusController::index'], [], [['text', '/hadoop']], [], []],
        'app_hadoopstatus_refresh' => [[], ['_controller' => 'App\\Controller\\HadoopStatusController::refresh'], [], [['text', '/hadoop/refresh']], [], []],
        'app_hadoopstatus_starthadoop' => [[], ['_controller' => 'App\\Controller\\HadoopStatusController::startHadoop'], [], [['text', '/starthadoop']], [], []],
        'app_hadoopstatus_stophadoop' => [[], ['_controller' => 'App\\Controller\\HadoopStatusController::stopHadoop'], [], [['text', '/stophadoop']], [], []],
        'app_mppstatus_creatempp' => [[], ['_controller' => 'App\\Controller\\MPPStatusController::creatempp'], [], [['text', '/creatempp']], [], []],
        'mpp' => [[], ['_controller' => 'App\\Controller\\MPPStatusController::index'], [], [['text', '/mpp']], [], []],
        'app_mppstatus_refresh' => [[], ['_controller' => 'App\\Controller\\MPPStatusController::refresh'], [], [['text', '/mpp/refresh']], [], []],
        'app_mppstatus_startmpp' => [[], ['_controller' => 'App\\Controller\\MPPStatusController::startmpp'], [], [['text', '/startmpp']], [], []],
        'app_mppstatus_stopmpp' => [[], ['_controller' => 'App\\Controller\\MPPStatusController::stopmpp'], [], [['text', '/stopmpp']], [], []],
        'nexusinitalize' => [[], ['_controller' => 'App\\Controller\\NexusController::initialize'], [], [['text', '/nexusinitalize']], [], []],
        'nexusanalysis' => [[], ['_controller' => 'App\\Controller\\NexusController::analysis'], [], [['text', '/nexusanalysis']], [], []],
        'dataprofile' => [[], ['_controller' => 'App\\Controller\\NexusController::dataprofile'], [], [['text', '/dataprofile']], [], []],
        'runanalysis' => [[], ['_controller' => 'App\\Controller\\NexusController::runanalysis'], [], [['text', '/runanalysis']], [], []],
        'rundataprofile' => [[], ['_controller' => 'App\\Controller\\NexusController::rundataprofile'], [], [['text', '/rundataprofile']], [], []],
        'nexusreport' => [[], ['_controller' => 'App\\Controller\\NexusController::report'], [], [['text', '/nexusreport']], [], []],
        'nexusmetadata' => [[], ['_controller' => 'App\\Controller\\NexusController::metadata'], [], [['text', '/nexusmetadata']], [], []],
        'app_nexus_view' => [[], ['_controller' => 'App\\Controller\\NexusController::view'], [], [['text', '/viewnexusmetadata']], [], []],
        'nexusfileupload' => [[], ['_controller' => 'App\\Controller\\NexusController::upload'], [], [['text', '/nexusfileupload']], [], []],
        'nexussetup' => [[], ['_controller' => 'App\\Controller\\NexusController::setup'], [], [['text', '/nexussetup']], [], []],
        'app_notification_notifications' => [[], ['_controller' => 'App\\Controller\\NotificationController::notifications'], [], [['text', '/notifications']], [], []],
        'app_notification_pushnotification' => [[], ['_controller' => 'App\\Controller\\NotificationController::pushNotification'], [], [['text', '/pushnotification']], [], []],
        'app_notification_markread' => [[], ['_controller' => 'App\\Controller\\NotificationController::markRead'], [], [['text', '/markread']], [], []],
        'projectassignment' => [[], ['_controller' => 'App\\Controller\\ProjectAssignmentController::projects'], [], [['text', '/projectassignment']], [], []],
        'app_projectassignment_refresh' => [[], ['_controller' => 'App\\Controller\\ProjectAssignmentController::refresh'], [], [['text', '/projectassignment/refresh']], [], []],
        'app_projectassignment_create' => [[], ['_controller' => 'App\\Controller\\ProjectAssignmentController::create'], [], [['text', '/createprojectassignment']], [], []],
        'app_projectassignment_edit' => [[], ['_controller' => 'App\\Controller\\ProjectAssignmentController::edit'], [], [['text', '/editprojectassignment']], [], []],
        'app_projectassignment_view' => [[], ['_controller' => 'App\\Controller\\ProjectAssignmentController::view'], [], [['text', '/viewprojectassignment']], [], []],
        'app_projectassignment_delete' => [[], ['_controller' => 'App\\Controller\\ProjectAssignmentController::delete'], [], [['text', '/deleteprojectassignment']], [], []],
        'project' => [[], ['_controller' => 'App\\Controller\\ProjectController::project'], [], [['text', '/project']], [], []],
        'app_project_new' => [[], ['_controller' => 'App\\Controller\\ProjectController::new'], [], [['text', '/newproject']], [], []],
        'app_project_refresh' => [[], ['_controller' => 'App\\Controller\\ProjectController::refresh'], [], [['text', '/project/refresh']], [], []],
        'app_project_create' => [[], ['_controller' => 'App\\Controller\\ProjectController::create'], [], [['text', '/createproject']], [], []],
        'app_project_edit' => [[], ['_controller' => 'App\\Controller\\ProjectController::edit'], [], [['text', '/editproject']], [], []],
        'app_project_view' => [[], ['_controller' => 'App\\Controller\\ProjectController::view'], [], [['text', '/viewproject']], [], []],
        'app_project_delete' => [[], ['_controller' => 'App\\Controller\\ProjectController::delete'], [], [['text', '/deleteproject']], [], []],
        'projectrate' => [[], ['_controller' => 'App\\Controller\\ProjectRateController::projectrate'], [], [['text', '/projectrate']], [], []],
        'app_projectrate_new' => [[], ['_controller' => 'App\\Controller\\ProjectRateController::new'], [], [['text', '/newprojectrate']], [], []],
        'app_projectrate_refresh' => [[], ['_controller' => 'App\\Controller\\ProjectRateController::refresh'], [], [['text', '/projectrate/refresh']], [], []],
        'app_projectrate_edit' => [[], ['_controller' => 'App\\Controller\\ProjectRateController::edit'], [], [['text', '/editprojectrate']], [], []],
        'app_projectrate_view' => [[], ['_controller' => 'App\\Controller\\ProjectRateController::view'], [], [['text', '/viewprojectrate']], [], []],
        'app_projectrate_create' => [[], ['_controller' => 'App\\Controller\\ProjectRateController::create'], [], [['text', '/createprojectrate']], [], []],
        'app_projectrate_delete' => [[], ['_controller' => 'App\\Controller\\ProjectRateController::delete'], [], [['text', '/deleteprojectrate']], [], []],
        'queries' => [[], ['_controller' => 'App\\Controller\\QueryController::queries'], [], [['text', '/queries']], [], []],
        'app_query_refresh' => [[], ['_controller' => 'App\\Controller\\QueryController::refresh'], [], [['text', '/queries/refresh']], [], []],
        'app_query_createquery' => [[], ['_controller' => 'App\\Controller\\QueryController::createQuery'], [], [['text', '/createquery']], [], []],
        'app_query_edit' => [[], ['_controller' => 'App\\Controller\\QueryController::edit'], [], [['text', '/editquery']], [], []],
        'app_query_view' => [[], ['_controller' => 'App\\Controller\\QueryController::view'], [], [['text', '/viewquery']], [], []],
        'app_query_delete' => [[], ['_controller' => 'App\\Controller\\QueryController::delete'], [], [['text', '/deletequery']], [], []],
        'app_query_run' => [[], ['_controller' => 'App\\Controller\\QueryController::run'], [], [['text', '/runquery']], [], []],
        'model' => [[], ['_controller' => 'App\\Controller\\SimulationController::simulator'], [], [['text', '/model']], [], []],
        'app_simulation_refresh' => [[], ['_controller' => 'App\\Controller\\SimulationController::refresh'], [], [['text', '/model/refresh']], [], []],
        'app_simulation_create' => [[], ['_controller' => 'App\\Controller\\SimulationController::create'], [], [['text', '/createmodel']], [], []],
        'app_simulation_edit' => [[], ['_controller' => 'App\\Controller\\SimulationController::edit'], [], [['text', '/editmodel']], [], []],
        'app_simulation_view' => [[], ['_controller' => 'App\\Controller\\SimulationController::view'], [], [['text', '/viewmodel']], [], []],
        'app_simulation_delete' => [[], ['_controller' => 'App\\Controller\\SimulationController::delete'], [], [['text', '/deletemodel']], [], []],
        'app_simulation_run' => [[], ['_controller' => 'App\\Controller\\SimulationController::run'], [], [['text', '/runmodel']], [], []],
        'app_sqs_sqs' => [[], ['_controller' => 'App\\Controller\\SqsController::sqs'], [], [['text', '/sqs']], [], []],
        'app_sqs_viewsqs' => [[], ['_controller' => 'App\\Controller\\SqsController::viewSQS'], [], [['text', '/sqslist']], [], []],
        'tables' => [[], ['_controller' => 'App\\Controller\\TableController::tables'], [], [['text', '/tables']], [], []],
        'app_table_refresh' => [[], ['_controller' => 'App\\Controller\\TableController::refresh'], [], [['text', '/tables/refresh']], [], []],
        'app_table_search' => [[], ['_controller' => 'App\\Controller\\TableController::search'], [], [['text', '/tables/searchforfiles']], [], []],
        'taskcategory' => [[], ['_controller' => 'App\\Controller\\TaskCategoryController::taskcategory'], [], [['text', '/taskcategory']], [], []],
        'app_taskcategory_new' => [[], ['_controller' => 'App\\Controller\\TaskCategoryController::new'], [], [['text', '/newtaskcategory']], [], []],
        'app_taskcategory_refresh' => [[], ['_controller' => 'App\\Controller\\TaskCategoryController::refresh'], [], [['text', '/taskcategory/refresh']], [], []],
        'app_taskcategory_edit' => [[], ['_controller' => 'App\\Controller\\TaskCategoryController::edit'], [], [['text', '/edittaskcategory']], [], []],
        'app_taskcategory_view' => [[], ['_controller' => 'App\\Controller\\TaskCategoryController::view'], [], [['text', '/viewtaskcategory']], [], []],
        'app_taskcategory_create' => [[], ['_controller' => 'App\\Controller\\TaskCategoryController::create'], [], [['text', '/createtaskcategory']], [], []],
        'app_taskcategory_delete' => [[], ['_controller' => 'App\\Controller\\TaskCategoryController::delete'], [], [['text', '/deletetaskcategory']], [], []],
        'task' => [[], ['_controller' => 'App\\Controller\\TaskController::task'], [], [['text', '/task']], [], []],
        'app_task_new' => [[], ['_controller' => 'App\\Controller\\TaskController::new'], [], [['text', '/newtask']], [], []],
        'app_task_refresh' => [[], ['_controller' => 'App\\Controller\\TaskController::refresh'], [], [['text', '/task/refresh']], [], []],
        'app_task_edit' => [[], ['_controller' => 'App\\Controller\\TaskController::edit'], [], [['text', '/edittask']], [], []],
        'app_task_blank' => [[], ['_controller' => 'App\\Controller\\TaskController::blank'], [], [['text', '/blanktask']], [], []],
        'app_task_view' => [[], ['_controller' => 'App\\Controller\\TaskController::view'], [], [['text', '/viewtask']], [], []],
        'app_task_create' => [[], ['_controller' => 'App\\Controller\\TaskController::create'], [], [['text', '/createtask']], [], []],
        'app_task_delete' => [[], ['_controller' => 'App\\Controller\\TaskController::delete'], [], [['text', '/deletetask']], [], []],
        'taskqueue' => [[], ['_controller' => 'App\\Controller\\TaskQueueController::taskqueue'], [], [['text', '/taskqueue']], [], []],
        'app_taskqueue_new' => [[], ['_controller' => 'App\\Controller\\TaskQueueController::new'], [], [['text', '/newtaskqueue']], [], []],
        'app_taskqueue_refresh' => [[], ['_controller' => 'App\\Controller\\TaskQueueController::refresh'], [], [['text', '/taskqueue/refresh']], [], []],
        'app_taskqueue_edit' => [[], ['_controller' => 'App\\Controller\\TaskQueueController::edit'], [], [['text', '/edittaskqueue']], [], []],
        'app_taskqueue_view' => [[], ['_controller' => 'App\\Controller\\TaskQueueController::view'], [], [['text', '/viewtaskqueue']], [], []],
        'app_taskqueue_create' => [[], ['_controller' => 'App\\Controller\\TaskQueueController::create'], [], [['text', '/createtaskqueue']], [], []],
        'app_taskqueue_delete' => [[], ['_controller' => 'App\\Controller\\TaskQueueController::delete'], [], [['text', '/deletetaskqueue']], [], []],
        'tasktemplate' => [[], ['_controller' => 'App\\Controller\\TaskTemplateController::tasktemplate'], [], [['text', '/tasktemplate']], [], []],
        'app_tasktemplate_new' => [[], ['_controller' => 'App\\Controller\\TaskTemplateController::new'], [], [['text', '/newtasktemplate']], [], []],
        'app_tasktemplate_refresh' => [[], ['_controller' => 'App\\Controller\\TaskTemplateController::refresh'], [], [['text', '/tasktemplate/refresh']], [], []],
        'app_tasktemplate_edit' => [[], ['_controller' => 'App\\Controller\\TaskTemplateController::edit'], [], [['text', '/edittasktemplate']], [], []],
        'app_tasktemplate_view' => [[], ['_controller' => 'App\\Controller\\TaskTemplateController::view'], [], [['text', '/viewtasktemplate']], [], []],
        'app_tasktemplate_create' => [[], ['_controller' => 'App\\Controller\\TaskTemplateController::create'], [], [['text', '/createtasktemplate']], [], []],
        'app_tasktemplate_delete' => [[], ['_controller' => 'App\\Controller\\TaskTemplateController::delete'], [], [['text', '/deletetasktemplate']], [], []],
        'app_template_createtemplate' => [[], ['_controller' => 'App\\Controller\\TemplateController::createTemplate'], [], [['text', '/createtemplate']], [], []],
        'templates' => [[], ['_controller' => 'App\\Controller\\TemplateController::index'], [], [['text', '/templates']], [], []],
        'app_template_wizard' => [[], ['_controller' => 'App\\Controller\\TemplateController::wizard'], [], [['text', '/wizard']], [], []],
        'app_template_refresh' => [[], ['_controller' => 'App\\Controller\\TemplateController::refresh'], [], [['text', '/templates/refresh']], [], []],
        'app_template_edit' => [[], ['_controller' => 'App\\Controller\\TemplateController::edit'], [], [['text', '/edittemplate']], [], []],
        'app_template_blank' => [[], ['_controller' => 'App\\Controller\\TemplateController::blank'], [], [['text', '/blanktemplate']], [], []],
        'app_template_activate' => [[], ['_controller' => 'App\\Controller\\TemplateController::activate'], [], [['text', '/activatetemplate']], [], []],
        'app_template_deactivate' => [[], ['_controller' => 'App\\Controller\\TemplateController::deactivate'], [], [['text', '/deactivatetemplate']], [], []],
        'app_template_sync' => [[], ['_controller' => 'App\\Controller\\TemplateController::sync'], [], [['text', '/synctemplate']], [], []],
        'app_template_delete' => [[], ['_controller' => 'App\\Controller\\TemplateController::delete'], [], [['text', '/deletetemplate']], [], []],
        'app_template_samplerow' => [[], ['_controller' => 'App\\Controller\\TemplateController::samplerow'], [], [['text', '/getsamplerow']], [], []],
        'timesheet' => [[], ['_controller' => 'App\\Controller\\TimesheetController::timesheet'], [], [['text', '/timesheet']], [], []],
        'app_timesheet_new' => [[], ['_controller' => 'App\\Controller\\TimesheetController::new'], [], [['text', '/newtimesheet']], [], []],
        'app_timesheet_refresh' => [[], ['_controller' => 'App\\Controller\\TimesheetController::refresh'], [], [['text', '/timesheet/refresh']], [], []],
        'app_timesheet_edit' => [[], ['_controller' => 'App\\Controller\\TimesheetController::edit'], [], [['text', '/edittimesheet']], [], []],
        'app_timesheet_view' => [[], ['_controller' => 'App\\Controller\\TimesheetController::view'], [], [['text', '/viewtimesheet']], [], []],
        'app_timesheet_create' => [[], ['_controller' => 'App\\Controller\\TimesheetController::create'], [], [['text', '/createtimesheet']], [], []],
        'app_timesheet_delete' => [[], ['_controller' => 'App\\Controller\\TimesheetController::delete'], [], [['text', '/deletetimesheet']], [], []],
        'users' => [[], ['_controller' => 'App\\Controller\\User\\AppUserController::users'], [], [['text', '/users']], [], []],
        'app_user_appuser_create' => [[], ['_controller' => 'App\\Controller\\User\\AppUserController::create'], [], [['text', '/createuser']], [], []],
        'app_user_appuser_edit' => [[], ['_controller' => 'App\\Controller\\User\\AppUserController::edit'], [], [['text', '/edituser']], [], []],
        'app_user_appuser_blankuser' => [[], ['_controller' => 'App\\Controller\\User\\AppUserController::blankuser'], [], [['text', '/blankuser']], [], []],
        'app_user_appuser_delete' => [[], ['_controller' => 'App\\Controller\\User\\AppUserController::delete'], [], [['text', '/deleteuser']], [], []],
        'app_user_appuser_changepassword' => [[], ['_controller' => 'App\\Controller\\User\\AppUserController::changePassword'], [], [['text', '/changepassword']], [], []],
        'forgot_password' => [[], ['_controller' => 'App\\Controller\\User\\AppUserController::forgotpassword'], [], [['text', '/forgot_password']], [], []],
        'forgot-password' => [[], ['_controller' => 'App\\Controller\\User\\AppUserController::processForgotPassword'], [], [['text', '/forgot-password']], [], []],
        'reset_password' => [['token'], ['_controller' => 'App\\Controller\\User\\AppUserController::processResetPassword'], [], [['variable', '/', '[^/]++', 'token'], ['text', '/reset-password']], [], []],
        'login' => [[], ['_controller' => 'App\\Controller\\User\\LoginController'], [], [['text', '/login']], [], []],
        'profile' => [[], ['_controller' => 'App\\Controller\\User\\ProfileController::profile'], [], [['text', '/profile']], [], []],
        'logout' => [[], [], [], [['text', '/logout']], [], []],
        'liip_monitor_health_interface' => [[], ['_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::indexAction'], [], [['text', '/monitor/health/']], [], []],
        'liip_monitor_list_checks' => [[], ['_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::listAction'], [], [['text', '/monitor/health/checks']], [], []],
        'liip_monitor_list_all_checks' => [[], ['_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::listAllAction'], [], [['text', '/monitor/health/all_checks']], [], []],
        'liip_monitor_list_groups' => [[], ['_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::listGroupsAction'], [], [['text', '/monitor/health/groups']], [], []],
        'liip_monitor_run_all_checks_http_status' => [[], ['_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::runAllChecksHttpStatusAction'], [], [['text', '/monitor/health/http_status_checks']], [], []],
        'liip_monitor_run_single_check_http_status' => [['checkId'], ['_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::runSingleCheckHttpStatusAction'], [], [['variable', '/', '[^/]++', 'checkId'], ['text', '/monitor/health/http_status_check']], [], []],
        'liip_monitor_run_all_checks' => [[], ['_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::runAllChecksAction'], [], [['text', '/monitor/health/run']], [], []],
        'liip_monitor_run_single_check' => [['checkId'], ['_controller' => 'Liip\\MonitorBundle\\Controller\\HealthCheckController::runSingleCheckAction'], [], [['variable', '/', '[^/]++', 'checkId'], ['text', '/monitor/health/run']], [], []],
    ];
        }
    }

    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && (self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name && null !== $name) {
            unset($parameters['_locale']);
            $name .= '.'.$locale;
        } elseif (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
