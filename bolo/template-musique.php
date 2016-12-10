<?php

	/*

	Template Name: musique

	*/

	get_header(); ?>
	<span class="col-md-1"></span>
	<section class="col-md-10 fifty_bottom">
		<!-- section -->
		<section>
			<div class="h1_container">
				
			<h1 class="text-center active"><?php the_title(); ?></h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, ad repellat! Nesciunt, tempora, harum! Laudantium consectetur accusantium, minus nesciunt delectus corrupti, harum quas fugiat, officiis fugit ipsa aut omnis quam.</p>
			</div>
		<?php
			$the_query = new WP_Query(array('post_type' => 'musiques'));
		?>
		<ul class="display_modulo">
			
			<?php if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post(); ?>
				
				<!-- article -->
				<li id="post-<?php the_ID(); ?>" class="<?php echo ($i++ % 2 != 0)? 'put-right': '';?>">
					<div>
							
						<h3><?php echo ucfirst(the_title()); ?></h3>

						<?php the_content(); ?>
					</div>
					<span class="clearfix"></span>
				</li>
				
			<?php endwhile; endif; ?>
		</ul>
	
		</section>
		<!-- /section -->
	</section>
	<span class="col-md-1"></span>
	<div class="clearfix"></div>
<?php 
	get_footer(); ?>
