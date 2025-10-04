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

/* contact/support.html.twig */
class __TwigTemplate_48f7c73beef1cedc9ce6ebe1df593f71 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "contact/support.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "contact/support.html.twig"));

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
        yield "<section class=\"support-section\">
  <div class=\"support-wrapper\">
    <div class=\"support-container\">
      <h2>Contactez le Support</h2>
      <p class=\"support-note\">Besoin d'aide ? Remplissez le formulaire ci-dessous ou consultez notre FAQ.</p>

      <form action=\"/submit-support\" method=\"POST\" class=\"support-form\">
        <div class=\"form-group\">
          <label for=\"name\">Nom :</label>
          <input type=\"text\" id=\"name\" name=\"name\" required placeholder=\"Votre nom\">
        </div>

        <div class=\"form-group\">
          <label for=\"email\">Email :</label>
          <input type=\"email\" id=\"email\" name=\"email\" required placeholder=\"Votre email\">
        </div>

        <div class=\"form-group\">
          <label for=\"message\">Message :</label>
          <textarea id=\"message\" name=\"message\" rows=\"5\" required placeholder=\"Décrivez votre problème ou question\"></textarea>
        </div>

        <button type=\"submit\" class=\"btn btn-support\">Envoyer</button>
      </form>

      <div class=\"support-faq\">
        <h3>FAQ</h3>
        <ul>
          <li><strong>Comment signaler un bug ?</strong> Utilisez le formulaire ci-dessus ou envoyez un email à support@morning-soul.com.</li>
          <li><strong>Quels sont les horaires du support ?</strong> Du lundi au vendredi, de 9h à 18h (CET).</li>
          <li><strong>Où trouver les mises à jour du jeu ?</strong> Consultez les pages <a href=\"/news/changelog.php\">changelogs</a> et <a href=\"/news/devblog.php\">devblogs</a>.</li>
        </ul>
      </div>

      <div class=\"support-email\">
        <p>Vous pouvez également nous contacter directement par email à <a href=\"mailto:support@morning-soul.com\">support@morning-soul.com</a>.</p>
      </div>
    </div>

    <div class=\"support-sidebar\">
      <p>Une question sur le jeu ou son gameplay ?</p>
      <a href=\"/forum/forum.php\" target=\"_blank\">Accédez au forum</a>
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
        return "contact/support.html.twig";
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
<section class=\"support-section\">
  <div class=\"support-wrapper\">
    <div class=\"support-container\">
      <h2>Contactez le Support</h2>
      <p class=\"support-note\">Besoin d'aide ? Remplissez le formulaire ci-dessous ou consultez notre FAQ.</p>

      <form action=\"/submit-support\" method=\"POST\" class=\"support-form\">
        <div class=\"form-group\">
          <label for=\"name\">Nom :</label>
          <input type=\"text\" id=\"name\" name=\"name\" required placeholder=\"Votre nom\">
        </div>

        <div class=\"form-group\">
          <label for=\"email\">Email :</label>
          <input type=\"email\" id=\"email\" name=\"email\" required placeholder=\"Votre email\">
        </div>

        <div class=\"form-group\">
          <label for=\"message\">Message :</label>
          <textarea id=\"message\" name=\"message\" rows=\"5\" required placeholder=\"Décrivez votre problème ou question\"></textarea>
        </div>

        <button type=\"submit\" class=\"btn btn-support\">Envoyer</button>
      </form>

      <div class=\"support-faq\">
        <h3>FAQ</h3>
        <ul>
          <li><strong>Comment signaler un bug ?</strong> Utilisez le formulaire ci-dessus ou envoyez un email à support@morning-soul.com.</li>
          <li><strong>Quels sont les horaires du support ?</strong> Du lundi au vendredi, de 9h à 18h (CET).</li>
          <li><strong>Où trouver les mises à jour du jeu ?</strong> Consultez les pages <a href=\"/news/changelog.php\">changelogs</a> et <a href=\"/news/devblog.php\">devblogs</a>.</li>
        </ul>
      </div>

      <div class=\"support-email\">
        <p>Vous pouvez également nous contacter directement par email à <a href=\"mailto:support@morning-soul.com\">support@morning-soul.com</a>.</p>
      </div>
    </div>

    <div class=\"support-sidebar\">
      <p>Une question sur le jeu ou son gameplay ?</p>
      <a href=\"/forum/forum.php\" target=\"_blank\">Accédez au forum</a>
    </div>
  </div>
</section>
{% endblock %}", "contact/support.html.twig", "C:\\Users\\vinpe\\mon_projet\\templates\\contact\\support.html.twig");
    }
}
