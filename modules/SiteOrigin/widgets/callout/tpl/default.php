<?php
$wrap_classes = array('callout-wrapper');
$content_classes = array('callout-content');
if ( ! empty( $instance['image'] ) ) {
  $wrap_classes[] = 'grid-container';
  $content_classes[] = 'grid-item-1';
}
if ( $instance['settings']['layout'] == 'reverse' ) {
  $wrap_classes[] = 'reverse';
}
?>
<div class="<?php print implode( ' ', $wrap_classes ); ?>">

  <?php if ( ! empty( $instance['image'] ) ): ?>
    <div class="callout-image grid-item-1">
      <?php
      print wp_get_attachment_image( $instance['image'], $instance['attachment_size'], false, array(
        'title' => $instance['title']
      ) );
      ?>
    </div>
  <?php endif; ?>

  <div class="<?php print implode( ' ', $content_classes ); ?>">
    <?php if ( ! empty( $instance['title'] ) ): ?>
      <h1><?php print $instance['title']; ?></h1>
    <?php endif; ?>

    <?php if ( ! empty( $instance['content'] ) ): ?>
      <div class="entry-content">
        <?php print $instance['content']; ?>
      </div>
    <?php endif; ?>

    <?php if ( ! empty( $instance['cta']['url'] ) ): ?>
      <div class="callout-cta">
        <a href="<?php print esc_url( $instance['cta']['url'] ); ?>" class="btn"><?php print $instance['cta']['text']; ?></a>
      </div>
    <?php endif; ?>
  </div>
</div>