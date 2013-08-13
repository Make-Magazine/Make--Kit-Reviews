<?php
// The Query
global $cap;
	if ($cap->feat_1) {
		// do stuff	
	$arr = array($cap->feat_1,$cap->feat_2,$cap->feat_3);
}

$query = new WP_Query( array( 'post__in' => $arr ) ); 
// The Loop
while ( $query->have_posts() ) : $query->the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('slider'); ?> >
	
	<div class="feat">
		<a href="<?php the_permalink(); ?>">
			<?php	if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('post', 'secondary-image')) :
				MultiPostThumbnails::the_post_thumbnail('post', 'secondary-image'); endif; ?>
		</a>
	</div>
	
	<div class="blurb">
	
		<span class="released">Just Reviewed</span>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php js_truncate_post('8', '...'); ?></p>
		<a href="<?php the_permalink(); ?>" class="label important readmore">Read On &rarr;</a>
	
	</div>

	<div class="minis">
	
		<ul>
			<?php
			reset($arr);
			while (list(, $value) = each($arr)) {
				echo '<li class="click'.$value.'">';
				echo get_the_post_thumbnail($value, 'small-thumb');
				echo '</li>';
			} ?>
		</ul>
	
	</div>

	

</div>
<div class="clear"></div>
<?php endwhile; ?>

<?php wp_reset_postdata(); ?>