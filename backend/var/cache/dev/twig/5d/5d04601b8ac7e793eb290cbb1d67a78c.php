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

/* Journal/habitude/modifier.html.twig */
class __TwigTemplate_7c1001b96fc72786a5d04a8aed4d9771 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Journal/habitude/modifier.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Journal/habitude/modifier.html.twig"));

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
input[type=range] {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 999px;
    outline: none;
    cursor: pointer;
    background: linear-gradient(to right, #48bb78, #ff4444);
}

input[type=range]::-webkit-slider-thumb {
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

input[type=range]::-webkit-slider-thumb:hover {
    border-color: #006876;
}

.slider-stress {
    background: linear-gradient(to right, #63b3ed, #ff4444) !important;
}

.slider-sommeil {
    background: linear-gradient(to right, #a0aec0, #b794f4) !important;
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

    slider.style.background =
        `linear-gradient(to right, \${color} \${pct}%, #e2e8f0 \${pct}%)`;

    const span = document.getElementById(spanId);
    if (span) {
        span.textContent = val;
        span.style.color = color;
    }
}

document.addEventListener('DOMContentLoaded', function() {

    // ── Init sliders ──
    const sliders = [
        { el: document.querySelector('.slider-energie'), span: 'val_energie', type: 'energie' },
        { el: document.querySelector('.slider-stress'),  span: 'val_stress',  type: 'stress'  },
        { el: document.querySelector('.slider-sommeil'), span: 'val_sommeil', type: 'sommeil' },
    ];
    sliders.forEach(s => {
        if (s.el) updateSlider(s.el, s.span, s.type);
    });

    // ── Désactiver placeholder émotion ──
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

    // ── Cacher erreur nom ──
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

});

</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 116
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

        // line 117
        yield "<div class=\"max-w-xl mx-auto\">

    ";
        // line 120
        yield "    <div class=\"rounded-2xl overflow-hidden mb-6\"
         style=\"background: linear-gradient(to right, #5a3ea1, #7c5cbf)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">✏️ Modifier l'habitude</h1>
            <p class=\"text-[#d8ccf5] text-sm mt-1\">";
        // line 124
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 124, $this->source); })()), "nomHabitude", [], "any", false, false, false, 124), "html", null, true);
        yield "</p>
        </div>
    </div>

    ";
        // line 128
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 128, $this->source); })()), 'form_start', ["attr" => ["class" => "space-y-4", "novalidate" => "novalidate"]]);
        yield "

";
        // line 130
        if (( !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 130, $this->source); })()), "vars", [], "any", false, false, false, 130), "valid", [], "any", false, false, false, 130) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 130, $this->source); })()), "vars", [], "any", false, false, false, 130), "submitted", [], "any", false, false, false, 130))) {
            // line 131
            yield "    <div class=\"bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm\">
        ⚠️ Veuillez corriger les erreurs ci-dessous
    </div>
";
        }
        // line 135
        yield "
";
        // line 137
        yield "<div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4\">
    <div>
        ";
        // line 139
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 139, $this->source); })()), "nomHabitude", [], "any", false, false, false, 139), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
        ";
        // line 140
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 140, $this->source); })()), "nomHabitude", [], "any", false, false, false, 140), 'widget', ["attr" => ["class" => ("w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 " . (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 142
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 142, $this->source); })()), "nomHabitude", [], "any", false, false, false, 142), "vars", [], "any", false, false, false, 142), "errors", [], "any", false, false, false, 142)) > 0)) ? ("border-red-400 focus:ring-red-300 bg-red-50") : ("border-gray-200 focus:ring-[#006876]")))]]);
        // line 143
        yield "
        ";
        // line 144
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 144, $this->source); })()), "nomHabitude", [], "any", false, false, false, 144), "vars", [], "any", false, false, false, 144), "errors", [], "any", false, false, false, 144)) > 0)) {
            // line 145
            yield "            <p class=\"text-red-500 text-xs mt-1 font-medium\">
                ⚠️ ";
            // line 146
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 146, $this->source); })()), "nomHabitude", [], "any", false, false, false, 146), "vars", [], "any", false, false, false, 146), "errors", [], "any", false, false, false, 146), 0, [], "array", false, false, false, 146), "message", [], "any", false, false, false, 146), "html", null, true);
            yield "
            </p>
        ";
        }
        // line 149
        yield "    </div>
    <div>
        ";
        // line 151
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 151, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 151), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
        ";
        // line 152
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 152, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 152), 'widget', ["attr" => ["class" => ("w-full rounded-xl border px-4 py-2 text-sm focus:outline-none focus:ring-2 " . (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 154
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 154, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 154), "vars", [], "any", false, false, false, 154), "errors", [], "any", false, false, false, 154)) > 0)) ? ("border-red-400 bg-red-50 focus:ring-red-300") : ("border-gray-200 focus:ring-[#006876]")))]]);
        // line 155
        yield "
        ";
        // line 156
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 156, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 156), "vars", [], "any", false, false, false, 156), "errors", [], "any", false, false, false, 156)) > 0)) {
            // line 157
            yield "            <p class=\"text-red-500 text-xs mt-1 font-medium\">
                ⚠️ ";
            // line 158
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 158, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 158), "vars", [], "any", false, false, false, 158), "errors", [], "any", false, false, false, 158), 0, [], "array", false, false, false, 158), "message", [], "any", false, false, false, 158), "html", null, true);
            yield "
            </p>
        ";
        }
        // line 161
        yield "    </div>
