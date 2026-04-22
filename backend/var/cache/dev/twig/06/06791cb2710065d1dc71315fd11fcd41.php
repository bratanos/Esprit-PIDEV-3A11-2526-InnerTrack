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

/* pages/testpsy/passer.html.twig */
class __TwigTemplate_d0e0f0580871ac5bb2eba278622a2846 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/passer.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/passer.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 3, $this->source); })()), "titre", [], "any", false, false, false, 3), "html", null, true);
        
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
        yield "<div class=\"max-w-2xl mx-auto pb-24\" x-data=\"testPsy()\">

    <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index");
        yield "\" class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary mb-8 transition-colors\">
        <span class=\"material-symbols-outlined\">arrow_back</span> Abandonner
    </a>

    <!-- Progress bar -->
    <div class=\"mb-10\">
        <div class=\"flex items-center justify-between mb-2\">
            <span class=\"text-xs font-bold text-on-surface-variant uppercase tracking-widest\">Progression</span>
            <span class=\"text-xs font-bold text-primary\" x-text=\"answered + ' / ";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["questions"]) || array_key_exists("questions", $context) ? $context["questions"] : (function () { throw new RuntimeError('Variable "questions" does not exist.', 16, $this->source); })())), "html", null, true);
        yield "'\"></span>
        </div>
        <div class=\"h-2 bg-gray-100 rounded-full overflow-hidden\">
            <div class=\"h-full rounded-full transition-all duration-500\"
                 style=\"background: linear-gradient(90deg, #6366f1, #4f46e5);\"
                 :style=\"'width: ' + (answered / ";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["questions"]) || array_key_exists("questions", $context) ? $context["questions"] : (function () { throw new RuntimeError('Variable "questions" does not exist.', 21, $this->source); })())), "html", null, true);
        yield " * 100) + '%'\"></div>
        </div>
    </div>

    <h1 class=\"text-2xl font-extrabold font-headline tracking-tight text-on-surface mb-2\">";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["test"]) || array_key_exists("test", $context) ? $context["test"] : (function () { throw new RuntimeError('Variable "test" does not exist.', 25, $this->source); })()), "titre", [], "any", false, false, false, 25), "html", null, true);
        yield "</h1>
    <p class=\"text-sm text-on-surface-variant mb-10\">Répondez honnêtement à chaque question.</p>

    <style>
        /* Option par défaut */
        .answer-option {
            border: 1.5px solid rgba(0,0,0,0.08);
            border-radius: 1rem;
            padding: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            color: #64748b;
            position: relative;
            overflow: hidden;
            user-select: none;
        }

        /* Hover */
        .answer-option:hover {
            border-color: rgba(79, 70, 229, 0.4);
            background: rgba(79, 70, 229, 0.04);
            transform: translateY(-1px);
        }

        /* Sélectionné — dégradé bleu */
        input[type=\"radio\"]:checked + .answer-option {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #3730a3 100%);
            border-color: transparent;
            color: white;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 8px 24px -4px rgba(79, 70, 229, 0.45),
                        0 4px 10px -2px rgba(79, 70, 229, 0.3);
        }

        /* Ripple animation au clic */
        .answer-option::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(255,255,255,0.35) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        input[type=\"radio\"]:checked + .answer-option::after {
            opacity: 1;
        }

        /* Animation pulse sur la carte question quand répondue */
        .question-card.answered {
            border-color: rgba(79, 70, 229, 0.25);
            background: linear-gradient(135deg, #ffffff 0%, rgba(238, 242, 255, 0.4) 100%);
        }

        /* Numéro de question animé */
        .question-number {
            transition: color 0.3s ease;
        }
        .question-card.answered .question-number {
            color: #4f46e5;
        }
    </style>

    <form method=\"post\" @submit=\"checkAll(\$event)\">
        <div class=\"space-y-6\">
            ";
        // line 92
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["questions"]) || array_key_exists("questions", $context) ? $context["questions"] : (function () { throw new RuntimeError('Variable "questions" does not exist.', 92, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["q"]) {
            // line 93
            yield "            <div class=\"question-card bg-white rounded-[2.5rem] p-8 shadow-sm border border-outline/20 transition-all duration-500\"
                 id=\"q";
            // line 94
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["q"], "idQuestion", [], "any", false, false, false, 94), "html", null, true);
            yield "\">
                <p class=\"text-base font-bold text-on-surface mb-6\">
                    <span class=\"question-number text-primary font-extrabold\">";
            // line 96
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 96), "html", null, true);
            yield ".</span> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["q"], "contenu", [], "any", false, false, false, 96), "html", null, true);
            yield "
                </p>
                <div class=\"grid grid-cols-4 gap-3\">
                    ";
            // line 99
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable([1 => "Jamais", 2 => "Parfois", 3 => "Souvent", 4 => "Toujours"]);
            foreach ($context['_seq'] as $context["val"] => $context["label"]) {
                // line 100
                yield "                    <label class=\"cursor-pointer\">
                        <input type=\"radio\"
                               name=\"reponses[";
                // line 102
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["q"], "idQuestion", [], "any", false, false, false, 102), "html", null, true);
                yield "]\"
                               value=\"";
                // line 103
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["val"], "html", null, true);
                yield "\"
                               class=\"sr-only\"
                               @change=\"markAnswered('";
                // line 105
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["q"], "idQuestion", [], "any", false, false, false, 105), "html", null, true);
                yield "')\">
                        <div class=\"answer-option\">
                            <div class=\"text-lg font-extrabold mb-1\">";
                // line 107
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["val"], "html", null, true);
                yield "</div>
                            <div class=\"text-[9px] uppercase tracking-wider font-bold\">";
                // line 108
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "</div>
                        </div>
                    </label>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['val'], $context['label'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 112
            yield "                </div>
            </div>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['q'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 115
        yield "        </div>

        <div class=\"mt-10\">
            <button type=\"submit\"
                    class=\"w-full py-4 text-base font-bold text-white rounded-2xl transition-all active:scale-95 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed\"
                    style=\"background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); box-shadow: 0 8px 24px -4px rgba(79,70,229,0.35);\">
                Soumettre mes réponses
            </button>
        </div>
    </form>
</div>

<script>
function testPsy() {
    return {
        answered: 0,
        answeredIds: new Set(),
        markAnswered(id) {
            // Colorer la carte question
            const card = document.getElementById('q' + id);
            if (card) card.classList.add('answered');

            if (!this.answeredIds.has(id)) {
                this.answeredIds.add(id);
                this.answered++;
            }
        },
        checkAll(e) {
            if (this.answered < ";
        // line 143
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["questions"]) || array_key_exists("questions", $context) ? $context["questions"] : (function () { throw new RuntimeError('Variable "questions" does not exist.', 143, $this->source); })())), "html", null, true);
        yield ") {
                e.preventDefault();
                alert('Veuillez répondre à toutes les questions avant de soumettre.');
            }
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
        return "pages/testpsy/passer.html.twig";
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
        return array (  315 => 143,  285 => 115,  269 => 112,  259 => 108,  255 => 107,  250 => 105,  245 => 103,  241 => 102,  237 => 100,  233 => 99,  225 => 96,  220 => 94,  217 => 93,  200 => 92,  130 => 25,  123 => 21,  115 => 16,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}{{ test.titre }}{% endblock %}

{% block content %}
<div class=\"max-w-2xl mx-auto pb-24\" x-data=\"testPsy()\">

    <a href=\"{{ path('testpsy_index') }}\" class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary mb-8 transition-colors\">
        <span class=\"material-symbols-outlined\">arrow_back</span> Abandonner
    </a>

    <!-- Progress bar -->
    <div class=\"mb-10\">
        <div class=\"flex items-center justify-between mb-2\">
            <span class=\"text-xs font-bold text-on-surface-variant uppercase tracking-widest\">Progression</span>
            <span class=\"text-xs font-bold text-primary\" x-text=\"answered + ' / {{ questions|length }}'\"></span>
        </div>
        <div class=\"h-2 bg-gray-100 rounded-full overflow-hidden\">
            <div class=\"h-full rounded-full transition-all duration-500\"
                 style=\"background: linear-gradient(90deg, #6366f1, #4f46e5);\"
                 :style=\"'width: ' + (answered / {{ questions|length }} * 100) + '%'\"></div>
        </div>
    </div>

    <h1 class=\"text-2xl font-extrabold font-headline tracking-tight text-on-surface mb-2\">{{ test.titre }}</h1>
    <p class=\"text-sm text-on-surface-variant mb-10\">Répondez honnêtement à chaque question.</p>

    <style>
        /* Option par défaut */
        .answer-option {
            border: 1.5px solid rgba(0,0,0,0.08);
            border-radius: 1rem;
            padding: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            color: #64748b;
            position: relative;
            overflow: hidden;
            user-select: none;
        }

        /* Hover */
        .answer-option:hover {
            border-color: rgba(79, 70, 229, 0.4);
            background: rgba(79, 70, 229, 0.04);
            transform: translateY(-1px);
        }

        /* Sélectionné — dégradé bleu */
        input[type=\"radio\"]:checked + .answer-option {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #3730a3 100%);
            border-color: transparent;
            color: white;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 8px 24px -4px rgba(79, 70, 229, 0.45),
                        0 4px 10px -2px rgba(79, 70, 229, 0.3);
        }

        /* Ripple animation au clic */
        .answer-option::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(255,255,255,0.35) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        input[type=\"radio\"]:checked + .answer-option::after {
            opacity: 1;
        }

        /* Animation pulse sur la carte question quand répondue */
        .question-card.answered {
            border-color: rgba(79, 70, 229, 0.25);
            background: linear-gradient(135deg, #ffffff 0%, rgba(238, 242, 255, 0.4) 100%);
        }

        /* Numéro de question animé */
        .question-number {
            transition: color 0.3s ease;
        }
        .question-card.answered .question-number {
            color: #4f46e5;
        }
    </style>

    <form method=\"post\" @submit=\"checkAll(\$event)\">
        <div class=\"space-y-6\">
            {% for q in questions %}
            <div class=\"question-card bg-white rounded-[2.5rem] p-8 shadow-sm border border-outline/20 transition-all duration-500\"
                 id=\"q{{ q.idQuestion }}\">
                <p class=\"text-base font-bold text-on-surface mb-6\">
                    <span class=\"question-number text-primary font-extrabold\">{{ loop.index }}.</span> {{ q.contenu }}
                </p>
                <div class=\"grid grid-cols-4 gap-3\">
                    {% for val, label in {1: 'Jamais', 2: 'Parfois', 3: 'Souvent', 4: 'Toujours'} %}
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\"
                               name=\"reponses[{{ q.idQuestion }}]\"
                               value=\"{{ val }}\"
                               class=\"sr-only\"
                               @change=\"markAnswered('{{ q.idQuestion }}')\">
                        <div class=\"answer-option\">
                            <div class=\"text-lg font-extrabold mb-1\">{{ val }}</div>
                            <div class=\"text-[9px] uppercase tracking-wider font-bold\">{{ label }}</div>
                        </div>
                    </label>
                    {% endfor %}
                </div>
            </div>
            {% endfor %}
        </div>

        <div class=\"mt-10\">
            <button type=\"submit\"
                    class=\"w-full py-4 text-base font-bold text-white rounded-2xl transition-all active:scale-95 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed\"
                    style=\"background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); box-shadow: 0 8px 24px -4px rgba(79,70,229,0.35);\">
                Soumettre mes réponses
            </button>
        </div>
    </form>
</div>

<script>
function testPsy() {
    return {
        answered: 0,
        answeredIds: new Set(),
        markAnswered(id) {
            // Colorer la carte question
            const card = document.getElementById('q' + id);
            if (card) card.classList.add('answered');

            if (!this.answeredIds.has(id)) {
                this.answeredIds.add(id);
                this.answered++;
            }
        },
        checkAll(e) {
            if (this.answered < {{ questions|length }}) {
                e.preventDefault();
                alert('Veuillez répondre à toutes les questions avant de soumettre.');
            }
        }
    }
}
</script>
{% endblock %}
", "pages/testpsy/passer.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\testpsy\\passer.html.twig");
    }
}
