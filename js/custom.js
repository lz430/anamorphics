$(document).ready(function(){
  $('li.dropdown').addClass('open');
  $('.dropdown.keep-open').on({
    "shown.bs.dropdown": function() { this.closable = false; },
    "click":             function() { this.closable = true; },
    "hide.bs.dropdown":  function() { return this.closable; }
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
  