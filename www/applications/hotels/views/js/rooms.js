function getRooms() {
	var post = {
		"ID"    : $("#hotels option:selected").val()
	}
	
	var room = "";
	
	$.ajax({
		type: "POST",
		url: PATHAPP + "ajax/getrooms/",
		data: post,
		dataType: "json",
		beforeSend: function(jqXHR, settings){
			
		},
		
		success: function(response, textStatus, jqXHR) {
			if(response["response"] != false) {
				var rooms = response["response"];
				var html  = ""; 
				
				$("tbody > tr").remove();
				
				for(var room in rooms) {
					if(room%2==0) {
						html = html + '<tr class="odd">';
					} else {
						html = html + '<tr>';
					}
					
					html = html + '<td>'+rooms[room].ID_Room+'</td><td>'+rooms[room].Name+'</td>';
					html = html + '<td>'+rooms[room].Number_Rooms+'</td><td>'+rooms[room].Language+'</td>';
					html = html + '<td><a href="' + PATHAPP + 'cpanel/editroom/' + rooms[room].ID_Room + '">' + $('.textedit').text() + '</a></td>';
					html = html + '<td><a href="' + PATHAPP + 'cpanel/deleteroom/' + rooms[room].ID_Room + '" onclick="return(confirm(\'' + $('.textsure').text() + '\'))">' + $('.textdelete').text() + '</a></td>';
					html = html + '</tr>';
				}
				
				$("tbody").html(html);											
			} else {
				$("tbody > tr").remove();
				$("tbody").html('<tr class="odd" ><td colspan="5">' + $('input[name="noresults"]').val() + '</td ></tr>');	
			}
		},
		
		error: function(jqXHR, textStatus){
			
		},
		
		complete: function(jqXHR, textStatus){
			
		}
	});
}

$(document).ready(function(){
	
	getRooms();
	
	$("#hotels").change(function () { getRooms(); });
});
