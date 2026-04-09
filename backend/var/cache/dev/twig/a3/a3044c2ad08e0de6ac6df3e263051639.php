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

/* pages/settings/settings.html.twig */
class __TwigTemplate_e09089aa0ba0fa880bb29ebfa558f3b6 extends Template
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
            'header_title' => [$this, 'block_header_title'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/settings/settings.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/settings/settings.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_title"));

        yield "Paramètres (Settings)";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
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

        // line 6
        yield "<div class=\"max-w-4xl mx-auto space-y-8\">

    ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 8, $this->source); })()), "flashes", ["success"], "method", false, false, false, 8));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 9
            yield "        <div class=\"p-4 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium border border-emerald-100 flex items-center gap-3\">
            <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M5 13l4 4L19 7\"></path></svg>
            ";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        yield "
    <form method=\"POST\" class=\"bg-white rounded-[2rem] p-8 shadow-sm border border-[#e5f7f6]\">
        
        <!-- Apparence & Thème -->
        <div class=\"mb-10\">
            <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-4 flex items-center gap-2\">
                <svg class=\"w-6 h-6 text-cyan-500\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z\"></path></svg>
                Thème et Apparence
            </h3>
            <p class=\"text-sm text-slate-500 mb-6\">Personnalisez l'apparence de votre interface pour plus de confort. (Remarque : Le dark mode est en phase bêta pour la version web).</p>
            
            <div class=\"grid grid-cols-2 flex-wrap gap-4\">
                <label class=\"cursor-pointer\">
                    <input type=\"radio\" name=\"theme\" value=\"LIGHT\" class=\"peer sr-only\" ";
        // line 27
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["settings"]) || array_key_exists("settings", $context) ? $context["settings"] : (function () { throw new RuntimeError('Variable "settings" does not exist.', 27, $this->source); })()), "theme", [], "any", false, false, false, 27) == "LIGHT")) {
            yield "checked";
        }
        yield ">
                    <div class=\"flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-cyan-400 peer-checked:bg-cyan-50 hover:bg-slate-50 transition\">
                        <div class=\"p-2 bg-white rounded-full shadow-sm\"><svg class=\"w-6 h-6 text-slate-700\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"1.5\" d=\"M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z\"></path></svg></div>
                        <span class=\"font-medium text-slate-800\">Mode Clair</span>
                    </div>
                </label>
                <label class=\"cursor-pointer\">
                    <input type=\"radio\" name=\"theme\" value=\"DARK\" class=\"peer sr-only\" ";
        // line 34
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["settings"]) || array_key_exists("settings", $context) ? $context["settings"] : (function () { throw new RuntimeError('Variable "settings" does not exist.', 34, $this->source); })()), "theme", [], "any", false, false, false, 34) == "DARK")) {
            yield "checked";
        }
        yield ">
                    <div class=\"flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-cyan-400 peer-checked:bg-cyan-50 hover:bg-slate-50 transition\">
                        <div class=\"p-2 bg-slate-800 rounded-full shadow-sm\"><svg class=\"w-6 h-6 text-white\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"1.5\" d=\"M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z\"></path></svg></div>
                        <span class=\"font-medium text-slate-800\">Mode Sombre</span>
                    </div>
                </label>
            </div>
        </div>

        <!-- Accessibilité: Taille de police -->
        <div class=\"mb-10 pl-2\">
            <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-4 flex items-center gap-2\">
                <svg class=\"w-6 h-6 text-emerald-500\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4\"></path></svg>
                Taille du texte
            </h3>
            
            <div class=\"flex gap-4\">
                <label class=\"cursor-pointer flex-1\">
                    <input type=\"radio\" name=\"fontSize\" value=\"SMALL\" class=\"peer sr-only\" ";
        // line 52
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["settings"]) || array_key_exists("settings", $context) ? $context["settings"] : (function () { throw new RuntimeError('Variable "settings" does not exist.', 52, $this->source); })()), "fontSize", [], "any", false, false, false, 52) == "SMALL")) {
            yield "checked";
        }
        yield ">
                    <div class=\"text-center p-3 rounded-xl border-2 border-slate-100 peer-checked:border-emerald-400 peer-checked:bg-emerald-50 hover:bg-slate-50 font-medium text-sm transition\">A- Petit</div>
                </label>
                <label class=\"cursor-pointer flex-1\">
                    <input type=\"radio\" name=\"fontSize\" value=\"NORMAL\" class=\"peer sr-only\" ";
        // line 56
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["settings"]) || array_key_exists("settings", $context) ? $context["settings"] : (function () { throw new RuntimeError('Variable "settings" does not exist.', 56, $this->source); })()), "fontSize", [], "any", false, false, false, 56) == "NORMAL")) {
            yield "checked";
        }
        yield ">
                    <div class=\"text-center p-3 rounded-xl border-2 border-slate-100 peer-checked:border-emerald-400 peer-checked:bg-emerald-50 hover:bg-slate-50 font-medium transition\">A Normal</div>
                </label>
                <label class=\"cursor-pointer flex-1\">
                    <input type=\"radio\" name=\"fontSize\" value=\"LARGE\" class=\"peer sr-only\" ";
        // line 60
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["settings"]) || array_key_exists("settings", $context) ? $context["settings"] : (function () { throw new RuntimeError('Variable "settings" does not exist.', 60, $this->source); })()), "fontSize", [], "any", false, false, false, 60) == "LARGE")) {
            yield "checked";
        }
        yield ">
                    <div class=\"text-center p-3 rounded-xl border-2 border-slate-100 peer-checked:border-emerald-400 peer-checked:bg-emerald-50 hover:bg-slate-50 font-medium text-lg transition\">A+ Grand</div>
                </label>
            </div>
        </div>

        <!-- Langue -->
        <div class=\"mb-8 pl-2\">
            <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-4 flex items-center gap-2\">
                 🌍 Langue (Language)
            </h3>
            <select name=\"language\" class=\"w-full md:w-1/2 h-12 bg-slate-50 border border-slate-200 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 outline-none transition\">
                <option value=\"FR\" ";
        // line 72
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["settings"]) || array_key_exists("settings", $context) ? $context["settings"] : (function () { throw new RuntimeError('Variable "settings" does not exist.', 72, $this->source); })()), "language", [], "any", false, false, false, 72) == "FR")) {
            yield "selected";
        }
        yield ">🇫🇷 Français</option>
                <option value=\"EN\" ";
        // line 73
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["settings"]) || array_key_exists("settings", $context) ? $context["settings"] : (function () { throw new RuntimeError('Variable "settings" does not exist.', 73, $this->source); })()), "language", [], "any", false, false, false, 73) == "EN")) {
            yield "selected";
        }
        yield ">🇬🇧 English</option>
            </select>
            <p class=\"text-xs text-slate-400 mt-2\">Ce paramètre est synchronisé et appliqué également sur l'application de bureau.</p>
        </div>

        <div class=\"flex justify-end pt-6 border-t border-slate-100\">
            <button type=\"submit\" class=\"px-8 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold shadow-[0_8px_24px_-8px_rgba(0,188,212,0.5)] transition-all\">
                Enregistrer les paramètres
            </button>
        </div>
    </form>
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
        return "pages/settings/settings.html.twig";
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
        return array (  212 => 73,  206 => 72,  189 => 60,  180 => 56,  171 => 52,  148 => 34,  136 => 27,  121 => 14,  112 => 11,  108 => 9,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Paramètres (Settings){% endblock %}

{% block content %}
<div class=\"max-w-4xl mx-auto space-y-8\">

    {% for message in app.flashes('success') %}
        <div class=\"p-4 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium border border-emerald-100 flex items-center gap-3\">
            <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M5 13l4 4L19 7\"></path></svg>
            {{ message }}
        </div>
    {% endfor %}

    <form method=\"POST\" class=\"bg-white rounded-[2rem] p-8 shadow-sm border border-[#e5f7f6]\">
        
        <!-- Apparence & Thème -->
        <div class=\"mb-10\">
            <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-4 flex items-center gap-2\">
                <svg class=\"w-6 h-6 text-cyan-500\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z\"></path></svg>
                Thème et Apparence
            </h3>
            <p class=\"text-sm text-slate-500 mb-6\">Personnalisez l'apparence de votre interface pour plus de confort. (Remarque : Le dark mode est en phase bêta pour la version web).</p>
            
            <div class=\"grid grid-cols-2 flex-wrap gap-4\">
                <label class=\"cursor-pointer\">
                    <input type=\"radio\" name=\"theme\" value=\"LIGHT\" class=\"peer sr-only\" {% if settings.theme == 'LIGHT' %}checked{% endif %}>
                    <div class=\"flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-cyan-400 peer-checked:bg-cyan-50 hover:bg-slate-50 transition\">
                        <div class=\"p-2 bg-white rounded-full shadow-sm\"><svg class=\"w-6 h-6 text-slate-700\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"1.5\" d=\"M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z\"></path></svg></div>
                        <span class=\"font-medium text-slate-800\">Mode Clair</span>
                    </div>
                </label>
                <label class=\"cursor-pointer\">
                    <input type=\"radio\" name=\"theme\" value=\"DARK\" class=\"peer sr-only\" {% if settings.theme == 'DARK' %}checked{% endif %}>
                    <div class=\"flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-cyan-400 peer-checked:bg-cyan-50 hover:bg-slate-50 transition\">
                        <div class=\"p-2 bg-slate-800 rounded-full shadow-sm\"><svg class=\"w-6 h-6 text-white\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"1.5\" d=\"M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z\"></path></svg></div>
                        <span class=\"font-medium text-slate-800\">Mode Sombre</span>
                    </div>
                </label>
            </div>
        </div>

        <!-- Accessibilité: Taille de police -->
        <div class=\"mb-10 pl-2\">
            <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-4 flex items-center gap-2\">
                <svg class=\"w-6 h-6 text-emerald-500\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4\"></path></svg>
                Taille du texte
            </h3>
            
            <div class=\"flex gap-4\">
                <label class=\"cursor-pointer flex-1\">
                    <input type=\"radio\" name=\"fontSize\" value=\"SMALL\" class=\"peer sr-only\" {% if settings.fontSize == 'SMALL' %}checked{% endif %}>
                    <div class=\"text-center p-3 rounded-xl border-2 border-slate-100 peer-checked:border-emerald-400 peer-checked:bg-emerald-50 hover:bg-slate-50 font-medium text-sm transition\">A- Petit</div>
                </label>
                <label class=\"cursor-pointer flex-1\">
                    <input type=\"radio\" name=\"fontSize\" value=\"NORMAL\" class=\"peer sr-only\" {% if settings.fontSize == 'NORMAL' %}checked{% endif %}>
                    <div class=\"text-center p-3 rounded-xl border-2 border-slate-100 peer-checked:border-emerald-400 peer-checked:bg-emerald-50 hover:bg-slate-50 font-medium transition\">A Normal</div>
                </label>
                <label class=\"cursor-pointer flex-1\">
                    <input type=\"radio\" name=\"fontSize\" value=\"LARGE\" class=\"peer sr-only\" {% if settings.fontSize == 'LARGE' %}checked{% endif %}>
                    <div class=\"text-center p-3 rounded-xl border-2 border-slate-100 peer-checked:border-emerald-400 peer-checked:bg-emerald-50 hover:bg-slate-50 font-medium text-lg transition\">A+ Grand</div>
                </label>
            </div>
        </div>

        <!-- Langue -->
        <div class=\"mb-8 pl-2\">
            <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-4 flex items-center gap-2\">
                 🌍 Langue (Language)
            </h3>
            <select name=\"language\" class=\"w-full md:w-1/2 h-12 bg-slate-50 border border-slate-200 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 outline-none transition\">
                <option value=\"FR\" {% if settings.language == 'FR' %}selected{% endif %}>🇫🇷 Français</option>
                <option value=\"EN\" {% if settings.language == 'EN' %}selected{% endif %}>🇬🇧 English</option>
            </select>
            <p class=\"text-xs text-slate-400 mt-2\">Ce paramètre est synchronisé et appliqué également sur l'application de bureau.</p>
        </div>

        <div class=\"flex justify-end pt-6 border-t border-slate-100\">
            <button type=\"submit\" class=\"px-8 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold shadow-[0_8px_24px_-8px_rgba(0,188,212,0.5)] transition-all\">
                Enregistrer les paramètres
            </button>
        </div>
    </form>
</div>
{% endblock %}
", "pages/settings/settings.html.twig", "C:\\Users\\user\\Documents\\fuck2\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\settings\\settings.html.twig");
    }
}
