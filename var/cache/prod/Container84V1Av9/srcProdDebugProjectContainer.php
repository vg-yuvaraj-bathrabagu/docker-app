<?php

namespace Container84V1Av9;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class srcProdDebugProjectContainer extends Container
{
    private $buildParameters;
    private $containerDir;
    private $parameters;
    private $targetDirs = [];

    /**
     * @internal but protected for BC on cache:clear
     */
    protected $privates = [];

    public function __construct(array $buildParameters = [], $containerDir = __DIR__)
    {
        $dir = $this->targetDirs[0] = \dirname($containerDir);
        for ($i = 1; $i <= 4; ++$i) {
            $this->targetDirs[$i] = $dir = \dirname($dir);
        }
        $this->buildParameters = $buildParameters;
        $this->containerDir = $containerDir;
        $this->parameters = $this->getDefaultParameters();

        $this->services = $this->privates = [];
        $this->syntheticIds = [
            'kernel' => true,
        ];
        $this->methodMap = [
            'doctrine' => 'getDoctrineService',
            'doctrine.dbal.default_connection' => 'getDoctrine_Dbal_DefaultConnectionService',
            'doctrine.orm.default_entity_manager' => 'getDoctrine_Orm_DefaultEntityManagerService',
            'event_dispatcher' => 'getEventDispatcherService',
            'http_kernel' => 'getHttpKernelService',
            'request_stack' => 'getRequestStackService',
            'router' => 'getRouterService',
            'security.authorization_checker' => 'getSecurity_AuthorizationCheckerService',
            'security.token_storage' => 'getSecurity_TokenStorageService',
            'translator' => 'getTranslatorService',
            'twig' => 'getTwigService',
        ];
        $this->fileMap = [
            'App\\Controller\\AccountController' => 'getAccountControllerService.php',
            'App\\Controller\\AppConfigurationController' => 'getAppConfigurationControllerService.php',
            'App\\Controller\\BaseController' => 'getBaseControllerService.php',
            'App\\Controller\\ConversionController' => 'getConversionControllerService.php',
            'App\\Controller\\DefaultController' => 'getDefaultControllerService.php',
            'App\\Controller\\FileUploadController' => 'getFileUploadControllerService.php',
            'App\\Controller\\FileWatcherController' => 'getFileWatcherControllerService.php',
            'App\\Controller\\HadoopStatusController' => 'getHadoopStatusControllerService.php',
            'App\\Controller\\MPPStatusController' => 'getMPPStatusControllerService.php',
            'App\\Controller\\NexusController' => 'getNexusControllerService.php',
            'App\\Controller\\NotificationController' => 'getNotificationControllerService.php',
            'App\\Controller\\ProjectAssignmentController' => 'getProjectAssignmentControllerService.php',
            'App\\Controller\\ProjectController' => 'getProjectControllerService.php',
            'App\\Controller\\ProjectRateController' => 'getProjectRateControllerService.php',
            'App\\Controller\\QueryController' => 'getQueryControllerService.php',
            'App\\Controller\\SimulationController' => 'getSimulationControllerService.php',
            'App\\Controller\\SqsController' => 'getSqsControllerService.php',
            'App\\Controller\\TableController' => 'getTableControllerService.php',
            'App\\Controller\\TaskCategoryController' => 'getTaskCategoryControllerService.php',
            'App\\Controller\\TaskController' => 'getTaskControllerService.php',
            'App\\Controller\\TaskQueueController' => 'getTaskQueueControllerService.php',
            'App\\Controller\\TaskTemplateController' => 'getTaskTemplateControllerService.php',
            'App\\Controller\\TemplateController' => 'getTemplateControllerService.php',
            'App\\Controller\\TimesheetController' => 'getTimesheetControllerService.php',
            'App\\Controller\\User\\AppUserController' => 'getAppUserControllerService.php',
            'App\\Controller\\User\\ForgotPasswordController' => 'getForgotPasswordControllerService.php',
            'App\\Controller\\User\\LoginController' => 'getLoginControllerService.php',
            'App\\Controller\\User\\ProfileController' => 'getProfileControllerService.php',
            'App\\Controller\\User\\ResetPasswordController' => 'getResetPasswordControllerService.php',
            'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController' => 'getRedirectControllerService.php',
            'Symfony\\Bundle\\FrameworkBundle\\Controller\\TemplateController' => 'getTemplateController2Service.php',
            'cache.app' => 'getCache_AppService.php',
            'cache.app_clearer' => 'getCache_AppClearerService.php',
            'cache.global_clearer' => 'getCache_GlobalClearerService.php',
            'cache.system' => 'getCache_SystemService.php',
            'cache.system_clearer' => 'getCache_SystemClearerService.php',
            'cache_clearer' => 'getCacheClearerService.php',
            'cache_warmer' => 'getCacheWarmerService.php',
            'console.command.public_alias.doctrine_cache.contains_command' => 'getConsole_Command_PublicAlias_DoctrineCache_ContainsCommandService.php',
            'console.command.public_alias.doctrine_cache.delete_command' => 'getConsole_Command_PublicAlias_DoctrineCache_DeleteCommandService.php',
            'console.command.public_alias.doctrine_cache.flush_command' => 'getConsole_Command_PublicAlias_DoctrineCache_FlushCommandService.php',
            'console.command.public_alias.doctrine_cache.stats_command' => 'getConsole_Command_PublicAlias_DoctrineCache_StatsCommandService.php',
            'console.command_loader' => 'getConsole_CommandLoaderService.php',
            'filesystem' => 'getFilesystemService.php',
            'form.factory' => 'getForm_FactoryService.php',
            'liip_monitor.check.php_extensions.default' => 'getLiipMonitor_Check_PhpExtensions_DefaultService.php',
            'liip_monitor.health_check.command' => 'getLiipMonitor_HealthCheck_CommandService.php',
            'liip_monitor.health_controller' => 'getLiipMonitor_HealthControllerService.php',
            'liip_monitor.helper' => 'getLiipMonitor_HelperService.php',
            'liip_monitor.helper.console_reporter' => 'getLiipMonitor_Helper_ConsoleReporterService.php',
            'liip_monitor.helper.raw_console_reporter' => 'getLiipMonitor_Helper_RawConsoleReporterService.php',
            'liip_monitor.helper.runner_manager' => 'getLiipMonitor_Helper_RunnerManagerService.php',
            'liip_monitor.list_checks.command' => 'getLiipMonitor_ListChecks_CommandService.php',
            'liip_monitor.runner_default' => 'getLiipMonitor_RunnerDefaultService.php',
            'message_bus' => 'getMessageBusService.php',
            'routing.loader' => 'getRouting_LoaderService.php',
            'security.authentication_utils' => 'getSecurity_AuthenticationUtilsService.php',
            'security.csrf.token_manager' => 'getSecurity_Csrf_TokenManagerService.php',
            'security.password_encoder' => 'getSecurity_PasswordEncoderService.php',
            'services_resetter' => 'getServicesResetterService.php',
            'session' => 'getSessionService.php',
            'twig.controller.exception' => 'getTwig_Controller_ExceptionService.php',
            'twig.controller.preview_error' => 'getTwig_Controller_PreviewErrorService.php',
            'validator' => 'getValidatorService.php',
        ];
        $this->aliases = [
            'Liip\\MonitorBundle\\Controller\\HealthCheckController' => 'liip_monitor.health_controller',
            'database_connection' => 'doctrine.dbal.default_connection',
            'doctrine.orm.entity_manager' => 'doctrine.orm.default_entity_manager',
            'liip_monitor.runner' => 'liip_monitor.runner_default',
        ];

        $this->privates['service_container'] = function () {
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/DomainIdentityMappingInterface.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/Infra/Doctrine/DomainIdentityMapping.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/DomainIdentityHelper.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/Factory/DomainObjectFactoryInterface.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/Factory/ClassMappingObjectFactory.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/Factory/DomainObjectFactory.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/Factory/EntityAwareFactoryInterface.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/Infra/Doctrine/EntityAwareFactory.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/Factory/EntityAwareFactory.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Handler/HandlerInterface.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/ResettableInterface.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Handler/AbstractHandler.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Handler/AbstractProcessingHandler.php';
            include_once $this->targetDirs[3].'/vendor/maxbanton/cwh/src/Handler/CloudWatch.php';
            include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/AwsClientInterface.php';
            include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/AwsClientTrait.php';
            include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/AwsClient.php';
            include_once $this->targetDirs[3].'/vendor/aws/aws-sdk-php/src/CloudWatchLogs/CloudWatchLogsClient.php';
            include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Controller/ControllerNameParser.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/ControllerMetadata/ArgumentMetadataFactoryInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/ControllerMetadata/ArgumentMetadataFactory.php';
            include_once $this->targetDirs[3].'/vendor/symfony/event-dispatcher/EventSubscriberInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/EventListener/ResponseListener.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/EventListener/StreamedResponseListener.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/EventListener/LocaleListener.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/EventListener/ValidateRequestListener.php';
            include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/EventListener/ResolveControllerNameSubscriber.php';
            include_once $this->targetDirs[3].'/vendor/symfony/event-dispatcher-contracts/EventDispatcherInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/event-dispatcher/EventDispatcherInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/event-dispatcher/EventDispatcher.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/HttpKernelInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/TerminableInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/HttpKernel.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Controller/ControllerResolverInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Controller/ControllerResolver.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Controller/ContainerControllerResolver.php';
            include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Controller/ControllerResolver.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Controller/ArgumentResolverInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Controller/ArgumentResolver.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-foundation/RequestStack.php';
            include_once $this->targetDirs[3].'/vendor/symfony/config/ConfigCacheFactoryInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/config/ResourceCheckerConfigCacheFactory.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/EventListener/AbstractSessionListener.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/EventListener/SessionListener.php';
            include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ServiceLocator.php';
            include_once $this->targetDirs[3].'/vendor/symfony/asset/Packages.php';
            include_once $this->targetDirs[3].'/vendor/symfony/asset/PackageInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/asset/Package.php';
            include_once $this->targetDirs[3].'/vendor/symfony/asset/PathPackage.php';
            include_once $this->targetDirs[3].'/vendor/symfony/asset/VersionStrategy/VersionStrategyInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/asset/VersionStrategy/EmptyVersionStrategy.php';
            include_once $this->targetDirs[3].'/vendor/symfony/asset/Context/ContextInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/asset/Context/RequestStackContext.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/EventListener/TranslatorListener.php';
            include_once $this->targetDirs[3].'/vendor/psr/cache/src/CacheItemPoolInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/cache/Adapter/AdapterInterface.php';
            include_once $this->targetDirs[3].'/vendor/psr/log/Psr/Log/LoggerAwareInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/cache/ResettableInterface.php';
            include_once $this->targetDirs[3].'/vendor/psr/log/Psr/Log/LoggerAwareTrait.php';
            include_once $this->targetDirs[3].'/vendor/symfony/cache/Traits/AbstractTrait.php';
            include_once $this->targetDirs[3].'/vendor/symfony/cache/Adapter/AbstractAdapter.php';
            include_once $this->targetDirs[3].'/vendor/symfony/cache/PruneableInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/cache/Traits/FilesystemCommonTrait.php';
            include_once $this->targetDirs[3].'/vendor/symfony/cache/Traits/FilesystemTrait.php';
            include_once $this->targetDirs[3].'/vendor/symfony/cache/Adapter/FilesystemAdapter.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/EventListener/DebugHandlersListener.php';
            include_once $this->targetDirs[3].'/vendor/psr/log/Psr/Log/LoggerInterface.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Logger.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Log/DebugLoggerInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/monolog-bridge/Logger.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Debug/FileLinkFormatter.php';
            include_once $this->targetDirs[3].'/vendor/symfony/routing/RequestContext.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/EventListener/RouterListener.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/annotations/lib/Doctrine/Common/Annotations/Reader.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/annotations/lib/Doctrine/Common/Annotations/AnnotationReader.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/annotations/lib/Doctrine/Common/Annotations/AnnotationRegistry.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Environment.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Loader/LoaderInterface.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Loader/ExistsLoaderInterface.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Loader/SourceContextLoaderInterface.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Loader/FilesystemLoader.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Extension/ExtensionInterface.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Extension/AbstractExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/CsrfExtension.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Extension/ProfilerExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/ProfilerExtension.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Profiler/Profile.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/TranslationExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/AssetExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/CodeExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/RoutingExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/YamlExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/HttpKernelExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/HttpFoundationExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/FormExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/LogoutUrlExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/Extension/SecurityExtension.php';
            include_once $this->targetDirs[3].'/vendor/twig/extensions/lib/Twig/Extensions/Extension/Text.php';
            include_once $this->targetDirs[3].'/src/Twig/OncloudTimeTwigExtension.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/Extension/DebugExtension.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Twig/DoctrineExtension.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bridge/AppVariable.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/RuntimeLoader/RuntimeLoaderInterface.php';
            include_once $this->targetDirs[3].'/vendor/twig/twig/src/RuntimeLoader/ContainerRuntimeLoader.php';
            include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ServiceSubscriberInterface.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/user-bundle/Twig/GlobalVariable.php';
            include_once $this->targetDirs[3].'/vendor/symfony/twig-bundle/DependencyInjection/Configurator/EnvironmentConfigurator.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/EventListener/ControllerListener.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/EventListener/ParamConverterListener.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/Request/ParamConverter/ParamConverterManager.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/Request/ParamConverter/ParamConverterInterface.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/Request/ParamConverter/DoctrineParamConverter.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/Request/ParamConverter/DateTimeParamConverter.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/user/Infra/Security/TokenStorageAwareTrait.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/user/Infra/Security/UserParamConverter.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/EventListener/TemplateListener.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/Templating/TemplateGuesser.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/EventListener/HttpCacheListener.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/EventListener/SecurityListener.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/EventListener/IsGrantedListener.php';
            include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/Request/ArgumentNameConverter.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/Persistence/ConnectionRegistry.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/Persistence/ManagerRegistry.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/Persistence/AbstractManagerRegistry.php';
            include_once $this->targetDirs[3].'/vendor/symfony/doctrine-bridge/ManagerRegistry.php';
            include_once $this->targetDirs[3].'/vendor/symfony/doctrine-bridge/RegistryInterface.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Registry.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Driver/Connection.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Connection.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Configuration.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Logging/SQLLogger.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Logging/LoggerChain.php';
            include_once $this->targetDirs[3].'/vendor/symfony/doctrine-bridge/Logger/DbalLogger.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Logging/DebugStack.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/EventManager.php';
            include_once $this->targetDirs[3].'/vendor/symfony/doctrine-bridge/ContainerAwareEventManager.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/EventSubscriber.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Tools/ResolveTargetEntityListener.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/Infra/Doctrine/Event/ObjectFieldMappingListener.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Tools/AttachEntityListenersListener.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/ConnectionFactory.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Configuration.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/Cache.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/FlushableCache.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/ClearableCache.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiGetCache.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiDeleteCache.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiPutCache.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiOperationCache.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/CacheProvider.php';
            include_once $this->targetDirs[3].'/vendor/symfony/cache/DoctrineProvider.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/Persistence/Mapping/Driver/MappingDriver.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/Persistence/Mapping/Driver/MappingDriverChain.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/Persistence/Mapping/Driver/FileDriver.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/XmlDriver.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/SimplifiedXmlDriver.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/Persistence/Mapping/Driver/AnnotationDriver.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/AnnotationDriver.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/NamingStrategy.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/UnderscoreNamingStrategy.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/QuoteStrategy.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/DefaultQuoteStrategy.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/EntityListenerResolver.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Mapping/EntityListenerServiceResolver.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Mapping/ContainerEntityListenerResolver.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/Repository/RepositoryFactory.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Repository/ContainerRepositoryFactory.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/common/lib/Doctrine/Common/Persistence/ObjectManager.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManagerInterface.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManager.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/ManagerConfigurator.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/user/Repository/UserRepositoryInterface.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/domain/Infra/Doctrine/DomainEntityRepositoryTrait.php';
            include_once $this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Repository/UserRepository.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authorization/AuthorizationCheckerInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authorization/AuthorizationChecker.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authentication/Token/Storage/TokenStorageInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/contracts/Service/ResetInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authentication/Token/Storage/TokenStorage.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authentication/AuthenticationManagerInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authentication/AuthenticationProviderManager.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authentication/AuthenticationTrustResolverInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authentication/AuthenticationTrustResolver.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Role/RoleHierarchyInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Role/RoleHierarchy.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Http/Logout/LogoutUrlGenerator.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Http/RememberMe/ResponseListener.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authorization/AccessDecisionManagerInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authorization/TraceableAccessDecisionManager.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authorization/AccessDecisionManager.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Http/Firewall.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security-bundle/EventListener/FirewallListener.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security-bundle/Debug/TraceableFirewallListener.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security/Http/FirewallMapInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/security-bundle/Security/FirewallMap.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Handler/StreamHandler.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Processor/ProcessorInterface.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Processor/PsrLogMessageProcessor.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Handler/FingersCrossedHandler.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Handler/FingersCrossed/ActivationStrategyInterface.php';
            include_once $this->targetDirs[3].'/vendor/monolog/monolog/src/Monolog/Handler/FingersCrossed/ErrorLevelActivationStrategy.php';
            include_once $this->targetDirs[3].'/vendor/symfony/monolog-bridge/Handler/FingersCrossed/NotFoundActivationStrategy.php';
            include_once $this->targetDirs[3].'/vendor/symfony/monolog-bridge/Handler/ConsoleHandler.php';
            include_once $this->targetDirs[3].'/vendor/symfony/translation/TranslatorInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/translation/TranslatorBagInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/translation/Translator.php';
            include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/CacheWarmer/WarmableInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Translation/Translator.php';
            include_once $this->targetDirs[3].'/vendor/symfony/translation/Formatter/MessageFormatterInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/translation/Formatter/ChoiceMessageFormatterInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/translation/Formatter/MessageFormatter.php';
            include_once $this->targetDirs[3].'/vendor/symfony/translation/MessageSelector.php';
            include_once $this->targetDirs[3].'/vendor/symfony/routing/RequestContextAwareInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/routing/Matcher/UrlMatcherInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/routing/Generator/UrlGeneratorInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/routing/RouterInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/routing/Matcher/RequestMatcherInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/routing/Router.php';
            include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Routing/Router.php';
            include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ParameterBag/ParameterBagInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ParameterBag/ParameterBag.php';
            include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ParameterBag/FrozenParameterBag.php';
            include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ParameterBag/ContainerBagInterface.php';
            include_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ParameterBag/ContainerBag.php';
            include_once $this->targetDirs[3].'/vendor/doctrine/annotations/lib/Doctrine/Common/Annotations/CachedReader.php';
        };
    }

