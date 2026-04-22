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

/* pages/community/index.html.twig */
class __TwigTemplate_4e98bd803646d33b984d6a2b7be900e2 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/community/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/community/index.html.twig"));

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
            <!--<span class=\"material-icons\">forum</span>-->
            Community Forum
        </h1>
    </div>

    ";
        // line 16
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "user", [], "any", false, false, false, 16)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 17
            yield "    <form method=\"post\" class=\"quick-post-form\">
        <input type=\"hidden\" name=\"quick_post\" value=\"1\">
        <input type=\"text\" name=\"title\" class=\"quick-post-title\" placeholder=\"Title (optional)\">
        <div class=\"quick-post-row\">
            <div class=\"thread-avatar\">
                ";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 22, $this->source); })()), "user", [], "any", false, false, false, 22), "firstName", [], "any", false, false, false, 22))), "html", null, true);
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 22, $this->source); })()), "user", [], "any", false, false, false, 22), "lastName", [], "any", false, false, false, 22))), "html", null, true);
            yield "
            </div>
            <input type=\"text\" name=\"content\" class=\"quick-post-input\"
                   placeholder=\"Share something with the community...\"
                   required
                   onkeydown=\"if(event.key==='Enter'){event.preventDefault();this.closest('form').submit();}\">
            <button type=\"submit\" class=\"send-btn\">
                <span class=\"material-icons\">send</span>
                Post
            </button>
        </div>
    </form>
    ";
        }
        // line 35
        yield "
    <div class=\"threads-list\">
        ";
        // line 37
        $context["emojis"] = ["👍", "❤️", "😂", "😮", "😢", "😡"];
        // line 38
        yield "
        ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 39, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 40
            yield "            ";
            $context["allReplies"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["replies_map"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 40), [], "array", true, true, false, 40) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["replies_map"]) || array_key_exists("replies_map", $context) ? $context["replies_map"] : (function () { throw new RuntimeError('Variable "replies_map" does not exist.', 40, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 40), [], "array", false, false, false, 40)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["replies_map"]) || array_key_exists("replies_map", $context) ? $context["replies_map"] : (function () { throw new RuntimeError('Variable "replies_map" does not exist.', 40, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 40), [], "array", false, false, false, 40)) : ([]));
            // line 41
            yield "
            <div class=\"thread-card\">
                <div class=\"thread-meta\">
                    <div class=\"thread-avatar\">
                        ";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["post"], "user", [], "any", false, false, false, 45), "firstName", [], "any", false, false, false, 45))), "html", null, true);
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["post"], "user", [], "any", false, false, false, 45), "lastName", [], "any", false, false, false, 45))), "html", null, true);
            yield "
                    </div>
                    <div class=\"thread-info\">
                        <span class=\"thread-author\">";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["post"], "user", [], "any", false, false, false, 48), "firstName", [], "any", false, false, false, 48), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["post"], "user", [], "any", false, false, false, 48), "lastName", [], "any", false, false, false, 48), "html", null, true);
            yield "</span>
                        <span class=\"thread-date\">
                            ";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "createdAt", [], "any", false, false, false, 50), "M d, Y · H:i"), "html", null, true);
            yield "
                            ";
            // line 51
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["post"], "modified", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<em class=\"thread-edited\">· edited</em>";
            }
            // line 52
            yield "                        </span>
                    </div>
                    ";
            // line 54
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 54, $this->source); })()), "user", [], "any", false, false, false, 54) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 54, $this->source); })()), "user", [], "any", false, false, false, 54), "id", [], "any", false, false, false, 54) == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["post"], "user", [], "any", false, false, false, 54), "id", [], "any", false, false, false, 54)))) {
                // line 55
                yield "                    <div class=\"owner-actions\">
                        <a href=\"";
                // line 56
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_community_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 56)]), "html", null, true);
                yield "\" class=\"action-btn\">
                            <span class=\"material-icons\">edit</span>
                        </a>
                        <form method=\"post\" action=\"";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_community_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 59)]), "html", null, true);
                yield "\" style=\"display:inline\" onsubmit=\"return confirm('Delete this post?')\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
                // line 60
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 60))), "html", null, true);
                yield "\">
                            <button type=\"submit\" class=\"action-btn action-btn--delete\">
                                <span class=\"material-icons\">delete</span>
                            </button>
                        </form>
                    </div>
                    ";
            }
            // line 67
            yield "                </div>

                ";
            // line 69
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 69)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<h2 class=\"thread-title\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 69), "html", null, true);
                yield "</h2>";
            }
            // line 70
            yield "                <p class=\"thread-content\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "content", [], "any", false, false, false, 70), "html", null, true);
            yield "</p>

                ";
            // line 73
            yield "                ";
            $context["counts"] = CoreExtension::getAttribute($this->env, $this->source, $context["post"], "reactionCounts", [], "any", false, false, false, 73);
            // line 74
            yield "                ";
            $context["myReaction"] = (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 74, $this->source); })()), "user", [], "any", false, false, false, 74)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, $context["post"], "getUserReaction", [CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 74, $this->source); })()), "user", [], "any", false, false, false, 74), "id", [], "any", false, false, false, 74)], "method", false, false, false, 74)) : (null));
            // line 75
            yield "                <div class=\"reaction-bar\">
                    ";
            // line 76
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["counts"]) || array_key_exists("counts", $context) ? $context["counts"] : (function () { throw new RuntimeError('Variable "counts" does not exist.', 76, $this->source); })()));
            foreach ($context['_seq'] as $context["emoji"] => $context["count"]) {
                // line 77
                yield "                    <form method=\"post\" class=\"reaction-form\">
                        <input type=\"hidden\" name=\"react\" value=\"1\">
                        <input type=\"hidden\" name=\"comment_id\" value=\"";
                // line 79
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 79), "html", null, true);
                yield "\">
                        <input type=\"hidden\" name=\"emoji\" value=\"";
                // line 80
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                yield "\">
                        <button type=\"submit\" class=\"reaction-pill ";
                // line 81
                yield ((((isset($context["myReaction"]) || array_key_exists("myReaction", $context) ? $context["myReaction"] : (function () { throw new RuntimeError('Variable "myReaction" does not exist.', 81, $this->source); })()) == $context["emoji"])) ? ("reaction-pill--mine") : (""));
                yield "\">
                            ";
                // line 82
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                yield " <span class=\"reaction-count\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["count"], "html", null, true);
                yield "</span>
                        </button>
                    </form>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['emoji'], $context['count'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 86
            yield "                    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 86, $this->source); })()), "user", [], "any", false, false, false, 86)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 87
                yield "                    <div class=\"emoji-picker-wrap\">
                        <button type=\"button\" class=\"reaction-add-btn\" onclick=\"togglePicker(this)\">
                            <span class=\"material-icons\">react</span>
                        </button>
                        <div class=\"emoji-picker\">
                            ";
                // line 92
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable((isset($context["emojis"]) || array_key_exists("emojis", $context) ? $context["emojis"] : (function () { throw new RuntimeError('Variable "emojis" does not exist.', 92, $this->source); })()));
                foreach ($context['_seq'] as $context["_key"] => $context["emoji"]) {
                    // line 93
                    yield "                            <form method=\"post\" class=\"reaction-form\">
                                <input type=\"hidden\" name=\"react\" value=\"1\">
                                <input type=\"hidden\" name=\"comment_id\" value=\"";
                    // line 95
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 95), "html", null, true);
                    yield "\">
                                <input type=\"hidden\" name=\"emoji\" value=\"";
                    // line 96
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                    yield "\">
                                <button type=\"submit\" class=\"emoji-option ";
                    // line 97
                    yield ((((isset($context["myReaction"]) || array_key_exists("myReaction", $context) ? $context["myReaction"] : (function () { throw new RuntimeError('Variable "myReaction" does not exist.', 97, $this->source); })()) == $context["emoji"])) ? ("emoji-option--active") : (""));
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                    yield "</button>
                            </form>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['emoji'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 100
                yield "                        </div>
                    </div>
                    ";
            }
            // line 103
            yield "                </div>

                ";
            // line 106
            yield "                ";
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["allReplies"]) || array_key_exists("allReplies", $context) ? $context["allReplies"] : (function () { throw new RuntimeError('Variable "allReplies" does not exist.', 106, $this->source); })())) > 0)) {
                // line 107
                yield "                <div class=\"replies-list\">
                    ";
                // line 108
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable((isset($context["allReplies"]) || array_key_exists("allReplies", $context) ? $context["allReplies"] : (function () { throw new RuntimeError('Variable "allReplies" does not exist.', 108, $this->source); })()));
                foreach ($context['_seq'] as $context["_key"] => $context["reply"]) {
                    // line 109
                    yield "                        ";
                    $context["isNested"] = (CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "parent", [], "any", false, false, false, 109) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "parent", [], "any", false, false, false, 109), "id", [], "any", false, false, false, 109) != CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 109)));
                    // line 110
                    yield "                        <div class=\"reply-card\" style=\"margin-left: ";
                    yield (((($tmp = (isset($context["isNested"]) || array_key_exists("isNested", $context) ? $context["isNested"] : (function () { throw new RuntimeError('Variable "isNested" does not exist.', 110, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("20px") : ("0"));
                    yield "\">
                            <div class=\"reply-line\"></div>
                            <div class=\"reply-body\">
                                <div class=\"thread-meta\">
                                    <div class=\"thread-avatar thread-avatar--sm\">
                                        ";
                    // line 115
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "user", [], "any", false, false, false, 115), "firstName", [], "any", false, false, false, 115))), "html", null, true);
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "user", [], "any", false, false, false, 115), "lastName", [], "any", false, false, false, 115))), "html", null, true);
                    yield "
                                    </div>
                                    <div class=\"thread-info\">
                                        <span class=\"thread-author\">";
                    // line 118
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "user", [], "any", false, false, false, 118), "firstName", [], "any", false, false, false, 118), "html", null, true);
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "user", [], "any", false, false, false, 118), "lastName", [], "any", false, false, false, 118), "html", null, true);
                    yield "</span>
                                        <span class=\"thread-date\">
                                            ";
                    // line 120
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "createdAt", [], "any", false, false, false, 120), "M d, Y · H:i"), "html", null, true);
                    yield "
                                            ";
                    // line 121
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "modified", [], "any", false, false, false, 121)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield "<em class=\"thread-edited\">· edited</em>";
                    }
                    // line 122
                    yield "                                        </span>
                                    </div>
                                    ";
                    // line 124
                    if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 124, $this->source); })()), "user", [], "any", false, false, false, 124) && (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 124, $this->source); })()), "user", [], "any", false, false, false, 124), "id", [], "any", false, false, false, 124) == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "user", [], "any", false, false, false, 124), "id", [], "any", false, false, false, 124)))) {
                        // line 125
                        yield "                                    <div class=\"owner-actions\">
                                        <a href=\"";
                        // line 126
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_community_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 126)]), "html", null, true);
                        yield "\" class=\"action-btn\">
                                            <span class=\"material-icons\">edit</span>
                                        </a>
                                        <form method=\"post\" action=\"";
                        // line 129
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_community_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 129)]), "html", null, true);
                        yield "\" style=\"display:inline\" onsubmit=\"return confirm('Delete?')\">
                                            <input type=\"hidden\" name=\"_token\" value=\"";
                        // line 130
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 130))), "html", null, true);
                        yield "\">
                                            <button type=\"submit\" class=\"action-btn action-btn--delete\">
                                                <span class=\"material-icons\">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                    ";
                    }
                    // line 137
                    yield "                                </div>
                                <p class=\"thread-content\">";
                    // line 138
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "content", [], "any", false, false, false, 138), "html", null, true);
                    yield "</p>

                                ";
                    // line 141
                    yield "                                ";
                    $context["rCounts"] = CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "reactionCounts", [], "any", false, false, false, 141);
                    // line 142
                    yield "                                ";
                    $context["myRReaction"] = (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 142, $this->source); })()), "user", [], "any", false, false, false, 142)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "getUserReaction", [CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 142, $this->source); })()), "user", [], "any", false, false, false, 142), "id", [], "any", false, false, false, 142)], "method", false, false, false, 142)) : (null));
                    // line 143
                    yield "                                <div class=\"reaction-bar\">
                                    ";
                    // line 144
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable((isset($context["rCounts"]) || array_key_exists("rCounts", $context) ? $context["rCounts"] : (function () { throw new RuntimeError('Variable "rCounts" does not exist.', 144, $this->source); })()));
                    foreach ($context['_seq'] as $context["emoji"] => $context["count"]) {
                        // line 145
                        yield "                                    <form method=\"post\" class=\"reaction-form\">
                                        <input type=\"hidden\" name=\"react\" value=\"1\">
                                        <input type=\"hidden\" name=\"comment_id\" value=\"";
                        // line 147
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 147), "html", null, true);
                        yield "\">
                                        <input type=\"hidden\" name=\"emoji\" value=\"";
                        // line 148
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                        yield "\">
                                        <button type=\"submit\" class=\"reaction-pill ";
                        // line 149
                        yield ((((isset($context["myRReaction"]) || array_key_exists("myRReaction", $context) ? $context["myRReaction"] : (function () { throw new RuntimeError('Variable "myRReaction" does not exist.', 149, $this->source); })()) == $context["emoji"])) ? ("reaction-pill--mine") : (""));
                        yield "\">
                                            ";
                        // line 150
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                        yield " <span class=\"reaction-count\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["count"], "html", null, true);
                        yield "</span>
                                        </button>
                                    </form>
                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['emoji'], $context['count'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 154
                    yield "                                    ";
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 154, $this->source); })()), "user", [], "any", false, false, false, 154)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 155
                        yield "                                    <div class=\"emoji-picker-wrap\">
                                        <button type=\"button\" class=\"reaction-add-btn\" onclick=\"togglePicker(this)\">
                                            <span class=\"material-icons\">react</span>
                                        </button>
                                        <div class=\"emoji-picker\">
                                            ";
                        // line 160
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["emojis"]) || array_key_exists("emojis", $context) ? $context["emojis"] : (function () { throw new RuntimeError('Variable "emojis" does not exist.', 160, $this->source); })()));
                        foreach ($context['_seq'] as $context["_key"] => $context["emoji"]) {
                            // line 161
                            yield "                                            <form method=\"post\" class=\"reaction-form\">
                                                <input type=\"hidden\" name=\"react\" value=\"1\">
                                                <input type=\"hidden\" name=\"comment_id\" value=\"";
                            // line 163
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 163), "html", null, true);
                            yield "\">
                                                <input type=\"hidden\" name=\"emoji\" value=\"";
                            // line 164
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                            yield "\">
                                                <button type=\"submit\" class=\"emoji-option ";
                            // line 165
                            yield ((((isset($context["myRReaction"]) || array_key_exists("myRReaction", $context) ? $context["myRReaction"] : (function () { throw new RuntimeError('Variable "myRReaction" does not exist.', 165, $this->source); })()) == $context["emoji"])) ? ("emoji-option--active") : (""));
                            yield "\">";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["emoji"], "html", null, true);
                            yield "</button>
                                            </form>
                                            ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_key'], $context['emoji'], $context['_parent']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 168
                        yield "                                        </div>
                                    </div>
                                    ";
                    }
                    // line 171
                    yield "                                </div>

                                ";
                    // line 173
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 173, $this->source); })()), "user", [], "any", false, false, false, 173)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 174
                        yield "                                <form method=\"post\" class=\"quick-reply-form\">
                                    <input type=\"hidden\" name=\"quick_post\" value=\"1\">
                                    <input type=\"hidden\" name=\"parent_id\" value=\"";
                        // line 176
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "id", [], "any", false, false, false, 176), "html", null, true);
                        yield "\">
                                    <div class=\"quick-post-row\">
                                        <div class=\"thread-avatar thread-avatar--sm\">
                                            ";
                        // line 179
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 179, $this->source); })()), "user", [], "any", false, false, false, 179), "firstName", [], "any", false, false, false, 179))), "html", null, true);
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 179, $this->source); })()), "user", [], "any", false, false, false, 179), "lastName", [], "any", false, false, false, 179))), "html", null, true);
                        yield "
                                        </div>
                                        <input type=\"text\" name=\"content\" class=\"quick-post-input\"
                                               placeholder=\"Reply to ";
                        // line 182
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["reply"], "user", [], "any", false, false, false, 182), "firstName", [], "any", false, false, false, 182), "html", null, true);
                        yield "...\"
                                               onkeydown=\"if(event.key==='Enter'){event.preventDefault();this.closest('form').submit();}\">
                                        <button type=\"submit\" class=\"send-btn send-btn--sm\">
                                            <span class=\"material-icons\">send</span>
                                        </button>
                                    </div>
                                </form>
                                ";
                    }
                    // line 190
                    yield "                            </div>
                        </div>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['reply'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 193
                yield "                </div>
                ";
            }
            // line 195
            yield "
                ";
            // line 196
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 196, $this->source); })()), "user", [], "any", false, false, false, 196)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 197
                yield "                <form method=\"post\" class=\"quick-reply-form\">
                    <input type=\"hidden\" name=\"quick_post\" value=\"1\">
                    <input type=\"hidden\" name=\"parent_id\" value=\"";
                // line 199
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 199), "html", null, true);
                yield "\">
                    <div class=\"quick-post-row\">
                        <div class=\"thread-avatar thread-avatar--sm\">
                            ";
                // line 202
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 202, $this->source); })()), "user", [], "any", false, false, false, 202), "firstName", [], "any", false, false, false, 202))), "html", null, true);
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 202, $this->source); })()), "user", [], "any", false, false, false, 202), "lastName", [], "any", false, false, false, 202))), "html", null, true);
                yield "
                        </div>
                        <input type=\"text\" name=\"content\" class=\"quick-post-input\"
                               placeholder=\"Reply to ";
                // line 205
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["post"], "user", [], "any", false, false, false, 205), "firstName", [], "any", false, false, false, 205), "html", null, true);
                yield "...\"
                               onkeydown=\"if(event.key==='Enter'){event.preventDefault();this.closest('form').submit();}\">
                        <button type=\"submit\" class=\"send-btn send-btn--sm\">
                            <span class=\"material-icons\">send</span>
                        </button>
                    </div>
                </form>
                ";
            }
            // line 213
            yield "
            </div>
        ";
            $context['_iterated'] = true;
        }
        // line 215
        if (!$context['_iterated']) {
            // line 216
            yield "            <div class=\"empty-state\">
                <span class=\"material-icons\">forum</span>
                <p>No posts yet. Be the first to start a conversation!</p>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['post'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 221
        yield "    </div>
</div>

<style>
.community-wrapper { max-width: 780px; margin: 2rem auto; padding: 0 1rem; }
.community-header { display: flex; align-items: center; margin-bottom: 1.5rem; }
.community-title { display: flex; align-items: center; gap: 0.5rem; font-size: 1.5rem; font-weight: 700; margin: 0; }

.quick-post-form {
    background: var(--card-bg, #fff); border: 1px solid var(--border, #e5e7eb);
    border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem;
    display: flex; flex-direction: column; gap: 0.6rem;
}
.quick-post-title {
    border: none; border-bottom: 1px solid #e5e7eb; padding: 0.4rem 0;
    font-size: 0.9rem; font-weight: 600; outline: none; width: 100%; background: transparent;
}
.quick-post-row { display: flex; align-items: center; gap: 0.75rem; }
.quick-post-input { flex: 1; border: none; outline: none; font-size: 0.95rem; background: transparent; padding: 0.4rem 0; }

.send-btn {
    display: inline-flex; align-items: center; gap: 0.3rem;
    background: var(--primary, #6c63ff); color: #fff; border: none;
    border-radius: 8px; padding: 0.4rem 0.9rem; font-size: 0.85rem; font-weight: 600;
    cursor: pointer; white-space: nowrap; transition: opacity 0.2s; flex-shrink: 0;
}
.send-btn:hover { opacity: 0.85; }
.send-btn .material-icons { font-size: 1rem; }
.send-btn--sm { padding: 0.3rem 0.65rem; font-size: 0.8rem; }
.send-btn--sm .material-icons { font-size: 0.9rem; }

.thread-card {
    background: var(--card-bg, #fff); border: 1px solid var(--border, #e5e7eb);
    border-radius: 12px; padding: 1.25rem 1.5rem; margin-bottom: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: box-shadow 0.2s;
}
.thread-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }

.thread-meta { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.75rem; flex-wrap: wrap; }
.thread-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: var(--primary, #6c63ff); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; font-weight: 700; flex-shrink: 0;
}
.thread-avatar--sm { width: 28px; height: 28px; font-size: 0.65rem; }
.thread-info { display: flex; flex-direction: column; line-height: 1.3; flex: 1; }
.thread-author { font-weight: 600; font-size: 0.9rem; }
.thread-date { font-size: 0.75rem; color: #9ca3af; }
.thread-edited { font-size: 0.7rem; color: #9ca3af; font-style: italic; }

.owner-actions { display: flex; align-items: center; gap: 0.25rem; margin-left: auto; }
.action-btn {
    display: inline-flex; align-items: center; color: #6b7280; background: #f3f4f6;
    border: none; border-radius: 6px; padding: 0.25rem 0.5rem;
    cursor: pointer; text-decoration: none; transition: background 0.15s, color 0.15s;
}
.action-btn:hover { background: #e5e7eb; color: #111; }
.action-btn .material-icons { font-size: 1rem; }
.action-btn--delete:hover { background: #fee2e2; color: #dc2626; }

.thread-title { font-size: 1.1rem; font-weight: 700; margin: 0 0 0.4rem 0; }
.thread-content { font-size: 0.95rem; color: #374151; margin: 0 0 0.6rem 0; line-height: 1.6; }

.replies-list { margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #f3f4f6; display: flex; flex-direction: column; gap: 0.75rem; }
.reply-card { display: flex; gap: 0.75rem; }
.reply-line { width: 2px; background: #e5e7eb; border-radius: 2px; flex-shrink: 0; margin-left: 0.5rem; }
.reply-body { flex: 1; min-width: 0; }
.quick-reply-form { margin-top: 0.6rem; padding-top: 0.6rem; border-top: 1px solid #f3f4f6; }

.reaction-bar { display: flex; align-items: center; flex-wrap: wrap; gap: 0.35rem; margin-bottom: 0.6rem; }
.reaction-form { display: inline-flex; }
.reaction-pill {
    display: inline-flex; align-items: center; gap: 0.2rem;
    background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 999px;
    padding: 0.2rem 0.6rem; font-size: 0.85rem; cursor: pointer;
    transition: background 0.15s; line-height: 1;
}
.reaction-pill:hover { background: #e5e7eb; }
.reaction-pill--mine { background: #ede9fe; border-color: var(--primary, #6c63ff); color: var(--primary, #6c63ff); }
.reaction-count { font-size: 0.75rem; font-weight: 600; }

.emoji-picker-wrap { position: relative; }
.reaction-add-btn {
    background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 999px;
    padding: 0.2rem 0.5rem; cursor: pointer; display: inline-flex;
    align-items: center; transition: background 0.15s;
}
.reaction-add-btn:hover { background: #e5e7eb; }
.reaction-add-btn .material-icons { font-size: 1rem; color: #6b7280; }

.emoji-picker {
    display: none; position: absolute; bottom: calc(100% + 6px); left: 0;
    background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;
    padding: 0.4rem; box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    flex-direction: row; gap: 0.2rem; z-index: 100; white-space: nowrap;
}
.emoji-picker.open { display: flex; }
.emoji-option {
    background: none; border: 2px solid transparent; border-radius: 6px;
    font-size: 1.2rem; padding: 0.2rem 0.3rem; cursor: pointer;
    transition: background 0.1s, transform 0.1s; line-height: 1;
}
.emoji-option:hover { background: #f3f4f6; transform: scale(1.2); }
.emoji-option--active { border-color: var(--primary, #6c63ff); background: #ede9fe; }

.empty-state { text-align: center; padding: 3rem; color: #9ca3af; }
.empty-state .material-icons { font-size: 3rem; display: block; margin-bottom: 0.5rem; }
</style>

<script>
function togglePicker(btn) {
    const picker = btn.nextElementSibling;
    const isOpen = picker.classList.contains('open');
    document.querySelectorAll('.emoji-picker.open').forEach(p => p.classList.remove('open'));
    if (!isOpen) picker.classList.add('open');
}
document.addEventListener('click', function(e) {
    if (!e.target.closest('.emoji-picker-wrap')) {
        document.querySelectorAll('.emoji-picker.open').forEach(p => p.classList.remove('open'));
    }
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
        return "pages/community/index.html.twig";
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
        return array (  576 => 221,  566 => 216,  564 => 215,  558 => 213,  547 => 205,  540 => 202,  534 => 199,  530 => 197,  528 => 196,  525 => 195,  521 => 193,  513 => 190,  502 => 182,  495 => 179,  489 => 176,  485 => 174,  483 => 173,  479 => 171,  474 => 168,  463 => 165,  459 => 164,  455 => 163,  451 => 161,  447 => 160,  440 => 155,  437 => 154,  425 => 150,  421 => 149,  417 => 148,  413 => 147,  409 => 145,  405 => 144,  402 => 143,  399 => 142,  396 => 141,  391 => 138,  388 => 137,  378 => 130,  374 => 129,  368 => 126,  365 => 125,  363 => 124,  359 => 122,  355 => 121,  351 => 120,  344 => 118,  337 => 115,  328 => 110,  325 => 109,  321 => 108,  318 => 107,  315 => 106,  311 => 103,  306 => 100,  295 => 97,  291 => 96,  287 => 95,  283 => 93,  279 => 92,  272 => 87,  269 => 86,  257 => 82,  253 => 81,  249 => 80,  245 => 79,  241 => 77,  237 => 76,  234 => 75,  231 => 74,  228 => 73,  222 => 70,  216 => 69,  212 => 67,  202 => 60,  198 => 59,  192 => 56,  189 => 55,  187 => 54,  183 => 52,  179 => 51,  175 => 50,  168 => 48,  161 => 45,  155 => 41,  152 => 40,  147 => 39,  144 => 38,  142 => 37,  138 => 35,  121 => 22,  114 => 17,  112 => 16,  101 => 7,  88 => 6,  64 => 3,  41 => 1,);
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
            <!--<span class=\"material-icons\">forum</span>-->
            Community Forum
        </h1>
    </div>

    {% if app.user %}
    <form method=\"post\" class=\"quick-post-form\">
        <input type=\"hidden\" name=\"quick_post\" value=\"1\">
        <input type=\"text\" name=\"title\" class=\"quick-post-title\" placeholder=\"Title (optional)\">
        <div class=\"quick-post-row\">
            <div class=\"thread-avatar\">
                {{ app.user.firstName|first|upper }}{{ app.user.lastName|first|upper }}
            </div>
            <input type=\"text\" name=\"content\" class=\"quick-post-input\"
                   placeholder=\"Share something with the community...\"
                   required
                   onkeydown=\"if(event.key==='Enter'){event.preventDefault();this.closest('form').submit();}\">
            <button type=\"submit\" class=\"send-btn\">
                <span class=\"material-icons\">send</span>
                Post
            </button>
        </div>
    </form>
    {% endif %}

    <div class=\"threads-list\">
        {% set emojis = ['👍','❤️','😂','😮','😢','😡'] %}

        {% for post in posts %}
            {% set allReplies = replies_map[post.id] ?? [] %}

            <div class=\"thread-card\">
                <div class=\"thread-meta\">
                    <div class=\"thread-avatar\">
                        {{ post.user.firstName|first|upper }}{{ post.user.lastName|first|upper }}
                    </div>
                    <div class=\"thread-info\">
                        <span class=\"thread-author\">{{ post.user.firstName }} {{ post.user.lastName }}</span>
                        <span class=\"thread-date\">
                            {{ post.createdAt|date('M d, Y · H:i') }}
                            {% if post.modified %}<em class=\"thread-edited\">· edited</em>{% endif %}
                        </span>
                    </div>
                    {% if app.user and app.user.id == post.user.id %}
                    <div class=\"owner-actions\">
                        <a href=\"{{ path('app_community_edit', {'id': post.id}) }}\" class=\"action-btn\">
                            <span class=\"material-icons\">edit</span>
                        </a>
                        <form method=\"post\" action=\"{{ path('app_community_delete', {'id': post.id}) }}\" style=\"display:inline\" onsubmit=\"return confirm('Delete this post?')\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ post.id) }}\">
                            <button type=\"submit\" class=\"action-btn action-btn--delete\">
                                <span class=\"material-icons\">delete</span>
                            </button>
                        </form>
                    </div>
                    {% endif %}
                </div>

                {% if post.title %}<h2 class=\"thread-title\">{{ post.title }}</h2>{% endif %}
                <p class=\"thread-content\">{{ post.content }}</p>

                {# Reactions on post #}
                {% set counts = post.reactionCounts %}
                {% set myReaction = app.user ? post.getUserReaction(app.user.id) : null %}
                <div class=\"reaction-bar\">
                    {% for emoji, count in counts %}
                    <form method=\"post\" class=\"reaction-form\">
                        <input type=\"hidden\" name=\"react\" value=\"1\">
                        <input type=\"hidden\" name=\"comment_id\" value=\"{{ post.id }}\">
                        <input type=\"hidden\" name=\"emoji\" value=\"{{ emoji }}\">
                        <button type=\"submit\" class=\"reaction-pill {{ myReaction == emoji ? 'reaction-pill--mine' : '' }}\">
                            {{ emoji }} <span class=\"reaction-count\">{{ count }}</span>
                        </button>
                    </form>
                    {% endfor %}
                    {% if app.user %}
                    <div class=\"emoji-picker-wrap\">
                        <button type=\"button\" class=\"reaction-add-btn\" onclick=\"togglePicker(this)\">
                            <span class=\"material-icons\">react</span>
                        </button>
                        <div class=\"emoji-picker\">
                            {% for emoji in emojis %}
                            <form method=\"post\" class=\"reaction-form\">
                                <input type=\"hidden\" name=\"react\" value=\"1\">
                                <input type=\"hidden\" name=\"comment_id\" value=\"{{ post.id }}\">
                                <input type=\"hidden\" name=\"emoji\" value=\"{{ emoji }}\">
                                <button type=\"submit\" class=\"emoji-option {{ myReaction == emoji ? 'emoji-option--active' : '' }}\">{{ emoji }}</button>
                            </form>
                            {% endfor %}
                        </div>
                    </div>
                    {% endif %}
                </div>

                {# All nested replies #}
                {% if allReplies|length > 0 %}
                <div class=\"replies-list\">
                    {% for reply in allReplies %}
                        {% set isNested = reply.parent and reply.parent.id != post.id %}
                        <div class=\"reply-card\" style=\"margin-left: {{ isNested ? '20px' : '0' }}\">
                            <div class=\"reply-line\"></div>
                            <div class=\"reply-body\">
                                <div class=\"thread-meta\">
                                    <div class=\"thread-avatar thread-avatar--sm\">
                                        {{ reply.user.firstName|first|upper }}{{ reply.user.lastName|first|upper }}
                                    </div>
                                    <div class=\"thread-info\">
                                        <span class=\"thread-author\">{{ reply.user.firstName }} {{ reply.user.lastName }}</span>
                                        <span class=\"thread-date\">
                                            {{ reply.createdAt|date('M d, Y · H:i') }}
                                            {% if reply.modified %}<em class=\"thread-edited\">· edited</em>{% endif %}
                                        </span>
                                    </div>
                                    {% if app.user and app.user.id == reply.user.id %}
                                    <div class=\"owner-actions\">
                                        <a href=\"{{ path('app_community_edit', {'id': reply.id}) }}\" class=\"action-btn\">
                                            <span class=\"material-icons\">edit</span>
                                        </a>
                                        <form method=\"post\" action=\"{{ path('app_community_delete', {'id': reply.id}) }}\" style=\"display:inline\" onsubmit=\"return confirm('Delete?')\">
                                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ reply.id) }}\">
                                            <button type=\"submit\" class=\"action-btn action-btn--delete\">
                                                <span class=\"material-icons\">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                    {% endif %}
                                </div>
                                <p class=\"thread-content\">{{ reply.content }}</p>

                                {# Reactions on reply #}
                                {% set rCounts = reply.reactionCounts %}
                                {% set myRReaction = app.user ? reply.getUserReaction(app.user.id) : null %}
                                <div class=\"reaction-bar\">
                                    {% for emoji, count in rCounts %}
                                    <form method=\"post\" class=\"reaction-form\">
                                        <input type=\"hidden\" name=\"react\" value=\"1\">
                                        <input type=\"hidden\" name=\"comment_id\" value=\"{{ reply.id }}\">
                                        <input type=\"hidden\" name=\"emoji\" value=\"{{ emoji }}\">
                                        <button type=\"submit\" class=\"reaction-pill {{ myRReaction == emoji ? 'reaction-pill--mine' : '' }}\">
                                            {{ emoji }} <span class=\"reaction-count\">{{ count }}</span>
                                        </button>
                                    </form>
                                    {% endfor %}
                                    {% if app.user %}
                                    <div class=\"emoji-picker-wrap\">
                                        <button type=\"button\" class=\"reaction-add-btn\" onclick=\"togglePicker(this)\">
                                            <span class=\"material-icons\">react</span>
                                        </button>
                                        <div class=\"emoji-picker\">
                                            {% for emoji in emojis %}
                                            <form method=\"post\" class=\"reaction-form\">
                                                <input type=\"hidden\" name=\"react\" value=\"1\">
                                                <input type=\"hidden\" name=\"comment_id\" value=\"{{ reply.id }}\">
                                                <input type=\"hidden\" name=\"emoji\" value=\"{{ emoji }}\">
                                                <button type=\"submit\" class=\"emoji-option {{ myRReaction == emoji ? 'emoji-option--active' : '' }}\">{{ emoji }}</button>
                                            </form>
                                            {% endfor %}
                                        </div>
                                    </div>
                                    {% endif %}
                                </div>

                                {% if app.user %}
                                <form method=\"post\" class=\"quick-reply-form\">
                                    <input type=\"hidden\" name=\"quick_post\" value=\"1\">
                                    <input type=\"hidden\" name=\"parent_id\" value=\"{{ reply.id }}\">
                                    <div class=\"quick-post-row\">
                                        <div class=\"thread-avatar thread-avatar--sm\">
                                            {{ app.user.firstName|first|upper }}{{ app.user.lastName|first|upper }}
                                        </div>
                                        <input type=\"text\" name=\"content\" class=\"quick-post-input\"
                                               placeholder=\"Reply to {{ reply.user.firstName }}...\"
                                               onkeydown=\"if(event.key==='Enter'){event.preventDefault();this.closest('form').submit();}\">
                                        <button type=\"submit\" class=\"send-btn send-btn--sm\">
                                            <span class=\"material-icons\">send</span>
                                        </button>
                                    </div>
                                </form>
                                {% endif %}
                            </div>
                        </div>
                    {% endfor %}
                </div>
                {% endif %}

                {% if app.user %}
                <form method=\"post\" class=\"quick-reply-form\">
                    <input type=\"hidden\" name=\"quick_post\" value=\"1\">
                    <input type=\"hidden\" name=\"parent_id\" value=\"{{ post.id }}\">
                    <div class=\"quick-post-row\">
                        <div class=\"thread-avatar thread-avatar--sm\">
                            {{ app.user.firstName|first|upper }}{{ app.user.lastName|first|upper }}
                        </div>
                        <input type=\"text\" name=\"content\" class=\"quick-post-input\"
                               placeholder=\"Reply to {{ post.user.firstName }}...\"
                               onkeydown=\"if(event.key==='Enter'){event.preventDefault();this.closest('form').submit();}\">
                        <button type=\"submit\" class=\"send-btn send-btn--sm\">
                            <span class=\"material-icons\">send</span>
                        </button>
                    </div>
                </form>
                {% endif %}

            </div>
        {% else %}
            <div class=\"empty-state\">
                <span class=\"material-icons\">forum</span>
                <p>No posts yet. Be the first to start a conversation!</p>
            </div>
        {% endfor %}
    </div>
</div>

<style>
.community-wrapper { max-width: 780px; margin: 2rem auto; padding: 0 1rem; }
.community-header { display: flex; align-items: center; margin-bottom: 1.5rem; }
.community-title { display: flex; align-items: center; gap: 0.5rem; font-size: 1.5rem; font-weight: 700; margin: 0; }

.quick-post-form {
    background: var(--card-bg, #fff); border: 1px solid var(--border, #e5e7eb);
    border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem;
    display: flex; flex-direction: column; gap: 0.6rem;
}
.quick-post-title {
    border: none; border-bottom: 1px solid #e5e7eb; padding: 0.4rem 0;
    font-size: 0.9rem; font-weight: 600; outline: none; width: 100%; background: transparent;
}
.quick-post-row { display: flex; align-items: center; gap: 0.75rem; }
.quick-post-input { flex: 1; border: none; outline: none; font-size: 0.95rem; background: transparent; padding: 0.4rem 0; }

.send-btn {
    display: inline-flex; align-items: center; gap: 0.3rem;
    background: var(--primary, #6c63ff); color: #fff; border: none;
    border-radius: 8px; padding: 0.4rem 0.9rem; font-size: 0.85rem; font-weight: 600;
    cursor: pointer; white-space: nowrap; transition: opacity 0.2s; flex-shrink: 0;
}
.send-btn:hover { opacity: 0.85; }
.send-btn .material-icons { font-size: 1rem; }
.send-btn--sm { padding: 0.3rem 0.65rem; font-size: 0.8rem; }
.send-btn--sm .material-icons { font-size: 0.9rem; }

.thread-card {
    background: var(--card-bg, #fff); border: 1px solid var(--border, #e5e7eb);
    border-radius: 12px; padding: 1.25rem 1.5rem; margin-bottom: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: box-shadow 0.2s;
}
.thread-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }

.thread-meta { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.75rem; flex-wrap: wrap; }
.thread-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: var(--primary, #6c63ff); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; font-weight: 700; flex-shrink: 0;
}
.thread-avatar--sm { width: 28px; height: 28px; font-size: 0.65rem; }
.thread-info { display: flex; flex-direction: column; line-height: 1.3; flex: 1; }
.thread-author { font-weight: 600; font-size: 0.9rem; }
.thread-date { font-size: 0.75rem; color: #9ca3af; }
.thread-edited { font-size: 0.7rem; color: #9ca3af; font-style: italic; }

.owner-actions { display: flex; align-items: center; gap: 0.25rem; margin-left: auto; }
.action-btn {
    display: inline-flex; align-items: center; color: #6b7280; background: #f3f4f6;
    border: none; border-radius: 6px; padding: 0.25rem 0.5rem;
    cursor: pointer; text-decoration: none; transition: background 0.15s, color 0.15s;
}
.action-btn:hover { background: #e5e7eb; color: #111; }
.action-btn .material-icons { font-size: 1rem; }
.action-btn--delete:hover { background: #fee2e2; color: #dc2626; }

.thread-title { font-size: 1.1rem; font-weight: 700; margin: 0 0 0.4rem 0; }
.thread-content { font-size: 0.95rem; color: #374151; margin: 0 0 0.6rem 0; line-height: 1.6; }

.replies-list { margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #f3f4f6; display: flex; flex-direction: column; gap: 0.75rem; }
.reply-card { display: flex; gap: 0.75rem; }
.reply-line { width: 2px; background: #e5e7eb; border-radius: 2px; flex-shrink: 0; margin-left: 0.5rem; }
.reply-body { flex: 1; min-width: 0; }
.quick-reply-form { margin-top: 0.6rem; padding-top: 0.6rem; border-top: 1px solid #f3f4f6; }

.reaction-bar { display: flex; align-items: center; flex-wrap: wrap; gap: 0.35rem; margin-bottom: 0.6rem; }
.reaction-form { display: inline-flex; }
.reaction-pill {
    display: inline-flex; align-items: center; gap: 0.2rem;
    background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 999px;
    padding: 0.2rem 0.6rem; font-size: 0.85rem; cursor: pointer;
    transition: background 0.15s; line-height: 1;
}
.reaction-pill:hover { background: #e5e7eb; }
.reaction-pill--mine { background: #ede9fe; border-color: var(--primary, #6c63ff); color: var(--primary, #6c63ff); }
.reaction-count { font-size: 0.75rem; font-weight: 600; }

.emoji-picker-wrap { position: relative; }
.reaction-add-btn {
    background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 999px;
    padding: 0.2rem 0.5rem; cursor: pointer; display: inline-flex;
    align-items: center; transition: background 0.15s;
}
.reaction-add-btn:hover { background: #e5e7eb; }
.reaction-add-btn .material-icons { font-size: 1rem; color: #6b7280; }

.emoji-picker {
    display: none; position: absolute; bottom: calc(100% + 6px); left: 0;
    background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;
    padding: 0.4rem; box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    flex-direction: row; gap: 0.2rem; z-index: 100; white-space: nowrap;
}
.emoji-picker.open { display: flex; }
.emoji-option {
    background: none; border: 2px solid transparent; border-radius: 6px;
    font-size: 1.2rem; padding: 0.2rem 0.3rem; cursor: pointer;
    transition: background 0.1s, transform 0.1s; line-height: 1;
}
.emoji-option:hover { background: #f3f4f6; transform: scale(1.2); }
.emoji-option--active { border-color: var(--primary, #6c63ff); background: #ede9fe; }

.empty-state { text-align: center; padding: 3rem; color: #9ca3af; }
.empty-state .material-icons { font-size: 3rem; display: block; margin-bottom: 0.5rem; }
</style>

<script>
function togglePicker(btn) {
    const picker = btn.nextElementSibling;
    const isOpen = picker.classList.contains('open');
    document.querySelectorAll('.emoji-picker.open').forEach(p => p.classList.remove('open'));
    if (!isOpen) picker.classList.add('open');
}
document.addEventListener('click', function(e) {
    if (!e.target.closest('.emoji-picker-wrap')) {
        document.querySelectorAll('.emoji-picker.open').forEach(p => p.classList.remove('open'));
    }
});
</script>
{% endblock %}
", "pages/community/index.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\community\\index.html.twig");
    }
}
