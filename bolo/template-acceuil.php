<?php

	/*

	Template Name: acceuil

	*/

	get_header(); ?>
	<div class="col-md-1"></div>
	<div class="col-md-1 no_padding">
		<img src="<?php bloginfo('template_directory'); ?>/img/menu.png" alt="kirael logo" class='header_kirael'>
	</div>
	<dif class="clearfix"></dif>

	<div class="col-md-1"></div>
	<div class="col-md-10 no_padding">
	
		<div id="myCarousel" class="carousel homepage slide">
			<!-- Carousel items -->
			<div class="carousel-inner">
				<!-- first slid -->
			    <div class="item active">
			        <div class="row">
			            <img src="<?php echo get_template_directory_uri();?>/img/home/slider_0.jpg" alt="Image" class="img-responsive">
			        </div>
			        <!--/row-->
			    </div>
			    <!-- second slid -->
			    <div class="item ">
			        <div class="row">
			            <img src="<?php echo get_template_directory_uri();?>/img/home/slider_0.jpg" alt="Image" class="img-responsive">
			        </div>
			        <!--/row-->
			    </div>
			        
			        <!-- add more items to display more-->
			        <!--/item-->
			</div>
			<!--/carousel-inner--> <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span></span></a>

			<a class="right carousel-control" href="#myCarousel" data-slide="next"><span></span></a>
		</div>
			<!--/myCarousel-->
		
		<!-- calendar -->
		<?php get_template_part('calendar');?>
		<!-- isotope -->
		<?php get_template_part('isotope');?>

	</div>
	<div id="col-md-1"></div>
	<!-- map -->
	<?php
		$the_query = new WP_Query(array(
					'post_type' => 'post'));
		$loop = new WP_Query(array(
			'post_type' => 'voyages',
			'orderby' => 'title',
			'order'   => 'ASC'
		));
		if ( $the_query->have_posts() )
		{
			$posts = [];
			$cats = [];

			while ( $loop->have_posts() ) : $loop->the_post();
			  $cat = get_the_terms(get_the_ID(), 'themes_categories')[0]->name;
			  if (!in_array($cat, $cats))
			  	$cats[] = $cat;
			  $posts[$cat][] = [get_the_title(), get_the_post_thumbnail_url()];
			endwhile;
		}
	?>
	<div class="col-md-12 no_padding home_map_container">		
		<div id="mapContainer">
			<div id="map"></div>
			<?php if ($posts): ?>
			<div id="mapCarousel" class="carousel homepage slide">
				<!-- Carousel items -->
				<span class="close">x</span>
				<?php  for ($i=0; $i < count($cats); $i++): ?>
					<div class="carousel-inner" id="<?php echo $cats[$i]?>">
						<!-- first slid -->
						<?php 
						$post = $posts[$cats[$i]];
						for ($j=0; $j < count($post); $j++): ?>
						    <div class="item <?php echo (($j == 0)? 'active' : '')?>">
						        <div class="row">
						            <img src="<?php echo $post[$j][1] ?>" alt="<?php echo $post[$j][0] ?>" class="img-responsive">
						        </div>
						        <!--/row-->
						    </div>
						<?php endfor; ?>
					</div>



					<?php endfor; ?>
				<?php endif; ?>
				<!--/carousel-inner-->
				<a class="left carousel-control" href="#mapCarousel" data-slide="prev"><span></span></a>

				<a class="right carousel-control" href="#mapCarousel" data-slide="next"><span></span></a>
			</div>

		</div>
	</div>


<?php	get_footer(); ?>
