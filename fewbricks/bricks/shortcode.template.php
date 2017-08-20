<?php
$field = array(
	'shortcode' => $this->get_field( 'shortcode' ),
  	'width' => $this->get_field('width') ? $this->get_field('width') : 'section-container--content-wide',
);
?>
<div class="page-block shortcode-block spacer-pt spacer-pb">
		<div class="<?= $field['width'] ?>">
      <?= $field['shortcode']; ?>
		</div>
</div>