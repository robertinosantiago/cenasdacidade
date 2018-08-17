<?php

/* inicio.html */
class __TwigTemplate_95927c07fbf7f9d9795ad7f5e5e66dbf5fe82f793cfa3b993d2ec4814e9f4c04 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("default.html", "inicio.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "default.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Inicio";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
    <style type=\"text/css\">
        .important { color: #336699; }
    </style>
";
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "<div id=\"carouselExampleIndicators\" class=\"carousel slide\" data-ride=\"carousel\">
  <ol class=\"carousel-indicators\">
    <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"0\" class=\"active\"></li>
    <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"1\"></li>
    <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"2\"></li>
  </ol>
  <div class=\"carousel-inner\">
    <div class=\"carousel-item active\">
      <img class=\"d-block w-100\" src=\"imagens/photo-1.jpg\" alt=\"First slide\">
      <div class=\"carousel-caption d-none d-md-block\">
        <h5>Concurso de Fotografias - Cenas da Cidade</h5>
        <p>...</p>
      </div>
    </div>
    <div class=\"carousel-item\">
      <img class=\"d-block w-100\" src=\"imagens/photo-2.jpg\" alt=\"Second slide\">
    </div>
    <div class=\"carousel-item\">
      <img class=\"d-block w-100\" src=\"imagens/photo-3.jpg\" alt=\"Third slide\">
    </div>
  </div>
  <a class=\"carousel-control-prev\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"prev\">
    <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
    <span class=\"sr-only\">Previous</span>
  </a>
  <a class=\"carousel-control-next\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"next\">
    <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
    <span class=\"sr-only\">Next</span>
  </a>
</div>
<div class=\"container\">
  <div class=\"row\">
    <div class=\"col\">
      <h1>Inicio</h1>
      <p class=\"important\">
        Welcome to my awesome homepage.
      </p>
    </div>
  </div>

</div>
";
    }

    public function getTemplateName()
    {
        return "inicio.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 11,  53 => 10,  43 => 5,  40 => 4,  34 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "inicio.html", "/var/www/html/cenasdacidade/templates/inicio.html");
    }
}
