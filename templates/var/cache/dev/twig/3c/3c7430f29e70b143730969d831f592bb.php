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

/* news/devblog.html.twig */
class __TwigTemplate_9960f8f15d8e1e9104804a87dafffbf3 extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "news/devblog.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "news/devblog.html.twig"));

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
        yield "<div class=\"devblog-title-container\">
  <h2 class=\"devblog-title\">Devblog de l'équipe : Voici les dernières nouveautés</h2>
</div>

<div class=\"devblog-carousel\">
  <!-- Flèche gauche -->
  <button class=\"devblog-nav prev\" type=\"button\">❮</button>

  <!-- Cartes du carousel -->
  <div class=\"devblog-card\">
    <img src=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/devblog_01.png"), "html", null, true);
        yield "\" alt=\"Starting project\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 03/07/2025 : Début du projet.</h3>
      <p>Il reste encore tant à accomplir...</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/devblog_02.png"), "html", null, true);
        yield "\" alt=\"New Raid Kraken\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 06/07/2025 : Nouveau Raid : Kraken</h3>
      <p>Attention à ses tentacules... !</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/devblog_03.png"), "html", null, true);
        yield "\" alt=\"Update : Stuff\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 09/07/2025 : Refonte des équipements.</h3>
      <p>Plus de place dans l'inventaire... pour porter encore plus d'équipements !</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/devblog_04.png"), "html", null, true);
        yield "\" alt=\"New class\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 11/07/2025 : Refonte des classes.</h3>
      <p>A l'arc, à l'épée, au bâton... Choisissez avec quelles armes vous allez commencer votre aventure !</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/devblog_05.png"), "html", null, true);
        yield "\" alt=\"New feature\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 14/07/2025 : Déité, nouvelle fonctionnalité.</h3>
      <p>Choisissez quel dieu vous allez servir... ou bien trahir.</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"";
        // line 53
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/devblog_07.png"), "html", null, true);
        yield "\" alt=\"Ride a dragon\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 16/07/2025 : Montures, ne voyagez plus seul !</h3>
      <p>Explorez le monde à dos de loup géant, de cerf, de... Dragon ?!</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"";
        // line 61
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/devblog_08.png"), "html", null, true);
        yield "\" alt=\"New Raid Sphinge\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 18/07/2025 : Nouveau Raid : La Sphinge</h3>
      <p>Répondez à son énigme, votre vie en dépend</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/devblog_09.png"), "html", null, true);
        yield "\" alt=\"Mt Ardu\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 22/07/2025 : Nouvelle Zone : Le Mont Ardu</h3>
      <p>Explorez une nouvelle zone et affrontez-y de nouveaux dangers.</p>
    </div>
  </div>

  <!-- Flèche droite -->
  <button class=\"devblog-nav next\" type=\"button\">❯</button>
</div>

<div class=\"carousel-spacer\"></div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 83
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 84
        yield "<!-- Script JS spécifique au carousel -->
<script src=\"";
        // line 85
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/devblog.js"), "html", null, true);
        yield "\"></script>
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
        return "news/devblog.html.twig";
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
        return array (  206 => 85,  203 => 84,  190 => 83,  166 => 69,  155 => 61,  144 => 53,  133 => 45,  122 => 37,  111 => 29,  100 => 21,  89 => 13,  77 => 3,  64 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{%  extends \"base.html.twig\" %}
{% block body %}
<div class=\"devblog-title-container\">
  <h2 class=\"devblog-title\">Devblog de l'équipe : Voici les dernières nouveautés</h2>
</div>

<div class=\"devblog-carousel\">
  <!-- Flèche gauche -->
  <button class=\"devblog-nav prev\" type=\"button\">❮</button>

  <!-- Cartes du carousel -->
  <div class=\"devblog-card\">
    <img src=\"{{ asset('img/devblog_01.png') }}\" alt=\"Starting project\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 03/07/2025 : Début du projet.</h3>
      <p>Il reste encore tant à accomplir...</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"{{ asset('img/devblog_02.png') }}\" alt=\"New Raid Kraken\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 06/07/2025 : Nouveau Raid : Kraken</h3>
      <p>Attention à ses tentacules... !</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"{{ asset('img/devblog_03.png') }}\" alt=\"Update : Stuff\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 09/07/2025 : Refonte des équipements.</h3>
      <p>Plus de place dans l'inventaire... pour porter encore plus d'équipements !</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"{{ asset('img/devblog_04.png') }}\" alt=\"New class\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 11/07/2025 : Refonte des classes.</h3>
      <p>A l'arc, à l'épée, au bâton... Choisissez avec quelles armes vous allez commencer votre aventure !</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"{{ asset('img/devblog_05.png') }}\" alt=\"New feature\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 14/07/2025 : Déité, nouvelle fonctionnalité.</h3>
      <p>Choisissez quel dieu vous allez servir... ou bien trahir.</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"{{ asset('img/devblog_07.png') }}\" alt=\"Ride a dragon\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 16/07/2025 : Montures, ne voyagez plus seul !</h3>
      <p>Explorez le monde à dos de loup géant, de cerf, de... Dragon ?!</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"{{ asset('img/devblog_08.png') }}\" alt=\"New Raid Sphinge\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 18/07/2025 : Nouveau Raid : La Sphinge</h3>
      <p>Répondez à son énigme, votre vie en dépend</p>
    </div>
  </div>

  <div class=\"devblog-card\">
    <img src=\"{{ asset('img/devblog_09.png') }}\" alt=\"Mt Ardu\">
    <div class=\"devblog-description\">
      <h3>DEVBLOG du 22/07/2025 : Nouvelle Zone : Le Mont Ardu</h3>
      <p>Explorez une nouvelle zone et affrontez-y de nouveaux dangers.</p>
    </div>
  </div>

  <!-- Flèche droite -->
  <button class=\"devblog-nav next\" type=\"button\">❯</button>
</div>

<div class=\"carousel-spacer\"></div>
{% endblock %}

{% block javascripts %}
<!-- Script JS spécifique au carousel -->
<script src=\"{{ asset('js/devblog.js') }}\"></script>
{% endblock %}", "news/devblog.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\news\\devblog.html.twig");
    }
}
