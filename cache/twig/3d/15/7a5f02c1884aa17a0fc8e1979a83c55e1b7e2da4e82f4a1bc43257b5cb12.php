<?php

/* partials/header.html.twig */
class __TwigTemplate_3d157a5f02c1884aa17a0fc8e1979a83c55e1b7e2da4e82f4a1bc43257b5cb12 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"inner-header large-4 columns\">
  <div class=\"title\">
    <a href=\"";
        // line 3
        echo ((((isset($context["base_url"]) ? $context["base_url"] : null) == "")) ? ("/") : ((isset($context["base_url"]) ? $context["base_url"] : null)));
        echo "\"><img src=\"";
        echo (isset($context["theme_url"]) ? $context["theme_url"] : null);
        echo "/images/title.png\" alt=\"title\"></a>
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "partials/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 3,  19 => 1,);
    }
}
