<?php

	/*

	Template Name: portfolio

	*/

	get_header(); 
?>

  <div id="page_portfolio">
    <div class="col-md-1"></div>
    <div class="col-md-10 no_padding">
      <?php get_template_part('isotope');?>
    </div>
    <div id="col-md-1"></div>
    <div class="clearfix"></div>
  </div>


<?php	get_footer(); ?>
