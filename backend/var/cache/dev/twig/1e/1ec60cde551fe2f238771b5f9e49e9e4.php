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

/* admin/inscription/show.html.twig */
class __TwigTemplate_0f5d0ed52937ed372ae059229e00b052 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/inscription/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/inscription/show.html.twig"));

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
        yield "<div class=\"max-w-2xl mx-auto pb-24 space-y-8\">

    <div>
        <a href=\"";
        // line 7
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_index");
        yield "\" class=\"inline-flex items-center gap-1 text-xs font-bold text-on-surface-variant hover:text-primary transition-colors mb-4\">
            <span class=\"material-symbols-outlined text-lg\">arrow_back</span> Retour aux inscriptions
        </a>
        <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Inscription de ";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 10, $this->source); })()), "nomParticipant", [], "any", false, false, false, 10), "html", null, true);
        yield "</h2>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm p-8 lg:p-10 space-y-8\">

        <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-6\">
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Nom du participant</div>
                <div class=\"text-sm font-bold text-on-surface\">";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 18, $this->source); })()), "nomParticipant", [], "any", false, false, false, 18), "html", null, true);
        yield "</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Email</div>
                <div class=\"text-sm font-bold text-on-surface\">";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 22, $this->source); })()), "emailParticipant", [], "any", false, false, false, 22), "html", null, true);
        yield "</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Événement</div>
                <a href=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 26, $this->source); })()), "evenement", [], "any", false, false, false, 26), "id", [], "any", false, false, false, 26)]), "html", null, true);
        yield "\"
                   class=\"inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors\">
                    ";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 28, $this->source); })()), "evenement", [], "any", false, false, false, 28), "titre", [], "any", false, false, false, 28), "html", null, true);
        yield "
                    <span class=\"material-symbols-outlined text-[14px]\">open_in_new</span>
                </a>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Date d'inscription</div>
                <div class=\"text-sm font-bold text-on-surface\">";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 34, $this->source); })()), "dateInscription", [], "any", false, false, false, 34), "d/m/Y"), "html", null, true);
        yield "</div>
            </div>
        </div>

        <div class=\"flex gap-3 pt-4 border-t border-outline/20\">
            <a href=\"";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 39, $this->source); })()), "id", [], "any", false, false, false, 39)]), "html", null, true);
        yield "\"
               class=\"flex-1 py-3.5 rounded-2xl bg-indigo-50 text-indigo-600 text-sm font-bold hover:bg-indigo-100 transition-colors text-center flex items-center justify-center gap-2\">
                <span class=\"material-symbols-outlined text-lg\">edit</span> Modifier
            </a>
            <form method=\"post\" action=\"";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 43, $this->source); })()), "id", [], "any", false, false, false, 43)]), "html", null, true);
        yield "\"
                  onsubmit=\"return confirm('Supprimer cette inscription ?');\" class=\"flex-1\">
                <input type=\"hidden\" name=\"_token\" value=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_inscription_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 45, $this->source); })()), "id", [], "any", false, false, false, 45))), "html", null, true);
        yield "\">
                <button type=\"submit\"
                        class=\"w-full py-3.5 rounded-2xl bg-red-50 text-red-500 text-sm font-bold hover:bg-red-100 transition-colors flex items-center justify-center gap-2\">
                    <span class=\"material-symbols-outlined text-lg\">delete</span> Supprimer
                </button>
            </form>
        </div>
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
        return "admin/inscription/show.html.twig";
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
        return array (  146 => 45,  141 => 43,  134 => 39,  126 => 34,  117 => 28,  112 => 26,  105 => 22,  98 => 18,  87 => 10,  81 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-2xl mx-auto pb-24 space-y-8\">

    <div>
        <a href=\"{{ path('admin_inscription_index') }}\" class=\"inline-flex items-center gap-1 text-xs font-bold text-on-surface-variant hover:text-primary transition-colors mb-4\">
            <span class=\"material-symbols-outlined text-lg\">arrow_back</span> Retour aux inscriptions
        </a>
        <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Inscription de {{ inscription.nomParticipant }}</h2>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm p-8 lg:p-10 space-y-8\">

        <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-6\">
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Nom du participant</div>
                <div class=\"text-sm font-bold text-on-surface\">{{ inscription.nomParticipant }}</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Email</div>
                <div class=\"text-sm font-bold text-on-surface\">{{ inscription.emailParticipant }}</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Événement</div>
                <a href=\"{{ path('admin_event_show', {id: inscription.evenement.id}) }}\"
                   class=\"inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors\">
                    {{ inscription.evenement.titre }}
                    <span class=\"material-symbols-outlined text-[14px]\">open_in_new</span>
                </a>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Date d'inscription</div>
                <div class=\"text-sm font-bold text-on-surface\">{{ inscription.dateInscription|date('d/m/Y') }}</div>
            </div>
        </div>

        <div class=\"flex gap-3 pt-4 border-t border-outline/20\">
            <a href=\"{{ path('admin_inscription_edit', {id: inscription.id}) }}\"
               class=\"flex-1 py-3.5 rounded-2xl bg-indigo-50 text-indigo-600 text-sm font-bold hover:bg-indigo-100 transition-colors text-center flex items-center justify-center gap-2\">
                <span class=\"material-symbols-outlined text-lg\">edit</span> Modifier
            </a>
            <form method=\"post\" action=\"{{ path('admin_inscription_delete', {id: inscription.id}) }}\"
                  onsubmit=\"return confirm('Supprimer cette inscription ?');\" class=\"flex-1\">
                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_inscription_' ~ inscription.id) }}\">
                <button type=\"submit\"
                        class=\"w-full py-3.5 rounded-2xl bg-red-50 text-red-500 text-sm font-bold hover:bg-red-100 transition-colors flex items-center justify-center gap-2\">
                    <span class=\"material-symbols-outlined text-lg\">delete</span> Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
{% endblock %}
", "admin/inscription/show.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\admin\\inscription\\show.html.twig");
    }
}
