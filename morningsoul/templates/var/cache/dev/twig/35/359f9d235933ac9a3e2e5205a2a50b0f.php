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

/* homepage/index.html.twig */
class __TwigTemplate_e77c1946d66220e730613e79ca0423cd extends Template
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
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "homepage/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "homepage/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
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

        // line 4
        yield "<!-- Conteneur principal de la page -->
<div class=\"ms-site-wrapper d-flex flex-column min-vh-100\">
  <main class=\"container mt-5 ms-content-wrap flex-grow-1\">
    
    <!-- Conteneur Texte + Intro -->
    <div class=\"text-center mb-5\">
      <h1 class=\"ms-home-header\">Morning Soul - Jeu Indépendant</h1>
      <p class=\"lead ms-home-intro\">- Un espace communautaire pour suivre l’évolution du projet -</p>
      <p class=\"ms-home-intro-scnd\">Chaque âme a son histoire...</p>
    </div>

    <div class=\"row\">

      <!-- Support & Aide -->
      <div class=\"col-md-4 mb-4\">
        <div class=\"card h-100 ms-transparent-card\" style=\"animation-delay: 0.2s;\">
          <div class=\"card-body\">
            <h5 class=\"card-title ms-card-title-custom\">Support & Aide</h5>
            <p class=\"card-text ms-card-text-custom\">Des réponses à vos questions, des tutoriels et une équipe prête à vous aider.</p>
            <a href=\"";
        // line 23
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact.support");
        yield "\" class=\"btn ms-btn-custom\">Support</a>
          </div>
        </div>
      </div>

      <!-- Actualités & Devblogs -->
      <div class=\"col-md-4 mb-4\">
        <div class=\"card h-100 ms-transparent-card\" style=\"animation-delay: 0.4s;\">
          <div class=\"card-body\">
            <h5 class=\"card-title ms-card-title-custom\">Actualités & Devblogs</h5>
            <p class=\"card-text ms-card-text-custom\">Suivez l’évolution du projet, les changelogs et le devblog de l’équipe.</p>
            <a href=\"";
        // line 34
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("news.devblog");
        yield "\" class=\"btn ms-btn-custom\">Nouveautés</a>
          </div>
        </div>
      </div>

      <!-- Forum & Discussions -->
      <div class=\"col-md-4 mb-4\">
        <div class=\"card h-100 ms-transparent-card\" style=\"animation-delay: 0.6s;\">
          <div class=\"card-body\">
            <h5 class=\"card-title ms-card-title-custom\">Forum & Discussions</h5>
            <p class=\"card-text ms-card-text-custom\">Explorez les derniers sujets, participez aux débats ou posez vos questions.</p>
            <a href=\"/forum\" class=\"btn ms-btn-custom\">Accéder au Forum</a>
          </div>
        </div>
      </div>
    </div>
  </main>
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
        return "homepage/index.html.twig";
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
        return array (  111 => 34,  97 => 23,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{%  extends \"base.html.twig\" %}

{% block body %}
<!-- Conteneur principal de la page -->
<div class=\"ms-site-wrapper d-flex flex-column min-vh-100\">
  <main class=\"container mt-5 ms-content-wrap flex-grow-1\">
    
    <!-- Conteneur Texte + Intro -->
    <div class=\"text-center mb-5\">
      <h1 class=\"ms-home-header\">Morning Soul - Jeu Indépendant</h1>
      <p class=\"lead ms-home-intro\">- Un espace communautaire pour suivre l’évolution du projet -</p>
      <p class=\"ms-home-intro-scnd\">Chaque âme a son histoire...</p>
    </div>

    <div class=\"row\">

      <!-- Support & Aide -->
      <div class=\"col-md-4 mb-4\">
        <div class=\"card h-100 ms-transparent-card\" style=\"animation-delay: 0.2s;\">
          <div class=\"card-body\">
            <h5 class=\"card-title ms-card-title-custom\">Support & Aide</h5>
            <p class=\"card-text ms-card-text-custom\">Des réponses à vos questions, des tutoriels et une équipe prête à vous aider.</p>
            <a href=\"{{ path('contact.support') }}\" class=\"btn ms-btn-custom\">Support</a>
          </div>
        </div>
      </div>

      <!-- Actualités & Devblogs -->
      <div class=\"col-md-4 mb-4\">
        <div class=\"card h-100 ms-transparent-card\" style=\"animation-delay: 0.4s;\">
          <div class=\"card-body\">
            <h5 class=\"card-title ms-card-title-custom\">Actualités & Devblogs</h5>
            <p class=\"card-text ms-card-text-custom\">Suivez l’évolution du projet, les changelogs et le devblog de l’équipe.</p>
            <a href=\"{{ path('news.devblog') }}\" class=\"btn ms-btn-custom\">Nouveautés</a>
          </div>
        </div>
      </div>

      <!-- Forum & Discussions -->
      <div class=\"col-md-4 mb-4\">
        <div class=\"card h-100 ms-transparent-card\" style=\"animation-delay: 0.6s;\">
          <div class=\"card-body\">
            <h5 class=\"card-title ms-card-title-custom\">Forum & Discussions</h5>
            <p class=\"card-text ms-card-text-custom\">Explorez les derniers sujets, participez aux débats ou posez vos questions.</p>
            <a href=\"/forum\" class=\"btn ms-btn-custom\">Accéder au Forum</a>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
{% endblock %}




{# <a href=\"{{ path('contact.support') }}\" class=\"btn ms-btn-custom\">Support</a>
<a href=\"{{ path('game.discover') }}\" class=\"btn ms-btn-custom\">Découvrir</a>
<a href=\"{{ path('forum.index') }}\" class=\"btn ms-btn-custom\">Accéder au Forum</a> #}", "homepage/index.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\homepage\\index.html.twig");
    }
}
