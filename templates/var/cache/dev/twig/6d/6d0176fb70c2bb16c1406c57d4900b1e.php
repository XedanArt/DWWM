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

/* forum/index.html.twig */
class __TwigTemplate_311775b7774f26d7f78da7821bc621d2 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/index.html.twig"));

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
        yield "<section class=\"forum-section\">
        <div class=\"forum-topics-container\">
            <!-- Contenu principal -->
            <div class=\"forum-main\">
                <div class=\"forum-title\">
                    <div class=\"forum-title-header\">
                      <img src=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/favicon_ms_00.png"), "html", null, true);
        yield "\" alt=\"Logo Morning Soul\" class=\"forum-logo\">
                      <h2>BIENVENUE SUR MORNING SOUL - FORUM</h2>
                    </div>
                </div>
                <div class=\"forum-annoucement\">
                  <h2>ANNONCE</h2>
                  <p>ANNONCE ANNONCE ANNONCE</p>
                </div>
                <div class=\"forum-informations\">
                  <h2>INFORMATIONS</h2>
                  <ul class=\"topic-list\">
                    <li><a href=\"#\">[Sujet 1] Communauté : Rejoignez le serveur Discord de la communauté !</a></li>
                    <li><a href=\"#\">[Sujet 2] Votes : pour l'ajout de la nouvelle monture [Clôturé] </a></li>
                    <li><a href=\"#\">[Sujet 3] Staff : L'équipe accueil de nouveaux membres </a></li>
                  </ul>
                </div>
                <div class=\"forum-morningsoul\">
                  <h2>MORNING SOUL</h2>
                  <ul class=\"topic-list\">
                    <li><a href=\"#\">[Sujet 1] BUG : JE SUIS BLOQUÉ DANS UN MUR !!!</a></li>
                    <li><a href=\"#\">[Sujet 2] Trop bien le jeu vivement l'Alpha ouverte</a></li>
                    <li><a href=\"#\">[Sujet 3] [MAINTENANCE] : Prévue le 22/07/2025 </a></li>
                  </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <div class=\"forum-sidebar-container\">
                <div class=\"forum-search\">
                    <h2>Rechercher sur le forum</h2>
                    <form action=\"/recherche\" method=\"post\" class=\"forum-search-form\">
                      <input type=\"text\" name=\"q\" placeholder=\"Rechercher un sujet...\" class=\"forum-search-input\">
                      <button type=\"submit\" class=\"forum-search-button\">🔍</button>
                    </form>
                </div>
                <div class=\"forum-toc\">
                    <h2>Table des matières</h2>
                    <p>Liste des sections à insérer ici.</p>
                </div>
                <div class=\"forum-allcategory\">
                    <h2>Derniers sujets créés</h2>
                    <p>Liens vers les catégories à insérer ici.</p>
                </div>
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
        return "forum/index.html.twig";
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
        return array (  84 => 9,  76 => 3,  63 => 2,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{%  extends \"base.html.twig\" %}
{% block body %}
<section class=\"forum-section\">
        <div class=\"forum-topics-container\">
            <!-- Contenu principal -->
            <div class=\"forum-main\">
                <div class=\"forum-title\">
                    <div class=\"forum-title-header\">
                      <img src=\"{{ asset('img/favicon_ms_00.png') }}\" alt=\"Logo Morning Soul\" class=\"forum-logo\">
                      <h2>BIENVENUE SUR MORNING SOUL - FORUM</h2>
                    </div>
                </div>
                <div class=\"forum-annoucement\">
                  <h2>ANNONCE</h2>
                  <p>ANNONCE ANNONCE ANNONCE</p>
                </div>
                <div class=\"forum-informations\">
                  <h2>INFORMATIONS</h2>
                  <ul class=\"topic-list\">
                    <li><a href=\"#\">[Sujet 1] Communauté : Rejoignez le serveur Discord de la communauté !</a></li>
                    <li><a href=\"#\">[Sujet 2] Votes : pour l'ajout de la nouvelle monture [Clôturé] </a></li>
                    <li><a href=\"#\">[Sujet 3] Staff : L'équipe accueil de nouveaux membres </a></li>
                  </ul>
                </div>
                <div class=\"forum-morningsoul\">
                  <h2>MORNING SOUL</h2>
                  <ul class=\"topic-list\">
                    <li><a href=\"#\">[Sujet 1] BUG : JE SUIS BLOQUÉ DANS UN MUR !!!</a></li>
                    <li><a href=\"#\">[Sujet 2] Trop bien le jeu vivement l'Alpha ouverte</a></li>
                    <li><a href=\"#\">[Sujet 3] [MAINTENANCE] : Prévue le 22/07/2025 </a></li>
                  </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <div class=\"forum-sidebar-container\">
                <div class=\"forum-search\">
                    <h2>Rechercher sur le forum</h2>
                    <form action=\"/recherche\" method=\"post\" class=\"forum-search-form\">
                      <input type=\"text\" name=\"q\" placeholder=\"Rechercher un sujet...\" class=\"forum-search-input\">
                      <button type=\"submit\" class=\"forum-search-button\">🔍</button>
                    </form>
                </div>
                <div class=\"forum-toc\">
                    <h2>Table des matières</h2>
                    <p>Liste des sections à insérer ici.</p>
                </div>
                <div class=\"forum-allcategory\">
                    <h2>Derniers sujets créés</h2>
                    <p>Liens vers les catégories à insérer ici.</p>
                </div>
            </div>
        </div>
</section>
{% endblock %}", "forum/index.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\forum\\index.html.twig");
    }
}
