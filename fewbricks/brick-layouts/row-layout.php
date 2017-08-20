<div <?= $this->get_attrs() ?>>
  <div <?= $this->get_width() ?>>
    <?php echo $html; ?>
    <?php if($this->get_field('parallax')) : ?>
        <div class="dark-overlay"></div>
    <?php endif; ?>
  </div>
</div>
