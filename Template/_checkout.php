<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once('database/config.php');

    $firstName = $_POST["cust_first_name"];
    $last_name = $_POST["cust_last_name"];
    $cust_username = $_POST["cust_username"];
    $address_1 = $_POST["address_1"];
    $address_2 = $_POST["address_2"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $zipcode = $_POST["zipcode"];

    $sql = "INSERT INTO `cust_address` ( `fist_name`, `last_name`, `cust_username`, `address_1`, `address_2`, `country`,`state`,`zipcode`) VALUES ('$firstName', '$last_name', '$cust_username', '$house_no', '$address_1', '$address_2','$country','$state','$zipcode')";
    mysqli_query($conn, $sql);



}

?>

<div class="container">
    <main>

        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="./assets/shoewoo_logo.png" alt="" width="72" height="72">
            <h2>Checkout</h2>
        </div>

        <div class="row gy-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill"><?php echo count($product->getcartData($user_id , 'cart')); ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                        foreach ($product->getcartData($user_id , 'cart') as $item) :
                        $cart = $product->getProduct($item['item_id']);
                        $subTotal[] = array_map(function ($item){
                        ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
                            <small class="text-muted">by <?php echo $item['item_brand'] ?? "Brand"; ?></small>
                        </div>
                        <div class="font-size-20 text-danger font-baloo">
                            ₹<span class="product_price" data-id="<?php echo $item['item_id'] ?? '0'; ?>"><?php echo $item['item_price'] ?? 0; ?></span>
                        </div>
                    </li>
                            <?php
                            return $item['item_price'];
                        }, $cart); // closing array_map function
                        endforeach;
                    ?>

                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>DEVIRAIVA5</small>
                        </div>
                        <span class="text-success">−%5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (₹)</span>
                        <strong><?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?></strong>
                    </li>
                </ul>

                <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </form>
            </div>

            <div class="col-md-7 col-lg-8 ">
                <h4 class="mb-3">Billing address</h4>
                <form action="checkout.php" method="post">
                    <div class="row gy-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="last_name" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="last_name" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="cust_username" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="cust_username" placeholder="Username" required>
                                <div class="invalid-feedback">
                                    Your username is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" id="email" placeholder="you@example.com">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="address_1" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address_1" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="address_2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="address_2" placeholder="Apartment or suite">
                        </div>
                        
                        
                        <div class="col-md-3 ">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" placeholder="" required>
                            <div class="invalid-feedback">
                                Country code required.
                            </div>
                        </div>
                        

                        <div class="col-md-3 ">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" placeholder="" required>
                            <div class="invalid-feedback">
                                State code required.
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <label for="zipcode" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zipcode" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="same-address">
                        <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="save-info">
                        <label class="form-check-label" for="save-info">Save this information for next time</label>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                            <label class="form-check-label" for="credit">Credit card</label>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="cc-number" class="form-label">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-expiration" class="form-label">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <a class="w-100 my-5 btn btn-primary btn-lg" id="checkout" href='thankyou.php'>Continue to checkout</a>
                                        
                </form>
            </div>
        </div>
    </main>

</div>


<script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="form-validation.js"></script>
</body>
</html>
