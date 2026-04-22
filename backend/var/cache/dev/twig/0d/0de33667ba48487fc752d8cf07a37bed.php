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

/* admin/inscription/index.html.twig */
class __TwigTemplate_be69cfe1c915e58fb911e9672e997a80 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/inscription/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/inscription/index.html.twig"));

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

    <div class=\"flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4\">
        <div>
            <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Inscriptions</h2>
            <p class=\"text-xs text-on-surface-variant mt-1\">Toutes les inscriptions aux événements.</p>
        </div>
        <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_new");
        yield "\"
           class=\"flex items-center gap-2 px-6 py-3 rounded-2xl bg-secondary text-white text-sm font-bold shadow-lg shadow-secondary/20 hover:bg-teal-700 active:scale-95 transition-all\">
            <span class=\"material-symbols-outlined text-xl\">person_add</span> Nouvelle inscription
        </a>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm overflow-hidden\">
        ";
        // line 18
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["inscriptions"]) || array_key_exists("inscriptions", $context) ? $context["inscriptions"] : (function () { throw new RuntimeError('Variable "inscriptions" does not exist.', 18, $this->source); })())) > 0)) {
            // line 19
            yield "        <table class=\"w-full text-sm\">
            <thead>
                <tr class=\"border-b border-outline/20 text-[10px] font-bold uppercase tracking-[0.12em] text-on-surface-variant\">
                    <th class=\"text-left px-8 py-5\">Participant</th>
                    <th class=\"text-left px-4 py-5 hidden md:table-cell\">Email</th>
                    <th class=\"text-left px-4 py-5 hidden lg:table-cell\">Événement</th>
                    <th class=\"text-left px-4 py-5 hidden lg:table-cell\">Date</th>
                    <th class=\"text-right px-8 py-5\">Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["inscriptions"]) || array_key_exists("inscriptions", $context) ? $context["inscriptions"] : (function () { throw new RuntimeError('Variable "inscriptions" does not exist.', 30, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["insc"]) {
                // line 31
                yield "                <tr class=\"border-b border-outline/10 hover:bg-gray-50 transition-colors group\">
                    <td class=\"px-8 py-5\">
                        <div class=\"flex items-center gap-3\">
                            <div class=\"w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold text-sm shrink-0\">
                                ";
                // line 35
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "nomParticipant", [], "any", false, false, false, 35))), "html", null, true);
                yield "
                            </div>
                            <div class=\"font-bold text-on-surface\">";
                // line 37
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "nomParticipant", [], "any", false, false, false, 37), "html", null, true);
                yield "</div>
                        </div>
                    </td>
                    <td class=\"px-4 py-5 text-on-surface-variant hidden md:table-cell text-xs\">";
                // line 40
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "emailParticipant", [], "any", false, false, false, 40), "html", null, true);
                yield "</td>
                    <td class=\"px-4 py-5 hidden lg:table-cell\">
                        <span class=\"px-3 py-1 rounded-full text-[9px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-600\">
                            ";
                // line 43
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "evenement", [], "any", false, false, false, 43), "titre", [], "any", false, false, false, 43), "html", null, true);
                yield "
                        </span>
                    </td>
                    <td class=\"px-4 py-5 text-on-surface-variant hidden lg:table-cell text-xs\">";
                // line 46
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "dateInscription", [], "any", false, false, false, 46), "d/m/Y"), "html", null, true);
                yield "</td>
                    <td class=\"px-8 py-5\">
                        <div class=\"flex justify-end gap-2 opacity-70 group-hover:opacity-100 transition-opacity\">
                            <a href=\"";
                // line 49
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "id", [], "any", false, false, false, 49)]), "html", null, true);
                yield "\"
                               title=\"Voir\" class=\"p-2.5 rounded-xl bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors active:scale-90\">
                                <span class=\"material-symbols-outlined text-[18px]\">visibility</span>
                            </a>
                            <a href=\"";
                // line 53
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "id", [], "any", false, false, false, 53)]), "html", null, true);
                yield "\"
                               title=\"Modifier\" class=\"p-2.5 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors active:scale-90\">
                                <span class=\"material-symbols-outlined text-[18px]\">edit</span>
                            </a>
                            <form method=\"post\" action=\"";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "id", [], "any", false, false, false, 57)]), "html", null, true);
                yield "\"
                                  onsubmit=\"return confirm('Supprimer cette inscription ?');\" style=\"display:inline\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_inscription_" . CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "id", [], "any", false, false, false, 59))), "html", null, true);
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
            unset($context['_seq'], $context['_key'], $context['insc'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 69
            yield "            </tbody>
        </table>
        ";
        } else {
            // line 72
            yield "        <div class=\"py-20 flex flex-col items-center justify-center text-center\">
            <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-4\">how_to_reg</span>
            <h3 class=\"font-headline font-extrabold text-xl text-gray-400\">Aucune inscription</h3>
            <p class=\"text-xs text-gray-400 mt-2\">Les inscriptions apparaîtront ici.</p>
        </div>
        ";
        }
        // line 78
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
        return "admin/inscription/index.html.twig";
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
        return array (  197 => 78,  189 => 72,  184 => 69,  168 => 59,  163 => 57,  156 => 53,  149 => 49,  143 => 46,  137 => 43,  131 => 40,  125 => 37,  120 => 35,  114 => 31,  110 => 30,  97 => 19,  95 => 18,  85 => 11,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-7xl mx-auto pb-24 space-y-8\">

    <div class=\"flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4\">
        <div>
            <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Inscriptions</h2>
            <p class=\"text-xs text-on-surface-variant mt-1\">Toutes les inscriptions aux événements.</p>
        </div>
        <a href=\"{{ path('admin_inscription_new') }}\"
           class=\"flex items-center gap-2 px-6 py-3 rounded-2xl bg-secondary text-white text-sm font-bold shadow-lg shadow-secondary/20 hover:bg-teal-700 active:scale-95 transition-all\">
            <span class=\"material-symbols-outlined text-xl\">person_add</span> Nouvelle inscription
        </a>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm overflow-hidden\">
        {% if inscriptions|length > 0 %}
        <table class=\"w-full text-sm\">
            <thead>
                <tr class=\"border-b border-outline/20 text-[10px] font-bold uppercase tracking-[0.12em] text-on-surface-variant\">
                    <th class=\"text-left px-8 py-5\">Participant</th>
                    <th class=\"text-left px-4 py-5 hidden md:table-cell\">Email</th>
                    <th class=\"text-left px-4 py-5 hidden lg:table-cell\">Événement</th>
                    <th class=\"text-left px-4 py-5 hidden lg:table-cell\">Date</th>
                    <th class=\"text-right px-8 py-5\">Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for insc in inscriptions %}
                <tr class=\"border-b border-outline/10 hover:bg-gray-50 transition-colors group\">
                    <td class=\"px-8 py-5\">
                        <div class=\"flex items-center gap-3\">
                            <div class=\"w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold text-sm shrink-0\">
                                {{ insc.nomParticipant|first|upper }}
                            </div>
                            <div class=\"font-bold text-on-surface\">{{ insc.nomParticipant }}</div>
                        </div>
                    </td>
                    <td class=\"px-4 py-5 text-on-surface-variant hidden md:table-cell text-xs\">{{ insc.emailParticipant }}</td>
                    <td class=\"px-4 py-5 hidden lg:table-cell\">
                        <span class=\"px-3 py-1 rounded-full text-[9px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-600\">
                            {{ insc.evenement.titre }}
                        </span>
                    </td>
                    <td class=\"px-4 py-5 text-on-surface-variant hidden lg:table-cell text-xs\">{{ insc.dateInscription|date('d/m/Y') }}</td>
                    <td class=\"px-8 py-5\">
                        <div class=\"flex justify-end gap-2 opacity-70 group-hover:opacity-100 transition-opacity\">
                            <a href=\"{{ path('admin_inscription_show', {id: insc.id}) }}\"
                               title=\"Voir\" class=\"p-2.5 rounded-xl bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors active:scale-90\">
                                <span class=\"material-symbols-outlined text-[18px]\">visibility</span>
                            </a>
                            <a href=\"{{ path('admin_inscription_edit', {id: insc.id}) }}\"
                               title=\"Modifier\" class=\"p-2.5 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors active:scale-90\">
                                <span class=\"material-symbols-outlined text-[18px]\">edit</span>
                            </a>
                            <form method=\"post\" action=\"{{ path('admin_inscription_delete', {id: insc.id}) }}\"
                                  onsubmit=\"return confirm('Supprimer cette inscription ?');\" style=\"display:inline\">
                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_inscription_' ~ insc.id) }}\">
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
            <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-4\">how_to_reg</span>
            <h3 class=\"font-headline font-extrabold text-xl text-gray-400\">Aucune inscription</h3>
            <p class=\"text-xs text-gray-400 mt-2\">Les inscriptions apparaîtront ici.</p>
        </div>
        {% endif %}
    </div>
</div>
{% endblock %}
", "admin/inscription/index.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\admin\\inscription\\index.html.twig");
    }
}
