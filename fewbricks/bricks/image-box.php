<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class image_box extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Image Box';

    /**
     * This is where all the fields for the brick will be set-
     */
    public function set_fields()
    {

        $this->add_field(new acf_fields\image('Image', 'image', '1408171553t',
            array(
                'instructions' => 'Recommended size: 1920 x 1440px',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all'
                )
            ));

        $this->add_field(new acf_fields\select('Seitenverhältnis', 'aspect_ratio', '1408171553p',
            array(
                'multiple' => '0',
                'allow_null' => '0',
                'choices' => [
                    'auto' => 'Automatisch',
                    '3:2' => '3:2 (Presse Fotos)',
                    '16:9' => '16:9',
                    '4:3' => '4:3'
                    ],
                'default_value' => [
                    'auto'
                    ],
                'return_format' => 'value'
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