</div>

        ";
        // line 165
        yield "        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5\">
            <h2 class=\"text-sm font-bold text-gray-500\">📊 Niveaux du jour</h2>

            ";
        // line 169
        yield "    <div>
        ";
        // line 170
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 170, $this->source); })()), "niveauEnergie", [], "any", false, false, false, 170), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-2"]]);
        yield "
        <div class=\"flex items-center gap-4\">
            ";
        // line 172
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 172, $this->source); })()), "niveauEnergie", [], "any", false, false, false, 172), 'widget', ["attr" => ["class" => "slider-energie", "oninput" => "updateSlider(this, 'val_energie', 'energie')"]]);
        // line 175
        yield "
            <span id=\"val_energie\" class=\"text-sm font-bold w-8 text-center\">
    ";
        // line 177
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 177, $this->source); })()), "niveauEnergie", [], "any", false, false, false, 177), "vars", [], "any", false, false, false, 177), "value", [], "any", false, false, false, 177), "html", null, true);
        yield "
</span>
        </div>
        <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
            <span>0 — Vide</span><span>10 — Vitalité</span>
        </div>
    </div>

    ";
        // line 186
        yield "    <div>
        ";
        // line 187
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 187, $this->source); })()), "niveauStress", [], "any", false, false, false, 187), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-2"]]);
        yield "
        <div class=\"flex items-center gap-4\">
            ";
        // line 189
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 189, $this->source); })()), "niveauStress", [], "any", false, false, false, 189), 'widget', ["attr" => ["class" => "slider-stress", "oninput" => "updateSlider(this, 'val_stress', 'stress')"]]);
        // line 192
        yield "
            <span id=\"val_stress\" class=\"text-sm font-bold w-8 text-center\">
    ";
        // line 194
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 194, $this->source); })()), "niveauStress", [], "any", false, false, false, 194), "vars", [], "any", false, false, false, 194), "value", [], "any", false, false, false, 194), "html", null, true);
        yield "
</span>
        </div>
        <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
            <span>0 — Zen</span><span>10 — Alarme</span>
        </div>
    </div>

    ";
        // line 203
        yield "    <div>
        ";
        // line 204
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 204, $this->source); })()), "qualiteSommeil", [], "any", false, false, false, 204), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-2"]]);
        yield "
        <div class=\"flex items-center gap-4\">
            ";
        // line 206
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 206, $this->source); })()), "qualiteSommeil", [], "any", false, false, false, 206), 'widget', ["attr" => ["class" => "slider-sommeil", "oninput" => "updateSlider(this, 'val_sommeil', 'sommeil')"]]);
        // line 209
        yield "
            <span id=\"val_sommeil\" class=\"text-sm font-bold w-8 text-center\">
    ";
        // line 211
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 211, $this->source); })()), "qualiteSommeil", [], "any", false, false, false, 211), "vars", [], "any", false, false, false, 211), "value", [], "any", false, false, false, 211), "html", null, true);
        yield "
