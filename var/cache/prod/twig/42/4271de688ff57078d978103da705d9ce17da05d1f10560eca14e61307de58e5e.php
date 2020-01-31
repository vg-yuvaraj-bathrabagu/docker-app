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

/* header.twig */
class __TwigTemplate_9baea11b9e7f7056fd4c4fbe17fadc3bc4c9760f2c95cb27d4c8b61979ef2c96 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "header.twig"));

        // line 2
        echo "<meta charset=\"utf-8\"/>
<link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/apple-icon.png"), "html", null, true);
        echo "\">
<link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/favicon.png"), "html", null, true);
        echo "\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\"/>

<title>OnCloudTime</title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
<meta name=\"viewport\" content=\"width=device-width\"/>

<!-- Bootstrap core CSS     -->
<link href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\"/>

<link href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/paper-dashboard.css"), "html", null, true);
        echo "\" rel=\"stylesheet\"/>

<!--  Fonts and icons     -->
<link href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/font-awesome.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
<link href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/themify-icons.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

<!-- Notification just like LinkedIn counter -->
<link href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/bootstrap-notifications.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

<link href=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/oncloudtime.css"), "html", null, true);
        echo "\" rel=\"stylesheet\"/>

<style type=\"text/css\">
    /* color for active links */
    .sidebar[data-background-color=\"brown\"][data-active-color=\"danger\"] .nav li.active > a,
    .off-canvas-sidebar[data-background-color=\"brown\"][data-active-color=\"danger\"] .nav li.active > a {
        color: ";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["sidebar_activetext_color"]) || array_key_exists("sidebar_activetext_color", $context) ? $context["sidebar_activetext_color"] : (function () { throw new RuntimeError('Variable "sidebar_activetext_color" does not exist.', 31, $this->source); })()), "html", null, true);
        echo ";
        opacity: 1;
    }
</style>



";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 31,  86 => 25,  81 => 23,  75 => 20,  70 => 18,  64 => 15,  59 => 13,  47 => 4,  43 => 3,  40 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# Contents of the header tag #}
<meta charset=\"utf-8\"/>
<link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"{{ asset('img/apple-icon.png') }}\">
<link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"{{ asset('img/favicon.png') }}\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\"/>

<title>OnCloudTime</title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
<meta name=\"viewport\" content=\"width=device-width\"/>

<!-- Bootstrap core CSS     -->
<link href=\"{{ asset('css/bootstrap.min.css') }}\" rel=\"stylesheet\"/>

<link href=\"{{ asset('css/paper-dashboard.css') }}\" rel=\"stylesheet\"/>

<!--  Fonts and icons     -->
<link href=\"{{ asset('css/font-awesome.min.css') }}\" rel=\"stylesheet\">
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
<link href=\"{{ asset('css/themify-icons.css') }}\" rel=\"stylesheet\">

<!-- Notification just like LinkedIn counter -->
<link href=\"{{ asset('css/bootstrap-notifications.min.css') }}\" rel=\"stylesheet\">

<link href=\"{{ asset('css/oncloudtime.css') }}\" rel=\"stylesheet\"/>

<style type=\"text/css\">
    /* color for active links */
    .sidebar[data-background-color=\"brown\"][data-active-color=\"danger\"] .nav li.active > a,
    .off-canvas-sidebar[data-background-color=\"brown\"][data-active-color=\"danger\"] .nav li.active > a {
        color: {{ sidebar_activetext_color }};
        opacity: 1;
    }
</style>



", "header.twig", "/data/personal/docker-app/templates/header.twig");
    }
}
