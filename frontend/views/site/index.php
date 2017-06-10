<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div id="currencies"></div>

<h1>Konto</h1>
<div>
	<?php foreach ($currencies as $currency){?>
		<div><?=$currency->name ?>: <?=$currency->amount ?></div>
	<?php }?>
</div>
<script>
var data = null;
getData();

function getData(){
	fetch('index.php?r=site/currencies')
		.then(response => response.json())
		.then(res => {
		    data = res;
		    renderData();
		})
		.catch(err => {
			alert("Error while querying the API. Error: " + err);
	        console.error('An error ocurred', err);
	    });
}

function renderData(){
	var target = document.getElementById("currencies");
	var currentValue = 0;
	data.forEach((item, index) => {
		currentValue += item.value_eur;
		
		var z = document.createElement("p");
		var title = document.createElement("h2");
		title.appendChild(document.createTextNode(item.name + " ("+item.symbol+")"));
		z.appendChild(title);
		
		var x = document.createTextNode("Amount: "+item.amount+ "   Value: "+item.value_eur+"    Price: "+item.price_btc+" BTC  =  "+item.price_eur+" €");
		z.appendChild(x);
		target.appendChild(z);
	});

	target.appendChild(document.createTextNode("Current Value: "+currentValue));
}

</script>