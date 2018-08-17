<?php

/* default.html */
class __TwigTemplate_493acc7746f90c837d78ec9f6fba358e4ffa70d1290f36fe398c9302e3e63b72 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html lang=\"en\">
  <head>
    ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 11
        echo "  </head>
  <body>
    <div class=\"container-fluid bg-dark\">
      <div class=\"row text-center\">
        <div class=\"col\">
          <img class=\"img-fluid\" src=\"imagens/logo-2.png\" alt=\"Logotipo do Concurso\">
        </div>
      </div>
    </div>
    <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">

      <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
      </button>
      <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
        <ul class=\"navbar-nav mx-auto\">
          <li class=\"nav-item active\">
            <a class=\"nav-link\" href=\"#\">Início <span class=\"sr-only\">(current)</span></a>
          </li>
          <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"#\">Regulamento</a>
          </li>
          <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"#\">Como participar</a>
          </li>
          <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"#\">Galeria</a>
          </li>
        </ul>
      </div>
    </nav>
    ";
        // line 42
        $this->displayBlock('content', $context, $blocks);
        // line 43
        echo "    <footer>
      ";
        // line 44
        $this->displayBlock('footer', $context, $blocks);
        // line 47
        echo "    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src=\"https://code.jquery.com/jquery-3.3.1.min.js\" integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js\" integrity=\"sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em\" crossorigin=\"anonymous\"></script>
    ";
        // line 54
        $this->displayBlock('scripts', $context, $blocks);
        // line 55
        echo "  </body>
</html>
";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <link href=\"https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/sandstone/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-CfCAYEgrdtRrpvjGKxoaRy5ge1ggMbxNSpEkY+XqdfdRTUkRrYZVB2z99E7BsEDZ\" crossorigin=\"anonymous\">
    <!-- <link rel=\"stylesheet\" href=\"style.css\" /> -->
    <title>";
        // line 9
        $this->displayBlock('title', $context, $blocks);
        echo " - Cenas da Cidade</title>
    ";
    }

    public function block_title($context, array $blocks = array())
    {
    }

    // line 42
    public function block_content($context, array $blocks = array())
    {
    }

    // line 44
    public function block_footer($context, array $blocks = array())
    {
        // line 45
        echo "          Rodapé
      ";
    }

    // line 54
    public function block_scripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "default.html";
    }

    public function getDebugInfo()
    {
        return array (  124 => 54,  119 => 45,  116 => 44,  111 => 42,  101 => 9,  95 => 5,  92 => 4,  86 => 55,  84 => 54,  75 => 47,  73 => 44,  70 => 43,  68 => 42,  35 => 11,  33 => 4,  28 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default.html", "/var/www/html/cenasdacidade/templates/default.html");
    }
}
