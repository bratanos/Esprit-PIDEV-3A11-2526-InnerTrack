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

/* journal/entree/modifier.html.twig */
class __TwigTemplate_d4cc85d2158731ea4cc9122cfd3c1dda extends Template
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
            'head' => [$this, 'block_head'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "journal/entree/modifier.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "journal/entree/modifier.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head"));

        // line 4
        yield from $this->yieldParentBlock("head", $context, $blocks);
        yield "
<style>
input[type=range].slider-humeur {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 999px;
    outline: none;
    cursor: pointer;
    background: #e2e8f0;
}
input[type=range].slider-humeur::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: white;
    border: 3px solid #ccc;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    cursor: pointer;
    transition: border-color 0.2s;
}
input[type=range].slider-humeur::-webkit-slider-thumb:hover {
    border-color: #006876;
}
</style>

<script>
function getColorHumeur(val) {
    return val >= 8 ? '#48bb78' : val >= 6 ? '#68d391' : val >= 4 ? '#f6ad55' : val >= 2 ? '#fc8181' : '#ff4444';
}

function updateHumeur(slider) {
    const val = parseInt(slider.value);
    const min = parseInt(slider.min) || 1;
    const max = parseInt(slider.max) || 10;
    const pct = ((val - min) / (max - min)) * 100;
    const color = getColorHumeur(val);
    slider.setAttribute('style',
        `background: linear-gradient(to right, \${color} \${pct}%, #e2e8f0 \${pct}%) !important`
    );
    const span = document.getElementById('val_humeur');
    if (span) {
        span.textContent = val;
        span.style.color = color;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider-humeur');
    if (slider) updateHumeur(slider);
});
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 61
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

        // line 62
        yield "<div class=\"max-w-xl mx-auto\">

    ";
        // line 65
        yield "    <div class=\"rounded-2xl overflow-hidden mb-6\"
         style=\"background: linear-gradient(to right, #006876, #008a9a)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">✏️ Modifier l'entrée</h1>
            <p class=\"text-[#b2e8ed] text-sm mt-1\">
                📅 ";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 70, $this->source); })()), "dateSaisie", [], "any", false, false, false, 70), "d/m/Y"), "html", null, true);
        yield "
            </p>
        </div>
    </div>

    ";
        // line 75
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 75, $this->source); })()), 'form_start', ["attr" => ["class" => "space-y-4", "novalidate" => "novalidate"]]);
        yield "

