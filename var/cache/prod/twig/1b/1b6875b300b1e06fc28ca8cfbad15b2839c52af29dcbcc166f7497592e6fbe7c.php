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

/* no_install.twig */
class __TwigTemplate_330486cd04cc3b740e7e60223a77523c6886fade8979185d01350cef39c7e551 extends \Twig\Template
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
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "no_install.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "no_install.twig", 1);
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
        echo "<div class=\"wrapper wrapper-full-page\">
    <div class=\"full-page login-page\" data-color=\"white\">
        <!--   you can change the color of the filter page using: data-color=\"blue | azure | green | orange | red | purple\" -->
        <div class=\"content\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 text-center\">
                        <a href=\"";
        // line 10
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard");
        echo "\">
                        <img id=\"login-logo\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("img/" . (isset($context["asset_image_login"]) || array_key_exists("asset_image_login", $context) ? $context["asset_image_login"] : (function () { throw new RuntimeError('Variable "asset_image_login" does not exist.', 11, $this->source); })()))), "html", null, true);
        echo "\"  />
                        </a>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3\">
                        <div class=\"card\" data-background=\"color\" data-color=\"orange\">
                            <div class=\"card-header\">
                                <h3 class=\"card-title\">Installer locked</h3>
                            </div>
                            <div class=\"card-content\">
                                The installer has been locked wizard is not available please contact your system administrator to enable it
                            </div>
                            <div class=\"card-footer\">
                                Click here to <a class=\"btn btn-info btn-primary btn-fill\" href=\"";
        // line 25
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard");
        echo "\">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "no_install.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 25,  72 => 11,  68 => 10,  59 => 3,  52 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}
{% block body %}
<div class=\"wrapper wrapper-full-page\">
    <div class=\"full-page login-page\" data-color=\"white\">
        <!--   you can change the color of the filter page using: data-color=\"blue | azure | green | orange | red | purple\" -->
        <div class=\"content\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 text-center\">
                        <a href=\"{{ path('dashboard') }}\">
                        <img id=\"login-logo\" src=\"{{  asset('img/'~asset_image_login) }}\"  />
                        </a>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3\">
                        <div class=\"card\" data-background=\"color\" data-color=\"orange\">
                            <div class=\"card-header\">
                                <h3 class=\"card-title\">Installer locked</h3>
                            </div>
                            <div class=\"card-content\">
                                The installer has been locked wizard is not available please contact your system administrator to enable it
                            </div>
                            <div class=\"card-footer\">
                                Click here to <a class=\"btn btn-info btn-primary btn-fill\" href=\"{{ path('dashboard') }}\">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{%  endblock %}", "no_install.twig", "/data/personal/docker-app/templates/no_install.twig");
    }
}
