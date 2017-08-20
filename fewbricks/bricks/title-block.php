<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class title_block extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Titel Element';

    /**
     * This is where all the fields for the brick will be set-
     */
    public function set_fields()
    {

        $this->add_field(new acf_fields\text('Titel', 'title', '1408171539t',
            array(
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                    ]
                )
            ));

        $this->add_field(new acf_fields\text('Subtitle', 'subtitle', '1408171541t',
            array(
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                    ]
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
