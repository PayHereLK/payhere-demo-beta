<?php include 'header.php' ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Redirecting Customer to PayHere Payment Gateway</h4>
            <p>Regardless of your scripting language, you can simply use an HTML Form to submit the below POST params
                to PayHere Payment Gateway. When the form is submitted, your customer will be securely redirected to
                the PayHere Payment Gateway & the customer can then enter the credentials (Card No / CVV / eZCash No /
                PIN)
                & securely process the payment there.</p>
            <div class="alert alert-info">
                <p>This is one time request to save the card. When the Recurring period has ended or wants any other
                    recurring payment, customer has to go with this process.</p>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-8">
            <form action="https://sandbox.payhere.lk/pay/checkout" method="post">
                <div class="form-group row">
                    <label for="merchant_id" class="col-sm-2 col-form-label">Merchant ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="merchant_id" name="merchant_id" placeholder="">
                        <small><em>You can leave this field.</em></small>
                    </div>
                </div>
                <input type="hidden" name="return_url"
                       value="http://payhere.bhasha.lk/payhere-demo-beta/recurring-payments/recurring-payment-view">
                <input type="hidden" name="cancel_url"
                       value="http://payhere.bhasha.lk/payhere-demo-beta/recurring-payments/recurring-payment-view">
                <input type="hidden" name="notify_url"
                       value="http://payhere.bhasha.lk/payhere-demo-beta/recurring-payments/recurring-payment-notify">
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
                               value="Sample Subscription Item"/>
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
                        <input type="number" class="form-control" id="amount" name="amount" placeholder=""
                               value="100.00"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="currency" class="col-sm-2 col-form-label">Recurrence</label>
                    <div class="col-sm-10 input-group">
                        <div class="input-group-prepend">
                            <input type="number" class="form-control" id="recurrence_int" name="recurrence_int"
                                   placeholder="" min="1"
                                   value="1"/>
                        </div>
                        <select name="recurrence_time" id="recurrence_time" class="form-control">
                            <option value="Week">Week</option>
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="currency" class="col-sm-2 col-form-label">Duration</label>
                    <div class="col-sm-10 input-group">
                        <div class="input-group-prepend">
                            <input type="number" class="form-control" id="duration_int" name="duration_int"
                                   placeholder="" min="1"
                                   value="1"/>
                        </div>
                        <select name="duration_time" id="duration_time" class="form-control">
                            <option value="Forever">Forever</option>
                            <option value="Week">Week</option>
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="recurrence" id="recurrence" value="">
                <input type="hidden" name="duration" id="duration" value="">

                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
        $('input').change(function () {
            $('select').change();
        });
        $('select').change(function () {
            var jsonString = $("form").serializeArray();
            var array = {};
            $.each(jsonString, function (i, row) {
                if (row.name != 'custom_2' && row.name != 'recurrence_int' && row.name != 'recurrence_time' && row.name != 'duration_int' && row.name != 'duration_time')
                    array[row.name] = row.value;
            });
            array['recurrence'] = $('#recurrence_int').val() + ' ' + $('#recurrence_time').val();
            let dv = $('#duration_time').val();
            array['duration'] = (dv != 'Forever' ? ($('#duration_int').val() + ' ') : '') + $('#duration_time').val();
            $("#recurrence").val(array['recurrence']);
            $("#duration").val(array['duration']);
            var jsonPretty = JSON.stringify(array, null, 2);
            $("#form_preview").html(jsonPretty);
        })
        $('select').change();
    });

</script>
<?php include 'footer.php' ?>
s