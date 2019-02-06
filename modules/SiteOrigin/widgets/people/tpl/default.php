<?php if( ! empty( $people ) ): ?>
  <?php if( ! empty( $instance['title'] ) ) print $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>

  <?php $show_groups = sizeof( $people ) > 1; ?>
  <?php $wrapper_classes = $show_groups ? array( 'people-group' ) : array(); ?>
  <?php foreach ( $people as $person ): ?>
    <div id="people-category-<?php print $person['term_id']; ?>" class="<?php print implode( ' ', $wrapper_classes ); ?>">
      <?php if ( $show_groups ): ?>
        <h3 class="person-category"><?php print $person['name']; ?></h3>
      <?php endif; ?>
      <ul class="people">
        <?php while ( $person['loop']->have_posts() ): $person['loop']->the_post(); ?>
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
      <?php wp_reset_postdata(); ?>
    </div>
  <?php endforeach; ?>
<?php endif; ?>