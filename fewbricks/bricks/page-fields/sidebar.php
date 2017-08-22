<?php

namespace fewbricks\bricks\page_fields;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;
use fewbricks\bricks\project_brick as project_brick;

use Mj\Utils;
/**
 * Class video
 * @package fewbricks\bricks
 */
class sidebar extends project_brick
{
  public function set_fields() {

    $this->add_field(new acf_fields\radio('Sidebar Position', 'sidebar_position', '1608171822a',
      array(
        'allow_null' => 0,
        'choices' => [
          'sidebar_left' => 'Links',
          'sidebar_right' => 'Rechts'
          ],
        'return_format' => 'value',
        'default_value' => [
          'sidebar_left'
          ],
        'wrapper' => [
          'width' => 25
          ],
          'layout' => 'vertical'
        )
      ));

    $this->add_field(new acf_fields\radio('Sidebar Größe', 'sidebar_col_size', '1608171825a',
      array(
        'allow_null' => 0,
        'choices' => [
          '4' => 'Col 4',
          '3' => 'Col 3'
          ],
        'return_format' => 'value',
        'default_value' => [
          'sidebar_left'
          ],
        'wrapper' => [
          'width' => 25
          ],
          'layout' => 'vertical'
        )
      ));
  }

  /**
   * Determine whether to show the sidebar
   * @return bool
   */
  public function display_sidebar()
  {
      $display;
      isset($display) || $display = false;

      if(class_exists('acf')) {
        if($this->get_field('sidebar_type'))
          $display = true;
      }

      return apply_filters('mj/frontend/display_sidebar', $display);
  }

  public function get_sidebar() {
      $sidebar = 'sidebar-primary';

      if(class_exists('acf')) {
        if($this->get_field('sidebar_type')) {
          $sidebar = $this->get_field('sidebar_type');
        }
      }
      return $sidebar;
  }

  public function get_main_classes() {
    $main_classes = [];
    // get position
    $sidebar_position = self::get_position();
    // get size
    $sidebar_size = self::get_sidebar_size_num();
    $main_size = self::get_main_size_num();

    if($sidebar_position === "sidebar_left") {
      $main_classes[] = "push-lg-$sidebar_size";
    }

    $main_classes[] = "col-lg-$main_size";

    return apply_filters('mj/frontend/main_classes', join(' ', $main_classes));
  }

  public function get_sidebar_classes() {
    $sidebar_classes = [];
    // get position
    $sidebar_position = self::get_position();
    // get size
    $sidebar_size = self::get_sidebar_size_num();
    $main_size = self::get_main_size_num();

    if($sidebar_position === "sidebar_left") {
      $sidebar_classes[] = "pull-lg-$main_size sidebar-left";
    } else {
      $sidebar_classes[] = "sidebar-right";
    }

    $sidebar_classes[] = "col-lg-$sidebar_size";

    return apply_filters('mj/frontend/sidebar_classes', join(' ', $sidebar_classes));
  }

  private function get_sidebar_size_num()
  {
    $size = 4;
    if(class_exists('acf')) {
      if($this->get_field('sidebar_col_size')) {
        $size = $this->get_field('sidebar_col_size');
      }
    }
    return intval($size);
  }


  private function get_main_size_num() {
    $sidebar_size = self::get_sidebar_size_num();

    if($sidebar_size === 3) {
      $size = 9;
    } elseif($sidebar_size === 4) {
      $size = 8;
    }

    return $size;
  }

  private function get_position() {
    $position = "";
    if(class_exists('acf')) {
      if($this->get_field('sidebar_position')) {
        $position = $this->get_field('sidebar_position');
      }
    }
    return $position;
  }
}
