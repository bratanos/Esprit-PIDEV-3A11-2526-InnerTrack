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

/* article/show.html.twig */
class __TwigTemplate_d6d689f9cb2bf2db5087daec76ec7fb3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/show.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
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

        // line 4
        yield "<link href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined\" rel=\"stylesheet\" />
<style>
.material-symbols-outlined {
  font-family: 'Material Symbols Outlined' !important;
  font-weight: normal;
  font-style: normal;
  font-size: 20px;
  display: inline-block;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  white-space: nowrap;
  direction: ltr;
  -webkit-font-smoothing: antialiased;
  font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
}
</style>

";
        // line 27
        yield "<div id=\"reading-progress-bar\"
     style=\"position:fixed;top:0;left:0;height:3px;width:0%;z-index:9999;
            background:linear-gradient(90deg,#60a5fa,#3b82f6,#2563eb);
            border-radius:0 3px 3px 0;
            box-shadow:0 0 8px rgba(96,165,250,.5);
            transition:width .1s linear\"></div>

";
        // line 35
        yield "<div style=\"position:fixed;right:16px;top:50%;transform:translateY(-50%);
            z-index:50;display:flex;flex-direction:column;gap:8px\"
     id=\"float-toolbar\">
    ";
        // line 38
        $context["tools"] = [["fn" => "toggleTTS()", "icon" => "volume_up", "id" => "tts-icon", "tip" => "Read aloud"], ["fn" => "copyLink()", "icon" => "link", "id" => "copy-icon", "tip" => "Copy link"], ["fn" => "window.print()", "icon" => "print", "id" => "", "tip" => "Print"], ["fn" => "window.scrollTo({top:0,behavior:'smooth'})", "icon" => "arrow_upward", "id" => "", "tip" => "Top"]];
        // line 44
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["tools"]) || array_key_exists("tools", $context) ? $context["tools"] : (function () { throw new RuntimeError('Variable "tools" does not exist.', 44, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            // line 45
            yield "        <button onclick=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["t"], "fn", [], "any", false, false, false, 45), "html", null, true);
            yield "\" class=\"ftool\"
                style=\"width:38px;height:38px;border-radius:11px;
                       background:white;border:1px solid rgba(0,0,0,0.09);
                       display:flex;align-items:center;justify-content:center;
                       cursor:pointer;position:relative;
                       box-shadow:0 2px 8px rgba(0,0,0,0.07);
                       transition:all .2s;color:#64748b\">
            <span class=\"material-symbols-outlined\" style=\"font-size:17px\"
                  ";
            // line 53
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["t"], "id", [], "any", false, false, false, 53)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["t"], "id", [], "any", false, false, false, 53), "html", null, true);
                yield "\"";
            }
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["t"], "icon", [], "any", false, false, false, 53), "html", null, true);
            yield "</span>
            <span style=\"position:absolute;right:46px;background:#0d1b2a;color:white;
                         font-size:10px;font-weight:700;padding:3px 9px;border-radius:7px;
                         white-space:nowrap;opacity:0;pointer-events:none;transition:opacity .15s;
                         font-family:var(--sans)\" class=\"ftip\">";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["t"], "tip", [], "any", false, false, false, 57), "html", null, true);
            yield "</span>
        </button>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['t'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        yield "</div>

";
        // line 63
        yield "<div id=\"tts-bar\"
     style=\"position:fixed;bottom:0;left:0;right:0;z-index:50;
            background:linear-gradient(135deg,#0d1b2a,#1b2d40);
            color:white;padding:12px 24px;
            display:flex;align-items:center;gap:12px;
            transform:translateY(100%);transition:transform .3s;
            box-shadow:0 -4px 24px rgba(0,0,0,0.2)\">
    <span class=\"material-symbols-outlined\" style=\"font-size:18px;color:#60a5fa;animation:pulse 1.5s infinite\">graphic_eq</span>
    <span style=\"font-size:12px;font-weight:700;flex:1;color:rgba(255,255,255,0.8)\">Reading aloud…</span>
    <button onclick=\"pauseTTS()\" id=\"tts-pause-btn\"
            style=\"display:flex;align-items:center;gap:4px;
                   background:rgba(96,165,250,0.15);border:1px solid rgba(96,165,250,0.3);
                   color:#60a5fa;padding:6px 14px;border-radius:10px;
                   font-size:11px;font-weight:800;cursor:pointer;font-family:var(--sans);
                   transition:all .2s\">
        <span class=\"material-symbols-outlined\" style=\"font-size:13px\" id=\"tts-pause-icon\">pause</span>
        <span id=\"tts-pause-label\">Pause</span>
    </button>
    <button onclick=\"stopTTS()\"
            style=\"display:flex;align-items:center;gap:4px;
                   background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);
                   color:rgba(255,255,255,0.7);padding:6px 14px;border-radius:10px;
                   font-size:11px;font-weight:800;cursor:pointer;font-family:var(--sans);transition:all .2s\">
        <span class=\"material-symbols-outlined\" style=\"font-size:13px\">stop</span> Stop
    </button>
    <div style=\"display:flex;align-items:center;gap:8px\">
        <span style=\"font-size:10px;color:rgba(255,255,255,0.4)\">Speed</span>
        <input type=\"range\" min=\"0.5\" max=\"2\" step=\"0.25\" value=\"1\" id=\"tts-rate\"
               style=\"width:80px;accent-color:#60a5fa\" oninput=\"updateTTSRate(this.value)\">
        <span style=\"font-size:11px;font-weight:800;width:24px;color:#60a5fa\" id=\"tts-rate-label\">1×</span>
    </div>
</div>

";
        // line 97
        yield "<div id=\"mood-toast\"
     style=\"position:fixed;bottom:24px;left:50%;transform:translateX(-50%) scale(.95);z-index:50;
            background:white;border-radius:20px;
            box-shadow:0 12px 40px rgba(0,0,0,0.15);
            border:1.5px solid rgba(0,0,0,0.07);
            padding:16px 20px;display:flex;align-items:center;gap:14px;
            min-width:320px;opacity:0;pointer-events:none;
            transition:all .4s cubic-bezier(.4,0,.2,1)\">
    <span style=\"font-size:22px;flex-shrink:0\">🧠</span>
    <div style=\"flex:1;min-width:0\">
        <p style=\"font-size:11px;font-weight:800;color:#1e293b;margin:0 0 8px;
                   letter-spacing:.02em\">How are you feeling right now?</p>
        <div style=\"display:flex;flex-wrap:wrap;gap:5px\">
            ";
        // line 110
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable([["😌", "Calm"], ["😊", "Happy"], ["😔", "Sad"], ["😰", "Anxious"], ["😤", "Stressed"]]);
        foreach ($context['_seq'] as $context["_key"] => $context["mood"]) {
            // line 111
            yield "                <button onclick=\"saveMood('";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["mood"], 0, [], "array", false, false, false, 111), "html", null, true);
            yield "','";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["mood"], 1, [], "array", false, false, false, 111), "html", null, true);
            yield "')\"
                        style=\"font-size:11px;font-weight:700;padding:4px 10px;border-radius:30px;
                               border:1.5px solid #e2e8f0;background:white;cursor:pointer;
                               font-family:var(--sans);white-space:nowrap;transition:all .15s\"
                        class=\"mood-btn\">
                    ";
            // line 116
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["mood"], 0, [], "array", false, false, false, 116), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["mood"], 1, [], "array", false, false, false, 116), "html", null, true);
            yield "
                </button>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['mood'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 119
        yield "        </div>
    </div>
    <button onclick=\"dismissMood()\"
            style=\"background:none;border:none;cursor:pointer;color:#94a3b8;flex-shrink:0;
                   display:flex;padding:4px;border-radius:6px;transition:color .15s\">
        <span class=\"material-symbols-outlined\" style=\"font-size:17px\">close</span>
    </button>
</div>

";
        // line 131
        yield "<div id=\"show-page\" style=\"max-width:760px\">

    ";
        // line 134
        yield "    <nav style=\"display:flex;align-items:center;gap:6px;font-size:12px;
                color:#94a3b8;margin-bottom:20px;flex-wrap:wrap\"
         class=\"art-fade\" style=\"--d:.04s\">
        <a href=\"";
        // line 137
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "\"
           style=\"color:#94a3b8;text-decoration:none;font-weight:600;
                  transition:color .2s\" class=\"bc-link\">Articles</a>
        <span style=\"color:#e2e8f0\">›</span>
        ";
        // line 141
        if ((($tmp = (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 141, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 142
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 142, $this->source); })()), "id", [], "any", false, false, false, 142)]), "html", null, true);
            yield "\"
               style=\"color:#94a3b8;text-decoration:none;font-weight:600;
                      transition:color .2s;max-width:140px;overflow:hidden;
                      white-space:nowrap;text-overflow:ellipsis\" class=\"bc-link\">
                ";
            // line 146
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 146, $this->source); })()), "titre", [], "any", false, false, false, 146), "html", null, true);
            yield "
            </a>
            <span style=\"color:#e2e8f0\">›</span>
        ";
        }
        // line 150
        yield "        <span style=\"color:#475569;font-weight:700;overflow:hidden;white-space:nowrap;
                     text-overflow:ellipsis;max-width:260px\">";
        // line 151
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 151, $this->source); })()), "titre", [], "any", false, false, false, 151), "html", null, true);
        yield "</span>
    </nav>

    ";
        // line 155
        yield "    ";
        if ((((isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 155, $this->source); })()) && (isset($context["currentStep"]) || array_key_exists("currentStep", $context) ? $context["currentStep"] : (function () { throw new RuntimeError('Variable "currentStep" does not exist.', 155, $this->source); })())) && (isset($context["totalSteps"]) || array_key_exists("totalSteps", $context) ? $context["totalSteps"] : (function () { throw new RuntimeError('Variable "totalSteps" does not exist.', 155, $this->source); })()))) {
            // line 156
            yield "        <div style=\"background:white;border-radius:18px;border:1.5px solid rgba(0,0,0,0.07);
                    padding:16px 20px;margin-bottom:20px;
                    box-shadow:0 2px 10px rgba(0,0,0,0.05)\"
             class=\"art-fade\" data-d=\".08\">
            <div style=\"display:flex;align-items:center;justify-content:space-between;margin-bottom:8px\">
                <span style=\"font-size:11px;font-weight:800;color:#3b82f6;
                              display:flex;align-items:center;gap:4px\">
                    <span class=\"material-symbols-outlined\" style=\"font-size:13px\">route</span>
                    ";
            // line 164
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 164, $this->source); })()), "titre", [], "any", false, false, false, 164), "html", null, true);
            yield "
                </span>
                <span style=\"font-size:11px;font-weight:800;color:#94a3b8\">
                    ";
            // line 167
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["currentStep"]) || array_key_exists("currentStep", $context) ? $context["currentStep"] : (function () { throw new RuntimeError('Variable "currentStep" does not exist.', 167, $this->source); })()), "html", null, true);
            yield " / ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalSteps"]) || array_key_exists("totalSteps", $context) ? $context["totalSteps"] : (function () { throw new RuntimeError('Variable "totalSteps" does not exist.', 167, $this->source); })()), "html", null, true);
            yield "
                </span>
            </div>
            <div style=\"background:#f1f5f9;border-radius:99px;height:5px\">
                <div style=\"height:5px;border-radius:99px;
                            background:linear-gradient(90deg,#60a5fa,#3b82f6);
                            transition:width .7s cubic-bezier(.4,0,.2,1);
                            width:";
            // line 174
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((((isset($context["currentStep"]) || array_key_exists("currentStep", $context) ? $context["currentStep"] : (function () { throw new RuntimeError('Variable "currentStep" does not exist.', 174, $this->source); })()) / (isset($context["totalSteps"]) || array_key_exists("totalSteps", $context) ? $context["totalSteps"] : (function () { throw new RuntimeError('Variable "totalSteps" does not exist.', 174, $this->source); })())) * 100)), "html", null, true);
            yield "%\"></div>
            </div>
            <div style=\"display:flex;gap:6px;margin-top:10px;flex-wrap:wrap\">
                ";
            // line 177
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(1, (isset($context["totalSteps"]) || array_key_exists("totalSteps", $context) ? $context["totalSteps"] : (function () { throw new RuntimeError('Variable "totalSteps" does not exist.', 177, $this->source); })())));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 178
                yield "                    <div class=\"step-dot\" data-step=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                yield "\"
                         style=\"width:8px;height:8px;border-radius:50%;
                                background:#e2e8f0;transition:all .3s\"></div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 182
            yield "            </div>
        </div>
    ";
        }
        // line 185
        yield "
    ";
        // line 187
        yield "<div style=\"background:linear-gradient(135deg, #232d8d 0%, #131c74 55%, #11125e 100%);
            border-radius:28px;overflow:hidden;margin-bottom:16px;
            position:relative\"
     class=\"art-fade\" data-d=\".1\">

    ";
        // line 193
        yield "    <div style=\"position:absolute;inset:0;
                background-image:linear-gradient(rgba(96,165,250,0.08) 1px,transparent 1px),
                                 linear-gradient(90deg,rgba(96,165,250,0.08) 1px,transparent 1px);
                background-size:24px 24px;pointer-events:none\"></div>
    ";
        // line 198
        yield "    <div style=\"position:absolute;top:-60px;right:-40px;width:240px;height:240px;
                background:radial-gradient(circle,rgba(96,165,250,0.2) 0%,transparent 70%);
                border-radius:50%;pointer-events:none\"></div>
    <div style=\"position:absolute;bottom:-60px;left:20%;width:180px;height:180px;
                background:radial-gradient(circle,rgba(59,130,246,0.15) 0%,transparent 70%);
                border-radius:50%;pointer-events:none\"></div>

    <div style=\"padding:28px 28px 24px;position:relative\">

        ";
        // line 208
        yield "        <div style=\"display:flex;flex-wrap:wrap;align-items:center;gap:6px;margin-bottom:16px\">
            ";
        // line 209
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 209, $this->source); })()), "categorie", [], "any", false, false, false, 209)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 210
            yield "                <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index", ["categorie" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 210, $this->source); })()), "categorie", [], "any", false, false, false, 210), "id", [], "any", false, false, false, 210)]), "html", null, true);
            yield "\"
                   style=\"font-size:10px;font-weight:800;padding:3px 12px;border-radius:30px;
                          background:rgba(96,165,250,0.15);color:#60a5fa;
                          text-decoration:none;letter-spacing:.04em;
                          border:1px solid rgba(96,165,250,0.3);transition:all .2s\"
                   class=\"cat-chip\">
                    ";
            // line 216
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 216, $this->source); })()), "categorie", [], "any", false, false, false, 216), "nom", [], "any", false, false, false, 216), "html", null, true);
            yield "
                </a>
            ";
        }
        // line 219
        yield "            ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 219, $this->source); })()), "readability", [], "any", false, false, false, 219)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 220
            yield "                ";
            $context["rmap"] = ["Easy" => "rgba(34,197,94,.15)|#4ade80", "Medium" => "rgba(245,158,11,.15)|#fbbf24", "Advanced" => "rgba(239,68,68,.15)|#f87171"];
            // line 221
            yield "                ";
            $context["rp"] = Twig\Extension\CoreExtension::split($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, ($context["rmap"] ?? null), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 221, $this->source); })()), "readability", [], "any", false, false, false, 221), [], "array", true, true, false, 221)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rmap"]) || array_key_exists("rmap", $context) ? $context["rmap"] : (function () { throw new RuntimeError('Variable "rmap" does not exist.', 221, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 221, $this->source); })()), "readability", [], "any", false, false, false, 221), [], "array", false, false, false, 221), "rgba(255,255,255,.1)|rgba(255,255,255,.6)")) : ("rgba(255,255,255,.1)|rgba(255,255,255,.6)")), "|");
            // line 222
            yield "                <span style=\"font-size:10px;font-weight:800;padding:3px 12px;border-radius:30px;
                              background:";
            // line 223
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rp"]) || array_key_exists("rp", $context) ? $context["rp"] : (function () { throw new RuntimeError('Variable "rp" does not exist.', 223, $this->source); })()), 0, [], "array", false, false, false, 223), "html", null, true);
            yield ";color:";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rp"]) || array_key_exists("rp", $context) ? $context["rp"] : (function () { throw new RuntimeError('Variable "rp" does not exist.', 223, $this->source); })()), 1, [], "array", false, false, false, 223), "html", null, true);
            yield ";
                              border:1px solid ";
            // line 224
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rp"]) || array_key_exists("rp", $context) ? $context["rp"] : (function () { throw new RuntimeError('Variable "rp" does not exist.', 224, $this->source); })()), 1, [], "array", false, false, false, 224), "html", null, true);
            yield "33\">
                    ";
            // line 225
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 225, $this->source); })()), "readability", [], "any", false, false, false, 225), "html", null, true);
            yield "
                </span>
            ";
        }
        // line 228
        yield "            ";
        $context["wc"] = Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 228, $this->source); })()), "contenu", [], "any", false, false, false, 228)), " "));
        // line 229
        yield "            ";
        $context["rt"] = Twig\Extension\CoreExtension::round(((isset($context["wc"]) || array_key_exists("wc", $context) ? $context["wc"] : (function () { throw new RuntimeError('Variable "wc" does not exist.', 229, $this->source); })()) / 200), 0, "ceil");
        // line 230
        yield "            <span style=\"font-size:10px;font-weight:700;padding:3px 10px;border-radius:30px;
                          background:rgba(255,255,255,0.08);color:rgba(255,255,255,0.5);
                          display:flex;align-items:center;gap:4px\">
                <span class=\"material-symbols-outlined\" style=\"font-size:11px\">schedule</span>
                ";
        // line 234
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["rt"]) || array_key_exists("rt", $context) ? $context["rt"] : (function () { throw new RuntimeError('Variable "rt" does not exist.', 234, $this->source); })()), "html", null, true);
        yield " min read
            </span>
            <span id=\"completed-badge\"
                  style=\"display:none;font-size:10px;font-weight:800;padding:3px 10px;
                         border-radius:30px;background:rgba(34,197,94,0.2);
                         color:#4ade80;align-items:center;gap:3px;
                         border:1px solid rgba(74,222,128,0.3)\">
                <span class=\"material-symbols-outlined\" style=\"font-size:11px\">check_circle</span>
                Read
            </span>
            <span style=\"margin-left:auto;font-size:11px;color:rgba(255,255,255,0.35);
                          display:flex;align-items:center;gap:4px;font-weight:600\">
                <span class=\"material-symbols-outlined\" style=\"font-size:12px\">calendar_today</span>
                ";
        // line 247
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 247, $this->source); })()), "datePublication", [], "any", false, false, false, 247)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 247, $this->source); })()), "datePublication", [], "any", false, false, false, 247), "d/m/Y"), "html", null, true)) : ("—"));
        yield "
            </span>
        </div>

        ";
        // line 252
        yield "        <h1 id=\"article-title\"
            style=\"font-family:var(--serif);font-size:clamp(1.4rem,3.5vw,2rem);
                   font-weight:400;color:#f0f6ff;letter-spacing:-.01em;
                   line-height:1.2;margin:0 0 16px;font-style:italic\">
            ";
        // line 256
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 256, $this->source); })()), "titre", [], "any", false, false, false, 256), "html", null, true);
        yield "
        </h1>

        ";
        // line 260
        yield "        ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 260, $this->source); })()), "auteur", [], "any", false, false, false, 260)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 261
            yield "            <div style=\"display:flex;align-items:center;gap:8px\">
                <div style=\"width:28px;height:28px;border-radius:50%;
                            background:linear-gradient(135deg,rgba(96,165,250,0.3),rgba(96,165,250,0.1));
                            border:1px solid rgba(96,165,250,0.3);
                            display:flex;align-items:center;justify-content:center;
                            font-size:9px;font-weight:800;color:#60a5fa;flex-shrink:0;overflow:hidden\">
                    ";
            // line 267
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "auteur", [], "any", false, true, false, 267), "profilePictureUrl", [], "any", true, true, false, 267) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 267, $this->source); })()), "auteur", [], "any", false, false, false, 267), "profilePictureUrl", [], "any", false, false, false, 267))) {
                // line 268
                yield "                        <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 268, $this->source); })()), "auteur", [], "any", false, false, false, 268), "profilePictureUrl", [], "any", false, false, false, 268), "html", null, true);
                yield "\"
                             style=\"width:100%;height:100%;object-fit:cover\" alt=\"\">
                    ";
            } else {
                // line 271
                yield "                        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 271, $this->source); })()), "auteur", [], "any", false, false, false, 271), "firstName", [], "any", false, false, false, 271))), "html", null, true);
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 271, $this->source); })()), "auteur", [], "any", false, false, false, 271), "lastName", [], "any", false, false, false, 271))), "html", null, true);
                yield "
                    ";
            }
            // line 273
            yield "                </div>
                <span style=\"font-size:12px;color:rgba(240,246,255,0.5);font-weight:600\">
                    ";
            // line 275
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 275, $this->source); })()), "auteur", [], "any", false, false, false, 275), "firstName", [], "any", false, false, false, 275), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 275, $this->source); })()), "auteur", [], "any", false, false, false, 275), "lastName", [], "any", false, false, false, 275), "html", null, true);
            yield "
                </span>
            </div>
        ";
        }
        // line 279
        yield "    </div>

    ";
        // line 282
        yield "    ";
        if (((isset($context["ambientSound"]) || array_key_exists("ambientSound", $context) ? $context["ambientSound"] : (function () { throw new RuntimeError('Variable "ambientSound" does not exist.', 282, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["ambientSound"]) || array_key_exists("ambientSound", $context) ? $context["ambientSound"] : (function () { throw new RuntimeError('Variable "ambientSound" does not exist.', 282, $this->source); })()), "audio", [], "any", false, false, false, 282))) {
            // line 283
            yield "        <div style=\"margin:0 28px 24px;padding:12px 16px;
                    background:rgba(96,165,250,0.1);border-radius:14px;
                    border:1px solid rgba(96,165,250,0.25);
                    display:flex;align-items:center;gap:10px\">
            <span class=\"material-symbols-outlined\" style=\"font-size:18px;color:#60a5fa;flex-shrink:0\">
                music_note
            </span>
            <div style=\"flex:1;min-width:0\">
                <p style=\"font-size:9px;font-weight:800;color:#60a5fa;
                           text-transform:uppercase;letter-spacing:.1em;margin:0 0 4px\">
                    Focus Sounds · ";
            // line 293
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["ambientSound"] ?? null), "title", [], "any", true, true, false, 293)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ambientSound"]) || array_key_exists("ambientSound", $context) ? $context["ambientSound"] : (function () { throw new RuntimeError('Variable "ambientSound" does not exist.', 293, $this->source); })()), "title", [], "any", false, false, false, 293), "Ambient")) : ("Ambient")), "html", null, true);
            yield "
                </p>
                <audio controls style=\"width:100%;height:24px\">
                    <source src=\"";
            // line 296
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["ambientSound"]) || array_key_exists("ambientSound", $context) ? $context["ambientSound"] : (function () { throw new RuntimeError('Variable "ambientSound" does not exist.', 296, $this->source); })()), "audio", [], "any", false, false, false, 296), "html", null, true);
            yield "\" type=\"audio/mpeg\">
                </audio>
            </div>
        </div>
    ";
        }
        // line 301
        yield "</div>

    ";
        // line 304
        yield "    ";
        if ((($tmp = (isset($context["aiAnalysis"]) || array_key_exists("aiAnalysis", $context) ? $context["aiAnalysis"] : (function () { throw new RuntimeError('Variable "aiAnalysis" does not exist.', 304, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 305
            yield "        <div style=\"background:white;border-radius:20px;
                    border:1.5px solid rgba(96,165,250,0.2);
                    overflow:hidden;margin-bottom:16px;
                    box-shadow:0 4px 20px rgba(96,165,250,0.06)\"
             class=\"art-fade\" data-d=\".14\">
            <div style=\"display:flex;align-items:center;gap:8px;
                        padding:12px 18px;
                        background:linear-gradient(135deg,rgba(96,165,250,0.06),rgba(96,165,250,0.02));
                        border-bottom:1px solid rgba(96,165,250,0.1)\">
                <span style=\"font-size:16px\">✨</span>
                <span style=\"font-size:10px;font-weight:800;color:#2563eb;
                              text-transform:uppercase;letter-spacing:.14em\">AI Insights</span>
                <span style=\"margin-left:auto;font-size:9px;color:#60a5fa;font-weight:600\">
                    DistilRoBERTa · Local Model
                </span>
            </div>
            <div style=\"padding:16px 18px;display:grid;gap:16px;
                        grid-template-columns:1fr";
            // line 322
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["aiAnalysis"]) || array_key_exists("aiAnalysis", $context) ? $context["aiAnalysis"] : (function () { throw new RuntimeError('Variable "aiAnalysis" does not exist.', 322, $this->source); })()), "key_points", [], "any", false, false, false, 322)) > 0)) {
                yield " 1fr";
            }
            yield "\">
                ";
            // line 323
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["aiAnalysis"]) || array_key_exists("aiAnalysis", $context) ? $context["aiAnalysis"] : (function () { throw new RuntimeError('Variable "aiAnalysis" does not exist.', 323, $this->source); })()), "emotions", [], "any", false, false, false, 323)) > 0)) {
                // line 324
                yield "                    <div>
                        <p style=\"font-size:9px;font-weight:800;color:#3b82f6;
                                   text-transform:uppercase;letter-spacing:.12em;margin:0 0 10px\">
                            Emotional Tone
                        </p>
                        <div style=\"display:flex;flex-direction:column;gap:8px\">
                            ";
                // line 330
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["aiAnalysis"]) || array_key_exists("aiAnalysis", $context) ? $context["aiAnalysis"] : (function () { throw new RuntimeError('Variable "aiAnalysis" does not exist.', 330, $this->source); })()), "emotions", [], "any", false, false, false, 330));
                foreach ($context['_seq'] as $context["_key"] => $context["emotion"]) {
                    // line 331
                    yield "                                <div style=\"display:flex;align-items:center;gap:8px\">
                                    <span style=\"font-size:14px;width:20px;text-align:center;flex-shrink:0\">";
                    // line 332
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["emotion"], "emoji", [], "any", false, false, false, 332), "html", null, true);
                    yield "</span>
                                    <span style=\"font-size:11px;font-weight:700;color:#334155;
                                                  width:70px;flex-shrink:0\">";
                    // line 334
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["emotion"], "label", [], "any", false, false, false, 334), "html", null, true);
                    yield "</span>
                                    <div style=\"flex:1;background:#f1f5f9;border-radius:99px;height:6px\">
                                        <div class=\"ebar\" data-w=\"";
                    // line 336
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["emotion"], "score", [], "any", false, false, false, 336), "html", null, true);
                    yield "\"
                                             style=\"height:6px;border-radius:99px;width:0%;
                                                    background:";
                    // line 338
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["emotion"], "color", [], "any", false, false, false, 338), "html", null, true);
                    yield ";
                                                    transition:width .8s cubic-bezier(.4,0,.2,1);
                                                    box-shadow:0 0 6px ";
                    // line 340
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["emotion"], "color", [], "any", false, false, false, 340), "html", null, true);
                    yield "44\"></div>
                                    </div>
                                    <span style=\"font-size:10px;font-weight:800;color:#64748b;
                                                  width:30px;text-align:right;flex-shrink:0\">
                                        ";
                    // line 344
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["emotion"], "score", [], "any", false, false, false, 344), "html", null, true);
                    yield "%
                                    </span>
                                </div>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['emotion'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 348
                yield "                        </div>
                    </div>
                ";
            }
            // line 351
            yield "                ";
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["aiAnalysis"]) || array_key_exists("aiAnalysis", $context) ? $context["aiAnalysis"] : (function () { throw new RuntimeError('Variable "aiAnalysis" does not exist.', 351, $this->source); })()), "key_points", [], "any", false, false, false, 351)) > 0)) {
                // line 352
                yield "                    <div style=\"border-left:1px solid #f1f5f9;padding-left:16px\">
                        <p style=\"font-size:9px;font-weight:800;color:#3b82f6;
                                   text-transform:uppercase;letter-spacing:.12em;margin:0 0 10px\">
                            Key Takeaways
                        </p>
                        <ul style=\"list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:6px\">
                            ";
                // line 358
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["aiAnalysis"]) || array_key_exists("aiAnalysis", $context) ? $context["aiAnalysis"] : (function () { throw new RuntimeError('Variable "aiAnalysis" does not exist.', 358, $this->source); })()), "key_points", [], "any", false, false, false, 358));
                foreach ($context['_seq'] as $context["_key"] => $context["point"]) {
                    // line 359
                    yield "                                <li style=\"display:flex;align-items:flex-start;gap:7px;
                                           font-size:12px;color:#475569;line-height:1.5\">
                                    <span style=\"width:5px;height:5px;border-radius:50%;
                                                  background:#60a5fa;flex-shrink:0;margin-top:5px\"></span>
                                    ";
                    // line 363
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["point"], "html", null, true);
                    yield "
                                </li>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['point'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 366
                yield "                        </ul>
                    </div>
                ";
            }
            // line 369
            yield "            </div>
        </div>
    ";
        }
        // line 372
        yield "
    ";
        // line 374
        yield "    <div style=\"background:white;border-radius:24px;border:1.5px solid rgba(0,0,0,0.07);
                padding:28px;margin-bottom:16px;
                box-shadow:0 2px 12px rgba(0,0,0,0.05)\"
         class=\"art-fade\" data-d=\".16\">

        ";
        // line 380
        yield "        <details style=\"background:#eff6ff;border:1.5px solid rgba(59,130,246,0.25);
                        border-radius:16px;overflow:hidden;margin-bottom:20px\">
            <summary style=\"display:flex;align-items:center;gap:8px;
                            padding:11px 16px;cursor:pointer;list-style:none;
                            font-size:12px;font-weight:800;color:#1e40af;
                            user-select:none;transition:background .2s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">edit_note</span>
                My Notes
                <span style=\"margin-left:auto;font-size:10px;font-weight:500;color:#3b82f6\">
                    Saved locally
                </span>
                <span class=\"material-symbols-outlined\" style=\"font-size:16px\" id=\"notes-chevron\">expand_more</span>
            </summary>
            <div style=\"padding:4px 16px 14px\">
                <textarea id=\"article-notes\"
                          style=\"width:100%;height:80px;font-size:12px;color:#334155;
                                 background:white;border:1.5px solid rgba(59,130,246,0.2);
                                 border-radius:12px;padding:10px;resize:none;
                                 outline:none;font-family:var(--sans);line-height:1.5;
                                 transition:border-color .2s;box-sizing:border-box\"
                          placeholder=\"Jot down your thoughts…\"></textarea>
                <div style=\"display:flex;align-items:center;gap:8px;margin-top:8px\">
                    <button onclick=\"saveNote()\"
                            style=\"font-size:11px;font-weight:800;padding:5px 16px;border-radius:9px;
                                   background:#3b82f6;color:white;border:none;cursor:pointer;
                                   font-family:var(--sans);transition:all .2s\">Save</button>
                    <button onclick=\"clearNote()\"
                            style=\"font-size:11px;font-weight:700;padding:5px 12px;border-radius:9px;
                                   background:none;color:#2563eb;border:1.5px solid rgba(59,130,246,0.3);
                                   cursor:pointer;font-family:var(--sans);transition:all .2s\">Clear</button>
                    <span id=\"note-saved\"
                          style=\"display:none;font-size:11px;font-weight:700;color:#16a34a;
                                 align-items:center;gap:4px\">
                        <span class=\"material-symbols-outlined\" style=\"font-size:13px\">check</span> Saved!
                    </span>
                </div>
            </div>
        </details>

        ";
        // line 420
        yield "        <div id=\"article-body\"
             style=\"font-size:14px;color:#334155;line-height:1.85;
                    white-space:pre-line;font-weight:400\">
            ";
        // line 423
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 423, $this->source); })()), "contenu", [], "any", false, false, false, 423), "html", null, true);
        yield "
        </div>

        ";
        // line 427
        yield "        ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 427, $this->source); })()), "tags", [], "any", false, false, false, 427)) > 0)) {
            // line 428
            yield "            <div style=\"display:flex;flex-wrap:wrap;align-items:center;gap:6px;
                        padding-top:16px;margin-top:16px;border-top:1px solid #f1f5f9\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px;color:#94a3b8\">label</span>
                ";
            // line 431
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 431, $this->source); })()), "tags", [], "any", false, false, false, 431));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 432
                yield "                    <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_by_tag", ["tagName" => CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "nom", [], "any", false, false, false, 432)]), "html", null, true);
                yield "\"
                       style=\"font-size:11px;font-weight:700;
                              padding:3px 10px;border-radius:30px;
                              background:#f1f5f9;color:#64748b;text-decoration:none;
                              border:1px solid #e2e8f0;transition:all .2s\" class=\"tag-chip\">
                        #";
                // line 437
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "nom", [], "any", false, false, false, 437), "html", null, true);
                yield "
                    </a>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 440
            yield "            </div>
        ";
        }
        // line 442
        yield "    </div>

    ";
        // line 445
        yield "    ";
        if ((($tmp = (isset($context["wikiSummary"]) || array_key_exists("wikiSummary", $context) ? $context["wikiSummary"] : (function () { throw new RuntimeError('Variable "wikiSummary" does not exist.', 445, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 446
            yield "        <details style=\"background:#eff6ff;border:1.5px solid rgba(59,130,246,0.2);
                        border-radius:18px;overflow:hidden;margin-bottom:16px\"
                 class=\"art-fade\" data-d=\".18\">
            <summary style=\"display:flex;align-items:center;gap:8px;padding:12px 18px;
                            cursor:pointer;list-style:none;font-size:12px;
                            font-weight:800;color:#1e40af;user-select:none;transition:background .2s\">
                <svg style=\"width:15px;height:15px;flex-shrink:0\" viewBox=\"0 0 24 24\" fill=\"currentColor\">
                    <path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z\"/>
                </svg>
                Wikipedia: ";
            // line 455
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["wikiSummary"]) || array_key_exists("wikiSummary", $context) ? $context["wikiSummary"] : (function () { throw new RuntimeError('Variable "wikiSummary" does not exist.', 455, $this->source); })()), "title", [], "any", false, false, false, 455), "html", null, true);
            yield "
                <span class=\"material-symbols-outlined\"
                      style=\"font-size:16px;margin-left:auto;transition:transform .2s\"
                      id=\"wiki-chevron\">expand_more</span>
            </summary>
            <div style=\"padding:4px 18px 16px\">
                <p style=\"font-size:12px;color:#1e3a5f;line-height:1.7;margin:0 0 8px\">
                    ";
            // line 462
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["wikiSummary"]) || array_key_exists("wikiSummary", $context) ? $context["wikiSummary"] : (function () { throw new RuntimeError('Variable "wikiSummary" does not exist.', 462, $this->source); })()), "extract", [], "any", false, false, false, 462), "html", null, true);
            yield "
                </p>
                <a href=\"";
            // line 464
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["wikiSummary"]) || array_key_exists("wikiSummary", $context) ? $context["wikiSummary"] : (function () { throw new RuntimeError('Variable "wikiSummary" does not exist.', 464, $this->source); })()), "url", [], "any", false, false, false, 464), "html", null, true);
            yield "\" target=\"_blank\" rel=\"noopener\"
                   style=\"font-size:11px;font-weight:800;color:#2563eb;
                          text-decoration:none;display:inline-flex;align-items:center;gap:4px\">
                    Read on Wikipedia
                    <span class=\"material-symbols-outlined\" style=\"font-size:12px\">open_in_new</span>
                </a>
            </div>
        </details>
    ";
        }
        // line 473
        yield "
    ";
        // line 475
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["bookRecommendations"]) || array_key_exists("bookRecommendations", $context) ? $context["bookRecommendations"] : (function () { throw new RuntimeError('Variable "bookRecommendations" does not exist.', 475, $this->source); })())) > 0)) {
            // line 476
            yield "        <div style=\"margin-bottom:16px\" class=\"art-fade\" data-d=\".2\">
            <h3 style=\"font-size:10px;font-weight:800;color:#94a3b8;
                        text-transform:uppercase;letter-spacing:.14em;
                        margin:0 0 10px;display:flex;align-items:center;gap:6px\">
                <span class=\"material-symbols-outlined\" style=\"font-size:14px\">menu_book</span>
                Related Books · OpenLibrary
            </h3>
            <div style=\"display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:10px\">
                ";
            // line 484
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["bookRecommendations"]) || array_key_exists("bookRecommendations", $context) ? $context["bookRecommendations"] : (function () { throw new RuntimeError('Variable "bookRecommendations" does not exist.', 484, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["book"]) {
                // line 485
                yield "                    <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["book"], "url", [], "any", false, false, false, 485), "html", null, true);
                yield "\" target=\"_blank\" rel=\"noopener\"
                       style=\"background:white;border-radius:14px;padding:12px;
                              border:1.5px solid rgba(0,0,0,0.07);text-decoration:none;
                              display:flex;gap:10px;align-items:flex-start;
                              transition:all .2s\" class=\"book-card\">
                        ";
                // line 490
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["book"], "cover", [], "any", false, false, false, 490)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 491
                    yield "                            <img src=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["book"], "cover", [], "any", false, false, false, 491), "html", null, true);
                    yield "\" alt=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["book"], "title", [], "any", false, false, false, 491), "html", null, true);
                    yield "\"
                                 style=\"width:36px;height:52px;object-fit:cover;
                                        border-radius:5px;flex-shrink:0;
                                        box-shadow:0 2px 8px rgba(0,0,0,0.12)\">
                        ";
                } else {
                    // line 496
                    yield "                            <div style=\"width:36px;height:52px;border-radius:5px;
                                        background:rgba(96,165,250,0.1);flex-shrink:0;
                                        display:flex;align-items:center;justify-content:center\">
                                <span class=\"material-symbols-outlined\" style=\"font-size:18px;color:#3b82f6\">book</span>
                            </div>
                        ";
                }
                // line 502
                yield "                        <div style=\"flex:1;min-width:0\">
                            <p style=\"font-size:11px;font-weight:700;color:#1e293b;
                                       margin:0 0 3px;line-height:1.3;
                                       display:-webkit-box;-webkit-line-clamp:2;
                                       -webkit-box-orient:vertical;overflow:hidden\">
                                ";
                // line 507
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["book"], "title", [], "any", false, false, false, 507), "html", null, true);
                yield "
                            </p>
                            <p style=\"font-size:10px;color:#94a3b8;margin:0\">";
                // line 509
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["book"], "author", [], "any", false, false, false, 509), "html", null, true);
                yield "</p>
                            ";
                // line 510
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["book"], "year", [], "any", false, false, false, 510)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 511
                    yield "                                <p style=\"font-size:9px;color:#cbd5e1;margin:2px 0 0\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["book"], "year", [], "any", false, false, false, 511), "html", null, true);
                    yield "</p>
                            ";
                }
                // line 513
                yield "                        </div>
                    </a>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['book'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 516
            yield "            </div>
        </div>
    ";
        }
        // line 519
        yield "
    ";
        // line 521
        yield "    ";
        if ((($tmp = (isset($context["nextStep"]) || array_key_exists("nextStep", $context) ? $context["nextStep"] : (function () { throw new RuntimeError('Variable "nextStep" does not exist.', 521, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 522
            yield "        <div style=\"background:linear-gradient(135deg,rgba(96,165,250,0.08),rgba(96,165,250,0.03));
                    border:1.5px solid rgba(96,165,250,0.2);border-radius:20px;
                    padding:18px 20px;display:flex;align-items:center;
                    justify-content:space-between;gap:16px;margin-bottom:16px\"
             class=\"art-fade\" data-d=\".22\">
            <div>
                <p style=\"font-size:9px;font-weight:800;color:#3b82f6;
                           text-transform:uppercase;letter-spacing:.14em;margin:0 0 4px\">
                    Continue Learning
                </p>
                <p style=\"font-size:13px;font-weight:700;color:#1e293b;margin:0 0 2px;
                           overflow:hidden;white-space:nowrap;text-overflow:ellipsis;max-width:380px\">
                    ";
            // line 534
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["nextStep"]) || array_key_exists("nextStep", $context) ? $context["nextStep"] : (function () { throw new RuntimeError('Variable "nextStep" does not exist.', 534, $this->source); })()), "article", [], "any", false, false, false, 534), "titre", [], "any", false, false, false, 534), "html", null, true);
            yield "
                </p>
                <p style=\"font-size:11px;color:#94a3b8;margin:0\">
                    Step ";
            // line 537
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["nextStep"]) || array_key_exists("nextStep", $context) ? $context["nextStep"] : (function () { throw new RuntimeError('Variable "nextStep" does not exist.', 537, $this->source); })()), "articleOrder", [], "any", false, false, false, 537), "html", null, true);
            yield " / ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalSteps"]) || array_key_exists("totalSteps", $context) ? $context["totalSteps"] : (function () { throw new RuntimeError('Variable "totalSteps" does not exist.', 537, $this->source); })()), "html", null, true);
            yield "
                </p>
            </div>
            <a href=\"";
            // line 540
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["nextStep"]) || array_key_exists("nextStep", $context) ? $context["nextStep"] : (function () { throw new RuntimeError('Variable "nextStep" does not exist.', 540, $this->source); })()), "article", [], "any", false, false, false, 540), "id", [], "any", false, false, false, 540)]), "html", null, true);
            yield "\"
               style=\"flex-shrink:0;display:inline-flex;align-items:center;gap:6px;
                      padding:10px 20px;border-radius:14px;
                      background:linear-gradient(135deg,#60a5fa,#3b82f6);
                      color:#0d1b2a;font-size:12px;font-weight:800;
                      text-decoration:none;white-space:nowrap;
                      box-shadow:0 4px 16px rgba(96,165,250,0.3);
                      transition:all .2s\" class=\"next-btn\">
                Next
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">arrow_forward</span>
            </a>
        </div>
    ";
        }
        // line 553
        yield "
    ";
        // line 555
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["relatedArticles"]) || array_key_exists("relatedArticles", $context) ? $context["relatedArticles"] : (function () { throw new RuntimeError('Variable "relatedArticles" does not exist.', 555, $this->source); })())) > 0)) {
            // line 556
            yield "        <div style=\"margin-bottom:16px\" class=\"art-fade\" data-d=\".24\">
            <h2 style=\"font-size:10px;font-weight:800;color:#94a3b8;
                        text-transform:uppercase;letter-spacing:.14em;
                        margin:0 0 10px;display:flex;align-items:center;gap:6px\">
                <span class=\"material-symbols-outlined\" style=\"font-size:14px\">recommend</span>
                You might also like
            </h2>
            <div style=\"display:flex;flex-direction:column;gap:8px\">
                ";
            // line 564
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["relatedArticles"]) || array_key_exists("relatedArticles", $context) ? $context["relatedArticles"] : (function () { throw new RuntimeError('Variable "relatedArticles" does not exist.', 564, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["related"]) {
                // line 565
                yield "                    <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["related"], "id", [], "any", false, false, false, 565)]), "html", null, true);
                yield "\"
                       style=\"display:flex;align-items:center;gap:12px;
                              background:white;border-radius:16px;
                              border:1.5px solid rgba(0,0,0,0.07);
                              padding:12px 16px;text-decoration:none;
                              transition:all .22s\" class=\"rel-card\">
                        <div style=\"width:36px;height:36px;border-radius:11px;
                                    background:rgba(96,165,250,0.08);flex-shrink:0;
                                    display:flex;align-items:center;justify-content:center\">
                            <span class=\"material-symbols-outlined\" style=\"font-size:16px;color:#3b82f6\">article</span>
                        </div>
                        <div style=\"flex:1;min-width:0\">
                            <p style=\"font-size:13px;font-weight:700;color:#1e293b;margin:0 0 2px;
                                       overflow:hidden;white-space:nowrap;text-overflow:ellipsis\">
                                ";
                // line 579
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["related"], "titre", [], "any", false, false, false, 579), "html", null, true);
                yield "
                            </p>
                            <p style=\"font-size:11px;color:#94a3b8;margin:0;
                                       overflow:hidden;white-space:nowrap;text-overflow:ellipsis\">
                                ";
                // line 583
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["related"], "contenu", [], "any", false, false, false, 583)), 0, 65), "html", null, true);
                yield "…
                            </p>
                        </div>
                        ";
                // line 586
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["related"], "categorie", [], "any", false, false, false, 586)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 587
                    yield "                            <span style=\"font-size:10px;font-weight:800;flex-shrink:0;
                                          padding:2px 8px;border-radius:20px;
                                          background:rgba(96,165,250,0.1);color:#3b82f6\">
                                ";
                    // line 590
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["related"], "categorie", [], "any", false, false, false, 590), "nom", [], "any", false, false, false, 590), "html", null, true);
                    yield "
                            </span>
                        ";
                }
                // line 593
                yield "                        <span class=\"material-symbols-outlined rel-arrow\"
                              style=\"font-size:16px;color:#cbd5e1;flex-shrink:0;transition:all .2s\">
                            arrow_forward
                        </span>
                    </a>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['related'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 599
            yield "            </div>
        </div>
    ";
        }
        // line 602
        yield "
    ";
        // line 604
        yield "    <div style=\"display:flex;align-items:center;justify-content:space-between;
                flex-wrap:wrap;gap:10px;
                padding-top:16px;border-top:1px solid #f1f5f9\"
         class=\"art-fade\" data-d=\".28\">
        <a href=\"";
        // line 608
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "\"
           style=\"display:inline-flex;align-items:center;gap:6px;
                  font-size:13px;font-weight:700;color:#64748b;
                  text-decoration:none;transition:color .2s\" class=\"back-lnk\">
            <span class=\"material-symbols-outlined\" style=\"font-size:15px\">arrow_back</span> Back
        </a>
        <div style=\"display:flex;align-items:center;gap:8px;flex-wrap:wrap\">

            ";
        // line 617
        yield "            ";
        $context["shareUrl"] = $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 617, $this->source); })()), "id", [], "any", false, false, false, 617)]);
        // line 618
        yield "            ";
        $context["shareText"] = Twig\Extension\CoreExtension::urlencode(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 618, $this->source); })()), "titre", [], "any", false, false, false, 618));
        // line 619
        yield "            <a href=\"https://twitter.com/intent/tweet?text=";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["shareText"]) || array_key_exists("shareText", $context) ? $context["shareText"] : (function () { throw new RuntimeError('Variable "shareText" does not exist.', 619, $this->source); })()), "html", null, true);
        yield "&url=";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode((isset($context["shareUrl"]) || array_key_exists("shareUrl", $context) ? $context["shareUrl"] : (function () { throw new RuntimeError('Variable "shareUrl" does not exist.', 619, $this->source); })())), "html", null, true);
        yield "\"
               target=\"_blank\" rel=\"noopener\"
               style=\"padding:8px 14px;border-radius:11px;border:1.5px solid #e2e8f0;
                      background:white;color:#64748b;font-size:12px;font-weight:700;
                      text-decoration:none;display:flex;align-items:center;gap:5px;
                      transition:all .2s;font-family:var(--sans)\" class=\"share-btn\">
                <svg style=\"width:13px;height:13px\" fill=\"currentColor\" viewBox=\"0 0 24 24\">
                    <path d=\"M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z\"/>
                </svg>
                Share
            </a>

            <a href=\"";
        // line 631
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_pdf", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 631, $this->source); })()), "id", [], "any", false, false, false, 631)]), "html", null, true);
        yield "\"
               style=\"padding:8px 14px;border-radius:11px;border:1.5px solid #e2e8f0;
                      background:white;color:#64748b;font-size:12px;font-weight:700;
                      text-decoration:none;display:flex;align-items:center;gap:5px;
                      transition:all .2s;font-family:var(--sans)\" class=\"share-btn\">
                <span class=\"material-symbols-outlined\" style=\"font-size:14px\">picture_as_pdf</span>
                PDF
            </a>

            ";
        // line 640
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
            // line 641
            yield "                <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 641, $this->source); })()), "id", [], "any", false, false, false, 641)]), "html", null, true);
            yield "\"
                   style=\"padding:8px 14px;border-radius:11px;border:1.5px solid #e2e8f0;
                          background:white;color:#64748b;font-size:12px;font-weight:700;
                          text-decoration:none;display:flex;align-items:center;gap:5px;
                          transition:all .2s;font-family:var(--sans)\" class=\"share-btn\">
                    <span class=\"material-symbols-outlined\" style=\"font-size:14px\">edit</span>
                    Edit
                </a>
                <form method=\"post\" action=\"";
            // line 649
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 649, $this->source); })()), "id", [], "any", false, false, false, 649)]), "html", null, true);
            yield "\"
                      onsubmit=\"return confirm('Permanently delete this article?')\"
                      style=\"display:flex;margin:0\">
                    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 652
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 652, $this->source); })()), "id", [], "any", false, false, false, 652))), "html", null, true);
            yield "\">
                    <button style=\"padding:8px 14px;border-radius:11px;
                                   border:1.5px solid rgba(239,68,68,0.25);
                                   background:white;color:#ef4444;font-size:12px;font-weight:700;
                                   cursor:pointer;display:flex;align-items:center;gap:5px;
                                   transition:all .2s;font-family:var(--sans)\" class=\"del-btn\">
                        <span class=\"material-symbols-outlined\" style=\"font-size:14px\">delete</span>
                        Delete
                    </button>
                </form>
            ";
        }
        // line 663
        yield "        </div>
    </div>

