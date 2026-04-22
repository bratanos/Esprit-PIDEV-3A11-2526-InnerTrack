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

/* pages/community/edit.html.twig */
class __TwigTemplate_d17b026c41d99eefb52f7ec8a9bd94cf extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/community/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/community/edit.html.twig"));

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

        yield "Forum
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 6
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

        // line 7
        yield "
<div class=\"community-wrapper\">
    <div class=\"community-header\">
        <h1 class=\"community-title\">
            <!--<span class=\"material-icons\">edit</span>-->
            Edit ";
        // line 12
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 12, $this->source); })()), "title", [], "any", false, false, false, 12)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Post") : ("Reply"));
        yield "
        </h1>
    </div>

    <div class=\"thread-card\">
        <form method=\"post\">
            ";
        // line 18
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 18, $this->source); })()), "parent", [], "any", false, false, false, 18)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 19
            yield "            <div class=\"edit-field\">
                <label class=\"edit-label\">Title <span class=\"edit-optional\">(optional)</span></label>
                <input type=\"text\" name=\"title\" class=\"edit-input\"
                       value=\"";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 22, $this->source); })()), "title", [], "any", false, false, false, 22), "html", null, true);
            yield "\"
                       placeholder=\"Post title...\">
            </div>
            ";
        }
        // line 26
        yield "
            <div class=\"edit-field\">
                <label class=\"edit-label\">Content</label>
                <textarea name=\"content\" class=\"edit-textarea\" required
                          placeholder=\"What's on your mind?\">";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 30, $this->source); })()), "content", [], "any", false, false, false, 30), "html", null, true);
        yield "</textarea>
            </div>

            <div class=\"edit-actions\">
                <a href=\"";
        // line 34
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_community_index");
        yield "\" class=\"btn-cancel\">Cancel</a>
                <button type=\"submit\" class=\"send-btn\">
                    <span class=\"material-icons\">save</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.community-wrapper { max-width: 780px; margin: 2rem auto; padding: 0 1rem; }
.community-header { display: flex; align-items: center; margin-bottom: 1.5rem; }
.community-title { display: flex; align-items: center; gap: 0.5rem; font-size: 1.5rem; font-weight: 700; margin: 0; }

.thread-card {
    background: var(--card-bg, #fff); border: 1px solid var(--border, #e5e7eb);
    border-radius: 12px; padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.edit-field { display: flex; flex-direction: column; gap: 0.4rem; margin-bottom: 1.25rem; }
.edit-label { font-size: 0.85rem; font-weight: 600; color: #374151; }
.edit-optional { font-weight: 400; color: #9ca3af; }
.edit-input {
    border: 1px solid #e5e7eb; border-radius: 8px; padding: 0.6rem 0.9rem;
    font-size: 1rem; outline: none; transition: border-color 0.2s; background: var(--card-bg, #fff);
}
.edit-input:focus { border-color: var(--primary, #6c63ff); }
.edit-textarea {
    border: 1px solid #e5e7eb; border-radius: 8px; padding: 0.6rem 0.9rem;
    font-size: 0.95rem; outline: none; min-height: 120px; resize: vertical;
    transition: border-color 0.2s; background: var(--card-bg, #fff);
    font-family: inherit; line-height: 1.6;
}
.edit-textarea:focus { border-color: var(--primary, #6c63ff); }
.edit-actions { display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; }
.btn-cancel {
    color: #6b7280; text-decoration: none; font-size: 0.9rem;
    padding: 0.4rem 0.9rem; border-radius: 8px; transition: background 0.15s;
}
.btn-cancel:hover { background: #f3f4f6; }
.send-btn {
    display: inline-flex; align-items: center; gap: 0.3rem;
    background: var(--primary, #6c63ff); color: #fff; border: none;
    border-radius: 8px; padding: 0.4rem 0.9rem; font-size: 0.85rem; font-weight: 600;
    cursor: pointer; transition: opacity 0.2s;
}
.send-btn:hover { opacity: 0.85; }
.send-btn .material-icons { font-size: 1rem; }
</style>
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
        return "pages/community/edit.html.twig";
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
        return array (  144 => 34,  137 => 30,  131 => 26,  124 => 22,  119 => 19,  117 => 18,  108 => 12,  101 => 7,  88 => 6,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Forum
{% endblock %}

{% block content %}

<div class=\"community-wrapper\">
    <div class=\"community-header\">
        <h1 class=\"community-title\">
            <!--<span class=\"material-icons\">edit</span>-->
            Edit {{ comment.title ? 'Post' : 'Reply' }}
        </h1>
    </div>

    <div class=\"thread-card\">
        <form method=\"post\">
            {% if not comment.parent %}
            <div class=\"edit-field\">
                <label class=\"edit-label\">Title <span class=\"edit-optional\">(optional)</span></label>
                <input type=\"text\" name=\"title\" class=\"edit-input\"
                       value=\"{{ comment.title }}\"
                       placeholder=\"Post title...\">
            </div>
            {% endif %}

            <div class=\"edit-field\">
                <label class=\"edit-label\">Content</label>
                <textarea name=\"content\" class=\"edit-textarea\" required
                          placeholder=\"What's on your mind?\">{{ comment.content }}</textarea>
            </div>

            <div class=\"edit-actions\">
                <a href=\"{{ path('app_community_index') }}\" class=\"btn-cancel\">Cancel</a>
                <button type=\"submit\" class=\"send-btn\">
                    <span class=\"material-icons\">save</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.community-wrapper { max-width: 780px; margin: 2rem auto; padding: 0 1rem; }
.community-header { display: flex; align-items: center; margin-bottom: 1.5rem; }
.community-title { display: flex; align-items: center; gap: 0.5rem; font-size: 1.5rem; font-weight: 700; margin: 0; }

.thread-card {
    background: var(--card-bg, #fff); border: 1px solid var(--border, #e5e7eb);
    border-radius: 12px; padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.edit-field { display: flex; flex-direction: column; gap: 0.4rem; margin-bottom: 1.25rem; }
.edit-label { font-size: 0.85rem; font-weight: 600; color: #374151; }
.edit-optional { font-weight: 400; color: #9ca3af; }
.edit-input {
    border: 1px solid #e5e7eb; border-radius: 8px; padding: 0.6rem 0.9rem;
    font-size: 1rem; outline: none; transition: border-color 0.2s; background: var(--card-bg, #fff);
}
.edit-input:focus { border-color: var(--primary, #6c63ff); }
.edit-textarea {
    border: 1px solid #e5e7eb; border-radius: 8px; padding: 0.6rem 0.9rem;
    font-size: 0.95rem; outline: none; min-height: 120px; resize: vertical;
    transition: border-color 0.2s; background: var(--card-bg, #fff);
    font-family: inherit; line-height: 1.6;
}
.edit-textarea:focus { border-color: var(--primary, #6c63ff); }
.edit-actions { display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; }
.btn-cancel {
    color: #6b7280; text-decoration: none; font-size: 0.9rem;
    padding: 0.4rem 0.9rem; border-radius: 8px; transition: background 0.15s;
}
.btn-cancel:hover { background: #f3f4f6; }
.send-btn {
    display: inline-flex; align-items: center; gap: 0.3rem;
    background: var(--primary, #6c63ff); color: #fff; border: none;
    border-radius: 8px; padding: 0.4rem 0.9rem; font-size: 0.85rem; font-weight: 600;
    cursor: pointer; transition: opacity 0.2s;
}
.send-btn:hover { opacity: 0.85; }
.send-btn .material-icons { font-size: 1rem; }
</style>
{% endblock %}
", "pages/community/edit.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\community\\edit.html.twig");
    }
}
