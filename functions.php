<?php 
// Init WP.com VIP environment
require_once( WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php' );

wpcom_vip_load_plugin( 'easy-custom-fields' );
wpcom_vip_load_plugin( 'multiple-post-thumbnails' );
wpcom_vip_load_plugin( 'wp-page-numbers' );
wpcom_vip_load_plugin( 'cheezcap' );
wpcom_vip_load_plugin( 'breadcrumb-navxt' );
wpcom_vip_load_plugin( 'editorial-calendar' );
wpcom_vip_load_plugin( 'lazy-load' );

if (function_exists('wpcom_vip_sharing_twitter_via')) {
	wpcom_vip_sharing_twitter_via( 'make' );
}

require_once( dirname( __FILE__ ) . '/includes/cheezcap-config.php' ); 
require_once( dirname( __FILE__ ) . '/query-multiple-taxonomies/query-multiple-taxonomies.php' ); 

function js_option( $option_name ) {
		global $cap;
		echo $cap->$option_name;
	}

//This is deprecated. I really love the simplicity tho...

function js_excerpt($length){
	echo substr(get_the_excerpt(), 0, $length);
}

//New shorten function. Thanks @ninnypants

add_filter( 'get_the_excerpt', 'dont_add_review_to_excerpt', 5);

function dont_add_review_to_excerpt( $content ) {
	remove_filter( 'the_content', 'js_add_review');
	return $content;
}

function custom_excerpt_length(){
	global $excerpt_length;
	return $excerpt_length;
}

function custom_excerpt_more(){
	global $excerpt_more;
	return $excerpt_more;
}

function js_truncate_post($length = 55, $more = '[...]',$echo = true){
	global $excerpt_length, $excerpt_more;
	$excerpt_length = (int)$length;
	$excerpt_more = $more;
	remove_filter( 'the_excerpt', 'js_add_review');
	add_filter('excerpt_length', 'custom_excerpt_length');
	add_filter('excerpt_more', 'custom_excerpt_more');
	$excerpt = get_the_excerpt();
	remove_filter('excerpt_length', 'custom_excerpt_length');
	remove_filter('excerpt_more', 'custom_excerpt_more');
	if($echo) {
		echo $excerpt;
	}
	else {
		return $excerpt;
	}
}




if ( function_exists('register_sidebar') )
	register_sidebar();
    
    
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'small-thumb', 56, 56, true );
	add_image_size( 'small-another', 40, 40, true );
	add_image_size( 'feat-cat-thumb', 263, 117, true );
	add_image_size( 'review-large', 560, 9999 );
	add_image_size( 'featured-large', 352, 262 );

}

if (class_exists('MultiPostThumbnails')) { 
	new MultiPostThumbnails(array( 'label' => 'Secondary Image', 'id' => 'secondary-image', 'post_type' => 'post' )); 
	}


function taxes_init() {
	// create a new taxonomy
	register_taxonomy(
		'complexity',
		'post',
		array(
			'label' => __( 'Complexity' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'complexity' )
		)
	);
	register_taxonomy(
		'components',
		'post',
		array(
			'label' => __( 'Components' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'components' )
		)
	);

	register_taxonomy(
		'documentation',
		'post',
		array(
			'label' => __( 'Documentation' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'documentation' )
		)
	);

	register_taxonomy(
		'community',
		'post',
		array(
			'label' => __( 'Community' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'community' )
		)
	);

	register_taxonomy(
		'completeness',
		'post',
		array(
			'label' => __( 'Completeness' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'completeness' )
		)
	);

	register_taxonomy(
		'maker',
		'post',
		array(
			'label' => __( 'Maker/Company' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'maker' )
		)
	);

}
add_action( 'init', 'taxes_init' );

function js_terms($terms) {
	$terms = the_terms($post->ID, $terms);
	$count = count($terms);
	if ( $count > 0 ){
	 foreach ( $terms as $term ) {
	   echo 'term'.$term->name;
	 }
	}
 }

