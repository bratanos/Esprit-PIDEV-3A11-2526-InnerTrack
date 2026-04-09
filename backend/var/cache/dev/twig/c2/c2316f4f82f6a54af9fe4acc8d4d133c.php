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

/* Journal/habitude/ajouter.html.twig */
class __TwigTemplate_d45ca918cd7b07c991963529efb203a6 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Journal/habitude/ajouter.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Journal/habitude/ajouter.html.twig"));

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
input[type=range].slider-energie,
input[type=range].slider-stress,
input[type=range].slider-sommeil {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 999px;
    outline: none;
    cursor: pointer;
    background: #e2e8f0;
}

input[type=range].slider-energie::-webkit-slider-thumb,
input[type=range].slider-stress::-webkit-slider-thumb,
input[type=range].slider-sommeil::-webkit-slider-thumb {
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

input[type=range].slider-energie::-webkit-slider-thumb:hover,
input[type=range].slider-stress::-webkit-slider-thumb:hover,
input[type=range].slider-sommeil::-webkit-slider-thumb:hover {
    border-color: #006876;
}
</style>

<script>

function getColor(type, val) {
    if (type === 'energie') {
        return val >= 7 ? '#48bb78' : val >= 4 ? '#f6ad55' : '#ff4444';
    } else if (type === 'stress') {
        return val >= 7 ? '#ff4444' : val >= 4 ? '#f6ad55' : '#63b3ed';
    } else {
        return val >= 7 ? '#b794f4' : val >= 4 ? '#4299e1' : '#a0aec0';
    }
}

function updateSlider(slider, spanId, type) {
    const val = parseInt(slider.value);
    const max = parseInt(slider.max) || 10;
    const pct = (val / max) * 100;
    const color = getColor(type, val);

    slider.setAttribute('style',
        `background: linear-gradient(to right, \${color} \${pct}%, #e2e8f0 \${pct}%) !important`
    );

    const span = document.getElementById(spanId);
    if (span) {
        span.textContent = val;
        span.style.color = color;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const sliders = [
        { el: document.querySelector('.slider-energie'), span: 'val_energie', type: 'energie' },
        { el: document.querySelector('.slider-stress'),  span: 'val_stress',  type: 'stress'  },
        { el: document.querySelector('.slider-sommeil'), span: 'val_sommeil', type: 'sommeil' },
    ];
    sliders.forEach(s => {
        if (s.el) updateSlider(s.el, s.span, s.type);
    });
});

function interpolateColor(c1, c2, t) {
    const hex = h => parseInt(h, 16);
    const r1 = hex(c1.slice(1,3)), g1 = hex(c1.slice(3,5)), b1 = hex(c1.slice(5,7));
    const r2 = hex(c2.slice(1,3)), g2 = hex(c2.slice(3,5)), b2 = hex(c2.slice(5,7));
    const r = Math.round(r1 + (r2-r1)*t);
    const g = Math.round(g1 + (g2-g1)*t);
    const b = Math.round(b1 + (b2-b1)*t);
    return `rgb(\${r},\${g},\${b})`;
}

// Init au chargement
document.addEventListener('DOMContentLoaded', function() {
    const sliders = [
        { el: document.querySelector('.slider-energie'), span: 'val_energie', c1: '#48bb78', c2: '#ff4444' },
        { el: document.querySelector('.slider-stress'),  span: 'val_stress',  c1: '#63b3ed', c2: '#ff4444' },
        { el: document.querySelector('.slider-sommeil'), span: 'val_sommeil', c1: '#a0aec0', c2: '#b794f4' },
    ];
    sliders.forEach(s => {
        if (s.el) {
            const val = parseInt(s.el.value);
            const max = parseInt(s.el.max) || 10;
            const pct = (val / max) * 100;
            s.el.setAttribute('style', 
                `background: linear-gradient(to right, \${s.c1} 0%, \${s.c2} \${pct}%, #e2e8f0 \${pct}%) !important`
            );

            const span = document.getElementById(s.span);
        if (span) {
            span.textContent = val;
            span.style.color = interpolateColor(s.c1, s.c2, pct / 100);
        }
    }
    });

// Cacher erreur nom quand l'utilisateur tape
    const nomInput = document.querySelector('#habitude_nomHabitude');
    if (nomInput) {
        nomInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('border-red-400', 'bg-red-50');
                this.classList.add('border-gray-200');
                const err = this.parentElement.querySelector('p.text-red-500');
                if (err) err.style.display = 'none';
            }
        });
    }


    // Cacher erreur émotion quand l'utilisateur choisit
    const emotionSelect = document.querySelector('#habitude_emotionDominantes');
    if (emotionSelect) {
        const placeholder = emotionSelect.querySelector('option[value=\"\"]');
        if (placeholder) placeholder.disabled = true;
        emotionSelect.addEventListener('change', function() {
            if (this.value !== '') {
                this.classList.remove('border-red-400', 'bg-red-50');
                this.classList.add('border-gray-200');
                const err = this.parentElement.querySelector('p.text-red-500');
                if (err) err.style.display = 'none';
            }
        });
    }
});

