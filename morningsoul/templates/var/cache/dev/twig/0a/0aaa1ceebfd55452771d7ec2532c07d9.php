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

/* game/download.html.twig */
class __TwigTemplate_6bda20e9ac1ac7a06a477771ebfebbdd extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/download.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/download.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 2
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

        // line 3
        yield "<section class=\"install-section\">
  <div class=\"install-container\">
    <h2>Téléchargez Morning Soul</h2>
    <p class=\"install-intro\">Accédez à la dernière version du jeu et commencez votre aventure.</p>

    <div class=\"install-block\">
      <a href=\"/assets/downloads/MorningSoul_Setup.exe\" class=\"btn btn-install\">Télécharger (Windows)</a>
    </div>

    <div class=\"system-reqs-dual\">
      <div class=\"system-req-column\">
        <h3>Configuration minimale</h3>
        <ul>
          <li><strong>OS :</strong> Microsoft® Windows 10 (64bit)</li>
          <li><strong>Processeur :</strong> Intel Core i3-4340 ou mieux</li>
          <li><strong>Mémoire :</strong> 8 GB RAM</li>
          <li><strong>Graphiques :</strong> Carte compatible OpenGL 4.4</li>
          <li><strong>Stockage :</strong> 8 GB d’espace disponible</li>
          <li><strong>Notes :</strong> Non compatible en environnement virtuel (ex. Nahimic à désactiver)</li>
        </ul>
      </div>

      <div class=\"system-req-column\">
        <h3>Configuration recommandée</h3>
        <ul>
          <li><strong>OS :</strong> Microsoft® Windows 10 (64bit)</li>
          <li><strong>Processeur :</strong> Core i5-8400 / Ryzen 5 1500X ou mieux</li>
          <li><strong>Mémoire :</strong> 16 GB RAM</li>
          <li><strong>Graphiques :</strong> GTX 1650 / Radeon RX570</li>
          <li><strong>Stockage :</strong> 8 GB d’espace disponible</li>
          <li><strong>Notes :</strong> Non compatible en environnement virtuel (ex. Nahimic à désactiver)</li>
        </ul>
      </div>
    </div>

    <div class=\"install-notes\">
      <p><strong>Note :</strong> cette version est une démo jouable, susceptible d’évoluer rapidement. Si vous avez des retours ou des bugs à signaler, <a href=\"/contact/support.php\">contactez le support</a>.</p>
    </div>
  </div>
</section>
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
        return "game/download.html.twig";
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
        return array (  76 => 3,  63 => 2,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{%  extends \"base.html.twig\" %}
{% block body %}
<section class=\"install-section\">
  <div class=\"install-container\">
    <h2>Téléchargez Morning Soul</h2>
    <p class=\"install-intro\">Accédez à la dernière version du jeu et commencez votre aventure.</p>

    <div class=\"install-block\">
      <a href=\"/assets/downloads/MorningSoul_Setup.exe\" class=\"btn btn-install\">Télécharger (Windows)</a>
    </div>

    <div class=\"system-reqs-dual\">
      <div class=\"system-req-column\">
        <h3>Configuration minimale</h3>
        <ul>
          <li><strong>OS :</strong> Microsoft® Windows 10 (64bit)</li>
          <li><strong>Processeur :</strong> Intel Core i3-4340 ou mieux</li>
          <li><strong>Mémoire :</strong> 8 GB RAM</li>
          <li><strong>Graphiques :</strong> Carte compatible OpenGL 4.4</li>
          <li><strong>Stockage :</strong> 8 GB d’espace disponible</li>
          <li><strong>Notes :</strong> Non compatible en environnement virtuel (ex. Nahimic à désactiver)</li>
        </ul>
      </div>

      <div class=\"system-req-column\">
        <h3>Configuration recommandée</h3>
        <ul>
          <li><strong>OS :</strong> Microsoft® Windows 10 (64bit)</li>
          <li><strong>Processeur :</strong> Core i5-8400 / Ryzen 5 1500X ou mieux</li>
          <li><strong>Mémoire :</strong> 16 GB RAM</li>
          <li><strong>Graphiques :</strong> GTX 1650 / Radeon RX570</li>
          <li><strong>Stockage :</strong> 8 GB d’espace disponible</li>
          <li><strong>Notes :</strong> Non compatible en environnement virtuel (ex. Nahimic à désactiver)</li>
        </ul>
      </div>
    </div>

    <div class=\"install-notes\">
      <p><strong>Note :</strong> cette version est une démo jouable, susceptible d’évoluer rapidement. Si vous avez des retours ou des bugs à signaler, <a href=\"/contact/support.php\">contactez le support</a>.</p>
    </div>
  </div>
</section>
{% endblock %}
", "game/download.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\game\\download.html.twig");
    }
}
