var CAPMAP = {//will not change, used for reference
  "alabama":"montgomery",
  "alaska":"juneau",
  "arizona":"phoenix",
  "arkansas":"little rock",
  "california":"sacramento",
  "colorado":"denver",
  "connecticut":"hartford",
  "delaware":"dover",
  "florida":"tallahassee",
  "georgia":"atlanta",
  "hawaii":"honolulu",
  "idaho":"boise",
  "illinois":"springfield",
  "indiana":"indianapolis",
  "iowa":"des moines",
  "kansas":"topeka",
  "kentucky":"frankfort",
  "louisiana":"baton rouge",
  "maine":"augusta",
  "maryland":"annapolis",
  "massachusetts":"boston",
  "michigan":"lansing",
  "minnesota":"saint paul",
  "mississippi":"jackson",
  "missouri":"jefferson city",
  "montana":"helena",
  "nebraska":"lincoln",
  "nevada":"carson city",
  "new hampshire":"concord",
  "new jersey":"trenton",
  "new mexico":"santa fe",
  "new york":"albany",
  "north carolina":"raleigh",
  "north dakota":"bismarck",
  "ohio":"columbus",
  "oklahoma":"oklahoma city",
  "oregon":"salem",
  "pennsylvania":"harrisburg",
  "rhode island":"providence",
  "south carolina":"columbia",
  "south dakota":"pierre",
  "tennessee":"nashville",
  "texas":"austin",
  "utah":"salt lake city",
  "vermont":"montpelier",
  "virginia":"richmond",
  "washington":"olympia",
  "west virginia":"charleston",
  "wisconsin":"madison",
  "wyoming":"cheyenne"
}

var keys = Object.keys(CAPMAP);//list of all states, which we'll randomize and use to find keys and stuff later

var time = timeAlotted = 10;

updateClock();

var countingDown;


var score = 0;

var input = document.getElementById('input');
setCountingDown(false);
// reset();

start();
finish();

document.getElementById('start').onclick = function(){
  if(!countingDown)
    return start();
  return finish()
}

function checkGuess(guess, fromkey){
  var state = keys[startIndex];
	
  if(CAPMAP[state] == guess.toLowerCase()){//they guessed right
    flashCol("green")
    return {
      bool:true,
      message:"Correct! " + guess + " is a state!"
    }
  }


  if(!fromkey)
    flashCol("red");
	return {
		bool:false,
		message:guess + " is not a state!"
	};

}

function timeToString(t){
  if(!t)
    t = time;
  var minutes = parseInt(t/60);
  var seconds = t % 60;
  seconds = (seconds < 10 ? "0" : "") + seconds;

  return minutes + ":" + seconds;
}


var countdown;
var startIndex = -1;

function next(){
  startIndex++;
  document.getElementById('remaining').innerHTML = keys.length - startIndex;
  input.value = "";
  if(startIndex == keys.length){//done

      var win = "You win! Your score was " + score + "/" + keys.length;
      finish();
      document.getElementById('message').innerHTML = win;
      setTimeout(function(){
        document.body.className = "hurray";  
      }, 1000)
      
      setTimeout(function(){
        document.body.className = "";
      }, 2000)
    finish();
    

  } else {
    time = timeAlotted;
    updateClock();

    document.getElementById('state').innerHTML = keys[startIndex];  
  }

  
}

function start(){
  startIndex = -1;
  score = 0;
  document.getElementById('score').innerHTML = score;
  keys.sort(function(){//randomize keys
    return 0.5-Math.random();
  });

  document.getElementById('message').innerHTML = "";
  document.getElementById('score').innerHTML = "0";
  document.body.className = "";

  next();

  document.getElementById('start').innerHTML = "(S)top";
  
  time = timeAlotted;
  setCountingDown(true);
  input.focus();
  updateClock();
  countdown = setInterval(function(){
    time-=1;
    updateClock();

    if(time == 0){
      next();
    }
      
  }, 1000)
}

function finish(){//show score, etc.
  // highScoreupdateClock();
  document.getElementById('start').innerHTML = "(S)tart";
  document.getElementById('state').innerHTML = "...";
  clearInterval(countdown);
  setCountingDown(false);
  reset();
}


function check(fromkey){
    var result = checkGuess(input.value, fromkey);
    
    if(result.bool){
      input.value = "";
      score++;
      document.getElementById('score').innerHTML = score;
      next();
    }
      

      
      // var win = "You win! Completed in " + timeToString(5*60 - time) + "!";
      // finish();
      // document.getElementById('message').innerHTML = win;
      // setTimeout(function(){
      //   document.body.className = "hurray";  
      // }, 1000)
      
      // setTimeout(function(){
      //   if(document.getElementById('message').innerHTML == win)
      //     document.getElementById('message').innerHTML = "";
      //   document.body.className = "";
      // }, 5000)

    input.focus();

}

document.getElementById('next').onclick = check;

input.onkeyup = function(e){
  var fromkey = (e.which != 13);
    // if(e.which == 13){//user hit enter
  check(fromkey);
  // }
}

function setCountingDown(bool){
  countingDown = bool;
  document.getElementById('input').disabled = !bool
  document.getElementById('next').disabled = !bool

  if(document.getElementById('next').disabled)
    document.getElementById('next').focus();
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

function updateClock(){
    document.getElementById('time').innerHTML = timeToString();
}

function reset(){

  time = timeAlotted;
  
  updateClock();
  document.getElementById('remaining').innerHTML = keys.length;

  // start();

}
