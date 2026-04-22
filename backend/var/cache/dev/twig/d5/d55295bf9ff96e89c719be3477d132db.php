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

/* article/edit.html.twig */
class __TwigTemplate_71bc061837620063021d7bf459c43045 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/edit.html.twig"));

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
        yield "<div class=\"max-w-2xl space-y-6\">

    <div class=\"flex items-center gap-4\">
        <a href=\"";
        // line 7
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "\"
           class=\"flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors\">
            <span class=\"material-symbols-outlined text-[18px]\">arrow_back</span>
            Back
        </a>
        <div>
            <h1 class=\"text-3xl font-extrabold text-on-surface tracking-tight\">Edit Article</h1>
            <p class=\"text-on-surface-variant text-sm mt-1 line-clamp-1\">";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 14, $this->source); })()), "titre", [], "any", false, false, false, 14), "html", null, true);
        yield "</p>
        </div>
    </div>

    <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation\">
        ";
        // line 19
        yield Twig\Extension\CoreExtension::include($this->env, $context, "article/_form.html.twig", ["button_label" => "Update"]);
        yield "
    </div>

    ";
        // line 23
        yield "    <div class=\"bg-white rounded-[2rem] border border-red-100 p-6\">
        <p class=\"text-sm font-bold text-red-600 mb-1\">⚠️ Danger Zone</p>
        <p class=\"text-xs text-on-surface-variant mb-4\">This action is irreversible.</p>
        <form method=\"post\" action=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 26, $this->source); })()), "id", [], "any", false, false, false, 26)]), "html", null, true);
        yield "\"
              onsubmit=\"return confirm('Permanently delete this article?')\">
            <input type=\"hidden\" name=\"_token\" value=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 28, $this->source); })()), "id", [], "any", false, false, false, 28))), "html", null, true);
        yield "\">
            <button type=\"submit\"
                    class=\"flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-500 text-white text-sm font-semibold hover:bg-red-600 transition-all\">
                <span class=\"material-symbols-outlined text-[16px]\">delete</span>
                Delete this article
            </button>
        </form>
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
        return "article/edit.html.twig";
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
        return array (  115 => 28,  110 => 26,  105 => 23,  99 => 19,  91 => 14,  81 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-2xl space-y-6\">

    <div class=\"flex items-center gap-4\">
        <a href=\"{{ path('app_article_index') }}\"
           class=\"flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors\">
            <span class=\"material-symbols-outlined text-[18px]\">arrow_back</span>
            Back
        </a>
        <div>
            <h1 class=\"text-3xl font-extrabold text-on-surface tracking-tight\">Edit Article</h1>
            <p class=\"text-on-surface-variant text-sm mt-1 line-clamp-1\">{{ article.titre }}</p>
        </div>
    </div>

    <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation\">
        {{ include('article/_form.html.twig', {'button_label': 'Update'}) }}
    </div>

    {# Danger zone #}
    <div class=\"bg-white rounded-[2rem] border border-red-100 p-6\">
        <p class=\"text-sm font-bold text-red-600 mb-1\">⚠️ Danger Zone</p>
        <p class=\"text-xs text-on-surface-variant mb-4\">This action is irreversible.</p>
        <form method=\"post\" action=\"{{ path('app_article_delete', {'id': article.id}) }}\"
              onsubmit=\"return confirm('Permanently delete this article?')\">
            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ article.id) }}\">
            <button type=\"submit\"
                    class=\"flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-500 text-white text-sm font-semibold hover:bg-red-600 transition-all\">
                <span class=\"material-symbols-outlined text-[16px]\">delete</span>
                Delete this article
            </button>
        </form>
    </div>

</div>
{% endblock %}
", "article/edit.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\article\\edit.html.twig");
    }
}
