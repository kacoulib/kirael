<?php

	/*

	Template Name: acceuil

	*/

	get_header(); ?>
	<div id="myCarousel" class="carousel slide">
		<!-- Carousel items -->
		<div class="carousel-inner">
			<!-- first slid -->
		    <div class="item active">
		        <div class="row">
		            <img src="<?php echo get_template_directory_uri();?>/img/home/kirael-carlos.jpg" alt="Image" class="img-responsive">
		        </div>
		        <!--/row-->
		    </div>
		    <!-- second slid -->
		    <div class="item ">
		        <div class="row">
		            <img src="<?php echo get_template_directory_uri();?>/img/home/kirael-carlos.jpg" alt="Image" class="img-responsive">
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
	
	<div id="isopefilter"></div>


<?php	get_footer(); ?>
