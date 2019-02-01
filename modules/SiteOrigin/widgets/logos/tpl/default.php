<?php if( ! empty( $instance['items'] ) ): ?>
  <?php if( ! empty( $instance['title'] ) ) print $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>
  <div class="logos-widget">
    <?php foreach( $instance['items'] as $i => $item ): ?>
      <div class="logo-container">
        <?php if ( ! empty( $item['url'] ) ): ?>
          <a href="<?php print esc_url( $item['url'] ); ?>">
        <?php endif; ?>
        <?php
        if ( ! empty( $item['image'] ) ) {
          print wp_get_attachment_image( $item['image'], $instance['attachment_size'], false, array(
            'title' => $item['title']
          ) );
        }
        ?>
        <?php if ( ! empty( $item['url'] ) ): ?>
          </a>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
