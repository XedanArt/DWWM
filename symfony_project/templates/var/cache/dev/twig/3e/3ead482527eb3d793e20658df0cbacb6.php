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

/* _inc/footer.html.twig */
class __TwigTemplate_ef0e1909670978558b617fa46f2dbb4c extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "_inc/footer.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "_inc/footer.html.twig"));

        // line 1
        yield "<!-- Animations pour logos réseaux sociaux -->
<script src=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/socials.js"), "html", null, true);
        yield "\" defer></script>

<footer class=\"text-center text-lg-start footer-custom\">  
  <div class=\"container p-4\">

    <!-- Partie haute : colonnes d'informations -->
    <div class=\"footer-top\">
      <div class=\"footer-col\">
        <h5 class=\"text-uppercase footer-title-custom\">MORNING SOUL</h5>  
        <ul class=\"footer-list mb-0\">  
           <li><a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("homepage.index");
        yield "\" class=\"footer-links-custom\">Accueil</a></li>  
           <li><a href=\"";
        // line 13
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game.discover");
        yield "\" class=\"footer-links-custom\">Découvrir</a></li>  
           <li><a href=\"#\" class=\"footer-links-custom\">Tutoriels</a></li>  
           <li><a href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("news.changelog");
        yield "\" class=\"footer-links-custom\">Changelog</a></li>  
           <li><a href=\"";
        // line 16
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("news.devblog");
        yield "\" class=\"footer-links-custom\">Devblog</a></li>  
        </ul>  
      </div>  

      <div class=\"footer-col\">
         <h5 class=\"text-uppercase footer-title-custom\">INFORMATIONS</h5>
         <ul class=\"footer-list mb-0\">
           <li><a href=\"#\" class=\"footer-links-custom\">Règles de la communauté</a></li>
           <li><a href=\"#\" class=\"footer-links-custom\">Nouveautés</a></li>
           <li><a href=\"/forum\" class=\"footer-links-custom\">Forum</a></li>
           <li><a href=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact.support");
        yield "\" class=\"footer-links-custom\">Nous contacter</a></li>
         </ul>
      </div>

      <div class=\"footer-col\">
         <h5 class=\"text-uppercase footer-title-custom\">Mon compte</h5>
         <ul class=\"footer-list mb-0\">
           <li><a href=\"/auth/login-register\" class=\"footer-links-custom\">S'inscrire</a></li>
           <li><a href=\"/auth/login-register\" class=\"footer-links-custom\">Se connecter</a></li>
         </ul>
      </div>
    </div>

    <!-- Partie basse : liens légaux + réseaux + copyright -->
    <div class=\"footer-bottom\">
      <div class=\"legal-links\">
        <a href=\"/legal/terms\" class=\"footer-links-custom\">Conditions d'utilisation</a>
        <a href=\"/legal/privacy\" class=\"footer-links-custom\">Politique de Confidentialité</a>
        <a href=\"/legal/terms#mentions\" class=\"footer-links-custom\">Mentions légales</a>
        <a href=\"/legal/terms#cookies\" class=\"footer-links-custom\">Gestion des cookies</a>
      </div>

      <div class=\"social-icons-custom\">
        <a href=\"https://facebook.com\" target=\"_blank\">
          <div class=\"logo-box\">
            <img src=\"";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/socials_fb_logo.png"), "html", null, true);
        yield "\" alt=\"Facebook\" class=\"social-icon-img\">
          </div>
        </a>
        <a href=\"https://instagram.com\" target=\"_blank\">
          <div class=\"logo-box\">
            <img src=\"";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/socials_insta_logo.png"), "html", null, true);
        yield "\" alt=\"Instagram\" class=\"social-icon-img\">
          </div>
        </a>
        <a href=\"https://twitter.com\" target=\"_blank\">
          <div class=\"logo-box\">
            <img src=\"";
        // line 61
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/socials_x_logo.png"), "html", null, true);
        yield "\" alt=\"X\" class=\"social-icon-img\">
          </div>
        </a>
      </div>

      <div class=\"copyright-custom text-center p-3\">© 2025 Morning Soul</div>
    </div>

  </div>
