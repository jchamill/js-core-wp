(function($) {
  if ((typeof typenow === 'undefined' || typenow !== 'person') || typeof adminpage === 'undefined' || (adminpage !== 'post-new-php' && adminpage !== 'post-php')) {
    return;
  }

  $(document).ready(function() {
    $('#publish, #save-post').click(function(e) {
      if ($('#taxonomy-person_category input:checked').length == 0) {
        $('#post').prepend('<div class="error notice"><p>Category is required.</p></div>');
        $('#taxonomy-person_category').addClass('error');
        return false;
      }
    });
  });
})(jQuery);