</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 148
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

        // line 149
        yield "<div class=\"max-w-xl mx-auto\">

    ";
        // line 152
        yield "    <div class=\"rounded-2xl overflow-hidden mb-6\"
         style=\"background: linear-gradient(to right, #5a3ea1, #7c5cbf)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">✨ Nouvelle Habitude</h1>
            <p class=\"text-[#d8ccf5] text-sm mt-1\">Enregistrez votre habitude du jour</p>
        </div>
    </div>

    ";
        // line 160
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 160, $this->source); })()), 'form_start', ["attr" => ["class" => "space-y-4", "novalidate" => "novalidate"]]);
        yield "

    ";
        // line 162
        if (( !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 162, $this->source); })()), "vars", [], "any", false, false, false, 162), "valid", [], "any", false, false, false, 162) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 162, $this->source); })()), "vars", [], "any", false, false, false, 162), "submitted", [], "any", false, false, false, 162))) {
            // line 163
            yield "    <div class=\"bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm\">
        ⚠️ Champs Obligatoire! 
    </div>
";
        }
        // line 167
        yield "
        ";
        // line 169
        yield "        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4\">
            <div>
    ";
        // line 171
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 171, $this->source); })()), "nomHabitude", [], "any", false, false, false, 171), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
    ";
        // line 172
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 172, $this->source); })()), "nomHabitude", [], "any", false, false, false, 172), 'widget', ["attr" => ["class" => ("w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 " . (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 174
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 174, $this->source); })()), "nomHabitude", [], "any", false, false, false, 174), "vars", [], "any", false, false, false, 174), "errors", [], "any", false, false, false, 174)) > 0)) ? ("border-red-400 focus:ring-red-300 bg-red-50") : ("border-gray-200 focus:ring-[#006876]")))]]);
        // line 175
        yield "
    ";
        // line 176
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 176, $this->source); })()), "nomHabitude", [], "any", false, false, false, 176), "vars", [], "any", false, false, false, 176), "errors", [], "any", false, false, false, 176)) > 0)) {
            // line 177
            yield "        <p class=\"text-red-500 text-xs mt-1 font-medium flex items-center gap-1\">
            ⚠️ ";
            // line 178
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 178, $this->source); })()), "nomHabitude", [], "any", false, false, false, 178), "vars", [], "any", false, false, false, 178), "errors", [], "any", false, false, false, 178), 0, [], "array", false, false, false, 178), "message", [], "any", false, false, false, 178), "html", null, true);
            yield "
        </p>
    ";
        }
        // line 181
        yield "</div>
            <div>
    ";
        // line 183
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 183, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 183), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
    ";
        // line 184
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 184, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 184), 'widget', ["attr" => ["class" => ("w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 " . (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 186
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 186, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 186), "vars", [], "any", false, false, false, 186), "errors", [], "any", false, false, false, 186)) > 0)) ? ("border-red-400 bg-red-50 focus:ring-red-300") : ("border-gray-200 focus:ring-[#006876]")))]]);
        // line 187
        yield "
    ";
        // line 188
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 188, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 188), "vars", [], "any", false, false, false, 188), "errors", [], "any", false, false, false, 188)) > 0)) {
            // line 189
            yield "        <p class=\"text-red-500 text-xs mt-1 font-medium\">
            ⚠️ ";
            // line 190
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 190, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 190), "vars", [], "any", false, false, false, 190), "errors", [], "any", false, false, false, 190), 0, [], "array", false, false, false, 190), "message", [], "any", false, false, false, 190), "html", null, true);
            yield "
        </p>
    ";
        }
        // line 193
        yield "</div>
        </div>

        ";
        // line 197
        yield "        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5\">
            <h2 class=\"text-sm font-bold text-gray-500\">📊 Niveaux du jour</h2>

            ";
        // line 201
        yield "    <div>
        ";
        // line 202
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 202, $this->source); })()), "niveauEnergie", [], "any", false, false, false, 202), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-2"]]);
        yield "
        <div class=\"flex items-center gap-4\">
            ";
        // line 204
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 204, $this->source); })()), "niveauEnergie", [], "any", false, false, false, 204), 'widget', ["attr" => ["class" => "slider-energie", "oninput" => "updateSlider(this, 'val_energie', 'energie')"]]);
        // line 207
        yield "
            <span id=\"val_energie\" class=\"text-sm font-bold w-8 text-center\">
    ";
        // line 209
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 209, $this->source); })()), "niveauEnergie", [], "any", false, false, false, 209), "vars", [], "any", false, false, false, 209), "value", [], "any", false, false, false, 209), "html", null, true);
        yield "
