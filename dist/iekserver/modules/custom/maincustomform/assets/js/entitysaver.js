(function ($, Drupal) {
 
 
  Drupal.behaviors.logInForm = {
    attach: function (context, settings) {

    //get all available regions
     jQuery.ajax({
     	url: Drupal.url('/jsonapi/region_entity/region_entity?_format=api_json&fields[region_entity--region_entity]=id,name'),	 
	    method: 'GET',
	    success: function(data, status, xhr) {
            var arrObjects = data["data"];
            var sel = $("#edit-region-select");
            sel.empty();
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
            arrObjects.forEach( function (arrayItem)
            {
               var attributes = arrayItem['attributes'];
               sel.append('<option value="' + attributes['id'] + '">' + attributes['name'] + '</option>');
            })
            
        }
	 });



	 

	function getCsrfToken(callback) {
	  jQuery
	    .get(Drupal.url('/session/token'))
	    .done(function (data) {
	      var csrfToken = data;
	      callback(csrfToken);
	    });
	}

	function postNode(csrfToken, node) {
	  jQuery.ajax({
        //url: 'http://localhost/drupal8new/api/custom/postentity/?_format=json',
        url: Drupal.url('api/custom/postentity/?_format=json'),
	    method: 'POST',
	    headers: {
	      'Content-Type': 'application/hal+json',
	       'Authorization': 'Basic YWRtaW46Y3Jhenk2MTQ=', 
	      'X-CSRF-Token': csrfToken
	    },
	    data: JSON.stringify(node),
         success: function(data, textStatus, jqXHR)
          {
          	if($.isNumeric(data['return-message'])) {
                var insertedId = data['return-message'];
                // e.stopPropagation();
                window.location.href = Drupal.url('aitisi/'+insertedId);
          	} else {
          		 $('#block-customformexample').html(data['return-message']);
          	}
           
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            console.log(textStatus);
          }
	  });
	}


	

	//$("form.custom-form", context).submit(function(e) {
  /* $("form.multistep-three-form  #edit-submit", context).click(function(e) {
		 e.preventDefault();

		 alert($(this).attr('id'));


       var first = drupalSettings.previousFormValues.first;
       var last = drupalSettings.previousFormValues.last;
       var fname = drupalSettings.previousFormValues.fname;
       var mname = drupalSettings.previousFormValues.mname;
       var idno = drupalSettings.previousFormValues.idno;
       var birth_date = drupalSettings.previousFormValues.birth_date;
       var birth_place = drupalSettings.previousFormValues.birth_place;
       var email = drupalSettings.previousFormValues.email;
       var telephone = drupalSettings.previousFormValues.telephone;
       var afm = drupalSettings.previousFormValues.afm;
       var sex = drupalSettings.previousFormValues.sex;
       if(!sex) {
          sex = 'male';
        } else {
          sex = 'female';
        }


      var prabek = $('form.multistep-three-form #edit-prabek').val();

      var numbek = $('form.multistep-three-form #edit-numbek').val();

      var regno = $('form.multistep-three-form #edit-regno').val();

      var iek_select = $('form.multistep-three-form #edit-iek-select').val();
      var region_select = $('form.multistep-three-form #edit-region-select').val();
      var eidikotita_select = $('form.multistep-three-form #edit-eidikotita-select').val();
     
		var newNode =   {
		"first": [{
		"value": first
		}],
		"last": [{
		"value": last
		}],
		"fname": [{
		"value": fname
		}],	
		"mname": [{
		"value": mname
		}],	
		"birthdate": [{
		"value": birth_date
		}],	
		"birthplace": [{
		"value": birth_place
		}],		
		"idno": [{
		"value": idno
		}],
        "sex": [{
		"value": sex
		}],
		"email": [{
		"value": email
		}],
		"telephone": [{
		"value": telephone
		}],
		"afm": [{
		"value": afm
		}],
		"prabek": [{
		"value": prabek
		}],
		"numbek": [{
		"value": numbek
		}],
		"regno": [{
		"value": regno
		}],
		"iek_id": [{
		"value": iek_select
		}],	
		"region_id": [{
		"value": region_select
		}],	
		"eidikotita_id": [{
		"value": eidikotita_select
		}],	
		};

		getCsrfToken(function (csrfToken) {
			 postNode(csrfToken, newNode);
		});
	    //return false;
    });*/


    }
  };
 
})(jQuery, Drupal);

function isInt16(n) {
    return +n === n && !(n % 1) && n < 0x8000 && n >= -0x8000;
}

