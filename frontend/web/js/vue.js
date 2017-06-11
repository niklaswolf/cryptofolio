/**
 * 
 */
getData();

function getData(){
	fetch('index.php?r=site/currencies')
		.then(response => response.json())
		.then(res => {
		    data = res;
		    renderData(res);
		    
		})
		.catch(err => {
			alert("Error while querying the API. Error: " + err);
	        console.error('An error ocurred', err);
	    });
}

function renderData(data) {
	
	var currencies = new Vue({
  	  el: '#currencies',
  	  data: {
  	    currencies: data
  	  }
  	})
	
	var valueBTC = 0;
	var valueEUR = 0;
	data.forEach((item, index) => {
		valueBTC += item.value_btc;
		valueEUR += item.value_eur;
	})
	
	var overall = new Vue({
		el: '#overall',
		data: {
			value_btc: valueBTC,
			value_eur: valueEUR
		}
	})
}