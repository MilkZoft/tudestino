$(document).ready(function(){
	
	$(".is_numeric").blur(function(){
		if(isNaN(parseInt($(this).val()))) {
			setError(this);
		} else {
			setSuccess(this);
		}
	});
				
	$("#formElem").find(".validate").each(function() {
		$(this).blur(function() {
			if($(this).val().length > 0 & $(this).attr("name") !== "email") {
				
				
						
				if($(this).attr("name") == "zip_code" || $(this).attr("name") == "area" ) {

					if(isNaN(parseInt($(this).val()))) {
						setError(this);
					} else {
						setSuccess(this);
					}
					
				} else if($(this).attr("name") == "website") {	
					if(testType("url", $(this).val())) {
						setSuccess(this);
						return true;
					} else {
						setError(this); 
						return false;
					}
				} else {
					setSuccess(this);
				}
				
			} else if($(this).val().length > 0 & $(this).attr("name") == "email") {
				if($(this).attr("name") == "email" && $(this).val() != "") {
					if(testType("email", $(this).val())) {
						setSuccess(this);
						return true;
					} else {
						setError(this); 
						return false;
					}
				}
			} else if($(this).attr("name") == "email" & $(this).val() == "")  {
				cleanAll(this);
			} else {
				setError(this);
			}
		});
	});
	
	$('.vcode').click(function(){$(this).next().toggle('slow'); return false;});
	$('.alphanumeric').alphanumeric();
	$('.alpha').alpha({nocaps:false, allow:" "});
	$('.telephone').numeric({allow:"-"});
	$('.numeric').numeric();
	$('.sample6').alphanumeric({ichars:'.1a'});

	/*
	form.submit(function(){
		if(validate(nombre, nombreInfo) & validate(apellidoPaterno, apellidoPaternoInfo) & validate(apellidoMaterno, apellidoMaternoInfo) & 
		validateSelect(ocupacion, ocupacionInfo) & validate(noCuenta, noCuentaInfo) & validateSelect(conferencias, conferenciasInfo) &
		validateSelect(mesa, mesaInfo) & validate(institucion, institucionInfo) & validate(dependencia, dependenciaInfo) &
		validate(direccion, direccionInfo) & validateEmail(email, emailInfo) & validateSelect(estado, estadoInfo) &
		validate(codigoPostal, codigoPostalInfo)) {
			return true
		} else {
			return false;
		}
	});
	*/
});
