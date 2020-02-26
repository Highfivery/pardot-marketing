(function( $ ) {
  'use strict';

  var PardotMarketingForms = {
    init: function() {
      var $forms = $('.pardotmarketing-form');

      $forms.each(function() {
        var $form = $( this );

        $form.submit(function(e) {
          e.preventDefault();

          $form.addClass( 'is-submitting' );
          $(this).attr('action', $(this).data('url'));

          $(this).unbind('submit').submit();
        });
      });
    },
    elementorInit: function() {
      var urlParams = new URLSearchParams(window.location.search);
      if(urlParams.has('popup')) {
        setTimeout(function() {
          document.querySelector(urlParams.get('popup')).click();
        }, 1000);
      }
    }
  };

  $(function() {
    PardotMarketingForms.elementorInit();
    PardotMarketingForms.init();
  });

  $( document ).on( 'elementor/popup/show', function() {
    PardotMarketingForms.init();
  });
})(jQuery);
