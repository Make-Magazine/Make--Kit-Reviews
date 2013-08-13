<?php get_header(); ?>

<div class="container">

		<div class="row">
	
			<div class="span10 schtuff">
			
				<div class="inner">
				
					<article>
						
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							
							<div class="entry-content white_box">
														
								<?php
									if ( function_exists( 'vip_safe_wp_remote_get' ) )
										$response = vip_safe_wp_remote_get( 'http://blogs.oreilly.com/makedeal/kits.html' );
									else
										$response = wp_remote_get( 'http://blogs.oreilly.com/makedeal/kits.html' );
									if( is_wp_error( $response ) ) {
									   echo 'Something went wrong!';
									} else {
									   echo $response['body'];
									}
									
								?>
								
								<div class="clear"></div>
								
								<div class="entry-meta">
								
									<?php edit_post_link('Fix me...'); ?>
								
								</div>
							
							</div>
							
						<?php endwhile; ?>
						
						<?php comments_template(); ?>
						
						<?php else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
					
					</article>
					
				 </div><!--//Inner-->
			</div>
	
			<?php get_sidebar(); ?>
			
		</div>
		
</div>

<?php get_footer(); ?>