<?php
$field = array(
	'subtitle'   => $this->get_field( 'subtitle' ),
	'title'      => $this->get_field( 'title' )
);

?>
<?php if(isset($field['title'])) : ?>
	<div class="section-container--content-wide center">
		<h2 class="h1"><?= $field['title']; ?></h2>
	</div>
<?php endif; ?>
<?php if(isset($field['subtitle'])) : ?>
	<div class="section-container--content center">
		<p class="subtitle"><?= $field['subtitle']; ?></p>
	</div>
<?php endif; ?>