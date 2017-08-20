<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class keyfacts extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Keyfacts';

    /**
     * This is where all the fields for the brick will be set-
     */
    public function set_fields()
    {

        

    }

    /**
     * @return string|void
     */
    public function get_brick_html()
    {

        $level = $this->get_field('level');

        return '<h' . $level . '>' . $this->get_field('text') . '</h' . $level . '>';

    }

}