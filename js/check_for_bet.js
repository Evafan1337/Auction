// alert('check for bet!');

// betForm = document.querySelector('.betForm');
// console.log(betForm);

function check_for_bet(){

	// var betInterval = parseInt(document.getElementById('betInterval').innerText);
	var maxBet = parseInt(document.getElementById('userBet').innerText);
	var betCount = parseInt(document.getElementById('betCount').innerText);
	var betInputValue = parseInt(document.getElementById('betInputRegular').value);

	// console.log(betInterval);
	console.log(maxBet);
	console.log(betCount);
	console.log(betInputRegular);

	// alert('check_for_bet func');

	if(betInputValue > maxBet && betCount != 0){
		return true;
	}
	else if(betCount === 0){
		return true;
	}
	else if(isNan(maxBet)){
		return true;
	}
	else{
		alert('Введите корректное значение ставки. Оно должно быть больше вашей текущей максимальной.');
		return false;
	}

}

// document.querySelector('.betForm').onsubmit = function(){
// 	// alert('pressed');
// 	// return false;
// 	return check_for_bet();
// };
