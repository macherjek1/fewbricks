<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;
/**
 * Class video
 * @package fewbricks\bricks
 */
class site_config extends project_brick
{

    /**
     * @var string
     */
    protected $label = 'Site-config';

    /**
     *
     */
    public function set_fields()
    {

    //TAB
    $this->add_field(new acf_fields\tab('Titel', '', '1608171617a', array('placement' => 'left')));
    $this->add_field(new acf_fields\text('Titel', 'mj_cb_title', '1608171621a', array('instructions' => 'Möchten Sie den Titel überschreiben?')));
    $this->add_field(new acf_fields\text('Subtitel', 'mj_cb_subtitle', '1608171623a'));
    
    //TAB
    $this->add_field(new acf_fields\tab('Hero Design', '', '1608171643a', array('placement' => 'left')));
    $this->add_field(new acf_fields\select('Hero Typ', 'mj_cb_hero_type', '1608171656a',
      array(
        'allow_null' => '1',
        'choices' => [
          'parallax' => 'Parallax',
          'slider' => 'Slider',
          'text' => 'Text',
          'video' => 'Video',
          'none' => 'Verstecken'
          ],
        'return_format' => 'value'
        )
      ));

    $this->add_field(new acf_fields\image('Hintergrundbild', 'mj_cb_background_image', '1608171659a',
      array(
        'conditional_logic' => [
          [
            [
              'field' => '1608171656a',
              'operator' => '==',
              'value' => 'parallax'
              ]
            ]
          ],
        'return_format' => 'array',
        'preview_size' => 'thumbnail',
        'library' => 'all'
        )
      ));

    $this->add_field(new acf_fields\text('Video URL', 'mj_cb_video_url', '1608171725a', array(
        'conditional_logic' => [
          [
            [
              'field' => '1608171656a',
              'operator' => '==',
              'value' => 'video'
              ]
            ]
          ]
        )
      ));

    $this->add_field(new acf_fields\select('Hero Größe', 'mj_cb_hero_height', '1608171727a',
      array(
        'allow_null' => '1',
        'requires' => '0',
        'choices' => [
          'full-height' => 'Full Height',
          'big' => 'Big',
          'small' => 'Small'
          ],
        'return_format' => 'value',
        'ajax' => 0,
        'ui' => 0
        )
      ));

    $this->add_field(new acf_fields\text('CSS Klasse', 'mj_cb_css_class', '1608171729a'));


    //TAB
    $this->add_field(new acf_fields\tab('Beitragsbild', '', '1608171734a', array('placement' => 'left')));
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

    //TAB
    $this->add_field(new acf_fields\tab('Call To Action', '', '1608171735a', array('placement' => 'left')));
    $this->add_field(new acf_fields\select('Link Type', 'link_type', '1608171736a',
      array(
        'allow_null' => 0,
        'choices' => [
          'internal' => 'Internal',
          'external' => 'External'
          ],
        'return_format' => 'value',
        'default_value' => [
          'internal'
          ],
        'wrapper' => [
          'width' => 25
          ]
        )
      ));
      $this->add_field(new acf_fields\page_link('Link', 'mj_cb_link', '1608171739a', array(
        'conditional_logic' => [
          [
            [
              'field' => '1608171736a',
              'operator' => '==',
              'value' => 'internal'
              ]
            ]
          ],
        'allow_archives' => 1
        )
      ));
      $this->add_field(new acf_fields\url('Link', 'mj_cb_link_extern', '1608171740a', array(
        'conditional_logic' => [
          [
            [
              'field' => '1608171736a',
              'operator' => '==',
              'value' => 'external'
              ]
            ]
          ]
        )
      ));

    //TAB
    $this->add_field(new acf_fields\tab('Sidebar', '', '1608171747a', array('placement' => 'left')));
    $this->add_field(new acf_fields\tab('Sidebar', 'sidebar_type', '1608171747a', array('allow_null' => '1')));
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

    //TAB
    $this->add_field(new acf_fields\tab('Seiten Einstellungen', '', '1608171828a', array('placement' => 'left')));
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

    }

    /**
     * @return string
     */
    protected function get_brick_html()
    {
      // $html = '';
      // if($this->have_rows('scpt_layouts')) {
      //   while ($this->have_rows('scpt_layouts')) {
      //       $this->the_row();
      //       $html .= acf_fields\flexible_content::get_sub_field_brick_instance()->get_html();
      //   }
      // }
      // return $html;
    }
}