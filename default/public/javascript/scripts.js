$(document).ready(function(){
	$('#busc').keyup(function(){
		console.log('adsadsdsa');
	});
});

function buscar(){
console.log('adsasd');	
}

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