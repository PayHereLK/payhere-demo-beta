<?php include 'header.php' ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Subscription Manager API</h4>
            <p>PayHere Subscription Manager API lets you view, retry & cancel your subscription customers
                programmatically you subscribed from Recurring API.
                If you're new to <a href="https://support.payhere.lk/api-&-mobile-sdk/payhere-recurring">Recurring API</a>, please refer <a href="https://support.payhere.lk/faq/recurring-billing">Recurring Billing</a> introduction first.

        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6">
            <form action="https://sandbox.payhere.lk/pay/preapprove" method="post" id="submit-form">
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
                    <div class="col-sm-6">
                        Base64 preview
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="button" class="btn btn-primary btn-sm" id="base64_encode">Generate Base 64 Value</button>
                    </div>
                </div>
                <p style="line-break: anywhere;"><strong class="text-info" id="base64_code"></strong></p>

                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <a href="subscription-view-html" class="btn btn-outline-success float-left">Subscription List</a>
                        <button type="button" class="btn btn-primary" id="chargin-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6 bg-dark text-white">
            <h3>Preview</h3>
            <pre class="bg-dark text-white">
            <div id="form_preview"></div>
            </pre>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {

        $("#base64_encode").click(function () {
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

        $("#chargin-submit").click(function () {
            $("#chargin-submit").addClass('disabled').attr({disabled:true}).html('Processing');
            $.ajax({
                url:'subscription-submit',
                type:'POST',
                dataType:'JSON',
                data:$("#submit-form").serialize(),
                success:function (data) {
            $("#chargin-submit").removeClass('disabled').attr({disabled:false}).html('Submit');
                    var jsonPretty = JSON.stringify(data, null, 2);
                    $("#form_preview").html(jsonPretty);
                }
            });
        });

    });
</script>
<?php include 'footer.php' ?>
