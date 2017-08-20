<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class video_block extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Video';

    /**
     * This is where all the fields for the brick will be set-
     */
    public function set_fields()
    {

        $this->add_field(new acf_fields\select('Videoquelle', 'choose_source', '1408171746c',
            array(
                'multiple' => '0',
                'allow_null' => '0',
                'choices' => [
                    'html5' => 'HTML5 (mp4)',
                    'youtube' => 'YouTube'
                    ],
                'default_value' => [],
                'return_format' => 'value',

                )
            ));

        $this->add_field(new acf_fields\text('Video ID', 'video_source_id', '1408171750a',
            array(
                'multiple' => '0',
                'allow_null' => '0',
                'choices' => [
                    'html5' => 'HTML5 (mp4)',
                    'youtube' => 'YouTube'
                    ],
                'default_value' => '',
                'return_format' => 'value',
                'conditional_logic' => [
                        [
                            [
                                'field' => '1408171746c',
                                'operator' => '==',
                                'value' => 'youtube'
                            ]
                        ]
                    ],
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
