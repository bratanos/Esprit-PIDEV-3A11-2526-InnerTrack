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

/* layouts/auth.html.twig */
class __TwigTemplate_43b8e77d457157db67d39295aecf7078 extends Template
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
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "layouts/auth.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "layouts/auth.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\"/>
    <meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\"/>
    <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    
    <!-- Stitch AI Design System injected natively via CDN for perfect fidelity isolated to authentication -->
    <script src=\"https://cdn.tailwindcss.com?plugins=forms,container-queries\"></script>
    <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@600;700;800&display=swap\" rel=\"stylesheet\"/>
    <link href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap\" rel=\"stylesheet\"/>
    <script id=\"tailwind-config\">
        tailwind.config = {
            darkMode: \"class\",
            theme: {
                extend: {
                    colors: {
                        \"on-primary-fixed-variant\": \"#3323cc\",
                        \"on-secondary-container\": \"#006f66\",
                        \"secondary-fixed\": \"#89f5e7\",
                        \"inverse-surface\": \"#233144\",
                        \"primary-container\": \"#4f46e5\",
                        \"surface-dim\": \"#ccdbf3\",
                        \"surface-container-lowest\": \"#ffffff\",
                        \"secondary-fixed-dim\": \"#6bd8cb\",
                        \"on-secondary-fixed-variant\": \"#005049\",
                        \"on-primary\": \"#ffffff\",
                        \"surface-bright\": \"#f8f9ff\",
                        \"on-tertiary\": \"#ffffff\",
                        \"error-container\": \"#ffdad6\",
                        \"outline-variant\": \"#c7c4d8\",
                        \"on-background\": \"#0d1c2e\",
                        \"tertiary-container\": \"#576361\",
                        \"surface-tint\": \"#4d44e3\",
                        \"on-primary-container\": \"#dad7ff\",
                        \"on-error-container\": \"#93000a\",
                        \"inverse-primary\": \"#c3c0ff\",
                        \"on-tertiary-container\": \"#d2dedc\",
                        \"error\": \"#ba1a1a\",
                        \"background\": \"#f8f9ff\",
                        \"surface-container-low\": \"#eff4ff\",
                        \"on-tertiary-fixed-variant\": \"#3d4947\",
                        \"surface-variant\": \"#d5e3fc\",
                        \"on-secondary\": \"#ffffff\",
                        \"primary\": \"#3525cd\",
                        \"on-surface-variant\": \"#464555\",
                        \"tertiary-fixed\": \"#d8e5e2\",
                        \"surface-container-high\": \"#dce9ff\",
                        \"inverse-on-surface\": \"#eaf1ff\",
                        \"surface-container\": \"#e6eeff\",
                        \"primary-fixed-dim\": \"#c3c0ff\",
                        \"on-error\": \"#ffffff\",
                        \"surface\": \"#f8f9ff\",
                        \"on-primary-fixed\": \"#0f0069\",
                        \"secondary-container\": \"#86f2e4\",
                        \"tertiary-fixed-dim\": \"#bcc9c6\",
                        \"surface-container-highest\": \"#d5e3fc\",
                        \"on-tertiary-fixed\": \"#121e1c\",
                        \"secondary\": \"#006a61\",
                        \"on-secondary-fixed\": \"#00201d\",
                        \"on-surface\": \"#0d1c2e\",
                        \"tertiary\": \"#3f4b49\",
                        \"outline\": \"#777587\",
                        \"primary-fixed\": \"#e2dfff\"
                    },
                    fontFamily: {
                        \"headline\": [\"Manrope\"],
                        \"body\": [\"Inter\"],
                        \"label\": [\"Inter\"]
                    },
                    borderRadius: {\"DEFAULT\": \"0.25rem\", \"lg\": \"1rem\", \"xl\": \"1.5rem\", \"full\": \"9999px\"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .sanctuary-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #006a61 100%);
        }
    </style>
</head>
<body class=\"bg-surface text-on-surface font-body antialiased selection:bg-secondary-container\">

<header class=\"fixed top-0 left-0 right-0 z-50 bg-[#f8f9ff]/70 backdrop-blur-xl border-b border-outline-variant/10\">
    <div class=\"flex justify-between items-center w-full px-8 py-6 max-w-7xl mx-auto\">
        <div class=\"text-2xl font-headline font-bold bg-gradient-to-br from-[#4f46e5] to-[#006a61] bg-clip-text text-transparent\">
            InnerTrack
        </div>
        <div class=\"flex items-center gap-4\">
            <button class=\"text-on-surface-variant hover:opacity-80 transition-opacity flex items-center gap-1\">
                <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"help_outline\">help_outline</span>
                <span class=\"text-sm font-medium hidden sm:inline\">Support</span>
            </button>
        </div>
    </div>
</header>

";
        // line 101
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 102
        yield "
<footer class=\"w-full py-12 px-8 flex flex-col md:flex-row justify-between items-center gap-6 bg-[#f8f9ff]\">
    <div class=\"text-on-surface-variant/50 font-body text-sm tracking-wide leading-relaxed\">
        © 2024 InnerTrack. Your Digital Sanctuary.
    </div>
    <div class=\"flex flex-wrap justify-center gap-8\">
        <a class=\"text-on-surface-variant/50 hover:text-[#4f46e5] transition-colors text-sm font-medium\" href=\"#\">Privacy Policy</a>
        <a class=\"text-on-surface-variant/50 hover:text-[#4f46e5] transition-colors text-sm font-medium\" href=\"#\">Terms of Service</a>
        <a class=\"text-on-surface-variant/50 hover:text-[#4f46e5] transition-colors text-sm font-medium\" href=\"#\">Contact Support</a>
    </div>
</footer>

</body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "InnerTrack";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 101
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layouts/auth.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  205 => 101,  182 => 6,  157 => 102,  155 => 101,  57 => 6,  50 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\"/>
    <meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\"/>
    <title>{% block title %}InnerTrack{% endblock %}</title>
    
    <!-- Stitch AI Design System injected natively via CDN for perfect fidelity isolated to authentication -->
    <script src=\"https://cdn.tailwindcss.com?plugins=forms,container-queries\"></script>
    <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@600;700;800&display=swap\" rel=\"stylesheet\"/>
    <link href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap\" rel=\"stylesheet\"/>
    <script id=\"tailwind-config\">
        tailwind.config = {
            darkMode: \"class\",
            theme: {
                extend: {
                    colors: {
                        \"on-primary-fixed-variant\": \"#3323cc\",
                        \"on-secondary-container\": \"#006f66\",
                        \"secondary-fixed\": \"#89f5e7\",
                        \"inverse-surface\": \"#233144\",
                        \"primary-container\": \"#4f46e5\",
                        \"surface-dim\": \"#ccdbf3\",
                        \"surface-container-lowest\": \"#ffffff\",
                        \"secondary-fixed-dim\": \"#6bd8cb\",
                        \"on-secondary-fixed-variant\": \"#005049\",
                        \"on-primary\": \"#ffffff\",
                        \"surface-bright\": \"#f8f9ff\",
                        \"on-tertiary\": \"#ffffff\",
                        \"error-container\": \"#ffdad6\",
                        \"outline-variant\": \"#c7c4d8\",
                        \"on-background\": \"#0d1c2e\",
                        \"tertiary-container\": \"#576361\",
                        \"surface-tint\": \"#4d44e3\",
                        \"on-primary-container\": \"#dad7ff\",
                        \"on-error-container\": \"#93000a\",
                        \"inverse-primary\": \"#c3c0ff\",
                        \"on-tertiary-container\": \"#d2dedc\",
                        \"error\": \"#ba1a1a\",
                        \"background\": \"#f8f9ff\",
                        \"surface-container-low\": \"#eff4ff\",
                        \"on-tertiary-fixed-variant\": \"#3d4947\",
                        \"surface-variant\": \"#d5e3fc\",
                        \"on-secondary\": \"#ffffff\",
                        \"primary\": \"#3525cd\",
                        \"on-surface-variant\": \"#464555\",
                        \"tertiary-fixed\": \"#d8e5e2\",
                        \"surface-container-high\": \"#dce9ff\",
                        \"inverse-on-surface\": \"#eaf1ff\",
                        \"surface-container\": \"#e6eeff\",
                        \"primary-fixed-dim\": \"#c3c0ff\",
                        \"on-error\": \"#ffffff\",
                        \"surface\": \"#f8f9ff\",
                        \"on-primary-fixed\": \"#0f0069\",
                        \"secondary-container\": \"#86f2e4\",
                        \"tertiary-fixed-dim\": \"#bcc9c6\",
                        \"surface-container-highest\": \"#d5e3fc\",
                        \"on-tertiary-fixed\": \"#121e1c\",
                        \"secondary\": \"#006a61\",
                        \"on-secondary-fixed\": \"#00201d\",
                        \"on-surface\": \"#0d1c2e\",
                        \"tertiary\": \"#3f4b49\",
                        \"outline\": \"#777587\",
                        \"primary-fixed\": \"#e2dfff\"
                    },
                    fontFamily: {
                        \"headline\": [\"Manrope\"],
                        \"body\": [\"Inter\"],
                        \"label\": [\"Inter\"]
                    },
                    borderRadius: {\"DEFAULT\": \"0.25rem\", \"lg\": \"1rem\", \"xl\": \"1.5rem\", \"full\": \"9999px\"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .sanctuary-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #006a61 100%);
        }
    </style>
</head>
<body class=\"bg-surface text-on-surface font-body antialiased selection:bg-secondary-container\">

<header class=\"fixed top-0 left-0 right-0 z-50 bg-[#f8f9ff]/70 backdrop-blur-xl border-b border-outline-variant/10\">
    <div class=\"flex justify-between items-center w-full px-8 py-6 max-w-7xl mx-auto\">
        <div class=\"text-2xl font-headline font-bold bg-gradient-to-br from-[#4f46e5] to-[#006a61] bg-clip-text text-transparent\">
            InnerTrack
        </div>
        <div class=\"flex items-center gap-4\">
            <button class=\"text-on-surface-variant hover:opacity-80 transition-opacity flex items-center gap-1\">
                <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"help_outline\">help_outline</span>
                <span class=\"text-sm font-medium hidden sm:inline\">Support</span>
            </button>
        </div>
    </div>
</header>

{% block body %}{% endblock %}

<footer class=\"w-full py-12 px-8 flex flex-col md:flex-row justify-between items-center gap-6 bg-[#f8f9ff]\">
    <div class=\"text-on-surface-variant/50 font-body text-sm tracking-wide leading-relaxed\">
        © 2024 InnerTrack. Your Digital Sanctuary.
    </div>
    <div class=\"flex flex-wrap justify-center gap-8\">
        <a class=\"text-on-surface-variant/50 hover:text-[#4f46e5] transition-colors text-sm font-medium\" href=\"#\">Privacy Policy</a>
        <a class=\"text-on-surface-variant/50 hover:text-[#4f46e5] transition-colors text-sm font-medium\" href=\"#\">Terms of Service</a>
        <a class=\"text-on-surface-variant/50 hover:text-[#4f46e5] transition-colors text-sm font-medium\" href=\"#\">Contact Support</a>
    </div>
</footer>

</body>
</html>
", "layouts/auth.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\layouts\\auth.html.twig");
    }
}
