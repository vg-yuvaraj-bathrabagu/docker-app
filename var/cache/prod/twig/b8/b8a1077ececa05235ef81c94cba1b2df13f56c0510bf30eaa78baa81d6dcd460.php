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

/* install_success.twig */
class __TwigTemplate_1fa0c2ad88b5d42107ccdacc744a5ee4b902441f495f206217853f9414a665f3 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
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
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "install_success.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "install_success.twig", 1);
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
\t\t<div class=\"col-md-6 col-md-offset-2\">
\t\t\t<div class=\"text-center\">
\t\t\t\t<img id=\"login-logo\" src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("img/" . (isset($context["asset_image_login"]) || array_key_exists("asset_image_login", $context) ? $context["asset_image_login"] : (function () { throw new RuntimeError('Variable "asset_image_login" does not exist.', 7, $this->source); })()))), "html", null, true);
        echo "\"  />
\t\t\t</div>
\t\t\t<div class=\"card card-wizard\" id=\"wizardCard\">

\t\t\t\t\t<div class=\"card-header text-center\">
\t\t\t\t\t\t<h4 class=\"card-title\">Installation Successful</h4>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"card-content text-center\">
\t\t\t\t\t\t<a href=\"login\" class=\"finish btn btn-info btn-fill btn-wd\" >Continue to login page</a>
\t\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "install_success.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 7,  59 => 3,  52 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}
{% block body %}
<div class=\"container-fluid\">
\t<div class=\"row\">
\t\t<div class=\"col-md-6 col-md-offset-2\">
\t\t\t<div class=\"text-center\">
\t\t\t\t<img id=\"login-logo\" src=\"{{  asset('img/'~asset_image_login) }}\"  />
\t\t\t</div>
\t\t\t<div class=\"card card-wizard\" id=\"wizardCard\">

\t\t\t\t\t<div class=\"card-header text-center\">
\t\t\t\t\t\t<h4 class=\"card-title\">Installation Successful</h4>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"card-content text-center\">
\t\t\t\t\t\t<a href=\"login\" class=\"finish btn btn-info btn-fill btn-wd\" >Continue to login page</a>
\t\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
{% endblock body %}", "install_success.twig", "/data/personal/docker-app/templates/install_success.twig");
    }
}
