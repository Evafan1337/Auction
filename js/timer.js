
var expressTourTimer = document.querySelectorAll('.express-tour-timer');
var expressTourTimerStart = document.querySelectorAll('.express-tour-timer-start');
expressTourTimerStart = expressTourTimerStart[0].innerText;
var currentStageTimeElem = document.getElementById('currentStageElem');
expressTourTimerStart1 = new Date(currentStageElem.innerText);
var expressTourTimerStartBetween = new Date(expressTourTimerStart1);
expressTourTimerStartBetween.setMinutes(expressTourTimerStartBetween.getMinutes() + 1);
console.log(expressTourTimer);
console.log(typeof expressTourTimerStart1);
console.log(expressTourTimerStart1);
console.log(expressTourTimerStartBetween);
printTimeExpress(expressTourTimer, expressTourTimerStart1, expressTourTimerStartBetween);

//надо все причесать
function printTime(fullTimeLeft,wrapper){
	console.log(fullTimeLeft);
	setInterval(function(){
		fullTimeLeft.forEach(function(element,index){
			lotDate = new Date(fullTimeLeft[index].innerText).getTime();
			dateNow = new Date().getTime();
			remainTime = new Date(lotDate - dateNow);
			remainTimeSecondsCheck = parseInt((lotDate - dateNow)/1000);
			remainTimeDays = remainTime.getDay();
			remainTimeHours = remainTime.getHours();
			remainTimeMinutes = remainTime.getMinutes();
			remainTimeSeconds = remainTime.getSeconds();
			if(remainTimeSecondsCheck <= 86400 && lotDate > dateNow){
				wrapper[index].innerText = remainTimeHours + ':' + remainTimeMinutes + ':' + remainTimeSeconds;
			}
			
		});
	},1000)
}

function printTimeExpress(wrapper,timeStart, timeGoing){
	setInterval(function(){
		dateNow = new Date;
		remainTime = new Date (timeGoing - dateNow);
		remainTimeMinutes = remainTime.getMinutes();
		remainTimeSeconds = remainTime.getSeconds();
		wrapper[0].innerText = remainTimeMinutes + ':' + remainTimeSeconds;
	},1000)
}

var auctionWrapper = document.querySelectorAll('.auction-info__timer');
var fullTimeLeft = Array.from(document.querySelectorAll('.auction-info__lot_time-finish'));
var dateNow = new Date().getTime();
var dateSplit = Array;

console.log(fullTimeLeft);

fullTimeLeft.forEach(function(element,index){
	var currentLotTime = fullTimeLeft[index].innerText;
	var lotDate = new Date(currentLotTime).getTime();
});

console.log(fullTimeLeft);
firstLotDate = new Date(fullTimeLeft[0].innerText).getTime();
console.log(dateNow);
console.log(firstLotDate);
console.log(fullTimeLeft);
printTime(fullTimeLeft,auctionWrapper);