</footer>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "_inc/footer.html.twig";
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
        return array (  134 => 61,  126 => 56,  118 => 51,  90 => 26,  77 => 16,  73 => 15,  68 => 13,  64 => 12,  51 => 2,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!-- Animations pour logos réseaux sociaux -->
<script src=\"{{ asset('js/socials.js') }}\" defer></script>

<footer class=\"text-center text-lg-start footer-custom\">  
  <div class=\"container p-4\">

    <!-- Partie haute : colonnes d'informations -->
    <div class=\"footer-top\">
      <div class=\"footer-col\">
        <h5 class=\"text-uppercase footer-title-custom\">MORNING SOUL</h5>  
        <ul class=\"footer-list mb-0\">  
           <li><a href=\"{{ path('homepage.index') }}\" class=\"footer-links-custom\">Accueil</a></li>  
           <li><a href=\"{{ path('game.discover') }}\" class=\"footer-links-custom\">Découvrir</a></li>  
           <li><a href=\"#\" class=\"footer-links-custom\">Tutoriels</a></li>  
           <li><a href=\"{{ path('news.changelog') }}\" class=\"footer-links-custom\">Changelog</a></li>  
           <li><a href=\"{{ path('news.devblog') }}\" class=\"footer-links-custom\">Devblog</a></li>  
        </ul>  
      </div>  

      <div class=\"footer-col\">
         <h5 class=\"text-uppercase footer-title-custom\">INFORMATIONS</h5>
         <ul class=\"footer-list mb-0\">
           <li><a href=\"#\" class=\"footer-links-custom\">Règles de la communauté</a></li>
           <li><a href=\"#\" class=\"footer-links-custom\">Nouveautés</a></li>
           <li><a href=\"/forum\" class=\"footer-links-custom\">Forum</a></li>
           <li><a href=\"{{ path('contact.support') }}\" class=\"footer-links-custom\">Nous contacter</a></li>
         </ul>
      </div>

      <div class=\"footer-col\">
         <h5 class=\"text-uppercase footer-title-custom\">Mon compte</h5>
         <ul class=\"footer-list mb-0\">
           <li><a href=\"/auth/login-register\" class=\"footer-links-custom\">S'inscrire</a></li>
           <li><a href=\"/auth/login-register\" class=\"footer-links-custom\">Se connecter</a></li>
         </ul>
      </div>
    </div>

    <!-- Partie basse : liens légaux + réseaux + copyright -->
    <div class=\"footer-bottom\">
      <div class=\"legal-links\">
        <a href=\"/legal/terms\" class=\"footer-links-custom\">Conditions d'utilisation</a>
        <a href=\"/legal/privacy\" class=\"footer-links-custom\">Politique de Confidentialité</a>
        <a href=\"/legal/terms#mentions\" class=\"footer-links-custom\">Mentions légales</a>
        <a href=\"/legal/terms#cookies\" class=\"footer-links-custom\">Gestion des cookies</a>
      </div>

      <div class=\"social-icons-custom\">
        <a href=\"https://facebook.com\" target=\"_blank\">
          <div class=\"logo-box\">
            <img src=\"{{ asset('img/socials_fb_logo.png') }}\" alt=\"Facebook\" class=\"social-icon-img\">
          </div>
        </a>
        <a href=\"https://instagram.com\" target=\"_blank\">
          <div class=\"logo-box\">
            <img src=\"{{ asset('img/socials_insta_logo.png') }}\" alt=\"Instagram\" class=\"social-icon-img\">
          </div>
        </a>
        <a href=\"https://twitter.com\" target=\"_blank\">
          <div class=\"logo-box\">
            <img src=\"{{ asset('img/socials_x_logo.png') }}\" alt=\"X\" class=\"social-icon-img\">
          </div>
        </a>
      </div>

      <div class=\"copyright-custom text-center p-3\">© 2025 Morning Soul</div>
    </div>

  </div>
</footer>", "_inc/footer.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\_inc\\footer.html.twig");
    }
}
