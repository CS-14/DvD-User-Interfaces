// JavaScript Document

let carts =document.querySelectorAll('.buy');


let products = [

	{
		name: 'Batman',
		tag: 'Action',
		price: 120,
		image: 'flash2.jpg',
		incart: 0
	},

	{
		name: 'Constantine',
		tag: 'Mystery',
		price: 130,
		image: 'Guradians.jpg',
		incart: 0
	},

	{
		name: 'Harley Quinzel',
		tag: 'Animated',
		price: 140,
		image: 'constantine.jpg',
		incart: 0
	}

]

for(let i=0; i< carts.length; i++)
{
	carts[i].addEventListener('click',() => {
		cartNumbers(products[i]);
		totalCost(products[i]);

	})
}



function onLoadCartNum()
{
	let productNumbers = localStorage.getItem('cartNumbers');

	if(productNumbers)
	{

	document.querySelector('.cart span').textContent = productNumbers;
	}
}



function cartNumbers(product)
{
	
let productNumbers = localStorage.getItem('cartNumbers');


productNumbers = parseInt(productNumbers);

if (productNumbers)
{

	localStorage.setItem('cartNumbers',productNumbers + 1);
	document.querySelector('.cart span').textContent=productNumbers + 1;
}

else{
	localStorage.setItem('cartNumbers',1);
	document.querySelector('.cart span').textContent=1;
 }

 setItems(product);

}


function setItems(product)
{
	let cartItems =localStorage.getItem('productsInCart');
	cartItems = JSON.parse(cartItems);
	
	if(cartItems != null)
	{	

	if(cartItems[product.tag] == undefined){
		cartItems = {
            ...cartItems, [product.tag]: product
		}
	}	
		cartItems[product.tag].incart += 1;
	}	

	else
	{
	product.incart = 1;
	cartItems = {
		[product.tag]:product  
	    }	
	}

	localStorage.setItem("productsInCart", JSON.stringify(cartItems));
}




function totalCost(product)
{
	let cartCost = localStorage.getItem('totalCost');

	console.log("My cartCost is",cartCost);

	console.log(typeof cartCost);
	

	if(cartCost != null)
	{
		cartCost = parseInt(cartCost);
		localStorage.setItem("totalCost" ,cartCost + product.price);
	}

	else
	{
		localStorage.setItem("totalCost", product.price);
	}

	
}


function displayCart()
{
	let cartItems = localStorage.getItem("productsInCart");
	cartItems = JSON.parse(cartItems);
	
	let cartCost = localStorage.getItem('totalCost');
	let productContanier = document.querySelector(".products")

// console.log(cartItems)	;
if(cartItems && productContanier)
{
	productContanier.innerHTML = '';

			Object.values(cartItems).map(item => {

				console.log(item);
			productContanier.innerHTML +=
		"<div class='product'><ion-icon name='close-circle'> </ion-icon><img src ='../Justice/"
		+item.image+"'><span>"+item.name+"</span></div><div class ='price'>"
		+item.price+"</div><div class ='quantity'><ion-icon class='decrease' name='chevron-back-circle'></ion-icon><span>"
		+item.incart+"</span><ion-icon class='increase' name='chevron-forward-circle'></ion-icon></div><div class='total'>"
		+item.incart * item.price+",00</div>";

				}) ;
		

   productContanier.innerHTML +=

   "<div class='basketTotalContanier'><h4 class ='basketTotalTitle'>Basket Total</h4><h4 class='basketTotal'>"+cartCost+",00</h4></div>";

}

}
onLoadCartNum();
displayCart();



