<?php include 'header.php' ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Checkout API with Javascript SDK</h4>
            <p>PayHere Checkout API lets you charge one time Payment from the customers. After Payment Complete Payment
                Notification details will send you to your notify_url.
                If you're new to Checkout API, please refer
                <a href="https://support.payhere.lk/api-&-mobile-sdk/payhere-checkout">Checkout API</a>
                introduction first.
            </p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-7">
            <form action="https://sandbox.payhere.lk/pay/checkout" method="post">
                <div class="form-group row">
                    <label for="merchant_id" class="col-sm-2 col-form-label">Merchant ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="merchant_id" name="merchant_id" placeholder="">
                        <small><em>You can leave this field.</em></small>
                    </div>
                </div>
                <input type="hidden" name="return_url" value="http://payhere.bhasha.lk/payhere-demo-beta/checkout-api/checkout-response">
                <input type="hidden" name="cancel_url" value="http://payhere.bhasha.lk/payhere-demo-beta/checkout-api/checkout-response">
                <input type="hidden" name="notify_url" value="http://payhere.bhasha.lk/payhere-demo-beta/checkout-api/checkout-notify">
                <input type="hidden" name="custom_2" value="<?php echo session_id() ?>">
                <div class="form-group row">
                    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="">
                    </div>
                    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="city" name="city" placeholder="" value="Colombo">
                    </div>
                    <label for="country" class="col-sm-2 col-form-label">Country</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="country" name="country" placeholder="" value="Sri Lanka">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="order_id" class="col-sm-2 col-form-label">Order ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="order_id" name="order_id" placeholder="" value="<?php echo rand(10000, 99999) ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="items" class="col-sm-2 col-form-label">Items</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="items" name="items" placeholder="" value="Sample Subscription Item" />
                        <em><small>Optional</small></em>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="currency" class="col-sm-2 col-form-label">Currency</label>
                    <div class="col-sm-10">
                        <select name="currency" id="currency" class="form-control">
                            <option value="USD">USD</option>
                            <option value="LKR">LKR</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="currency" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="" value="100.00" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <button type="button" id="submit-button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-5 bg-dark text-white">
            <h3>Preview</h3>
            <div style="display: none" id="payment_div"><a href="" target="_blank">View Payment Details</a></div>
            <pre class="bg-dark text-white">
            <div id="form_preview"></div>
            </pre>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://sandbox.payhere.lk/lib/payhere.js"></script>
<script>
    $(document).ready(function() {

        $('input').change(function() {
            $('.text-danger').html('');
            var jsonString = $("form").serializeArray();
            var array = {};
            $.each(jsonString, function(i, row) {
                if (row.name != 'custom_2')
                    array[row.name] = row.value;
            });
            var jsonPretty = JSON.stringify(array, null, 2);
            $("#form_preview").html(jsonPretty);
        })
        $('input').change();



        payhere.onCompleted = function onCompleted(orderId) {
            console.log("Payment completed. OrderID:" + orderId);
            // Note: validate the payment and show success or failure page to the customer
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
            // Note: Prompt user to pay again or show an error page
            console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
            // Note: show an error page
            console.log("Error:" + error);
        };

        // Put the payment variables here


        $("#chargin-submit").click(function() {
            var payment = $("#submit-form").serializeArray();
            payhere.startPayment(payment);
        });

    });
</script>
<?php include 'footer.php' ?>