</span>
        </div>
        <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
            <span>0 — Vide</span><span>10 — Vitalité</span>
        </div>
    </div>

            ";
        // line 218
        yield "    <div>
        ";
        // line 219
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 219, $this->source); })()), "niveauStress", [], "any", false, false, false, 219), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-2"]]);
        yield "
        <div class=\"flex items-center gap-4\">
            ";
        // line 221
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 221, $this->source); })()), "niveauStress", [], "any", false, false, false, 221), 'widget', ["attr" => ["class" => "slider-stress", "oninput" => "updateSlider(this, 'val_stress', 'stress')"]]);
        // line 224
        yield "
            <span id=\"val_stress\" class=\"text-sm font-bold w-8 text-center\">
    ";
        // line 226
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 226, $this->source); })()), "niveauStress", [], "any", false, false, false, 226), "vars", [], "any", false, false, false, 226), "value", [], "any", false, false, false, 226), "html", null, true);
        yield "
</span>
        </div>
        <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
            <span>0 — Zen</span><span>10 — Alarme</span>
        </div>
    </div>

            ";
        // line 235
        yield "    <div>
        ";
        // line 236
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 236, $this->source); })()), "qualiteSommeil", [], "any", false, false, false, 236), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-2"]]);
        yield "
        <div class=\"flex items-center gap-4\">
            ";
        // line 238
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 238, $this->source); })()), "qualiteSommeil", [], "any", false, false, false, 238), 'widget', ["attr" => ["class" => "slider-sommeil", "oninput" => "updateSlider(this, 'val_sommeil', 'sommeil')"]]);
        // line 241
        yield "
            <span id=\"val_sommeil\" class=\"text-sm font-bold w-8 text-center\">
    ";
        // line 243
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 243, $this->source); })()), "qualiteSommeil", [], "any", false, false, false, 243), "vars", [], "any", false, false, false, 243), "value", [], "any", false, false, false, 243), "html", null, true);
        yield "
</span>
        </div>
        <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
            <span>0 — Fatigué</span><span>10 — Récupéré</span>
        </div>
    </div>
