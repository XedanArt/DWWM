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

/* game/discover.html.twig */
class __TwigTemplate_b8ec0ec0aa23132803554b04d5c5ddbe extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/discover.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/discover.html.twig"));

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
        yield "<div class=\"site-wrapper d-flex flex-column min-vh-100\">
  <main class=\"container-fluid p-0\">
    
    <!-- Bloc 1 : Univers -->
    <section class=\"world-section-discover\" id=\"hero-1\">
      <div class=\"overlay-text-discover\">
        <h2 class=\"title-world-section-discover\">Un univers sombre et complet</h2>
        <p class=\"paragraph-world-section-discover\">Plongez dans un monde où chaque décision est lourde de sens et chaque réussite arrachée à la difficulté. - Morning Soul - récompense l’audace, la réflexion et la persévérance dans une aventure intense et inoubliable.</p>
      </div>
    </section>

    <!-- Transition -->
    <div class=\"transition-section\" id=\"transition-1\">
      <div class=\"gradient-overlay\"></div>
    </div>

    <!-- Bloc 2 : Gameplay -->
    <section class=\"gameplay-section-discover\" id=\"hero-2\">
      <div class=\"overlay-text-discover\">
        <h2 class=\"title-gameplay-section-discover\">Gameplay exigeant mais gratifiant</h2>
        <p class=\"paragraph-gameplay-section-discover\">Plongez dans un RPG aux mécaniques originales, où chaque affrontement met vos choix à l’épreuve. Le système de classes offre une richesse rare : créez, combinez et adaptez votre style à travers des configurations variées.</p>
      </div>
    </section>

    <!-- Transition -->
    <div class=\"transition-section\" id=\"transition-2\">
      <div class=\"gradient-overlay\"></div>
    </div>

    <!-- Bloc 3 : Évolution -->
    <section class=\"evo-section-discover\" id=\"hero-3\">
      <div class=\"overlay-text-discover\">
        <h2 class=\"title-evo-section-discover\">Un monde en constante evolution</h2>
        <p class=\"paragraph-evo-section-discover\">- Morning Soul - est un projet vivant. En perpétuelle expansion, il évolue au fil des idées, des inspirations et des retours de la communauté. Entre mises à jour, équilibrages et extensions narratives, ce monde s’étoffe avec une ambition sincère : créer une expérience marquante et durable.</p>
      </div>
    </section>

  </main>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 43
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

        // line 44
        yield "<script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/discover.js"), "html", null, true);
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
        return "game/discover.html.twig";
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
        return array (  140 => 44,  127 => 43,  77 => 3,  64 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{%  extends \"base.html.twig\" %}
{% block body %}
<div class=\"site-wrapper d-flex flex-column min-vh-100\">
  <main class=\"container-fluid p-0\">
    
    <!-- Bloc 1 : Univers -->
    <section class=\"world-section-discover\" id=\"hero-1\">
      <div class=\"overlay-text-discover\">
        <h2 class=\"title-world-section-discover\">Un univers sombre et complet</h2>
        <p class=\"paragraph-world-section-discover\">Plongez dans un monde où chaque décision est lourde de sens et chaque réussite arrachée à la difficulté. - Morning Soul - récompense l’audace, la réflexion et la persévérance dans une aventure intense et inoubliable.</p>
      </div>
    </section>

    <!-- Transition -->
    <div class=\"transition-section\" id=\"transition-1\">
      <div class=\"gradient-overlay\"></div>
    </div>

    <!-- Bloc 2 : Gameplay -->
    <section class=\"gameplay-section-discover\" id=\"hero-2\">
      <div class=\"overlay-text-discover\">
        <h2 class=\"title-gameplay-section-discover\">Gameplay exigeant mais gratifiant</h2>
        <p class=\"paragraph-gameplay-section-discover\">Plongez dans un RPG aux mécaniques originales, où chaque affrontement met vos choix à l’épreuve. Le système de classes offre une richesse rare : créez, combinez et adaptez votre style à travers des configurations variées.</p>
      </div>
    </section>

    <!-- Transition -->
    <div class=\"transition-section\" id=\"transition-2\">
      <div class=\"gradient-overlay\"></div>
    </div>

    <!-- Bloc 3 : Évolution -->
    <section class=\"evo-section-discover\" id=\"hero-3\">
      <div class=\"overlay-text-discover\">
        <h2 class=\"title-evo-section-discover\">Un monde en constante evolution</h2>
        <p class=\"paragraph-evo-section-discover\">- Morning Soul - est un projet vivant. En perpétuelle expansion, il évolue au fil des idées, des inspirations et des retours de la communauté. Entre mises à jour, équilibrages et extensions narratives, ce monde s’étoffe avec une ambition sincère : créer une expérience marquante et durable.</p>
      </div>
    </section>

  </main>
</div>
{% endblock %}
{% block javascripts %}
<script src=\"{{ asset('js/discover.js') }}\"></script>
{% endblock %}", "game/discover.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\game\\discover.html.twig");
    }
}
