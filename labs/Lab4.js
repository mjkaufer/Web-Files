document.body.onclick = function(e){
	console.log(e.target);
	target = e.target;
	//check firstChild, then nextSibling, then parentNode's next sibling, then body's first child if nothing else

	var newTarget =  target.firstElementChild || nextInDom(target);

	// if(target.firstElementChild){
	// 	newTarget = target.firstElementChild;
	// } else if(target.nextElementSibling){
	// 	newTarget = target.nextElementSibling;
	// }

	console.log(newTarget)

	newTarget.style.background = "#BADA55";

	setTimeout(function(){
		newTarget.style.background = "";
	}, 500)

}

function nextInDom(element, considerChildren){

	if(element == null)
		return document.body;

	var newTarget = element.nextElementSibling;

	if(newTarget == null)
		return nextInDom(element.parentNode)

	if(newTarget.tagName.toUpperCase() == "SCRIPT")
		newTarget = newTarget.nextElementSibling;

	if(newTarget == null)
		return document.body;

	return newTarget;

}