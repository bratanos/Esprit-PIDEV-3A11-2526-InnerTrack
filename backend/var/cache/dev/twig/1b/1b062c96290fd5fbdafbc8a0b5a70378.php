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

/* pages/testpsy/edit.html.twig */
class __TwigTemplate_2f06ae2b8c22e4cdebd52c7c9fb9e214 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/edit.html.twig"));

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

        yield "Modifier le Test";
        
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
        yield "<div class=\"max-w-3xl mx-auto pb-24\" x-data=\"editTest(";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode(Twig\Extension\CoreExtension::map($this->env, (isset($context["questions"]) || array_key_exists("questions", $context) ? $context["questions"] : (function () { throw new RuntimeError('Variable "questions" does not exist.', 6, $this->source); })()), function ($__q__) use ($context, $macros) { $context["q"] = $__q__; return CoreExtension::getAttribute($this->env, $this->source, (isset($context["q"]) || array_key_exists("q", $context) ? $context["q"] : (function () { throw new RuntimeError('Variable "q" does not exist.', 6, $this->source); })()), "contenu", [], "any", false, false, false, 6); })), "html_attr");
        yield ")\">

    <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index");
        yield "\"
       class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary mb-8 transition-colors\">
        <span class=\"material-symbols-outlined\">arrow_back</span> Retour
    </a>

    <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface mb-2\">Modifier le Test</h1>
    <p class=\"text-sm text-on-surface-variant mb-10\">Mettez à jour les informations et les questions.</p>

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
        // line 23
        yield "    ";
        if ((array_key_exists("errors", $context) &&  !Twig\Extension\CoreExtension::testEmpty((isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 23, $this->source); })())))) {
            // line 24
            yield "        <div class=\"mb-6 bg-red-50 border border-red-200 px-6 py-4 rounded-2xl\">
            <div class=\"flex items-center gap-2 text-red-700 text-sm font-bold mb-2\">
                <span class=\"material-symbols-outlined\">error</span>
                Veuillez corriger les erreurs suivantes :
            </div>
            <ul class=\"list-disc list-inside space-y-1 text-red-600 text-xs font-medium\">
                ";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 30, $this->source); })()));
            foreach ($context['_seq'] as $context["field"] => $context["msg"]) {
                // line 31
                yield "                    <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
                yield "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['field'], $context['msg'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 33
            yield "            </ul>
        </div>
    ";
        }
        // line 36
        yield "
    ";
        // line 38
        yield "    <form method=\"post\" novalidate>

        <!-- Test Info -->
        <div class=\"bg-white rounded-[3rem] p-10 shadow-sm border border-outline/20 mb-6\">
            <h2 class=\"text-lg font-extrabold text-on-surface font-headline mb-6\">Informations générales</h2>

            <div class=\"space-y-5\">

                <!-- Titre -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Titre du test
                    </label>
                    <input type=\"text\" name=\"titre\"
                           value=\"";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 52, $this->source); })()), "titre", [], "any", false, false, false, 52), "html", null, true);
        yield "\"
                           class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all
                                  ";
        // line 54
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "titre", [], "any", true, true, false, 54)) ? ("border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30") : ("border-outline/30 focus:border-primary focus:ring-primary/10"));
        yield "\">
                    ";
        // line 55
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "titre", [], "any", true, true, false, 55)) {
            // line 56
            yield "                        <p class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> ";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 57, $this->source); })()), "titre", [], "any", false, false, false, 57), "html", null, true);
            yield "
                        </p>
                    ";
        }
        // line 60
        yield "                </div>

                <!-- Type de test -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Type de test
                    </label>
                    <div class=\"relative\">
                        <select name=\"id_type\"
                                class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all appearance-none pr-12
                                       ";
        // line 70
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "id_type", [], "any", true, true, false, 70)) ? ("border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30") : ("border-outline/30 focus:border-primary focus:ring-primary/10"));
        yield "\">
                            <option value=\"\">Sélectionnez un type...</option>
                            ";
        // line 72
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["types"]) || array_key_exists("types", $context) ? $context["types"] : (function () { throw new RuntimeError('Variable "types" does not exist.', 72, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 73
            yield "                                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["type"], "id_type", [], "array", false, false, false, 73), "html", null, true);
            yield "\"
                                        ";
            // line 74
            yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 74, $this->source); })()), "idType", [], "any", false, false, false, 74) == CoreExtension::getAttribute($this->env, $this->source, $context["type"], "id_type", [], "array", false, false, false, 74))) ? ("selected") : (""));
            yield ">
                                    ";
            // line 75
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["type"], "libelle", [], "array", false, false, false, 75), "html", null, true);
            yield "
                                </option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['type'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        yield "                        </select>
                        <span class=\"material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none\">expand_more</span>
                    </div>
                    ";
        // line 81
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "id_type", [], "any", true, true, false, 81)) {
            // line 82
            yield "                        <p class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> ";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 83, $this->source); })()), "id_type", [], "any", false, false, false, 83), "html", null, true);
            yield "
                        </p>
                    ";
        }
        // line 86
        yield "                </div>

                <!-- Description -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Description
                    </label>
                    <textarea name=\"description\" rows=\"3\"
                              class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all resize-none
                                     ";
        // line 95
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "description", [], "any", true, true, false, 95)) ? ("border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30") : ("border-outline/30 focus:border-primary focus:ring-primary/10"));
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 95, $this->source); })()), "description", [], "any", false, false, false, 95), "html", null, true);
        yield "</textarea>
                    ";
        // line 96
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "description", [], "any", true, true, false, 96)) {
            // line 97
            yield "                        <p class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> ";
            // line 98
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 98, $this->source); })()), "description", [], "any", false, false, false, 98), "html", null, true);
            yield "
                        </p>
                    ";
        }
        // line 101
        yield "                </div>

            </div>
        </div>

        <!-- Questions -->
        <div class=\"bg-white rounded-[3rem] p-10 shadow-sm border ";
        // line 107
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "questions", [], "any", true, true, false, 107)) ? ("border-red-300") : ("border-outline/20"));
        yield " mb-6\">
            <div class=\"flex items-center justify-between mb-6\">
                <h2 class=\"text-lg font-extrabold text-on-surface font-headline\">Questions</h2>
                <span class=\"text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full\"
                      x-text=\"questions.length + ' question(s)'\"></span>
            </div>

            ";
        // line 114
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "questions", [], "any", true, true, false, 114)) {
            // line 115
            yield "                <p class=\"mb-4 text-xs font-bold text-red-500 flex items-center gap-1\">
                    <span class=\"material-symbols-outlined text-sm\">error</span> ";
            // line 116
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 116, $this->source); })()), "questions", [], "any", false, false, false, 116), "html", null, true);
            yield "
                </p>
            ";
        }
        // line 119
        yield "
            <div class=\"space-y-4\">
                <template x-for=\"(q, index) in questions\" :key=\"index\">
                    <div class=\"flex items-start gap-4 p-5 bg-gray-50/50 rounded-[1.5rem] border border-outline/10\">
                        <div class=\"w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-extrabold flex-shrink-0 mt-1\"
                             x-text=\"index + 1\"></div>
                        <input type=\"text\"
                               :name=\"'questions[' + index + ']'\"
                               x-model=\"questions[index]\"
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

        <!-- Actions -->
        <div class=\"flex gap-4\">
            <a href=\"";
        // line 145
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index");
        yield "\"
               class=\"flex-1 py-4 text-center text-sm font-bold text-on-surface-variant bg-gray-50 border border-outline/30 rounded-2xl hover:bg-white hover:border-outline transition-all uppercase tracking-wider\">
                Annuler
            </a>
            <button type=\"submit\"
                    class=\"flex-1 py-4 text-sm font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-lg shadow-primary/20 uppercase tracking-wider\">
                Enregistrer les modifications
            </button>
        </div>

    </form>

    <!-- Danger Zone -->
    <div class=\"mt-8 bg-red-50/50 rounded-[2.5rem] p-8 border border-red-100\">
        <h3 class=\"text-sm font-extrabold text-red-600 uppercase tracking-widest mb-2 flex items-center gap-2\">
            <span class=\"material-symbols-outlined text-lg\">warning</span> Zone dangereuse
        </h3>
        <p class=\"text-xs text-red-400 mb-6\">La suppression est irréversible. Toutes les questions et résultats liés seront perdus.</p>
        <form method=\"post\" action=\"";
        // line 163
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 163, $this->source); })()), "idTest", [], "any", false, false, false, 163)]), "html", null, true);
        yield "\"
              onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer ce test ? Cette action est irréversible.')\">
            <button type=\"submit\"
                    class=\"px-8 py-3 bg-red-500 text-white text-sm font-bold rounded-2xl hover:bg-red-600 transition-all active:scale-95 shadow-md shadow-red-100 flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-lg\">delete_forever</span> Supprimer ce test
            </button>
        </form>
    </div>

