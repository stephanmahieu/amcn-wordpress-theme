/**
 * ==== BASED ON navigation.js FROM TWENTY SEVENTEEN THEME ====
 *
 * Handles toggling the navigation menu for small screens and
 * accessibility for submenu items.
 */


// Better focus for hidden submenu items for accessibility.
( function( $ ) {

    var masthead       = $( '#masthead' );
    var siteNavigation = masthead.find( '.primary-navigation > div > ul, .secondary-navigation > div > ul' );

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    (function() {
        if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

                $( document.body ).on( 'touchstart.twentyfourteen', function( e ) {
                    if ( ! $( e.target ).closest(  '.primary-navigation li, .secondary-navigation li' ).length ) {
                        $( '.primary-navigation li, .secondary-navigation li' ).removeClass( 'focus' );
                    }
                });

                siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).on( 'touchstart.twentyfourteen', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                });

            } else {
                siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.twentyfourteen' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize.twentyfourteen', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigation.find( 'a' ).on( 'focus.twentyfourteen blur.twentyfourteen', function() {
            $( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
        });

    })();

} )( jQuery );
