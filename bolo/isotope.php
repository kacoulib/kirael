		<div id="isopefilter">
			<?php
				// The Query
				$the_query = new WP_Query(array(
					'post_type' => 'post'));

				// The Loop
				if ( $the_query->have_posts() ) {
					$txt = '';
					$cats = get_categories();
					$i = 0;

					$txt .= '<ul class="filter_name">';
					while ($cats[$i]) {
						if (is_page_template('template-portfolio.php'))
							if ($i == 0)
								$txt .= '<li class="all my_btn active">all</li>';
							
						$txt .= '<li class="my_btn '.$cats[$i]->name.'">'.$cats[$i]->name.'</li>';
						if (is_page_template('template-acceuil.php'))
							if ($i >= 1)
							{
								$txt .= '<li><a href="'.get_permalink(get_page_by_title("portfolio")).'"><span class="orange">+</span>plus</a></li>';
								break;
							}
						$i++;
					}
					$txt .= '<ul class="grid row">';
					function getCat($e) {
				    	return($e->name);
					}
					$i = 0;
					while ( $the_query->have_posts() ) {
						$cats = array();
						$cat = get_the_category();
						$cats = array_map("getCat", $cat);
						$the_query->the_post();

						if (!empty(get_the_post_thumbnail()))
							$txt .= '<li class="grid-item transition  '.join(' ', $cats).'"><a href="'.get_the_permalink().'">' . get_the_post_thumbnail() . '</a></li>';
						if (is_page_template('template-acceuil.php'))
							if ($i == 5)
								break;
						$i++;
					}
					$txt .=  '</ul>';
					echo $txt;
					wp_reset_postdata();
				}
			?>
		</div>