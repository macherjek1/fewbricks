<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class call_to_action extends project_brick
{

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'Call To Action';

    /**
     * This is where all the fields for the brick will be set-
     */
    public function set_fields()
    {

        $this->add_field(new acf_fields\tab('Content', '', '1408171701t',
            array(
                'placement' => 'left'
                )
            ));

        $this->add_field(new acf_fields\text('Titel', 'title', '1408171637t',
            array(
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                    ]
                )
            ));

        $this->add_field(new acf_fields\image('Background Image', 'background_image', '1408171638t',
            array(
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => ''
                    ],
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all'
                )
            ));

        $this->add_field(new acf_fields\select('Link Type', 'link_type', '1408171647t',
            array(
                'wrapper' => [
                    'width' => '33',
                    'class' => '',
                    'id' => ''
                    ],
                'multiple' => '0',
                'allow_null' => '0',
                'choices' => [
                    'internal' => 'Internal',
                    'external' => 'External'
                    ],
                'default_value' => [
                    'internal'
                    ],
                'return_format' => 'value'
                )
            ));

        $this->add_field(new acf_fields\page_link('Link', 'internal_link', '1408171650t',
            array(
                'conditional_logic' => [
                    [
                        [
                            'field' => '1408171647t',
                            'operator' => '==',
                            'value' => 'internal'
                            ]
                        ]
                    ],
                'wrapper' => [
                    'width' => '33',
                    'class' => '',
                    'id' => ''
                    ],
                'allow_archives' => '1'
                )
            ));

        $this->add_field(new acf_fields\url('Link', 'external_link', '1408171655t',
            array(
                'conditional_logic' => [
                    [
                        [
                            'field' => '1408171647t',
                            'operator' => '==',
                            'value' => 'external'
                            ]
                        ]
                    ],
                'wrapper' => [
                    'width' => '33',
                    'class' => '',
                    'id' => ''
                    ]
                )
            ));

        $this->add_field(new acf_fields\true_false('Open In New Window', 'open_in_new_window', '1408171657t',
            array(
                'wrapper' => [
                    'width' => '33',
                    'class' => '',
                    'id' => ''
                    ]
                )
            ));

        $this->add_field(new acf_fields\tab('Settings', '', '1408171703t',
            array(
                'placement' => 'left'
                )
            ));

        $this->add_field(new acf_fields\select('Mask', 'mask', '1408171704t',
            array(
                'multiple' => '0',
                'allow_null' => '0',
                'choices' => [
                    'white' => 'White',
                    'green' => 'Green'
                    ],
                'default_value' => [],
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
