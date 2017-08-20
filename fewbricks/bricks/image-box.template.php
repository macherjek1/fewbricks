<?php
$field = array(
	'image' => $this->get_field( 'image' )
);
?>

<?php if ( ! empty( $field['image'] ) ): ?>
    <div class="image-wrapper">
        <figure>
			<?= App\mj_get_responsive_img($field['image'], 'full', 'lazyload', 'MACHERJEK_THUMBNAIL_SIZES', $this->get_field('aspect_ratio')); ?>
        </figure>
    </div>
<?php endif; ?>