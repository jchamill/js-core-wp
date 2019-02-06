<?php if( $loop->have_posts() ): ?>
  <?php if( ! empty( $instance['title'] ) ) print $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>

  <div class="people-featured">
    <ul class="people">
      <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
        <?php $job_title = \JS_Core\Modules\Structure::get_field( 'crb_job_title' ); ?>
        <li>
          <div class="post-block">
            <a href="<?php print esc_url( get_permalink() ); ?>">
              <div class="post-image">
                <?php the_post_thumbnail( $instance['attachment_size'], array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
              </div>
              <div class="post-content">
                <h5 class="person-name"><?php the_title(); ?></h5>
                <?php if ($job_title): ?>
                  <p class="person-title"><?php print $job_title; ?></p>
                <?php endif; ?>
              </div>
            </a>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
  <?php wp_reset_postdata(); ?>

<?php endif; ?>