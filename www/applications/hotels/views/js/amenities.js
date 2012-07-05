$(document).ready(function(){
	
	$('select[name="hotels"]').change(function () {
		
		var post = {
			"ID"    : $("select option:selected").val()
		}
		
		var amenity = "";
		
		$.ajax({
			type: "POST",
			url: PATHAPP + "ajax/getamenities/",
			data: post,
			dataType: "json",
			beforeSend: function(jqXHR, settings){
				
			},
			
			success: function(response, textStatus, jqXHR) {
				if(response["response"] != false) {
					var amenities = response["response"];
					
					$('input[name="amenities[]"]').removeAttr("checked");
					
					for(var amenity in amenities) {
						$('.checkbox[value="' + amenities[amenity].ID_Amenity + '"]').attr("checked","checked");
					}	
														
				} else {
					$('input[name="amenities[]"]').removeAttr("checked");
				}
			},
			
			error: function(jqXHR, textStatus){
				$('input[name="amenities[]"]').removeAttr("checked");
			},
			
			complete: function(jqXHR, textStatus){
				
			}
		});
		
	});
});
