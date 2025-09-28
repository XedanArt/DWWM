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

/* news/changelog.html.twig */
class __TwigTemplate_fa6d9fb60aa79fc5120ec06c1142ae66 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "news/changelog.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "news/changelog.html.twig"));

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
        yield "<div class=\"container changelog-main-container my-5\">
  <div class=\"row\">

    <!-- Section principale -->
    <div class=\"col-lg-8 changelog-patchs-container\">

      <!-- Titre principal -->
      <div class=\"changelog-title mb-4\">
        <h1>NOTES DE MISE À JOUR</h1>
      </div>

      <!-- Dernier patch mis en avant -->
      <div class=\"changelog-last-patch mb-5\" id=\"entry-2025-07-20\">
        <div class=\"changelog-last-title text-center\">
          <h2>MÀJ 1.5 : 20/07/2025 : Post-Production</h2>
        </div>
        <div class=\"changelog-last-image-wrapper\">
          <img src=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/changelog_01.png"), "html", null, true);
        yield "\" alt=\"Dernier patch illustration\" class=\"changelog-last-image\">
          <div class=\"changelog-last-content\">
            <h4>20 juillet 2025</h4>
            <p><strong>Ajout :</strong> Création du site et de la BDD</p>
            <p><strong>Correction :</strong> Problème d'affichage sur mobile réglé (responsive)</p>
          </div>
        </div>
      </div>

      <!-- Liste des patchs précédents -->
      <div class=\"changelog-patch-list\">
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-17\">
          <h5>MÀJ 1.4 - 17 juillet 2025</h5>
          <p><strong>Changelog :</strong> Rajout d'une classe</p>
        </div>
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-15\">
          <h5>MÀJ 1.3 - 15 juillet 2025</h5>
          <p><strong>Changelog :</strong> Modification du système d'inventaire</p>
        </div>
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-12\">
          <h5>MÀJ 1.2 - 12 juillet 2025</h5>
          <p><strong>Changelog :</strong> Ajout des icônes</p>
        </div>
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-15\">
          <h5>MÀJ 1.3 - 15 juillet 2025</h5>
          <p><strong>Changelog :</strong> Modification du système d'inventaire</p>
        </div>
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-12\">
          <h5>MÀJ 1.2 - 12 juillet 2025</h5>
          <p><strong>Changelog :</strong> Ajout des icônes</p>
        </div>
      </div>

      <!-- Pagination -->
      <div class=\"changelog-pagination\">
        <a href=\"#\">«</a>
        <a href=\"#\" class=\"active\">1</a>
        <a href=\"#\">2</a>
        <a href=\"#\">3</a>
        <a href=\"#\">»</a>
      </div>
    </div>

    <!-- Sidebar -->
    <div class=\"col-lg-4 changelog-sidebar-container\">
      <div class=\"changelog-patch-nav\">
        <h5>Correctifs</h5>
        <div class=\"changelog-patch-items-container\">
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-31\">MÀJ - 1.10 : 31/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-30\">MÀJ - 1.9 :  30/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-29\">MÀJ - 1.8 :  29/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-28\">MÀJ - 1.7 :  28/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-27\">MÀJ - 1.6 :  27/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-26\">MÀJ - 1.5 :  26/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-25\">MÀJ - 1.4 :  25/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-24\">MÀJ - 1.3 :  24/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-23\">MÀJ - 1.2 :  23/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-22\">MÀJ - 1.1 :  22/07/2025</a><br>
        </div>
      </div>
    </div>

  </div>
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
        return "news/changelog.html.twig";
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
        return array (  95 => 21,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{%  extends \"base.html.twig\" %}

{% block body %}
<div class=\"container changelog-main-container my-5\">
  <div class=\"row\">

    <!-- Section principale -->
    <div class=\"col-lg-8 changelog-patchs-container\">

      <!-- Titre principal -->
      <div class=\"changelog-title mb-4\">
        <h1>NOTES DE MISE À JOUR</h1>
      </div>

      <!-- Dernier patch mis en avant -->
      <div class=\"changelog-last-patch mb-5\" id=\"entry-2025-07-20\">
        <div class=\"changelog-last-title text-center\">
          <h2>MÀJ 1.5 : 20/07/2025 : Post-Production</h2>
        </div>
        <div class=\"changelog-last-image-wrapper\">
          <img src=\"{{ asset('img/changelog_01.png') }}\" alt=\"Dernier patch illustration\" class=\"changelog-last-image\">
          <div class=\"changelog-last-content\">
            <h4>20 juillet 2025</h4>
            <p><strong>Ajout :</strong> Création du site et de la BDD</p>
            <p><strong>Correction :</strong> Problème d'affichage sur mobile réglé (responsive)</p>
          </div>
        </div>
      </div>

      <!-- Liste des patchs précédents -->
      <div class=\"changelog-patch-list\">
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-17\">
          <h5>MÀJ 1.4 - 17 juillet 2025</h5>
          <p><strong>Changelog :</strong> Rajout d'une classe</p>
        </div>
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-15\">
          <h5>MÀJ 1.3 - 15 juillet 2025</h5>
          <p><strong>Changelog :</strong> Modification du système d'inventaire</p>
        </div>
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-12\">
          <h5>MÀJ 1.2 - 12 juillet 2025</h5>
          <p><strong>Changelog :</strong> Ajout des icônes</p>
        </div>
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-15\">
          <h5>MÀJ 1.3 - 15 juillet 2025</h5>
          <p><strong>Changelog :</strong> Modification du système d'inventaire</p>
        </div>
        <div class=\"patch-entry mb-4\" id=\"entry-2025-07-12\">
          <h5>MÀJ 1.2 - 12 juillet 2025</h5>
          <p><strong>Changelog :</strong> Ajout des icônes</p>
        </div>
      </div>

      <!-- Pagination -->
      <div class=\"changelog-pagination\">
        <a href=\"#\">«</a>
        <a href=\"#\" class=\"active\">1</a>
        <a href=\"#\">2</a>
        <a href=\"#\">3</a>
        <a href=\"#\">»</a>
      </div>
    </div>

    <!-- Sidebar -->
    <div class=\"col-lg-4 changelog-sidebar-container\">
      <div class=\"changelog-patch-nav\">
        <h5>Correctifs</h5>
        <div class=\"changelog-patch-items-container\">
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-31\">MÀJ - 1.10 : 31/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-30\">MÀJ - 1.9 :  30/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-29\">MÀJ - 1.8 :  29/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-28\">MÀJ - 1.7 :  28/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-27\">MÀJ - 1.6 :  27/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-26\">MÀJ - 1.5 :  26/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-25\">MÀJ - 1.4 :  25/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-24\">MÀJ - 1.3 :  24/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-23\">MÀJ - 1.2 :  23/07/2025</a><br>
          <a class=\"changelog-patch-items\" href=\"#entry-2025-07-22\">MÀJ - 1.1 :  22/07/2025</a><br>
        </div>
      </div>
    </div>

  </div>
</div>
{% endblock %}", "news/changelog.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\news\\changelog.html.twig");
    }
}
