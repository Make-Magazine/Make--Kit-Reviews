<footer>

<div class="container">

<ul>
	<?php wp_nav_menu( array('menu' => 'Footer', 'container' => '','container_class' => 'menu-{menu slug}-container navi','items_wrap' => '%3$s', 'fallback_cb' => false )); ?>
	<li><?php if ( function_exists('vip_powered_wpcom') ) { echo vip_powered_wpcom(); } ?></li>
</ul>


</div>

</footer>

</div> <!-- /container -->

<script src="http://twitter.github.com/bootstrap/1.3.0/bootstrap-twipsy.js"></script>
<script src="http://twitter.github.com/bootstrap/1.3.0/bootstrap-popover.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/makekitreviews.js"></script>

<script>

<?php 
global $cap;
	if ($cap->feat_1) { ?>
jQuery(document).ready(function(){
	/* Put your jQuery here */
	jQuery('.post-<?php echo $cap->feat_2; ?>').hide();
	jQuery('.post-<?php echo $cap->feat_3; ?>').hide();
	jQuery('.click<?php echo $cap->feat_1; ?>').addClass('active');
	
	jQuery('.click<?php echo $cap->feat_1; ?>').click(function() {
		jQuery('.post-<?php echo $cap->feat_2; ?>,.post-<?php echo $cap->feat_3; ?>').hide();
		jQuery('.post-<?php echo $cap->feat_1; ?>').show();
		jQuery('.click<?php echo $cap->feat_1; ?>').addClass('active');
		jQuery('.click<?php echo $cap->feat_3; ?>, .click<?php echo $cap->feat_2; ?>').removeClass('active');
	});
	
	jQuery('.click<?php echo $cap->feat_2; ?>').click(function() {
		jQuery('.post-<?php echo $cap->feat_1; ?>,.post-<?php echo $cap->feat_3; ?>').hide();
		jQuery('.post-<?php echo $cap->feat_2; ?>').show();
		jQuery('.click<?php echo $cap->feat_2; ?>').addClass('active');
		jQuery('.click<?php echo $cap->feat_3; ?>, .click<?php echo $cap->feat_1; ?>').removeClass('active');
	});
		
	jQuery('.click<?php echo $cap->feat_3; ?>').click(function() {
		jQuery('.post-<?php echo $cap->feat_3; ?>').show();
		jQuery('.post-<?php echo $cap->feat_2; ?>,.post-<?php echo $cap->feat_1; ?>').hide();
		jQuery('.click<?php echo $cap->feat_3; ?>').addClass('active');
		jQuery('.click<?php echo $cap->feat_2; ?>, .click<?php echo $cap->feat_1; ?>').removeClass('active');
	});
	
	jQuery('h4.term-list-category').click(function() {
		if (jQuery('#term-list-category').is(':visible')) {
			jQuery('div#term-list-category').slideUp('fast');
			jQuery('.triangle').addClass('transformed');
		} 
		else {
			jQuery('div#term-list-category').slideDown('fast');
			jQuery('.triangle').removeClass('transformed');
		}
	});
	
	jQuery('h4.term-list-post_tag').click(function() {
		if (jQuery('#term-list-post_tag').is(':visible')) {
			jQuery('div#term-list-post_tag').slideUp('fast');
		} 
		else {
			jQuery('div#term-list-post_tag').slideDown('fast');
		}
	});
	
	jQuery('h4.term-list-complexity').click(function() {
		if (jQuery('#term-list-complexity').is(':visible')) {
			jQuery('div#term-list-complexity').slideUp('fast');
		} 
		else {
			jQuery('div#term-list-complexity').slideDown('fast');
		}
	});
	
	jQuery('h4.term-list-maker').click(function() {
		if (jQuery('#term-list-maker').is(':visible')) {
			jQuery('div#term-list-maker').slideUp('fast');
		} 
		else {
			jQuery('div#term-list-maker').slideDown('fast');
		}
	});
	
	jQuery('h4.term-list-components').click(function() {
		if (jQuery('#term-list-components').is(':visible')) {
			jQuery('div#term-list-components').slideUp('fast');
		} 
		else {
			jQuery('div#term-list-components').slideDown('fast');
		}
	});
	
	jQuery('h4.term-list-documentation').click(function() {
		if (jQuery('#term-list-documentation').is(':visible')) {
			jQuery('div#term-list-documentation').slideUp('fast');
		} 
		else {
			jQuery('div#term-list-documentation').slideDown('fast');
		}
	});
	
	jQuery('h4.term-list-community').click(function() {
		if (jQuery('#term-list-community').is(':visible')) {
			jQuery('div#term-list-community').slideUp('fast');
		} 
		else {
			jQuery('div#term-list-community').slideDown('fast');
		}
	});
	
	
	jQuery('h4.term-list-completeness').click(function() {
		if (jQuery('#term-list-completeness').is(':visible')) {
			jQuery('div#term-list-completeness').slideUp('fast');
		} 
		else {
			jQuery('div#term-list-completeness').slideDown('fast');
		}
	});
	
		
})

<?php } ?>


</script>
<?php wp_footer(); ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-51157-17']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
