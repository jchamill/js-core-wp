<?php if ( ! empty( $instance['url'] ) ): ?>
  <a href="<?php print esc_url( $instance['url'] ); ?>" class="<?php print esc_attr($instance['style']); ?>"><?php print $instance['title']; ?></a>
<?php endif; ?>