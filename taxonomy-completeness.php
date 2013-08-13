<?php get_header(); ?>

<div class="container">

		<div class="row">
	
			<div class="span10 schtuff">
			
				<div class="inner">
	
					<article class="white_box">
					
						<h2 class="archive-header"><?php
				printf( __( 'Kit Completeness: %s', 'makezine' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			?></h2>
						<p class="alert-message block-message info descriptor">(5=Most complete) How complete is the kit? Plans only? That rates a 1. Parts bundles and kits rate 2–5, depending on whether it’s just key components, almost every- thing, or absolutely everything you need, including any unusual tools.</p>
						
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
							<div class="white_box">
								
								<?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
								
								<div class="span6 pull-right">
								
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><h2>
								
									<?php the_excerpt(); ?>
									
									<p class="cats"><span class="the_category"><?php the_category(' '); ?>:</span> <em><?php the_tags(''); ?></em></p>
									
								</div>
								
								<div class="clear"></div>
								
								<div class="border"></div>
								
							</div>
							
						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
						
						<?php if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
						
					</article>
					
				 </div><!--//Inner-->
			</div>
	
			<?php get_sidebar(); ?>
			
		</div>
		
</div>

<?php get_footer(); ?>