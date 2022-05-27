<?php
ob_start();
// include header.php file
include('header.php');
?>
<?php

/*  include cart items if it is not empty */
count($product->getcartData($user_id , 'cart')) ? include ('Template/_cart-template.php') :  include ('Template/notFound/_cart_notFound.php');
/*  include cart items if it is not empty */

/*  include top sale section */
count($product->getcartData($user_id , 'wishlist')) ? include ('Template/_wishlist_template.php') :  include ('Template/notFound/_wishlist_notFound.php');
/*  include top sale section */


/*  include top sale section */
include ('Template/_new-phones.php');
/*  include top sale section */

?>

<?php
// include footer.php file
include('footer.php');
?>
