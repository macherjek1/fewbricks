<?php if($this->get_field('gallery_title')) : ?>
<h2><?= $this->get_field( 'gallery_title' ) ?></h2>
<?php endif; ?>
<?php
if ( function_exists( 'envira_gallery' ) ) {
  envira_gallery( $this->get_field( 'gallery_id' ) );
}
?>