</div>

        ";
        // line 253
        yield "        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4\">
            <div>
                ";
        // line 255
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 255, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 255), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
                ";
        // line 256
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 256, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 256), 'widget');
        yield "
            </div>
            <div>
                ";
        // line 259
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 259, $this->source); })()), "dateCreation", [], "any", false, false, false, 259), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
                ";
        // line 260
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 260, $this->source); })()), "dateCreation", [], "any", false, false, false, 260), 'widget');
        yield "
            </div>
        </div>

        ";
        // line 265
        yield "        <div class=\"flex gap-3\">
            <a href=\"";
        // line 266
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_index");
        yield "\"
               class=\"flex-1 text-center bg-gray-100 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition\">
                ✕ Annuler
            </a>
            <button type=\"submit\"
                    class=\"flex-1 bg-[#006876] text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
                ✅ Enregistrer
            </button>
        </div>

    ";
        // line 276
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 276, $this->source); })()), 'form_end');
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
        return "Journal/habitude/ajouter.html.twig";
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
        return array (  451 => 276,  438 => 266,  435 => 265,  428 => 260,  424 => 259,  418 => 256,  414 => 255,  410 => 253,  398 => 243,  394 => 241,  392 => 238,  387 => 236,  384 => 235,  373 => 226,  369 => 224,  367 => 221,  362 => 219,  359 => 218,  348 => 209,  344 => 207,  342 => 204,  337 => 202,  334 => 201,  329 => 197,  324 => 193,  318 => 190,  315 => 189,  313 => 188,  310 => 187,  308 => 186,  307 => 184,  303 => 183,  299 => 181,  293 => 178,  290 => 177,  288 => 176,  285 => 175,  283 => 174,  282 => 172,  278 => 171,  274 => 169,  271 => 167,  265 => 163,  263 => 162,  258 => 160,  248 => 152,  244 => 149,  231 => 148,  77 => 4,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block head %}
{{ parent() }}
<style>
input[type=range].slider-energie,
input[type=range].slider-stress,
input[type=range].slider-sommeil {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 999px;
    outline: none;
    cursor: pointer;
    background: #e2e8f0;
}

