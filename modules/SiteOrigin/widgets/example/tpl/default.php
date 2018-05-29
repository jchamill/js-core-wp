<?php if( ! empty( $instance['items'] ) ): ?>
  <?php if( ! empty( $instance['title'] ) ) print $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>
  <div class="widget-example">
    <?php foreach( $instance['items'] as $i => $item ): ?>
      <?php $classes = array( 'widget-example-' . $i ); ?>
      <?php
        // Dynamic classes.
        if ( $i % 2 == 0 ) {
          $classes[] = 'widget-example-even';
        }
      ?>
      <div class="<?php print implode( ' ', $classes ); ?>">
        <h5><?php print $item['title']; ?></h5>
        <?php
        if ( ! empty( $item['image'] ) ) {
          print wp_get_attachment_image( $item['image'], $instance['display']['attachment_size'], false, array(
            'title' => $item['title']
          ) );
        }
        ?>

        <div class="entry-content">
          <?php print $item['content']; ?>
        </div>

        <?php if ( ! empty( $item['url'] ) ): ?>
          <p><a href="<?php print esc_url( $item['url'] ); ?>" class="btn">Learn More</a></p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
