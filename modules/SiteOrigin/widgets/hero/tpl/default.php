<?php if( ! empty( $instance['items'] ) ): ?>
  <?php foreach( $instance['items'] as $i => $item ): ?>
    <?php
    $styles = array();
    if ( ! empty( $item['image'] ) ) {
      $styles['background-image'] = 'url(' . array_shift( wp_get_attachment_image_src( $item['image'], $item['display']['attachment_size'] ) ) . ')';
    }
    ?>
    <div class="hero-item so-light-text" style="<?php print \JS_Core\Modules\SiteOrigin::get_style_attrs($styles); ?>">
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
<?php endif; ?>
