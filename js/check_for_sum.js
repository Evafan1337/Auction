function check_for_sum(){
	var betInputValue = parseInt(document.getElementById('betInput').value);
	var maxBet = parseInt(document.getElementById('maxBet').innerText);
	var betStep = parseInt(document.getElementById('betStep').innerText);

	// console.log(maxBet - betStep);
	alert('check_for_sum');
	if((maxBet+betStep) > betInputValue){
		alert('Неправильное значение. Введите значение ставки больше максимальной. Или же проверьте время отправления ставки.');
		return false;
	}
	else{
		return true;
	}
}

function check_for_time(){
	var currentStageTimeElem = document.getElementById('currentStageElem');
	var currentStageElemDate = new Date(currentStageElem.innerText).getTime();
	var currentStageElemDateFinish = new Date(currentStageElem.innerText);
	dateNow = new Date().getTime();
	currentStageElemDateFinish.setMinutes(currentStageElemDateFinish.getMinutes() + 15);
	if(dateNow > currentStageElemDateFinish) {
		return false;
	}
	else{
		return true;
	}

}

function check_for_submit(){
	if(check_for_sum() && check_for_time()){
		return true;
	}
	else{
		return false;
	}
}

document.getElementById('expressTourBetForm').onsubmit = function() {
	return check_for_submit();
};