";
        // line 77
        if (( !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 77, $this->source); })()), "vars", [], "any", false, false, false, 77), "valid", [], "any", false, false, false, 77) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 77, $this->source); })()), "vars", [], "any", false, false, false, 77), "submitted", [], "any", false, false, false, 77))) {
            // line 78
            yield "    <div class=\"bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm\">
        ⚠️ Champs Obligatoire!
    </div>
";
        }
        // line 82
        yield "
    ";
        // line 83
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 83, $this->source); })()), 'form_start', ["attr" => ["class" => "space-y-4"]]);
        yield "

        ";
        // line 86
        yield "        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6\">
            <h2 class=\"text-sm font-bold text-gray-500 mb-4\">😊 Humeur du jour</h2>
            <div class=\"flex items-center gap-4\">
                ";
        // line 89
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 89, $this->source); })()), "humeur", [], "any", false, false, false, 89), 'widget', ["attr" => ["class" => "slider-humeur", "oninput" => "updateHumeur(this)"]]);
        // line 92
        yield "
                <span id=\"val_humeur\" class=\"text-sm font-bold w-8 text-center\">
                    ";
        // line 94
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "humeur", [], "any", false, true, false, 94), "vars", [], "any", false, true, false, 94), "value", [], "any", true, true, false, 94) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 94, $this->source); })()), "humeur", [], "any", false, false, false, 94), "vars", [], "any", false, false, false, 94), "value", [], "any", false, false, false, 94)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 94, $this->source); })()), "humeur", [], "any", false, false, false, 94), "vars", [], "any", false, false, false, 94), "value", [], "any", false, false, false, 94), "html", null, true)) : (5));
        yield "
                </span>
            </div>
            <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
                <span>1 — Très difficile</span>
                <span>10 — Excellent</span>
            </div>
        </div>

        ";
        // line 104
        yield "<div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4\">
    <div>
        ";
        // line 106
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 106, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 106), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
        ";
        // line 107
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 107, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 107), 'widget', ["attr" => ["class" => ("w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 " . (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 109
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 109, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 109), "vars", [], "any", false, false, false, 109), "errors", [], "any", false, false, false, 109)) > 0)) ? ("border-red-400 focus:ring-red-300 bg-red-50") : ("border-gray-200 focus:ring-[#006876]")))]]);
        // line 110
        yield "
        ";
        // line 111
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 111, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 111), "vars", [], "any", false, false, false, 111), "errors", [], "any", false, false, false, 111)) > 0)) {
            // line 112
            yield "            <p class=\"text-red-500 text-xs mt-1 font-medium flex items-center gap-1\">
                ⚠️ ";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 113, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 113), "vars", [], "any", false, false, false, 113), "errors", [], "any", false, false, false, 113), 0, [], "array", false, false, false, 113), "message", [], "any", false, false, false, 113), "html", null, true);
            yield "
            </p>
        ";
        }
        // line 116
        yield "    </div>
    <div>
        ";
        // line 118
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 118, $this->source); })()), "dateSaisie", [], "any", false, false, false, 118), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
        ";
        // line 119
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 119, $this->source); })()), "dateSaisie", [], "any", false, false, false, 119), 'widget', ["attr" => ["class" => ("w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 " . (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 121
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 121, $this->source); })()), "dateSaisie", [], "any", false, false, false, 121), "vars", [], "any", false, false, false, 121), "errors", [], "any", false, false, false, 121)) > 0)) ? ("border-red-400 bg-red-50") : ("border-gray-200 focus:ring-[#006876]")))]]);
        // line 122
        yield "
        ";
        // line 123
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 123, $this->source); })()), "dateSaisie", [], "any", false, false, false, 123), "vars", [], "any", false, false, false, 123), "errors", [], "any", false, false, false, 123)) > 0)) {
            // line 124
            yield "            <p class=\"text-red-500 text-xs mt-1 font-medium\">
                ⚠️ ";
            // line 125
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 125, $this->source); })()), "dateSaisie", [], "any", false, false, false, 125), "vars", [], "any", false, false, false, 125), "errors", [], "any", false, false, false, 125), 0, [], "array", false, false, false, 125), "message", [], "any", false, false, false, 125), "html", null, true);
            yield "
            </p>
        ";
        }
        // line 128
        yield "    </div>
</div>

        ";
        // line 132
        yield "        <div class=\"flex gap-3\">
            <a href=\"";
        // line 133
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_index");
        yield "\"
               class=\"flex-1 text-center bg-gray-100 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition\">
                ✕ Annuler
            </a>
            <button type=\"submit\"
                    class=\"flex-1 bg-[#006876] text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
                ✅ Sauvegarder
            </button>
        </div>

    ";
        // line 143
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 143, $this->source); })()), 'form_end');
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
        return "journal/entree/modifier.html.twig";
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
        return array (  291 => 143,  278 => 133,  275 => 132,  270 => 128,  264 => 125,  261 => 124,  259 => 123,  256 => 122,  254 => 121,  253 => 119,  249 => 118,  245 => 116,  239 => 113,  236 => 112,  234 => 111,  231 => 110,  229 => 109,  228 => 107,  224 => 106,  220 => 104,  208 => 94,  204 => 92,  202 => 89,  197 => 86,  192 => 83,  189 => 82,  183 => 78,  181 => 77,  176 => 75,  168 => 70,  161 => 65,  157 => 62,  144 => 61,  77 => 4,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block head %}
{{ parent() }}
<style>
input[type=range].slider-humeur {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 999px;
    outline: none;
    cursor: pointer;
    background: #e2e8f0;
}
input[type=range].slider-humeur::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: white;
    border: 3px solid #ccc;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    cursor: pointer;
    transition: border-color 0.2s;
}
input[type=range].slider-humeur::-webkit-slider-thumb:hover {
    border-color: #006876;
}
</style>

<script>
function getColorHumeur(val) {
    return val >= 8 ? '#48bb78' : val >= 6 ? '#68d391' : val >= 4 ? '#f6ad55' : val >= 2 ? '#fc8181' : '#ff4444';
}

