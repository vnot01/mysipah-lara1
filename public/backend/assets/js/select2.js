// npm package: select2
// github link: https://github.com/select2/select2

// $(function() {
//   'use strict'
//   if ($(".js-example-basic-single").length) {
//     $(".js-example-basic-single").select2();
//   }
//   if ($(".js-example-basic-multiple").length) {
//     $(".js-example-basic-multiple").select2();
//   }

// });

jQuery(function() {
    $('.my-select2').each(function() {
      $(this).select2({
        // theme: "bootstrap-5",
        dropdownParent: $(this).parent(), // fix select2 search input focus bug
      })
    })
    // fix select2 bootstrap modal scroll bug
    $(document).on('select2:close', '.my-select2', function(e) {
      var evt = "scroll.select2"
      $(e.target).parents().off(evt)
      $(window).off(evt)
    })

  })
