

// alert('restart!');

function action(counter){
	// alert('action');
	console.log(counter);
	if(counter.innerText === '0'){
		counter.textContent = '1';
		// location.href='main';
	}
	if(counter.innerText === '1'){
		counter.textContent = '3';
		// location.href = 'main';
	}
}

function restartPage(counter){
	var intervalID = setInterval(function(){
		// console.log('interval');

		// for(i = 0; i<2; i++){
			action(counter);
		// }

		clearInterval(intervalID);
	},5000);
}

var counter = document.querySelector('.double-refresher');
console.log(counter);

sessionStorage('counter','1');

// restartPage(counter);

