<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Types;

class CouvendprintPlugin extends Plugin{

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

    $home = $page->find('/home');

    $this->enable(['onTwigSiteVariables' => ['onTwigSiteVariables', 0]]);
  }

  public function build($home){

    $html = $home->content();
    return $html;

  }

  public function onTwigSiteVariables()
  {
    $pages = $this->grav['pages'];
    $page = $this->grav['page'];

    $home = $page->find('/home');

    $this->grav['twig']->twig_vars['couvendprint'] = $this->build($home);
  }

} // end file
?>