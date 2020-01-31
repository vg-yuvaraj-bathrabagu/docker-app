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

/* base.html.twig */
class __TwigTemplate_37a1ab0d7a9605ec13a10c6b607383d1ea6e087fa1d32bed22f3a603743750d2 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'custom_css' => [$this, 'block_custom_css'],
            'body' => [$this, 'block_body'],
            'custom_javascript' => [$this, 'block_custom_javascript'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!doctype html>
<html lang=\"en\">
<head>
    ";
        // line 4
        echo twig_include($this->env, $context, "header.twig");
        echo "
    ";
        // line 5
        $this->displayBlock('custom_css', $context, $blocks);
        // line 7
        echo "</head>

<body>
<div class=\"wrapper\">
    ";
        // line 11
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("IS_AUTHENTICATED_FULLY")) {
            // line 12
            echo "        ";
            echo twig_include($this->env, $context, "sidebar.twig");
            echo "
    <div class=\"main-panel\">
        ";
            // line 14
            echo twig_include($this->env, $context, "top-nav.twig");
            echo "
        ";
        }
        // line 16
        echo "
        <div class=\"content\">
            ";
        // line 18
        $this->displayBlock('body', $context, $blocks);
        // line 19
        echo "        </div>
     ";
        // line 20
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("IS_AUTHENTICATED_FULLY")) {
            // line 21
            echo "    </div>
    ";
        }
        // line 23
        echo "    ";
        echo twig_include($this->env, $context, "footer.twig");
        echo "
</div>
";
        // line 25
        $this->displayBlock('custom_javascript', $context, $blocks);
        // line 27
        echo "</body>
</html>";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_custom_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "custom_css"));

        // line 6
        echo "    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 18
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 25
    public function block_custom_javascript($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "custom_javascript"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 25,  118 => 18,  111 => 6,  104 => 5,  96 => 27,  94 => 25,  88 => 23,  84 => 21,  82 => 20,  79 => 19,  77 => 18,  73 => 16,  68 => 14,  62 => 12,  60 => 11,  54 => 7,  52 => 5,  48 => 4,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"en\">
<head>
    {{ include('header.twig') }}
    {% block custom_css %}
    {% endblock %}
</head>

<body>
<div class=\"wrapper\">
    {% if is_granted('IS_AUTHENTICATED_FULLY') %}
        {{ include('sidebar.twig') }}
    <div class=\"main-panel\">
        {{ include('top-nav.twig') }}
        {% endif %}

        <div class=\"content\">
            {% block body %}{% endblock %}
        </div>
     {% if is_granted('IS_AUTHENTICATED_FULLY') %}
    </div>
    {% endif %}
    {{ include('footer.twig') }}
</div>
{% block custom_javascript %}
{% endblock %}
</body>
</html>", "base.html.twig", "/data/personal/docker-app/templates/base.html.twig");
    }
}
