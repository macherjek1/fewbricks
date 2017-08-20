<?php
$field = array(
	'subtitle'   => $this->get_field( 'subtitle' ),
	'title'      => $this->get_field( 'title' ),
	'content'    => $this->get_field( 'content' ),
);
?>
<div class="page-block content-block">
	<?php if ( ! empty( $field['subtitle'] ) ): ?>
		<h4><?= $field['subtitle']; ?></h4>
	<?php endif; ?>

	<?php if ( ! empty( $field['title'] ) ): ?>
		<h2><?= $field['title']; ?></h2>
	<?php endif; ?>

	<?= $field['content']; ?>
</div>

<?php 

//echo '<div class="page-block content-block"><h4>' . $this->get_field('subtitle') . '</h4><h2>' . $this->get_field('title') . '</h2>' . $this->get_field('content') . '</div>';