<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* install.twig */
class __TwigTemplate_b23729ff0158a5c7bed324d62a8000223ff354da1bdf32b523d5966cebf754d3 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
            'custom_javascript' => [$this, 'block_custom_javascript'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "install.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "install.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 3
        echo "<div class=\"container-fluid\">
\t<div class=\"row\">
\t\t<div class=\"col-md-8 col-md-offset-2\">
\t\t\t<div class=\"card card-wizard\" id=\"wizardCard\">
\t\t\t\t<form id=\"wizardForm\" method=\"POST\" action=\"updateconfig\">
\t\t\t\t\t<div class=\"text-center\">
\t\t\t\t\t\t<img src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("img/" . (isset($context["asset_image_login"]) || array_key_exists("asset_image_login", $context) ? $context["asset_image_login"] : (function () { throw new RuntimeError('Variable "asset_image_login" does not exist.', 9, $this->source); })()))), "html", null, true);
        echo "\"  />
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"card-header text-center\">
\t\t\t\t\t\t<h4 class=\"card-title\">Configuration</h4>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"card-content\">
\t\t\t\t\t\t<ul class=\"nav\">
\t\t\t\t\t\t\t<li><a href=\"#tab5\" data-toggle=\"tab\">Instructions</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab1\" data-toggle=\"tab\">Database</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab2\" data-toggle=\"tab\">S3</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab3\" data-toggle=\"tab\">Athena</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab4\" data-toggle=\"tab\">Queue</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab6\" data-toggle=\"tab\">Notification</a></li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t\t<div class=\"tab-content\">
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab5\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Please read the instructions carefully before proceeding.</h5>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t1. Create S3, SQS, Athena services and SNS topic.<br />
\t\t\t\t\t\t\t\t\t2. Create Aurora database and ensure access to it from public addresses.<br />
\t\t\t\t\t\t\t\t\t3. Provide the details asked in forthcoming steps respectively for successful installation.
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div id=\"error_contents\" class=\"row error\">
\t\t\t\t\t\t\t\t\t";
        // line 32
        echo (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 32, $this->source); })());
        echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab1\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tHost Name<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"rdbms_host\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 47
        echo twig_escape_filter($this->env, (isset($context["rdbms_host"]) || array_key_exists("rdbms_host", $context) ? $context["rdbms_host"] : (function () { throw new RuntimeError('Variable "rdbms_host" does not exist.', 47, $this->source); })()), "html", null, true);
        echo "\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tDatabase<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"rdbms_dbname\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 59
        echo twig_escape_filter($this->env, (isset($context["rdbms_dbname"]) || array_key_exists("rdbms_dbname", $context) ? $context["rdbms_dbname"] : (function () { throw new RuntimeError('Variable "rdbms_dbname" does not exist.', 59, $this->source); })()), "html", null, true);
        echo "\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tUsername<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"rdbms_user\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 73
        echo twig_escape_filter($this->env, (isset($context["rdbms_user"]) || array_key_exists("rdbms_user", $context) ? $context["rdbms_user"] : (function () { throw new RuntimeError('Variable "rdbms_user" does not exist.', 73, $this->source); })()), "html", null, true);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-check\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tPassword<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"password\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"rdbms_password\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 85
        echo twig_escape_filter($this->env, (isset($context["rdbms_password"]) || array_key_exists("rdbms_password", $context) ? $context["rdbms_password"] : (function () { throw new RuntimeError('Variable "rdbms_password" does not exist.', 85, $this->source); })()), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<!-- This will be displayed later when functionality to update a configuration is added -->
\t\t\t\t\t\t\t\t<div class=\"row hidden\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-10 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-check\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"1\" class=\"form-check-input\" name=\"setupdb\" checked=\"checked\"/>&nbsp;Setup new database (This will delete any existing data in the provided database)
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab2\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tKey<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"aws_credentials_key\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 113
        echo twig_escape_filter($this->env, (isset($context["aws_credentials_key"]) || array_key_exists("aws_credentials_key", $context) ? $context["aws_credentials_key"] : (function () { throw new RuntimeError('Variable "aws_credentials_key" does not exist.', 113, $this->source); })()), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tSecret<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<!--     IMPORTANT! - the \"bootstrap select picker\" is not compatible with jquery.validation.js, that's why we use the \"default select\" inside this wizard. We will try to contact the guys who are responsibble for the \"bootstrap select picker\" to find a solution. Thank you for your patience.
\t\t\t\t\t\t\t\t\t\t\t -->
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"aws_credentials_secret\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 128
        echo twig_escape_filter($this->env, (isset($context["aws_credentials_secret"]) || array_key_exists("aws_credentials_secret", $context) ? $context["aws_credentials_secret"] : (function () { throw new RuntimeError('Variable "aws_credentials_secret" does not exist.', 128, $this->source); })()), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-10 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tBucket<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<!--     IMPORTANT! - the \"bootstrap select picker\" is not compatible with jquery.validation.js, that's why we use the \"default select\" inside this wizard. We will try to contact the guys who are responsibble for the \"bootstrap select picker\" to find a solution. Thank you for your patience.
\t\t\t\t\t\t\t\t\t\t\t -->
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"s3_bucket\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 145
        echo twig_escape_filter($this->env, (isset($context["s3_bucket"]) || array_key_exists("s3_bucket", $context) ? $context["s3_bucket"] : (function () { throw new RuntimeError('Variable "s3_bucket" does not exist.', 145, $this->source); })()), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab3\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<p class=\"text-center\">Please start the athena service before completing this wizrd in AWS.</p>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tAthena Directory<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"athena_directory\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 164
        echo twig_escape_filter($this->env, (isset($context["athena_directory"]) || array_key_exists("athena_directory", $context) ? $context["athena_directory"] : (function () { throw new RuntimeError('Variable "athena_directory" does not exist.', 164, $this->source); })()), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tDatabase<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<!--     IMPORTANT! - the \"bootstrap select picker\" is not compatible with jquery.validation.js, that's why we use the \"default select\" inside this wizard. We will try to contact the guys who are responsibble for the \"bootstrap select picker\" to find a solution. Thank you for your patience.
\t\t\t\t\t\t\t\t\t\t\t -->
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"athena_database\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 179
        echo twig_escape_filter($this->env, (isset($context["athena_database"]) || array_key_exists("athena_database", $context) ? $context["athena_database"] : (function () { throw new RuntimeError('Variable "athena_database" does not exist.', 179, $this->source); })()), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab4\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<p class=\"text-center\">Get the queue url from created sqs queue in AWS</p>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-10 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tQueue URL<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"sqs_notificationQueue\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   url=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 199
        echo twig_escape_filter($this->env, (isset($context["sqs_notificationQueue"]) || array_key_exists("sqs_notificationQueue", $context) ? $context["sqs_notificationQueue"] : (function () { throw new RuntimeError('Variable "sqs_notificationQueue" does not exist.', 199, $this->source); })()), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t   placeholder=\"https://sqs.us-east-1.amazonaws.com/123456789012/oncloudtime\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab6\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<p class=\"text-center\">Get the ARN for the default SNS Topic AWS</p>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-10 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tTopic ARN<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"sns_general_topic\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"";
        // line 219
        echo twig_escape_filter($this->env, (isset($context["sns_general_topic"]) || array_key_exists("sns_general_topic", $context) ? $context["sns_general_topic"] : (function () { throw new RuntimeError('Variable "sns_general_topic" does not exist.', 219, $this->source); })()), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t   placeholder=\"arn:aws:sns:us-east-1:123456789012:oncloudtime-global\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"card-footer\">
\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default btn-fill btn-wd btn-back pull-left\">Back</button>
\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-info btn-fill btn-wd btn-next pull-right\">Next</button>
\t\t\t\t\t\t<button type=\"button\" class=\"finish btn btn-info btn-fill btn-wd btn-finish pull-right\" >Finish</button>
\t\t\t\t\t\t<div class=\"clearfix\"></div>
\t\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 240
    public function block_custom_javascript($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "custom_javascript"));

        // line 241
        echo "<script type=\"text/javascript\">
        \$(document).ready(function(){
\t\t\tdemo.initWizard();
            \$(document).on('click','.finish', function(){
                \$('#wizardForm').submit();
            });
\t\t});
\t</script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "install.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  349 => 241,  342 => 240,  314 => 219,  291 => 199,  268 => 179,  250 => 164,  228 => 145,  208 => 128,  190 => 113,  159 => 85,  144 => 73,  127 => 59,  112 => 47,  94 => 32,  68 => 9,  60 => 3,  53 => 2,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}
{% block body %}
<div class=\"container-fluid\">
\t<div class=\"row\">
\t\t<div class=\"col-md-8 col-md-offset-2\">
\t\t\t<div class=\"card card-wizard\" id=\"wizardCard\">
\t\t\t\t<form id=\"wizardForm\" method=\"POST\" action=\"updateconfig\">
\t\t\t\t\t<div class=\"text-center\">
\t\t\t\t\t\t<img src=\"{{  asset('img/'~asset_image_login) }}\"  />
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"card-header text-center\">
\t\t\t\t\t\t<h4 class=\"card-title\">Configuration</h4>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"card-content\">
\t\t\t\t\t\t<ul class=\"nav\">
\t\t\t\t\t\t\t<li><a href=\"#tab5\" data-toggle=\"tab\">Instructions</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab1\" data-toggle=\"tab\">Database</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab2\" data-toggle=\"tab\">S3</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab3\" data-toggle=\"tab\">Athena</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab4\" data-toggle=\"tab\">Queue</a></li>
\t\t\t\t\t\t\t<li><a href=\"#tab6\" data-toggle=\"tab\">Notification</a></li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t\t<div class=\"tab-content\">
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab5\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Please read the instructions carefully before proceeding.</h5>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t1. Create S3, SQS, Athena services and SNS topic.<br />
\t\t\t\t\t\t\t\t\t2. Create Aurora database and ensure access to it from public addresses.<br />
\t\t\t\t\t\t\t\t\t3. Provide the details asked in forthcoming steps respectively for successful installation.
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div id=\"error_contents\" class=\"row error\">
\t\t\t\t\t\t\t\t\t{{  error | raw}}
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab1\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tHost Name<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"rdbms_host\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{rdbms_host}}\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tDatabase<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"rdbms_dbname\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{rdbms_dbname}}\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tUsername<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"rdbms_user\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{rdbms_user}}\"/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-check\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tPassword<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"password\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"rdbms_password\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{rdbms_password}}\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<!-- This will be displayed later when functionality to update a configuration is added -->
\t\t\t\t\t\t\t\t<div class=\"row hidden\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-10 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-check\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"1\" class=\"form-check-input\" name=\"setupdb\" checked=\"checked\"/>&nbsp;Setup new database (This will delete any existing data in the provided database)
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab2\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tKey<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"aws_credentials_key\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{aws_credentials_key}}\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tSecret<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<!--     IMPORTANT! - the \"bootstrap select picker\" is not compatible with jquery.validation.js, that's why we use the \"default select\" inside this wizard. We will try to contact the guys who are responsibble for the \"bootstrap select picker\" to find a solution. Thank you for your patience.
\t\t\t\t\t\t\t\t\t\t\t -->
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"aws_credentials_secret\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{aws_credentials_secret}}\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-10 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tBucket<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<!--     IMPORTANT! - the \"bootstrap select picker\" is not compatible with jquery.validation.js, that's why we use the \"default select\" inside this wizard. We will try to contact the guys who are responsibble for the \"bootstrap select picker\" to find a solution. Thank you for your patience.
\t\t\t\t\t\t\t\t\t\t\t -->
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"s3_bucket\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{s3_bucket}}\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab3\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<p class=\"text-center\">Please start the athena service before completing this wizrd in AWS.</p>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tAthena Directory<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"athena_directory\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{athena_directory}}\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-5\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tDatabase<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<!--     IMPORTANT! - the \"bootstrap select picker\" is not compatible with jquery.validation.js, that's why we use the \"default select\" inside this wizard. We will try to contact the guys who are responsibble for the \"bootstrap select picker\" to find a solution. Thank you for your patience.
\t\t\t\t\t\t\t\t\t\t\t -->
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"athena_database\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{athena_database}}\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab4\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<p class=\"text-center\">Get the queue url from created sqs queue in AWS</p>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-10 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tQueue URL<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"sqs_notificationQueue\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   url=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{sqs_notificationQueue}}\"
\t\t\t\t\t\t\t\t\t\t\t\t   placeholder=\"https://sqs.us-east-1.amazonaws.com/123456789012/oncloudtime\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"tab-pane\" id=\"tab6\">
\t\t\t\t\t\t\t\t<h5 class=\"text-center\">Provide the configurations by completing this wizard.</h5>
\t\t\t\t\t\t\t\t<p class=\"text-center\">Get the ARN for the default SNS Topic AWS</p>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-10 col-md-offset-1\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">
\t\t\t\t\t\t\t\t\t\t\t\tTopic ARN<star>*</star>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\"
\t\t\t\t\t\t\t\t\t\t\t\t   type=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t   name=\"sns_general_topic\"
\t\t\t\t\t\t\t\t\t\t\t\t   required=\"true\"
\t\t\t\t\t\t\t\t\t\t\t\t   value=\"{{sns_general_topic}}\"
\t\t\t\t\t\t\t\t\t\t\t\t   placeholder=\"arn:aws:sns:us-east-1:123456789012:oncloudtime-global\"
\t\t\t\t\t\t\t\t\t\t\t/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"card-footer\">
\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default btn-fill btn-wd btn-back pull-left\">Back</button>
\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-info btn-fill btn-wd btn-next pull-right\">Next</button>
\t\t\t\t\t\t<button type=\"button\" class=\"finish btn btn-info btn-fill btn-wd btn-finish pull-right\" >Finish</button>
\t\t\t\t\t\t<div class=\"clearfix\"></div>
\t\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
{% endblock body %}
{% block custom_javascript %}
<script type=\"text/javascript\">
        \$(document).ready(function(){
\t\t\tdemo.initWizard();
            \$(document).on('click','.finish', function(){
                \$('#wizardForm').submit();
            });
\t\t});
\t</script>
{%  endblock custom_javascript %}", "install.twig", "/data/personal/docker-app/templates/install.twig");
    }
}
