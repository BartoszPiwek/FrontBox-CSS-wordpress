<?php
/*=========================================================================
|| FILE: themes_taxonomy.php
===========================================================================
|| When a visitor clicks on a hyperlink to category, tag or custom taxonomy,
|| WordPress displays a page of posts in reverse chronological order 
|| filtered by that taxonomy.
===========================================================================
||	Item template:
    register_taxonomy(  
        'games-status',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'games',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Status',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'games-status', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );
=========================================================================*/

function frontbox_taxonomy() { 

    //  Add here

}  
add_action( 'init', 'frontbox_taxonomy');

?>