<?php if( ! empty( $instance['categories'] ) ): ?>
  <div class="faqs">
    <?php $show_groups = sizeof( $instance['categories'] ) > 1; ?>
    <?php $wrapper_classes = $show_groups ? array( 'faq-group' ) : array( 'faq-no-group' ); ?>
    <?php foreach ( $instance['categories'] as $category ): ?>
      <div class="<?php print implode( ' ', $wrapper_classes ); ?>">
        <?php if ( $show_groups ): ?>
          <h3 class="faq-category"><?php print $category['category']; ?></h3>
        <?php endif; ?>
        <ol class="faq-content">
          <?php foreach ( $category['faqs'] as $faq ): ?>
            <?php $classes = array( 'faq' ); ?>
            <?php
            // Hash to identify the FAQ is more accurate, an index changes if order changes.
            $hash = substr( md5( $faq['title'] ), 0, 6 );
            if ( $_GET['post'] === $hash ) {
              $classes[] = 'faq-open';
            }
            ?>
            <li id="faq-<?php print $hash; ?>" class="<?php print implode( ' ', $classes ); ?>">
              <h5 class="faq-question"><?php print $faq['title']; ?></h5>
              <div class="faq-answer">
                <?php print nl2br( $faq['content'] ); ?>
              </div>
            </li>
          <?php endforeach; ?>
        </ol>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>