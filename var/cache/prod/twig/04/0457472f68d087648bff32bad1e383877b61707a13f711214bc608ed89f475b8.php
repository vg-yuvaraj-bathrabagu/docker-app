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

/* user/login.html.twig */
class __TwigTemplate_824c568dd2ee1a46ff6cac3a2827a1c184891333bbb651517426468eea80588a extends \Twig\Template
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
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/login.html.twig"));

        // line 2
        $this->env->getRuntime("Symfony\\Component\\Form\\FormRenderer")->setTheme((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 2, $this->source); })()), [0 => "bootstrap_3_layout.html.twig"], true);
        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "user/login.html.twig", 1);
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
                        <img id=\"login-logo\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("img/" . (isset($context["asset_image_login"]) || array_key_exists("asset_image_login", $context) ? $context["asset_image_login"] : (function () { throw new RuntimeError('Variable "asset_image_login" does not exist.', 11, $this->source); })()))), "html", null, true);
        echo "\"  />
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3\">
                            <div class=\"card\" data-background=\"color\" data-color=\"orange\">
                                <div class=\"card-header\">
                                    <h3 class=\"card-title\">Login</h3>
                                </div>
                                <div class=\"card-content\">
                                ";
        // line 21
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 21, $this->source); })()), 'form_start');
        echo "
                                ";
        // line 22
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 22, $this->source); })()), 'errors');
        echo "
                                ";
        // line 23
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 23, $this->source); })()), "email", [], "any", false, false, false, 23), 'row');
        echo "
                                ";
        // line 24
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 24, $this->source); })()), "password", [], "any", false, false, false, 24), 'row');
        echo "
                                    <div class=\"card-footer text-center\">
                                        <button type=\"submit\" class=\"btn btn-fill btn-wd \">Login</button>
                                        <div class=\"forgot\">
                                            <a href=\"";
        // line 28
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("forgot_password");
        echo "\">Forgot your password?</a>
                                        </div>
                                    </div>
                                ";
        // line 31
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), 'form_end');
        echo "
                                </div>
                                ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 33, $this->source); })()), "flashes", [0 => "success"], "method", false, false, false, 33));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 34
            echo "                                    <div class=\"alert-notice\">
                                        ";
            // line 35
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "
                                    </div>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "                            </div>
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
        return "user/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 38,  121 => 35,  118 => 34,  114 => 33,  109 => 31,  103 => 28,  96 => 24,  92 => 23,  88 => 22,  84 => 21,  71 => 11,  62 => 4,  55 => 3,  47 => 1,  45 => 2,  35 => 1,);
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
                        <img id=\"login-logo\" src=\"{{  asset('img/'~asset_image_login) }}\"  />
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3\">
                            <div class=\"card\" data-background=\"color\" data-color=\"orange\">
                                <div class=\"card-header\">
                                    <h3 class=\"card-title\">Login</h3>
                                </div>
                                <div class=\"card-content\">
                                {{ form_start(form) }}
                                {{ form_errors(form) }}
                                {{ form_row(form.email) }}
                                {{ form_row(form.password) }}
                                    <div class=\"card-footer text-center\">
                                        <button type=\"submit\" class=\"btn btn-fill btn-wd \">Login</button>
                                        <div class=\"forgot\">
                                            <a href=\"{{ url('forgot_password') }}\">Forgot your password?</a>
                                        </div>
                                    </div>
                                {{ form_end(form) }}
                                </div>
                                {% for message in app.flashes('success') %}
                                    <div class=\"alert-notice\">
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
{% endblock %}", "user/login.html.twig", "/data/personal/docker-app/templates/user/login.html.twig");
    }
}
