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
<title>Payment Gateway</title>
</head>

<body>
	
	<div class="container">
    <?php 
        // Fetch products from the database 
        $results = $db->query("SELECT * FROM products WHERE status = 1"); 
        while($row = $results->fetch_assoc()){ 
    ?>
        <div class="pro-box">
            <img src="images/<?php echo $row['image']; ?>"/>
            <div class="body">
                <h5><?php echo $row['name']; ?></h5>
                <h6>Price: <?php echo '$'.$row['price'].' '.PAYPAL_CURRENCY; ?></h6>
				
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
            </div>
        </div>
    <?php } ?>
</div>
	
	<script src="https://www.paypal.com/sdk/js?client-id=AbJlSxBOV6HPb_dN1O5LGnvaEfyekJZgH1OCAn8v6VB4lc11m1xerToLWp6t4vWEWoWUpAFBODv2rLET"></script>
						<script src="index.js">
											</script>
	
</body>
</html>