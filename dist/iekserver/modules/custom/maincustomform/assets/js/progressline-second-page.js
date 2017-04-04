(function ($, Drupal) {
 
 
  Drupal.behaviors.progressline = {
    attach: function (context, settings) {



        //	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
    	// navigation steps / progress steps
    	var current_active_step = $('.multistep-two-form').find('.f1-step.active');
    	var progress_line = $('.multistep-two-form').find('.f1-progress-line');

    	if( next_step ) {
    			// change icons
    			current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    	}

    // previous step
    /*
    $('.custom-form #edit-back').on('click', function() {
    	// navigation steps / progress steps
    	var current_active_step = $('.custom-form').find('.f1-step.active');
    	var progress_line = $('.custom-form').find('.f1-progress-line');
    		// change icons
    		current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    		// progress bar
    		bar_progress(progress_line, 'left');

    }); */


    }
  };
 
})(jQuery, Drupal);

function scroll_to_class(element_class, removed_height) {
	var scroll_to = $(element_class).offset().top - removed_height;
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 0);
	}
}

function bar_progress(progress_line_object, direction) {
	var number_of_steps = progress_line_object.data('number-of-steps');
	var now_value = progress_line_object.data('now-value');
	var new_value = 0;
	if(direction == 'right') {
		new_value = now_value + ( 100 / number_of_steps );
	}
	else if(direction == 'left') {
		new_value = now_value - ( 100 / number_of_steps );
	}
	progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}
