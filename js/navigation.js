/**
 * ==== BASED ON navigation.js FROM TWENTYTWELVE THEME ====
 *
 * Handles toggling the navigation menu for small screens and
 * accessibility for submenu items.
 */


// Better focus for hidden submenu items for accessibility.
( function( $ ) {
	$( '.primary-navigation, .secondary-navigation'  ).find( 'a' ).on( 'focus.twentyfourteen blur.twentyfourteen', function() {
		$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
	} );

  if ( 'ontouchstart' in window ) {
    $('body').on( 'touchstart.twentyfourteen',  '.menu-item-has-children > a, .page_item_has_children > a', function( e ) {
      var el = $( this ).parent( 'li' );

      if ( ! el.hasClass( 'focus' ) ) {
        e.preventDefault();
        el.toggleClass( 'focus' );
        el.siblings( '.focus').removeClass( 'focus' );
      }
    } );
  }
} )( jQuery );
