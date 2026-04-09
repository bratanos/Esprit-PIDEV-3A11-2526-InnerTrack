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

/* article/_form.html.twig */
class __TwigTemplate_06c910999bc1267cd2223795de20c42a extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/_form.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/_form.html.twig"));

        // line 1
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 1, $this->source); })()), 'form_start', ["attr" => ["class" => "space-y-5", "novalidate" => "novalidate"]]);
        yield "

    ";
        // line 4
        yield "    <div>
        ";
        // line 5
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 5, $this->source); })()), "titre", [], "any", false, false, false, 5), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-on-surface mb-1.5"], "label" => "Title"]);
        yield "
        ";
        // line 6
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 6, $this->source); })()), "titre", [], "any", false, false, false, 6), 'widget', ["attr" => ["class" => "w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm text-on-surface placeholder:text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/50 transition", "placeholder" => "Article title…"]]);
        // line 9
        yield "
        ";
        // line 10
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 10, $this->source); })()), "titre", [], "any", false, false, false, 10), 'errors');
        yield "
    </div>

    ";
        // line 14
        yield "    <div>
        ";
        // line 15
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 15, $this->source); })()), "contenu", [], "any", false, false, false, 15), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-on-surface mb-1.5"], "label" => "Content"]);
        yield "
        ";
        // line 16
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 16, $this->source); })()), "contenu", [], "any", false, false, false, 16), 'widget', ["attr" => ["class" => "w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm text-on-surface placeholder:text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/50 transition resize-none", "rows" => 8, "placeholder" => "Write your article here…"]]);
        // line 20
        yield "
        ";
        // line 21
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 21, $this->source); })()), "contenu", [], "any", false, false, false, 21), 'errors');
        yield "
    </div>

    ";
        // line 25
        yield "    <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-4\">
        <div>
            ";
        // line 27
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 27, $this->source); })()), "datePublication", [], "any", false, false, false, 27), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-on-surface mb-1.5"], "label" => "Publication date"]);
        yield "
            ";
        // line 28
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), "datePublication", [], "any", false, false, false, 28), 'widget', ["attr" => ["class" => "w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/50 transition"]]);
        // line 30
        yield "
            ";
        // line 31
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), "datePublication", [], "any", false, false, false, 31), 'errors');
        yield "
        </div>
        <div>
            ";
        // line 34
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 34, $this->source); })()), "categorie", [], "any", false, false, false, 34), 'label', ["label_attr" => ["class" => "block text-sm font-semibold text-on-surface mb-1.5"], "label" => "Category"]);
        yield "
            ";
        // line 35
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 35, $this->source); })()), "categorie", [], "any", false, false, false, 35), 'widget', ["attr" => ["class" => "w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/50 transition"]]);
        // line 37
        yield "
            ";
        // line 38
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "categorie", [], "any", false, false, false, 38), 'errors');
        yield "
        </div>
    </div>

    ";
        // line 43
        yield "    <div class=\"pt-2\">
        <button type=\"submit\"
                class=\"flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
            <span class=\"material-symbols-outlined text-[18px]\">save</span>
            ";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("button_label", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["button_label"]) || array_key_exists("button_label", $context) ? $context["button_label"] : (function () { throw new RuntimeError('Variable "button_label" does not exist.', 47, $this->source); })()), "Save")) : ("Save")), "html", null, true);
        yield "
        </button>
    </div>

";
        // line 51
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), 'form_end');
        yield "
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "article/_form.html.twig";
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
        return array (  137 => 51,  130 => 47,  124 => 43,  117 => 38,  114 => 37,  112 => 35,  108 => 34,  102 => 31,  99 => 30,  97 => 28,  93 => 27,  89 => 25,  83 => 21,  80 => 20,  78 => 16,  74 => 15,  71 => 14,  65 => 10,  62 => 9,  60 => 6,  56 => 5,  53 => 4,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{{ form_start(form, {attr: {class: 'space-y-5', novalidate: 'novalidate'}}) }}

    {# Title #}
    <div>
        {{ form_label(form.titre, 'Title', {label_attr: {class: 'block text-sm font-semibold text-on-surface mb-1.5'}}) }}
        {{ form_widget(form.titre, {attr: {
            class: 'w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm text-on-surface placeholder:text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/50 transition',
            placeholder: 'Article title…'
        }}) }}
        {{ form_errors(form.titre) }}
    </div>

    {# Content #}
    <div>
        {{ form_label(form.contenu, 'Content', {label_attr: {class: 'block text-sm font-semibold text-on-surface mb-1.5'}}) }}
        {{ form_widget(form.contenu, {attr: {
            class: 'w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm text-on-surface placeholder:text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/50 transition resize-none',
            rows: 8,
            placeholder: 'Write your article here…'
        }}) }}
        {{ form_errors(form.contenu) }}
    </div>

    {# Date + Category side by side #}
    <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-4\">
        <div>
            {{ form_label(form.datePublication, 'Publication date', {label_attr: {class: 'block text-sm font-semibold text-on-surface mb-1.5'}}) }}
            {{ form_widget(form.datePublication, {attr: {
                class: 'w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/50 transition'
            }}) }}
            {{ form_errors(form.datePublication) }}
        </div>
        <div>
            {{ form_label(form.categorie, 'Category', {label_attr: {class: 'block text-sm font-semibold text-on-surface mb-1.5'}}) }}
            {{ form_widget(form.categorie, {attr: {
                class: 'w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/50 transition'
            }}) }}
            {{ form_errors(form.categorie) }}
        </div>
    </div>

    {# Submit #}
    <div class=\"pt-2\">
        <button type=\"submit\"
                class=\"flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
            <span class=\"material-symbols-outlined text-[18px]\">save</span>
            {{ button_label|default('Save') }}
        </button>
    </div>

{{ form_end(form) }}
", "article/_form.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\article\\_form.html.twig");
    }
}
