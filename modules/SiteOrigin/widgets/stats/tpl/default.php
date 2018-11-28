<?php if( ! empty( $instance['items'] ) ): ?>
  <div class="stats-widget">
    <?php foreach( $instance['items'] as $i => $item ): ?>
      <?php $classes = array('stat'); ?>
      <div class="<?php print implode( ' ', $classes ); ?>">
        <h5><?php print $item['prefix']; ?><span class="stat-counter" data-from="0" data-to="<?php print $item['number']; ?>"><?php print number_format( $item['number'] ); ?></span><?php print $item['suffix']; ?></h5>
        <p><?php print $item['subject']; ?></p>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
