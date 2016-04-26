$(document).ready(function(){
  $('li.dropdown').addClass('open');
  $('li.dropdown').on({
    "shown.bs.dropdown": function() { $(this).data('closable', false); },
    "click":             function() { $(this).data('closable', true);  },
    "hide.bs.dropdown":  function() { return $(this).data('closable'); }
  });

  $('li.dropdown a').click(function(){
    $(this).toggleClass('active');
  });

  // 1st carousel, main
  $('.gallery-main').flickity({
    // options
    cellAlign: 'left',
    contain: true,
    imagesLoaded: true
  });

  // 2nd carousel, navigation
  $('.gallery-top-bar').flickity({
    asNavFor: '.gallery-main',
  });

  // Slides inside of carousel
  $(function() {
    $('.rslides').responsiveSlides({
      pager: true
    });
  });
});
  