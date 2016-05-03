<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Types;

class DefinitionprintPlugin extends Plugin{

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
    $definitionPages = $page->find('/definitions')->children();

    $this->enable(['onTwigSiteVariables' => ['onTwigSiteVariables', 0]]);
  }

  public function build_list($definitionPages){

    $cur_let = null;
    $html = '<ul>';
    foreach ($definitionPages as $page) {
      if($page->name() == "page.md"){
        $titre = $page->title();
        $text = $page->content();
        $first_let = (is_numeric(strtoupper(substr($titre,0,1))) ? '#' : strtoupper(substr($titre,0,1)));
        if ($cur_let !== $first_let){
          $cur_let = $first_let;
          $letter = '<li class="letter"><span>' . $cur_let . '</span></li>';
          $html .= $letter;
        }
        $html .= '<li class="definitions"><h3>' . $titre . '</h3><p>' . $text . '</p></li>';
      }
    }
    $html .= '</ul>';
    return $html;

  }

  public function onTwigSiteVariables()
  {
    $pages = $this->grav['pages'];
    $page = $this->grav['page'];
    // get all definition pages
    $definitionPages = $page->find('/definitions')->children();

    $this->grav['twig']->twig_vars['definitionprint'] = $this->build_list($definitionPages);
  }

} // end file
?>