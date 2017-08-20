<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;
/**
 * Class video
 * @package fewbricks\bricks
 */
class flexible_brick extends project_brick
{

    private $includeCols;

    /**
     * @var string
     */
    protected $label = 'Flexible Bricks';

    public function __construct($name = '', $key = '', $includeCols = false) {
        parent::__construct($name, $key);
        $this->includeCols = $includeCols;
    }

    /**
     *
     */
    public function set_fields()
    {
      $fc = (new acf_fields\flexible_content('Modules', 'modules', '1509111554i', [
        'button_label' => __('Neues Element', 'mj'),
        'label_placement' => 'top',
        'instruction_placement' => 'label',
      ]));

      // title block
      $l = new layout('', 'text', '1603250048a');
      $l->add_brick(new title_block('title_block', '1603250048b'));
      $fc->add_layout($l);
      // content block
      $l = new layout('', 'content_block', '1408171258a');
      $l->add_brick(new content_block('content_block', '1408171258b'));
      $fc->add_layout($l);

      // image box
      $l = new layout('', 'image_box', '1509111557u');
      $l->add_brick(new image_box('image_box', '1509111556s'));
      $fc->add_layout($l);

      // call to action
      $l = new layout('', 'call_to_action', '1509111555a');
      $l->add_brick(new call_to_action('call_to_action', '1509111556x'));
      $fc->add_layout($l);

      // gallery
      $l = new layout('', 'custom_gallery', '1408171738a');
      $l->add_brick(new custom_gallery('custom_gallery', '1408171738b'));
      $fc->add_layout($l);

      // video block
      $l = new layout('', 'video_block', '1408171744a');
      $l->add_brick(new video_block('video_block', '1408171744b'));
      $fc->add_layout($l);

      // shortcode
      $l = new layout('', 'shortcode', '1408171754a');
      $l->add_brick(new shortcode('shortcode', '1408171754b'));
      $fc->add_layout($l);

      // page block
      $l = new layout('', 'page_block', '1408171801a');
      $l->add_brick(new page_block('page_block', '1408171801b'));
      $fc->add_layout($l);

      // keyfacts
      $l = new layout('', 'keyfacts', '1408171825a');
      $l->add_brick(new keyfacts('keyfacts', '1408171825b'));
      $fc->add_layout($l);

      if($this->includeCols)
      {
        // 2 Columns
        $l = new layout('2 Spalten Layout', 'columns-2', 'ba667dd8a98a');
        $l->add_brick((new flexible_columns('fcol2', '837c1b678d6d'))->set_arg('nr_of_columns', 2));
        $fc->add_layout($l);

        // 3 Columns
        $l = new layout('3 Spalten Layout', 'columns-3', '166b7a8b7973');
        $l->add_brick((new flexible_columns('fcol3', '59d73d51cd0d'))->set_arg('nr_of_columns', 3));
        $fc->add_layout($l);
      }

      do_action_ref_array('fewbricks/visual-editor/flexible/set_fields', array(&$fc) );

      $this->add_flexible_content($fc);
    }

    /**
     * @return string
     */
    protected function get_brick_html()
    {
      $html = '';
      while ($this->have_rows('modules')) {
          $this->the_row();
          $html .= acf_fields\flexible_content::get_sub_field_brick_instance()->get_html();
      }
      return $html;
    }
}
