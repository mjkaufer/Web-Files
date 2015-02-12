var permaStates = [//will not change, used for reference
  "alabama",
  "alaska",
  "arizona",
  "arkansas",
  "california",
  "colorado",
  "connecticut",
  "delaware",
  "florida",
  "georgia",
  "hawaii",
  "idaho",
  "illinois",
  "indiana",
  "iowa",
  "kansas",
  "kentucky",
  "louisiana",
  "maine",
  "maryland",
  "massachusetts",
  "michigan",
  "minnesota",
  "mississippi",
  "missouri",
  "montana",
  "nebraska",
  "nevada",
  "new hampshire",
  "new jersey",
  "new mexico",
  "new york",
  "north carolina",
  "north dakota",
  "ohio",
  "oklahoma",
  "oregon",
  "pennsylvania",
  "rhode island",
  "south carolina",
  "south dakota",
  "tennessee",
  "texas",
  "utah",
  "vermont",
  "virginia",
  "washington",
  "west virginia",
  "wisconsin",
  "wyoming"
]


var tempStates;

var time;
var countingDown;

var input = document.getElementById('input');

reset();

document.getElementById('start').onclick = function(){
  if(!countingDown){
    this.innerHTML = "Stop";
    return start();
  }
  this.innerHTML = "Start";
  return finish()
}

function checkGuess(guess){
	guess = guess.trim().toLowerCase();
	if(tempStates.indexOf(guess) == -1)
		if(permaStates.indexOf(guess) != -1){//if the state has already been listed
      flashCol("blue");
			return {
				bool:false,
				message:"Already listed " + guess + "!"
			};
    }
		else{//guess is not a state
      flashCol("red");
			return {
				bool:false,
				message:guess + " is not a state!"
			};
    }
	//else, guess is an unnamed state
	tempStates.splice(tempStates.indexOf(guess), 1);//remove guess from list if it's correct
  flashCol("green")
	return {
		bool:true,
		message:"Correct! " + guess + " is a state!"
	}

}

function timeToString(){
  var minutes = parseInt(time/60);
  var seconds = time % 60;
  seconds = (seconds < 10 ? "0" : "") + seconds;

  return minutes + ":" + seconds;
}


var countdown;

function start(){
  tempStates = permaStates.slice();
  time = 5*60;
  setCountingDown(true);
  update();
  countdown = setInterval(function(){
    time-=1;
    update();

    if(time == 0){
      var failure = "You lose!";
      
      document.getElementById('message').innerHTML = failure;
      setTimeout(function(){
        if(document.getElementById('message').innerHTML == failure)
          document.getElementById('message').innerHTML = "";
      }, 2000)

      var finalStates = tempStates.slice();
      console.log(finalStates);
      finish();
    }
      
  }, 1000)
}

function finish(){//show score, etc.
  clearInterval(countdown);
  reset();
}



input.onkeydown = function(e){
  if(e.which == 13){//user hit enter
    var result = checkGuess(input.value);
    document.getElementById('remaining').innerHTML = tempStates.length;
    if(result.bool)
      input.value = "";

    if(tempStates.length == 0){
      finish();
      var win = "You win!";
      document.getElementById('message').innerHTML = win;
      setTimeout(function(){
        if(document.getElementById('message').innerHTML == win)
          document.getElementById('message').innerHTML = "";
      }, 2000)

    }
      
  }
}

function setCountingDown(bool){
  countingDown = bool;
  document.getElementById('input').disabled = !bool
  document.getElementById('next').disabled = !bool
}

var colorInterval;

function flashCol(col){

  if(colorInterval)
    clearInterval(colorInterval);

  input.style.borderStyle = "solid";
  input.style.borderColor = col;
  input.style.borderWidth = "1px";
  input.style.padding = "2px 1px";

  colorInterval = setInterval(function(){
    input.style.borderStyle = "";
    input.style.borderColor = "";
    input.style.borderWidth = "";
    input.style.padding = "";
  }, 300)


}

function update(){
    document.getElementById('time').innerHTML = timeToString();
}

function reset(){

  time = 5*60;
  tempStates = permaStates.slice();
  setCountingDown(false)
  update();
  document.getElementById('remaining').innerHTML = permaStates.length;

}
