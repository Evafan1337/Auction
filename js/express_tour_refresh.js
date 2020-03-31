// alert('express_tour_refresh');

function checkForReload(stmt,data){
	console.log('checkForReload');
	setInterval(function(){
		console.log('checkForReload-interval');
		// console.log(data);
		data.forEach(function(element,index){
			dateNow = Math.trunc(new Date().getTime()/ 1000);
			elemTime = element.getTime() / 1000;
			console.log(dateNow - elemTime);
			if (!isNaN(element) && (dateNow - elemTime === 61)){

				location.href=location.href;
				
				console.log(dateNow - elemTime);
			// if(!isNaN(element) && (dateNow - elemTime > 60)){
				console.log('non elem-nan');
				// console.log('----');
			}

		});
		// dateNow = new Date();
		console.log(dateNow);

	},1000);
}

var expressTourDateArray = Array();
var expressTourExist = Array();
var expressTourStagesArray = Array.from(document.querySelectorAll('.auction-info_express-tour-stages'));
var lots = Array.from(document.querySelectorAll('.lot'));
var currentPageMarker = false;

expressTourStagesArray.forEach(function(element,index){
	expressTourDateArray[index] = new Date(expressTourStagesArray[index].innerText);
});


lots.forEach(function(element,index){
	console.log(element);
	var expressTourChecker = element.getElementsByClassName('express-tour');
	if(expressTourChecker.length > 0 && expressTourChecker[0].innerText === 'Экспресс тур!'){
		expressTourExist[index] = true;
	}
	else{
		// console.log('no!');
		expressTourExist[index] = false;
	}
});
console.log(expressTourExist);
console.log(expressTourDateArray);

expressTourExist.forEach(function(element,index){
	console.log(element);
	if(element == true){
		currentPageMarker = true;
	}
});

console.log(currentPageMarker);

if(currentPageMarker == true){
	// checkForReload(expressTourExist,expressTourDateArray);
}