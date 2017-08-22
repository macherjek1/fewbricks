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
class hero extends project_brick
{

  const CUSTOMIZER_SECTION = 'mj_hero_section';

  const CUST_HERO_TYPE_SETTING = 'mj_hero_type';
  const CUST_HERO_VIDEO_URL = 'mj_hero_video_url';
  const CUST_HERO_HEIGHT_SETTING = 'mj_hero_height';

  public function display_hero() {
    return $this->get_type() !== "none";
  }

  public function set_fields()
  {
    //TAB

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
  }

  public function get_classnames() {
      $classNames = [];
      $option = get_theme_mod(self::CUST_HERO_HEIGHT_SETTING);

      if($option === null) {
        if(is_front_page())
            $className[] = "front big";
        elseif(is_home() || is_archive()) {
            $classNames[] = "small";
        }
        else {
            $classNames[] = "small";
        }
      } else {
        $classNames[] = $option;
      }

      // get page option (if set)
      if(class_exists('acf')) {
        if($this->get_field('mj_cb_hero_height')) {
          $classNames= [];
          $classNames[] = $this->get_field('mj_cb_hero_height');
        }
      }

      $classNames[] = $this->get_type();

      return apply_filters('mj/mj_get_hero_classnames', join(' ', $classNames));
  }

  public function get_options() {
  	return [
  		'classnames' => $this->get_classnames(),
  		'data_types' => $this->get_dataTypes(),
  		'title_wrapper' => $this->get_title_wrapper(),
  		'mj_cb_background_image' => $this->get_field('mj_cb_background_image')
  	];
  }

  public function get_dataTypes() {
      $data_attr = [];
      $hero_type = $this->get_type();


      // @TODO: needs a test, just fixed
      if($this->get_field('mj_cb_scrollToID')) {
        $data_attr['scroll-to'] = $this->get_field('mj_cb_scrollToID')  ;
      }

      if($hero_type !== "none") {
        $data_attr['data-node-type'] = $hero_type . "-block";
      }

      return apply_filters('mj/frontend/hero/get_data_types', Utils::attrToArray($data_attr));
  }

  public function get_title() {
    $title = "";
      if(is_front_page())
          $title = get_theme_mod('mj_header_image_title', 'Lorem ipsum');
      elseif(is_home()) {
          $postType = get_queried_object();
          $title = esc_html($postType->post_title);
      }
      elseif(is_post_type_archive()) {
          $title = post_type_archive_title();
      }
      elseif(is_search()) {
        $title = sprintf(__('Suchergebnisse %s', 'mj'), get_search_query());
      }
      elseif(is_404()) {
        $title = __("Nicht gefunden", "mj");
      } else {
        $title = get_the_title();
      }

      if( class_exists('acf') ) {
          if($this->get_field('mj_cb_title')) {
              $title = $this->get_field('mj_cb_title');
          }
      } else {
        $title = get_the_title();
      }

      return apply_filters('mj/mj_get_hero_title', $title);
  }

  /**
   * Get main title and subtitle if available
   * @return string
   */
  public function get_title_wrapper() {
    $title = $this->get_title();
    $subtitle = $this->get_subtitle();
    $html  = "<h1 class='hero__title'>$title</h1>";
    if($subtitle) {
      $html .= "<span class='hero__subtitle'>$subtitle</span>";
    }
    return apply_filters('mj/mj_get_title_wrapper',$html);
  }

  /**
   * Get Hero Subtitle if available
   * @return [type] [description]
   */
  public function get_subtitle() {
    if(class_exists('acf')) {
        if($this->get_field('mj_cb_subtitle')) {
            return $this->get_field('mj_cb_subtitle');
        }
    }
    return false;
  }

  /**
   * Get The Hero Type (Parallax, Slider, Text, None)
   * @return string
   */
  public function get_type() {
    // get global option
    $option = get_theme_mod(self::CUST_HERO_TYPE_SETTING);

    if(is_front_page()) {
      $option = 'none';
    }

    // Check if WooCommerce (Shop Extension) is active
    if(class_exists('WooCommerce')) {
        $option = "text";
    }

    // Check if ACF is set
    if(class_exists('acf')) {
      if($this->get_field('mj_cb_hero_type')) {
        $option = $this->get_field('mj_cb_hero_type');
      }
    }

    return apply_filters('mj/mj_get_hero_type',
    $option != null ? $option : 'parallax');
  }

  public function get_background_image() {
    $headerImg = false;

    // get page option (if set)
    if(class_exists('acf')) {
      if($this->get_field('mj_cb_background_image'))
        $headerImg = \App\mj_get_image($this->get_field('mj_cb_background_image'));
    }

    // get global option
    if(!$headerImg) {
      if(get_header_image()) {
        $headerImg = get_header_image();
      } else {
        $headerImg = get_template_directory_uri() . Assets::DEFAULT_IMAGE_2;
      }
    }
    return apply_filters('mj/mj_get_header_image_src', $headerImg);
  }

  public function get_video_url() {
    $videoUrl = false;

    // get page option (if set)
    if(class_exists('acf')) {
      if($this->get_field('mj_cb_video_url'))
        $videoUrl = $this->get_field('mj_cb_video_url');
    }

    // get global option
    if(!$videoUrl && get_theme_mod(self::CUST_HERO_VIDEO_URL)) {
      $videoUrl = get_theme_mod(self::CUST_HERO_VIDEO_URL);
    } elseif(!$videoUrl) {
      $videoUrl = Assets::DEFAULT_VIDEO;
    }
    return apply_filters('mj/mj_get_video_url', $videoUrl);
  }
}
