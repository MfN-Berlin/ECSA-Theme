Drupal.behaviors.elementFocus = {
	attach : function(context, settings){
		
		jQuery('.message .close')
			.on('click', function() {
			jQuery(this)
				.closest('.message')
				.transition('fade')
				;
			})
		;
		
		
		jQuery('#header .sticky')
		  .sticky({ context : '#header'});
		
		jQuery('.popuper')
		  .popup({
		    popup : jQuery(this).data('content'),
		    on    : 'hover'
		    
		  })
		;

		//jQuery('#mobile-sticky').parent().sticky({context : 'body'})
		jQuery('.ui.dropdown').dropdown();
		
 		jQuery('#popuper').click(function(){
			
			var height = jQuery('header').outerHeight();
			var height = height - 2;
			if ( jQuery('#admin-menu-wrapper').length > 0  ) {
				height += jQuery('#admin-menu').outerHeight() - 2;
			}
			
			jQuery('#menu-content')
			  .css({position : 'fixed',top : height})
			  .transition('slide down')
			;
			jQuery(this).hasClass('closer') ;
			
			
		});
		
		
		// mobil
 		
jQuery('.ui.dropdown').dropdown();
		
 		jQuery('#popuper1').click(function(){
			
			var height = jQuery('header').outerHeight();
			var height = height - 2;
			if ( jQuery('#admin-menu-wrapper').length > 0  ) {
				height += jQuery('#admin-menu').outerHeight() - 2;
			}
			
			jQuery('#menu-content')
			  .css({position : 'fixed',top : height})
			  .transition('slide down')
			;
			jQuery(this).hasClass('closer') ;
			
			
		});
		
		
 		
 		
 		
		jQuery('#popuper').click(function(){
			if (jQuery('#popuper').hasClass('sidebar')) {
				(jQuery('#popuper').removeClass('sidebar'));
				(jQuery('#popuper').addClass('remove'))
				;
				
			}
			
			else{
				(jQuery('#popuper').removeClass('remove'));
				(jQuery('#popuper').addClass('sidebar'))
				
				;
			}			
			
		});
		
		jQuery('#popuper').click(function(){
			if (jQuery('#popuper').hasClass('trans')) {
				(jQuery('#popuper').removeClass('trans'));
				(jQuery('#popuper').addClass('transn'))
				;
				
			}
			
			else{
				(jQuery('#popuper').removeClass('trans'));
				(jQuery('#popuper').addClass('transn'))
				;
			}			
			
		});
		
		jQuery('#popuper').click(function(){
			if (jQuery('#content').hasClass('noscroll')) {
				(jQuery('#content').removeClass('noscroll'));
				
				
			}
			
			else{
				
				(jQuery('#content').addClass('noscroll'))
				;
			}			
			
		});
		
		
		// mobil
		
		jQuery('#popuper1').click(function(){
			if (jQuery('#popuper1').hasClass('sidebar')) {
				(jQuery('#popuper1').removeClass('sidebar'));
				(jQuery('#popuper1').addClass('remove'))
				;
				
			}
			
			else{
				(jQuery('#popuper1').removeClass('remove'));
				(jQuery('#popuper1').addClass('sidebar'))
				
				;
			}			
			
		});
		
		jQuery('#popuper1').click(function(){
			if (jQuery('#popuper1').hasClass('trans')) {
				(jQuery('#popuper1').removeClass('trans'));
				(jQuery('#popuper1').addClass('transn'))
				;
				
			}
			
			else{
				(jQuery('#popuper1').removeClass('trans'));
				(jQuery('#popuper1').addClass('transn'))
				;
			}			
			
		});
		
		jQuery('#popuper1').click(function(){
			if (jQuery('#content').hasClass('noscroll')) {
				(jQuery('#content').removeClass('noscroll'));
				
				
			}
			
			else{
				
				(jQuery('#content').addClass('noscroll'))
				;
			}			
			
		});
		
		
		// Article overlay
		
		jQuery('article').click(function(){
			if (jQuery(this).hasClass('overlay')) {
				(jQuery(this).removeClass('overlay'))
				(jQuery(this).addClass('overlayn'));
				jQuery('article.overlay .content-text')
					.css({position : 'absolute',top : 0})
					.transition('slide up', '2s')
					;
				
				
				
			}
			
			else{
				(jQuery(this).removeClass('overlayn'))
				(jQuery(this).addClass('overlay'))
				;
			}			
			
		});
		
		
			
	/*	jQuery('#popuper').click(function(){
			if (jQuery('#content').hasClass('scroll')) {
				(jQuery('#content').removeClass('scroll'))
				(jQuery('#content').addClass('no-scroll'));
				
			}
			
			else{
				(jQuery('#content').removeClass('no-scroll'))
				(jQuery('#content').addClass('scroll'))
				;
			}			
			
		});
*/		
				
		
		// Search
		jQuery('#edit-keys-3,#edit-keys-3--2,#edit-keys-3--3').hide();
		
		jQuery('.ui.icon i.search.link.material-icons').bind('click',function(event){
		  var clicker = jQuery(this).parents('.ui.icon');
//		  if (clicker.find('#edit-keys-3--2').is(':visible'))
			  clicker.find('#edit-keys-3,#edit-keys-3--2,#edit-keys-3--3').show();
//		  else
//			  clicker.find('#edit-keys-3,#edit-keys-3--2').show();
		 
	//	  if ( clicker.hasClass('input') ) 
	//		clicker.removeClass('input');
	 //         else 
//			clicker.addClass('input');
		  event.stopPropagation();


		  if(jQuery(this).hasClass('openedSearch')){
			// if( /*clicker.find('#edit-keys-3').val().trim().length>0 ||*/ clicker.find('#edit-keys-3--2').val().length>0 ){
			var edit_keys;
			if(clicker.find('#edit-keys-3').attr("id"))
				edit_keys = clicker.find('#edit-keys-3');
			if(clicker.find('#edit-keys-3--2').attr("id"))
                                edit_keys = clicker.find('#edit-keys-3--2');
			if(clicker.find('#edit-keys-3--3').attr("id"))
                                edit_keys = clicker.find('#edit-keys-3--3');
			
			var edit_keys_val = edit_keys.val();
			if(typeof edit_keys_val ==="undefined")
				edit_keys_val = "";
			if(edit_keys_val.length > 0) {
//				jQuery(this).parents('form').trigger('submit');
				clicker.find('#edit-keys-3,#edit-keys-3--2,#edit-keys-3--3').show();
//	
				if(jQuery("#edit-submit-3").attr("id"))
					jQuery("#edit-submit-3").trigger("click");
				if(jQuery("#edit-submit-3--2").attr("id"))
                                        jQuery("#edit-submit-3--2").trigger("click");
				if(jQuery("#edit-submit-3--3").attr("id"))
                                        jQuery("#edit-submit-3--3").trigger("click");
//				jQuery('#search-api-page-search-form-namu-default-search-page--2').trigger('submit');
			  }else
			  {
				clicker.find('#edit-keys-3,#edit-keys-3--2,#edit-keys-3--3').hide();
				jQuery(this).removeClass('openedSearch');
			  }


		  }else
			jQuery(this).addClass('openedSearch');
//			clicker.find('#edit-keys-3,#edit-keys-3--2').show();
	  }).addClass('processed');
		
		jQuery('.ui.popup')  
		  .popup();
		
		jQuery('.ui.accordion')
		  .accordion()
		;
	}
};

// 
jQuery(document).ready(function() {
	var my_width = jQuery(window).width();
	
	//sticky menu navigation
	// jQuery('#sticky-nav').onePageNav({
	//     currentClass: 'active',
	//     changeHash: true,
	//     scrollSpeed: 1200
	// });
	
	
	//sticky page menu script
    var top = jQuery('.header-wrapper').offset().top - parseFloat(jQuery('.header-wrapper').css('margin-top').replace(/auto/, 0));
    jQuery(window).scroll(function (event) {
      var y = jQuery(this).scrollTop();
      
      if (y > top) {
    	  jQuery('.header-wrapper').addClass('fixed-header');
      }
      
      else {
    	  jQuery('.header-wrapper').removeClass('fixed-header');
      }
    });
});
