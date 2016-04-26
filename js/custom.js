$(document).ready(function(){
  $('li.dropdown.open').addClass('open');
  $('li.dropdown.open').on('hide.bs.dropdown', function () {
    return false;
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
  