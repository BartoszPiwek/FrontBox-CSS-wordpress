<?php
/*=========================================================================
|| FILE: walker_nav_menu.php
===========================================================================
|| Core class used to implement an HTML list of nav menu items.
==========================================================================*/

class NAV_MENU extends Walker_Nav_Menu
{
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        $attributes  = 'class="nav__item"';

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output = 
            "<a $attributes>"
            . $title
            . "</a>";

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
        ,   $item_output
        ,   $item
        ,   $depth
        ,   $args
        );
    }
}
?>