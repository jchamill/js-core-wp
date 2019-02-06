<?php if( ! empty( $instance['items'] ) ): ?>
  <?php if( ! empty( $instance['title'] ) ) print $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>
  <div class="cards-widget grid-container">
    <?php foreach( $instance['items'] as $i => $item ): ?>
      <div class="grid-item-1">
        <div class="card-container">
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

            <?php if ( ! empty( $item['title'] ) ): ?>
              <h3><?php print $item['title']; ?></h3>
            <?php endif; ?>

            <?php if ( ! empty( $item['content'] ) ): ?>
              <div class="entry-content">
                <?php print $item['content']; ?>
              </div>
            <?php endif; ?>

          <?php if ( ! empty( $item['url'] ) ): ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
