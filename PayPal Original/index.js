// JavaScript Document

paypal.Buttons({
	style:{
		shape:'pill',
		color:'blue'
	},
	createOrder:function(data,actions){
		return actions.order.create({
			purchase_units:[
				{
					amount:{
						value:'0.1'
					}
				}]
		});
	},
	
	onApprove:function(data,actions)
	{
	window.location.href="success.php";
	console.log(data);
	console.log(actions);
		return actions.order.capture().then(function(details) {
		
	console.log(details);
//window.location.replace(url: "http://localhost:80443/PayPal/Pay2/success.php")
	})
	},
	
	onCancel:function(data)
	{
		window.location.href="cancel.php";
//		window.location.replace(url:"http://localhost:80443/PayPal/Pay2/cancel.php")
	}
}
).render('#paypal-payment-button');