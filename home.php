<?php get_header(); ?>

<div class="container">

		<div class="row">
	
			<div class="span10 schtuff">
			
				<div class="inner">

					<?php					
					global $cap;					
					if ($cap->bool_ad) { ?>
						<a href="<?php js_option('link_url'); ?>">
						<img alt="Top Kits of 2011" src="<?php js_option('image_url'); ?>">
						</a>
					<?php } ?>
					
	
					<?php get_template_part('slider'); ?>
					
					<?php get_template_part('feat', 'cats'); ?>
					
					<div class="recent">
					
						<h2>Latest Reviews</h2>
						
						<?php $query = new WP_Query( 'posts_per_page=5' );
						if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
						
						<div class="entry-small">
							
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-another', array('class' => 'alignleft')); ?></a>
							
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							
							<span class="make-me-smaller"><?php js_excerpt(100); ?></span></h3>
							
							<p class="cats"><span class="the_category"><?php the_category(' '); ?>:</span> <em><?php the_tags(''); ?></em></p>
							
							
						</div>

						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
					
					</div>
				
					<div class="recent">
					
						<h2>Recent Articles</h2>
						
						<?php 
						wp_reset_postdata();
						$query = new WP_Query( array( 'post_type' => 'blog-post', 'posts_per_page' => 5 )  );
						if ( $query->have_posts() ) : while ( $query ->have_posts() ) : $query->the_post(); ?> 	
						
						<div class="entry-small">
							
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-another', array('class' => 'alignleft')); ?></a>
							
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							
							<span class="make-me-smaller"><?php js_excerpt(100); ?></span></h3>
							
							<p class="cats"><span class="the_category"><?php the_category(' '); ?>:</span> <em><?php the_tags(''); ?></em></p>
							
							
						</div>

						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
					
					</div>
					
				 </div><!--//Inner-->
			</div>
	
			<?php get_sidebar(); ?>
			
		</div>
		
</div>

<?php get_footer(); ?>