</div>

<script>
function editTest(initialQuestions) {
    return {
        questions: initialQuestions.length > 0 ? initialQuestions : [''],
        addQuestion() { this.questions.push(''); },
        removeQuestion(index) {
            if (this.questions.length > 1) this.questions.splice(index, 1);
        }
    }
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
        return "pages/testpsy/edit.html.twig";
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
        return array (  365 => 163,  344 => 145,  316 => 119,  310 => 116,  307 => 115,  305 => 114,  295 => 107,  287 => 101,  281 => 98,  278 => 97,  276 => 96,  270 => 95,  259 => 86,  253 => 83,  250 => 82,  248 => 81,  243 => 78,  234 => 75,  230 => 74,  225 => 73,  221 => 72,  216 => 70,  204 => 60,  198 => 57,  195 => 56,  193 => 55,  189 => 54,  184 => 52,  168 => 38,  165 => 36,  160 => 33,  151 => 31,  147 => 30,  139 => 24,  136 => 23,  133 => 21,  124 => 18,  121 => 17,  117 => 16,  106 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Modifier le Test{% endblock %}

{% block content %}
<div class=\"max-w-3xl mx-auto pb-24\" x-data=\"editTest({{ questions|map(q => q.contenu)|json_encode|e('html_attr') }})\">

    <a href=\"{{ path('testpsy_index') }}\"
       class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary mb-8 transition-colors\">
        <span class=\"material-symbols-outlined\">arrow_back</span> Retour
    </a>

    <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface mb-2\">Modifier le Test</h1>
    <p class=\"text-sm text-on-surface-variant mb-10\">Mettez à jour les informations et les questions.</p>

    {% for message in app.flashes('success') %}
        <div class=\"mb-6 bg-green-50 border border-green-200 text-green-700 text-sm font-bold px-6 py-4 rounded-2xl flex items-center gap-3\">
            <span class=\"material-symbols-outlined\">check_circle</span> {{ message }}
        </div>
    {% endfor %}

    {# Bloc d'erreurs globales PHP #}
    {% if errors is defined and errors is not empty %}
        <div class=\"mb-6 bg-red-50 border border-red-200 px-6 py-4 rounded-2xl\">
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

    {# novalidate = désactive toute validation HTML5 du navigateur #}
    <form method=\"post\" novalidate>

        <!-- Test Info -->
        <div class=\"bg-white rounded-[3rem] p-10 shadow-sm border border-outline/20 mb-6\">
            <h2 class=\"text-lg font-extrabold text-on-surface font-headline mb-6\">Informations générales</h2>

            <div class=\"space-y-5\">

                <!-- Titre -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Titre du test
                    </label>
                    <input type=\"text\" name=\"titre\"
                           value=\"{{ test.titre }}\"
                           class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all
                                  {{ errors.titre is defined ? 'border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30' : 'border-outline/30 focus:border-primary focus:ring-primary/10' }}\">
                    {% if errors.titre is defined %}
                        <p class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> {{ errors.titre }}
                        </p>
                    {% endif %}
                </div>

                <!-- Type de test -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Type de test
                    </label>
                    <div class=\"relative\">
                        <select name=\"id_type\"
                                class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all appearance-none pr-12
                                       {{ errors.id_type is defined ? 'border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30' : 'border-outline/30 focus:border-primary focus:ring-primary/10' }}\">
                            <option value=\"\">Sélectionnez un type...</option>
                            {% for type in types %}
                                <option value=\"{{ type['id_type'] }}\"
                                        {{ test.idType == type['id_type'] ? 'selected' : '' }}>
                                    {{ type['libelle'] }}
                                </option>
                            {% endfor %}
                        </select>
                        <span class=\"material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none\">expand_more</span>
                    </div>
                    {% if errors.id_type is defined %}
                        <p class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> {{ errors.id_type }}
                        </p>
                    {% endif %}
                </div>

                <!-- Description -->
                <div>
                    <label class=\"block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2\">
                        Description
                    </label>
                    <textarea name=\"description\" rows=\"3\"
                              class=\"w-full px-6 py-4 rounded-2xl border text-sm font-medium text-on-surface bg-gray-50/50 focus:outline-none focus:ring-2 transition-all resize-none
                                     {{ errors.description is defined ? 'border-red-400 focus:border-red-400 focus:ring-red-100 bg-red-50/30' : 'border-outline/30 focus:border-primary focus:ring-primary/10' }}\">{{ test.description }}</textarea>
                    {% if errors.description is defined %}
                        <p class=\"mt-2 text-xs font-bold text-red-500 flex items-center gap-1\">
                            <span class=\"material-symbols-outlined text-sm\">error</span> {{ errors.description }}
                        </p>
                    {% endif %}
                </div>

            </div>
        </div>

        <!-- Questions -->
        <div class=\"bg-white rounded-[3rem] p-10 shadow-sm border {{ errors.questions is defined ? 'border-red-300' : 'border-outline/20' }} mb-6\">
            <div class=\"flex items-center justify-between mb-6\">
                <h2 class=\"text-lg font-extrabold text-on-surface font-headline\">Questions</h2>
                <span class=\"text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full\"
                      x-text=\"questions.length + ' question(s)'\"></span>
            </div>

            {% if errors.questions is defined %}
                <p class=\"mb-4 text-xs font-bold text-red-500 flex items-center gap-1\">
                    <span class=\"material-symbols-outlined text-sm\">error</span> {{ errors.questions }}
                </p>
            {% endif %}

            <div class=\"space-y-4\">
                <template x-for=\"(q, index) in questions\" :key=\"index\">
                    <div class=\"flex items-start gap-4 p-5 bg-gray-50/50 rounded-[1.5rem] border border-outline/10\">
                        <div class=\"w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-extrabold flex-shrink-0 mt-1\"
                             x-text=\"index + 1\"></div>
                        <input type=\"text\"
                               :name=\"'questions[' + index + ']'\"
                               x-model=\"questions[index]\"
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

        <!-- Actions -->
        <div class=\"flex gap-4\">
            <a href=\"{{ path('testpsy_index') }}\"
               class=\"flex-1 py-4 text-center text-sm font-bold text-on-surface-variant bg-gray-50 border border-outline/30 rounded-2xl hover:bg-white hover:border-outline transition-all uppercase tracking-wider\">
                Annuler
            </a>
            <button type=\"submit\"
                    class=\"flex-1 py-4 text-sm font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-lg shadow-primary/20 uppercase tracking-wider\">
                Enregistrer les modifications
            </button>
        </div>

    </form>

    <!-- Danger Zone -->
    <div class=\"mt-8 bg-red-50/50 rounded-[2.5rem] p-8 border border-red-100\">
        <h3 class=\"text-sm font-extrabold text-red-600 uppercase tracking-widest mb-2 flex items-center gap-2\">
            <span class=\"material-symbols-outlined text-lg\">warning</span> Zone dangereuse
        </h3>
        <p class=\"text-xs text-red-400 mb-6\">La suppression est irréversible. Toutes les questions et résultats liés seront perdus.</p>
        <form method=\"post\" action=\"{{ path('testpsy_delete', {id: test.idTest}) }}\"
              onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer ce test ? Cette action est irréversible.')\">
            <button type=\"submit\"
                    class=\"px-8 py-3 bg-red-500 text-white text-sm font-bold rounded-2xl hover:bg-red-600 transition-all active:scale-95 shadow-md shadow-red-100 flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-lg\">delete_forever</span> Supprimer ce test
            </button>
        </form>
    </div>

</div>

<script>
function editTest(initialQuestions) {
    return {
        questions: initialQuestions.length > 0 ? initialQuestions : [''],
        addQuestion() { this.questions.push(''); },
        removeQuestion(index) {
            if (this.questions.length > 1) this.questions.splice(index, 1);
        }
    }
}
</script>
{% endblock %}
", "pages/testpsy/edit.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\testpsy\\edit.html.twig");
    }
}
