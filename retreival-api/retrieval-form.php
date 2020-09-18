<?php include 'header.php' ?>
<?php include '_tokenizer.php' ?>

<?php
$time = microtime(true);
$json_string = 'No Data';
$payment_data = [];
$msg = 'No Data';
if (isset($_GET['order_id'])) {

    $_auth_token_data = getAuthorizationToken();
    $auth_token_data = json_decode($_auth_token_data);
    if (isset($auth_token_data->access_token) && !empty($auth_token_data->access_token)) {
        $payment_response = getPayment($auth_token_data->access_token);
        $json_string = json_encode(json_decode($payment_response), JSON_PRETTY_PRINT);
        $_payment_data = json_decode($payment_response, TRUE);
        if ($_payment_data) {
            if ($_payment_data['status'] == 1)
                $payment_data = $_payment_data['data'];
            else
                $msg = $_payment_data['msg'];
        }
    } else {
        $msg = $auth_token_data->msg;
        $json_string = json_encode(json_decode($_auth_token_data), JSON_PRETTY_PRINT);
    }

}

function getPayment($token)
{
    $payment_id = $_GET['order_id'];
    $url = 'https://sandbox.payhere.lk/merchant/v1/payment/search?order_id=' . $payment_id;

    $headers = array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $head = curl_exec($ch);
    curl_close($ch);

    if (!$head) {
        return FALSE;
    } else {
        return $head;
    }
    return FALSE;
}

?>

    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <h4>Recurring Payment Details</h4>
                <h4>You can find the Payment details for an Order. </h4>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <form action="retrieval-form" method="get">
                    <div class="form-group row">
                        <label for="app_id" class="col-sm-2 col-form-label">Business App ID</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="app_id" name="app_id" placeholder="">
                            <small><em>You can leave this field.</em></small>
                            <p class="text-danger"></p>
                        </div>
                        <div class="col-sm-4">
                            How to get Business App ID -: <a
                                    href="https://support.payhere.lk/api-&-mobile-sdk/payhere-retrieval">Retrieval
                                API</a> and Read the First Step
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="app_secret" class="col-sm-2 col-form-label">Business App Secret</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="app_secret" name="app_secret" placeholder="">
                            <small><em>You can leave this field.</em></small>
                            <p class="text-danger"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merchant_id" class="col-sm-2 col-form-label text-right">Order ID</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="order_id" name="order_id" placeholder=""
                                   required
                                   value="<?php echo isset($_GET['id']) ? $_GET['id'] : (isset($_GET['order_id']) ? $_GET['order_id'] : '') ?>">
                            <small><em>The order_id you passed to the Checkout API when processing the
                                    payment.</em></small>
                        </div>
                        <div class="col-sm-4">
                            In this case All the Parameters Sends through GET Request. In Production Application
                            <strong>DO NOT </strong> Send Sensitive Details through POST Request.
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-lg-6 text-right">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-html-tab" data-toggle="tab" href="#nav-html"
                           role="tab" aria-controls="nav-home" aria-selected="true">HTML</a>
                        <a class="nav-item nav-link" id="nav-json-tab" data-toggle="tab" href="#nav-json" role="tab"
                           aria-controls="nav-profile" aria-selected="false">JSON</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-html" role="tabpanel"
                         aria-labelledby="nav-html-tab">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="modal_tbody">
                            <?php
                            if (!isset($_GET['order_id']) || empty($payment_data)) {
                                ?>
                                <tr>
                                    <td colspan="8"><p class="text-center"><em><?php echo $msg ?></em></p></td>
                                </tr>
                                <?php
                            } else {
                                foreach ($payment_data as $payment) {
                                    ?>
                                    <tr>
                                        <td><?php echo $payment['payment_id'] ?></td>
                                        <td><?php echo $payment['date'] ?></td>
                                        <td><?php echo $payment['description'] ?></td>
                                        <td><?php echo $payment['customer']['fist_name'] . ' ' . $payment['customer']['last_name'] ?></td>
                                        <td><?php echo $payment['currency'] . ' ' . $payment['amount'] ?></td>
                                        <td><?php echo $payment['status'] ?></td>
                                    </tr>
                                    <?php
                                }

                            }
                            ?>
                            </tbody>
                        </table>
                        <div class="alert alert-info">
                            <h4>Status Messages</h4>
                            <div style="font-size: 13px;">
                                <p><strong>RECEIVED</strong> - Payment successfully received</p>
                                <p><strong>REFUND REQUESTED</strong> - A refund request was received for the payment and
                                    waiting for the
                                    amount to be transferred from the merchant account</p>
                                <p><strong>REFUND PROCESSING</strong> - Refund amount successfully transferred from the
                                    merchant and waiting
                                    for PayHere to process the refund</p>
                                <p><strong>REFUNDED</strong> - Refund completed</p>
                                <p><strong>CHARGEBACKED</strong> - Payment chargebacked</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-json" role="tabpanel" aria-labelledby="nav-json-tab">
                        <pre class="bg-dark text-white p-3"><?php echo $json_string ?></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include 'footer.php' ?>