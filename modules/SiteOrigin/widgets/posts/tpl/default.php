<?php if( ! empty( $instance['title'] ) ) print $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>

<?php if ( $instance['style'] === 'list' ): ?>
  <?php
  /**
   * List style display.
   */
  ?>
  <ul class="posts-style-list">
    <?php while ($loop->have_posts()): $loop->the_post(); ?>
      <li>
        <div class="post-block">
          <a href="<?php print esc_url( get_permalink() ); ?>">
            <p class="post-date"><?php print get_the_date('M j'); ?></p>
            <h4><?php print get_the_title(); ?></h4>
          </a>
        </div>
      </li>
    <?php endwhile; ?>
  </ul>
<?php elseif ( $instance['style'] === 'blocks' ): ?>
  <?php
  /**
   * Blocks style display.
   */
  ?>
  <ul class="posts-style-blocks">
    <?php while ($loop->have_posts()): $loop->the_post(); ?>
      <li>
        <div class="post-block">
          <a href="<?php print esc_url( get_permalink() ); ?>">
            <div class="post-image">
              <?php the_post_thumbnail( $instance['attachment_size'], array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
            </div>
            <div class="post-content">
              <p class="post-date"><?php print get_the_date('M j'); ?></p>
              <h4><?php print get_the_title(); ?></h4>
            </div>
          </a>
        </div>
      </li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>

<?php if ( $instance['display'] == 'all' && $loop->max_num_pages > 1 ): ?>
  <div class="pager">
    <?php
    print paginate_links( array(
      'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
      'total'        => $loop->max_num_pages,
      'current'      => max( 1, get_query_var( 'paged' ) ),
      'format'       => '?paged=%#%',
      'show_all'     => false,
      'type'         => 'plain',
      'end_size'     => 2,
      'mid_size'     => 1,
      'prev_next'    => true,
      'prev_text'    => sprintf( '<i></i> %1$s', __( 'Prev', 'js-core' ) ),
      'next_text'    => sprintf( '%1$s <i></i>', __( 'Next', 'js-core' ) ),
      'add_args'     => false,
      'add_fragment' => '',
    ) );
    ?>
  </div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>