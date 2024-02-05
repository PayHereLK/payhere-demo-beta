<?php include '../common/header.php' ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Charging API</h4>
            <p>PayHere Charging API lets you charge your preapproved customers programatically on demand using the
                encrypted tokens you retrieved from
                <a href="./pre-approval-form.php">Preapproval API</a>. If you're new to Charging API, please refer
                <a href="https://support.payhere.lk/api-&-mobile-sdk/payhere-charging">Automated Charging</a>
                introduction first.
            </p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6">
            <form action="<?php echo IPG_BASE_URL . 'preapprove' ?>" method="post" id="submit-form">
                <div class="form-group row">
                    <label for="app_id" class="col-sm-2 col-form-label">Business App ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="app_id" name="app_id" placeholder="">
                        <small><em>You can leave this field.</em></small>
                        <p class="text-danger"></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="app_secret" class="col-sm-2 col-form-label">Business App Secret</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="app_secret" name="app_secret" placeholder="">
                        <small><em>You can leave this field.</em></small>
                        <p class="text-danger"></p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-primary" id="base64_encode">Generate Base 64 Value</button>
                    </div>
                </div>
                <p style="line-break: anywhere;"><strong class="text-info" id="base64_code"></strong></p>
                <p class="alert alert-info">If you created the customer access token with your Merchant id, You need to
                    Provide your Business App ID and Secret for above fields.</p>

                <div class="form-group row">
                    <label for="order_id" class="col-sm-2 col-form-label">Customer Token</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="customer_token" name="customer_token" placeholder="" value="<?php echo isset($_SESSION['customer_token']) ? $_SESSION['customer_token'] : '' ?>" />
                        <small>This is the Token, generated from previous step(<a href="pre-approval-form">Pre Approval
                                From</a>) for as specific customer identification insted of credit card</small>
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
                        <input type="text" class="form-control" id="items" name="items" placeholder="" value="Sample Item" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="items" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="" value="100" />
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
                    <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-primary" id="chargin-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6 bg-dark text-white">
            <h3>Preview</h3>
            <div style="display: none" id="payment_div"><a href="" target="_blank">View Payment Details</a></div>
            <pre class="bg-dark text-white">
            <div id="form_preview"></div>
            </pre>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $("#base64_encode").click(function() {
            var app_id = $("#app_id").val();
            var app_secret = $("#app_secret").val();
            if (app_id != '' && typeof app_id != 'undefined') {
                if (app_secret != '' && typeof app_secret != 'undefined') {
                    var bs64 = btoa(app_id + ':' + app_secret);
                    $("#base64_code").html(bs64);
                } else {
                    $("#app_secret").siblings('p').html('App Secret is required');
                }
            } else {
                $("#app_id").siblings('p').html('App Id is required');
            }
        });

        $('input').keyup(function() {
            $('select').change();
        });
        $('select').change(function() {
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
        $('select').change();

        $("#chargin-submit").click(function() {
            $.ajax({
                url: 'chargin-submit',
                type: 'POST',
                dataType: 'JSON',
                data: $("#submit-form").serialize(),
                success: function(data) {
                    var order_id = data.charging_submit_response.data.order_id;
                    $("#payment_div a").attr({
                        href: '/retreival-api/retrieval-form?id=' + order_id
                    });
                    $("#payment_div").slideDown(500);
                    var jsonPretty = JSON.stringify(data, null, 2);
                    $("#form_preview").html(jsonPretty);
                }
            });
        });

    });
</script>
<?php include '../common/footer.php' ?>