function js_ratings_box() {
	global $post; ?>


<div id="review_box">
							
<h3><span class="red">Make</span> Kit Reviews</h3>

<h5><?php echo get_the_term_list( $post->ID, 'maker', '', ', ', '' ); ?></h5>
<h2><?php the_title(); ?></h2>
<h4>
<?php
	$price = get_post_custom_values('Price');
	if (isset($price[0])) {
		echo $price[0];
	}
?>
</h4>

<div class="meta">

<?php
	$price = get_post_custom_values('CompanyURL');
	if (isset($price[0])) {
		echo '<a href="';
		echo esc_url( $price[0] );
		echo '" class="btn primary">Company Website</a>';
	}
?>

<?php
	$price = get_post_custom_values('ProductURL');
	if (isset($price[0])) {
		echo '<a href="';
		echo esc_url( $price[0] );
		echo '" class="btn danger">Buy now!</a>';
	}
?>

<!--<p><?php the_author_posts_link(); ?></p>-->
</div>

<dl class="ratings">
	<dt><span class="define" rel="popover" data-content="(1=Easy, 5=Difficult) Is the kit easy, moderate, or challenging to build for its most likely target audience? Kits clearly aimed at children would, for example, be rated differently from microcontroller kits." data-original-title="Complexity">Complexity:</span> <?php echo get_the_term_list( $post->ID, 'complexity', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'complexity', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>
	
	<dt><span class="define" rel="popover" data-content="(5=Highest quality) How nice are the components in terms of materials, design, fit, and other qualities? Well-made circuit boards, computer-cut plastic and metal parts, and other precision components add to the experience." data-original-title="Component Quality">Components:</span> <?php echo get_the_term_list( $post->ID, 'components', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'components', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>
	
	<dt><span class="define" rel="popover" data-content="(5=Highest quality) How clear, complete, and polished
is the documentation? Some of the best instructions, like from Makey award-winner Lego, don’t use words, so they can be understood by anyone." data-original-title="Documentation Quality">Documentation:</span> <?php echo get_the_term_list( $post->ID, 'documentation', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'documentation', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>
	
	<dt><span class="define" rel="popover" data-content="(5=Most community) How much of a community is there around the kit? Are there builder groups, online forums, circles, and meetups? Is the kit used in class- rooms or after-school programs? Do the kit makers or builders have a presence at events like Maker Faire?" data-original-title="Community Quality">Community:</span> <?php echo get_the_term_list( $post->ID, 'community', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'community', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>

	<dt><span class="define" rel="popover" data-content="(5=Most complete) How complete is the kit? Plans only? That rates a 1. Parts bundles and kits rate 2–5, depending on whether it’s just key components, almost every- thing, or absolutely everything you need, including any unusual tools." data-original-title="Completeness">Completeness:</span> <?php echo get_the_term_list( $post->ID, 'completeness', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'completeness', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>

</dl>

<p class="the_tags"> 
	<?php the_tags('<strong>TAGS:</strong> '); ?>
</p>

<p class="date">Reviewed: <?php the_date(); ?></p>

<iframe src="//www.facebook.com/plugins/like.php?href= <?php echo urlencode(get_permalink()); ?>&amp;send=false&amp;layout=button_count&amp;width=183&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=171225639607468" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:183px; height:21px;" allowTransparency="true"></iframe>
								
							
</div>

<?php }

function js_add_review($content) {
	global $post;
        $original = $content;
		$content = js_ratings_box();
		$content .= $original;
	return $content;
}

//add_filter( 'the_content', 'js_add_review', 15 );

//Comments

function js_kit_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 50 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'kit_comments' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kit_comments' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'kit_comments' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'kit_comments' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'kit_comments' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'kit_comments' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

register_nav_menu( 'primary', 'Primary Navigation' );
register_nav_menu( 'primary', 'Top Bar' );


//Custom Field Hacks

$field_data = array (
	'Meta' => array (				// unique group id
		'fields' => array(				// array "fields" with field definitions
			'CompanyURL' => array(),		// globally unique field id
			'ProductURL'	=> array(),
			'Price'	=> array(),
			'MakeProjectsGuideNumber'	=> array(),
		),
	),
);
$easy_cf = new Easy_CF($field_data);


/** catch a description for the OG protocol **/
function js_catch_that_desc() {
	global $post;
 	$meta = strip_tags($post->post_content);
 	$meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);
 	$meta = substr(trim($meta), 0, 200);
 	$meta= htmlentities($meta);
 	return($meta);
}
/** END **/


function js_enqueue_jquery() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'make-twipsy', get_stylesheet_directory_uri() . '/scripts/bootstrap-twipsy.js', array( 'jquery' ) );
	wp_enqueue_script( 'make-popover', get_stylesheet_directory_uri() . '/scripts/bootstrap-popover.js', array( 'jquery' ) );
	wp_enqueue_script( 'make-popover', get_stylesheet_directory_uri() . '/scripts/makekitreviews.js', array( 'jquery' ) );
}

add_action( 'wp_enqueue_scripts', 'js_enqueue_jquery' );



//Here we go with the Make: Projects APi

function js_make_project($guide) { 
	global $post;
	$guide = get_post_custom_values('MakeProjectsGuideNumber');

$url = 'http://makeprojects.com/api/0.1/guide/'.$guide[0];
$json = wpcom_vip_file_get_contents($url);
$json_output = json_decode($json);
// Don't print anything if we didn't get a good response
if ( !is_object( $json_output ) )
	return;
ob_start();
echo '<div class="clear"></div><p class="alert-message block-message info">';
echo '<a href="' . esc_url( $json_output->url ) . '"><img src="';
echo bloginfo('stylesheet_directory');
echo '/images/proj.jpg" class="pull-right" alt="Make: Projects" /></a>';
echo 'Check out this full <a href="' . esc_url( $json_output->url ) . '">' . esc_html( $json_output->guide->title ) . '</a> build from <a href="http://makeprojects.com">Make: Projects</a>, where you can find hundreds of project how-tos, techniques, and an active community of makers.</p>';
echo '<p class="summary">' . esc_html( $json_output->guide->summary ) . '</p>';
echo '<p><strong>Author</strong>: ' . esc_html( $json_output->guide->author->text );
echo ' <strong>Time Required</strong>: ' . esc_html( $json_output->guide->time_required );
echo ' <strong>Difficulty</strong>: ' . esc_html( $json_output->guide->difficulty ) . '</p>'; ?>

<div class="entry-content">

<img src="<?php echo esc_url( $json_output->guide->image->text ); ?>.standard" class="thumbnail" alt="<?php echo esc_attr( $json_output->guide->title ); ?>" align="right" />
<?php echo '<div class="summary">' . wp_kses_post( $json_output->guide->introduction_rendered ) .'</div>' ?>

<div class="clear"></div>

</div>		

<div class="row">

<div class="span5">

	<strong>Build Steps</strong>
	
	<ol>
		
	<?php 
		$steps = $json_output->guide->steps;
		foreach ($steps as $step) {
		   echo '<li>';
		   echo '<a href="#' . esc_attr( $step->number ) . '">';
		   echo esc_html( $step->title );
		   echo '</a></li>';
		}
	?>
	
	</ol>	
	
</div>

<div class="span4">

	<strong>Files</strong>
	
	<ul>
	
	<?php 
		$documents = $json_output->guide->documents;
		foreach ($documents as $document) {
		   echo '<li>';
		   echo '<a href="' . esc_url( $document->url ) . '">';
		   echo esc_html( $document->text );
		   echo '</a></li>';
		}
	?>
	
	</ul>

</div>

</div>

<div class="clear"></div>
	<?php 
	$i = 0;
	foreach ($steps as $step) {
		//var_dump($step);
		echo '<div class="project" id="' . esc_attr( $step->number ) . '">';
		echo '<div class="big_images">';
			$images = $step->images;
			foreach ($images as $image) {
				//var_dump($image);
				echo '<img src="';
				echo esc_url( $image->text );
				echo '.standard" class="' . esc_attr( $image->imageid ) . ' ' . esc_attr( $image->orderby ) .'" />';
			}
		echo '</div><!--.big_images-->';
		echo '<div class="right_column">';
		$images = $step->images;
		foreach ($images as $image) {
			//var_dump($image);
			echo '<img src="';
			echo esc_url( $image->text );
			echo '.thumbnail" class="thumbnail span1 ' . esc_attr( $image->imageid ) . ' ' . esc_attr( $image->orderby ) . '" />';
		}

		$lines = $step->lines;
		echo '<h3 class="clear">Step #' . esc_html( $step->number ) . ' ' . esc_html( $step->title ) . '</h3>';
		echo '<ul>';
		foreach ($lines as $line) {
			//var_dump($line);
			echo '<li>';
			echo esc_html( $line->text );
			echo '</li>';
			}
		echo '</ul>';
		echo '</div><!--.right_column-->';
		echo '<div class="clear"></div><!--.clear-->';
		echo '</div><!--.project - Step #' . esc_html( $step->number ) .'-->';
		if (++$i == 999) break;

	}
	echo '<div class="conclusion">';
	echo wp_kses_post( $json_output->guide->conclusion ) ;
	echo '</div>';
return ob_get_clean();
}


add_filter('comment_form_defaults','js_change_reply');

function js_change_reply($defaults) {
	$defaults['title_reply'] = 'Your Thoughts?';
	return $defaults;
}


function new_js_add_review($content) {
	global $post;
	$content = js_ratings_box().$content;
	$guide = get_post_custom_values('MakeProjectsGuideNumber');
	if (isset($guide[0])) {
		$content .= js_make_project($guide);
	}

	return $content;
}

add_filter( 'the_content', 'new_js_add_review' );

add_filter('the_excerpt_rss', 'new_js_add_review');

vip_redirects( array('/kitguide' => 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M21KTAD') );

add_action( 'init', 'js_create_blog_taxonomies', 0 );

function js_create_blog_taxonomies() {

	$labels = array(
		'name' => _x( 'Blog Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Categories' ),
		'all_items' => __( 'All Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Category' ),
		'update_item' => __( 'Update Category' ),
		'add_new_item' => __( 'Add New Category' ),
		'new_item_name' => __( 'New Category Name' ),
	); 	

	register_taxonomy( 'blog-category', array( 'book' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'blog-category' ),
	));
	
	$labels = array(
		'name' => _x( 'Blog Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Writer', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Blog Tags' ),
		'popular_items' => __( 'Popular Blog Tags' ),
		'all_items' => __( 'All Blog Tags' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Tag' ),
		'update_item' => __( 'Update Tag' ),
		'add_new_item' => __( 'Add New Tag' ),
		'new_item_name' => __( 'New Tag Name' ),
		'separate_items_with_commas' => __( 'Separate Blog Tags with commas' ),
		'add_or_remove_items' => __( 'Add or remove Blog Tags' ),
		'choose_from_most_used' => __( 'Choose from the most used Blog Tags' )
	);
	register_taxonomy( 'blog-tag', 'book', array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'blog-tag' ),
	));
}


add_action( 'init', 'js_kit_blog' );

function js_kit_blog() {

    $labels = array( 
        'name' => _x( 'Blog Posts', 'blog-post' ),
        'singular_name' => _x( 'Post', 'blog-post' ),
        'add_new' => _x( 'Add New Post', 'blog-post' ),
        'add_new_item' => _x( 'Add New Post', 'blog-post' ),
        'edit_item' => _x( 'Edit Post', 'blog-post' ),
        'new_item' => _x( 'New Post', 'blog-post' ),
        'view_item' => _x( 'View Post', 'blog-post' ),
        'search_items' => _x( 'Search Blog', 'blog-post' ),
        'not_found' => _x( 'No post found', 'blog-post' ),
        'not_found_in_trash' => _x( 'No post found in Trash', 'blog-post' ),
        'parent_item_colon' => _x( 'Parent Post:', 'blog-post' ),
        'menu_name' => _x( 'Blog Posts', 'blog-post' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Blog posts for Make: Kit  Reviews',
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats' ),
        'taxonomies' => array( 'blog-category', 'post_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'blog-post', $args );
}



function js_blog_page_remove_plugin_filters() {

    global $wp_filter;
    global $wp;
    if ( isset( $wp->query_vars['post_type'] ) && $wp->query_vars["post_type"] == 'blog-post' ) {
        remove_all_filters('the_content', 'plugin_filters');
        add_filter('the_content', 'do_shortcode');
    }
}   

add_action('wp','js_blog_page_remove_plugin_filters');

function js_feed_change($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'blog-post');
	return $qv;
}
add_filter('request', 'js_feed_change');

function make_get_category_name() {
	if ( is_single() ) {
		$cats = get_the_category();
		if (!empty($cats)) {
			$cat = $cats[0]; // let's just assume the post has one category	
		} else 
		return;

	}
	elseif ( is_category() ) { // category archives
		$cat = get_queried_object();
	}
	if (is_single() || is_category()) {
		$output = '/';	
	} else {
		$output = null;
	}
	$cat = get_queried_object();
	$boom = array( '&amp;', ' ', 'and' );
	if (!empty($cat->name)) {
		$output .= str_replace($boom, '', $cat->name);
	}
	return $output;
}

/**
 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
 */
add_action( 'wp_enqueue_scripts', 'make_kits_add_my_stylesheet' );

/**
 * Enqueue plugin style-file
 */
function make_kits_add_my_stylesheet() {
	// Respects SSL, Style.css is relative to the current file
	wp_register_style( 'make_bs_kits', plugins_url('css/bootstrap.css', __FILE__) );
	wp_enqueue_style( 'make_bs_kits' );
	wp_register_style( 'make_kits', plugins_url('style.css', __FILE__) );
	wp_enqueue_style( 'make_kits' );
}

function make_quantcast_tag() { ?>
		<!-- Quantcast Tag -->
		<script type="text/javascript">
			var _qevents = _qevents || [];

			(function() {
				var elem = document.createElement('script');
				elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
				elem.async = true;
				elem.type = "text/javascript";
				var scpt = document.getElementsByTagName('script')[0];
				scpt.parentNode.insertBefore(elem, scpt);
			})();

			_qevents.push({
				qacct:"p-c0y51yWFFvFCY"
			});
		</script>

		<noscript>
			<div style="display:none;">
				<img src="//pixel.quantserve.com/pixel/p-c0y51yWFFvFCY.gif" border="0" height="1" width="1" alt="Quantcast"/>
			</div>
		</noscript>
		<!-- End Quantcast tag -->
<?php }

add_action('wp_footer', 'make_quantcast_tag');