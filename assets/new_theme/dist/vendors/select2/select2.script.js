(function ($) {
  "use strict";
  $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: 'style',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });

  $(".multiple-token").select2({
    tags: true,
    tokenSeparators: [',', ' ']
  });

  $(".tokenizationSelect2").select2({
    placeholder: "Choose..", //placeholder
    theme: 'bootstrap4',
    tags: true,
    tokenSeparators: ['/', ',', ';', " "]
  });


})(jQuery);
