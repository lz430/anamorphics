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
});
  