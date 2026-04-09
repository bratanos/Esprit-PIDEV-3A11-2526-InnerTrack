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

/* pages/testpsy/create.html.twig */
class __TwigTemplate_cf74012b78840c9aa0b76abfe2c2fbd4 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/create.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/create.html.twig"));

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

        yield "Créer un Test";
        
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
        yield "<div class=\"max-w-3xl mx-auto pb-24\" x-data=\"createTest(";
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["old"] ?? null), "questions", [], "any", true, true, false, 6) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 6, $this->source); })()), "questions", [], "any", false, false, false, 6)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode(CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 6, $this->source); })()), "questions", [], "any", false, false, false, 6)), "html", null, true)) : ("['']"));
        yield ")\">

    <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index");
        yield "\"
       class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary mb-8 transition-colors\">
        <span class=\"material-symbols-outlined\">arrow_back</span> Retour
    </a>

    <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface mb-2\">Nouveau Test</h1>
    <p class=\"text-sm text-on-surface-variant mb-10\">Remplissez les informations et ajoutez vos questions.</p>

    ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "flashes", ["success"], "method", false, false, false, 16));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 17
            yield "        <div class=\"mb-6 bg-green-50 border border-green-200 text-green-700 text-sm font-bold px-6 py-4 rounded-2xl flex items-center gap-3\">
            <span class=\"material-symbols-outlined\">check_circle</span> ";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        yield "
    ";
        // line 22
        if ((array_key_exists("errors", $context) &&  !Twig\Extension\CoreExtension::testEmpty((isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 22, $this->source); })())))) {
            // line 23
            yield "        <div id=\"global-errors\" class=\"mb-6 bg-red-50 border border-red-200 px-6 py-4 rounded-2xl\">
            <div class=\"flex items-center gap-2 text-red-700 text-sm font-bold mb-2\">
                <span class=\"material-symbols-outlined\">error</span>
                Veuillez corriger les erreurs suivantes :
            </div>
            <ul class=\"list-disc list-inside space-y-1 text-red-600 text-xs font-medium\">
                ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 29, $this->source); })()));
            foreach ($context['_seq'] as $context["field"] => $context["msg"]) {
                // line 30
                yield "                    <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
                yield "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['field'], $context['msg'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            yield "            </ul>
        </div>
    ";
        }
        // line 35
        yield "
    <form method=\"post\" novalidate>

        <div class=\"bg-white rounded-[3rem] p-10 shadow-sm border border-outline/20 mb-6\">
            <h2 class=\"text-lg font-extrabold text-on-surface font-headline mb-6\">Informations générales</h2>

            <div class=\"space-y-5\">

                <!-- Titre -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Titre du test
                    </label>
                    <input type=\"text\" name=\"titre\" id=\"field-titre\"
                           value=\"";
        // line 49
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["old"] ?? null), "titre", [], "any", true, true, false, 49)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 49, $this->source); })()), "titre", [], "any", false, false, false, 49), "html", null, true)) : (""));
        yield "\"
                           placeholder=\"ex: Test d'anxiété GAD-7\"
                           class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all
                                  ";
        // line 52
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "titre", [], "any", true, true, false, 52)) ? ("border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30") : ("border-outline/30 focus:border-primary focus:ring-primary/10"));
        yield "\">
                    ";
        // line 53
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "titre", [], "any", true, true, false, 53)) {
            // line 54
            yield "                        <p id=\"error-titre\" class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> ";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 55, $this->source); })()), "titre", [], "any", false, false, false, 55), "html", null, true);
            yield "
                        </p>
                    ";
        }
        // line 58
        yield "                </div>

                <!-- Type -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Type de test
                    </label>
                    <div class=\"relative\">
                        <select name=\"id_type\" id=\"field-id_type\"
                                class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all appearance-none pr-12
                                       ";
        // line 68
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "id_type", [], "any", true, true, false, 68)) ? ("border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30") : ("border-outline/30 focus:border-primary focus:ring-primary/10"));
        yield "\">
                            <option value=\"\">Sélectionnez un type...</option>
                            ";
        // line 70
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["types"]) || array_key_exists("types", $context) ? $context["types"] : (function () { throw new RuntimeError('Variable "types" does not exist.', 70, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 71
            yield "                                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["type"], "id_type", [], "array", false, false, false, 71), "html", null, true);
            yield "\"
                                        ";
            // line 72
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["old"] ?? null), "id_type", [], "any", true, true, false, 72) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 72, $this->source); })()), "id_type", [], "any", false, false, false, 72) == CoreExtension::getAttribute($this->env, $this->source, $context["type"], "id_type", [], "array", false, false, false, 72)))) ? ("selected") : (""));
            yield ">
                                    ";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["type"], "libelle", [], "array", false, false, false, 73), "html", null, true);
            yield "
                                </option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['type'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        yield "                        </select>
                        <span class=\"material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none\">expand_more</span>
                    </div>
                    ";
        // line 79
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "id_type", [], "any", true, true, false, 79)) {
            // line 80
            yield "                        <p id=\"error-id_type\" class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> ";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 81, $this->source); })()), "id_type", [], "any", false, false, false, 81), "html", null, true);
            yield "
                        </p>
                    ";
        }
        // line 84
        yield "                </div>

                <!-- Description -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Description
                    </label>
                    <textarea name=\"description\" id=\"field-description\" rows=\"3\"
                              placeholder=\"Décrivez l'objectif de ce test...\"
                              class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all resize-none
                                     ";
        // line 94
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "description", [], "any", true, true, false, 94)) ? ("border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30") : ("border-outline/30 focus:border-primary focus:ring-primary/10"));
        yield "\">";
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["old"] ?? null), "description", [], "any", true, true, false, 94)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 94, $this->source); })()), "description", [], "any", false, false, false, 94), "html", null, true)) : (""));
        yield "</textarea>
                    ";
        // line 95
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "description", [], "any", true, true, false, 95)) {
            // line 96
            yield "                        <p id=\"error-description\" class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> ";
            // line 97
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 97, $this->source); })()), "description", [], "any", false, false, false, 97), "html", null, true);
            yield "
                        </p>
                    ";
        }
        // line 100
        yield "                </div>

            </div>
        </div>

        <!-- Questions -->
        <div class=\"bg-white rounded-[3rem] p-10 shadow-sm border ";
        // line 106
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "questions", [], "any", true, true, false, 106)) ? ("border-red-300") : ("border-outline/20"));
        yield " mb-6\" id=\"questions-block\">
            <div class=\"flex items-center justify-between mb-6\">
                <h2 class=\"text-lg font-extrabold text-on-surface font-headline\">Questions</h2>
                <span class=\"text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full\"
                      x-text=\"questions.length + ' question(s)'\"></span>
            </div>

            ";
        // line 113
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "questions", [], "any", true, true, false, 113)) {
            // line 114
            yield "                <p id=\"error-questions\" class=\"mb-4 text-xs font-bold text-red-500 flex items-center gap-1\">
                    <span class=\"material-symbols-outlined text-sm\">error</span> ";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 115, $this->source); })()), "questions", [], "any", false, false, false, 115), "html", null, true);
            yield "
                </p>
            ";
        }
        // line 118
        yield "
            <div class=\"space-y-4\">
                <template x-for=\"(q, index) in questions\" :key=\"index\">
                    <div class=\"flex items-start gap-4 p-5 bg-gray-50/50 rounded-[1.5rem] border border-outline/10\">
                        <div class=\"w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-extrabold flex-shrink-0 mt-1\"
                             x-text=\"index + 1\"></div>
                        <input type=\"text\" :name=\"'questions[' + index + ']'\"
                               x-model=\"questions[index]\"
                               @input=\"clearQuestionError()\"
                               placeholder=\"Rédigez votre question ici...\"
                               class=\"flex-1 bg-transparent text-sm font-medium text-on-surface placeholder-on-surface-variant/40 focus:outline-none\">
                        <button type=\"button\" @click=\"removeQuestion(index)\"
                                class=\"w-8 h-8 rounded-full bg-red-50 text-red-400 hover:bg-red-100 flex items-center justify-center transition-all flex-shrink-0 mt-1\">
                            <span class=\"material-symbols-outlined text-base\">close</span>
                        </button>
                    </div>
                </template>
            </div>

            <button type=\"button\" @click=\"addQuestion()\"
                    class=\"mt-5 w-full py-4 border-2 border-dashed border-outline/40 rounded-[1.5rem] text-sm font-bold text-on-surface-variant hover:border-primary/50 hover:text-primary hover:bg-primary/5 transition-all flex items-center justify-center gap-2\">
                <span class=\"material-symbols-outlined\">add</span> Ajouter une question
            </button>
        </div>

        <button type=\"submit\"
                class=\"w-full py-4 text-base font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-lg shadow-primary/20\">
            Créer le test
        </button>

    </form>
