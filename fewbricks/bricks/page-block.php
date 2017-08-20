<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class page_block extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Page Block';

    /**
     * This is where all the fields for the brick will be set-
     */
    public function set_fields()
    {

        $this->add_field(new acf_fields\text('Titel', 'mj_pageblock_title', '1408171803d'));

        $this->add_field(new acf_fields\text('Page Block', 'page_block_name', '1408171804a',
            array(
                'instructions' => 'Zeigt einen bestimmten Page-Block an (visual-editor/elements)* Diese Einstellung sollten nur Entwickler verwenden.',
                )
            ));

        $this->add_field(new acf_fields\post_type_selector('Post Type', 'post_type_name', '1408171812a',
            array(
                'select_type' => 1,
                )
            ));

        $this->add_field(new acf_fields\taxonomy('Post Type Kategorie', 'page_block_filter_taxonomy', '1408171819a',
            array(
                'taxonomy' => 'category',
                'field_type' => 'checkbox',
                'allow_null' => 0,
                'add_term' => 1,
                'save_terms' => 0,
                'load_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
                )
            ));

    }

    /**
     * @return string|void
     */
    public function get_brick_html()
    {
        return $this->get_brick_template_html();
    }

}
