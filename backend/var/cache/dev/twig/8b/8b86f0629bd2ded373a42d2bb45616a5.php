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

/* admin/event/edit.html.twig */
class __TwigTemplate_d0e3931c3dfd11559440eb1354028911 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/event/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/event/edit.html.twig"));

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
        <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Modifier l'événement</h2>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm p-8 lg:p-10\">
        <form method=\"post\" action=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 14, $this->source); })()), "id", [], "any", false, false, false, 14)]), "html", null, true);
        yield "\" class=\"space-y-6\" id=\"eventForm\" enctype=\"multipart/form-data\" novalidate onsubmit=\"return validateEventForm(event)\">

            ";
        // line 17
        yield "            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Titre *</label>
                <input type=\"text\" name=\"titre\" id=\"event_titre\" value=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 19, $this->source); })()), "titre", [], "any", false, false, false, 19), "html", null, true);
        yield "\"
                       class=\"w-full px-4 py-3 rounded-xl border ";
        // line 20
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "titre", [], "any", true, true, false, 20)) ? ("border-red-400 ring-1 ring-red-300") : ("border-outline/30 focus:ring-primary"));
        yield " bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\"
                       placeholder=\"Nom de l'événement\">
                ";
        // line 22
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "titre", [], "any", true, true, false, 22)) {
            // line 23
            yield "                    <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 23, $this->source); })()), "titre", [], "any", false, false, false, 23), "html", null, true);
            yield "</div>
                ";
        }
        // line 25
        yield "            </div>

            ";
        // line 28
        yield "            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Description</label>
                <textarea name=\"description\" id=\"event_description\" rows=\"4\"
                          class=\"w-full px-4 py-3 rounded-xl border border-outline/30 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition\"
                          placeholder=\"Décrivez l'événement…\">";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 32, $this->source); })()), "description", [], "any", false, false, false, 32), "html", null, true);
        yield "</textarea>
            </div>

            <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-5\">
                ";
        // line 37
        yield "                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Date *</label>
                    <input type=\"date\" name=\"date\" id=\"event_date\" value=\"";
        // line 39
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 39, $this->source); })()), "date", [], "any", false, false, false, 39)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 39, $this->source); })()), "date", [], "any", false, false, false, 39), "Y-m-d"), "html", null, true)) : (""));
        yield "\"
                           class=\"w-full px-4 py-3 rounded-xl border ";
        // line 40
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "date", [], "any", true, true, false, 40)) ? ("border-red-400 ring-1 ring-red-300") : ("border-outline/30 focus:ring-primary"));
        yield " bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\">
                    ";
        // line 41
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "date", [], "any", true, true, false, 41)) {
            // line 42
            yield "                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 42, $this->source); })()), "date", [], "any", false, false, false, 42), "html", null, true);
            yield "</div>
                    ";
        }
        // line 44
        yield "                </div>

                ";
        // line 47
        yield "                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Type *</label>
                    <select name=\"type\" id=\"event_type\"
                            class=\"w-full px-4 py-3 rounded-xl border ";
        // line 50
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "type", [], "any", true, true, false, 50)) ? ("border-red-400 ring-1 ring-red-300") : ("border-outline/30 focus:ring-primary"));
        yield " bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\">
                        <option value=\"\">-- Choisir --</option>
                        ";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["types"]) || array_key_exists("types", $context) ? $context["types"] : (function () { throw new RuntimeError('Variable "types" does not exist.', 52, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            // line 53
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["t"], "value", [], "any", false, false, false, 53), "html", null, true);
            yield "\" ";
            yield ((( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 53, $this->source); })()), "type", [], "any", false, false, false, 53)) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 53, $this->source); })()), "type", [], "any", false, false, false, 53), "value", [], "any", false, false, false, 53) == CoreExtension::getAttribute($this->env, $this->source, $context["t"], "value", [], "any", false, false, false, 53)))) ? ("selected") : (""));
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["t"], "label", [], "method", false, false, false, 53), "html", null, true);
            yield "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['t'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        yield "                    </select>
                    ";
        // line 56
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "type", [], "any", true, true, false, 56)) {
            // line 57
            yield "                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 57, $this->source); })()), "type", [], "any", false, false, false, 57), "html", null, true);
            yield "</div>
                    ";
        }
        // line 59
        yield "                </div>
            </div>

            <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-5\">
                ";
        // line 64
        yield "                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Capacité *</label>
                    <input type=\"number\" name=\"capacite\" id=\"event_capacite\" value=\"";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 66, $this->source); })()), "capacite", [], "any", false, false, false, 66), "html", null, true);
        yield "\"
                           class=\"w-full px-4 py-3 rounded-xl border ";
        // line 67
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "capacite", [], "any", true, true, false, 67)) ? ("border-red-400 ring-1 ring-red-300") : ("border-outline/30 focus:ring-primary"));
        yield " bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\"
                           placeholder=\"Nombre de places\">
                    ";
        // line 69
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "capacite", [], "any", true, true, false, 69)) {
            // line 70
            yield "                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 70, $this->source); })()), "capacite", [], "any", false, false, false, 70), "html", null, true);
            yield "</div>
                    ";
        }
        // line 72
        yield "                </div>

                ";
        // line 75
        yield "                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Statut</label>
                    <select name=\"statut\"
                            class=\"w-full px-4 py-3 rounded-xl border border-outline/30 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition\">
                        <option value=\"1\" ";
        // line 79
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 79, $this->source); })()), "statut", [], "any", false, false, false, 79)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("selected") : (""));
        yield ">Actif</option>
                        <option value=\"0\" ";
        // line 80
        yield (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 80, $this->source); })()), "statut", [], "any", false, false, false, 80)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("selected") : (""));
        yield ">Inactif</option>
                    </select>
                </div>
            </div>

            ";
        // line 86
        yield "            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Image de l'événement (Optionnel)</label>
                ";
        // line 88
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 88, $this->source); })()), "image", [], "any", false, false, false, 88)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 89
            yield "                    <div class=\"mb-2\">
                        <img src=\"";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/events/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 90, $this->source); })()), "image", [], "any", false, false, false, 90))), "html", null, true);
            yield "\" alt=\"Image\" class=\"h-20 rounded-xl object-cover\">
                    </div>
                ";
        }
        // line 93
        yield "                <input type=\"file\" name=\"image\" id=\"event_image\" accept=\"image/*\"
                       class=\"w-full px-4 py-3 rounded-xl border border-outline/30 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition\">
                ";
        // line 95
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "image", [], "any", true, true, false, 95)) {
            // line 96
            yield "                    <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 96, $this->source); })()), "image", [], "any", false, false, false, 96), "html", null, true);
            yield "</div>
                ";
        }
        // line 98
        yield "            </div>

            ";
        // line 101
        yield "            <div class=\"flex gap-3 pt-4\">
                <a href=\"";
        // line 102
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_index");
        yield "\"
                   class=\"flex-1 py-3.5 rounded-2xl border border-outline/40 text-sm font-bold text-on-surface-variant hover:bg-gray-50 transition-colors text-center\">Annuler</a>
                <button type=\"submit\"
                        class=\"flex-2 px-8 py-3.5 rounded-2xl bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 hover:bg-indigo-700 active:scale-95 transition-all\">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function validateEventForm(e) {
    // Clear previous errors
    document.querySelectorAll('.js-error-msg').forEach(el => el.remove());
    document.querySelectorAll('.border-red-400').forEach(el => el.classList.remove('border-red-400', 'ring-1', 'ring-red-300'));
    
    let isValid = true;

    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        input.classList.add('border-red-400', 'ring-1', 'ring-red-300');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'js-error-msg text-[10px] text-red-500 mt-1 font-semibold';
        errorDiv.innerText = message;
        input.parentNode.appendChild(errorDiv);
        isValid = false;
    }

    const titre = document.getElementById('event_titre').value.trim();
    if (titre.length < 2) {
        showError('event_titre', 'Le titre est obligatoire et doit faire au moins 2 caractères.');
    }

    const description = document.getElementById('event_description').value.trim();
    if (description.length > 0 && description.length < 10) {
        showError('event_description', 'La description doit faire au moins 10 caractères.');
    }

    const dateStr = document.getElementById('event_date').value;
    if (!dateStr) {
        showError('event_date', 'La date de l\\'événement est obligatoire.');
    }

    const type = document.getElementById('event_type').value;
    if (!type) {
        showError('event_type', 'Veuillez sélectionner un type d\\'événement.');
    }

    const capacite = document.getElementById('event_capacite').value;
    if (!capacite || parseInt(capacite) < 1) {
        showError('event_capacite', 'La capacité doit être un nombre positif (1 ou plus).');
    }

    if (!isValid) {
        e.preventDefault();
    }
    return isValid;
}
</script>
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
        return "admin/event/edit.html.twig";
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
        return array (  279 => 102,  276 => 101,  272 => 98,  266 => 96,  264 => 95,  260 => 93,  254 => 90,  251 => 89,  249 => 88,  245 => 86,  237 => 80,  233 => 79,  227 => 75,  223 => 72,  217 => 70,  215 => 69,  210 => 67,  206 => 66,  202 => 64,  196 => 59,  190 => 57,  188 => 56,  185 => 55,  172 => 53,  168 => 52,  163 => 50,  158 => 47,  154 => 44,  148 => 42,  146 => 41,  142 => 40,  138 => 39,  134 => 37,  127 => 32,  121 => 28,  117 => 25,  111 => 23,  109 => 22,  104 => 20,  100 => 19,  96 => 17,  91 => 14,  81 => 7,  76 => 4,  63 => 3,  40 => 1,);
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
        <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Modifier l'événement</h2>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm p-8 lg:p-10\">
        <form method=\"post\" action=\"{{ path('admin_event_edit', {id: event.id}) }}\" class=\"space-y-6\" id=\"eventForm\" enctype=\"multipart/form-data\" novalidate onsubmit=\"return validateEventForm(event)\">

            {# Titre #}
            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Titre *</label>
                <input type=\"text\" name=\"titre\" id=\"event_titre\" value=\"{{ event.titre }}\"
                       class=\"w-full px-4 py-3 rounded-xl border {{ errors.titre is defined ? 'border-red-400 ring-1 ring-red-300' : 'border-outline/30 focus:ring-primary' }} bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\"
                       placeholder=\"Nom de l'événement\">
                {% if errors.titre is defined %}
                    <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">{{ errors.titre }}</div>
                {% endif %}
            </div>

            {# Description #}
            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Description</label>
                <textarea name=\"description\" id=\"event_description\" rows=\"4\"
                          class=\"w-full px-4 py-3 rounded-xl border border-outline/30 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition\"
                          placeholder=\"Décrivez l'événement…\">{{ event.description }}</textarea>
            </div>

            <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-5\">
                {# Date #}
                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Date *</label>
                    <input type=\"date\" name=\"date\" id=\"event_date\" value=\"{{ event.date ? event.date|date('Y-m-d') : '' }}\"
                           class=\"w-full px-4 py-3 rounded-xl border {{ errors.date is defined ? 'border-red-400 ring-1 ring-red-300' : 'border-outline/30 focus:ring-primary' }} bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\">
                    {% if errors.date is defined %}
                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">{{ errors.date }}</div>
                    {% endif %}
                </div>

                {# Type #}
                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Type *</label>
                    <select name=\"type\" id=\"event_type\"
                            class=\"w-full px-4 py-3 rounded-xl border {{ errors.type is defined ? 'border-red-400 ring-1 ring-red-300' : 'border-outline/30 focus:ring-primary' }} bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\">
                        <option value=\"\">-- Choisir --</option>
                        {% for t in types %}
                            <option value=\"{{ t.value }}\" {{ event.type is not null and event.type.value == t.value ? 'selected' : '' }}>{{ t.label() }}</option>
                        {% endfor %}
                    </select>
                    {% if errors.type is defined %}
                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">{{ errors.type }}</div>
                    {% endif %}
                </div>
            </div>

            <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-5\">
                {# Capacité #}
                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Capacité *</label>
                    <input type=\"number\" name=\"capacite\" id=\"event_capacite\" value=\"{{ event.capacite }}\"
                           class=\"w-full px-4 py-3 rounded-xl border {{ errors.capacite is defined ? 'border-red-400 ring-1 ring-red-300' : 'border-outline/30 focus:ring-primary' }} bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\"
                           placeholder=\"Nombre de places\">
                    {% if errors.capacite is defined %}
                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">{{ errors.capacite }}</div>
                    {% endif %}
                </div>

                {# Statut #}
                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Statut</label>
                    <select name=\"statut\"
                            class=\"w-full px-4 py-3 rounded-xl border border-outline/30 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition\">
                        <option value=\"1\" {{ event.statut ? 'selected' : '' }}>Actif</option>
                        <option value=\"0\" {{ not event.statut ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

            {# Image #}
            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Image de l'événement (Optionnel)</label>
                {% if event.image %}
                    <div class=\"mb-2\">
                        <img src=\"{{ asset('uploads/events/' ~ event.image) }}\" alt=\"Image\" class=\"h-20 rounded-xl object-cover\">
                    </div>
                {% endif %}
                <input type=\"file\" name=\"image\" id=\"event_image\" accept=\"image/*\"
                       class=\"w-full px-4 py-3 rounded-xl border border-outline/30 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition\">
                {% if errors.image is defined %}
                    <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">{{ errors.image }}</div>
                {% endif %}
            </div>

            {# Submit #}
            <div class=\"flex gap-3 pt-4\">
                <a href=\"{{ path('admin_event_index') }}\"
                   class=\"flex-1 py-3.5 rounded-2xl border border-outline/40 text-sm font-bold text-on-surface-variant hover:bg-gray-50 transition-colors text-center\">Annuler</a>
                <button type=\"submit\"
                        class=\"flex-2 px-8 py-3.5 rounded-2xl bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 hover:bg-indigo-700 active:scale-95 transition-all\">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function validateEventForm(e) {
    // Clear previous errors
    document.querySelectorAll('.js-error-msg').forEach(el => el.remove());
    document.querySelectorAll('.border-red-400').forEach(el => el.classList.remove('border-red-400', 'ring-1', 'ring-red-300'));
    
    let isValid = true;

    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        input.classList.add('border-red-400', 'ring-1', 'ring-red-300');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'js-error-msg text-[10px] text-red-500 mt-1 font-semibold';
        errorDiv.innerText = message;
        input.parentNode.appendChild(errorDiv);
        isValid = false;
    }

    const titre = document.getElementById('event_titre').value.trim();
    if (titre.length < 2) {
        showError('event_titre', 'Le titre est obligatoire et doit faire au moins 2 caractères.');
    }

    const description = document.getElementById('event_description').value.trim();
    if (description.length > 0 && description.length < 10) {
        showError('event_description', 'La description doit faire au moins 10 caractères.');
    }

    const dateStr = document.getElementById('event_date').value;
    if (!dateStr) {
        showError('event_date', 'La date de l\\'événement est obligatoire.');
    }

    const type = document.getElementById('event_type').value;
    if (!type) {
        showError('event_type', 'Veuillez sélectionner un type d\\'événement.');
    }

    const capacite = document.getElementById('event_capacite').value;
    if (!capacite || parseInt(capacite) < 1) {
        showError('event_capacite', 'La capacité doit être un nombre positif (1 ou plus).');
    }

    if (!isValid) {
        e.preventDefault();
    }
    return isValid;
}
</script>
{% endblock %}
", "admin/event/edit.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\admin\\event\\edit.html.twig");
    }
}
