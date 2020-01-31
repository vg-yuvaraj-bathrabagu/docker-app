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

/* user/forgot_password.html.twig */
class __TwigTemplate_b1777cafc72c5b0b895f4ae5e717ea064a8c53647adc4301cd65e37d27e3f2f3 extends \Twig\Template
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
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/forgot_password.html.twig"));

        // line 2
        $this->env->getRuntime("Symfony\\Component\\Form\\FormRenderer")->setTheme((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 2, $this->source); })()), [0 => "bootstrap_3_layout.html.twig"], true);
        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "user/forgot_password.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<div class=\"wrapper wrapper-full-page\">
    <div class=\"full-page login-page\" data-color=\"white\">
        <!--   you can change the color of the filter page using: data-color=\"blue | azure | green | orange | red | purple\" -->
        <div class=\"content\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 text-center\">
                        <a href=\"";
        // line 11
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard");
        echo "\"><img id=\"login-logo\" src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("img/" . (isset($context["asset_image_login"]) || array_key_exists("asset_image_login", $context) ? $context["asset_image_login"] : (function () { throw new RuntimeError('Variable "asset_image_login" does not exist.', 11, $this->source); })()))), "html", null, true);
        echo "\"  /></a>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3\">
                        <div class=\"card\" data-background=\"color\" data-color=\"orange\">
                            <div class=\"card-header\">
                                <h3 class=\"card-title\">Forgot Password</h3>
                            </div>
                            <div class=\"card-content\">
                                <form method=\"POST\" action=\"";
        // line 21
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forgot-password");
        echo "\">
                                ";
        // line 22
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 22, $this->source); })()), 'errors');
        echo "
                                ";
        // line 23
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 23, $this->source); })()), "nickname", [], "any", false, false, false, 23), 'row');
        echo "

                                <div>
                                    <input class=\"btn\" type=\"submit\" value=\"Request a password\"/>
                                </div>
                                ";
        // line 28
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), 'form_end');
        echo "
                            </div>
                            ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 30, $this->source); })()), "flashes", [0 => "reset_password_failure"], "method", false, false, false, 30));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 31
            echo "                                <div class=\"error\">
                                    ";
            // line 32
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "
                                </div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "                        </div>
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
        return "user/forgot_password.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 35,  114 => 32,  111 => 31,  107 => 30,  102 => 28,  94 => 23,  90 => 22,  86 => 21,  71 => 11,  62 => 4,  55 => 3,  47 => 1,  45 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}
{% form_theme form 'bootstrap_3_layout.html.twig' %}
{% block body %}
<div class=\"wrapper wrapper-full-page\">
    <div class=\"full-page login-page\" data-color=\"white\">
        <!--   you can change the color of the filter page using: data-color=\"blue | azure | green | orange | red | purple\" -->
        <div class=\"content\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 text-center\">
                        <a href=\"{{ path('dashboard') }}\"><img id=\"login-logo\" src=\"{{  asset('img/'~asset_image_login) }}\"  /></a>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3\">
                        <div class=\"card\" data-background=\"color\" data-color=\"orange\">
                            <div class=\"card-header\">
                                <h3 class=\"card-title\">Forgot Password</h3>
                            </div>
                            <div class=\"card-content\">
                                <form method=\"POST\" action=\"{{ path('forgot-password') }}\">
                                {{ form_errors(form) }}
                                {{ form_row(form.nickname) }}

                                <div>
                                    <input class=\"btn\" type=\"submit\" value=\"Request a password\"/>
                                </div>
                                {{ form_end(form) }}
                            </div>
                            {% for message in app.flashes('reset_password_failure') %}
                                <div class=\"error\">
                                    {{ message }}
                                </div>
                            {% endfor %}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{%  endblock body %}", "user/forgot_password.html.twig", "/data/personal/docker-app/templates/user/forgot_password.html.twig");
    }
}
