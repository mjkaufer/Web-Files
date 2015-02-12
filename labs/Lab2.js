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

var tempStates = permaStates.slice();


function checkGuess(guess){
	guess = guess.trim().toLowerCase();
	if(tempStates.indexOf(guess) == -1)
		if(permaStates.indexOf(guess) == -1)//if the state has already been listed
			return {
				bool:false,
				message:"Already listed " + guess + "!"
			};
		else//guess is not a state
			return {
				bool:false,
				message:guess + " is not a state!"
			};
	//else, guess is an unnamed state
	tempStates.splice(tempStates.indexOf(guess), 1);//remove guess

	return {
		bool:true,
		message:"Correct! " + guess + " is a state!"
	}

}

