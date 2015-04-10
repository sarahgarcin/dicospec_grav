<?php

/* default.html.twig */
class __TwigTemplate_4b82fcc6440edae58508afb1fbb70f4cd8f9662279260facbc362bac6eb755f9 extends Twig_Template
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
        echo "\t<header id=\"header\">
\t\t";
        // line 5
        $this->env->loadTemplate("partials/header.html.twig")->display($context);
        // line 6
        echo "\t</header><!-- /header -->

\t<section id=\"content\" class=\"row\">
\t\t";
        // line 9
        $this->env->loadTemplate("partials/menu.html.twig")->display($context);
        // line 10
        echo "\t\t<div class=\"large-12 columns\">
\t\t\t";
        // line 11
        echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "content", array());
        echo "\t
\t\t</div>
\t</section>
    
";
    }

    public function getTemplateName()
    {
        return "default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 11,  51 => 10,  49 => 9,  44 => 6,  42 => 5,  39 => 4,  36 => 3,  11 => 1,);
    }
}
