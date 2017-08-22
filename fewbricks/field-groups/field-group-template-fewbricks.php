<?php

/**
 * Example file on how to build field groups.
 * "Namespacing" by prefixing variable names with "fewbricks" is optional
 * but is recommended to avoid the, clashing with other data in WordPress.
 */

use fewbricks\bricks AS bricks;
use fewbricks\acf AS fewacf;
use fewbricks\acf\fields AS acf_fields;

/**
 * Define where the field group should be used
 */
$fewbricks_fg_location = apply_filters('mj/fewbricks/visual-editor/location', [
    [
        [
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page',
        ],
    ]
]);

// /**
//  * Lets  create a bunch of field groups.
//  * The reason for increasing the order-argument by then is that it makes it easier to add new field groups
//  * in between existing ones later on.
//  * Make sure that you check out the bricks that we create instances of here to get a sense of what is going on.
//  */

//zeile
$fewbricks_fg = (new fewacf\field_group('Visual Editor', '1509111453p', $fewbricks_fg_location, 35));
$fewbricks_fc = (new acf_fields\flexible_content('Visual Editor', 'visual_editor', '150901113c', [
  'button_label' => __('Neue Zeile', 'mj'),
  'label_placement' => 'top',
  'instruction_placement' => 'label',
]));

$fewbricks_l = new fewacf\layout('', 'layout_1', '1509060003x');
$fewbricks_l->add_brick(new bricks\row('Visual Editor', '1509060002x'));
$fewbricks_fc->add_layout($fewbricks_l);

$fewbricks_fg->add_flexible_content($fewbricks_fc);
$fewbricks_fg->register();
