document.getElementById('form').onsubmit = function(e){
	
	var selects = document.getElementsByTagName('select');

	for(var i = 0; i < selects.length; i++){
		var s = selects[i];
		if(s.value == "*")
			s.disabled = true;
	}
}