<?php

/* definitions.html.twig */
class __TwigTemplate_1f5fb0ceadeb03f37fdbb6bf0ec5f03996eca8c429b7f95cb0a9452e860b9065 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("partials/base.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "partials/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "  <header id=\"header\">
  </header><!-- /header -->
    <nav class=\"definition-list\">
        ";
        // line 7
        echo (isset($context["alphabetical"]) ? $context["alphabetical"] : null);
        echo "
    </nav>  
";
    }

    public function getTemplateName()
    {
        return "definitions.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 7,  39 => 4,  36 => 3,  11 => 1,);
    }
}
