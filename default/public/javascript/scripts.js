$(document).ready(function() {
	$('#busc').keyup(function() {
		console.log($('#busc').val());
		for (var i = 0; i < $('tr:not(#head)').length; i++) {
			if ($('tr:not(#head)')[i].getAttribute('id').toLowerCase().indexOf($('#busc').val().toLowerCase()) < 0) {
				$('tr:not(#head)')[i].style.display='none';
			}else{
				$('tr:not(#head)')[i].style.display='table-row';
			}
		}
	});
	$('#nuevo_usuario').submit(function(e) {
	    e.preventDefault();
	  }).validate({
	    debug: false,
	    rules: {
	      "nombre": {
	        required: true
	      },
	      "apellidos": {
	        required: true
	      },
	      "localidad": {
	        required: true
	      },
	      "nombre_usuario": {
	        required: true,
	        maxlength: 30
	      },
	      "email": {
	        required: true,
	        email: true
	      },
	      "password": {
	        required: true
	      }
	    },
	    messages: {
	      "nombre": {
	        required: 'Introduzca un nombre válido.'
	      },
	      "apellidos": {
	        required: 'Introduzca unos apellidos válidos.'
	      },
	      "localidad": {
	        required: 'Introduzca una localidad válida'
	      },
	      "nombre_usuario": {
	        required: 'Introduzca un nombre de usuario válido.'
	      },
	      "email": {
	        required: 'Introduzca un email válido.',
	        email: 'Introduzca un email con un formato válido (aaa@bbb.ccc).'
	      },
	      "password": {
	        required: 'Introduzca una contraseña válida.'
	      }
	    }
	  });
		
});
function random_password(length) {
	var iteration = 0;
	var password = "";
	var randomNumber;
	while (iteration < length) {
		randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
		if ((randomNumber >= 33) && (randomNumber <= 47)) {
			continue;
		}
		if ((randomNumber >= 58) && (randomNumber <= 64)) {
			continue;
		}
		if ((randomNumber >= 91) && (randomNumber <= 96)) {
			continue;
		}
		if ((randomNumber >= 123) && (randomNumber <= 126)) {
			continue;
		}
		iteration++;
		password += String.fromCharCode(randomNumber);
	}
	return password;
}