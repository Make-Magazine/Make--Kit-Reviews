<?php get_header(); ?>

<div class="container">

		<div class="row">
	
			<div class="span10 schtuff">
			
				<div class="inner">
	
					<article class="white_box">
					
						<h2>Latest Reviews</h2>
						
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
							<?php the_post_thumbnail('review-large'); ?>
							
							<div class="white_box">
							
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								
								<?php the_content(); ?>

							</div>
							
							<div class="clear"></div>
							
						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
					
					</article>
					
					<?php if(function_exists('wp_paginate')) { wp_paginate(); } ?>
					
				 </div><!--//Inner-->
			</div>
	
			<?php get_sidebar(); ?>
			
		</div>
		
</div>

<?php get_footer(); ?>