function updateHumeur(slider) {
    const val = parseInt(slider.value);
    const min = parseInt(slider.min) || 1;
    const max = parseInt(slider.max) || 10;
    const pct = ((val - min) / (max - min)) * 100;
    const color = getColorHumeur(val);
    slider.setAttribute('style',
        `background: linear-gradient(to right, \${color} \${pct}%, #e2e8f0 \${pct}%) !important`
    );
    const span = document.getElementById('val_humeur');
    if (span) {
        span.textContent = val;
        span.style.color = color;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider-humeur');
    if (slider) updateHumeur(slider);
});
</script>
{% endblock %}

{% block content %}
<div class=\"max-w-xl mx-auto\">

    {# EN-TÊTE #}
    <div class=\"rounded-2xl overflow-hidden mb-6\"
         style=\"background: linear-gradient(to right, #006876, #008a9a)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">✏️ Modifier l'entrée</h1>
            <p class=\"text-[#b2e8ed] text-sm mt-1\">
                📅 {{ entree.dateSaisie|date('d/m/Y') }}
            </p>
        </div>
    </div>

    {{ form_start(form, {attr: {class: 'space-y-4', novalidate: 'novalidate'}}) }}

{% if not form.vars.valid and form.vars.submitted %}
    <div class=\"bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm\">
        ⚠️ Champs Obligatoire!
    </div>
{% endif %}

    {{ form_start(form, {attr: {class: 'space-y-4'}}) }}

        {# 1. HUMEUR #}
        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6\">
            <h2 class=\"text-sm font-bold text-gray-500 mb-4\">😊 Humeur du jour</h2>
            <div class=\"flex items-center gap-4\">
                {{ form_widget(form.humeur, {attr: {
                    class: 'slider-humeur',
                    oninput: 'updateHumeur(this)'
                }}) }}
                <span id=\"val_humeur\" class=\"text-sm font-bold w-8 text-center\">
                    {{ form.humeur.vars.value ?? 5 }}
                </span>
            </div>
            <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
                <span>1 — Très difficile</span>
                <span>10 — Excellent</span>
            </div>
        </div>

        {# 2. NOTE + DATE #}
<div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4\">
    <div>
        {{ form_label(form.noteTextuelle, null, {label_attr: {class: 'block text-sm font-semibold text-gray-600 mb-1'}}) }}
        {{ form_widget(form.noteTextuelle, {attr: {
            class: 'w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 ' ~
                   (form.noteTextuelle.vars.errors|length > 0 ? 'border-red-400 focus:ring-red-300 bg-red-50' : 'border-gray-200 focus:ring-[#006876]')
        }}) }}
        {% if form.noteTextuelle.vars.errors|length > 0 %}
            <p class=\"text-red-500 text-xs mt-1 font-medium flex items-center gap-1\">
                ⚠️ {{ form.noteTextuelle.vars.errors[0].message }}
            </p>
        {% endif %}
    </div>
    <div>
        {{ form_label(form.dateSaisie, null, {label_attr: {class: 'block text-sm font-semibold text-gray-600 mb-1'}}) }}
        {{ form_widget(form.dateSaisie, {attr: {
            class: 'w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 ' ~
                   (form.dateSaisie.vars.errors|length > 0 ? 'border-red-400 bg-red-50' : 'border-gray-200 focus:ring-[#006876]')
        }}) }}
        {% if form.dateSaisie.vars.errors|length > 0 %}
            <p class=\"text-red-500 text-xs mt-1 font-medium\">
                ⚠️ {{ form.dateSaisie.vars.errors[0].message }}
            </p>
        {% endif %}
    </div>
</div>

        {# 3. BOUTONS #}
        <div class=\"flex gap-3\">
            <a href=\"{{ path('entree_index') }}\"
               class=\"flex-1 text-center bg-gray-100 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition\">
                ✕ Annuler
            </a>
            <button type=\"submit\"
                    class=\"flex-1 bg-[#006876] text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
                ✅ Sauvegarder
            </button>
        </div>

    {{ form_end(form) }}
</div>
{% endblock %}", "journal/entree/modifier.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\Journal\\entree\\modifier.html.twig");
    }
}
