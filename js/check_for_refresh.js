function checkForReloadPanel(data){
	console.log('checkForReload');
	var intervalID = setInterval(function(){
		console.log('checkForReload-interval');
		data.forEach(function(element,index){
			console.log(element);
			dateNow = Math.trunc(new Date().getTime()/ 1000);
			elemTime = element.getTime() / 1000;
			console.log(dateNow - elemTime);
			if (!isNaN(element) && (dateNow - elemTime === 61)){
				location.href='main';
				clearInterval(intervalID);
				console.log(dateNow - elemTime);
				console.log('non elem-nan');
			}

		});
		console.log(dateNow);

	},1000);
}

var expressTourPanel = document.querySelectorAll('.express-tour-wrapper');

if(expressTourPanel){
	var dates = Array.from(document.querySelectorAll('.express-tour__date'));
	var datesArray = Array();

	dates.forEach(function(element,index){
		datesArray[index] = new Date(dates[index].innerText);
	});

	console.log(dates);
	console.log(datesArray);
	console.log(datesArray.length);

	if(datesArray.length !== 0){
		checkForReloadPanel(datesArray);
	}
}