input[type=range].slider-energie::-webkit-slider-thumb,
input[type=range].slider-stress::-webkit-slider-thumb,
input[type=range].slider-sommeil::-webkit-slider-thumb {
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

input[type=range].slider-energie::-webkit-slider-thumb:hover,
input[type=range].slider-stress::-webkit-slider-thumb:hover,
input[type=range].slider-sommeil::-webkit-slider-thumb:hover {
    border-color: #006876;
}
</style>

<script>

function getColor(type, val) {
    if (type === 'energie') {
        return val >= 7 ? '#48bb78' : val >= 4 ? '#f6ad55' : '#ff4444';
    } else if (type === 'stress') {
        return val >= 7 ? '#ff4444' : val >= 4 ? '#f6ad55' : '#63b3ed';
    } else {
        return val >= 7 ? '#b794f4' : val >= 4 ? '#4299e1' : '#a0aec0';
    }
}

function updateSlider(slider, spanId, type) {
    const val = parseInt(slider.value);
    const max = parseInt(slider.max) || 10;
    const pct = (val / max) * 100;
    const color = getColor(type, val);

    slider.setAttribute('style',
        `background: linear-gradient(to right, \${color} \${pct}%, #e2e8f0 \${pct}%) !important`
    );

    const span = document.getElementById(spanId);
    if (span) {
        span.textContent = val;
        span.style.color = color;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const sliders = [
        { el: document.querySelector('.slider-energie'), span: 'val_energie', type: 'energie' },
        { el: document.querySelector('.slider-stress'),  span: 'val_stress',  type: 'stress'  },
        { el: document.querySelector('.slider-sommeil'), span: 'val_sommeil', type: 'sommeil' },
    ];
    sliders.forEach(s => {
        if (s.el) updateSlider(s.el, s.span, s.type);
    });
});

function interpolateColor(c1, c2, t) {
    const hex = h => parseInt(h, 16);
    const r1 = hex(c1.slice(1,3)), g1 = hex(c1.slice(3,5)), b1 = hex(c1.slice(5,7));
    const r2 = hex(c2.slice(1,3)), g2 = hex(c2.slice(3,5)), b2 = hex(c2.slice(5,7));
    const r = Math.round(r1 + (r2-r1)*t);
    const g = Math.round(g1 + (g2-g1)*t);
    const b = Math.round(b1 + (b2-b1)*t);
    return `rgb(\${r},\${g},\${b})`;
}

// Init au chargement
document.addEventListener('DOMContentLoaded', function() {
    const sliders = [
        { el: document.querySelector('.slider-energie'), span: 'val_energie', c1: '#48bb78', c2: '#ff4444' },
        { el: document.querySelector('.slider-stress'),  span: 'val_stress',  c1: '#63b3ed', c2: '#ff4444' },
        { el: document.querySelector('.slider-sommeil'), span: 'val_sommeil', c1: '#a0aec0', c2: '#b794f4' },
    ];
    sliders.forEach(s => {
        if (s.el) {
            const val = parseInt(s.el.value);
            const max = parseInt(s.el.max) || 10;
            const pct = (val / max) * 100;
            s.el.setAttribute('style', 
                `background: linear-gradient(to right, \${s.c1} 0%, \${s.c2} \${pct}%, #e2e8f0 \${pct}%) !important`
            );

            const span = document.getElementById(s.span);
        if (span) {
            span.textContent = val;
            span.style.color = interpolateColor(s.c1, s.c2, pct / 100);
        }
    }
    });

// Cacher erreur nom quand l'utilisateur tape
    const nomInput = document.querySelector('#habitude_nomHabitude');
    if (nomInput) {
        nomInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('border-red-400', 'bg-red-50');
                this.classList.add('border-gray-200');
                const err = this.parentElement.querySelector('p.text-red-500');
                if (err) err.style.display = 'none';
            }
        });
    }


    // Cacher erreur émotion quand l'utilisateur choisit
    const emotionSelect = document.querySelector('#habitude_emotionDominantes');
    if (emotionSelect) {
        const placeholder = emotionSelect.querySelector('option[value=\"\"]');
        if (placeholder) placeholder.disabled = true;
        emotionSelect.addEventListener('change', function() {
            if (this.value !== '') {
                this.classList.remove('border-red-400', 'bg-red-50');
                this.classList.add('border-gray-200');
                const err = this.parentElement.querySelector('p.text-red-500');
                if (err) err.style.display = 'none';
            }
        });
    }
});

</script>
{% endblock %}

