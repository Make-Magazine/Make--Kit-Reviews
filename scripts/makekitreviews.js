jQuery(function () {
  jQuery("span[class=define]")
	.popover({
	  offset: 10
	})
	.click(function(e) {
	  e.preventDefault()
	})
})


jQuery(document).ready(function(){
	/* Put your jQuery here */
	jQuery('.robotics').hide();
	jQuery('.toys').hide();
	jQuery('.tools').hide();
	jQuery('.toys').hide();
	
	jQuery('#robotics').click(function() {
		jQuery('.tools').hide();
		jQuery('.electronics').hide();
		jQuery('.toys').hide();
		jQuery('.robotics').show();
		jQuery('#robotics').addClass('active-slide red');
		jQuery('#tools, #electronics, #toys').removeClass('active-slide red');
	});
	
	jQuery('#tools').click(function() {
		jQuery('.electronics').hide();
		jQuery('.robotics').hide(); 
		jQuery('.toys').hide();
		jQuery('.tools').show();
		jQuery('#tools').addClass('active-slide red');
		jQuery('#robotics, #electronics, #toys').removeClass('active-slide red');
	});
		
	jQuery('#electronics').click(function() {
		jQuery('.electronics').show();
		jQuery('.robotics').hide(); 
		jQuery('.tools').hide();
		jQuery('.toys').hide();
		jQuery('#electronics').addClass('active-slide red');
		jQuery('#tools, #robotics, #toys ').removeClass('active-slide red');
	});
		
	jQuery('#toys').click(function() {
		jQuery('.toys').show();
		jQuery('.robotics').hide(); 
		jQuery('.tools').hide();
		jQuery('.electronics').hide();
		jQuery('#toys').addClass('active-slide red');
		jQuery('#tools, #robotics, #electronics ').removeClass('active-slide red');
	});
		
})