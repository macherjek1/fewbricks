<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;

use fewbricks\bricks;
use fewbricks\bricks\page_fields as page_fields;


use Mj\Utils;

/**
 * Class video
 * @package fewbricks\bricks
 */
class Page extends project_brick
{

    /**
     * @var string
     */
    protected $label = 'Page';

    /**
     * Singleton Instance
     * @var site_config
     */
    private $site_config;


    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new page('page');
        }
        return $inst;
    }

    /**
     * Return Hero instance
     * @return hero
     */
    public static function hero() {
      return self::getInstance()->get_child_brick('page_fields\hero', 'Hero');
    }

    /**
     * Return Sidebar instance
     * @return hero
     */
    public static function sidebar() {
      return self::getInstance()->get_child_brick('page_fields\sidebar', 'Sidebar');
    }

    /**
     * Return Options instance
     * @return hero
     */
    public static function options() {
      return self::getInstance()->get_child_brick('page_fields\options', 'Options');
    }

    /**
     *  Set Fields for Page Settings
     */
    public function set_fields()
    {
      //TAB
      $this->add_field(new acf_fields\tab('Titel', '', '1608171617a', array('placement' => 'left')));
      $this->add_field(new acf_fields\text('Titel', 'mj_cb_title', '1608171621a', array('instructions' => 'Möchten Sie den Titel überschreiben?')));
      $this->add_field(new acf_fields\text('Subtitel', 'mj_cb_subtitle', '1608171623a'));

      // Add Hero
      $this->add_field(new acf_fields\tab('Hero Design', '', '1608171643a', array('placement' => 'left')));
      $this->add_brick(new page_fields\hero('Hero', '95d8s6x106'));

      // Add Sidebar
      $this->add_field(new acf_fields\tab('Sidebar', '', '1608171747a', array('allow_null' => '1')));
      $this->add_brick(new page_fields\sidebar('Sidebar', '7n38wt7gz8jo'));

      // Add Site Options
      $this->add_field(new acf_fields\tab('Seiten Einstellungen', '', '1608171828a', array('placement' => 'left')));
      $this->add_brick(new page_fields\options('Options', '7n38wt7gz8jo'));
    }

}
