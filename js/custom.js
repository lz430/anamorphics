$(document).ready(function(){

	
	//// -------- Navigation Large Screens
	$('#explore-trigger').click(function() {
		$( '#explore-trigger').addClass( 'on' );
		$( '#sample-trigger').removeClass( 'on' );
		$( '#analyze-trigger').removeClass( 'on' );
		$( '#explore' ).fadeIn( 400, "linear");
		$( '#sample' ).fadeOut( 400, "linear");
		$( '#analyze' ).fadeOut( 400, "linear");
	});
	$('#sample-trigger').click(function() {
		$( '#explore-trigger').removeClass( 'on' );
		$( '#sample-trigger').addClass( 'on' );
		$( '#analyze-trigger').removeClass( 'on' );
		$( '#explore' ).fadeOut( 400, "linear");
		$( '#sample' ).fadeIn( 400, "linear");
		$( '#analyze' ).fadeOut( 400, "linear");
	});
	$('#analyze-trigger').click(function() {
		$( '#explore-trigger').removeClass( 'on' );
		$( '#sample-trigger').removeClass( 'on' );
		$( '#analyze-trigger').addClass( 'on' );
		$( '#explore' ).fadeOut( 400, "linear");
		$( '#sample' ).fadeOut( 400, "linear");
		$( '#analyze' ).fadeIn( 400, "linear");
	});

	//// -------- Navigation Small Screens
	$('#explore-trigger-sm').click(function() {
		$( '#explore-trigger-sm').addClass( 'on' );
		$( '#sample-trigger-sm').removeClass( 'on' );
		$( '#analyze-trigger-sm').removeClass( 'on' );
		$( '#explore-sm' ).slideDown( 400, "linear");
		$( '#sample-sm' ).slideUp( 400, "linear");
		$( '#analyze-sm' ).slideUp( 400, "linear");
	});
	$('#sample-trigger-sm').click(function() {
		$( '#explore-trigger-sm').removeClass( 'on' );
		$( '#sample-trigger-sm').addClass( 'on' );
		$( '#analyze-trigger-sm').removeClass( 'on' );
		$( '#explore-sm' ).slideUp( 400, "linear");
		$( '#sample-sm' ).slideDown( 400, "linear");
		$( '#analyze-sm' ).slideUp( 400, "linear");
	});
	$('#analyze-trigger-sm').click(function() {
		$( '#explore-trigger-sm').removeClass( 'on' );
		$( '#sample-trigger-sm').removeClass( 'on' );
		$( '#analyze-trigger-sm').addClass( 'on' );
		$( '#explore-sm' ).slideUp( 400, "linear");
		$( '#sample-sm' ).slideUp( 400, "linear");
		$( '#analyze-sm' ).slideDown( 400, "linear");
	});


});