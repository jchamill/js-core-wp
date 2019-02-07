<?php if( ! empty( $instance['items'] ) ): ?>
  <?php $BackgroundImage = \JS_Core\Helpers\BackgroundImage::getInstance(); ?>

  <?php if ( sizeof( $instance['items'] ) > 1 ): ?>
    <div class="hero-slider">
  <?php endif; ?>

  <?php foreach( $instance['items'] as $i => $item ): ?>
    <?php
    $index = $BackgroundImage->get_next_index();
    $config = array(
      'selector' => '.widget .hero-' . $index,
      'image' => $item['image'],
    );
    $BackgroundImage->add_image( $config );
    ?>
    <div class="hero-item so-light-text hero-<?php print $index; ?>">
      <div class="container">
        <h1><?php print $item['title']; ?></h1>

        <div class="entry-content">
          <?php print $item['content']; ?>
        </div>

        <?php if ( ! empty( $item['cta']['url'] ) ): ?>
          <div class="hero-cta">
            <a href="<?php print esc_url( $item['cta']['url'] ); ?>" class="btn"><?php print $item['cta']['text']; ?></a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
  <?php if ( sizeof( $instance['items'] ) > 1 ): ?>
    </div>
  <?php endif; ?>

  <?php if ( ! empty( $instance['jump']['row_id'] ) ): ?>
    <div class="hero-down">
      <a href="#<?php print esc_attr( $instance['jump']['row_id'] ); ?>" class="jump-to"><span class="screen-reader-text">Skip to Content</span></a>
    </div>
  <?php endif; ?>

<?php endif; ?>