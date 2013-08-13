<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="author" content="<?php the_author(); ?>">

<?php if ( is_home() || is_front_page() ) {	?>

<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
<meta property="og:type" content="blog" />
<meta property="og:url" content="<?php echo home_url(); ?>" />
<meta property="fb:admins" content="712115840,690836447,34600017,804811257,203001338" />
<meta property="og:description" content="<?php echo get_bloginfo( 'description' ); ?>" />
<meta name="description" content="<?php echo get_bloginfo( 'description' ); ?>" />
<meta itemprop="name" content="<?php echo get_bloginfo('name'); ?>">
<meta itemprop="description" content="<?php echo get_bloginfo( 'description' ); ?>">

<?php 
}
?>		

<?php if ( is_author() ) { ?>

<?php $author = get_queried_object(); ?>


<meta property="og:title" content="<?php echo $author->display_name; ?>" />
<meta property="og:type" content="blog" />
<meta property="og:url" content="<?php echo get_author_posts_url( $author->ID ); ?>" />
<meta property="fb:admins" content="712115840,690836447,34600017,804811257,203001338" />
<meta property="og:description" content="<?php echo strip_tags($author->description) ?>" />
<meta name="description" content="<?php echo strip_tags($author->description) ?>" />
<meta itemprop="name" content="<?php echo get_bloginfo('name'); ?>">
<meta itemprop="description" content="<?php echo strip_tags($author->description); ?>">


<?php } ?>

<?php if(is_page() || is_single()) { ?>	
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="fb:admins" content="712115840,690836447,34600017,804811257,203001338" />
<?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
<meta property="og:image" content="<?php echo esc_attr( $thumbnail_src[0] ) ?>"/>
<meta property="og:description" content="<?php echo js_catch_that_desc() ?>" />
<meta name="description" content="<?php echo js_catch_that_desc() ?>" />
<meta itemprop="name" content="<?php the_title(); ?>">
<meta itemprop="description" content="<?php echo js_catch_that_desc() ?>">
<meta itemprop="image" content="<?php echo esc_attr( $thumbnail_src[0] ) ?>">


<?php } 
	else { ?>
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<?php }
?>


<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
<script type="text/javascript" src="http://use.typekit.com/fzm8sgx.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<!-- Le dfp schtuff-->

<?php get_template_part('dfp'); ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="topbar">
	<div class="fill">
		<div class="container">
		
		<ul class="nav">
			<li><a class="red" href="http://makezine.com">MAKE</a></li>
			<?php wp_nav_menu( array('menu' => 'Top Bar', 'container' => '','container_class' => 'menu-{menu slug}-container navi','items_wrap' => '%3$s', 'fallback_cb' => false )); ?>
		</ul>
		
		<form method="get" id="searchform" action="<?php home_url(); ?>/" class="pull-right">
			<input class="input-small span3" type="text" placeholder="Make: Kit Reviews" value="<?php echo esc_html($s, 1); ?>" name="s" id="s">
			<button class="btn" type="submit" value="search">Search</button>
		</form>
		
		</div><!--/Container-->
	</div><!--/fill-->
</div><!--/topbar-->

	<header>
	
		<div class="adbloc">
		
			<!-- Beginning Sync AdSlot 1 for Ad unit header ### size: [[728,90]]  -->
			<div id='div-gpt-ad-664089004995786621-1'>
				<script type='text/javascript'>
					googletag.display('div-gpt-ad-664089004995786621-1');
				</script>
			</div>
			<!-- End AdSlot 1 -->
		
		</div>
		
		<div class="container">
		
			<div class="row">
			
				<div class="span8 logo">
				
					<h1><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="Make: Kit Reviews" /><span class="noshow">Make: Kit Reviews</span></a></h1>
				
				</div>
				
				<div class="span8 source">
					
					<?php js_option('heading'); ?>
					<!--<img src="<?php bloginfo('stylesheet_directory'); ?>/images/source.png" alt="Your Trusted Source For Kit Reviews" />-->
				
				</div>
	
			</div>
			
			
			<ul class="navi">
				
				<?php wp_nav_menu( array('menu' => 'Primary Navigation', 'container' => '','container_class' => 'menu-{menu slug}-container navi','items_wrap' => '%3$s' )); ?>
				
			</ul>
			<?php if (!is_home()) { ?>
			<ul class="breadcrumb-kits">
				<?php if(class_exists('bcn_breadcrumb_trail'))
				{
					//Make new breadcrumb object
					$breadcrumb_trail = new bcn_breadcrumb_trail;
					//Setup our options
					//Set the home_title to Blog
					$breadcrumb_trail->opt['home_title'] = "Home";
					//Set the current item to be surrounded by a span element, start with the prefix
					$breadcrumb_trail->opt['current_item_prefix'] = '<li class="current">';
					//Set the suffix to close the span tag
					$breadcrumb_trail->opt['current_item_suffix'] = '</li>';
					$breadcrumb_trail->opt['separator'] = '&nbsp;/&nbsp;';
					//Fill the breadcrumb trail
					$breadcrumb_trail->fill();
					//Display the trail
					$breadcrumb_trail->display();
				} ?>
			</div>
			<?php }  ?>
			
		</div>
	
	</header>