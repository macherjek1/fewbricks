<?php
namespace fewbricks\bricks;
use fewbricks\acf\fields as acf_fields;
/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class row_options extends project_brick
{
  /**
   * @var string
   */
  protected $label;

  function __construct($name = '', $key = '') {
    parent::__construct($name, $key);
    $this->label = __('Zeilen Einstellung', 'mj');
  }


  public function set_fields() {
    // zeile id
    $this->add_field(new acf_fields\text('Zeilen ID', 'page_block_id', '1408171211f'));

    // hintergrundart
    $this->add_field(new acf_fields\radio('Hintergrundart', 'background-type', '1408171213f',
      array(
        'instructions' => 'Wählen Sie zwischen verschiedenen Hintergrundarten',
        'layout' => 'vertical',
        'choices' => [
          'background-color' => 'Hintergrundfarbe',
          'background-image' => 'Hintergrundbild'
        ],
        'default_value' => 'background-color',
        )
      ));

    // hintergrundfarbe
    $this->add_field(new acf_fields\color_picker('Hintergrund-Farbe', 'background-color', '1408171445b',
      array(
        'conditional_logic' => [
            [
              [
              'field' => '1408171213f',
              'operator' => '==',
              'value' => 'background-color'
              ]
            ]
          ]
        )
      ));

    // hintergrundbild
    $this->add_field(new acf_fields\image('Hintergrund-Bild', 'mj_background-image', '1408171454b',
      array(
        'conditional_logic' => [
            [
              [
              'field' => '1408171213f',
              'operator' => '==',
              'value' => 'background-image'
              ]
            ]
          ],
          'return_format' => 'url',
          'preview_size' => 'thumbnail',
          'library' => 'all'
        )
      ));

    // parallax
    $this->add_field(new acf_fields\true_false('Parallax', 'parallax', '1408171501b',
      array(
        'conditional_logic' => [
            [
              [
              'field' => '1408171213f',
              'operator' => '==',
              'value' => 'background-image'
              ]
            ]
          ]
        )
      ));

    // abstand nach oben
    $this->add_field(new acf_fields\radio('Abstand nach oben', 'padding', '1408171505b',
      array(
        'layout' => 'vertical',
        'choices' => [
          'no_padding' => 'Kein Abstand',
          'small_padding' => 'Kleiner Abstand',
          'default_padding' => 'Normaler Abstand',
          'big_padding' => 'Großer Abstand'
          ],
        'return_format' => 'value'
        )
      ));

    // abstand nach unten
    $this->add_field(new acf_fields\true_false('Abstand nach unten', 'bottom-padding', '1408171512b',
      array(
        'default_value' => '1'
        )
      ));

    // no gutter
    $this->add_field(new acf_fields\true_false('No Gutter', 'no_gutter', '1408171520',
      array(
        'default_value' => '1'
        )
      ));

    // container breite
    $this->add_field(new acf_fields\select('Container Breite', 'width', '1408171523b',
      array(
        'multiple' => '0',
        'allow_null' => '0',
        'choices' => [
          'section-container' => 'section-container',
          'section-container--content' => 'section-container--content',
          'section-container--content-wide' => 'section-container--content-wide',
          'section-container--with-border' => 'section-container--with-border'
          ],
        'return_format' => 'value'
        )
      ));

    // custom css
    $this->add_field(new acf_fields\text('Custom CSS', 'custom_css', '1408171527b',
      array(
        'instructions' => 'Mehrere classes mit , getrennt'
        )
      ));
  }

  // public function get_brick_html() {}
}
