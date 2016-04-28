$(document).ready(function(){

  function dropDownOpen(){
    var bodyClass   = $('body').attr('class').toUpperCase();
    var menuItem    = $('li.dropdown > a.active');
    var menuText    = $('li.dropdown > a.active').text().toUpperCase();

    if(bodyClass === menuText){
      $(menuItem).parent().addClass('open');
      $('li.dropdown.open').on({
        "shown.bs.dropdown": function() { this.closable = false; },
        "click":             function() { this.closable = true; },
        "hide.bs.dropdown":  function() { return this.closable; }
      });
    }
  }
  
  dropDownOpen();

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
      auto: false,            
      pager: true,           
      pause: true,            
      nav: true,  //displays prevText and nextText
      pauseControls: true,    
      prevText: "Previous",   
      nextText: "Next"
    });
  });
});
  