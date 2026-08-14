(function ($) {
  'use strict';

  if (typeof $ === 'undefined') {
    return;
  }

  $(function () {
  if ($.fn.tree) {
    $('[data-widget="tree"]').tree();
  }

  $(document).on('click', '.sidebar-menu a[href="#"]', function (event) {
    event.preventDefault();
  });

  if (window.location.hash === '#') {
    history.replaceState(null, document.title, window.location.pathname + window.location.search);
  }
  });
})(window.jQuery);
