
Drupal.behaviors.elementFocus = {
	attach : function(context, settings){

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
			if ( jQuery('#admin-menu-wrapper').length > 0  ) {
				height += jQuery('#admin-menu').outerHeight() - 1;
			}
			
			jQuery('#menu-content')
			  .css({position : 'absolute',top : height})
			  .transition('fly down')
			;
			jQuery(this).hasClass('closer') ;
		})
		// Search
		jQuery('#edit-keys-3,#edit-keys-3--2').hide();
		
		jQuery('.ui.icon i.search.link.icon').bind('click',function(event){
		  var clicker = jQuery(this).parents('.ui.icon');
		  clicker.find('#edit-keys-3,#edit-keys-3--2').toggle();
		  if ( clicker.hasClass('input') ) clicker.removeClass('input');
          else clicker.addClass('input');
		  event.stopPropagation();
		  //jQuery(this).parents('form').trigger('submit') ;
	  }).addClass('processed');
		
		jQuery('.ui.popup')
		  .popup();
		
		jQuery('.ui.accordion')
		  .accordion()
		;
	}
};