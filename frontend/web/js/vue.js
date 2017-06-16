
var currencies = new Vue({
	el: '#currencies',
	data: {
		currencies: {},
		lastUpdate: ""
	},
	mounted: function(){
		// get data every 60s
		this.getData();
		setInterval(this.getData.bind(this), 60*1000);
	},
	methods: {
		getData: function(){
			console.log("Fetching data!");
			fetch('index.php?r=site/currencies')
				.then(response => response.json())
				.then(res => {
				    this.processData(res);
				    this.currencies =  res;
				    var d = new Date();
				    
				    this.lastUpdate = d.toLocaleDateString()+", "+d.toLocaleTimeString();
				})
				.catch(err => {
					alert("Error while querying the API. Error: " + err);
			        console.error('An error ocurred', err);
			    });
		},
		processData: function (data){
			var valueBTC = 0;
			var valueEUR = 0;
			var euroAmount = 0;
			data.forEach((item, index) => {
				valueBTC += item.value_btc;
				valueEUR += item.value_eur;
				
				if(item.name == "Euro"){
					euroAmount = item.amount;
				}
			})
			
			var overall = new Vue({
				el: '#overall',
				data: {
					value_btc: valueBTC,
					value_eur: roundEuro (valueEUR),
					profit: roundEuro (valueEUR + euroAmount)
				},
			})
			
			function roundEuro (value){
				return Math.round(value*100) / 100;
			}
		}
	}
});
