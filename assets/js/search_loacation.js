    
var mail_id_fld;
var mail_id_fld_search;
var componentForm = {  
  locality: 'long_name',  
  lat: 'long_name',
  lng: 'long_name',
  sublocality_level_1: 'long_name',  
  sublocality_level_2: 'long_name',  
  postal_code: 'long_name',  
};


function initAutoComplete() {  
     
  var iso3 ='IND';
if( iso3 !='' && iso3!=undefined){

    mail_id_fld = new google.maps.places.Autocomplete(
      (document.getElementById('sublocality_level_1')), {types: ['geocode'] , componentRestrictions: { country: [ iso3 ] }
    });
   
    mail_id_fld.addListener('place_changed', function() {     
          fillInAddress(mail_id_fld, "5");
    });
    
    /* mail_id_fld1 = new google.maps.places.Autocomplete(
      (document.getElementById('google_address')), {types: ['geocode'] , componentRestrictions: { country: [ iso3 ] }
    });
   
    mail_id_fld1.addListener('place_changed', function() {     
          fillInAddress2(mail_id_fld1, "5");
    }); */
  }
  else{
      mail_id_fld = new google.maps.places.Autocomplete(
      (document.getElementById('sublocality_level_1')), {types: ['geocode']  })  ;
      mail_id_fld.addListener('place_changed', function() {     
          fillInAddress(mail_id_fld, "5");
      });
  }

  
}

function fillInAddress(autocomplete, unique) {

  var place = autocomplete.getPlace();
  for (var component in componentForm) {
    if (!!document.getElementById(component + unique)) {
      document.getElementById(component + unique).value = '';
      document.getElementById(component + unique).disabled = false;
    }
  }
  document.getElementById('lat').value = place.geometry.location.lat();
  document.getElementById('lng').value = place.geometry.location.lng();

  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType] && document.getElementById(addressType + unique)) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType + unique).value = val;
    }
   
    if(place.address_components[i].types[0] == 'locality'){
      document.getElementById('cityname').value = place.address_components[i].long_name;   
    }
    if(place.address_components[i].types[0] == 'sublocality_level_1'){
      document.getElementById('sublocality_level_1').value = place.address_components[i].long_name;      
    }
    if(place.address_components[i].types[0] == 'sublocality_level_2'){
      document.getElementById('sublocality_level_2').value = place.address_components[i].long_name;      
    }        
    if(place.address_components[i].types[0] == 'postal_code'){
      document.getElementById('postal_code').value = place.address_components[i].long_name;
    }       
  }  
}

function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}


  function fillInAddress2(autocomplete, unique) {

    var place = autocomplete.getPlace();
    for (var component in componentForm) {
      if (!!document.getElementById(component + unique)) {
        document.getElementById(component + unique).value = '';
        document.getElementById(component + unique).disabled = false;
      }
    }
    document.getElementById('google_lat').value = place.geometry.location.lat();
    document.getElementById('google_long').value = place.geometry.location.lng();
    document.getElementById('place_id').value = place.place_id;
    
    getShortURL(place.formatted_address,place.place_id);

  }
  function getShortURL(location,place_id){
		$.ajax({
			type : 'post',
			url : 'https://insurance.welnext.com/check_status/check_status/getShortURL', 
			dataType : 'json',
			data : {'address':location,'place_id':place_id,'csrf_test_name':csrf_token},
			success: function(res){ 
				$(".se-pre-con").hide();
				if(res['status'] == '200'){
					link = res['link'];
					$('#short_url').val(link);
			   
				}else{
					alert(res['message']);
				}                  
			}
		});
		return true;
	}