{% block content %}
<div class=\"max-w-xl mx-auto\">

    {# EN-TÊTE #}
    <div class=\"rounded-2xl overflow-hidden mb-6\"
         style=\"background: linear-gradient(to right, #5a3ea1, #7c5cbf)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">✨ Nouvelle Habitude</h1>
            <p class=\"text-[#d8ccf5] text-sm mt-1\">Enregistrez votre habitude du jour</p>
        </div>
    </div>

    {{ form_start(form, {attr: {class: 'space-y-4', novalidate: 'novalidate'}}) }}

    {% if not form.vars.valid and form.vars.submitted %}
    <div class=\"bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm\">
        ⚠️ Champs Obligatoire! 
    </div>
{% endif %}

        {# NOM + ÉMOTION #}
        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4\">
            <div>
    {{ form_label(form.nomHabitude, null, {label_attr: {class: 'block text-sm font-semibold text-gray-600 mb-1'}}) }}
    {{ form_widget(form.nomHabitude, {attr: {
        class: 'w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 ' ~
               (form.nomHabitude.vars.errors|length > 0 ? 'border-red-400 focus:ring-red-300 bg-red-50' : 'border-gray-200 focus:ring-[#006876]')
    }}) }}
    {% if form.nomHabitude.vars.errors|length > 0 %}
        <p class=\"text-red-500 text-xs mt-1 font-medium flex items-center gap-1\">
            ⚠️ {{ form.nomHabitude.vars.errors[0].message }}
        </p>
    {% endif %}
</div>
            <div>
    {{ form_label(form.emotionDominantes, null, {label_attr: {class: 'block text-sm font-semibold text-gray-600 mb-1'}}) }}
    {{ form_widget(form.emotionDominantes, {attr: {
    class: 'w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 ' ~
           (form.emotionDominantes.vars.errors|length > 0 ? 'border-red-400 bg-red-50 focus:ring-red-300' : 'border-gray-200 focus:ring-[#006876]')
}}) }}
    {% if form.emotionDominantes.vars.errors|length > 0 %}
        <p class=\"text-red-500 text-xs mt-1 font-medium\">
            ⚠️ {{ form.emotionDominantes.vars.errors[0].message }}
        </p>
    {% endif %}
</div>
        </div>

        {# NIVEAUX #}
        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5\">
            <h2 class=\"text-sm font-bold text-gray-500\">📊 Niveaux du jour</h2>

            {# Énergie #}
    <div>
        {{ form_label(form.niveauEnergie, null, {label_attr: {class: 'block text-sm font-semibold text-gray-600 mb-2'}}) }}
        <div class=\"flex items-center gap-4\">
            {{ form_widget(form.niveauEnergie, {attr: {
                class: 'slider-energie',
                oninput: \"updateSlider(this, 'val_energie', 'energie')\"
            }}) }}
            <span id=\"val_energie\" class=\"text-sm font-bold w-8 text-center\">
    {{ form.niveauEnergie.vars.value }}
</span>
        </div>
        <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
            <span>0 — Vide</span><span>10 — Vitalité</span>
        </div>
    </div>

            {# Stress #}
    <div>
        {{ form_label(form.niveauStress, null, {label_attr: {class: 'block text-sm font-semibold text-gray-600 mb-2'}}) }}
        <div class=\"flex items-center gap-4\">
            {{ form_widget(form.niveauStress, {attr: {
                class: 'slider-stress',
                oninput: \"updateSlider(this, 'val_stress', 'stress')\"
            }}) }}
            <span id=\"val_stress\" class=\"text-sm font-bold w-8 text-center\">
    {{ form.niveauStress.vars.value }}
</span>
        </div>
        <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
            <span>0 — Zen</span><span>10 — Alarme</span>
        </div>
    </div>

            {# Sommeil #}
    <div>
        {{ form_label(form.qualiteSommeil, null, {label_attr: {class: 'block text-sm font-semibold text-gray-600 mb-2'}}) }}
        <div class=\"flex items-center gap-4\">
            {{ form_widget(form.qualiteSommeil, {attr: {
                class: 'slider-sommeil',
                oninput: \"updateSlider(this, 'val_sommeil', 'sommeil')\"
            }}) }}
            <span id=\"val_sommeil\" class=\"text-sm font-bold w-8 text-center\">
    {{ form.qualiteSommeil.vars.value }}
</span>
        </div>
        <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
            <span>0 — Fatigué</span><span>10 — Récupéré</span>
        </div>
    </div>
</div>

        {# NOTE + DATE #}
        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4\">
            <div>
                {{ form_label(form.noteTextuelle, null, {label_attr: {class: 'block text-sm font-semibold text-gray-600 mb-1'}}) }}
                {{ form_widget(form.noteTextuelle) }}
            </div>
            <div>
                {{ form_label(form.dateCreation, null, {label_attr: {class: 'block text-sm font-semibold text-gray-600 mb-1'}}) }}
                {{ form_widget(form.dateCreation) }}
            </div>
        </div>

        {# BOUTONS #}
        <div class=\"flex gap-3\">
            <a href=\"{{ path('habitude_index') }}\"
               class=\"flex-1 text-center bg-gray-100 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition\">
                ✕ Annuler
            </a>
            <button type=\"submit\"
                    class=\"flex-1 bg-[#006876] text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
                ✅ Enregistrer
            </button>
        </div>

    {{ form_end(form) }}
</div>
{% endblock %}", "Journal/habitude/ajouter.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\Journal\\habitude\\ajouter.html.twig");
    }
}
