<?php
  
  add_action( 'init', 'kc_cpt_musique' );
  function kc_cpt_musique() {
    $labels = array(
      'name' => __( 'Musique'),
      'singular_name' => __( 'musique' ),
      'all_items' => __( 'Tous les livres')
    );
    
    $args = array(
      'labels' => $labels,
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'title', 'editor', 'theme'),
      'query_var' => true
    );
    register_post_type('musiques',$args);
}