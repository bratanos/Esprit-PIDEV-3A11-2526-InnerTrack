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

/* pages/testpsy/statistiques_globales.html.twig */
class __TwigTemplate_4490cedc5dd5efdbeb4543accd7f9642 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/statistiques_globales.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/statistiques_globales.html.twig"));

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

        yield "Statistiques Globales";
        
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
        yield "<div class=\"max-w-7xl mx-auto pb-24\">
    <!-- Header -->
    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface\">Statistiques Globales</h1>
            <p class=\"text-sm text-on-surface-variant mt-1\">Aperçu général de l'utilisation des tests psychologiques</p>
        </div>
        <a href=\"";
        // line 13
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index");
        yield "\"
           class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors\">
            <span class=\"material-symbols-outlined\">arrow_back</span> Retour aux tests
        </a>
    </div>

    <!-- Top Stats Cards -->
    <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10\">
        <div class=\"bg-gradient-to-br from-primary to-indigo-600 rounded-[2rem] p-6 text-white shadow-lg shadow-indigo-200 flex items-center gap-5\">
            <div class=\"w-14 h-14 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm\">
                <span class=\"material-symbols-outlined text-3xl\">psychology</span>
            </div>
            <div>
                <p class=\"text-[10px] font-bold uppercase tracking-widest text-indigo-100 mb-1\">Total Passages</p>
                <p class=\"text-4xl font-extrabold font-headline\">";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats_globales"]) || array_key_exists("stats_globales", $context) ? $context["stats_globales"] : (function () { throw new RuntimeError('Variable "stats_globales" does not exist.', 27, $this->source); })()), "total_passages", [], "any", false, false, false, 27), "html", null, true);
        yield "</p>
            </div>
        </div>

        <div class=\"bg-white rounded-[2rem] p-6 border border-outline/20 shadow-sm flex items-center gap-5\">
            <div class=\"w-14 h-14 rounded-[1.25rem] bg-amber-50 text-amber-500 flex items-center justify-center\">
                <span class=\"material-symbols-outlined text-3xl\">star</span>
            </div>
            <div class=\"min-w-0\">
                <p class=\"text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-1\">Test le plus Populaire</p>
                <p class=\"text-xl font-extrabold text-on-surface font-headline truncate\" title=\"";
        // line 37
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats_globales"]) || array_key_exists("stats_globales", $context) ? $context["stats_globales"] : (function () { throw new RuntimeError('Variable "stats_globales" does not exist.', 37, $this->source); })()), "populaire", [], "any", false, false, false, 37)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats_globales"]) || array_key_exists("stats_globales", $context) ? $context["stats_globales"] : (function () { throw new RuntimeError('Variable "stats_globales" does not exist.', 37, $this->source); })()), "populaire", [], "any", false, false, false, 37), "html", null, true)) : ("Aucun"));
        yield "\">";
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats_globales"]) || array_key_exists("stats_globales", $context) ? $context["stats_globales"] : (function () { throw new RuntimeError('Variable "stats_globales" does not exist.', 37, $this->source); })()), "populaire", [], "any", false, false, false, 37)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats_globales"]) || array_key_exists("stats_globales", $context) ? $context["stats_globales"] : (function () { throw new RuntimeError('Variable "stats_globales" does not exist.', 37, $this->source); })()), "populaire", [], "any", false, false, false, 37), "html", null, true)) : ("Aucun test passé"));
        yield "</p>
            </div>
        </div>

        <div class=\"bg-white rounded-[2rem] p-6 border border-outline/20 shadow-sm flex items-center gap-5\">
            <div class=\"w-14 h-14 rounded-[1.25rem] bg-green-50 text-green-500 flex items-center justify-center\">
                <span class=\"material-symbols-outlined text-3xl\">analytics</span>
            </div>
            <div>
                <p class=\"text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-1\">Tests Actifs</p>
                <p class=\"text-2xl font-extrabold text-on-surface font-headline\">";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["passages"]) || array_key_exists("passages", $context) ? $context["passages"] : (function () { throw new RuntimeError('Variable "passages" does not exist.', 47, $this->source); })())), "html", null, true);
        yield "</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class=\"grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10\">
        <!-- Passages Chart -->
        <div class=\"bg-white rounded-[2rem] p-8 border border-outline/20 shadow-sm\">
            <h3 class=\"text-lg font-extrabold font-headline text-on-surface mb-6 flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-primary\">bar_chart</span> Nombre de passages par test
            </h3>
            <div class=\"relative h-72 w-full\">
                <canvas id=\"passagesChart\"></canvas>
            </div>
        </div>

        <!-- Moyennes Chart -->
        <div class=\"bg-white rounded-[2rem] p-8 border border-outline/20 shadow-sm\">
            <h3 class=\"text-lg font-extrabold font-headline text-on-surface mb-6 flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-green-600\">pie_chart</span> Score moyen par test (%)
            </h3>
            <div class=\"relative h-72 w-full\">
                <canvas id=\"moyennesChart\"></canvas>
            </div>
        </div>
    </div>
