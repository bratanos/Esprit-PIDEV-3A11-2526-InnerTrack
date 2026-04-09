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

/* pages/testpsy/show.html.twig */
class __TwigTemplate_e6b36c97c040a0c5f382a58eeacf3c9b extends Template
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
            'header_title' => [$this, 'block_header_title'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/show.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_title"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 3, $this->source); })()), "titre", [], "any", false, false, false, 3), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
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

        // line 6
        yield "<div class=\"max-w-3xl mx-auto pb-24\">

    <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index");
        yield "\" class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary mb-8 transition-colors\">
        <span class=\"material-symbols-outlined\">arrow_back</span> Retour aux tests
    </a>

    <div class=\"bg-white rounded-[3rem] p-12 shadow-sm border border-outline/20\">
        <div class=\"w-16 h-16 rounded-[1.5rem] bg-primary/10 text-primary flex items-center justify-center mb-8\">
            <span class=\"material-symbols-outlined text-4xl\">psychology_alt</span>
        </div>

        <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface mb-4\">";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 17, $this->source); })()), "titre", [], "any", false, false, false, 17), "html", null, true);
        yield "</h1>
        <p class=\"text-base text-on-surface-variant leading-relaxed mb-10\">";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 18, $this->source); })()), "description", [], "any", false, false, false, 18), "html", null, true);
        yield "</p>

        <div class=\"grid grid-cols-2 gap-4 mb-10\">
            <div class=\"bg-gray-50/50 rounded-[1.5rem] p-6 border border-outline/10\">
                <div class=\"text-[10px] font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-1\">Questions</div>
                <div class=\"text-3xl font-extrabold text-primary font-headline\">";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 23, $this->source); })()), "nombreQuestions", [], "any", false, false, false, 23), "html", null, true);
        yield "</div>
            </div>
            <div class=\"bg-gray-50/50 rounded-[1.5rem] p-6 border border-outline/10\">
                <div class=\"text-[10px] font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-1\">Durée estimée</div>
                <div class=\"text-3xl font-extrabold text-on-surface font-headline\">~";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 27, $this->source); })()), "nombreQuestions", [], "any", false, false, false, 27) * 0.5)), "html", null, true);
        yield " min</div>
            </div>
        </div>

        <a href=\"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_passer", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 31, $this->source); })()), "idTest", [], "any", false, false, false, 31)]), "html", null, true);
        yield "\"
           class=\"w-full py-4 text-center block text-base font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-lg shadow-primary/20\">
            Commencer le test
        </a>
    </div>

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
        return "pages/testpsy/show.html.twig";
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
        return array (  142 => 31,  135 => 27,  128 => 23,  120 => 18,  116 => 17,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}{{ test.titre }}{% endblock %}

{% block content %}
<div class=\"max-w-3xl mx-auto pb-24\">

    <a href=\"{{ path('testpsy_index') }}\" class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary mb-8 transition-colors\">
        <span class=\"material-symbols-outlined\">arrow_back</span> Retour aux tests
    </a>

    <div class=\"bg-white rounded-[3rem] p-12 shadow-sm border border-outline/20\">
        <div class=\"w-16 h-16 rounded-[1.5rem] bg-primary/10 text-primary flex items-center justify-center mb-8\">
            <span class=\"material-symbols-outlined text-4xl\">psychology_alt</span>
        </div>

        <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface mb-4\">{{ test.titre }}</h1>
        <p class=\"text-base text-on-surface-variant leading-relaxed mb-10\">{{ test.description }}</p>

        <div class=\"grid grid-cols-2 gap-4 mb-10\">
            <div class=\"bg-gray-50/50 rounded-[1.5rem] p-6 border border-outline/10\">
                <div class=\"text-[10px] font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-1\">Questions</div>
                <div class=\"text-3xl font-extrabold text-primary font-headline\">{{ test.nombreQuestions }}</div>
            </div>
            <div class=\"bg-gray-50/50 rounded-[1.5rem] p-6 border border-outline/10\">
                <div class=\"text-[10px] font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-1\">Durée estimée</div>
                <div class=\"text-3xl font-extrabold text-on-surface font-headline\">~{{ (test.nombreQuestions * 0.5)|round }} min</div>
            </div>
        </div>

        <a href=\"{{ path('testpsy_passer', {id: test.idTest}) }}\"
           class=\"w-full py-4 text-center block text-base font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-lg shadow-primary/20\">
            Commencer le test
        </a>
    </div>

</div>
{% endblock %}", "pages/testpsy/show.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\testpsy\\show.html.twig");
    }
}
