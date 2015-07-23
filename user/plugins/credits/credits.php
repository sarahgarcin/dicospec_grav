<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Types;

class CreditsPlugin extends Plugin{

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
    $creditPages = $page->children();

    $this->enable(['onTwigSiteVariables' => ['onTwigSiteVariables', 0]]);
  }

  public function build_credit($creditPages){

    $html = '<div class="credits effluves"><div class="credits-text">';
    foreach ($creditPages as $page) {
      if($page->name() == "credits.md"){
        $titre = $page->title();
        $text = $page->content();
        $html .= '<h2>'.$titre.'</h2>'. $text;
      }
    }
    $html .= '</div></div>';
    return $html;

  }

  public function onTwigSiteVariables()
  {
    $page = $this->grav['page'];
    // get all definition pages
    $creditPages = $page->children();

    $this->grav['twig']->twig_vars['credits'] = $this->build_credit($creditPages);
  }

} // end file
?>