</div>

<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data injection from Twig
    const passagesData = ";
        // line 80
        yield json_encode((isset($context["passages"]) || array_key_exists("passages", $context) ? $context["passages"] : (function () { throw new RuntimeError('Variable "passages" does not exist.', 80, $this->source); })()));
        yield ";
    const moyennesData = ";
        // line 81
        yield json_encode((isset($context["moyennes"]) || array_key_exists("moyennes", $context) ? $context["moyennes"] : (function () { throw new RuntimeError('Variable "moyennes" does not exist.', 81, $this->source); })()));
        yield ";

    if(passagesData.length === 0) return;

    // Passages Chart
    const labelsPassages = passagesData.map(item => item.titre.length > 20 ? item.titre.substring(0, 20) + '...' : item.titre);
    const dataPassages = passagesData.map(item => parseInt(item.nb_passages));

    new Chart(document.getElementById('passagesChart'), {
        type: 'bar',
        data: {
            labels: labelsPassages,
            datasets: [{
                label: 'Passages',
                data: dataPassages,
                backgroundColor: 'rgba(99, 102, 241, 0.8)', // Primary color
                borderRadius: 8,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Moyennes Chart
    const labelsMoyennes = moyennesData.map(item => item.titre.length > 20 ? item.titre.substring(0, 20) + '...' : item.titre);
    const dataMoyennes = moyennesData.map(item => parseFloat(item.moyenne));

    new Chart(document.getElementById('moyennesChart'), {
        type: 'doughnut',
        data: {
            labels: labelsMoyennes,
            datasets: [{
                data: dataMoyennes,
                backgroundColor: [
                    '#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6', '#f97316'
                ],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right', labels: { boxWidth: 12, usePointStyle: true, font: { size: 10 } } }
            },
            cutout: '65%'
        }
    });
});
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
        return "pages/testpsy/statistiques_globales.html.twig";
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
        return array (  194 => 81,  190 => 80,  154 => 47,  139 => 37,  126 => 27,  109 => 13,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Statistiques Globales{% endblock %}

{% block content %}
<div class=\"max-w-7xl mx-auto pb-24\">
    <!-- Header -->
    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface\">Statistiques Globales</h1>
            <p class=\"text-sm text-on-surface-variant mt-1\">Aperçu général de l'utilisation des tests psychologiques</p>
        </div>
        <a href=\"{{ path('testpsy_index') }}\"
           class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors\">
            <span class=\"material-symbols-outlined\">arrow_back</span> Retour aux tests
        </a>
    </div>

    <!-- Top Stats Cards -->
    <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10\">
        <div class=\"bg-gradient-to-br from-primary to-indigo-600 rounded-[2rem] p-6 text-white shadow-lg shadow-indigo-200 flex items-center gap-5\">
            <div class=\"w-14 h-14 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm\">
                <span class=\"material-symbols-outlined text-3xl\">psychology</span>
            </div>
            <div>
                <p class=\"text-[10px] font-bold uppercase tracking-widest text-indigo-100 mb-1\">Total Passages</p>
                <p class=\"text-4xl font-extrabold font-headline\">{{ stats_globales.total_passages }}</p>
            </div>
        </div>

        <div class=\"bg-white rounded-[2rem] p-6 border border-outline/20 shadow-sm flex items-center gap-5\">
            <div class=\"w-14 h-14 rounded-[1.25rem] bg-amber-50 text-amber-500 flex items-center justify-center\">
                <span class=\"material-symbols-outlined text-3xl\">star</span>
            </div>
            <div class=\"min-w-0\">
                <p class=\"text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-1\">Test le plus Populaire</p>
                <p class=\"text-xl font-extrabold text-on-surface font-headline truncate\" title=\"{{ stats_globales.populaire ?: 'Aucun' }}\">{{ stats_globales.populaire ?: 'Aucun test passé' }}</p>
            </div>
        </div>

        <div class=\"bg-white rounded-[2rem] p-6 border border-outline/20 shadow-sm flex items-center gap-5\">
            <div class=\"w-14 h-14 rounded-[1.25rem] bg-green-50 text-green-500 flex items-center justify-center\">
                <span class=\"material-symbols-outlined text-3xl\">analytics</span>
            </div>
            <div>
                <p class=\"text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-1\">Tests Actifs</p>
                <p class=\"text-2xl font-extrabold text-on-surface font-headline\">{{ passages|length }}</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class=\"grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10\">
        <!-- Passages Chart -->
        <div class=\"bg-white rounded-[2rem] p-8 border border-outline/20 shadow-sm\">
            <h3 class=\"text-lg font-extrabold font-headline text-on-surface mb-6 flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-primary\">bar_chart</span> Nombre de passages par test
            </h3>
            <div class=\"relative h-72 w-full\">
                <canvas id=\"passagesChart\"></canvas>
            </div>
        </div>

        <!-- Moyennes Chart -->
        <div class=\"bg-white rounded-[2rem] p-8 border border-outline/20 shadow-sm\">
            <h3 class=\"text-lg font-extrabold font-headline text-on-surface mb-6 flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-green-600\">pie_chart</span> Score moyen par test (%)
            </h3>
            <div class=\"relative h-72 w-full\">
                <canvas id=\"moyennesChart\"></canvas>
            </div>
        </div>
    </div>
</div>

<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data injection from Twig
    const passagesData = {{ passages|json_encode|raw }};
    const moyennesData = {{ moyennes|json_encode|raw }};

    if(passagesData.length === 0) return;

    // Passages Chart
    const labelsPassages = passagesData.map(item => item.titre.length > 20 ? item.titre.substring(0, 20) + '...' : item.titre);
    const dataPassages = passagesData.map(item => parseInt(item.nb_passages));

    new Chart(document.getElementById('passagesChart'), {
        type: 'bar',
        data: {
            labels: labelsPassages,
            datasets: [{
                label: 'Passages',
                data: dataPassages,
                backgroundColor: 'rgba(99, 102, 241, 0.8)', // Primary color
                borderRadius: 8,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Moyennes Chart
    const labelsMoyennes = moyennesData.map(item => item.titre.length > 20 ? item.titre.substring(0, 20) + '...' : item.titre);
    const dataMoyennes = moyennesData.map(item => parseFloat(item.moyenne));

    new Chart(document.getElementById('moyennesChart'), {
        type: 'doughnut',
        data: {
            labels: labelsMoyennes,
            datasets: [{
                data: dataMoyennes,
                backgroundColor: [
                    '#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6', '#f97316'
                ],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right', labels: { boxWidth: 12, usePointStyle: true, font: { size: 10 } } }
            },
            cutout: '65%'
        }
    });
});
</script>
{% endblock %}
", "pages/testpsy/statistiques_globales.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\testpsy\\statistiques_globales.html.twig");
    }
}
