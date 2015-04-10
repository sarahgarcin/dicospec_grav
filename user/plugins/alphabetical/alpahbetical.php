<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Types;

class Alphabetical_Order extends Plugin{ 

  private $pages;

  public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page) {
    $pages = $this->removeElementWithValue($pages, 'title', 'Welcome');
    $pages = $this->removeElementWithValue($pages, 'title', 'Définitions');
    $pages = $this->removeElementWithValue($pages, 'title', 'À propos');
    $this->pages = array();
    function compareByName($a, $b) {
      return strcasecmp($a["title"], $b["title"]);
    }
    usort($pages, 'compareByName');
    $this->pages = $pages;
  }// end function 



  public function before_render(&$twig_vars, &$twig){
    $twig_vars['alphabetical'] = $this->build_list($this->pages);
  }

  private function removeElementWithValue($array, $key, $value){
    foreach($array as $subKey => $subArray){
      if($subArray[$key] == $value){
        unset($array[$subKey]);
      }
    }
    return $array;
  }

  private function build_list($pages){
    $cur_let = null;
    $html = '<ul>';
    foreach ($pages as $page) {
      $titre = $page['title'];
      $excerpt = $page['excerpt'];
      $first_let = (is_numeric(strtoupper(substr($titre,0,1))) ? '#' : strtoupper(substr($titre,0,1)));
      if ($cur_let !== $first_let){
        $cur_let = $first_let;
        $letter = '<li class="letter large-2 columns">' . $cur_let . '<div class="wave"></div></li>';
        $html .= $letter;
      }
      $html .= '<li class="definition large-2 columns"><a href="' . $page['url']. '" title="' . $titre .'"><h3>' . $titre . '</h3><p>' . $excerpt . '</p></a></li>';
    }
    $html .= '</ul>';
    return $html;
  }

} // end file
?>