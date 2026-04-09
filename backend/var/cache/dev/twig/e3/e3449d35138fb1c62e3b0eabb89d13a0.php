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

/* admin/event/index.html.twig */
class __TwigTemplate_0a54645c5da89f3dabe227d1ec913d55 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/event/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/event/index.html.twig"));

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
        yield "<div class=\"max-w-7xl mx-auto pb-24 space-y-8\">

    ";
        // line 7
        yield "    <div class=\"flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4\">
        <div>
            <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Événements</h2>
            <p class=\"text-xs text-on-surface-variant mt-1\">Gérez vos événements : conférences, ateliers, forums et webinaires.</p>
        </div>
        <a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_new");
        yield "\"
           class=\"flex items-center gap-2 px-6 py-3 rounded-2xl bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 hover:bg-indigo-700 active:scale-95 transition-all\">
            <span class=\"material-symbols-outlined text-xl\">add</span> Nouvel événement
        </a>
    </div>

    ";
        // line 19
        yield "    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm overflow-hidden\">
        ";
        // line 20
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 20, $this->source); })())) > 0)) {
            // line 21
            yield "        <table class=\"w-full text-sm\">
            <thead>
                <tr class=\"border-b border-outline/20 text-[10px] font-bold uppercase tracking-[0.12em] text-on-surface-variant\">
                    <th class=\"text-left px-8 py-5\">Titre</th>
                    <th class=\"text-left px-4 py-5 hidden md:table-cell\">Type</th>
                    <th class=\"text-left px-4 py-5 hidden lg:table-cell\">Date</th>
                    <th class=\"text-left px-4 py-5 hidden lg:table-cell\">Capacité</th>
                    <th class=\"text-left px-4 py-5\">Statut</th>
                    <th class=\"text-right px-8 py-5\">Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 33, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
                // line 34
                yield "                <tr class=\"border-b border-outline/10 hover:bg-gray-50 transition-colors group\">
                    <td class=\"px-8 py-5\">
                        <div class=\"font-bold text-on-surface\">";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "titre", [], "any", false, false, false, 36), "html", null, true);
                yield "</div>
                        <div class=\"text-[10px] text-on-surface-variant mt-0.5 md:hidden\">";
                // line 37
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "type", [], "any", false, false, false, 37), "label", [], "method", false, false, false, 37), "html", null, true);
                yield "</div>
                    </td>
                    <td class=\"px-4 py-5 hidden md:table-cell\">
                        <span class=\"px-3 py-1 rounded-full text-[9px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-600\">
                            ";
                // line 41
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "type", [], "any", false, false, false, 41), "label", [], "method", false, false, false, 41), "html", null, true);
                yield "
                        </span>
                    </td>
                    <td class=\"px-4 py-5 text-on-surface-variant hidden lg:table-cell text-xs\">
                        ";
                // line 45
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "date", [], "any", false, false, false, 45), "d/m/Y"), "html", null, true);
                yield "
                    </td>
                    <td class=\"px-4 py-5 text-on-surface-variant hidden lg:table-cell text-xs font-bold\">
                        ";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "capacite", [], "any", false, false, false, 48), "html", null, true);
                yield "
                    </td>
                    <td class=\"px-4 py-5\">
                        <span class=\"flex items-center gap-1.5 text-[10px] font-bold ";
                // line 51
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["event"], "statut", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("text-green-600") : ("text-red-500"));
                yield "\">
                            <span class=\"w-1.5 h-1.5 rounded-full ";
                // line 52
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["event"], "statut", [], "any", false, false, false, 52)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-green-500") : ("bg-red-500"));
                yield "\"></span>
                            ";
                // line 53
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["event"], "statut", [], "any", false, false, false, 53)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Actif") : ("Inactif"));
                yield "
                        </span>
                    </td>
                    <td class=\"px-8 py-5\">
                        <div class=\"flex justify-end gap-2 opacity-70 group-hover:opacity-100 transition-opacity\">
                            <a href=\"";
                // line 58
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 58)]), "html", null, true);
                yield "\"
                               title=\"Voir\" class=\"p-2.5 rounded-xl bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors active:scale-90\">
                                <span class=\"material-symbols-outlined text-[18px]\">visibility</span>
                            </a>
                            <a href=\"";
                // line 62
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 62)]), "html", null, true);
                yield "\"
                               title=\"Modifier\" class=\"p-2.5 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors active:scale-90\">
                                <span class=\"material-symbols-outlined text-[18px]\">edit</span>
                            </a>
                            <form method=\"post\" action=\"";
                // line 66
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 66)]), "html", null, true);
                yield "\"
                                  onsubmit=\"return confirm('Supprimer cet événement ?');\" style=\"display:inline\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                // line 68
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_event_" . CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 68))), "html", null, true);
                yield "\">
                                <button type=\"submit\" title=\"Supprimer\"
                                        class=\"p-2.5 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition-colors active:scale-90\">
                                    <span class=\"material-symbols-outlined text-[18px]\">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['event'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 78
            yield "            </tbody>
        </table>
        ";
        } else {
            // line 81
            yield "        <div class=\"py-20 flex flex-col items-center justify-center text-center\">
            <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-4\">event_busy</span>
            <h3 class=\"font-headline font-extrabold text-xl text-gray-400\">Aucun événement</h3>
            <p class=\"text-xs text-gray-400 mt-2\">Commencez par créer votre premier événement.</p>
        </div>
        ";
        }
        // line 87
        yield "    </div>
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
        return "admin/event/index.html.twig";
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
        return array (  217 => 87,  209 => 81,  204 => 78,  188 => 68,  183 => 66,  176 => 62,  169 => 58,  161 => 53,  157 => 52,  153 => 51,  147 => 48,  141 => 45,  134 => 41,  127 => 37,  123 => 36,  119 => 34,  115 => 33,  101 => 21,  99 => 20,  96 => 19,  87 => 12,  80 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-7xl mx-auto pb-24 space-y-8\">

    {# ── Header ── #}
    <div class=\"flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4\">
        <div>
            <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Événements</h2>
            <p class=\"text-xs text-on-surface-variant mt-1\">Gérez vos événements : conférences, ateliers, forums et webinaires.</p>
        </div>
        <a href=\"{{ path('admin_event_new') }}\"
           class=\"flex items-center gap-2 px-6 py-3 rounded-2xl bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 hover:bg-indigo-700 active:scale-95 transition-all\">
            <span class=\"material-symbols-outlined text-xl\">add</span> Nouvel événement
        </a>
    </div>

    {# ── Table ── #}
    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm overflow-hidden\">
        {% if events|length > 0 %}
        <table class=\"w-full text-sm\">
            <thead>
                <tr class=\"border-b border-outline/20 text-[10px] font-bold uppercase tracking-[0.12em] text-on-surface-variant\">
                    <th class=\"text-left px-8 py-5\">Titre</th>
                    <th class=\"text-left px-4 py-5 hidden md:table-cell\">Type</th>
                    <th class=\"text-left px-4 py-5 hidden lg:table-cell\">Date</th>
                    <th class=\"text-left px-4 py-5 hidden lg:table-cell\">Capacité</th>
                    <th class=\"text-left px-4 py-5\">Statut</th>
                    <th class=\"text-right px-8 py-5\">Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for event in events %}
                <tr class=\"border-b border-outline/10 hover:bg-gray-50 transition-colors group\">
                    <td class=\"px-8 py-5\">
                        <div class=\"font-bold text-on-surface\">{{ event.titre }}</div>
                        <div class=\"text-[10px] text-on-surface-variant mt-0.5 md:hidden\">{{ event.type.label() }}</div>
                    </td>
                    <td class=\"px-4 py-5 hidden md:table-cell\">
                        <span class=\"px-3 py-1 rounded-full text-[9px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-600\">
                            {{ event.type.label() }}
                        </span>
                    </td>
                    <td class=\"px-4 py-5 text-on-surface-variant hidden lg:table-cell text-xs\">
                        {{ event.date|date('d/m/Y') }}
                    </td>
                    <td class=\"px-4 py-5 text-on-surface-variant hidden lg:table-cell text-xs font-bold\">
                        {{ event.capacite }}
                    </td>
                    <td class=\"px-4 py-5\">
                        <span class=\"flex items-center gap-1.5 text-[10px] font-bold {{ event.statut ? 'text-green-600' : 'text-red-500' }}\">
                            <span class=\"w-1.5 h-1.5 rounded-full {{ event.statut ? 'bg-green-500' : 'bg-red-500' }}\"></span>
                            {{ event.statut ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class=\"px-8 py-5\">
                        <div class=\"flex justify-end gap-2 opacity-70 group-hover:opacity-100 transition-opacity\">
                            <a href=\"{{ path('admin_event_show', {id: event.id}) }}\"
                               title=\"Voir\" class=\"p-2.5 rounded-xl bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors active:scale-90\">
                                <span class=\"material-symbols-outlined text-[18px]\">visibility</span>
                            </a>
                            <a href=\"{{ path('admin_event_edit', {id: event.id}) }}\"
                               title=\"Modifier\" class=\"p-2.5 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors active:scale-90\">
                                <span class=\"material-symbols-outlined text-[18px]\">edit</span>
                            </a>
                            <form method=\"post\" action=\"{{ path('admin_event_delete', {id: event.id}) }}\"
                                  onsubmit=\"return confirm('Supprimer cet événement ?');\" style=\"display:inline\">
                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_event_' ~ event.id) }}\">
                                <button type=\"submit\" title=\"Supprimer\"
                                        class=\"p-2.5 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition-colors active:scale-90\">
                                    <span class=\"material-symbols-outlined text-[18px]\">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
        {% else %}
        <div class=\"py-20 flex flex-col items-center justify-center text-center\">
            <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-4\">event_busy</span>
            <h3 class=\"font-headline font-extrabold text-xl text-gray-400\">Aucun événement</h3>
            <p class=\"text-xs text-gray-400 mt-2\">Commencez par créer votre premier événement.</p>
        </div>
        {% endif %}
    </div>
</div>
{% endblock %}
", "admin/event/index.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\admin\\event\\index.html.twig");
    }
}
