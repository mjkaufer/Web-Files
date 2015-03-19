var map = {
	"Queen":["Radio Ga Ga", "Killer Queen", "We Will Rock You", "Don't Stop Me Now", "Bicycle Race"],
	"Foo Fighters":["Something from Nothing", "Everlong", "Monkey Wrench", "Back and Forth"],
	"Cage the Elephant":["Ain't No Rest for the Wicked", "Cigarette Daydreams", "Aberdeen"]
}

var dropDownOne = document.getElementsByTagName('select')[0];
var dropDownTwo = document.getElementsByTagName('select')[1];

function radioClick(e){
	if(e.value.toLowerCase() == "goo goo")
		return dropDownOne.size = dropDownOne.children.length
	return dropDownOne.size = 1
}

function updateSecond(){
	var artist = dropDownOne.value;

	
	while(dropDownTwo.hasChildNodes()){
    	dropDownTwo.removeChild(dropDownTwo.lastChild);
	}

	for(var i in map[artist]){
		var option = document.createElement('option');
		option.value = option.innerHTML = map[artist][i]
		dropDownTwo.appendChild(option)
	}
}

document.getElementsByTagName("input")[1].checked = true