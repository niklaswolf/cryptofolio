<?php
?>

<script>
var data = null;
getData();

function getData(){
	fetch('index.php?r=site/update')
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
	var body = document.getElementsByTagName("body")[0];
	data.forEach((item, index) => {
		var z = document.createElement("p");
		var x = document.createTextNode(item.name+": "+item.price_btc);
		z.appendChild(x);
		body.appendChild(z);
	});
}

</script>