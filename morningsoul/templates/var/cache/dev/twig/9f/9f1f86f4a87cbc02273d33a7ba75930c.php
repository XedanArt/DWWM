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

/* contact/socials.html.twig */
class __TwigTemplate_31c3f290ea1d63b2345343e25f105339 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "contact/socials.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "contact/socials.html.twig"));

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
        yield "<section class=\"social-section\">
  <div class=\"social-container\">
    <h2>Suivez-nous sur les réseaux sociaux</h2>
    <p class=\"social-note\">Restez connectés avec nous pour les dernières nouvelles et mises à jour.</p>

    <div class=\"social-cards\">
      <div class=\"social-card\" id=\"facebook\">
        <a href=\"https://www.facebook.com\" target=\"_blank\">
          <i class=\"fab fa-facebook-f\"></i>
          <h3>Facebook</h3>
          <img src=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/socials_fb_logo.png"), "html", null, true);
        yield "\" alt=\"Logo Facebook\">
        </a>
      </div>

      <div class=\"social-card\" id=\"instagram\">
        <a href=\"https://www.instagram.com\" target=\"_blank\">
          <i class=\"fab fa-instagram\"></i>
          <h3>Instagram</h3>
          <img src=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/socials_insta_logo.png"), "html", null, true);
        yield "\" alt=\"Logo Instagram\">
        </a>
      </div>

      <div class=\"social-card\" id=\"twitter\">
        <a href=\"https://www.twitter.com\" target=\"_blank\">
          <i class=\"fab fa-twitter\"></i>
          <h3>Twitter</h3>
          <img src=\"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/socials_x_logo.png"), "html", null, true);
        yield "\" alt=\"Logo Twitter\">
        </a>
      </div>
    </div>
  </div>
</section>v
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 36
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

        // line 37
        yield "  ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
  <script src=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/socials.js"), "html", null, true);
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
        return "contact/socials.html.twig";
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
        return array (  147 => 38,  142 => 37,  129 => 36,  111 => 29,  100 => 21,  89 => 13,  77 => 3,  64 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{%  extends \"base.html.twig\" %}
{% block body %}
<section class=\"social-section\">
  <div class=\"social-container\">
    <h2>Suivez-nous sur les réseaux sociaux</h2>
    <p class=\"social-note\">Restez connectés avec nous pour les dernières nouvelles et mises à jour.</p>

    <div class=\"social-cards\">
      <div class=\"social-card\" id=\"facebook\">
        <a href=\"https://www.facebook.com\" target=\"_blank\">
          <i class=\"fab fa-facebook-f\"></i>
          <h3>Facebook</h3>
          <img src=\"{{ asset('img/socials_fb_logo.png') }}\" alt=\"Logo Facebook\">
        </a>
      </div>

      <div class=\"social-card\" id=\"instagram\">
        <a href=\"https://www.instagram.com\" target=\"_blank\">
          <i class=\"fab fa-instagram\"></i>
          <h3>Instagram</h3>
          <img src=\"{{ asset('img/socials_insta_logo.png') }}\" alt=\"Logo Instagram\">
        </a>
      </div>

      <div class=\"social-card\" id=\"twitter\">
        <a href=\"https://www.twitter.com\" target=\"_blank\">
          <i class=\"fab fa-twitter\"></i>
          <h3>Twitter</h3>
          <img src=\"{{ asset('img/socials_x_logo.png') }}\" alt=\"Logo Twitter\">
        </a>
      </div>
    </div>
  </div>
</section>v
{% endblock %}
{% block javascripts %}
  {{ parent() }}
  <script src=\"{{ asset('js/socials.js') }}\"></script>
{% endblock %}
", "contact/socials.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\contact\\socials.html.twig");
    }
}