    public function reset()
    {
        $this->privates = [];
        parent::reset();
    }

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function getRemovedIds()
    {
        return require $this->containerDir.\DIRECTORY_SEPARATOR.'removed-ids.php';
    }

    protected function load($file, $lazyLoad = true)
    {
        return require $this->containerDir.\DIRECTORY_SEPARATOR.$file;
    }

    /**
     * Gets the public 'doctrine' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected function getDoctrineService()
    {
        return $this->services['doctrine'] = new \Doctrine\Bundle\DoctrineBundle\Registry($this, $this->parameters['doctrine.connections'], $this->parameters['doctrine.entity_managers'], 'default', 'default');
    }

    /**
     * Gets the public 'doctrine.dbal.default_connection' shared service.
     *
     * @return \Doctrine\DBAL\Connection
     */
    protected function getDoctrine_Dbal_DefaultConnectionService()
    {
        $a = new \Doctrine\DBAL\Configuration();

        $b = new \Doctrine\DBAL\Logging\LoggerChain();

        $c = new \Symfony\Bridge\Monolog\Logger('doctrine');
        $c->pushHandler(($this->privates['cloudwatch_handler'] ?? $this->getCloudwatchHandlerService()));
        $c->pushHandler(($this->privates['monolog.handler.container_logs'] ?? $this->getMonolog_Handler_ContainerLogsService()));
        $c->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        $b->addLogger(new \Symfony\Bridge\Doctrine\Logger\DbalLogger($c, NULL));
        $b->addLogger(new \Doctrine\DBAL\Logging\DebugStack());

        $a->setSQLLogger($b);
        $d = new \Symfony\Bridge\Doctrine\ContainerAwareEventManager($this);

        $e = new \Doctrine\ORM\Tools\ResolveTargetEntityListener();
        $e->addResolveTargetEntity('MsgPhp\\User\\Entity\\Role', 'App\\Entity\\User\\Role', []);
        $e->addResolveTargetEntity('MsgPhp\\User\\Entity\\UserRole', 'App\\Entity\\User\\UserRole', []);
        $e->addResolveTargetEntity('MsgPhp\\User\\Entity\\User', 'App\\Entity\\User\\AppUser', []);
        $e->addResolveTargetEntity('MsgPhp\\User\\UserIdInterface', 'MsgPhp\\User\\UserId', []);
        $e->addResolveTargetEntity('MsgPhp\\User\\CredentialInterface', 'MsgPhp\\User\\Entity\\Credential\\EmailPassword', []);

        $d->addEventSubscriber($e);
        $d->addEventListener([0 => 'loadClassMetadata'], new \MsgPhp\Domain\Infra\Doctrine\Event\ObjectFieldMappingListener(['MsgPhp\\Domain\\Entity\\Features\\CanBeConfirmed' => ['confirmationToken' => ['type' => 'string', 'unique' => true, 'nullable' => true], 'confirmedAt' => ['type' => 'datetime', 'nullable' => true]], 'MsgPhp\\Domain\\Entity\\Fields\\CreatedAtField' => ['createdAt' => ['type' => 'datetime']], 'MsgPhp\\Domain\\Entity\\Fields\\EnabledField' => ['enabled' => ['type' => 'boolean']], 'MsgPhp\\Domain\\Entity\\Fields\\LastUpdatedAtField' => ['lastUpdatedAt' => ['type' => 'datetime']], 'MsgPhp\\User\\Entity\\Features\\EmailCredential' => ['credential' => ['type' => 'embedded', 'class' => 'MsgPhp\\User\\Entity\\Credential\\Email', 'columnPrefix' => NULL]], 'MsgPhp\\User\\Entity\\Features\\EmailPasswordCredential' => ['credential' => ['type' => 'embedded', 'class' => 'MsgPhp\\User\\Entity\\Credential\\EmailPassword', 'columnPrefix' => NULL]], 'MsgPhp\\User\\Entity\\Features\\EmailSaltedPasswordCredential' => ['credential' => ['type' => 'embedded', 'class' => 'MsgPhp\\User\\Entity\\Credential\\EmailSaltedPassword', 'columnPrefix' => NULL]], 'MsgPhp\\User\\Entity\\Features\\NicknameCredential' => ['credential' => ['type' => 'embedded', 'class' => 'MsgPhp\\User\\Entity\\Credential\\Nickname', 'columnPrefix' => NULL]], 'MsgPhp\\User\\Entity\\Features\\NicknamePasswordCredential' => ['credential' => ['type' => 'embedded', 'class' => 'MsgPhp\\User\\Entity\\Credential\\NicknamePassword', 'columnPrefix' => NULL]], 'MsgPhp\\User\\Entity\\Features\\NicknameSaltedPasswordCredential' => ['credential' => ['type' => 'embedded', 'class' => 'MsgPhp\\User\\Entity\\Credential\\NicknameSaltedPassword', 'columnPrefix' => NULL]], 'MsgPhp\\User\\Entity\\Features\\TokenCredential' => ['credential' => ['type' => 'embedded', 'class' => 'MsgPhp\\User\\Entity\\Credential\\Token', 'columnPrefix' => NULL]], 'MsgPhp\\User\\Entity\\Features\\ResettablePassword' => ['passwordResetToken' => ['type' => 'string', 'unique' => true, 'nullable' => true], 'passwordRequestedAt' => ['type' => 'datetime', 'nullable' => true]], 'MsgPhp\\User\\Entity\\Fields\\AttributeValuesField' => ['attributeValues' => ['type' => 'oneToMany', 'targetEntity' => 'MsgPhp\\User\\Entity\\UserAttributeValue', 'mappedBy' => 'user']], 'MsgPhp\\User\\Entity\\Fields\\EmailsField' => ['emails' => ['type' => 'oneToMany', 'targetEntity' => 'MsgPhp\\User\\Entity\\UserEmail', 'mappedBy' => 'user', 'indexBy' => 'email']], 'MsgPhp\\User\\Entity\\Fields\\RoleField' => ['role' => ['type' => 'manyToOne', 'targetEntity' => 'App\\Entity\\User\\Role', 'joinColumns' => [0 => ['referencedColumnName' => 'name', 'nullable' => false]]]], 'MsgPhp\\User\\Entity\\Fields\\RolesField' => ['roles' => ['type' => 'oneToMany', 'targetEntity' => 'App\\Entity\\User\\UserRole', 'mappedBy' => 'user']], 'MsgPhp\\User\\Entity\\Fields\\UserField' => ['user' => ['type' => 'manyToOne', 'targetEntity' => 'App\\Entity\\User\\AppUser', 'joinColumns' => [0 => ['nullable' => false]]]]]));
        $d->addEventListener([0 => 'loadClassMetadata'], new \Doctrine\ORM\Tools\AttachEntityListenersListener());

        return $this->services['doctrine.dbal.default_connection'] = (new \Doctrine\Bundle\DoctrineBundle\ConnectionFactory($this->parameters['doctrine.dbal.connection_factory.types']))->createConnection(['charset' => 'utf8', 'url' => 'mysql://root:mysql@localhost:3306/oncloudtime', 'driver' => 'pdo_mysql', 'host' => 'localhost', 'port' => NULL, 'user' => 'root', 'password' => NULL, 'driverOptions' => [], 'serverVersion' => '5.6', 'defaultTableOptions' => ['charset' => 'utf8', 'collate' => 'utf8_unicode_ci']], $a, $d, ['enum' => 'string']);
    }

    /**
     * Gets the public 'doctrine.orm.default_entity_manager' shared service.
     *
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getDoctrine_Orm_DefaultEntityManagerService($lazyLoad = true)
    {
        $this->services['doctrine.orm.default_entity_manager'] = $instance = \Doctrine\ORM\EntityManager::create(($this->services['doctrine.dbal.default_connection'] ?? $this->getDoctrine_Dbal_DefaultConnectionService()), ($this->privates['doctrine.orm.default_configuration'] ?? $this->getDoctrine_Orm_DefaultConfigurationService()));

        (new \Doctrine\Bundle\DoctrineBundle\ManagerConfigurator([], []))->configure($instance);

        return $instance;
    }

    /**
     * Gets the public 'event_dispatcher' shared service.
     *
     * @return \Symfony\Component\EventDispatcher\EventDispatcher
     */
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\EventDispatcher();