</div>

<script>
function createTest(initialQuestions) {
    return {
        questions: (initialQuestions && initialQuestions.length > 0) ? initialQuestions : [''],
        addQuestion() { this.questions.push(''); },
        removeQuestion(index) {
            if (this.questions.length > 1) this.questions.splice(index, 1);
        },
        clearQuestionError() {
            const err = document.getElementById('error-questions');
            if (err) err.remove();
            const block = document.getElementById('questions-block');
            if (block) {
                block.classList.remove('border-red-300');
                block.classList.add('border-outline/20');
            }
        }
    }
}

// Supprime l'erreur inline + reset la bordure dès que l'utilisateur interagit
(function () {
    const fields = ['titre', 'id_type', 'description'];
    fields.forEach(function (name) {
        const el = document.getElementById('field-' + name);
        const err = document.getElementById('error-' + name);
        if (!el) return;

        const resetField = function () {
            // Retirer le message d'erreur
            if (err) err.remove();
            // Reset les classes de l'input/select/textarea
            el.classList.remove('border-red-400', 'focus:border-red-400', 'focus:ring-red-100', 'bg-red-50/30');
            el.classList.add('border-outline/30', 'focus:border-primary', 'focus:ring-primary/10');
        };

        el.addEventListener('input', resetField);
        el.addEventListener('change', resetField); // pour le select
    });
})();
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
        return "pages/testpsy/create.html.twig";
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
        return array (  314 => 118,  308 => 115,  305 => 114,  303 => 113,  293 => 106,  285 => 100,  279 => 97,  276 => 96,  274 => 95,  268 => 94,  256 => 84,  250 => 81,  247 => 80,  245 => 79,  240 => 76,  231 => 73,  227 => 72,  222 => 71,  218 => 70,  213 => 68,  201 => 58,  195 => 55,  192 => 54,  190 => 53,  186 => 52,  180 => 49,  164 => 35,  159 => 32,  150 => 30,  146 => 29,  138 => 23,  136 => 22,  133 => 21,  124 => 18,  121 => 17,  117 => 16,  106 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Créer un Test{% endblock %}

{% block content %}
<div class=\"max-w-3xl mx-auto pb-24\" x-data=\"createTest({{ (old.questions is defined and old.questions is not empty) ? old.questions|json_encode : \"['']\" }})\">

    <a href=\"{{ path('testpsy_index') }}\"
       class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary mb-8 transition-colors\">
        <span class=\"material-symbols-outlined\">arrow_back</span> Retour
    </a>

    <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface mb-2\">Nouveau Test</h1>
    <p class=\"text-sm text-on-surface-variant mb-10\">Remplissez les informations et ajoutez vos questions.</p>

    {% for message in app.flashes('success') %}
        <div class=\"mb-6 bg-green-50 border border-green-200 text-green-700 text-sm font-bold px-6 py-4 rounded-2xl flex items-center gap-3\">
            <span class=\"material-symbols-outlined\">check_circle</span> {{ message }}
        </div>
    {% endfor %}

    {% if errors is defined and errors is not empty %}
        <div id=\"global-errors\" class=\"mb-6 bg-red-50 border border-red-200 px-6 py-4 rounded-2xl\">
            <div class=\"flex items-center gap-2 text-red-700 text-sm font-bold mb-2\">
                <span class=\"material-symbols-outlined\">error</span>
                Veuillez corriger les erreurs suivantes :
            </div>
            <ul class=\"list-disc list-inside space-y-1 text-red-600 text-xs font-medium\">
                {% for field, msg in errors %}
                    <li>{{ msg }}</li>
                {% endfor %}
            </ul>
        </div>
    {% endif %}

    <form method=\"post\" novalidate>

        <div class=\"bg-white rounded-[3rem] p-10 shadow-sm border border-outline/20 mb-6\">
            <h2 class=\"text-lg font-extrabold text-on-surface font-headline mb-6\">Informations générales</h2>

            <div class=\"space-y-5\">

                <!-- Titre -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Titre du test
                    </label>
                    <input type=\"text\" name=\"titre\" id=\"field-titre\"
                           value=\"{{ old.titre is defined ? old.titre : '' }}\"
                           placeholder=\"ex: Test d'anxiété GAD-7\"
                           class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all
                                  {{ errors.titre is defined ? 'border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30' : 'border-outline/30 focus:border-primary focus:ring-primary/10' }}\">
                    {% if errors.titre is defined %}
                        <p id=\"error-titre\" class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> {{ errors.titre }}
                        </p>
                    {% endif %}
                </div>

                <!-- Type -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Type de test
                    </label>
                    <div class=\"relative\">
                        <select name=\"id_type\" id=\"field-id_type\"
                                class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all appearance-none pr-12
                                       {{ errors.id_type is defined ? 'border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30' : 'border-outline/30 focus:border-primary focus:ring-primary/10' }}\">
                            <option value=\"\">Sélectionnez un type...</option>
                            {% for type in types %}
                                <option value=\"{{ type['id_type'] }}\"
                                        {{ (old.id_type is defined and old.id_type == type['id_type']) ? 'selected' : '' }}>
                                    {{ type['libelle'] }}
                                </option>
                            {% endfor %}
                        </select>
                        <span class=\"material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none\">expand_more</span>
                    </div>
                    {% if errors.id_type is defined %}
                        <p id=\"error-id_type\" class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> {{ errors.id_type }}
                        </p>
                    {% endif %}
                </div>

                <!-- Description -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Description
                    </label>
                    <textarea name=\"description\" id=\"field-description\" rows=\"3\"
                              placeholder=\"Décrivez l'objectif de ce test...\"
                              class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all resize-none
                                     {{ errors.description is defined ? 'border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30' : 'border-outline/30 focus:border-primary focus:ring-primary/10' }}\">{{ old.description is defined ? old.description : '' }}</textarea>
                    {% if errors.description is defined %}
                        <p id=\"error-description\" class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> {{ errors.description }}
                        </p>
                    {% endif %}
                </div>

            </div>
        </div>

        <!-- Questions -->
        <div class=\"bg-white rounded-[3rem] p-10 shadow-sm border {{ errors.questions is defined ? 'border-red-300' : 'border-outline/20' }} mb-6\" id=\"questions-block\">
            <div class=\"flex items-center justify-between mb-6\">
                <h2 class=\"text-lg font-extrabold text-on-surface font-headline\">Questions</h2>
                <span class=\"text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full\"
                      x-text=\"questions.length + ' question(s)'\"></span>
            </div>

            {% if errors.questions is defined %}
                <p id=\"error-questions\" class=\"mb-4 text-xs font-bold text-red-500 flex items-center gap-1\">
                    <span class=\"material-symbols-outlined text-sm\">error</span> {{ errors.questions }}
                </p>
            {% endif %}

            <div class=\"space-y-4\">
                <template x-for=\"(q, index) in questions\" :key=\"index\">
                    <div class=\"flex items-start gap-4 p-5 bg-gray-50/50 rounded-[1.5rem] border border-outline/10\">
                        <div class=\"w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-extrabold flex-shrink-0 mt-1\"
                             x-text=\"index + 1\"></div>
                        <input type=\"text\" :name=\"'questions[' + index + ']'\"
                               x-model=\"questions[index]\"
                               @input=\"clearQuestionError()\"
                               placeholder=\"Rédigez votre question ici...\"
                               class=\"flex-1 bg-transparent text-sm font-medium text-on-surface placeholder-on-surface-variant/40 focus:outline-none\">
                        <button type=\"button\" @click=\"removeQuestion(index)\"
                                class=\"w-8 h-8 rounded-full bg-red-50 text-red-400 hover:bg-red-100 flex items-center justify-center transition-all flex-shrink-0 mt-1\">
                            <span class=\"material-symbols-outlined text-base\">close</span>
                        </button>
                    </div>
                </template>
            </div>

            <button type=\"button\" @click=\"addQuestion()\"
                    class=\"mt-5 w-full py-4 border-2 border-dashed border-outline/40 rounded-[1.5rem] text-sm font-bold text-on-surface-variant hover:border-primary/50 hover:text-primary hover:bg-primary/5 transition-all flex items-center justify-center gap-2\">
                <span class=\"material-symbols-outlined\">add</span> Ajouter une question
            </button>
        </div>

        <button type=\"submit\"
                class=\"w-full py-4 text-base font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-lg shadow-primary/20\">
            Créer le test
        </button>

    </form>
</div>

<script>
function createTest(initialQuestions) {
    return {
        questions: (initialQuestions && initialQuestions.length > 0) ? initialQuestions : [''],
        addQuestion() { this.questions.push(''); },
        removeQuestion(index) {
            if (this.questions.length > 1) this.questions.splice(index, 1);
        },
        clearQuestionError() {
            const err = document.getElementById('error-questions');
            if (err) err.remove();
            const block = document.getElementById('questions-block');
            if (block) {
                block.classList.remove('border-red-300');
                block.classList.add('border-outline/20');
            }
        }
    }
}

// Supprime l'erreur inline + reset la bordure dès que l'utilisateur interagit
(function () {
    const fields = ['titre', 'id_type', 'description'];
    fields.forEach(function (name) {
        const el = document.getElementById('field-' + name);
        const err = document.getElementById('error-' + name);
        if (!el) return;

        const resetField = function () {
            // Retirer le message d'erreur
            if (err) err.remove();
            // Reset les classes de l'input/select/textarea
            el.classList.remove('border-red-400', 'focus:border-red-400', 'focus:ring-red-100', 'bg-red-50/30');
            el.classList.add('border-outline/30', 'focus:border-primary', 'focus:ring-primary/10');
        };

        el.addEventListener('input', resetField);
        el.addEventListener('change', resetField); // pour le select
    });
})();
</script>
{% endblock %}
", "pages/testpsy/create.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\testpsy\\create.html.twig");
    }
}
