<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Types;

class DefinitionPlugin extends Plugin{

  public static function getSubscribedEvents(){
    return [
        'onPluginsInitialized' => ['onPluginsInitialized', 0]
    ];
  }
   
/**
* Initialize configuration
*/
  public function onPluginsInitialized(){
      if ($this->isAdmin()) {
          $this->active = false;
          return;
      }
      $this->enable([
          'onPageInitialized' => ['onPageInitialized', 0]
      ]);
  }

  /**
   * Process
   *
   */
  public function onPageInitialized()
  {

    /** @var Cache $cache */
    $cache = $this->grav['cache'];
    /** @var Pages $pages */
    $pages = $this->grav['pages'];
    /** @var Page $page */
    $page = $this->grav['page'];

    // get all definition pages
    $definitionPages = $page->children();

    $this->enable(['onTwigSiteVariables' => ['onTwigSiteVariables', 0]]);
  }

  public function build_list($definitionPages){

    $cur_let = null;
    $html = '<ul>';
    foreach ($definitionPages as $page) {
      if($page->name() == "page.md"){
        $titre = $page->title();
        $excerpt = $page->content();
        $excerpt = substr($excerpt, 0, 150);
        $excerpt = substr($excerpt,0,strrpos($excerpt," ")); 
        $etc = " ...";  
        $excerpt = $excerpt.$etc; 
        $first_let = (is_numeric(strtoupper(substr($titre,0,1))) ? '#' : strtoupper(substr($titre,0,1)));
        if ($cur_let !== $first_let){
          $cur_let = $first_let;
          $letter = '<li class="letter item"><span>' . $cur_let . '</span></li>';
          $html .= $letter;
        }
        $html .= '<li class="definition item"><a href="' . $page->url(). '" title="' . $titre .'"><h3>' . $titre . '</h3><p>' . $excerpt . '</p></a></li>';
      }
    }
    $html .= '</ul>';
    return $html;

  }

  public function onTwigSiteVariables()
  {
    $page = $this->grav['page'];
    // get all definition pages
    $definitionPages = $page->children();

    $this->grav['twig']->twig_vars['definition'] = $this->build_list($definitionPages);
  }

} // end file
?>