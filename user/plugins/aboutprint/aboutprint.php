<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Types;

class AboutprintPlugin extends Plugin{

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
    $about = $page->find('/about');

    $this->enable(['onTwigSiteVariables' => ['onTwigSiteVariables', 0]]);
  }

  public function build($about){
    $html = $about->content();
    return $html;
  }

  public function onTwigSiteVariables()
  {
    $pages = $this->grav['pages'];
    $page = $this->grav['page'];
    // get all definition pages
    $about = $page->find('/about');

    $this->grav['twig']->twig_vars['aboutprint'] = $this->build($about);
  }

} // end file
?>