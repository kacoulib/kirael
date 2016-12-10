<?php
  
function themes_taxonomy() {  
    register_taxonomy(  
        'themes_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'themes',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'liste des destination',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'themes', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );  
}  
add_action( 'init', 'themes_taxonomy');

  add_action( 'init', 'kc_cpt_voyage' );
  function kc_cpt_voyage() {
    $labels = array(
      'name' => __( 'Voyage'),
      'singular_name' => __( 'voyage' ),
      'all_items' => __( 'Tous les destination')
    );
    
    $args = array(
      'labels' => $labels,
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'title', 'thumbnail'),
      'taxonomies' => array( 'themes_categories' ),
      'query_var' => true
    );
    register_post_type('voyages',$args);
}