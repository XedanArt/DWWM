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

/* _inc/header.html.twig */
class __TwigTemplate_e4abf010759c289a3d91b1451387b82c extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "_inc/header.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "_inc/header.html.twig"));

        // line 1
        yield "<nav class=\"navbar navbar-expand-lg navbar-light navbar-custom fixed-top\">
  <div class=\"container-fluid\">
    <!-- Logo -->
    <a class=\"navbar-brand\" href=\"";
        // line 4
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("homepage.index");
        yield "\">
      <img src=\"";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/favicon_ms_00.png"), "html", null, true);
        yield "\" alt=\"Logo\" width=\"30\" height=\"30\" class=\"d-inline-block align-text-top logo\">
    </a>

    <!-- Bouton burger -->
    <button class=\"navbar-toggler d-lg-none\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>

    <!-- Menu -->
    <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
      <ul class=\"navbar-nav me-auto\">
        <!-- Jeu -->
        <li class=\"nav-item dropdown\">
          <a class=\"nav-link dropdown-toggle link-custom\" href=\"#\" id=\"siteDropdown\" data-bs-toggle=\"dropdown\">Jeu</a>
          <ul class=\"dropdown-menu dropdown-custom\">
            <li><a class=\"dropdown-item\" href=\"";
        // line 20
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game.discover");
        yield "\">Découvrir</a></li>
            <li><a class=\"dropdown-item\" href=\"";
        // line 21
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game.download");
        yield "\">Télécharger</a></li>
          </ul>
        </li>

        <!-- Contact -->
        <li class=\"nav-item dropdown\">
          <a class=\"nav-link dropdown-toggle link-custom\" href=\"#\" id=\"contactDropdown\" data-bs-toggle=\"dropdown\">Contact</a>
          <ul class=\"dropdown-menu dropdown-custom\">
            <li><a class=\"dropdown-item\" href=\"";
        // line 29
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact.support");
        yield "\">Support</a></li>
            <li><a class=\"dropdown-item\" href=\"";
        // line 30
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact.socials");
        yield "\">Réseaux</a></li>
          </ul>
        </li>

        <!-- Actualités -->
        <li class=\"nav-item dropdown\">
          <a class=\"nav-link dropdown-toggle link-custom\" href=\"#\" id=\"newsDropdown\" data-bs-toggle=\"dropdown\">Actualités</a>
          <ul class=\"dropdown-menu dropdown-custom\">
            <li><a class=\"dropdown-item\" href=\"";
        // line 38
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("news.changelog");
        yield "\">Changelog</a></li>
            <li><a class=\"dropdown-item\" href=\"";
        // line 39
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("news.devblog");
        yield "\">Devblog</a></li>
          </ul>
        </li>

        <!-- Forum -->
        <li class=\"nav-item\">
          <a class=\"nav-link link-custom\" href=\"";
        // line 45
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum.index");
        yield "\">Forum</a>
        </li>
      </ul>

      <!-- Bouton Nous Rejoindre -->
      <a class=\"btn btn-primary custom-login-btn ms-auto\" href=\"";
        // line 50
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("auth.login");
        yield "\">Nous Rejoindre</a>
    </div>
  </div>
</nav>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "_inc/header.html.twig";
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
        return array (  126 => 50,  118 => 45,  109 => 39,  105 => 38,  94 => 30,  90 => 29,  79 => 21,  75 => 20,  57 => 5,  53 => 4,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"navbar navbar-expand-lg navbar-light navbar-custom fixed-top\">
  <div class=\"container-fluid\">
    <!-- Logo -->
    <a class=\"navbar-brand\" href=\"{{ path('homepage.index') }}\">
      <img src=\"{{ asset('img/favicon_ms_00.png') }}\" alt=\"Logo\" width=\"30\" height=\"30\" class=\"d-inline-block align-text-top logo\">
    </a>

    <!-- Bouton burger -->
    <button class=\"navbar-toggler d-lg-none\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>

    <!-- Menu -->
    <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
      <ul class=\"navbar-nav me-auto\">
        <!-- Jeu -->
        <li class=\"nav-item dropdown\">
          <a class=\"nav-link dropdown-toggle link-custom\" href=\"#\" id=\"siteDropdown\" data-bs-toggle=\"dropdown\">Jeu</a>
          <ul class=\"dropdown-menu dropdown-custom\">
            <li><a class=\"dropdown-item\" href=\"{{ path('game.discover') }}\">Découvrir</a></li>
            <li><a class=\"dropdown-item\" href=\"{{ path('game.download') }}\">Télécharger</a></li>
          </ul>
        </li>

        <!-- Contact -->
        <li class=\"nav-item dropdown\">
          <a class=\"nav-link dropdown-toggle link-custom\" href=\"#\" id=\"contactDropdown\" data-bs-toggle=\"dropdown\">Contact</a>
          <ul class=\"dropdown-menu dropdown-custom\">
            <li><a class=\"dropdown-item\" href=\"{{ path('contact.support') }}\">Support</a></li>
            <li><a class=\"dropdown-item\" href=\"{{ path('contact.socials') }}\">Réseaux</a></li>
          </ul>
        </li>

        <!-- Actualités -->
        <li class=\"nav-item dropdown\">
          <a class=\"nav-link dropdown-toggle link-custom\" href=\"#\" id=\"newsDropdown\" data-bs-toggle=\"dropdown\">Actualités</a>
          <ul class=\"dropdown-menu dropdown-custom\">
            <li><a class=\"dropdown-item\" href=\"{{ path('news.changelog') }}\">Changelog</a></li>
            <li><a class=\"dropdown-item\" href=\"{{ path('news.devblog') }}\">Devblog</a></li>
          </ul>
        </li>

        <!-- Forum -->
        <li class=\"nav-item\">
          <a class=\"nav-link link-custom\" href=\"{{ path('forum.index') }}\">Forum</a>
        </li>
      </ul>

      <!-- Bouton Nous Rejoindre -->
      <a class=\"btn btn-primary custom-login-btn ms-auto\" href=\"{{ path('auth.login') }}\">Nous Rejoindre</a>
    </div>
  </div>
</nav>", "_inc/header.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\_inc\\header.html.twig");
    }
}
