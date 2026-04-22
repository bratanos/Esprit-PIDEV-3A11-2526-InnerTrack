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

/* admin/inscription/new.html.twig */
class __TwigTemplate_4101160a7eedb613434c4c7b73526366 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/inscription/new.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/inscription/new.html.twig"));

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
        <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Nouvelle inscription</h2>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm p-8 lg:p-10\">
        <form method=\"post\" action=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_new");
        yield "\" class=\"space-y-6\" id=\"inscForm\" novalidate onsubmit=\"return validateInscForm(event)\">

            ";
        // line 17
        yield "            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Nom du participant *</label>
                <input type=\"text\" name=\"nom_participant\" id=\"insc_nom\" value=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 19, $this->source); })()), "nomParticipant", [], "any", false, false, false, 19), "html", null, true);
        yield "\"
                       class=\"w-full px-4 py-3 rounded-xl border ";
        // line 20
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "nom_participant", [], "any", true, true, false, 20)) ? ("border-red-400 ring-1 ring-red-300") : ("border-outline/30 focus:ring-primary"));
        yield " bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\"
                       placeholder=\"Nom complet\">
                ";
        // line 22
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "nom_participant", [], "any", true, true, false, 22)) {
            // line 23
            yield "                    <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 23, $this->source); })()), "nom_participant", [], "any", false, false, false, 23), "html", null, true);
            yield "</div>
                ";
        }
        // line 25
        yield "            </div>

            ";
        // line 28
        yield "            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Email *</label>
                <input type=\"email\" name=\"email_participant\" id=\"insc_email\" value=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 30, $this->source); })()), "emailParticipant", [], "any", false, false, false, 30), "html", null, true);
        yield "\"
                       class=\"w-full px-4 py-3 rounded-xl border ";
        // line 31
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "email_participant", [], "any", true, true, false, 31)) ? ("border-red-400 ring-1 ring-red-300") : ("border-outline/30 focus:ring-primary"));
        yield " bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\"
                       placeholder=\"participant@email.com\">
                ";
        // line 33
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "email_participant", [], "any", true, true, false, 33)) {
            // line 34
            yield "                    <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 34, $this->source); })()), "email_participant", [], "any", false, false, false, 34), "html", null, true);
            yield "</div>
                ";
        }
        // line 36
        yield "            </div>

            <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-5\">
                ";
        // line 40
        yield "                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Événement *</label>
                    <select name=\"evenement_id\" id=\"insc_event\"
                            class=\"w-full px-4 py-3 rounded-xl border ";
        // line 43
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "evenement_id", [], "any", true, true, false, 43)) ? ("border-red-400 ring-1 ring-red-300") : ("border-outline/30 focus:ring-primary"));
        yield " bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\">
                        <option value=\"\">-- Choisir --</option>
                        ";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 45, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["ev"]) {
            // line 46
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ev"], "id", [], "any", false, false, false, 46), "html", null, true);
            yield "\" ";
            yield ((( !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 46, $this->source); })()), "evenement", [], "any", false, false, false, 46)) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 46, $this->source); })()), "evenement", [], "any", false, false, false, 46), "id", [], "any", false, false, false, 46) == CoreExtension::getAttribute($this->env, $this->source, $context["ev"], "id", [], "any", false, false, false, 46)))) ? ("selected") : (""));
            yield ">
                                ";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ev"], "titre", [], "any", false, false, false, 47), "html", null, true);
            yield "
                            </option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['ev'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        yield "                    </select>
                    ";
        // line 51
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "evenement_id", [], "any", true, true, false, 51)) {
            // line 52
            yield "                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 52, $this->source); })()), "evenement_id", [], "any", false, false, false, 52), "html", null, true);
            yield "</div>
                    ";
        }
        // line 54
        yield "                </div>

                ";
        // line 57
        yield "                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Date d'inscription *</label>
                    <input type=\"date\" name=\"date_inscription\" id=\"insc_date\" value=\"";
        // line 59
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 59, $this->source); })()), "dateInscription", [], "any", false, false, false, 59)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 59, $this->source); })()), "dateInscription", [], "any", false, false, false, 59), "Y-m-d"), "html", null, true)) : (""));
        yield "\"
                           class=\"w-full px-4 py-3 rounded-xl border ";
        // line 60
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "date_inscription", [], "any", true, true, false, 60)) ? ("border-red-400 ring-1 ring-red-300") : ("border-outline/30 focus:ring-primary"));
        yield " bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\">
                    ";
        // line 61
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "date_inscription", [], "any", true, true, false, 61)) {
            // line 62
            yield "                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 62, $this->source); })()), "date_inscription", [], "any", false, false, false, 62), "html", null, true);
            yield "</div>
                    ";
        }
        // line 64
        yield "                </div>
            </div>

            <div class=\"flex gap-3 pt-4\">
                <a href=\"";
        // line 68
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_index");
        yield "\"
                   class=\"flex-1 py-3.5 rounded-2xl border border-outline/40 text-sm font-bold text-on-surface-variant hover:bg-gray-50 transition-colors text-center\">Annuler</a>
                <button type=\"submit\"
                        class=\"flex-2 px-8 py-3.5 rounded-2xl bg-secondary text-white text-sm font-bold shadow-lg shadow-secondary/20 hover:bg-teal-700 active:scale-95 transition-all\">
                    Inscrire
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function validateInscForm(e) {
    document.querySelectorAll('.js-error-msg').forEach(el => el.remove());
    document.querySelectorAll('.border-red-400').forEach(el => el.classList.remove('border-red-400', 'ring-1', 'ring-red-300'));
    
    let isValid = true;

    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        if(!input) return;
        input.classList.add('border-red-400', 'ring-1', 'ring-red-300');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'js-error-msg text-[10px] text-red-500 mt-1 font-semibold';
        errorDiv.innerText = message;
        input.parentNode.appendChild(errorDiv);
        isValid = false;
    }

    const nom = document.getElementById('insc_nom').value.trim();
    if (nom.length < 2) {
        showError('insc_nom', 'Le nom du participant est obligatoire et doit faire au moins 2 caractères.');
    }

    const email = document.getElementById('insc_email').value.trim();
    const emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;
    if (!emailRegex.test(email)) {
        showError('insc_email', 'Veuillez saisir une adresse email valide.');
    }

    const eventId = document.getElementById('insc_event').value;
    if (!eventId) {
        showError('insc_event', 'Veuillez sélectionner un événement.');
    }

    const dateStr = document.getElementById('insc_date').value;
    if (!dateStr) {
        showError('insc_date', 'La date d\\'inscription est obligatoire.');
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
        return "admin/inscription/new.html.twig";
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
        return array (  218 => 68,  212 => 64,  206 => 62,  204 => 61,  200 => 60,  196 => 59,  192 => 57,  188 => 54,  182 => 52,  180 => 51,  177 => 50,  168 => 47,  161 => 46,  157 => 45,  152 => 43,  147 => 40,  142 => 36,  136 => 34,  134 => 33,  129 => 31,  125 => 30,  121 => 28,  117 => 25,  111 => 23,  109 => 22,  104 => 20,  100 => 19,  96 => 17,  91 => 14,  81 => 7,  76 => 4,  63 => 3,  40 => 1,);
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
        <h2 class=\"text-3xl font-extrabold font-headline tracking-tighter\">Nouvelle inscription</h2>
    </div>

    <div class=\"bg-white rounded-[2.5rem] border border-outline/20 shadow-sm p-8 lg:p-10\">
        <form method=\"post\" action=\"{{ path('admin_inscription_new') }}\" class=\"space-y-6\" id=\"inscForm\" novalidate onsubmit=\"return validateInscForm(event)\">

            {# Nom participant #}
            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Nom du participant *</label>
                <input type=\"text\" name=\"nom_participant\" id=\"insc_nom\" value=\"{{ inscription.nomParticipant }}\"
                       class=\"w-full px-4 py-3 rounded-xl border {{ errors.nom_participant is defined ? 'border-red-400 ring-1 ring-red-300' : 'border-outline/30 focus:ring-primary' }} bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\"
                       placeholder=\"Nom complet\">
                {% if errors.nom_participant is defined %}
                    <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">{{ errors.nom_participant }}</div>
                {% endif %}
            </div>

            {# Email participant #}
            <div>
                <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Email *</label>
                <input type=\"email\" name=\"email_participant\" id=\"insc_email\" value=\"{{ inscription.emailParticipant }}\"
                       class=\"w-full px-4 py-3 rounded-xl border {{ errors.email_participant is defined ? 'border-red-400 ring-1 ring-red-300' : 'border-outline/30 focus:ring-primary' }} bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\"
                       placeholder=\"participant@email.com\">
                {% if errors.email_participant is defined %}
                    <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">{{ errors.email_participant }}</div>
                {% endif %}
            </div>

            <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-5\">
                {# Événement #}
                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Événement *</label>
                    <select name=\"evenement_id\" id=\"insc_event\"
                            class=\"w-full px-4 py-3 rounded-xl border {{ errors.evenement_id is defined ? 'border-red-400 ring-1 ring-red-300' : 'border-outline/30 focus:ring-primary' }} bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\">
                        <option value=\"\">-- Choisir --</option>
                        {% for ev in events %}
                            <option value=\"{{ ev.id }}\" {{ inscription.evenement is not null and inscription.evenement.id == ev.id ? 'selected' : '' }}>
                                {{ ev.titre }}
                            </option>
                        {% endfor %}
                    </select>
                    {% if errors.evenement_id is defined %}
                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">{{ errors.evenement_id }}</div>
                    {% endif %}
                </div>

                {# Date inscription #}
                <div>
                    <label class=\"text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant mb-1 block\">Date d'inscription *</label>
                    <input type=\"date\" name=\"date_inscription\" id=\"insc_date\" value=\"{{ inscription.dateInscription ? inscription.dateInscription|date('Y-m-d') : '' }}\"
                           class=\"w-full px-4 py-3 rounded-xl border {{ errors.date_inscription is defined ? 'border-red-400 ring-1 ring-red-300' : 'border-outline/30 focus:ring-primary' }} bg-gray-50 text-sm focus:outline-none focus:ring-2 transition\">
                    {% if errors.date_inscription is defined %}
                        <div class=\"text-[10px] text-red-500 mt-1 font-semibold\">{{ errors.date_inscription }}</div>
                    {% endif %}
                </div>
            </div>

            <div class=\"flex gap-3 pt-4\">
                <a href=\"{{ path('admin_inscription_index') }}\"
                   class=\"flex-1 py-3.5 rounded-2xl border border-outline/40 text-sm font-bold text-on-surface-variant hover:bg-gray-50 transition-colors text-center\">Annuler</a>
                <button type=\"submit\"
                        class=\"flex-2 px-8 py-3.5 rounded-2xl bg-secondary text-white text-sm font-bold shadow-lg shadow-secondary/20 hover:bg-teal-700 active:scale-95 transition-all\">
                    Inscrire
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function validateInscForm(e) {
    document.querySelectorAll('.js-error-msg').forEach(el => el.remove());
    document.querySelectorAll('.border-red-400').forEach(el => el.classList.remove('border-red-400', 'ring-1', 'ring-red-300'));
    
    let isValid = true;

    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        if(!input) return;
        input.classList.add('border-red-400', 'ring-1', 'ring-red-300');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'js-error-msg text-[10px] text-red-500 mt-1 font-semibold';
        errorDiv.innerText = message;
        input.parentNode.appendChild(errorDiv);
        isValid = false;
    }

    const nom = document.getElementById('insc_nom').value.trim();
    if (nom.length < 2) {
        showError('insc_nom', 'Le nom du participant est obligatoire et doit faire au moins 2 caractères.');
    }

    const email = document.getElementById('insc_email').value.trim();
    const emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;
    if (!emailRegex.test(email)) {
        showError('insc_email', 'Veuillez saisir une adresse email valide.');
    }

    const eventId = document.getElementById('insc_event').value;
    if (!eventId) {
        showError('insc_event', 'Veuillez sélectionner un événement.');
    }

    const dateStr = document.getElementById('insc_date').value;
    if (!dateStr) {
        showError('insc_date', 'La date d\\'inscription est obligatoire.');
    }

    if (!isValid) {
        e.preventDefault();
    }
    return isValid;
}
</script>
{% endblock %}
", "admin/inscription/new.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\admin\\inscription\\new.html.twig");
    }
}
