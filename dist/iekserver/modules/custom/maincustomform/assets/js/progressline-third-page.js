(function ($, Drupal) {
 
 
  Drupal.behaviors.progresslinelast = {
    attach: function (context, settings) {


            //get all available regions
     jQuery.ajax({
        url: Drupal.url('/jsonapi/region_entity/region_entity?_format=api_json&fields[region_entity--region_entity]=id,name'),   
        method: 'GET',
        success: function(data, status, xhr) {
            var arrObjects = data["data"];
            var sel = $("#edit-region-select");
            sel.empty();
            sel.append('<option value="0">---Επιλέξτε ---</option>');
            arrObjects.forEach( function (arrayItem)
            {
               var attributes = arrayItem['attributes'];
               sel.append('<option value="' + attributes['id'] + '">' + attributes['name'] + '</option>');
            })
            
        }
     });

     //select iek
     jQuery.ajax({
        url: Drupal.url('/jsonapi/school_entity/school_entity?_format=api_json&fields[school_entity--school_entity]=id,name'),
        method: 'GET',
        success: function(data, status, xhr) {
            var arrObjects = data["data"];
            var sel = $("#edit-iek-select");
            sel.empty();
            sel.append('<option value="0">---Επιλέξτε ---</option>');
            arrObjects.forEach( function (arrayItem)
            {
               var attributes = arrayItem['attributes'];
               sel.append('<option value="' + attributes['id'] + '">' + attributes['name'] + '</option>');
            })
            
        }
     });

     //select eidikotita
     jQuery.ajax({  
        url: Drupal.url('/jsonapi/eidikotita_entity/eidikotita_entity?_format=api_json&fields[eidikotita_entity--eidikotita_entity]=id,name'),
        method: 'GET',
        success: function(data, status, xhr) {
            var arrObjects = data["data"];
            var sel = $("#edit-eidikotita-select");
            sel.empty();
            sel.append('<option value="0">---Επιλέξτε ---</option>');
            arrObjects.forEach( function (arrayItem)
            {
               var attributes = arrayItem['attributes'];
               sel.append('<option value="' + attributes['id'] + '">' + attributes['name'] + '</option>');
            })
            
        }
     });


    //	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
    	// navigation steps / progress steps
    	var current_active_step = $(context).find('.f1-step.active');

    	var progress_line = $(context).find('.f1-progress-line');

    	if( next_step ) {
                // alert(progress_line);
    			// change icons
    			current_active_step.once('progresslinelast').removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    	}

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
