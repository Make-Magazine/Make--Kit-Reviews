<div class="white_box">

	<div class="mastheader">
		
		<p class="heavy">Top Categories</p>
		
		<ul class="unstyled">
			<li id="electronics" class="active-slide">Electronics</li>
			<li id="robotics">Robotics</li>
			<li id="tools">Tools</li>
			<li id="toys">Toys</li>
		</ul>
	
	</div>
	
	<div id="slideshow">
	
	<?php
	// The Query
	$the_query = new WP_Query( 'category_name=electronics-and-controllers&posts_per_page=4' ); ?>
	<ul class="unstyled feature_box electronics " >
	
	<?php
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		echo '<li><a href="';
		the_permalink();
		echo '">';
		the_post_thumbnail('feat-cat-thumb');
		the_title('<p class="overlay transparent">', '</p></a>');
		$string = get_the_excerpt();
		$brackets = array(' [',']');
		echo '<p class="blurbish">'.str_replace($brackets, '', $string).'</p><p><a href="'. get_permalink() .'" class="label important">Read more &rarr;</a></p>';
		
		echo '</li>';
	endwhile;
	
	// Reset Post Data
	wp_reset_postdata();
	echo '</ul>';
	?>
	
	
	<?php
	// The Query
	$the_query = new WP_Query( 'category_name=robotics&posts_per_page=4' ); ?>
	<ul class="unstyled feature_box robotics" >
	
	<?php
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		echo '<li><a href="';
		the_permalink();
		echo '">';
		the_post_thumbnail('feat-cat-thumb');
		the_title('<p class="overlay transparent">', '</p></a>');
		$string = get_the_excerpt();
		$brackets = array(' [',']');
		echo '<p class="blurbish">'.str_replace($brackets, '', $string).'</p><p><a href="'. get_permalink() .'" class="label important">Read more &rarr;</a></p>';
		
		echo '</li>';
	endwhile;
	
	// Reset Post Data
	wp_reset_postdata();
	echo '</ul>';
	?>
	
	<?php
	// The Query
	$the_query = new WP_Query( 'category_name=tools-workshop&posts_per_page=4' ); ?>
	<ul class="unstyled feature_box tools" >
	
	<?php
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		echo '<li><a href="';
		the_permalink();
		echo '">';
		the_post_thumbnail('feat-cat-thumb');
		the_title('<p class="overlay transparent">', '</p></a>');
		$string = get_the_excerpt();
		$brackets = array(' [',']');
		echo '<p class="blurbish">'.str_replace($brackets, '', $string).'</p><p><a href="'. get_permalink() .'" class="label important">Read more &rarr;</a></p>';
		
		echo '</li>';
	endwhile;
	
	// Reset Post Data
	wp_reset_postdata();
	echo '</ul>';
	?>
	
	<?php
	// The Query
	$the_query = new WP_Query( 'category_name=toys-games&posts_per_page=4' ); ?>
	<ul class="unstyled feature_box toys" >
	
	<?php
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		echo '<li><a href="';
		the_permalink();
		echo '">';
		the_post_thumbnail('feat-cat-thumb');
		the_title('<p class="overlay transparent">', '</p></a>');
		$string = get_the_excerpt();
		$brackets = array(' [',']');
		echo '<p class="blurbish">'.str_replace($brackets, '', $string).'</p><p><a href="'. get_permalink() .'" class="label important">Read more &rarr;</a></p>';
		
		echo '</li>';
	endwhile;
	
	// Reset Post Data
	wp_reset_postdata();
	echo '</ul>';
	?>
	
	</div>

</div>

<div class="clear"></div>