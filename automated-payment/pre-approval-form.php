<?php include 'header.php' ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Redirecting Customer to PayHere Payment Gateway</h4>
            <p>Regardless of your scripting language, you can simply use an HTML Form to submit the below POST params to
                PayHere Payment Gateway. When the form is submitted, your customer will be securely redirected to the
                PayHere Payment Gateway & the customer can then enter the credentials (Card No / CVV) & securely process
                the preapproval there.</p>
            <div class="alert alert-info">
                <p>This is one time request to generate a token for a customer.</p>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-8">
            <form action="https://sandbox.payhere.lk/pay/preapprove" method="post">
                <div class="form-group row">
                    <label for="merchant_id" class="col-sm-2 col-form-label">Merchant ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="merchant_id" name="merchant_id" placeholder="">
                        <small><em>You can leave this field.</em></small>
                    </div>
                </div>
                <input type="hidden" name="return_url" value="http://payhere.bhasha.lk/payhere-demo-beta/automated-payment/pre-approval-view">
                <input type="hidden" name="cancel_url" value="http://payhere.bhasha.lk/payhere-demo-beta/automated-payment/pre-approval-view">
                <input type="hidden" name="notify_url" value="http://payhere.bhasha.lk/payhere-demo-beta/automated-payment/pre-approval-return">
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
                        <input type="text" class="form-control" id="country" name="country" placeholder=""
                               value="Sri Lanka">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="order_id" class="col-sm-2 col-form-label">Order ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="order_id" name="order_id" placeholder=""
                               value="<?php echo rand(10000, 99999) ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="items" class="col-sm-2 col-form-label">Items</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="items" name="items" placeholder=""
                               value="Sample Item"/>
                    </div>
                </div>
                <em>Optional</em>
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
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button><br/>
                        <em>After generate the token save in the database according to the customer. </em>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4 bg-dark text-white">
            <h3>Preview</h3>
            <pre class="bg-dark text-white">
            <div id="form_preview"></div>
            </pre>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $('input').keyup(function () {
            $('select').change();
        });
        $('select').change(function () {
            var jsonString = $("form").serializeArray();
            var array = {};
            $.each(jsonString, function (i, row) {
                if (row.name != 'custom_2')
                    array[row.name] = row.value;
            });
            var jsonPretty = JSON.stringify(array, null, 2);
            $("#form_preview").html(jsonPretty);
        })
        $('select').change();
    });

</script>
<?php include 'footer.php' ?>
