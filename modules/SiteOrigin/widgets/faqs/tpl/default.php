<?php if( ! empty( $faqs ) ): ?>
  <div class="faqs">
    <?php $show_groups = sizeof( $faqs ) > 1; ?>
    <?php $wrapper_classes = $show_groups ? array( 'faq-group' ) : array(); ?>
    <?php foreach ( $faqs as $faq ): ?>
      <div id="faq-<?php print $faq['term_id']; ?>" class="<?php print implode( ' ', $wrapper_classes ); ?>">
        <?php if ( $show_groups ): ?>
          <h3 class="faq-category"><?php print $faq['name']; ?></h3>
        <?php endif; ?>
        <ol class="faq-content">
          <?php while ( $faq['loop']->have_posts() ): $faq['loop']->the_post(); ?>
            <?php $classes = array( 'faq' ); ?>
            <?php
            if ( $_GET['post'] == get_the_ID() ) {
              $classes[] = 'faq-open';
            }
            ?>
            <li id="post-<?php print get_the_ID(); ?>" class="<?php print implode( ' ', $classes ); ?>">
              <h5 class="faq-question"><?php the_title(); ?></h5>
              <div class="faq-answer">
                <?php the_content(); ?>
              </div>
            </li>
          <?php endwhile; ?>
        </ol>
        <?php wp_reset_postdata(); ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>