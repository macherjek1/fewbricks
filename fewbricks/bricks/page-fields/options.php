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
class options extends project_brick
{

  public function set_fields() {
    $this->add_field(new acf_fields\text('Scroll to ID', 'mj_cb_scrollToID', '1608171831a',
      array(
        'instructions' => 'Verwendbar als ID für Single Pages wo das Menü zu diesem Punkt scrollt.',
        'default_value' => 'home'
        )));

    $this->add_field(new acf_fields\text('Node Type', 'node_type_name', '1608171832a'));
    $this->add_field(new acf_fields\select('Container Breite', 'container_width', '1608171833a',
      array(
        'allow_null' => 1,
        'instruction' => 'Der Container der über den gesamten Inhaltsbereich gezogen werden soll.',
        'choices' => [
          'section-container' => 'section-container',
          'section-container--content' => 'section-container--content',
          'section-container--content-wide' => 'section-container--content-wide',
          'section-container--with-border' => 'section-container--with-border',
          'container' => 'container'
          ],
        'return_format' => 'value',
        'default_value' => [
          'sidebar_left'
          ]
        )
      ));


     $this->add_field(new acf_fields\true_false('Auf der Startseite anzeigen', 'show_on_frontpage', '1608171839a', array('instructions' => 'Entscheidet ob zuerst der Visual Editor oder die Main Wordpress Loop angezeigt wird (siehe page.php)',
      'default_value' => 0
      )));

     $this->add_field(new acf_fields\true_false('Main Content on Top', 'main_content_on_top', '1608171837a', array(
      'default_value' => 0
      )));

      $this->add_field(new acf_fields\select('Seitenverhältnis', 'aspect_ratio', '1608171731a',
        array(
          'allow_null' => 0,
          'choices' => [
            'auto' => 'Automatisch',
            '3x2' => '3x2',
            '4x3' => '4x3',
            '16x9' => '16x9',
            '16x10' => '16x10',
            '2x3' => '2x3',
            '3x4' => '3x4',
            '9x16' => '9x16',
            '10x16' => '10x16'
            ],
          'return_format' => 'value'
          )
        ));
  }


      public function get_attrs($opts = array()) {
        return join(' ' , [$this->get_id(), $this->get_data_types(), $this->get_classnames()]);
      }

      public function get_inner_attrs() {
        return $this->get_field('container_width') ? 'class="'.$this->get_field('container_width').'"' : '';
      }

      public function get_id() {
        return apply_filters('mj/frontend/pagesection/get_id', sprintf('id="%s"',
        'page-content-'.Utils::get_current_pagename_id()));
      }

      public function get_classnames() {
        return apply_filters('mj/frontend/pagesection/get_classnames', sprintf('class="%s"',
        join(' ', [
          'page-content',
          'page-content-ajax',
          'wrap'
        ])));
      }

      public function get_data_types() {
          $data_attr = [
            'data-node-name' => Utils::get_current_pagename_id(),
            'data-node-type' => $this->get_data_node_type(),
            'data-meta-title' => get_the_title()
          ];
          return apply_filters('mj/frontend/pagesection/get_data_types', Utils::attrToArray($data_attr));
      }

      private function get_data_node_type() {
        $node_type = 'page';

        if(is_single()) {
          $node_type = "single-post";
        }

        if($this->get_field('node_type_name')) {
          $node_type = $this->get_field('node_type_name');
        }

        return $node_type;
      }

      /**
       * @return string
       */
      protected function get_brick_html()
      {
        return '';
      }

}
