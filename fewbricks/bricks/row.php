<?php
namespace fewbricks\bricks;
use Mj\Utils;

use fewbricks\acf\fields as acf_fields;
use fewbricks\acf\layout;
/**
 * Class video
 * @package fewbricks\bricks
 */
class row extends project_brick
{
    /**
     * @var string
     */
    protected $label;

    function __construct($name = '', $key = '') {
      parent::__construct($name, $key);
      $this->label = __('Zeile', 'mj');
    }

    /**
     * Set fields
     */
    public function set_fields()
    {
      //tab ROW
      $this->add_field(new acf_fields\tab('Layout', 'tab_layout', '1408171201f', array('placement' => 'left')));
        $this->add_brick(new flexible_brick('Row', 'd7fef96ac62e', true));

      // tab DESIGN
      $this->add_field(new acf_fields\tab('Designanpassung', 'tab_design', '1408171210f', array('placement' => 'left')));
        $this->add_brick(new row_options('Row Options','sbrfclox9alw'));
    }

    /**
     * @return string
     */
    protected function get_brick_html() {
      return $this->get_child_brick('flexible_brick', 'Row')->get_html();
    }

    /**
     * Get Row Options Shorthand function
     * @return row_options
     */
    protected function get_options() {
      return $this->get_child_brick('row_options', 'Row Options');
    }

    public function get_attrs($opts = array()) {
      return join(' ' , [$this->get_id(), $this->get_dataTypes(), $this->get_style(), $this->get_classnames()]);
    }

    public function get_style($style = '') {
    	$data_attr = [];

    	switch ($this->get_options()->get_field('background-type')) {
    		case 'background-color':
    			$style = $this->get_options()->get_field('background-color') ? 'background-color:'.$this->get_options()->get_field('background-color').';' : '';
    			break;
    		case 'mj_background-image':
    			$style .= $this->get_options()->get_field('mj_background-image') ? 'background-image:'.$this->get_options()->get_field('mj_background-image') : '';
    		default:
    			$style = "";
    			break;
    	}

      $data_attr['style'] = $style;
      return apply_filters('mj/mj_get_pageblock_style', Utils::attrToArray($data_attr));
    }

    public function get_id() {
      $id = $this->get_options()->get_field('page_block_id') ? $this->get_options()->get_field('page_block_id') : 'page-block-'.Utils::getToken(4);
      return 'id="'.$id.'"';
    }

    public function get_dataTypes() {
        $data_attr = [];

        if($this->get_options()->get_field('parallax')) {
          $imgurl = $this->get_options()->get_field('mj_background-image');
          $data_attr = [
            'data-parallax' => 'scroll',
            'data-image-src' => $this->get_options()->get_field('mj_background-image') ? $imgurl : '',
          ];
        }

        return apply_filters('mj/mj_get_pageblock_dataTypes', Utils::attrToArray($data_attr));
    }

    public function get_classnames() {
    	$classes = [];

    	// look at _parallax.scss -> .parallax-section
    	// for parallax we use height
    	if($this->get_options()->get_field('background-type') === "mj_background-image") {
    		switch($this->get_options()->get_field('padding')) {
    			case 'small_padding':
    				$classes[] = 'small';
    				break;
    			case 'default_padding':
    				$classes[] = 'default';
    				break;
    			case 'big_padding':
    				$classes[] = 'big';
    				break;
    			default:
    				$classes[] = '';
    				break;
    		}
    	// no parallax means real padding and not height
    	} else {
    		switch($this->get_options()->get_field('padding')) {
    			case 'small_padding':
    				$classes[] = 'spacer-pt small';
    				break;
    			case 'default_padding':
    				$classes[] = 'spacer-pt';
    				break;
    			default:
    				break;
    		}
    	}

    	// use bottom padding?
    	if($this->get_options()->get_field('bottom-padding')) {
    		$classes[] = 'spacer-pb';
    	}

    	// use parrallax?
    	if($this->get_options()->get_field('parallax')) {
    		$classes[] = 'parallax-block';
    	}

      if($this->get_options()->get_field('custom_css')){
        $custom_classes = $this->get_options()->get_field('custom_css');
        $cust_class_arr = explode(',', $custom_classes);
        foreach($cust_class_arr as $custom):
          $classes[] = $custom;
        endforeach;
      }

      $classes = [
        'class' => join(' ',  array_map( 'esc_attr', $classes ))
      ];

      return apply_filters('mj/mj_get_pageblock_classnames', Utils::attrToArray($classes));
    }

    public function get_width() {
      $classes = [
        'class' => $this->get_options()->get_field('width') ? $this->get_options()->get_field('width') : 'section-container'
      ];
      return apply_filters('mj/mj_get_pageblock_width', Utils::attrToArray($classes));
    }
}
