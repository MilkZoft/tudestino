function getRates() {
	var post = {
		"ID"    : $("select option:selected").val()
	}
	
	var rate = "";
	
	$.ajax({
		type: "POST",
		url: PATHAPP + "ajax/getrates/",
		data: post,
		dataType: "json",
		beforeSend: function(jqXHR, settings){
			
		},
		
		success: function(response, textStatus, jqXHR) {
			if(response["response"] != false) {
				var rates = response["response"];
				var html  = ""; 
				
				$("tbody > tr").remove();
				
				for(var rate in rates) {
					if(rate%2==0) {
						html = html + '<tr class="odd">';
					} else {
						html = html + '<tr>';
					}
					
					html = html + '<td>'+rates[rate].ID_Rate+'</td><td>'+rates[rate].Start_Date_Text+'</td><td>'+rates[rate].End_Date_Text+'</td>';
					html = html + '<td>'+rates[rate].Name+'</td><td>'+rates[rate].Cost+'</td><td>'+rates[rate].Language+'</td>';
					html = html + '<td><a href="' + PATHAPP + 'cpanel/editrate/' + rates[rate].ID_Rate + '">' + $('.textedit').text() + '</a></td>';
					html = html + '<td><a href="' + PATHAPP + 'cpanel/deleterate/' + rates[rate].ID_Rate + '" onclick="return(confirm(\'' + $('.textsure').text() + '\'))">' + $('.textdelete').text() + '</a></td>';
					html = html + '</tr>';
				}
				
				$("tbody").html(html);											
			} else {
				$("tbody > tr").remove();
				$("tbody").html('<tr class="odd" ><td colspan="7">' + $('input[name="noresults"]').val() + '</td ></tr>');	
			}
		},
		
		error: function(jqXHR, textStatus){
			
		},
		
		complete: function(jqXHR, textStatus){
			
		}
	});
}

$(document).ready(function(){
	
	getRates();
	
	$("#hotels").change(function () { getRates(); });
	
	$(".datepicker").datepicker({
		showOtherMonths: true,
		selectOtherMonths: true
	});
});
