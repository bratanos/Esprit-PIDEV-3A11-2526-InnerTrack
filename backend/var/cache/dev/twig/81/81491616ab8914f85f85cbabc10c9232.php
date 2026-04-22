<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* learning_path/index.html.twig */
class __TwigTemplate_1b55a3dade86950f52eb36557a60fa12 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layouts/dashboard.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "learning_path/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "learning_path/index.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 4
        yield "<div class=\"space-y-6\">

    ";
        // line 7
        yield "    <nav class=\"flex items-center gap-2 text-sm text-on-surface-variant\">
<a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "#paths\" class=\"hover:text-primary transition\">Learning Paths</a>        <span>›</span>
        
    </nav>

    ";
        // line 13
        yield "    <div class=\"flex items-center justify-between\">
        <div>
            <h1 class=\"text-3xl font-extrabold text-on-surface tracking-tight\">Learning Paths</h1>
            <p class=\"text-on-surface-variant text-sm mt-1\">
                ";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["paths"]) || array_key_exists("paths", $context) ? $context["paths"] : (function () { throw new RuntimeError('Variable "paths" does not exist.', 17, $this->source); })())), "html", null, true);
        yield " path";
        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["paths"]) || array_key_exists("paths", $context) ? $context["paths"] : (function () { throw new RuntimeError('Variable "paths" does not exist.', 17, $this->source); })())) != 1)) ? ("s") : (""));
        yield "
            </p>
        </div>
        ";
        // line 20
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
            // line 21
            yield "            <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_new");
            yield "\"
               class=\"flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                      hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
                <span class=\"material-symbols-outlined text-[18px]\">add</span>
                New Path
            </a>
        ";
        }
        // line 28
        yield "    </div>

    ";
        // line 31
        yield "    ";
        yield Twig\Extension\CoreExtension::include($this->env, $context, "learning_path/_list.html.twig");
        yield "

</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "learning_path/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  121 => 31,  117 => 28,  106 => 21,  104 => 20,  96 => 17,  90 => 13,  83 => 8,  80 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"space-y-6\">

    {# Breadcrumb #}
    <nav class=\"flex items-center gap-2 text-sm text-on-surface-variant\">
<a href=\"{{ path('app_article_index') }}#paths\" class=\"hover:text-primary transition\">Learning Paths</a>        <span>›</span>
        
    </nav>

    {# Header #}
    <div class=\"flex items-center justify-between\">
        <div>
            <h1 class=\"text-3xl font-extrabold text-on-surface tracking-tight\">Learning Paths</h1>
            <p class=\"text-on-surface-variant text-sm mt-1\">
                {{ paths|length }} path{{ paths|length != 1 ? 's' : '' }}
            </p>
        </div>
        {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
            <a href=\"{{ path('app_learning_path_new') }}\"
               class=\"flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                      hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
                <span class=\"material-symbols-outlined text-[18px]\">add</span>
                New Path
            </a>
        {% endif %}
    </div>

    {# Shared partial: path cards grid #}
    {{ include('learning_path/_list.html.twig') }}

</div>
{% endblock %}
", "learning_path/index.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\learning_path\\index.html.twig");
    }
}
