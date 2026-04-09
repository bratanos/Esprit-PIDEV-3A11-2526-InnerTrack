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

/* admin/event/show.html.twig */
class __TwigTemplate_cf402595767b8705b11458e34ece90fc extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/event/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/event/show.html.twig"));

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
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_index");
        yield "\" class=\"inline-flex items-center gap-1 text-xs font-bold text-on-surface-variant hover:text-primary transition-colors mb-4\">
            <span class=\"material-symbols-outlined text-lg\">arrow_back</span> Retour aux événements
        </a>
        <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 10, $this->source); })()), "titre", [], "any", false, false, false, 10), "html", null, true);
        yield "</h2>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm p-8 lg:p-10 space-y-8\">

        ";
        // line 16
        yield "        <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-6\">
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Type</div>
                <span class=\"px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-600\">
                    ";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 20, $this->source); })()), "type", [], "any", false, false, false, 20), "label", [], "method", false, false, false, 20), "html", null, true);
        yield "
                </span>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Date de l'événement</div>
                <div class=\"text-sm font-bold text-on-surface\">";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 25, $this->source); })()), "date", [], "any", false, false, false, 25), "d/m/Y"), "html", null, true);
        yield "</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Capacité</div>
                <div class=\"text-sm font-bold text-on-surface\">";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 29, $this->source); })()), "capacite", [], "any", false, false, false, 29), "html", null, true);
        yield " places</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Statut</div>
                <span class=\"flex items-center gap-1.5 text-sm font-bold ";
        // line 33
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 33, $this->source); })()), "statut", [], "any", false, false, false, 33)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("text-green-600") : ("text-red-500"));
        yield "\">
                    <span class=\"w-2 h-2 rounded-full ";
        // line 34
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 34, $this->source); })()), "statut", [], "any", false, false, false, 34)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-green-500") : ("bg-red-500"));
        yield "\"></span>
                    ";
        // line 35
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 35, $this->source); })()), "statut", [], "any", false, false, false, 35)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Actif") : ("Inactif"));
        yield "
                </span>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Date de création</div>
                <div class=\"text-sm font-bold text-on-surface\">";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 40, $this->source); })()), "dateCreation", [], "any", false, false, false, 40), "d/m/Y"), "html", null, true);
        yield "</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Inscriptions</div>
                <div class=\"text-sm font-bold text-on-surface\">";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 44, $this->source); })()), "inscriptions", [], "any", false, false, false, 44)), "html", null, true);
        yield "</div>
            </div>
        </div>

        ";
        // line 48
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 48, $this->source); })()), "description", [], "any", false, false, false, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 49
            yield "        <div>
            <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-2\">Description</div>
            <div class=\"p-5 bg-gray-50 rounded-2xl text-sm text-on-surface-variant leading-relaxed\">
                ";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 52, $this->source); })()), "description", [], "any", false, false, false, 52), "html", null, true);
            yield "
            </div>
        </div>
        ";
        }
        // line 56
        yield "
        ";
        // line 58
        yield "        <div class=\"flex gap-3 pt-4 border-t border-outline/20\">
            <a href=\"";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 59, $this->source); })()), "id", [], "any", false, false, false, 59)]), "html", null, true);
        yield "\"
               class=\"flex-1 py-3.5 rounded-2xl bg-indigo-50 text-indigo-600 text-sm font-bold hover:bg-indigo-100 transition-colors text-center flex items-center justify-center gap-2\">
                <span class=\"material-symbols-outlined text-lg\">edit</span> Modifier
            </a>
            <form method=\"post\" action=\"";
        // line 63
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 63, $this->source); })()), "id", [], "any", false, false, false, 63)]), "html", null, true);
        yield "\"
                  onsubmit=\"return confirm('Supprimer cet événement ?');\" class=\"flex-1\">
                <input type=\"hidden\" name=\"_token\" value=\"";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_event_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 65, $this->source); })()), "id", [], "any", false, false, false, 65))), "html", null, true);
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
        return "admin/event/show.html.twig";
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
        return array (  185 => 65,  180 => 63,  173 => 59,  170 => 58,  167 => 56,  160 => 52,  155 => 49,  153 => 48,  146 => 44,  139 => 40,  131 => 35,  127 => 34,  123 => 33,  116 => 29,  109 => 25,  101 => 20,  95 => 16,  87 => 10,  81 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-2xl mx-auto pb-24 space-y-8\">

    <div>
        <a href=\"{{ path('admin_event_index') }}\" class=\"inline-flex items-center gap-1 text-xs font-bold text-on-surface-variant hover:text-primary transition-colors mb-4\">
            <span class=\"material-symbols-outlined text-lg\">arrow_back</span> Retour aux événements
        </a>
        <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">{{ event.titre }}</h2>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm p-8 lg:p-10 space-y-8\">

        {# Info grid #}
        <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-6\">
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Type</div>
                <span class=\"px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-600\">
                    {{ event.type.label() }}
                </span>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Date de l'événement</div>
                <div class=\"text-sm font-bold text-on-surface\">{{ event.date|date('d/m/Y') }}</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Capacité</div>
                <div class=\"text-sm font-bold text-on-surface\">{{ event.capacite }} places</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Statut</div>
                <span class=\"flex items-center gap-1.5 text-sm font-bold {{ event.statut ? 'text-green-600' : 'text-red-500' }}\">
                    <span class=\"w-2 h-2 rounded-full {{ event.statut ? 'bg-green-500' : 'bg-red-500' }}\"></span>
                    {{ event.statut ? 'Actif' : 'Inactif' }}
                </span>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Date de création</div>
                <div class=\"text-sm font-bold text-on-surface\">{{ event.dateCreation|date('d/m/Y') }}</div>
            </div>
            <div>
                <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1\">Inscriptions</div>
                <div class=\"text-sm font-bold text-on-surface\">{{ event.inscriptions|length }}</div>
            </div>
        </div>

        {% if event.description %}
        <div>
            <div class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-2\">Description</div>
            <div class=\"p-5 bg-gray-50 rounded-2xl text-sm text-on-surface-variant leading-relaxed\">
                {{ event.description }}
            </div>
        </div>
        {% endif %}

        {# Actions #}
        <div class=\"flex gap-3 pt-4 border-t border-outline/20\">
            <a href=\"{{ path('admin_event_edit', {id: event.id}) }}\"
               class=\"flex-1 py-3.5 rounded-2xl bg-indigo-50 text-indigo-600 text-sm font-bold hover:bg-indigo-100 transition-colors text-center flex items-center justify-center gap-2\">
                <span class=\"material-symbols-outlined text-lg\">edit</span> Modifier
            </a>
            <form method=\"post\" action=\"{{ path('admin_event_delete', {id: event.id}) }}\"
                  onsubmit=\"return confirm('Supprimer cet événement ?');\" class=\"flex-1\">
                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_event_' ~ event.id) }}\">
                <button type=\"submit\"
                        class=\"w-full py-3.5 rounded-2xl bg-red-50 text-red-500 text-sm font-bold hover:bg-red-100 transition-colors flex items-center justify-center gap-2\">
                    <span class=\"material-symbols-outlined text-lg\">delete</span> Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
{% endblock %}
", "admin/event/show.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\admin\\event\\show.html.twig");
    }
}
