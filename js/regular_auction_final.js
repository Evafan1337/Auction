// alert('regular!');

function regularBetCheckForReload(data) {
	console.log('regularBetCheckForReload');
	var intervalId = setInterval(function(){

		data.forEach(function(element,index){
			console.log(element);
			elementDate = new Date(element);
			dateNow = Math.trunc(new Date().getTime()/ 1000);
			console.log(typeof(elementDate));
			// typeof element;
			elemTime = (elementDate.getTime() / 1000);
			console.log(dateNow - elemTime);

			if(dateNow === elemTime){
				location.href='main';
				clearInterval(intervalID);
			}
		});

	},1000);
};

function diffDates(day_one, day_two) {
    return (day_one - day_two) / (60 * 60 * 24 * 1000);
};

var lotDateFinishElement = Array.from(document.querySelectorAll('.auction-info__lot_time-finish'));
var lotDate = Array();
var currentDate = new Date().getTime();
console.log(lotDateFinishElement);

lotDateFinishElement.forEach(function(element,index){
	lotDate[index] = new Date(lotDateFinishElement[index].innerText).getTime();
});

console.log(lotDate);
console.log(currentDate);

var diffSec = Math.trunc((lotDate - currentDate)/1000);
var diff = new Date(Math.trunc((lotDate - currentDate)/1000));
console.log(diff);
console.log(diffSec);

if(diffSec < 1200){
	regularBetCheckForReload(lotDate);
}