        $instance->addListener('console.command', [0 => function () {
            return ($this->privates['MsgPhp\\Domain\\Infra\\Console\\MessageReceiver'] ?? ($this->privates['MsgPhp\\Domain\\Infra\\Console\\MessageReceiver'] = new \MsgPhp\Domain\Infra\Console\MessageReceiver()));
        }, 1 => 'onCommand'], 0);
        $instance->addListener('console.terminate', [0 => function () {
            return ($this->privates['MsgPhp\\Domain\\Infra\\Console\\MessageReceiver'] ?? ($this->privates['MsgPhp\\Domain\\Infra\\Console\\MessageReceiver'] = new \MsgPhp\Domain\Infra\Console\MessageReceiver()));
        }, 1 => 'onTerminate'], 0);
        $instance->addListener('security.interactive_login', [0 => function () {
            return ($this->privates['App\\EventListener\\LoginListener'] ?? $this->load('getLoginListenerService.php'));
        }, 1 => 'onSecurityInteractivelogin'], 0);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['response_listener'] ?? ($this->privates['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8')));
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['streamed_response_listener'] ?? ($this->privates['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener()));
        }, 1 => 'onKernelResponse'], -1024);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['locale_listener'] ?? $this->getLocaleListenerService());
        }, 1 => 'onKernelRequest'], 16);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['locale_listener'] ?? $this->getLocaleListenerService());
        }, 1 => 'onKernelFinishRequest'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['validate_request_listener'] ?? ($this->privates['validate_request_listener'] = new \Symfony\Component\HttpKernel\EventListener\ValidateRequestListener()));
        }, 1 => 'onKernelRequest'], 256);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['resolve_controller_name_subscriber'] ?? $this->getResolveControllerNameSubscriberService());
        }, 1 => 'onKernelRequest'], 24);
        $instance->addListener('console.error', [0 => function () {
            return ($this->privates['console.error_listener'] ?? $this->load('getConsole_ErrorListenerService.php'));
        }, 1 => 'onConsoleError'], -128);
        $instance->addListener('console.terminate', [0 => function () {
            return ($this->privates['console.error_listener'] ?? $this->load('getConsole_ErrorListenerService.php'));
        }, 1 => 'onConsoleTerminate'], -128);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['session_listener'] ?? $this->getSessionListenerService());
        }, 1 => 'onKernelRequest'], 128);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['session_listener'] ?? $this->getSessionListenerService());
        }, 1 => 'onKernelResponse'], -1000);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['session_listener'] ?? $this->getSessionListenerService());
        }, 1 => 'onFinishRequest'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['translator_listener'] ?? $this->getTranslatorListenerService());
        }, 1 => 'onKernelRequest'], 10);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['translator_listener'] ?? $this->getTranslatorListenerService());
        }, 1 => 'onKernelFinishRequest'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['debug.debug_handlers_listener'] ?? $this->getDebug_DebugHandlersListenerService());
        }, 1 => 'configure'], 2048);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['router_listener'] ?? $this->getRouterListenerService());
        }, 1 => 'onKernelRequest'], 32);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['router_listener'] ?? $this->getRouterListenerService());
        }, 1 => 'onKernelFinishRequest'], 0);
        $instance->addListener('kernel.exception', [0 => function () {
            return ($this->privates['router_listener'] ?? $this->getRouterListenerService());
        }, 1 => 'onKernelException'], -64);
        $instance->addListener('kernel.exception', [0 => function () {
            return ($this->privates['twig.exception_listener'] ?? $this->load('getTwig_ExceptionListenerService.php'));
        }, 1 => 'logKernelException'], 0);
        $instance->addListener('kernel.exception', [0 => function () {
            return ($this->privates['twig.exception_listener'] ?? $this->load('getTwig_ExceptionListenerService.php'));
        }, 1 => 'onKernelException'], -128);
        $instance->addListener('kernel.controller', [0 => function () {
            return ($this->privates['sensio_framework_extra.controller.listener'] ?? $this->getSensioFrameworkExtra_Controller_ListenerService());
        }, 1 => 'onKernelController'], 0);
        $instance->addListener('kernel.controller', [0 => function () {
            return ($this->privates['sensio_framework_extra.converter.listener'] ?? $this->getSensioFrameworkExtra_Converter_ListenerService());
        }, 1 => 'onKernelController'], 0);
        $instance->addListener('kernel.controller', [0 => function () {
            return ($this->privates['sensio_framework_extra.view.listener'] ?? $this->getSensioFrameworkExtra_View_ListenerService());
        }, 1 => 'onKernelController'], -128);
        $instance->addListener('kernel.view', [0 => function () {
            return ($this->privates['sensio_framework_extra.view.listener'] ?? $this->getSensioFrameworkExtra_View_ListenerService());
        }, 1 => 'onKernelView'], 0);
        $instance->addListener('kernel.controller', [0 => function () {
            return ($this->privates['sensio_framework_extra.cache.listener'] ?? ($this->privates['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener()));
        }, 1 => 'onKernelController'], 0);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['sensio_framework_extra.cache.listener'] ?? ($this->privates['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener()));
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('kernel.controller_arguments', [0 => function () {
            return ($this->privates['sensio_framework_extra.security.listener'] ?? $this->getSensioFrameworkExtra_Security_ListenerService());
        }, 1 => 'onKernelControllerArguments'], 0);
        $instance->addListener('kernel.controller_arguments', [0 => function () {
            return ($this->privates['framework_extra_bundle.event.is_granted'] ?? $this->getFrameworkExtraBundle_Event_IsGrantedService());
        }, 1 => 'onKernelControllerArguments'], 0);
        $instance->addListener('kernel.response', [0 => function () {
            return ($this->privates['security.rememberme.response_listener'] ?? ($this->privates['security.rememberme.response_listener'] = new \Symfony\Component\Security\Http\RememberMe\ResponseListener()));
        }, 1 => 'onKernelResponse'], 0);
        $instance->addListener('kernel.request', [0 => function () {
            return ($this->privates['debug.security.firewall'] ?? $this->getDebug_Security_FirewallService());
        }, 1 => 'onKernelRequest'], 8);
        $instance->addListener('kernel.finish_request', [0 => function () {
            return ($this->privates['debug.security.firewall'] ?? $this->getDebug_Security_FirewallService());
        }, 1 => 'onKernelFinishRequest'], 0);
        $instance->addListener('console.command', [0 => function () {
            return ($this->privates['monolog.handler.console'] ?? ($this->privates['monolog.handler.console'] = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, [])));
        }, 1 => 'onCommand'], 255);
        $instance->addListener('console.terminate', [0 => function () {
            return ($this->privates['monolog.handler.console'] ?? ($this->privates['monolog.handler.console'] = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, [])));
        }, 1 => 'onTerminate'], -255);

        return $instance;
    }

    /**
     * Gets the public 'http_kernel' shared service.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernel
     */
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Component\HttpKernel\HttpKernel(($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()), new \Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver($this, ($this->privates['controller_name_converter'] ?? ($this->privates['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser(($this->services['kernel'] ?? $this->get('kernel', 1))))), ($this->privates['monolog.logger.request'] ?? $this->getMonolog_Logger_RequestService())), ($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), new \Symfony\Component\HttpKernel\Controller\ArgumentResolver(($this->privates['argument_metadata_factory'] ?? ($this->privates['argument_metadata_factory'] = new \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory())), new RewindableGenerator(function () {
            yield 0 => ($this->privates['argument_resolver.request_attribute'] ?? ($this->privates['argument_resolver.request_attribute'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver()));
            yield 1 => ($this->privates['argument_resolver.request'] ?? ($this->privates['argument_resolver.request'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver()));
            yield 2 => ($this->privates['argument_resolver.session'] ?? ($this->privates['argument_resolver.session'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\SessionValueResolver()));
            yield 3 => ($this->privates['security.user_value_resolver'] ?? $this->load('getSecurity_UserValueResolverService.php'));
            yield 4 => ($this->privates['MsgPhp\\User\\Infra\\Security\\UserArgumentValueResolver'] ?? $this->load('getUserArgumentValueResolverService.php'));
            yield 5 => ($this->privates['argument_resolver.service'] ?? $this->load('getArgumentResolver_ServiceService.php'));
            yield 6 => ($this->privates['argument_resolver.default'] ?? ($this->privates['argument_resolver.default'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver()));
            yield 7 => ($this->privates['argument_resolver.variadic'] ?? ($this->privates['argument_resolver.variadic'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\VariadicValueResolver()));
        }, 8)));
    }

    /**
     * Gets the public 'request_stack' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\RequestStack
     */
    protected function getRequestStackService()
    {
        return $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack();
    }

    /**
     * Gets the public 'router' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    protected function getRouterService()
    {
        $a = new \Symfony\Bridge\Monolog\Logger('router');
        $a->pushHandler(($this->privates['cloudwatch_handler'] ?? $this->getCloudwatchHandlerService()));
        $a->pushHandler(($this->privates['monolog.handler.console'] ?? ($this->privates['monolog.handler.console'] = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, []))));
        $a->pushHandler(($this->privates['monolog.handler.container_logs'] ?? $this->getMonolog_Handler_ContainerLogsService()));
        $a->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        $this->services['router'] = $instance = new \Symfony\Bundle\FrameworkBundle\Routing\Router((new \Symfony\Component\DependencyInjection\ServiceLocator(['routing.loader' => function (): \Symfony\Component\Config\Loader\LoaderInterface {
            return ($this->services['routing.loader'] ?? $this->load('getRouting_LoaderService.php'));
        }]))->withContext('router.default', $this), 'kernel::loadRoutes', ['cache_dir' => $this->targetDirs[0], 'debug' => true, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'srcProdDebugProjectContainerUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'srcProdDebugProjectContainerUrlMatcher', 'strict_requirements' => NULL, 'resource_type' => 'service'], ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()), new \Symfony\Component\DependencyInjection\ParameterBag\ContainerBag($this), $a);

        $instance->setConfigCacheFactory(($this->privates['config_cache_factory'] ?? $this->getConfigCacheFactoryService()));

        return $instance;
    }

    /**
     * Gets the public 'security.authorization_checker' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authorization\AuthorizationChecker
     */
    protected function getSecurity_AuthorizationCheckerService()
    {
        return $this->services['security.authorization_checker'] = new \Symfony\Component\Security\Core\Authorization\AuthorizationChecker(($this->services['security.token_storage'] ?? ($this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())), ($this->privates['security.authentication.manager'] ?? $this->getSecurity_Authentication_ManagerService()), ($this->privates['debug.security.access.decision_manager'] ?? $this->getDebug_Security_Access_DecisionManagerService()), false);
    }

    /**
     * Gets the public 'security.token_storage' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage
     */
    protected function getSecurity_TokenStorageService()
    {
        return $this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage();
    }

    /**
     * Gets the public 'translator' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    protected function getTranslatorService()
    {
        $this->services['translator'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\Translator(new \Symfony\Component\DependencyInjection\ServiceLocator(['translation.loader.csv' => function () {
            return ($this->privates['translation.loader.csv'] ?? ($this->privates['translation.loader.csv'] = new \Symfony\Component\Translation\Loader\CsvFileLoader()));
        }, 'translation.loader.dat' => function () {
            return ($this->privates['translation.loader.dat'] ?? ($this->privates['translation.loader.dat'] = new \Symfony\Component\Translation\Loader\IcuDatFileLoader()));
        }, 'translation.loader.ini' => function () {
            return ($this->privates['translation.loader.ini'] ?? ($this->privates['translation.loader.ini'] = new \Symfony\Component\Translation\Loader\IniFileLoader()));
        }, 'translation.loader.json' => function () {
            return ($this->privates['translation.loader.json'] ?? ($this->privates['translation.loader.json'] = new \Symfony\Component\Translation\Loader\JsonFileLoader()));
        }, 'translation.loader.mo' => function () {
            return ($this->privates['translation.loader.mo'] ?? ($this->privates['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader()));
        }, 'translation.loader.php' => function () {
            return ($this->privates['translation.loader.php'] ?? ($this->privates['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader()));
        }, 'translation.loader.po' => function () {
            return ($this->privates['translation.loader.po'] ?? ($this->privates['translation.loader.po'] = new \Symfony\Component\Translation\Loader\PoFileLoader()));
        }, 'translation.loader.qt' => function () {
            return ($this->privates['translation.loader.qt'] ?? ($this->privates['translation.loader.qt'] = new \Symfony\Component\Translation\Loader\QtFileLoader()));
        }, 'translation.loader.res' => function () {
            return ($this->privates['translation.loader.res'] ?? ($this->privates['translation.loader.res'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader()));
        }, 'translation.loader.xliff' => function () {
            return ($this->privates['translation.loader.xliff'] ?? ($this->privates['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader()));
        }, 'translation.loader.yml' => function () {
            return ($this->privates['translation.loader.yml'] ?? ($this->privates['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader()));
        }]), new \Symfony\Component\Translation\Formatter\MessageFormatter(new \Symfony\Component\Translation\MessageSelector()), 'en', ['translation.loader.php' => [0 => 'php'], 'translation.loader.yml' => [0 => 'yaml', 1 => 'yml'], 'translation.loader.xliff' => [0 => 'xlf', 1 => 'xliff'], 'translation.loader.po' => [0 => 'po'], 'translation.loader.mo' => [0 => 'mo'], 'translation.loader.qt' => [0 => 'ts'], 'translation.loader.csv' => [0 => 'csv'], 'translation.loader.res' => [0 => 'res'], 'translation.loader.dat' => [0 => 'dat'], 'translation.loader.ini' => [0 => 'ini'], 'translation.loader.json' => [0 => 'json']], ['cache_dir' => ($this->targetDirs[0].'/translations'), 'debug' => true, 'resource_files' => ['af' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.af.xlf')], 'ar' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.ar.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.ar.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.ar.xlf')], 'az' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.az.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.az.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.az.xlf')], 'bg' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.bg.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.bg.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.bg.xlf')], 'ca' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.ca.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.ca.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.ca.xlf')], 'cs' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.cs.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.cs.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.cs.xlf')], 'cy' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.cy.xlf')], 'da' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.da.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.da.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.da.xlf')], 'de' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.de.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.de.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.de.xlf')], 'el' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.el.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.el.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.el.xlf')], 'en' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.en.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.en.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.en.xlf'), 3 => ($this->targetDirs[3].'/translations/messages.en.yaml'), 4 => ($this->targetDirs[3].'/translations/messages.en.yaml')], 'es' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.es.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.es.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.es.xlf')], 'et' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.et.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.et.xlf')], 'eu' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.eu.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.eu.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.eu.xlf')], 'fa' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.fa.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.fa.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.fa.xlf')], 'fi' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.fi.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.fi.xlf')], 'fr' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.fr.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.fr.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.fr.xlf')], 'gl' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.gl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.gl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.gl.xlf')], 'he' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.he.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.he.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.he.xlf')], 'hr' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.hr.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.hr.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.hr.xlf')], 'hu' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.hu.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.hu.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.hu.xlf')], 'hy' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.hy.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.hy.xlf')], 'id' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.id.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.id.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.id.xlf')], 'it' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.it.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.it.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.it.xlf')], 'ja' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.ja.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.ja.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.ja.xlf')], 'lb' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.lb.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.lb.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.lb.xlf')], 'lt' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.lt.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.lt.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.lt.xlf')], 'lv' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.lv.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.lv.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.lv.xlf')], 'mn' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.mn.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.mn.xlf')], 'nb' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.nb.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.nb.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.nb.xlf')], 'nl' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.nl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.nl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.nl.xlf')], 'nn' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.nn.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.nn.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.nn.xlf')], 'no' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.no.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.no.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.no.xlf')], 'pl' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.pl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.pl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.pl.xlf')], 'pt' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.pt.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.pt.xlf')], 'pt_BR' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.pt_BR.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.pt_BR.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.pt_BR.xlf')], 'ro' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.ro.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.ro.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.ro.xlf')], 'ru' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.ru.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.ru.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.ru.xlf')], 'sk' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.sk.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.sk.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.sk.xlf')], 'sl' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.sl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.sl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.sl.xlf')], 'sq' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.sq.xlf')], 'sr_Cyrl' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.sr_Cyrl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.sr_Cyrl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.sr_Cyrl.xlf')], 'sr_Latn' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.sr_Latn.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.sr_Latn.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.sr_Latn.xlf')], 'sv' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.sv.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.sv.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.sv.xlf')], 'th' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.th.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.th.xlf')], 'tl' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.tl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.tl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.tl.xlf')], 'tr' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.tr.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.tr.xlf')], 'uk' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.uk.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.uk.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.uk.xlf')], 'vi' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.vi.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.vi.xlf')], 'zh_CN' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.zh_CN.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/form/Resources/translations/validators.zh_CN.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.zh_CN.xlf')], 'zh_TW' => [0 => ($this->targetDirs[3].'/vendor/symfony/validator/Resources/translations/validators.zh_TW.xlf')], 'be' => [0 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.be.xlf')], 'pt_PT' => [0 => ($this->targetDirs[3].'/vendor/symfony/security/Core/Resources/translations/security.pt_PT.xlf')]]]);

        $instance->setConfigCacheFactory(($this->privates['config_cache_factory'] ?? $this->getConfigCacheFactoryService()));
        $instance->setFallbackLocales([0 => 'en']);

        return $instance;
    }

    /**
     * Gets the public 'twig' shared service.
     *
     * @return \Twig\Environment
     */
    protected function getTwigService()
    {
        $a = new \Twig\Loader\FilesystemLoader([], $this->targetDirs[3]);
        $a->addPath(($this->targetDirs[3].'/templates'));
        $a->addPath(($this->targetDirs[3].'/vendor/symfony/framework-bundle/Resources/views'), 'Framework');
        $a->addPath(($this->targetDirs[3].'/vendor/symfony/framework-bundle/Resources/views'), '!Framework');
        $a->addPath(($this->targetDirs[3].'/vendor/symfony/twig-bundle/Resources/views'), 'Twig');
        $a->addPath(($this->targetDirs[3].'/vendor/symfony/twig-bundle/Resources/views'), '!Twig');
        $a->addPath(($this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Resources/views'), 'Doctrine');
        $a->addPath(($this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Resources/views'), '!Doctrine');
        $a->addPath(($this->targetDirs[3].'/vendor/symfony/security-bundle/Resources/views'), 'Security');
        $a->addPath(($this->targetDirs[3].'/vendor/symfony/security-bundle/Resources/views'), '!Security');
        $a->addPath(($this->targetDirs[3].'/vendor/liip/monitor-bundle/Resources/views'), 'LiipMonitor');
        $a->addPath(($this->targetDirs[3].'/vendor/liip/monitor-bundle/Resources/views'), '!LiipMonitor');
        $a->addPath(($this->targetDirs[3].'/templates'));
        $a->addPath(($this->targetDirs[3].'/vendor/symfony/twig-bridge/Resources/views/Form'));

        $this->services['twig'] = $instance = new \Twig\Environment($a, ['paths' => [($this->targetDirs[3].'/templates') => NULL], 'debug' => true, 'strict_variables' => true, 'form_themes' => $this->parameters['twig.form.resources'], 'exception_controller' => 'twig.controller.exception::showAction', 'autoescape' => 'name', 'cache' => ($this->targetDirs[0].'/twig'), 'charset' => 'UTF-8', 'default_path' => ($this->targetDirs[3].'/templates'), 'date' => ['format' => 'F j, Y H:i', 'interval_format' => '%d days', 'timezone' => NULL], 'number_format' => ['decimals' => 0, 'decimal_point' => '.', 'thousands_separator' => ',']]);

        $b = ($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack()));
        $c = new \Symfony\Bridge\Twig\AppVariable();
        $c->setEnvironment('prod');
        $c->setDebug(true);
        if ($this->has('security.token_storage')) {
            $c->setTokenStorage(($this->services['security.token_storage'] ?? ($this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())));
        }
        if ($this->has('request_stack')) {
            $c->setRequestStack($b);
        }

        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\CsrfExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\ProfilerExtension(new \Twig\Profiler\Profile(), NULL));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension(($this->services['translator'] ?? $this->getTranslatorService())));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\AssetExtension(($this->privates['assets.packages'] ?? $this->getAssets_PackagesService())));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\CodeExtension(($this->privates['debug.file_link_formatter'] ?? ($this->privates['debug.file_link_formatter'] = new \Symfony\Component\HttpKernel\Debug\FileLinkFormatter(NULL))), ($this->targetDirs[3].'/src'), 'UTF-8'));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\RoutingExtension(($this->services['router'] ?? $this->getRouterService())));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\YamlExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\HttpKernelExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\HttpFoundationExtension($b, ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService())));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\FormExtension([0 => $this, 1 => 'twig.form.renderer']));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\LogoutUrlExtension(($this->privates['security.logout_url_generator'] ?? $this->getSecurity_LogoutUrlGeneratorService())));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\SecurityExtension(($this->services['security.authorization_checker'] ?? $this->getSecurity_AuthorizationCheckerService())));
        $instance->addExtension(new \Twig\Extensions\TextExtension());
        $instance->addExtension(new \App\Twig\OncloudTimeTwigExtension());
        $instance->addExtension(new \Twig\Extension\DebugExtension());
        $instance->addExtension(new \Doctrine\Bundle\DoctrineBundle\Twig\DoctrineExtension());
        $instance->addGlobal('app', $c);
        $instance->addRuntimeLoader(new \Twig\RuntimeLoader\ContainerRuntimeLoader(new \Symfony\Component\DependencyInjection\ServiceLocator(['Symfony\\Bridge\\Twig\\Extension\\CsrfRuntime' => function () {
            return ($this->privates['twig.runtime.security_csrf'] ?? $this->load('getTwig_Runtime_SecurityCsrfService.php'));
        }, 'Symfony\\Bridge\\Twig\\Extension\\HttpKernelRuntime' => function () {
            return ($this->privates['twig.runtime.httpkernel'] ?? $this->load('getTwig_Runtime_HttpkernelService.php'));
        }, 'Symfony\\Component\\Form\\FormRenderer' => function () {
            return ($this->privates['twig.form.renderer'] ?? $this->load('getTwig_Form_RendererService.php'));
        }])));
        $instance->addGlobal('msgphp_user', new \MsgPhp\UserBundle\Twig\GlobalVariable((new \Symfony\Component\DependencyInjection\ServiceLocator(['MsgPhp\\Domain\\Factory\\EntityAwareFactoryInterface' => function () {
            return ($this->privates['MsgPhp\\Domain\\Infra\\Doctrine\\EntityAwareFactory'] ?? $this->getEntityAwareFactoryService());
        }, 'MsgPhp\\User\\Repository\\UserRepositoryInterface' => function () {
            return ($this->privates['MsgPhp\\User\\Infra\\Doctrine\\Repository\\UserRepository'] ?? $this->getUserRepositoryService());
        }, 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\Storage\\TokenStorageInterface' => function () {
            return ($this->services['security.token_storage'] ?? ($this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage()));
        }]))->withContext('MsgPhp\\UserBundle\\Twig\\GlobalVariable', $this)));
        $instance->addGlobal('activity_current_dashboardUrl', '<iframe id="powerbi_dashboard" width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiZWQ0OGQ3NDktNDllMy00NDVlLTgwNjItYzYxZWE0ZDc1ZDdjIiwidCI6ImM3ZGZjNTk1LWU4OWUtNDQ4Ni1iNGM0LWI0NmRhZmFjMmU5NSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>');
        $instance->addGlobal('activity_history_dashboardUrl', '<iframe id="powerbi_dashboard" width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiZWQ0OGQ3NDktNDllMy00NDVlLTgwNjItYzYxZWE0ZDc1ZDdjIiwidCI6ImM3ZGZjNTk1LWU4OWUtNDQ4Ni1iNGM0LWI0NmRhZmFjMmU5NSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>');
        $instance->addGlobal('athena_directory', 'test');
        $instance->addGlobal('athena_database', 'test');
        $instance->addGlobal('aws_credentials_key', 'AKIAIZ6ENRM52CQMFSTA');
        $instance->addGlobal('aws_credentials_secret', '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');
        $instance->addGlobal('company_name', 'OnCloudTime');
        $instance->addGlobal('dashboard_powerbiUrl', '<iframe id="powerbi_dashboard" width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiZWQ0OGQ3NDktNDllMy00NDVlLTgwNjItYzYxZWE0ZDc1ZDdjIiwidCI6ImM3ZGZjNTk1LWU4OWUtNDQ4Ni1iNGM0LWI0NmRhZmFjMmU5NSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>');
        $instance->addGlobal('nexus_powerbiUrl', '<iframe id="powerbi_dashboard" width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiNTcwMTI1NWUtNjcyZS00MTU4LWFiYWEtZDA4MDgxMTNiMWU3IiwidCI6ImM3ZGZjNTk1LWU4OWUtNDQ4Ni1iNGM0LWI0NmRhZmFjMmU5NSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>');
        $instance->addGlobal('need_update', 'yes');
        $instance->addGlobal('rdbms_dbname', 'oncloudtime');
        $instance->addGlobal('rdbms_host', 'localhost');
        $instance->addGlobal('rdbms_user', 'root');
        $instance->addGlobal('rdbms_password', 'mysql');
        $instance->addGlobal('s3_bucket', 'yuva-bucket');
        $instance->addGlobal('sns_general_topic', 'arn:aws:sns:us-east-1:590297375119:test-sns');
        $instance->addGlobal('sqs_notificationQueue', 'https://sqs.us-east-1.amazonaws.com/590297375119/test-yuva');
        $instance->addGlobal('tables_long_text_display_characters', 20);
        $instance->addGlobal('tables_rows_per_page', 7);
        $instance->addGlobal('tables_templates_rows_per_page', 4);
        $instance->addGlobal('date_format', 'm/d/Y');
        $instance->addGlobal('asset_image_login', 'logo-no-words.png');
        $instance->addGlobal('asset_image_sidebar', 'logo-no-words.png');
        $instance->addGlobal('sidebar_activetext_color', '#df4e71');
        $instance->addGlobal('notification_success_color', 'green');
        $instance->addGlobal('notification_info_color', 'blue');
        $instance->addGlobal('notification_failed_color', '#df4e71');
        (new \Symfony\Bundle\TwigBundle\DependencyInjection\Configurator\EnvironmentConfigurator('F j, Y H:i', '%d days', NULL, 0, '.', ','))->configure($instance);

        return $instance;
    }

    /**
     * Gets the private 'MsgPhp\Domain\DomainIdentityHelper' shared autowired service.
     *
     * @return \MsgPhp\Domain\DomainIdentityHelper
     */
    protected function getDomainIdentityHelperService()
    {
        return $this->privates['MsgPhp\\Domain\\DomainIdentityHelper'] = new \MsgPhp\Domain\DomainIdentityHelper(($this->privates['MsgPhp\\Domain\\Infra\\Doctrine\\DomainIdentityMapping'] ?? $this->getDomainIdentityMappingService()));
    }

    /**
     * Gets the private 'MsgPhp\Domain\Factory\ClassMappingObjectFactory' shared service.
     *
     * @return \MsgPhp\Domain\Factory\ClassMappingObjectFactory
     */
    protected function getClassMappingObjectFactoryService()
    {
        $a = new \MsgPhp\Domain\Factory\DomainObjectFactory();

        $this->privates['MsgPhp\\Domain\\Factory\\ClassMappingObjectFactory'] = $instance = new \MsgPhp\Domain\Factory\ClassMappingObjectFactory($a, $this->parameters['msgphp.domain.class_mapping']);

        $a->setNestedFactory($instance);

        return $instance;
    }

    /**
     * Gets the private 'MsgPhp\Domain\Infra\Doctrine\DomainIdentityMapping' shared service.
     *
     * @return \MsgPhp\Domain\Infra\Doctrine\DomainIdentityMapping
     */
    protected function getDomainIdentityMappingService()
    {
        return $this->privates['MsgPhp\\Domain\\Infra\\Doctrine\\DomainIdentityMapping'] = new \MsgPhp\Domain\Infra\Doctrine\DomainIdentityMapping(($this->services['doctrine.orm.default_entity_manager'] ?? $this->getDoctrine_Orm_DefaultEntityManagerService()), $this->parameters['msgphp.domain.class_mapping']);
    }

    /**
     * Gets the private 'MsgPhp\Domain\Infra\Doctrine\EntityAwareFactory' shared service.
     *
     * @return \MsgPhp\Domain\Infra\Doctrine\EntityAwareFactory
     */
    protected function getEntityAwareFactoryService()
    {
        return $this->privates['MsgPhp\\Domain\\Infra\\Doctrine\\EntityAwareFactory'] = new \MsgPhp\Domain\Infra\Doctrine\EntityAwareFactory(new \MsgPhp\Domain\Factory\EntityAwareFactory(($this->privates['MsgPhp\\Domain\\Factory\\ClassMappingObjectFactory'] ?? $this->getClassMappingObjectFactoryService()), ($this->privates['MsgPhp\\Domain\\Infra\\Doctrine\\DomainIdentityMapping'] ?? $this->getDomainIdentityMappingService()), $this->parameters['msgphp.domain.id_class_mapping']), ($this->services['doctrine.orm.default_entity_manager'] ?? $this->getDoctrine_Orm_DefaultEntityManagerService()), $this->parameters['msgphp.domain.class_mapping']);
    }

    /**
     * Gets the private 'MsgPhp\User\Infra\Doctrine\Repository\UserRepository' shared autowired service.
     *
     * @return \MsgPhp\User\Infra\Doctrine\Repository\UserRepository
     */
    protected function getUserRepositoryService()
    {
        return $this->privates['MsgPhp\\User\\Infra\\Doctrine\\Repository\\UserRepository'] = new \MsgPhp\User\Infra\Doctrine\Repository\UserRepository('App\\Entity\\User\\AppUser', 'credential.email', ($this->services['doctrine.orm.default_entity_manager'] ?? $this->getDoctrine_Orm_DefaultEntityManagerService()), ($this->privates['MsgPhp\\Domain\\DomainIdentityHelper'] ?? $this->getDomainIdentityHelperService()));
    }

    /**
     * Gets the private 'annotations.cached_reader' shared service.
     *
     * @return \Doctrine\Common\Annotations\CachedReader
     */
    protected function getAnnotations_CachedReaderService()
    {
        return $this->privates['annotations.cached_reader'] = new \Doctrine\Common\Annotations\CachedReader(($this->privates['annotations.reader'] ?? $this->getAnnotations_ReaderService()), ($this->privates['annotations.cache'] ?? $this->load('getAnnotations_CacheService.php')), true);
    }

    /**
     * Gets the private 'annotations.reader' shared service.
     *
     * @return \Doctrine\Common\Annotations\AnnotationReader
     */
    protected function getAnnotations_ReaderService()
    {
        $this->privates['annotations.reader'] = $instance = new \Doctrine\Common\Annotations\AnnotationReader();

        $a = new \Doctrine\Common\Annotations\AnnotationRegistry();
        $a->registerUniqueLoader('class_exists');

        $instance->addGlobalIgnoredName('required', $a);

        return $instance;
    }

    /**
     * Gets the private 'assets.packages' shared service.
     *
     * @return \Symfony\Component\Asset\Packages
     */
    protected function getAssets_PackagesService()
    {
        return $this->privates['assets.packages'] = new \Symfony\Component\Asset\Packages(new \Symfony\Component\Asset\PathPackage('', new \Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy(), new \Symfony\Component\Asset\Context\RequestStackContext(($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), '', false)), []);
    }

    /**
     * Gets the private 'cloudwatch_handler' shared autowired service.
     *
     * @return \Maxbanton\Cwh\Handler\CloudWatch
     */
    protected function getCloudwatchHandlerService()
    {
        return $this->privates['cloudwatch_handler'] = new \Maxbanton\Cwh\Handler\CloudWatch(new \Aws\CloudWatchLogs\CloudWatchLogsClient(['credentials' => ['key' => 'AKIAIZ6ENRM52CQMFSTA', 'secret' => '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'], 'region' => 'us-east-1', 'version' => 'latest']), 'oncloudtime', 'prod', 30, 10000, ['mytag' => 'oncloudtime'], 'DEBUG');
    }

    /**
     * Gets the private 'config_cache_factory' shared service.
     *
     * @return \Symfony\Component\Config\ResourceCheckerConfigCacheFactory
     */
    protected function getConfigCacheFactoryService()
    {
        return $this->privates['config_cache_factory'] = new \Symfony\Component\Config\ResourceCheckerConfigCacheFactory(new RewindableGenerator(function () {
            yield 0 => ($this->privates['dependency_injection.config.container_parameters_resource_checker'] ?? ($this->privates['dependency_injection.config.container_parameters_resource_checker'] = new \Symfony\Component\DependencyInjection\Config\ContainerParametersResourceChecker($this)));
            yield 1 => ($this->privates['config.resource.self_checking_resource_checker'] ?? ($this->privates['config.resource.self_checking_resource_checker'] = new \Symfony\Component\Config\Resource\SelfCheckingResourceChecker()));
        }, 2));
    }

    /**
     * Gets the private 'debug.debug_handlers_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener
     */
    protected function getDebug_DebugHandlersListenerService()
    {
        $a = new \Symfony\Bridge\Monolog\Logger('php');
        $a->pushHandler(($this->privates['cloudwatch_handler'] ?? $this->getCloudwatchHandlerService()));
        $a->pushHandler(($this->privates['monolog.handler.console'] ?? ($this->privates['monolog.handler.console'] = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, []))));
        $a->pushHandler(($this->privates['monolog.handler.container_logs'] ?? $this->getMonolog_Handler_ContainerLogsService()));
        $a->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        return $this->privates['debug.debug_handlers_listener'] = new \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener(NULL, $a, NULL, -1, true, ($this->privates['debug.file_link_formatter'] ?? ($this->privates['debug.file_link_formatter'] = new \Symfony\Component\HttpKernel\Debug\FileLinkFormatter(NULL))), true);
    }

    /**
     * Gets the private 'debug.security.access.decision_manager' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authorization\TraceableAccessDecisionManager
     */
    protected function getDebug_Security_Access_DecisionManagerService()
    {
        return $this->privates['debug.security.access.decision_manager'] = new \Symfony\Component\Security\Core\Authorization\TraceableAccessDecisionManager(new \Symfony\Component\Security\Core\Authorization\AccessDecisionManager(new RewindableGenerator(function () {
            yield 0 => ($this->privates['security.access.authenticated_voter'] ?? $this->load('getSecurity_Access_AuthenticatedVoterService.php'));
            yield 1 => ($this->privates['security.access.role_hierarchy_voter'] ?? $this->load('getSecurity_Access_RoleHierarchyVoterService.php'));
        }, 2), 'affirmative', false, true));
    }

    /**
     * Gets the private 'debug.security.firewall' shared service.
     *
     * @return \Symfony\Bundle\SecurityBundle\Debug\TraceableFirewallListener
     */
    protected function getDebug_Security_FirewallService()
    {
        return $this->privates['debug.security.firewall'] = new \Symfony\Bundle\SecurityBundle\Debug\TraceableFirewallListener(new \Symfony\Bundle\SecurityBundle\Security\FirewallMap(new \Symfony\Component\DependencyInjection\ServiceLocator(['security.firewall.map.context.dev' => function () {
            return ($this->privates['security.firewall.map.context.dev'] ?? $this->load('getSecurity_Firewall_Map_Context_DevService.php'));
        }, 'security.firewall.map.context.main' => function () {
            return ($this->privates['security.firewall.map.context.main'] ?? $this->load('getSecurity_Firewall_Map_Context_MainService.php'));
        }]), new RewindableGenerator(function () {
            yield 'security.firewall.map.context.dev' => ($this->privates['.security.request_matcher.zfHj2lW'] ?? ($this->privates['.security.request_matcher.zfHj2lW'] = new \Symfony\Component\HttpFoundation\RequestMatcher('^/(_(profiler|wdt)|css|images|js)/')));
            yield 'security.firewall.map.context.main' => ($this->privates['.security.request_matcher.00qF1Z7'] ?? ($this->privates['.security.request_matcher.00qF1Z7'] = new \Symfony\Component\HttpFoundation\RequestMatcher('^/')));
        }, 2)), ($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()), ($this->privates['security.logout_url_generator'] ?? $this->getSecurity_LogoutUrlGeneratorService()));
    }

    /**
     * Gets the private 'doctrine.orm.default_configuration' shared service.
     *
     * @return \Doctrine\ORM\Configuration
     */
    protected function getDoctrine_Orm_DefaultConfigurationService()
    {
        $this->privates['doctrine.orm.default_configuration'] = $instance = new \Doctrine\ORM\Configuration();

        $a = new \Symfony\Component\Cache\DoctrineProvider(($this->privates['doctrine.system_cache_pool'] ?? $this->getDoctrine_SystemCachePoolService()));
        $b = new \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain();

        $c = new \Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver([($this->targetDirs[0].'/msgphp/doctrine-mapping') => 'MsgPhp']);
        $c->setGlobalBasename('mapping');

        $b->addDriver($c, 'MsgPhp');
        $b->addDriver(new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService()), [0 => ($this->targetDirs[3].'/src/Entity')]), 'App\\Entity');

        $instance->setEntityNamespaces(['msgphp' => 'MsgPhp', 'App' => 'App\\Entity']);
        $instance->setMetadataCacheImpl($a);
        $instance->setQueryCacheImpl($a);
        $instance->setResultCacheImpl(new \Symfony\Component\Cache\DoctrineProvider(($this->privates['doctrine.result_cache_pool'] ?? $this->getDoctrine_ResultCachePoolService())));
        $instance->setMetadataDriverImpl($b);
        $instance->setProxyDir(($this->targetDirs[0].'/doctrine/orm/Proxies'));
        $instance->setProxyNamespace('Proxies');
        $instance->setAutoGenerateProxyClasses(true);
        $instance->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');
        $instance->setDefaultRepositoryClassName('Doctrine\\ORM\\EntityRepository');
        $instance->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy());
        $instance->setQuoteStrategy(new \Doctrine\ORM\Mapping\DefaultQuoteStrategy());
        $instance->setEntityListenerResolver(new \Doctrine\Bundle\DoctrineBundle\Mapping\ContainerEntityListenerResolver($this));
        $instance->setRepositoryFactory(new \Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory(new \Symfony\Component\DependencyInjection\ServiceLocator(['App\\Repository\\AccountRepository' => function () {
            return ($this->privates['App\\Repository\\AccountRepository'] ?? $this->load('getAccountRepositoryService.php'));
        }, 'App\\Repository\\AppUserRepository' => function () {
            return ($this->privates['App\\Repository\\AppUserRepository'] ?? $this->load('getAppUserRepositoryService.php'));
        }, 'App\\Repository\\ConversionRepository' => function () {
            return ($this->privates['App\\Repository\\ConversionRepository'] ?? $this->load('getConversionRepositoryService.php'));
        }, 'App\\Repository\\CustomReportRepository' => function () {
            return ($this->privates['App\\Repository\\CustomReportRepository'] ?? $this->load('getCustomReportRepositoryService.php'));
        }, 'App\\Repository\\EmployeeRelationshipRepository' => function () {
            return ($this->privates['App\\Repository\\EmployeeRelationshipRepository'] ?? $this->load('getEmployeeRelationshipRepositoryService.php'));
        }, 'App\\Repository\\EmployeeRepository' => function () {
            return ($this->privates['App\\Repository\\EmployeeRepository'] ?? $this->load('getEmployeeRepositoryService.php'));
        }, 'App\\Repository\\FileUploadRepository' => function () {
            return ($this->privates['App\\Repository\\FileUploadRepository'] ?? $this->load('getFileUploadRepositoryService.php'));
        }, 'App\\Repository\\FileWatcherRepository' => function () {
            return ($this->privates['App\\Repository\\FileWatcherRepository'] ?? $this->load('getFileWatcherRepositoryService.php'));
        }, 'App\\Repository\\HadoopStatusRepository' => function () {
            return ($this->privates['App\\Repository\\HadoopStatusRepository'] ?? $this->load('getHadoopStatusRepositoryService.php'));
        }, 'App\\Repository\\MPPStatusRepository' => function () {
            return ($this->privates['App\\Repository\\MPPStatusRepository'] ?? $this->load('getMPPStatusRepositoryService.php'));
        }, 'App\\Repository\\NotificationRepository' => function () {
            return ($this->privates['App\\Repository\\NotificationRepository'] ?? $this->load('getNotificationRepositoryService.php'));
        }, 'App\\Repository\\ProjectAssignmentRepository' => function () {
            return ($this->privates['App\\Repository\\ProjectAssignmentRepository'] ?? $this->load('getProjectAssignmentRepositoryService.php'));
        }, 'App\\Repository\\ProjectRateRepository' => function () {
            return ($this->privates['App\\Repository\\ProjectRateRepository'] ?? $this->load('getProjectRateRepositoryService.php'));
        }, 'App\\Repository\\ProjectRepository' => function () {
            return ($this->privates['App\\Repository\\ProjectRepository'] ?? $this->load('getProjectRepositoryService.php'));
        }, 'App\\Repository\\SimulationRepository' => function () {
            return ($this->privates['App\\Repository\\SimulationRepository'] ?? $this->load('getSimulationRepositoryService.php'));
        }, 'App\\Repository\\StateGuideRepository' => function () {
            return ($this->privates['App\\Repository\\StateGuideRepository'] ?? $this->load('getStateGuideRepositoryService.php'));
        }, 'App\\Repository\\TaskCategoryRepository' => function () {
            return ($this->privates['App\\Repository\\TaskCategoryRepository'] ?? $this->load('getTaskCategoryRepositoryService.php'));
        }, 'App\\Repository\\TaskQueueRepository' => function () {
            return ($this->privates['App\\Repository\\TaskQueueRepository'] ?? $this->load('getTaskQueueRepositoryService.php'));
        }, 'App\\Repository\\TaskRepository' => function () {
            return ($this->privates['App\\Repository\\TaskRepository'] ?? $this->load('getTaskRepositoryService.php'));
        }, 'App\\Repository\\TaskTemplateRepository' => function () {
            return ($this->privates['App\\Repository\\TaskTemplateRepository'] ?? $this->load('getTaskTemplateRepositoryService.php'));
        }, 'App\\Repository\\TemplateRepository' => function () {
            return ($this->privates['App\\Repository\\TemplateRepository'] ?? $this->load('getTemplateRepositoryService.php'));
        }, 'App\\Repository\\TimesheetDetailRepository' => function () {
            return ($this->privates['App\\Repository\\TimesheetDetailRepository'] ?? $this->load('getTimesheetDetailRepositoryService.php'));
        }, 'App\\Repository\\TimesheetRepository' => function () {
            return ($this->privates['App\\Repository\\TimesheetRepository'] ?? $this->load('getTimesheetRepositoryService.php'));
        }])));
        $instance->addCustomHydrationMode('msgphp_scalar', 'MsgPhp\\Domain\\Infra\\Doctrine\\Hydration\\ScalarHydrator');
        $instance->addCustomHydrationMode('msgphp_single_scalar', 'MsgPhp\\Domain\\Infra\\Doctrine\\Hydration\\SingleScalarHydrator');

        return $instance;
    }

    /**
     * Gets the private 'doctrine.result_cache_pool' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\FilesystemAdapter
     */
    protected function getDoctrine_ResultCachePoolService()
    {
        $this->privates['doctrine.result_cache_pool'] = $instance = new \Symfony\Component\Cache\Adapter\FilesystemAdapter('GeLLaTQBqJ', 0, ($this->targetDirs[0].'/pools'));

        $instance->setLogger(($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));

        return $instance;
    }

    /**
     * Gets the private 'doctrine.system_cache_pool' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected function getDoctrine_SystemCachePoolService()
    {
        return $this->privates['doctrine.system_cache_pool'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('5QPg7qCRk4', 0, $this->getParameter('container.build_id'), ($this->targetDirs[0].'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));
    }

    /**
     * Gets the private 'framework_extra_bundle.argument_name_convertor' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\Request\ArgumentNameConverter
     */
    protected function getFrameworkExtraBundle_ArgumentNameConvertorService()
    {
        return $this->privates['framework_extra_bundle.argument_name_convertor'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ArgumentNameConverter(($this->privates['argument_metadata_factory'] ?? ($this->privates['argument_metadata_factory'] = new \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory())));
    }

    /**
     * Gets the private 'framework_extra_bundle.event.is_granted' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\IsGrantedListener
     */
    protected function getFrameworkExtraBundle_Event_IsGrantedService()
    {
        return $this->privates['framework_extra_bundle.event.is_granted'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\IsGrantedListener(($this->privates['framework_extra_bundle.argument_name_convertor'] ?? $this->getFrameworkExtraBundle_ArgumentNameConvertorService()), ($this->services['security.authorization_checker'] ?? $this->getSecurity_AuthorizationCheckerService()));
    }

    /**
     * Gets the private 'locale_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\LocaleListener
     */
    protected function getLocaleListenerService()
    {
        return $this->privates['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener(($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), 'en', ($this->services['router'] ?? $this->getRouterService()));
    }

    /**
     * Gets the private 'monolog.handler.container_logs' shared service.
     *
     * @return \Monolog\Handler\StreamHandler
     */
    protected function getMonolog_Handler_ContainerLogsService()
    {
        $this->privates['monolog.handler.container_logs'] = $instance = new \Monolog\Handler\StreamHandler('php://stderr', 200, true, NULL);

        $instance->pushProcessor(($this->privates['monolog.processor.psr_log_message'] ?? ($this->privates['monolog.processor.psr_log_message'] = new \Monolog\Processor\PsrLogMessageProcessor())));

        return $instance;
    }

    /**
     * Gets the private 'monolog.handler.main' shared service.
     *
     * @return \Monolog\Handler\FingersCrossedHandler
     */
    protected function getMonolog_Handler_MainService()
    {
        $a = new \Monolog\Handler\StreamHandler(($this->targetDirs[2].'/log/prod.log'), 200, true, NULL);

        $b = ($this->privates['monolog.processor.psr_log_message'] ?? ($this->privates['monolog.processor.psr_log_message'] = new \Monolog\Processor\PsrLogMessageProcessor()));

        $a->pushProcessor($b);

        $this->privates['monolog.handler.main'] = $instance = new \Monolog\Handler\FingersCrossedHandler($a, new \Symfony\Bridge\Monolog\Handler\FingersCrossed\NotFoundActivationStrategy(($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), [0 => '^/'], 200), 0, true, true, NULL);

        $instance->pushProcessor($b);

        return $instance;
    }

    /**
     * Gets the private 'monolog.logger' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_LoggerService()
    {
        $this->privates['monolog.logger'] = $instance = new \Symfony\Bridge\Monolog\Logger('app');

        $a = new \Monolog\Handler\StreamHandler(($this->targetDirs[2].'/log/oncloudtime-prod.log'), 200, true, NULL);
        $a->pushProcessor(($this->privates['monolog.processor.psr_log_message'] ?? ($this->privates['monolog.processor.psr_log_message'] = new \Monolog\Processor\PsrLogMessageProcessor())));

        $instance->useMicrosecondTimestamps(true);
        $instance->pushHandler(($this->privates['cloudwatch_handler'] ?? $this->getCloudwatchHandlerService()));
        $instance->pushHandler(($this->privates['monolog.handler.console'] ?? ($this->privates['monolog.handler.console'] = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, []))));
        $instance->pushHandler(($this->privates['monolog.handler.container_logs'] ?? $this->getMonolog_Handler_ContainerLogsService()));
        $instance->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));
        $instance->pushHandler($a);

        return $instance;
    }

    /**
     * Gets the private 'monolog.logger.cache' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_CacheService()
    {
        $this->privates['monolog.logger.cache'] = $instance = new \Symfony\Bridge\Monolog\Logger('cache');

        $instance->pushHandler(($this->privates['cloudwatch_handler'] ?? $this->getCloudwatchHandlerService()));
        $instance->pushHandler(($this->privates['monolog.handler.console'] ?? ($this->privates['monolog.handler.console'] = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, []))));
        $instance->pushHandler(($this->privates['monolog.handler.container_logs'] ?? $this->getMonolog_Handler_ContainerLogsService()));
        $instance->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        return $instance;
    }

    /**
     * Gets the private 'monolog.logger.request' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_RequestService()
    {
        $this->privates['monolog.logger.request'] = $instance = new \Symfony\Bridge\Monolog\Logger('request');

        $instance->pushHandler(($this->privates['cloudwatch_handler'] ?? $this->getCloudwatchHandlerService()));
        $instance->pushHandler(($this->privates['monolog.handler.console'] ?? ($this->privates['monolog.handler.console'] = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, []))));
        $instance->pushHandler(($this->privates['monolog.handler.container_logs'] ?? $this->getMonolog_Handler_ContainerLogsService()));
        $instance->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

        return $instance;
    }

    /**
     * Gets the private 'resolve_controller_name_subscriber' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\EventListener\ResolveControllerNameSubscriber
     */
    protected function getResolveControllerNameSubscriberService()
    {
        return $this->privates['resolve_controller_name_subscriber'] = new \Symfony\Bundle\FrameworkBundle\EventListener\ResolveControllerNameSubscriber(($this->privates['controller_name_converter'] ?? ($this->privates['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser(($this->services['kernel'] ?? $this->get('kernel', 1))))));
    }

    /**
     * Gets the private 'router.request_context' shared service.
     *
     * @return \Symfony\Component\Routing\RequestContext
     */
    protected function getRouter_RequestContextService()
    {
        return $this->privates['router.request_context'] = new \Symfony\Component\Routing\RequestContext('', 'GET', 'localhost', 'http', 80, 443);
    }

    /**
     * Gets the private 'router_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\RouterListener
     */
    protected function getRouterListenerService()
    {
        return $this->privates['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener(($this->services['router'] ?? $this->getRouterService()), ($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()), ($this->privates['monolog.logger.request'] ?? $this->getMonolog_Logger_RequestService()), $this->targetDirs[3], true);
    }

    /**
     * Gets the private 'security.authentication.manager' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager
     */
    protected function getSecurity_Authentication_ManagerService()
    {
        $this->privates['security.authentication.manager'] = $instance = new \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager(new RewindableGenerator(function () {
            yield 0 => ($this->privates['security.authentication.provider.guard.main'] ?? $this->load('getSecurity_Authentication_Provider_Guard_MainService.php'));
            yield 1 => ($this->privates['security.authentication.provider.dao.main'] ?? $this->load('getSecurity_Authentication_Provider_Dao_MainService.php'));
            yield 2 => ($this->privates['security.authentication.provider.anonymous.main'] ?? ($this->privates['security.authentication.provider.anonymous.main'] = new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider($this->getParameter('container.build_hash'))));
        }, 3), true);

        $instance->setEventDispatcher(($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()));

        return $instance;
    }

    /**
     * Gets the private 'security.logout_url_generator' shared service.
     *
     * @return \Symfony\Component\Security\Http\Logout\LogoutUrlGenerator
     */
    protected function getSecurity_LogoutUrlGeneratorService()
    {
        $this->privates['security.logout_url_generator'] = $instance = new \Symfony\Component\Security\Http\Logout\LogoutUrlGenerator(($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())), ($this->services['router'] ?? $this->getRouterService()), ($this->services['security.token_storage'] ?? ($this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())));

        $instance->registerListener('main', '/logout', 'logout', '_csrf_token', NULL, NULL);

        return $instance;
    }

    /**
     * Gets the private 'security.role_hierarchy' shared service.
     *
     * @return \Symfony\Component\Security\Core\Role\RoleHierarchy
     */
    protected function getSecurity_RoleHierarchyService()
    {
        return $this->privates['security.role_hierarchy'] = new \Symfony\Component\Security\Core\Role\RoleHierarchy($this->parameters['security.role_hierarchy.roles']);
    }

    /**
     * Gets the private 'sensio_framework_extra.controller.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener
     */
    protected function getSensioFrameworkExtra_Controller_ListenerService()
    {
        return $this->privates['sensio_framework_extra.controller.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener(($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService()));
    }

    /**
     * Gets the private 'sensio_framework_extra.converter.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener
     */
    protected function getSensioFrameworkExtra_Converter_ListenerService()
    {
        $a = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager();
        $a->add(new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter(($this->services['doctrine'] ?? $this->getDoctrineService()), NULL), 0, 'doctrine.orm');
        $a->add(new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter(), 0, 'datetime');
        $a->add(new \MsgPhp\User\Infra\Security\UserParamConverter(($this->services['security.token_storage'] ?? ($this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())), ($this->privates['MsgPhp\\User\\Infra\\Doctrine\\Repository\\UserRepository'] ?? $this->getUserRepositoryService()), ($this->privates['MsgPhp\\Domain\\Infra\\Doctrine\\EntityAwareFactory'] ?? $this->getEntityAwareFactoryService())), 0, 'msgphp.current_user');

        return $this->privates['sensio_framework_extra.converter.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener($a, true);
    }

    /**
     * Gets the private 'sensio_framework_extra.security.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener
     */
    protected function getSensioFrameworkExtra_Security_ListenerService()
    {
        return $this->privates['sensio_framework_extra.security.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener(($this->privates['framework_extra_bundle.argument_name_convertor'] ?? $this->getFrameworkExtraBundle_ArgumentNameConvertorService()), NULL, ($this->privates['security.authentication.trust_resolver'] ?? ($this->privates['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver('Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken', 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken'))), ($this->privates['security.role_hierarchy'] ?? $this->getSecurity_RoleHierarchyService()), ($this->services['security.token_storage'] ?? ($this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())), ($this->services['security.authorization_checker'] ?? $this->getSecurity_AuthorizationCheckerService()), ($this->privates['monolog.logger'] ?? $this->getMonolog_LoggerService()));
    }

    /**
     * Gets the private 'sensio_framework_extra.view.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\TemplateListener
     */
    protected function getSensioFrameworkExtra_View_ListenerService()
    {
        return $this->privates['sensio_framework_extra.view.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\TemplateListener(new \Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser(($this->services['kernel'] ?? $this->get('kernel', 1))), ($this->services['twig'] ?? $this->getTwigService()));
    }

    /**
     * Gets the private 'session_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\SessionListener
     */
    protected function getSessionListenerService()
    {
        return $this->privates['session_listener'] = new \Symfony\Component\HttpKernel\EventListener\SessionListener(new \Symfony\Component\DependencyInjection\ServiceLocator(['initialized_session' => function () {
            return ($this->services['session'] ?? null);
        }, 'session' => function () {
            return ($this->services['session'] ?? $this->load('getSessionService.php'));
        }]));
    }

    /**
     * Gets the private 'translator_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\TranslatorListener
     */
    protected function getTranslatorListenerService()
    {
        return $this->privates['translator_listener'] = new \Symfony\Component\HttpKernel\EventListener\TranslatorListener(($this->services['translator'] ?? $this->getTranslatorService()), ($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())));
    }

    public function getParameter($name)
    {
        $name = (string) $name;
        if (isset($this->buildParameters[$name])) {
            return $this->buildParameters[$name];
        }

        if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    public function hasParameter($name)
    {
        $name = (string) $name;
        if (isset($this->buildParameters[$name])) {
            return true;
        }

        return isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters);
    }

    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            foreach ($this->buildParameters as $name => $value) {
                $parameters[$name] = $value;
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = [
        'kernel.root_dir' => false,
        'kernel.project_dir' => false,
        'kernel.cache_dir' => false,
        'kernel.logs_dir' => false,
        'kernel.bundles_metadata' => false,
        'msgphp.doctrine.mapping_files' => false,
        'kernel.secret' => false,
        'session.save_path' => false,
        'validator.mapping.cache.file' => false,
        'translator.default_path' => false,
        'debug.container.dump' => false,
        'twig.default_path' => false,
        'doctrine.orm.proxy_dir' => false,
        'liip_monitor.view_template' => false,
    ];
    private $dynamicParameters = [];

    /**
     * Computes a dynamic parameter.
     *
     * @param string $name The name of the dynamic parameter to load
     *
     * @return mixed The value of the dynamic parameter
     *
     * @throws InvalidArgumentException When the dynamic parameter does not exist
     */
    private function getDynamicParameter($name)
    {
        switch ($name) {
            case 'kernel.root_dir': $value = ($this->targetDirs[3].'/src'); break;
            case 'kernel.project_dir': $value = $this->targetDirs[3]; break;
            case 'kernel.cache_dir': $value = $this->targetDirs[0]; break;
            case 'kernel.logs_dir': $value = ($this->targetDirs[2].'/log'); break;
            case 'kernel.bundles_metadata': $value = [
                'FrameworkBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/symfony/framework-bundle'),
                    'namespace' => 'Symfony\\Bundle\\FrameworkBundle',
                ],
                'TwigBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/symfony/twig-bundle'),
                    'namespace' => 'Symfony\\Bundle\\TwigBundle',
                ],
                'SensioFrameworkExtraBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/sensio/framework-extra-bundle'),
                    'namespace' => 'Sensio\\Bundle\\FrameworkExtraBundle',
                ],
                'DoctrineCacheBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/doctrine/doctrine-cache-bundle'),
                    'namespace' => 'Doctrine\\Bundle\\DoctrineCacheBundle',
                ],
                'DoctrineBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/doctrine/doctrine-bundle'),
                    'namespace' => 'Doctrine\\Bundle\\DoctrineBundle',
                ],
                'MsgPhpUserBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/msgphp/user-bundle'),
                    'namespace' => 'MsgPhp\\UserBundle',
                ],
                'SecurityBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/symfony/security-bundle'),
                    'namespace' => 'Symfony\\Bundle\\SecurityBundle',
                ],
                'AwsBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/aws/aws-sdk-php-symfony/src'),
                    'namespace' => 'Aws\\Symfony',
                ],
                'MonologBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/symfony/monolog-bundle'),
                    'namespace' => 'Symfony\\Bundle\\MonologBundle',
                ],
                'LiipMonitorBundle' => [
                    'path' => ($this->targetDirs[3].'/vendor/liip/monitor-bundle'),
                    'namespace' => 'Liip\\MonitorBundle',
                ],
            ]; break;
            case 'msgphp.doctrine.mapping_files': $value = [
                0 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.Credential.Email.orm.xml'),
                1 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.Credential.EmailPassword.orm.xml'),
                2 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.Credential.EmailSaltedPassword.orm.xml'),
                3 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.Credential.Nickname.orm.xml'),
                4 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.Credential.NicknamePassword.orm.xml'),
                5 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.Credential.NicknameSaltedPassword.orm.xml'),
                6 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.Credential.Token.orm.xml'),
                7 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.Role.orm.xml'),
                8 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.User.orm.xml'),
                9 => ($this->targetDirs[3].'/vendor/msgphp/user/Infra/Doctrine/Resources/dist-mapping/User.Entity.UserRole.orm.xml'),
            ]; break;
            case 'kernel.secret': $value = $this->getEnv('APP_SECRET'); break;
            case 'session.save_path': $value = ($this->targetDirs[2].'/sessions/prod'); break;
            case 'validator.mapping.cache.file': $value = ($this->targetDirs[0].'/validation.php'); break;
            case 'translator.default_path': $value = ($this->targetDirs[3].'/translations'); break;
            case 'debug.container.dump': $value = ($this->targetDirs[0].'/srcProdDebugProjectContainer.xml'); break;
            case 'twig.default_path': $value = ($this->targetDirs[3].'/templates'); break;
            case 'doctrine.orm.proxy_dir': $value = ($this->targetDirs[0].'/doctrine/orm/Proxies'); break;
            case 'liip_monitor.view_template': $value = ($this->targetDirs[3].'/vendor/liip/monitor-bundle/DependencyInjection/../Resources/views/health/index.html.php'); break;
            default: throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
        }
        $this->loadedDynamicParameters[$name] = true;

        return $this->dynamicParameters[$name] = $value;
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return [
            'kernel.environment' => 'prod',
            'kernel.debug' => true,
            'kernel.name' => 'src',
            'kernel.bundles' => [
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'TwigBundle' => 'Symfony\\Bundle\\TwigBundle\\TwigBundle',
                'SensioFrameworkExtraBundle' => 'Sensio\\Bundle\\FrameworkExtraBundle\\SensioFrameworkExtraBundle',
                'DoctrineCacheBundle' => 'Doctrine\\Bundle\\DoctrineCacheBundle\\DoctrineCacheBundle',
                'DoctrineBundle' => 'Doctrine\\Bundle\\DoctrineBundle\\DoctrineBundle',
                'MsgPhpUserBundle' => 'MsgPhp\\UserBundle\\MsgPhpUserBundle',
                'SecurityBundle' => 'Symfony\\Bundle\\SecurityBundle\\SecurityBundle',
                'AwsBundle' => 'Aws\\Symfony\\AwsBundle',
                'MonologBundle' => 'Symfony\\Bundle\\MonologBundle\\MonologBundle',
                'LiipMonitorBundle' => 'Liip\\MonitorBundle\\LiipMonitorBundle',
            ],
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'srcProdDebugProjectContainer',
            'container.autowiring.strict_mode' => true,
            'container.dumper.inline_class_loader' => true,
            'env(DATABASE_URL)' => '',
            'activity.current.dashboardUrl' => '<iframe id="powerbi_dashboard" width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiZWQ0OGQ3NDktNDllMy00NDVlLTgwNjItYzYxZWE0ZDc1ZDdjIiwidCI6ImM3ZGZjNTk1LWU4OWUtNDQ4Ni1iNGM0LWI0NmRhZmFjMmU5NSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>',
            'activity.history.dashboardUrl' => '<iframe id="powerbi_dashboard" width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiZWQ0OGQ3NDktNDllMy00NDVlLTgwNjItYzYxZWE0ZDc1ZDdjIiwidCI6ImM3ZGZjNTk1LWU4OWUtNDQ4Ni1iNGM0LWI0NmRhZmFjMmU5NSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>',
            'company.name' => 'OnCloudTime',
            'rdbms.port' => '3306',
            'rdbms.driver' => 'pdo_mysql',
            'rdbms.server_version' => '5.6',
            'dashboard.powerbiUrl' => '<iframe id="powerbi_dashboard" width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiZWQ0OGQ3NDktNDllMy00NDVlLTgwNjItYzYxZWE0ZDc1ZDdjIiwidCI6ImM3ZGZjNTk1LWU4OWUtNDQ4Ni1iNGM0LWI0NmRhZmFjMmU5NSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>',
            'nexus.powerbiUrl' => '<iframe id="powerbi_dashboard" width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiNTcwMTI1NWUtNjcyZS00MTU4LWFiYWEtZDA4MDgxMTNiMWU3IiwidCI6ImM3ZGZjNTk1LWU4OWUtNDQ4Ni1iNGM0LWI0NmRhZmFjMmU5NSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>',
            'aws.region' => 'us-east-1',
            'aws.version' => 'latest',
            'log.level' => 'info',
            's3.version' => 'latest',
            's3.region' => 'us-east-1',
            's3.presignduration' => 7890000,
            'session.lifetime.seconds' => 3600,
            'date.format' => 'm/d/Y',
            'shell' => [
                'accountCreateFile' => 'admin/createaccount.sh',
                'accountDeleteFile' => 'admin/deleteaccount.sh',
                'accountUpdateFile' => 'admin/updateaccount.sh',
                'adminResetFile' => 'admin/reset.sh',
                'appSetupFile' => 'admin/setup.sh',
                'athenaTableCreateFile' => 'createathenatable.sh',
                'athenaTableUpdateFile' => 'updateathenatable.sh',
                'conversionActivateFile' => 'admin/activateconversion.sh',
                'conversionCreateFile' => 'admin/createconversion.sh',
                'conversionDeleteFile' => 'admin/deleteconversion.sh',
                'conversionUpdateFile' => 'admin/updateconversion.sh',
                'fileuploadCreateFile' => 'createfileupload.sh',
                'fileuploadCopyToTemplate' => 'copyfiletotemplatefolder.sh',
                'fileuploadDelete' => 'deletefileupload.sh',
                'fileuploadRestore' => 'restorefileupload.sh',
                'filewatcherCreateFile' => 'createfilewatcher.sh',
                'filewatcherDeleteFile' => 'deletefilewatcher.sh',
                'filewatcherRunFile' => 'runfilewatcher.sh',
                'filewatcherUpdateFile' => 'updatefilewatcher.sh',
                'hadoopCreateFile' => 'createhadoop.sh',
                'hadoopStartFile' => 'starthadoop.sh',
                'hadoopStopFile' => 'stophadoop.sh',
                'mppCreateFile' => 'creatempp.sh',
                'mppStartFile' => 'startmpp.sh',
                'mppStopFile' => 'stopmpp.sh',
                'orcConversion' => 'orcConversion.sh',
                'parquetConversion' => 'parquetConversion.sh',
                'permissionsUpdateFile' => 'admin/updatepermission.sh',
                'projectAssignmentCreateFile' => 'createprojectassignment.sh',
                'projectAssignmentDeleteFile' => 'deleteprojectassignment.sh',
                'projectAssignmentUpdateFile' => 'updateprojectassignment.sh',
                'projectCreateFile' => 'createproject.sh',
                'projectDeleteFile' => 'deleteproject.sh',
                'projectUpdateFile' => 'updateproject.sh',
                'queryCreateFile' => 'createquery.sh',
                'queryDeleteFile' => 'deletequery.sh',
                'queryRunFile' => 'runQuery.sh',
                'queryUpdateFile' => 'updatequery.sh',
                'runNexusAnalysisFile' => 'runNexusAnalysis.sh',
                'getNexusAnalysisDates' => 'getNexusAnalysisDates.sh',
                'runNexusDataPreviewFile' => 'runNexusDataPreview.sh',
                'simulationCreateFile' => 'createsimulation.sh',
                'simulationDeleteFile' => 'deletesimulation.sh',
                'simulationRunFile' => 'runsimulation.sh',
                'simulationUpdateFile' => 'updatesimulation.sh',
                'tableSearchFile' => 'tablesearchfiles.sh',
                'taskCreateFile' => 'createtask.sh',
                'taskDeleteFile' => 'deletetask.sh',
                'taskUpdateFile' => 'updatetask.sh',
                'templateCreateFile' => 'createtemplate.sh',
                'templateDeleteFile' => 'deletetemplate.sh',
                'templateSyncFile' => 'synctemplate.sh',
                'templateUpdateFile' => 'updatetemplate.sh',
                'timesheetCreateFile' => 'createtimesheet.sh',
                'timesheetDeleteFile' => 'deletetimesheet.sh',
                'timesheetUpdateFile' => 'updatetimesheet.sh',
                'userChangePasswordFile' => 'admin/changeuserpassword.sh',
                'userCreateFile' => 'admin/createuser.sh',
                'userDeleteFile' => 'admin/deleteuser.sh',
                'userUpdateFile' => 'admin/updateuser.sh',
                'userForgotPasswordFile' => 'admin/forgotpassword.sh',
            ],
            'sns_topic_prefix' => 'oncloudtime-',
            'tables.long_text_display_characters' => 20,
            'tables.rows_per_page' => 7,
            'tables.templates_rows_per_page' => 4,
            'asset.image.login' => 'logo-no-words.png',
            'asset.image.sidebar' => 'logo-no-words.png',
            'nexus.template.samplerow' => 'State,Sales Price,Document Number,Document Date,Posting Date Alabama,420.33,INV303030030,12-15-18,12-15-18',
            'nexus.template.rules' => '{"columnname_4":"postingdate","datatype_4":"String","processing_4":"1","parameter_4":"","target_4":"postingdate","order_4":"4","columnname_0":"state","datatype_0":"String","processing_0":"1","parameter_0":"","target_0":"state","order_0":"0","columnname_1":"salesprice","datatype_1":"Double","processing_1":"1","parameter_1":"","target_1":"salesprice","order_1":"1","columnname_2":"documentnumber","datatype_2":"String","processing_2":"1","parameter_2":"","target_2":"documentnumber","order_2":"2","columnname_3":"documentdate","datatype_3":"String","processing_3":"1","parameter_3":"","target_3":"documentdate","order_3":"3"}',
            'nexus.analysis.query' => 'SELECT s.state, nn.transactions, nn.totalsales, (CASE WHEN nn.transactions > salestransactionsthreshold THEN \'Yes\' WHEN nn.transactions > nearingtransactioncountthreshold THEN \'Close\' ELSE \'No\' END) AS transaction_thresholds_met,  (CASE WHEN nn.totalsales > salesdollarsthreshold THEN \'Yes\' WHEN nn.totalsales > nearingsalesthreshold THEN \'Close\' ELSE \'No\' END) as sales_thresholds_met, s.salestransactionsthreshold, s.salesdollarsthreshold, s.nearingtransactioncountthreshold, s.nearingsalesthreshold FROM stateguide s INNER JOIN (SELECT n.state, count(n.salesprice) as transactions, SUM(n.salesprice) AS totalsales FROM #table_name# n #date_filter_string# GROUP BY n.state) AS nn ON s.state = nn.state #state_filter_string#',
            'nexus.dataprofile.query' => 'SELECT state, COUNT(state) as transaction_count, SUM(salesprice) AS total_sales, date_format(date_parse(documentdate, \'%m/%d/%Y\'), \'%m\') as month, date_format(date_parse(documentdate, \'%m/%d/%Y\'), \'%Y\') as year_value FROM #table_name# #filter_string# GROUP BY state, date_format(date_parse(documentdate, \'%m/%d/%Y\'), \'%m\'), date_format(date_parse(documentdate, \'%m/%d/%Y\'), \'%Y\') ORDER BY state',
            'nexus.dropdowndates.query' => 'SELECT DISTINCT date_format(date_trunc(\'month\', date_parse(documentdate, \'%m/%d/%Y\')), \'%Y-%m-%d\') as startdate, date_format(date_add(\'day\', -1, date_add(\'month\', 1, date_trunc(\'month\', date_parse(documentdate, \'%m/%d/%Y\')))), \'%Y-%m-%d\') as enddate FROM #table_name# ORDER BY startdate',
            'sidebar.activetext.color' => '#df4e71',
            'notification.success.color' => 'green',
            'notification.failed.color' => '#df4e71',
            'notification.info.color' => 'blue',
            'cognito.userpool.groupname' => 'oncloudtimePoolGroup',
            'cognito.userpool.name' => 'oncloudtime-user-pool-dev',
            'cognito.userpool.iamrolename' => 'oncloudtime-iam-role-dev',
            'cognito.userpool.clientname' => 'oncloudtime-client-app',
            'cognito.userpool.defaultuserpassword' => 'oc-APP-001',
            'rdbms_user' => 'root',
            'rdbms_password' => 'mysql',
            'rdbms_dbname' => 'oncloudtime',
            'rdbms_host' => 'localhost',
            'aws_credentials_key' => 'AKIAIZ6ENRM52CQMFSTA',
            'aws_credentials_secret' => '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',
            'athena_directory' => 'test',
            'athena_database' => 'test',
            'athena_input' => 's3://yuva-bucket/',
            'athena_output' => 's3://yuva-bucket/athena-output/',
            'sqs_notificationQueue' => 'https://sqs.us-east-1.amazonaws.com/590297375119/test-yuva',
            's3_bucket' => 'yuva-bucket',
            'need_update' => 'yes',
            'sns_general_topic' => 'arn:aws:sns:us-east-1:590297375119:test-sns',
            'cognito_pool_id' => 'us-east-1_CoYrJynGm',
            'cognito_pool_client_id' => '3246q2desfgnoboh1f5u9ugtm0',
            'locale' => 'en',
            'install_config_file' => 'install.yaml',
            'msgphp.doctrine.type_config' => [
                'msgphp_user_id' => [
                    'class' => 'MsgPhp\\User\\UserId',
                    'type' => 'integer',
                    'type_class' => 'MsgPhp\\User\\Infra\\Doctrine\\Type\\UserIdType',
                ],
            ],
            'fragment.renderer.hinclude.global_template' => '',
            'fragment.path' => '/_fragment',
            'kernel.http_method_override' => true,
            'kernel.trusted_hosts' => [

            ],
            'kernel.default_locale' => 'en',
            'templating.helper.code.file_link_format' => NULL,
            'debug.file_link_format' => NULL,
            'session.metadata.storage_key' => '_sf2_meta',
            'session.storage.options' => [
                'cache_limiter' => '0',
                'cookie_lifetime' => 3600,
                'cookie_httponly' => true,
                'gc_maxlifetime' => 3600,
                'gc_probability' => 1,
            ],
            'session.metadata.update_threshold' => '0',
            'form.type_extension.csrf.enabled' => true,
            'form.type_extension.csrf.field_name' => '_token',
            'asset.request_context.base_path' => '',
            'asset.request_context.secure' => false,
            'validator.mapping.cache.prefix' => '',
            'validator.translation_domain' => 'validators',
            'translator.logging' => false,
            'data_collector.templates' => [

            ],
            'debug.error_handler.throw_at' => -1,
            'router.request_context.host' => 'localhost',
            'router.request_context.scheme' => 'http',
            'router.request_context.base_url' => '',
            'router.resource' => 'kernel::loadRoutes',
            'router.cache_class_prefix' => 'srcProdDebugProjectContainer',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'twig.exception_listener.controller' => 'twig.controller.exception::showAction',
            'twig.form.resources' => [
                0 => 'form_div_layout.html.twig',
                1 => 'bootstrap_3_layout.html.twig',
            ],
            'doctrine_cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine_cache.apcu.class' => 'Doctrine\\Common\\Cache\\ApcuCache',
            'doctrine_cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine_cache.chain.class' => 'Doctrine\\Common\\Cache\\ChainCache',
            'doctrine_cache.couchbase.class' => 'Doctrine\\Common\\Cache\\CouchbaseCache',
            'doctrine_cache.couchbase.connection.class' => 'Couchbase',
            'doctrine_cache.couchbase.hostnames' => 'localhost:8091',
            'doctrine_cache.file_system.class' => 'Doctrine\\Common\\Cache\\FilesystemCache',
            'doctrine_cache.php_file.class' => 'Doctrine\\Common\\Cache\\PhpFileCache',
            'doctrine_cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine_cache.memcache.connection.class' => 'Memcache',
            'doctrine_cache.memcache.host' => 'localhost',
            'doctrine_cache.memcache.port' => 11211,
            'doctrine_cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine_cache.memcached.connection.class' => 'Memcached',
            'doctrine_cache.memcached.host' => 'localhost',
            'doctrine_cache.memcached.port' => 11211,
            'doctrine_cache.mongodb.class' => 'Doctrine\\Common\\Cache\\MongoDBCache',
            'doctrine_cache.mongodb.collection.class' => 'MongoCollection',
            'doctrine_cache.mongodb.connection.class' => 'MongoClient',
            'doctrine_cache.mongodb.server' => 'localhost:27017',
            'doctrine_cache.predis.client.class' => 'Predis\\Client',
            'doctrine_cache.predis.scheme' => 'tcp',
            'doctrine_cache.predis.host' => 'localhost',
            'doctrine_cache.predis.port' => 6379,
            'doctrine_cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine_cache.redis.connection.class' => 'Redis',
            'doctrine_cache.redis.host' => 'localhost',
            'doctrine_cache.redis.port' => 6379,
            'doctrine_cache.riak.class' => 'Doctrine\\Common\\Cache\\RiakCache',
            'doctrine_cache.riak.bucket.class' => 'Riak\\Bucket',
            'doctrine_cache.riak.connection.class' => 'Riak\\Connection',
            'doctrine_cache.riak.bucket_property_list.class' => 'Riak\\BucketPropertyList',
            'doctrine_cache.riak.host' => 'localhost',
            'doctrine_cache.riak.port' => 8087,
            'doctrine_cache.sqlite3.class' => 'Doctrine\\Common\\Cache\\SQLite3Cache',
            'doctrine_cache.sqlite3.connection.class' => 'SQLite3',
            'doctrine_cache.void.class' => 'Doctrine\\Common\\Cache\\VoidCache',
            'doctrine_cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine_cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine_cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine_cache.security.acl.cache.class' => 'Doctrine\\Bundle\\DoctrineCacheBundle\\Acl\\Model\\AclCache',
            'doctrine.dbal.logger.chain.class' => 'Doctrine\\DBAL\\Logging\\LoggerChain',
            'doctrine.dbal.logger.profiling.class' => 'Doctrine\\DBAL\\Logging\\DebugStack',
            'doctrine.dbal.logger.class' => 'Symfony\\Bridge\\Doctrine\\Logger\\DbalLogger',
            'doctrine.dbal.configuration.class' => 'Doctrine\\DBAL\\Configuration',
            'doctrine.data_collector.class' => 'Doctrine\\Bundle\\DoctrineBundle\\DataCollector\\DoctrineDataCollector',
            'doctrine.dbal.connection.event_manager.class' => 'Symfony\\Bridge\\Doctrine\\ContainerAwareEventManager',
            'doctrine.dbal.connection_factory.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ConnectionFactory',
            'doctrine.dbal.events.mysql_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\MysqlSessionInit',
            'doctrine.dbal.events.oracle_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\OracleSessionInit',
            'doctrine.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Registry',
            'doctrine.entity_managers' => [
                'default' => 'doctrine.orm.default_entity_manager',
            ],
            'doctrine.default_entity_manager' => 'default',
            'doctrine.dbal.connection_factory.types' => [
                'msgphp_user_id' => [
                    'class' => 'MsgPhp\\User\\Infra\\Doctrine\\Type\\UserIdType',
                    'commented' => NULL,
                ],
            ],
            'doctrine.connections' => [
                'default' => 'doctrine.dbal.default_connection',
            ],
            'doctrine.default_connection' => 'default',
            'doctrine.orm.configuration.class' => 'Doctrine\\ORM\\Configuration',
            'doctrine.orm.entity_manager.class' => 'Doctrine\\ORM\\EntityManager',
            'doctrine.orm.manager_configurator.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ManagerConfigurator',
            'doctrine.orm.cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine.orm.cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine.orm.cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine.orm.cache.memcache_host' => 'localhost',
            'doctrine.orm.cache.memcache_port' => 11211,
            'doctrine.orm.cache.memcache_instance.class' => 'Memcache',
            'doctrine.orm.cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine.orm.cache.memcached_host' => 'localhost',
            'doctrine.orm.cache.memcached_port' => 11211,
            'doctrine.orm.cache.memcached_instance.class' => 'Memcached',
            'doctrine.orm.cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine.orm.cache.redis_host' => 'localhost',
            'doctrine.orm.cache.redis_port' => 6379,
            'doctrine.orm.cache.redis_instance.class' => 'Redis',
            'doctrine.orm.cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine.orm.cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine.orm.cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine.orm.metadata.driver_chain.class' => 'Doctrine\\Common\\Persistence\\Mapping\\Driver\\MappingDriverChain',
            'doctrine.orm.metadata.annotation.class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
            'doctrine.orm.metadata.xml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedXmlDriver',
            'doctrine.orm.metadata.yml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedYamlDriver',
            'doctrine.orm.metadata.php.class' => 'Doctrine\\ORM\\Mapping\\Driver\\PHPDriver',
            'doctrine.orm.metadata.staticphp.class' => 'Doctrine\\ORM\\Mapping\\Driver\\StaticPHPDriver',
            'doctrine.orm.proxy_cache_warmer.class' => 'Symfony\\Bridge\\Doctrine\\CacheWarmer\\ProxyCacheWarmer',
            'form.type_guesser.doctrine.class' => 'Symfony\\Bridge\\Doctrine\\Form\\DoctrineOrmTypeGuesser',
            'doctrine.orm.validator.unique.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator',
            'doctrine.orm.validator_initializer.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\DoctrineInitializer',
            'doctrine.orm.security.user.provider.class' => 'Symfony\\Bridge\\Doctrine\\Security\\User\\EntityUserProvider',
            'doctrine.orm.listeners.resolve_target_entity.class' => 'Doctrine\\ORM\\Tools\\ResolveTargetEntityListener',
            'doctrine.orm.listeners.attach_entity_listeners.class' => 'Doctrine\\ORM\\Tools\\AttachEntityListenersListener',
            'doctrine.orm.naming_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultNamingStrategy',
            'doctrine.orm.naming_strategy.underscore.class' => 'Doctrine\\ORM\\Mapping\\UnderscoreNamingStrategy',
            'doctrine.orm.quote_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultQuoteStrategy',
            'doctrine.orm.quote_strategy.ansi.class' => 'Doctrine\\ORM\\Mapping\\AnsiQuoteStrategy',
            'doctrine.orm.entity_listener_resolver.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Mapping\\ContainerEntityListenerResolver',
            'doctrine.orm.second_level_cache.default_cache_factory.class' => 'Doctrine\\ORM\\Cache\\DefaultCacheFactory',
            'doctrine.orm.second_level_cache.default_region.class' => 'Doctrine\\ORM\\Cache\\Region\\DefaultRegion',
            'doctrine.orm.second_level_cache.filelock_region.class' => 'Doctrine\\ORM\\Cache\\Region\\FileLockRegion',
            'doctrine.orm.second_level_cache.logger_chain.class' => 'Doctrine\\ORM\\Cache\\Logging\\CacheLoggerChain',
            'doctrine.orm.second_level_cache.logger_statistics.class' => 'Doctrine\\ORM\\Cache\\Logging\\StatisticsCacheLogger',
            'doctrine.orm.second_level_cache.cache_configuration.class' => 'Doctrine\\ORM\\Cache\\CacheConfiguration',
            'doctrine.orm.second_level_cache.regions_configuration.class' => 'Doctrine\\ORM\\Cache\\RegionsConfiguration',
            'doctrine.orm.auto_generate_proxy_classes' => true,
            'doctrine.orm.proxy_namespace' => 'Proxies',
            'msgphp.domain.class_mapping' => [
                'MsgPhp\\User\\Entity\\Role' => 'App\\Entity\\User\\Role',
                'MsgPhp\\User\\Entity\\UserRole' => 'App\\Entity\\User\\UserRole',
                'MsgPhp\\User\\Entity\\User' => 'App\\Entity\\User\\AppUser',
                'MsgPhp\\User\\UserIdInterface' => 'MsgPhp\\User\\UserId',
                'MsgPhp\\User\\CredentialInterface' => 'MsgPhp\\User\\Entity\\Credential\\EmailPassword',
            ],
            'msgphp.domain.id_class_mapping' => [
                'MsgPhp\\User\\Entity\\User' => 'MsgPhp\\User\\UserIdInterface',
                'App\\Entity\\User\\AppUser' => 'MsgPhp\\User\\UserIdInterface',
            ],
            'msgphp.domain.identity_mapping' => [
                'MsgPhp\\User\\Entity\\Role' => [
                    0 => 'name',
                ],
                'MsgPhp\\User\\Entity\\UserAttributeValue' => [
                    0 => 'attributeValue',
                ],
                'MsgPhp\\User\\Entity\\User' => [
                    0 => 'id',
                ],
                'MsgPhp\\User\\Entity\\Username' => [
                    0 => 'username',
                ],
                'MsgPhp\\User\\Entity\\UserRole' => [
                    0 => 'user',
                    1 => 'role',
                ],
                'MsgPhp\\User\\Entity\\UserEmail' => [
                    0 => 'email',
                ],
                'App\\Entity\\User\\Role' => [
                    0 => 'name',
                ],
                'App\\Entity\\User\\AppUser' => [
                    0 => 'id',
                ],
                'App\\Entity\\User\\UserRole' => [
                    0 => 'user',
                    1 => 'role',
                ],
            ],
            'msgphp.domain.events' => [
                0 => 'MsgPhp\\User\\Event\\UserAttributeValueAddedEvent',
                1 => 'MsgPhp\\User\\Event\\UserAttributeValueChangedEvent',
                2 => 'MsgPhp\\User\\Event\\UserAttributeValueDeletedEvent',
                3 => 'MsgPhp\\User\\Event\\UserConfirmedEvent',
                4 => 'MsgPhp\\User\\Event\\UserCreatedEvent',
                5 => 'MsgPhp\\User\\Event\\UserCredentialChangedEvent',
                6 => 'MsgPhp\\User\\Event\\UserDeletedEvent',
                7 => 'MsgPhp\\User\\Event\\UserDisabledEvent',
                8 => 'MsgPhp\\User\\Event\\UserEmailAddedEvent',
                9 => 'MsgPhp\\User\\Event\\UserEmailConfirmedEvent',
                10 => 'MsgPhp\\User\\Event\\UserEmailDeletedEvent',
                11 => 'MsgPhp\\User\\Event\\UserEnabledEvent',
                12 => 'MsgPhp\\User\\Event\\UserPasswordRequestedEvent',
                13 => 'MsgPhp\\User\\Event\\UserRoleAddedEvent',
                14 => 'MsgPhp\\User\\Event\\UserRoleDeletedEvent',
                15 => 'MsgPhp\\Domain\\Event\\ProjectionDocumentDeletedEvent',
                16 => 'MsgPhp\\Domain\\Event\\ProjectionDocumentSavedEvent',
            ],
            'security.authentication.trust_resolver.anonymous_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken',
            'security.authentication.trust_resolver.rememberme_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken',
            'security.role_hierarchy.roles' => [
                'ROLE_SUPER_ADMIN' => [
                    0 => 'ROLE_ADMIN',
                ],
                'ROLE_ADMIN' => [
                    0 => 'ROLE_USER',
                ],
            ],
            'security.access.denied_url' => NULL,
            'security.authentication.manager.erase_credentials' => true,
            'security.authentication.session_strategy.strategy' => 'migrate',
            'security.access.always_authenticate_before_granting' => false,
            'security.authentication.hide_user_not_found' => true,
            'aws_sdk.class' => 'Aws\\Sdk',
            'monolog.use_microseconds' => true,
            'monolog.swift_mailer.handlers' => [

            ],
            'monolog.handlers_to_channels' => [
                'monolog.handler.cloudwatch' => NULL,
                'monolog.handler.console' => [
                    'type' => 'exclusive',
                    'elements' => [
                        0 => 'event',
                        1 => 'doctrine',
                    ],
                ],
                'monolog.handler.container_logs' => NULL,
                'monolog.handler.main' => NULL,
                'monolog.handler.app' => [
                    'type' => 'inclusive',
                    'elements' => [
                        0 => 'app',
                    ],
                ],
            ],
            'liip_monitor.runner.class' => 'r',
            'liip_monitor.default_group' => 'default',
            'liip_monitor.check.php_extensions.default' => [
                0 => 'mysqlnd',
            ],
            'liip_monitor.check.php_extensions.0.default' => 'mysqlnd',
            'liip_monitor.checks' => [
                'groups' => [
                    'default' => [
                        'php_extensions' => [
                            0 => 'mysqlnd',
                        ],
                    ],
                ],
            ],
            'liip_monitor.runners' => [
                0 => 'liip_monitor.runner_default',
            ],
            'console.command.ids' => [
                0 => 'console.command.public_alias.doctrine_cache.contains_command',
                1 => 'console.command.public_alias.doctrine_cache.delete_command',
                2 => 'console.command.public_alias.doctrine_cache.flush_command',
                3 => 'console.command.public_alias.doctrine_cache.stats_command',
            ],
        ];
    }
}