</span>
        </div>
        <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
            <span>0 — Fatigué</span><span>10 — Récupéré</span>
        </div>
    </div>
</div>

        ";
        // line 221
        yield "        <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4\">
            <div>
                ";
        // line 223
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 223, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 223), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
                ";
        // line 224
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 224, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 224), 'widget');
        yield "
            </div>
            <div>
                ";
        // line 227
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 227, $this->source); })()), "dateCreation", [], "any", false, false, false, 227), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-gray-600 mb-1"]]);
        yield "
                ";
        // line 228
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 228, $this->source); })()), "dateCreation", [], "any", false, false, false, 228), 'widget');
        yield "
            </div>
        </div>

        ";
        // line 233
        yield "        <div class=\"flex gap-3\">
            <a href=\"";
        // line 234
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_index");
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
        // line 244
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 244, $this->source); })()), 'form_end');
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
        return "Journal/habitude/modifier.html.twig";
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
        return array (  422 => 244,  409 => 234,  406 => 233,  399 => 228,  395 => 227,  389 => 224,  385 => 223,  381 => 221,  369 => 211,  365 => 209,  363 => 206,  358 => 204,  355 => 203,  344 => 194,  340 => 192,  338 => 189,  333 => 187,  330 => 186,  319 => 177,  315 => 175,  313 => 172,  308 => 170,  305 => 169,  300 => 165,  295 => 161,  289 => 158,  286 => 157,  284 => 156,  281 => 155,  279 => 154,  278 => 152,  274 => 151,  270 => 149,  264 => 146,  261 => 145,  259 => 144,  256 => 143,  254 => 142,  253 => 140,  249 => 139,  245 => 137,  242 => 135,  236 => 131,  234 => 130,  229 => 128,  222 => 124,  216 => 120,  212 => 117,  199 => 116,  77 => 4,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block head %}
{{ parent() }}
<style>
input[type=range] {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 999px;
    outline: none;
    cursor: pointer;
    background: linear-gradient(to right, #48bb78, #ff4444);
}

input[type=range]::-webkit-slider-thumb {
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

input[type=range]::-webkit-slider-thumb:hover {
    border-color: #006876;
}

.slider-stress {
    background: linear-gradient(to right, #63b3ed, #ff4444) !important;
}

.slider-sommeil {
    background: linear-gradient(to right, #a0aec0, #b794f4) !important;
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

    slider.style.background =
        `linear-gradient(to right, \${color} \${pct}%, #e2e8f0 \${pct}%)`;

    const span = document.getElementById(spanId);
    if (span) {
        span.textContent = val;
        span.style.color = color;
    }
}

document.addEventListener('DOMContentLoaded', function() {

    // ── Init sliders ──
    const sliders = [
        { el: document.querySelector('.slider-energie'), span: 'val_energie', type: 'energie' },
        { el: document.querySelector('.slider-stress'),  span: 'val_stress',  type: 'stress'  },
        { el: document.querySelector('.slider-sommeil'), span: 'val_sommeil', type: 'sommeil' },
    ];
    sliders.forEach(s => {
        if (s.el) updateSlider(s.el, s.span, s.type);
    });

    // ── Désactiver placeholder émotion ──
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

    // ── Cacher erreur nom ──
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

});

</script>
{% endblock %}

{% block content %}
<div class=\"max-w-xl mx-auto\">

    {# EN-TÊTE #}
    <div class=\"rounded-2xl overflow-hidden mb-6\"
         style=\"background: linear-gradient(to right, #5a3ea1, #7c5cbf)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">✏️ Modifier l'habitude</h1>
            <p class=\"text-[#d8ccf5] text-sm mt-1\">{{ habitude.nomHabitude }}</p>
        </div>
    </div>

    {{ form_start(form, {attr: {class: 'space-y-4', novalidate: 'novalidate'}}) }}

{% if not form.vars.valid and form.vars.submitted %}
    <div class=\"bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm\">
        ⚠️ Veuillez corriger les erreurs ci-dessous
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
            <p class=\"text-red-500 text-xs mt-1 font-medium\">
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
                ✅ Sauvegarder
            </button>
        </div>

    {{ form_end(form) }}
</div>
{% endblock %}", "Journal/habitude/modifier.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\Journal\\habitude\\modifier.html.twig");
    }
}
