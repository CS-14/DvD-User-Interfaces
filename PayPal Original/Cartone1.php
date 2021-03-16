<?php 
// Include configuration file 
include_once 'config.php'; 
 
// Include database connection file 
include_once 'dbConnect.php'; 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Cart Official</title>
	
	
<link rel="stylesheet" href="cart.css">
<link rel="stylesheet" href="ProductCart1.css" >
<link rel="stylesheet" href="ShopMain_NavBar.css" >
<link rel="stylesheet" href="ShopMain_Section.css" >
<link rel="stylesheet" href="ShopMain_Gallery.css" >
</head>

<body>
<header>
    <a href="#" class="logo">DVD<span>House</span></a>
    
    <div class="toggle"></div>
     <div class="toggleMenu" onmouseover="toggleMenu();"></div>
    <ul class="navigation">
 	<li><a href="ShopMain.html">Home</a></li>
    <li><a href="ShopMain.html">About</a></li>
    <li class="cart">
    <a href="CartOne.html">
    <ion-icon name="basket"></ion-icon>Cart<span>0</span>
    </a></li>
    
 </ul>
 </header>
 
<section class="product1">

<div class ="products-container">
    <div class="product-header">
      <h5 class="product-title">PRODUCT</h5>
       <h5 class="price">PRICE</h5>
        <h5 class="quantity">QUANTITY</h5>
         <h5 class="total">TOTAL</h5>
         </div>

         <div class ="products">

         </div>

</div>
	  <!-- PayPal payment form for displaying the buy button -->
                <form action="<?php echo PAYPAL_URL; ?>" method="post">
                    <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
					
                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">
					
                    <!-- Specify details about the item that buyers will purchase. -->
                    <input type="hidden" name="item_name" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="item_number" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="amount" value="<?php echo $row['price']; ?>">
                    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
					
                    <!-- Specify URLs -->
                    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
					<input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
					
                    <!-- Display the payment button. -->
					
                    <div id="paypal-payment-button">
					</div>
					
                </form>
         
</section>
    
				
              
	
	<script src="https://www.paypal.com/sdk/js?client-id=AbJlSxBOV6HPb_dN1O5LGnvaEfyekJZgH1OCAn8v6VB4lc11m1xerToLWp6t4vWEWoWUpAFBODv2rLET"></script>
						<script src="index.js">
</script>

   <section class="footer">
   
   <ul class="sci">
     <li><a href="#"><img src="../User1/facebook.png"></a></li>
     <li><a href="#"><img src="../User1/instagram.png"></a></li>
     <li><a href="#"><img src="../User1/twitter.png"></a></li>
     </ul>
   
   <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>
   </section>



<script src="vanilla-tilt.min.js"></script>
<script>
 VanillaTilt.init(document.querySelectorAll(".box"), {
		max: 25,
		speed: 400
	});
</script>
<script src="ShopCart.js"></script>
<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

 
    <script type="text/javascript"> 
    function toggleMenu()
    {
    const toggleMenu = document.querySelector('.toggleMenu');
	const navigation = document.querySelector('.navigation');
    toggleMenu.classList.toggle('active');
	navigation.classList.toggle('active');
    }
    </script>

</body>
</html>