</div>";
        // line 667
        yield "
<style>
/* ── Animations ── */
@keyframes artFadeUp {
    from{opacity:0;transform:translateY(16px)}
    to  {opacity:1;transform:translateY(0)}
}
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.4} }

.art-fade {
    opacity:0;
    animation:artFadeUp .45s cubic-bezier(.4,0,.2,1) forwards;
    animation-delay:var(--d,.1s);
}

/* ── Floating tool buttons (blue hover) ── */
.ftool:hover { background:#0d1b2a !important; color:#60a5fa !important; transform:scale(1.08); box-shadow:0 4px 16px rgba(96,165,250,.2) !important; }
.ftool:hover .ftip { opacity:1 !important; }

/* ── Breadcrumb ── */
.bc-link:hover { color:#3b82f6 !important; }

/* ── Category chip ── */
.cat-chip:hover { background:rgba(96,165,250,0.3) !important; border-color:rgba(96,165,250,0.5) !important; }

/* ── Tag chips ── */
.tag-chip:hover { background:rgba(96,165,250,0.1) !important; color:#3b82f6 !important; border-color:rgba(96,165,250,0.3) !important; }

/* ── Related cards ── */
.rel-card:hover { border-color:rgba(96,165,250,0.3) !important; box-shadow:0 6px 24px rgba(96,165,250,0.1) !important; transform:translateX(4px); }
.rel-card:hover .rel-arrow { color:#3b82f6 !important; transform:translateX(3px); }

/* ── Book cards ── */
.book-card:hover { border-color:rgba(96,165,250,0.3) !important; box-shadow:0 4px 16px rgba(96,165,250,0.1) !important; transform:translateY(-2px); }

/* ── Share / action buttons ── */
.share-btn:hover { border-color:rgba(96,165,250,0.3) !important; color:#3b82f6 !important; background:#eff6ff !important; }
.del-btn:hover { background:#fef2f2 !important; }

/* ── Next button ── */
.next-btn:hover { box-shadow:0 6px 24px rgba(96,165,250,0.4) !important; transform:translateY(-1px); }
.next-btn:hover .material-symbols-outlined { transform:translateX(3px); }
.next-btn .material-symbols-outlined { transition:transform .2s; }

/* ── Mood buttons (blue hover) ── */
.mood-btn:hover { background:#0d1b2a !important; color:#60a5fa !important; border-color:#0d1b2a !important; }

/* ── Back link ── */
.back-lnk:hover { color:#3b82f6 !important; }

/* ── Step dots (blue) ── */
.step-dot.done    { background:#3b82f6 !important; box-shadow:0 0 0 2px rgba(96,165,250,0.2); }
.step-dot.current { background:#2563eb !important; box-shadow:0 0 0 2px rgba(59,130,246,0.3); }

/* ── Print ── */
@media print {
    #float-toolbar,#reading-progress-bar,#tts-bar,#mood-toast { display:none !important; }
    .art-fade { opacity:1 !important; animation:none !important; }
}
</style>

<script>
const ARTICLE_ID = '";
        // line 729
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 729, $this->source); })()), "id", [], "any", false, false, false, 729), "html", null, true);
        yield "';
const NOTE_KEY   = 'article_note_'  + ARTICLE_ID;
const READ_KEY   = 'article_read_'  + ARTICLE_ID;
const MOOD_KEY   = 'mood_shown_'    + ARTICLE_ID;
const READ_ARTS  = 'read_articles';

/* ── Staggered fade-up via data-d attribute ── */
document.querySelectorAll('.art-fade[data-d]').forEach(el => {
    el.style.animationDelay = el.dataset.d + 's';
});

/* ── Reading progress ── */
window.addEventListener('scroll', () => {
    const body=document.body, html=document.documentElement;
    const total=Math.max(body.scrollHeight,html.scrollHeight)-window.innerHeight;
    const pct=total>0?(window.scrollY/total)*100:0;
    document.getElementById('reading-progress-bar').style.width=pct+'%';
    if(pct>=80) markAsRead();
});

function markAsRead(){
    if(localStorage.getItem(READ_KEY)) return;
    localStorage.setItem(READ_KEY,'1');
    const b=document.getElementById('completed-badge');
    if(b){ b.style.display='inline-flex'; }
    let rs=JSON.parse(localStorage.getItem(READ_ARTS)||'[]');
    if(!rs.includes(ARTICLE_ID)){ rs.push(ARTICLE_ID); localStorage.setItem(READ_ARTS,JSON.stringify(rs)); }
}

/* ── Notes ── */
function saveNote(){
    const ta=document.getElementById('article-notes');
    if(ta) localStorage.setItem(NOTE_KEY,ta.value);
    const s=document.getElementById('note-saved');
    if(s){ s.style.display='flex'; setTimeout(()=>s.style.display='none',2000); }
}
function clearNote(){
    const ta=document.getElementById('article-notes');
    if(ta) ta.value='';
    localStorage.removeItem(NOTE_KEY);
}

/* ── TTS ── */
let ttsU=null, ttsPaused=false, ttsRate=1;
function toggleTTS(){
    if(window.speechSynthesis.speaking&&!ttsPaused){ pauseTTS(); return; }
    if(ttsPaused){ window.speechSynthesis.resume(); ttsPaused=false; setTTSUI(true); return; }
    const title=document.getElementById('article-title')?.textContent.trim()||'';
    const body=document.getElementById('article-body')?.textContent.trim()||'';
    ttsU=new SpeechSynthesisUtterance(title+'. '+body);
    ttsU.rate=ttsRate; ttsU.onend=stopTTS; ttsU.onerror=stopTTS;
    window.speechSynthesis.speak(ttsU); setTTSUI(true);
}
function pauseTTS(){
    window.speechSynthesis.pause(); ttsPaused=true;
    document.getElementById('tts-pause-icon').textContent='play_arrow';
    document.getElementById('tts-pause-label').textContent='Resume';
}
function stopTTS(){
    window.speechSynthesis.cancel(); ttsPaused=false; setTTSUI(false);
    document.getElementById('tts-pause-icon').textContent='pause';
    document.getElementById('tts-pause-label').textContent='Pause';
}
function setTTSUI(on){
    document.getElementById('tts-bar').style.transform=on?'translateY(0)':'translateY(100%)';
    document.getElementById('tts-icon').textContent=on?'volume_off':'volume_up';
}
function updateTTSRate(v){
    ttsRate=parseFloat(v);
    document.getElementById('tts-rate-label').textContent=ttsRate+'×';
}

/* ── Copy link ── */
function copyLink(){
    navigator.clipboard.writeText(window.location.href).then(()=>{
        const i=document.getElementById('copy-icon');
        i.textContent='check';
        setTimeout(()=>i.textContent='link',2000);
    });
}

/* ── Mood toast ── */
function showMoodToast(){
    const t=document.getElementById('mood-toast');
    if(t){ t.style.opacity='1'; t.style.pointerEvents='auto'; t.style.transform='translateX(-50%) scale(1)'; }
}
function dismissMood(){
    const t=document.getElementById('mood-toast');
    if(t){ t.style.opacity='0'; t.style.pointerEvents='none'; t.style.transform='translateX(-50%) scale(.95)'; }
    localStorage.setItem(MOOD_KEY,'1');
}
function saveMood(emoji,label){
    const log=JSON.parse(localStorage.getItem('mood_log')||'[]');
    log.push({article:ARTICLE_ID,mood:label,emoji,date:new Date().toISOString()});
    localStorage.setItem('mood_log',JSON.stringify(log));
    dismissMood();
    const t=document.createElement('div');
    t.style.cssText='position:fixed;bottom:80px;left:50%;transform:translateX(-50%);z-index:60;background:#059669;color:white;font-size:13px;font-weight:800;padding:10px 20px;border-radius:14px;box-shadow:0 4px 20px rgba(5,150,105,.3);font-family:var(--sans)';
    t.textContent=emoji+' Mood logged!';
    document.body.appendChild(t);
    setTimeout(()=>t.remove(),2200);
}

/* ── Init ── */
document.addEventListener('DOMContentLoaded',()=>{
    if(localStorage.getItem(READ_KEY)){
        const b=document.getElementById('completed-badge'); if(b) b.style.display='inline-flex';
    }
    const saved=localStorage.getItem(NOTE_KEY);
    if(saved){ const ta=document.getElementById('article-notes'); if(ta) ta.value=saved; }

    setTimeout(()=>{
        document.querySelectorAll('.ebar').forEach(b=>b.style.width=b.dataset.w+'%');
    },500);

    const cs=";
        // line 844
        yield (((array_key_exists("currentStep", $context) &&  !(null === $context["currentStep"]))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["currentStep"], "html", null, true)) : ("null"));
        yield ";
    if(cs){ document.querySelectorAll('.step-dot').forEach(d=>{
        const s=parseInt(d.dataset.step);
        if(s<cs) d.classList.add('done'); else if(s===cs) d.classList.add('current');
    }); }

    if(!localStorage.getItem(MOOD_KEY)) setTimeout(showMoodToast,4000);
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
        return "article/show.html.twig";
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
        return array (  1307 => 844,  1189 => 729,  1125 => 667,  1120 => 663,  1106 => 652,  1100 => 649,  1088 => 641,  1086 => 640,  1074 => 631,  1056 => 619,  1053 => 618,  1050 => 617,  1039 => 608,  1033 => 604,  1030 => 602,  1025 => 599,  1014 => 593,  1008 => 590,  1003 => 587,  1001 => 586,  995 => 583,  988 => 579,  970 => 565,  966 => 564,  956 => 556,  953 => 555,  950 => 553,  934 => 540,  926 => 537,  920 => 534,  906 => 522,  903 => 521,  900 => 519,  895 => 516,  887 => 513,  881 => 511,  879 => 510,  875 => 509,  870 => 507,  863 => 502,  855 => 496,  844 => 491,  842 => 490,  833 => 485,  829 => 484,  819 => 476,  816 => 475,  813 => 473,  801 => 464,  796 => 462,  786 => 455,  775 => 446,  772 => 445,  768 => 442,  764 => 440,  755 => 437,  746 => 432,  742 => 431,  737 => 428,  734 => 427,  728 => 423,  723 => 420,  682 => 380,  675 => 374,  672 => 372,  667 => 369,  662 => 366,  653 => 363,  647 => 359,  643 => 358,  635 => 352,  632 => 351,  627 => 348,  617 => 344,  610 => 340,  605 => 338,  600 => 336,  595 => 334,  590 => 332,  587 => 331,  583 => 330,  575 => 324,  573 => 323,  567 => 322,  548 => 305,  545 => 304,  541 => 301,  533 => 296,  527 => 293,  515 => 283,  512 => 282,  508 => 279,  499 => 275,  495 => 273,  488 => 271,  481 => 268,  479 => 267,  471 => 261,  468 => 260,  462 => 256,  456 => 252,  449 => 247,  433 => 234,  427 => 230,  424 => 229,  421 => 228,  415 => 225,  411 => 224,  405 => 223,  402 => 222,  399 => 221,  396 => 220,  393 => 219,  387 => 216,  377 => 210,  375 => 209,  372 => 208,  361 => 198,  355 => 193,  348 => 187,  345 => 185,  340 => 182,  329 => 178,  325 => 177,  319 => 174,  307 => 167,  301 => 164,  291 => 156,  288 => 155,  282 => 151,  279 => 150,  272 => 146,  264 => 142,  262 => 141,  255 => 137,  250 => 134,  246 => 131,  235 => 119,  224 => 116,  213 => 111,  209 => 110,  194 => 97,  159 => 63,  155 => 60,  146 => 57,  133 => 53,  121 => 45,  116 => 44,  114 => 38,  109 => 35,  100 => 27,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<link href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined\" rel=\"stylesheet\" />
<style>
.material-symbols-outlined {
  font-family: 'Material Symbols Outlined' !important;
  font-weight: normal;
  font-style: normal;
  font-size: 20px;
  display: inline-block;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  white-space: nowrap;
  direction: ltr;
  -webkit-font-smoothing: antialiased;
  font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
}
</style>

{# ── Reading progress bar (blue) ── #}
<div id=\"reading-progress-bar\"
     style=\"position:fixed;top:0;left:0;height:3px;width:0%;z-index:9999;
            background:linear-gradient(90deg,#60a5fa,#3b82f6,#2563eb);
            border-radius:0 3px 3px 0;
            box-shadow:0 0 8px rgba(96,165,250,.5);
            transition:width .1s linear\"></div>

{# ── Floating toolbar ── #}
<div style=\"position:fixed;right:16px;top:50%;transform:translateY(-50%);
            z-index:50;display:flex;flex-direction:column;gap:8px\"
     id=\"float-toolbar\">
    {% set tools = [
        {fn:'toggleTTS()', icon:'volume_up', id:'tts-icon', tip:'Read aloud'},
        {fn:'copyLink()',  icon:'link',       id:'copy-icon', tip:'Copy link'},
        {fn:'window.print()', icon:'print',  id:'',          tip:'Print'},
        {fn:\"window.scrollTo({top:0,behavior:'smooth'})\", icon:'arrow_upward', id:'', tip:'Top'},
    ] %}
    {% for t in tools %}
        <button onclick=\"{{ t.fn }}\" class=\"ftool\"
                style=\"width:38px;height:38px;border-radius:11px;
                       background:white;border:1px solid rgba(0,0,0,0.09);
                       display:flex;align-items:center;justify-content:center;
                       cursor:pointer;position:relative;
                       box-shadow:0 2px 8px rgba(0,0,0,0.07);
                       transition:all .2s;color:#64748b\">
            <span class=\"material-symbols-outlined\" style=\"font-size:17px\"
                  {% if t.id %}id=\"{{ t.id }}\"{% endif %}>{{ t.icon }}</span>
            <span style=\"position:absolute;right:46px;background:#0d1b2a;color:white;
                         font-size:10px;font-weight:700;padding:3px 9px;border-radius:7px;
                         white-space:nowrap;opacity:0;pointer-events:none;transition:opacity .15s;
                         font-family:var(--sans)\" class=\"ftip\">{{ t.tip }}</span>
        </button>
    {% endfor %}
</div>

{# ── TTS bar (blue) ── #}
<div id=\"tts-bar\"
     style=\"position:fixed;bottom:0;left:0;right:0;z-index:50;
            background:linear-gradient(135deg,#0d1b2a,#1b2d40);
            color:white;padding:12px 24px;
            display:flex;align-items:center;gap:12px;
            transform:translateY(100%);transition:transform .3s;
            box-shadow:0 -4px 24px rgba(0,0,0,0.2)\">
    <span class=\"material-symbols-outlined\" style=\"font-size:18px;color:#60a5fa;animation:pulse 1.5s infinite\">graphic_eq</span>
    <span style=\"font-size:12px;font-weight:700;flex:1;color:rgba(255,255,255,0.8)\">Reading aloud…</span>
    <button onclick=\"pauseTTS()\" id=\"tts-pause-btn\"
            style=\"display:flex;align-items:center;gap:4px;
                   background:rgba(96,165,250,0.15);border:1px solid rgba(96,165,250,0.3);
                   color:#60a5fa;padding:6px 14px;border-radius:10px;
                   font-size:11px;font-weight:800;cursor:pointer;font-family:var(--sans);
                   transition:all .2s\">
        <span class=\"material-symbols-outlined\" style=\"font-size:13px\" id=\"tts-pause-icon\">pause</span>
        <span id=\"tts-pause-label\">Pause</span>
    </button>
    <button onclick=\"stopTTS()\"
            style=\"display:flex;align-items:center;gap:4px;
                   background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);
                   color:rgba(255,255,255,0.7);padding:6px 14px;border-radius:10px;
                   font-size:11px;font-weight:800;cursor:pointer;font-family:var(--sans);transition:all .2s\">
        <span class=\"material-symbols-outlined\" style=\"font-size:13px\">stop</span> Stop
    </button>
    <div style=\"display:flex;align-items:center;gap:8px\">
        <span style=\"font-size:10px;color:rgba(255,255,255,0.4)\">Speed</span>
        <input type=\"range\" min=\"0.5\" max=\"2\" step=\"0.25\" value=\"1\" id=\"tts-rate\"
               style=\"width:80px;accent-color:#60a5fa\" oninput=\"updateTTSRate(this.value)\">
        <span style=\"font-size:11px;font-weight:800;width:24px;color:#60a5fa\" id=\"tts-rate-label\">1×</span>
    </div>
</div>

{# ── Mood toast (unchanged) ── #}
<div id=\"mood-toast\"
     style=\"position:fixed;bottom:24px;left:50%;transform:translateX(-50%) scale(.95);z-index:50;
            background:white;border-radius:20px;
            box-shadow:0 12px 40px rgba(0,0,0,0.15);
            border:1.5px solid rgba(0,0,0,0.07);
            padding:16px 20px;display:flex;align-items:center;gap:14px;
            min-width:320px;opacity:0;pointer-events:none;
            transition:all .4s cubic-bezier(.4,0,.2,1)\">
    <span style=\"font-size:22px;flex-shrink:0\">🧠</span>
    <div style=\"flex:1;min-width:0\">
        <p style=\"font-size:11px;font-weight:800;color:#1e293b;margin:0 0 8px;
                   letter-spacing:.02em\">How are you feeling right now?</p>
        <div style=\"display:flex;flex-wrap:wrap;gap:5px\">
            {% for mood in [['😌','Calm'],['😊','Happy'],['😔','Sad'],['😰','Anxious'],['😤','Stressed']] %}
                <button onclick=\"saveMood('{{ mood[0] }}','{{ mood[1] }}')\"
                        style=\"font-size:11px;font-weight:700;padding:4px 10px;border-radius:30px;
                               border:1.5px solid #e2e8f0;background:white;cursor:pointer;
                               font-family:var(--sans);white-space:nowrap;transition:all .15s\"
                        class=\"mood-btn\">
                    {{ mood[0] }} {{ mood[1] }}
                </button>
            {% endfor %}
        </div>
    </div>
    <button onclick=\"dismissMood()\"
            style=\"background:none;border:none;cursor:pointer;color:#94a3b8;flex-shrink:0;
                   display:flex;padding:4px;border-radius:6px;transition:color .15s\">
        <span class=\"material-symbols-outlined\" style=\"font-size:17px\">close</span>
    </button>
</div>

{# ══════════════════════════════════════════
   MAIN LAYOUT
══════════════════════════════════════════ #}
<div id=\"show-page\" style=\"max-width:760px\">

    {# Breadcrumb #}
    <nav style=\"display:flex;align-items:center;gap:6px;font-size:12px;
                color:#94a3b8;margin-bottom:20px;flex-wrap:wrap\"
         class=\"art-fade\" style=\"--d:.04s\">
        <a href=\"{{ path('app_article_index') }}\"
           style=\"color:#94a3b8;text-decoration:none;font-weight:600;
                  transition:color .2s\" class=\"bc-link\">Articles</a>
        <span style=\"color:#e2e8f0\">›</span>
        {% if currentPath %}
            <a href=\"{{ path('app_learning_path_show', {id: currentPath.id}) }}\"
               style=\"color:#94a3b8;text-decoration:none;font-weight:600;
                      transition:color .2s;max-width:140px;overflow:hidden;
                      white-space:nowrap;text-overflow:ellipsis\" class=\"bc-link\">
                {{ currentPath.titre }}
            </a>
            <span style=\"color:#e2e8f0\">›</span>
        {% endif %}
        <span style=\"color:#475569;font-weight:700;overflow:hidden;white-space:nowrap;
                     text-overflow:ellipsis;max-width:260px\">{{ article.titre }}</span>
    </nav>

    {# ── Path progress (blue) ── #}
    {% if currentPath and currentStep and totalSteps %}
        <div style=\"background:white;border-radius:18px;border:1.5px solid rgba(0,0,0,0.07);
                    padding:16px 20px;margin-bottom:20px;
                    box-shadow:0 2px 10px rgba(0,0,0,0.05)\"
             class=\"art-fade\" data-d=\".08\">
            <div style=\"display:flex;align-items:center;justify-content:space-between;margin-bottom:8px\">
                <span style=\"font-size:11px;font-weight:800;color:#3b82f6;
                              display:flex;align-items:center;gap:4px\">
                    <span class=\"material-symbols-outlined\" style=\"font-size:13px\">route</span>
                    {{ currentPath.titre }}
                </span>
                <span style=\"font-size:11px;font-weight:800;color:#94a3b8\">
                    {{ currentStep }} / {{ totalSteps }}
                </span>
            </div>
            <div style=\"background:#f1f5f9;border-radius:99px;height:5px\">
                <div style=\"height:5px;border-radius:99px;
                            background:linear-gradient(90deg,#60a5fa,#3b82f6);
                            transition:width .7s cubic-bezier(.4,0,.2,1);
                            width:{{ ((currentStep / totalSteps) * 100)|round }}%\"></div>
            </div>
            <div style=\"display:flex;gap:6px;margin-top:10px;flex-wrap:wrap\">
                {% for i in 1..totalSteps %}
                    <div class=\"step-dot\" data-step=\"{{ i }}\"
                         style=\"width:8px;height:8px;border-radius:50%;
                                background:#e2e8f0;transition:all .3s\"></div>
                {% endfor %}
            </div>
        </div>
    {% endif %}

    {# ══ ARTICLE HERO (updated to blue gradient) ══ #}
<div style=\"background:linear-gradient(135deg, #232d8d 0%, #131c74 55%, #11125e 100%);
            border-radius:28px;overflow:hidden;margin-bottom:16px;
            position:relative\"
     class=\"art-fade\" data-d=\".1\">

    {# Grid texture – light blue lines #}
    <div style=\"position:absolute;inset:0;
                background-image:linear-gradient(rgba(96,165,250,0.08) 1px,transparent 1px),
                                 linear-gradient(90deg,rgba(96,165,250,0.08) 1px,transparent 1px);
                background-size:24px 24px;pointer-events:none\"></div>
    {# Glow orbs – blue #}
    <div style=\"position:absolute;top:-60px;right:-40px;width:240px;height:240px;
                background:radial-gradient(circle,rgba(96,165,250,0.2) 0%,transparent 70%);
                border-radius:50%;pointer-events:none\"></div>
    <div style=\"position:absolute;bottom:-60px;left:20%;width:180px;height:180px;
                background:radial-gradient(circle,rgba(59,130,246,0.15) 0%,transparent 70%);
                border-radius:50%;pointer-events:none\"></div>

    <div style=\"padding:28px 28px 24px;position:relative\">

        {# Meta chips (keep readability colors, but category chip becomes blue) #}
        <div style=\"display:flex;flex-wrap:wrap;align-items:center;gap:6px;margin-bottom:16px\">
            {% if article.categorie %}
                <a href=\"{{ path('app_article_index', {categorie: article.categorie.id}) }}\"
                   style=\"font-size:10px;font-weight:800;padding:3px 12px;border-radius:30px;
                          background:rgba(96,165,250,0.15);color:#60a5fa;
                          text-decoration:none;letter-spacing:.04em;
                          border:1px solid rgba(96,165,250,0.3);transition:all .2s\"
                   class=\"cat-chip\">
                    {{ article.categorie.nom }}
                </a>
            {% endif %}
            {% if article.readability %}
                {% set rmap = {'Easy':'rgba(34,197,94,.15)|#4ade80','Medium':'rgba(245,158,11,.15)|#fbbf24','Advanced':'rgba(239,68,68,.15)|#f87171'} %}
                {% set rp = rmap[article.readability]|default('rgba(255,255,255,.1)|rgba(255,255,255,.6)')|split('|') %}
                <span style=\"font-size:10px;font-weight:800;padding:3px 12px;border-radius:30px;
                              background:{{ rp[0] }};color:{{ rp[1] }};
                              border:1px solid {{ rp[1] }}33\">
                    {{ article.readability }}
                </span>
            {% endif %}
            {% set wc = article.contenu|striptags|split(' ')|length %}
            {% set rt = (wc / 200)|round(0,'ceil') %}
            <span style=\"font-size:10px;font-weight:700;padding:3px 10px;border-radius:30px;
                          background:rgba(255,255,255,0.08);color:rgba(255,255,255,0.5);
                          display:flex;align-items:center;gap:4px\">
                <span class=\"material-symbols-outlined\" style=\"font-size:11px\">schedule</span>
                {{ rt }} min read
            </span>
            <span id=\"completed-badge\"
                  style=\"display:none;font-size:10px;font-weight:800;padding:3px 10px;
                         border-radius:30px;background:rgba(34,197,94,0.2);
                         color:#4ade80;align-items:center;gap:3px;
                         border:1px solid rgba(74,222,128,0.3)\">
                <span class=\"material-symbols-outlined\" style=\"font-size:11px\">check_circle</span>
                Read
            </span>
            <span style=\"margin-left:auto;font-size:11px;color:rgba(255,255,255,0.35);
                          display:flex;align-items:center;gap:4px;font-weight:600\">
                <span class=\"material-symbols-outlined\" style=\"font-size:12px\">calendar_today</span>
                {{ article.datePublication ? article.datePublication|date('d/m/Y') : '—' }}
            </span>
        </div>

        {# Title #}
        <h1 id=\"article-title\"
            style=\"font-family:var(--serif);font-size:clamp(1.4rem,3.5vw,2rem);
                   font-weight:400;color:#f0f6ff;letter-spacing:-.01em;
                   line-height:1.2;margin:0 0 16px;font-style:italic\">
            {{ article.titre }}
        </h1>

        {# Author (blue accent) #}
        {% if article.auteur %}
            <div style=\"display:flex;align-items:center;gap:8px\">
                <div style=\"width:28px;height:28px;border-radius:50%;
                            background:linear-gradient(135deg,rgba(96,165,250,0.3),rgba(96,165,250,0.1));
                            border:1px solid rgba(96,165,250,0.3);
                            display:flex;align-items:center;justify-content:center;
                            font-size:9px;font-weight:800;color:#60a5fa;flex-shrink:0;overflow:hidden\">
                    {% if article.auteur.profilePictureUrl is defined and article.auteur.profilePictureUrl %}
                        <img src=\"{{ article.auteur.profilePictureUrl }}\"
                             style=\"width:100%;height:100%;object-fit:cover\" alt=\"\">
                    {% else %}
                        {{ article.auteur.firstName|first|upper }}{{ article.auteur.lastName|first|upper }}
                    {% endif %}
                </div>
                <span style=\"font-size:12px;color:rgba(240,246,255,0.5);font-weight:600\">
                    {{ article.auteur.firstName }} {{ article.auteur.lastName }}
                </span>
            </div>
        {% endif %}
    </div>

    {# Ambient sound (blue) #}
    {% if ambientSound and ambientSound.audio %}
        <div style=\"margin:0 28px 24px;padding:12px 16px;
                    background:rgba(96,165,250,0.1);border-radius:14px;
                    border:1px solid rgba(96,165,250,0.25);
                    display:flex;align-items:center;gap:10px\">
            <span class=\"material-symbols-outlined\" style=\"font-size:18px;color:#60a5fa;flex-shrink:0\">
                music_note
            </span>
            <div style=\"flex:1;min-width:0\">
                <p style=\"font-size:9px;font-weight:800;color:#60a5fa;
                           text-transform:uppercase;letter-spacing:.1em;margin:0 0 4px\">
                    Focus Sounds · {{ ambientSound.title|default('Ambient') }}
                </p>
                <audio controls style=\"width:100%;height:24px\">
                    <source src=\"{{ ambientSound.audio }}\" type=\"audio/mpeg\">
                </audio>
            </div>
        </div>
    {% endif %}
</div>

    {# ══ AI INSIGHTS (blue instead of purple) ══ #}
    {% if aiAnalysis %}
        <div style=\"background:white;border-radius:20px;
                    border:1.5px solid rgba(96,165,250,0.2);
                    overflow:hidden;margin-bottom:16px;
                    box-shadow:0 4px 20px rgba(96,165,250,0.06)\"
             class=\"art-fade\" data-d=\".14\">
            <div style=\"display:flex;align-items:center;gap:8px;
                        padding:12px 18px;
                        background:linear-gradient(135deg,rgba(96,165,250,0.06),rgba(96,165,250,0.02));
                        border-bottom:1px solid rgba(96,165,250,0.1)\">
                <span style=\"font-size:16px\">✨</span>
                <span style=\"font-size:10px;font-weight:800;color:#2563eb;
                              text-transform:uppercase;letter-spacing:.14em\">AI Insights</span>
                <span style=\"margin-left:auto;font-size:9px;color:#60a5fa;font-weight:600\">
                    DistilRoBERTa · Local Model
                </span>
            </div>
            <div style=\"padding:16px 18px;display:grid;gap:16px;
                        grid-template-columns:1fr{% if aiAnalysis.key_points|length > 0 %} 1fr{% endif %}\">
                {% if aiAnalysis.emotions|length > 0 %}
                    <div>
                        <p style=\"font-size:9px;font-weight:800;color:#3b82f6;
                                   text-transform:uppercase;letter-spacing:.12em;margin:0 0 10px\">
                            Emotional Tone
                        </p>
                        <div style=\"display:flex;flex-direction:column;gap:8px\">
                            {% for emotion in aiAnalysis.emotions %}
                                <div style=\"display:flex;align-items:center;gap:8px\">
                                    <span style=\"font-size:14px;width:20px;text-align:center;flex-shrink:0\">{{ emotion.emoji }}</span>
                                    <span style=\"font-size:11px;font-weight:700;color:#334155;
                                                  width:70px;flex-shrink:0\">{{ emotion.label }}</span>
                                    <div style=\"flex:1;background:#f1f5f9;border-radius:99px;height:6px\">
                                        <div class=\"ebar\" data-w=\"{{ emotion.score }}\"
                                             style=\"height:6px;border-radius:99px;width:0%;
                                                    background:{{ emotion.color }};
                                                    transition:width .8s cubic-bezier(.4,0,.2,1);
                                                    box-shadow:0 0 6px {{ emotion.color }}44\"></div>
                                    </div>
                                    <span style=\"font-size:10px;font-weight:800;color:#64748b;
                                                  width:30px;text-align:right;flex-shrink:0\">
                                        {{ emotion.score }}%
                                    </span>
                                </div>
                            {% endfor %}
                        </div>
                    </div>
                {% endif %}
                {% if aiAnalysis.key_points|length > 0 %}
                    <div style=\"border-left:1px solid #f1f5f9;padding-left:16px\">
                        <p style=\"font-size:9px;font-weight:800;color:#3b82f6;
                                   text-transform:uppercase;letter-spacing:.12em;margin:0 0 10px\">
                            Key Takeaways
                        </p>
                        <ul style=\"list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:6px\">
                            {% for point in aiAnalysis.key_points %}
                                <li style=\"display:flex;align-items:flex-start;gap:7px;
                                           font-size:12px;color:#475569;line-height:1.5\">
                                    <span style=\"width:5px;height:5px;border-radius:50%;
                                                  background:#60a5fa;flex-shrink:0;margin-top:5px\"></span>
                                    {{ point }}
                                </li>
                            {% endfor %}
                        </ul>
                    </div>
                {% endif %}
            </div>
        </div>
    {% endif %}

    {# ══ ARTICLE BODY CARD (blue notes pad) ══ #}
    <div style=\"background:white;border-radius:24px;border:1.5px solid rgba(0,0,0,0.07);
                padding:28px;margin-bottom:16px;
                box-shadow:0 2px 12px rgba(0,0,0,0.05)\"
         class=\"art-fade\" data-d=\".16\">

        {# Notes pad – now blue themed #}
        <details style=\"background:#eff6ff;border:1.5px solid rgba(59,130,246,0.25);
                        border-radius:16px;overflow:hidden;margin-bottom:20px\">
            <summary style=\"display:flex;align-items:center;gap:8px;
                            padding:11px 16px;cursor:pointer;list-style:none;
                            font-size:12px;font-weight:800;color:#1e40af;
                            user-select:none;transition:background .2s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">edit_note</span>
                My Notes
                <span style=\"margin-left:auto;font-size:10px;font-weight:500;color:#3b82f6\">
                    Saved locally
                </span>
                <span class=\"material-symbols-outlined\" style=\"font-size:16px\" id=\"notes-chevron\">expand_more</span>
            </summary>
            <div style=\"padding:4px 16px 14px\">
                <textarea id=\"article-notes\"
                          style=\"width:100%;height:80px;font-size:12px;color:#334155;
                                 background:white;border:1.5px solid rgba(59,130,246,0.2);
                                 border-radius:12px;padding:10px;resize:none;
                                 outline:none;font-family:var(--sans);line-height:1.5;
                                 transition:border-color .2s;box-sizing:border-box\"
                          placeholder=\"Jot down your thoughts…\"></textarea>
                <div style=\"display:flex;align-items:center;gap:8px;margin-top:8px\">
                    <button onclick=\"saveNote()\"
                            style=\"font-size:11px;font-weight:800;padding:5px 16px;border-radius:9px;
                                   background:#3b82f6;color:white;border:none;cursor:pointer;
                                   font-family:var(--sans);transition:all .2s\">Save</button>
                    <button onclick=\"clearNote()\"
                            style=\"font-size:11px;font-weight:700;padding:5px 12px;border-radius:9px;
                                   background:none;color:#2563eb;border:1.5px solid rgba(59,130,246,0.3);
                                   cursor:pointer;font-family:var(--sans);transition:all .2s\">Clear</button>
                    <span id=\"note-saved\"
                          style=\"display:none;font-size:11px;font-weight:700;color:#16a34a;
                                 align-items:center;gap:4px\">
                        <span class=\"material-symbols-outlined\" style=\"font-size:13px\">check</span> Saved!
                    </span>
                </div>
            </div>
        </details>

        {# Article body text #}
        <div id=\"article-body\"
             style=\"font-size:14px;color:#334155;line-height:1.85;
                    white-space:pre-line;font-weight:400\">
            {{ article.contenu }}
        </div>

        {# Tags (blue hover) #}
        {% if article.tags|length > 0 %}
            <div style=\"display:flex;flex-wrap:wrap;align-items:center;gap:6px;
                        padding-top:16px;margin-top:16px;border-top:1px solid #f1f5f9\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px;color:#94a3b8\">label</span>
                {% for tag in article.tags %}
                    <a href=\"{{ path('app_article_by_tag', {tagName: tag.nom}) }}\"
                       style=\"font-size:11px;font-weight:700;
                              padding:3px 10px;border-radius:30px;
                              background:#f1f5f9;color:#64748b;text-decoration:none;
                              border:1px solid #e2e8f0;transition:all .2s\" class=\"tag-chip\">
                        #{{ tag.nom }}
                    </a>
                {% endfor %}
            </div>
        {% endif %}
    </div>

    {# ══ WIKIPEDIA (blue) ══ #}
    {% if wikiSummary %}
        <details style=\"background:#eff6ff;border:1.5px solid rgba(59,130,246,0.2);
                        border-radius:18px;overflow:hidden;margin-bottom:16px\"
                 class=\"art-fade\" data-d=\".18\">
            <summary style=\"display:flex;align-items:center;gap:8px;padding:12px 18px;
                            cursor:pointer;list-style:none;font-size:12px;
                            font-weight:800;color:#1e40af;user-select:none;transition:background .2s\">
                <svg style=\"width:15px;height:15px;flex-shrink:0\" viewBox=\"0 0 24 24\" fill=\"currentColor\">
                    <path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z\"/>
                </svg>
                Wikipedia: {{ wikiSummary.title }}
                <span class=\"material-symbols-outlined\"
                      style=\"font-size:16px;margin-left:auto;transition:transform .2s\"
                      id=\"wiki-chevron\">expand_more</span>
            </summary>
            <div style=\"padding:4px 18px 16px\">
                <p style=\"font-size:12px;color:#1e3a5f;line-height:1.7;margin:0 0 8px\">
                    {{ wikiSummary.extract }}
                </p>
                <a href=\"{{ wikiSummary.url }}\" target=\"_blank\" rel=\"noopener\"
                   style=\"font-size:11px;font-weight:800;color:#2563eb;
                          text-decoration:none;display:inline-flex;align-items:center;gap:4px\">
                    Read on Wikipedia
                    <span class=\"material-symbols-outlined\" style=\"font-size:12px\">open_in_new</span>
                </a>
            </div>
        </details>
    {% endif %}

    {# ══ BOOK RECOMMENDATIONS (blue) ══ #}
    {% if bookRecommendations|length > 0 %}
        <div style=\"margin-bottom:16px\" class=\"art-fade\" data-d=\".2\">
            <h3 style=\"font-size:10px;font-weight:800;color:#94a3b8;
                        text-transform:uppercase;letter-spacing:.14em;
                        margin:0 0 10px;display:flex;align-items:center;gap:6px\">
                <span class=\"material-symbols-outlined\" style=\"font-size:14px\">menu_book</span>
                Related Books · OpenLibrary
            </h3>
            <div style=\"display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:10px\">
                {% for book in bookRecommendations %}
                    <a href=\"{{ book.url }}\" target=\"_blank\" rel=\"noopener\"
                       style=\"background:white;border-radius:14px;padding:12px;
                              border:1.5px solid rgba(0,0,0,0.07);text-decoration:none;
                              display:flex;gap:10px;align-items:flex-start;
                              transition:all .2s\" class=\"book-card\">
                        {% if book.cover %}
                            <img src=\"{{ book.cover }}\" alt=\"{{ book.title }}\"
                                 style=\"width:36px;height:52px;object-fit:cover;
                                        border-radius:5px;flex-shrink:0;
                                        box-shadow:0 2px 8px rgba(0,0,0,0.12)\">
                        {% else %}
                            <div style=\"width:36px;height:52px;border-radius:5px;
                                        background:rgba(96,165,250,0.1);flex-shrink:0;
                                        display:flex;align-items:center;justify-content:center\">
                                <span class=\"material-symbols-outlined\" style=\"font-size:18px;color:#3b82f6\">book</span>
                            </div>
                        {% endif %}
                        <div style=\"flex:1;min-width:0\">
                            <p style=\"font-size:11px;font-weight:700;color:#1e293b;
                                       margin:0 0 3px;line-height:1.3;
                                       display:-webkit-box;-webkit-line-clamp:2;
                                       -webkit-box-orient:vertical;overflow:hidden\">
                                {{ book.title }}
                            </p>
                            <p style=\"font-size:10px;color:#94a3b8;margin:0\">{{ book.author }}</p>
                            {% if book.year %}
                                <p style=\"font-size:9px;color:#cbd5e1;margin:2px 0 0\">{{ book.year }}</p>
                            {% endif %}
                        </div>
                    </a>
                {% endfor %}
            </div>
        </div>
    {% endif %}

    {# ══ NEXT STEP (blue) ══ #}
    {% if nextStep %}
        <div style=\"background:linear-gradient(135deg,rgba(96,165,250,0.08),rgba(96,165,250,0.03));
                    border:1.5px solid rgba(96,165,250,0.2);border-radius:20px;
                    padding:18px 20px;display:flex;align-items:center;
                    justify-content:space-between;gap:16px;margin-bottom:16px\"
             class=\"art-fade\" data-d=\".22\">
            <div>
                <p style=\"font-size:9px;font-weight:800;color:#3b82f6;
                           text-transform:uppercase;letter-spacing:.14em;margin:0 0 4px\">
                    Continue Learning
                </p>
                <p style=\"font-size:13px;font-weight:700;color:#1e293b;margin:0 0 2px;
                           overflow:hidden;white-space:nowrap;text-overflow:ellipsis;max-width:380px\">
                    {{ nextStep.article.titre }}
                </p>
                <p style=\"font-size:11px;color:#94a3b8;margin:0\">
                    Step {{ nextStep.articleOrder }} / {{ totalSteps }}
                </p>
            </div>
            <a href=\"{{ path('app_article_show', {id: nextStep.article.id}) }}\"
               style=\"flex-shrink:0;display:inline-flex;align-items:center;gap:6px;
                      padding:10px 20px;border-radius:14px;
                      background:linear-gradient(135deg,#60a5fa,#3b82f6);
                      color:#0d1b2a;font-size:12px;font-weight:800;
                      text-decoration:none;white-space:nowrap;
                      box-shadow:0 4px 16px rgba(96,165,250,0.3);
                      transition:all .2s\" class=\"next-btn\">
                Next
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">arrow_forward</span>
            </a>
        </div>
    {% endif %}

    {# ══ RELATED ARTICLES (blue) ══ #}
    {% if relatedArticles|length > 0 %}
        <div style=\"margin-bottom:16px\" class=\"art-fade\" data-d=\".24\">
            <h2 style=\"font-size:10px;font-weight:800;color:#94a3b8;
                        text-transform:uppercase;letter-spacing:.14em;
                        margin:0 0 10px;display:flex;align-items:center;gap:6px\">
                <span class=\"material-symbols-outlined\" style=\"font-size:14px\">recommend</span>
                You might also like
            </h2>
            <div style=\"display:flex;flex-direction:column;gap:8px\">
                {% for related in relatedArticles %}
                    <a href=\"{{ path('app_article_show', {id: related.id}) }}\"
                       style=\"display:flex;align-items:center;gap:12px;
                              background:white;border-radius:16px;
                              border:1.5px solid rgba(0,0,0,0.07);
                              padding:12px 16px;text-decoration:none;
                              transition:all .22s\" class=\"rel-card\">
                        <div style=\"width:36px;height:36px;border-radius:11px;
                                    background:rgba(96,165,250,0.08);flex-shrink:0;
                                    display:flex;align-items:center;justify-content:center\">
                            <span class=\"material-symbols-outlined\" style=\"font-size:16px;color:#3b82f6\">article</span>
                        </div>
                        <div style=\"flex:1;min-width:0\">
                            <p style=\"font-size:13px;font-weight:700;color:#1e293b;margin:0 0 2px;
                                       overflow:hidden;white-space:nowrap;text-overflow:ellipsis\">
                                {{ related.titre }}
                            </p>
                            <p style=\"font-size:11px;color:#94a3b8;margin:0;
                                       overflow:hidden;white-space:nowrap;text-overflow:ellipsis\">
                                {{ related.contenu|striptags|slice(0,65) }}…
                            </p>
                        </div>
                        {% if related.categorie %}
                            <span style=\"font-size:10px;font-weight:800;flex-shrink:0;
                                          padding:2px 8px;border-radius:20px;
                                          background:rgba(96,165,250,0.1);color:#3b82f6\">
                                {{ related.categorie.nom }}
                            </span>
                        {% endif %}
                        <span class=\"material-symbols-outlined rel-arrow\"
                              style=\"font-size:16px;color:#cbd5e1;flex-shrink:0;transition:all .2s\">
                            arrow_forward
                        </span>
                    </a>
                {% endfor %}
            </div>
        </div>
    {% endif %}

    {# ══ ACTION BAR (blue) ══ #}
    <div style=\"display:flex;align-items:center;justify-content:space-between;
                flex-wrap:wrap;gap:10px;
                padding-top:16px;border-top:1px solid #f1f5f9\"
         class=\"art-fade\" data-d=\".28\">
        <a href=\"{{ path('app_article_index') }}\"
           style=\"display:inline-flex;align-items:center;gap:6px;
                  font-size:13px;font-weight:700;color:#64748b;
                  text-decoration:none;transition:color .2s\" class=\"back-lnk\">
            <span class=\"material-symbols-outlined\" style=\"font-size:15px\">arrow_back</span> Back
        </a>
        <div style=\"display:flex;align-items:center;gap:8px;flex-wrap:wrap\">

            {# Share buttons (blue hover) #}
            {% set shareUrl = url('app_article_show', {id: article.id}) %}
            {% set shareText = article.titre|url_encode %}
            <a href=\"https://twitter.com/intent/tweet?text={{ shareText }}&url={{ shareUrl|url_encode }}\"
               target=\"_blank\" rel=\"noopener\"
               style=\"padding:8px 14px;border-radius:11px;border:1.5px solid #e2e8f0;
                      background:white;color:#64748b;font-size:12px;font-weight:700;
                      text-decoration:none;display:flex;align-items:center;gap:5px;
                      transition:all .2s;font-family:var(--sans)\" class=\"share-btn\">
                <svg style=\"width:13px;height:13px\" fill=\"currentColor\" viewBox=\"0 0 24 24\">
                    <path d=\"M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z\"/>
                </svg>
                Share
            </a>

            <a href=\"{{ path('app_article_pdf', {id: article.id}) }}\"
               style=\"padding:8px 14px;border-radius:11px;border:1.5px solid #e2e8f0;
                      background:white;color:#64748b;font-size:12px;font-weight:700;
                      text-decoration:none;display:flex;align-items:center;gap:5px;
                      transition:all .2s;font-family:var(--sans)\" class=\"share-btn\">
                <span class=\"material-symbols-outlined\" style=\"font-size:14px\">picture_as_pdf</span>
                PDF
            </a>

            {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
                <a href=\"{{ path('app_article_edit', {id: article.id}) }}\"
                   style=\"padding:8px 14px;border-radius:11px;border:1.5px solid #e2e8f0;
                          background:white;color:#64748b;font-size:12px;font-weight:700;
                          text-decoration:none;display:flex;align-items:center;gap:5px;
                          transition:all .2s;font-family:var(--sans)\" class=\"share-btn\">
                    <span class=\"material-symbols-outlined\" style=\"font-size:14px\">edit</span>
                    Edit
                </a>
                <form method=\"post\" action=\"{{ path('app_article_delete', {id: article.id}) }}\"
                      onsubmit=\"return confirm('Permanently delete this article?')\"
                      style=\"display:flex;margin:0\">
                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ article.id) }}\">
                    <button style=\"padding:8px 14px;border-radius:11px;
                                   border:1.5px solid rgba(239,68,68,0.25);
                                   background:white;color:#ef4444;font-size:12px;font-weight:700;
                                   cursor:pointer;display:flex;align-items:center;gap:5px;
                                   transition:all .2s;font-family:var(--sans)\" class=\"del-btn\">
                        <span class=\"material-symbols-outlined\" style=\"font-size:14px\">delete</span>
                        Delete
                    </button>
                </form>
            {% endif %}
        </div>
    </div>

</div>{# /show-page #}

<style>
/* ── Animations ── */
@keyframes artFadeUp {
    from{opacity:0;transform:translateY(16px)}
    to  {opacity:1;transform:translateY(0)}
}
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.4} }

.art-fade {
    opacity:0;
    animation:artFadeUp .45s cubic-bezier(.4,0,.2,1) forwards;
    animation-delay:var(--d,.1s);
}

/* ── Floating tool buttons (blue hover) ── */
.ftool:hover { background:#0d1b2a !important; color:#60a5fa !important; transform:scale(1.08); box-shadow:0 4px 16px rgba(96,165,250,.2) !important; }
.ftool:hover .ftip { opacity:1 !important; }

/* ── Breadcrumb ── */
.bc-link:hover { color:#3b82f6 !important; }

/* ── Category chip ── */
.cat-chip:hover { background:rgba(96,165,250,0.3) !important; border-color:rgba(96,165,250,0.5) !important; }

/* ── Tag chips ── */
.tag-chip:hover { background:rgba(96,165,250,0.1) !important; color:#3b82f6 !important; border-color:rgba(96,165,250,0.3) !important; }

/* ── Related cards ── */
.rel-card:hover { border-color:rgba(96,165,250,0.3) !important; box-shadow:0 6px 24px rgba(96,165,250,0.1) !important; transform:translateX(4px); }
.rel-card:hover .rel-arrow { color:#3b82f6 !important; transform:translateX(3px); }

/* ── Book cards ── */
.book-card:hover { border-color:rgba(96,165,250,0.3) !important; box-shadow:0 4px 16px rgba(96,165,250,0.1) !important; transform:translateY(-2px); }

/* ── Share / action buttons ── */
.share-btn:hover { border-color:rgba(96,165,250,0.3) !important; color:#3b82f6 !important; background:#eff6ff !important; }
.del-btn:hover { background:#fef2f2 !important; }

/* ── Next button ── */
.next-btn:hover { box-shadow:0 6px 24px rgba(96,165,250,0.4) !important; transform:translateY(-1px); }
.next-btn:hover .material-symbols-outlined { transform:translateX(3px); }
.next-btn .material-symbols-outlined { transition:transform .2s; }

/* ── Mood buttons (blue hover) ── */
.mood-btn:hover { background:#0d1b2a !important; color:#60a5fa !important; border-color:#0d1b2a !important; }

/* ── Back link ── */
.back-lnk:hover { color:#3b82f6 !important; }

/* ── Step dots (blue) ── */
.step-dot.done    { background:#3b82f6 !important; box-shadow:0 0 0 2px rgba(96,165,250,0.2); }
.step-dot.current { background:#2563eb !important; box-shadow:0 0 0 2px rgba(59,130,246,0.3); }

/* ── Print ── */
@media print {
    #float-toolbar,#reading-progress-bar,#tts-bar,#mood-toast { display:none !important; }
    .art-fade { opacity:1 !important; animation:none !important; }
}
</style>

<script>
const ARTICLE_ID = '{{ article.id }}';
const NOTE_KEY   = 'article_note_'  + ARTICLE_ID;
const READ_KEY   = 'article_read_'  + ARTICLE_ID;
const MOOD_KEY   = 'mood_shown_'    + ARTICLE_ID;
const READ_ARTS  = 'read_articles';

/* ── Staggered fade-up via data-d attribute ── */
document.querySelectorAll('.art-fade[data-d]').forEach(el => {
    el.style.animationDelay = el.dataset.d + 's';
});

/* ── Reading progress ── */
window.addEventListener('scroll', () => {
    const body=document.body, html=document.documentElement;
    const total=Math.max(body.scrollHeight,html.scrollHeight)-window.innerHeight;
    const pct=total>0?(window.scrollY/total)*100:0;
    document.getElementById('reading-progress-bar').style.width=pct+'%';
    if(pct>=80) markAsRead();
});

function markAsRead(){
    if(localStorage.getItem(READ_KEY)) return;
    localStorage.setItem(READ_KEY,'1');
    const b=document.getElementById('completed-badge');
    if(b){ b.style.display='inline-flex'; }
    let rs=JSON.parse(localStorage.getItem(READ_ARTS)||'[]');
    if(!rs.includes(ARTICLE_ID)){ rs.push(ARTICLE_ID); localStorage.setItem(READ_ARTS,JSON.stringify(rs)); }
}

/* ── Notes ── */
function saveNote(){
    const ta=document.getElementById('article-notes');
    if(ta) localStorage.setItem(NOTE_KEY,ta.value);
    const s=document.getElementById('note-saved');
    if(s){ s.style.display='flex'; setTimeout(()=>s.style.display='none',2000); }
}
function clearNote(){
    const ta=document.getElementById('article-notes');
    if(ta) ta.value='';
    localStorage.removeItem(NOTE_KEY);
}

/* ── TTS ── */
let ttsU=null, ttsPaused=false, ttsRate=1;
function toggleTTS(){
    if(window.speechSynthesis.speaking&&!ttsPaused){ pauseTTS(); return; }
    if(ttsPaused){ window.speechSynthesis.resume(); ttsPaused=false; setTTSUI(true); return; }
    const title=document.getElementById('article-title')?.textContent.trim()||'';
    const body=document.getElementById('article-body')?.textContent.trim()||'';
    ttsU=new SpeechSynthesisUtterance(title+'. '+body);
    ttsU.rate=ttsRate; ttsU.onend=stopTTS; ttsU.onerror=stopTTS;
    window.speechSynthesis.speak(ttsU); setTTSUI(true);
}
function pauseTTS(){
    window.speechSynthesis.pause(); ttsPaused=true;
    document.getElementById('tts-pause-icon').textContent='play_arrow';
    document.getElementById('tts-pause-label').textContent='Resume';
}
function stopTTS(){
    window.speechSynthesis.cancel(); ttsPaused=false; setTTSUI(false);
    document.getElementById('tts-pause-icon').textContent='pause';
    document.getElementById('tts-pause-label').textContent='Pause';
}
function setTTSUI(on){
    document.getElementById('tts-bar').style.transform=on?'translateY(0)':'translateY(100%)';
    document.getElementById('tts-icon').textContent=on?'volume_off':'volume_up';
}
function updateTTSRate(v){
    ttsRate=parseFloat(v);
    document.getElementById('tts-rate-label').textContent=ttsRate+'×';
}

/* ── Copy link ── */
function copyLink(){
    navigator.clipboard.writeText(window.location.href).then(()=>{
        const i=document.getElementById('copy-icon');
        i.textContent='check';
        setTimeout(()=>i.textContent='link',2000);
    });
}

/* ── Mood toast ── */
function showMoodToast(){
    const t=document.getElementById('mood-toast');
    if(t){ t.style.opacity='1'; t.style.pointerEvents='auto'; t.style.transform='translateX(-50%) scale(1)'; }
}
function dismissMood(){
    const t=document.getElementById('mood-toast');
    if(t){ t.style.opacity='0'; t.style.pointerEvents='none'; t.style.transform='translateX(-50%) scale(.95)'; }
    localStorage.setItem(MOOD_KEY,'1');
}
function saveMood(emoji,label){
    const log=JSON.parse(localStorage.getItem('mood_log')||'[]');
    log.push({article:ARTICLE_ID,mood:label,emoji,date:new Date().toISOString()});
    localStorage.setItem('mood_log',JSON.stringify(log));
    dismissMood();
    const t=document.createElement('div');
    t.style.cssText='position:fixed;bottom:80px;left:50%;transform:translateX(-50%);z-index:60;background:#059669;color:white;font-size:13px;font-weight:800;padding:10px 20px;border-radius:14px;box-shadow:0 4px 20px rgba(5,150,105,.3);font-family:var(--sans)';
    t.textContent=emoji+' Mood logged!';
    document.body.appendChild(t);
    setTimeout(()=>t.remove(),2200);
}

/* ── Init ── */
document.addEventListener('DOMContentLoaded',()=>{
    if(localStorage.getItem(READ_KEY)){
        const b=document.getElementById('completed-badge'); if(b) b.style.display='inline-flex';
    }
    const saved=localStorage.getItem(NOTE_KEY);
    if(saved){ const ta=document.getElementById('article-notes'); if(ta) ta.value=saved; }

    setTimeout(()=>{
        document.querySelectorAll('.ebar').forEach(b=>b.style.width=b.dataset.w+'%');
    },500);

    const cs={{ currentStep ?? 'null' }};
    if(cs){ document.querySelectorAll('.step-dot').forEach(d=>{
        const s=parseInt(d.dataset.step);
        if(s<cs) d.classList.add('done'); else if(s===cs) d.classList.add('current');
    }); }

    if(!localStorage.getItem(MOOD_KEY)) setTimeout(showMoodToast,4000);
});
</script>

{% endblock %}", "article/show.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\article\\show.html.twig");
    }
}
