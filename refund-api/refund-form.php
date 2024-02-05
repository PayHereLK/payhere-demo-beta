<?php include '../common/header.php' ?>
<?php include '../common/_tokenizer.php' ?>

<?php
$time = microtime(true);
$json_string = 'No Data';
$payment_data = [];
$msg = 'No Data';
if (isset($_GET['payment_id'])) {

    $_auth_token_data = getAuthorizationToken();
    if ($_auth_token_data) {
        $auth_token_data = json_decode($_auth_token_data);
        var_dump($auth_token_data);
        if (isset($auth_token_data->access_token) && !empty($auth_token_data->access_token)) {
            $payment_response = refundPayment($auth_token_data->access_token);
            $json_string = json_encode(json_decode($payment_response), JSON_PRETTY_PRINT);
        } else {
            $msg = $auth_token_data->msg;
            $json_string = json_encode(json_decode($_auth_token_data), JSON_PRETTY_PRINT);
        }
    } else {
        $json_string = json_encode(['authorization_response' => 'Auth token retrieval failed.'], JSON_PRETTY_PRINT);
    }
} else {
    $json_string = json_encode(['message' => 'Empty payment ID.'], JSON_PRETTY_PRINT);
}

function refundPayment($token)
{
    $payment_id = $_GET['payment_id'];
    $url = API_BASE_URL . 'payment/refund';

    $headers = array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    );

    $fields = array(
        'payment_id' => $payment_id,
        'description' => 'Sample refund request from PayHere demo site',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, (json_encode($fields)));
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

$app_id = '';
$app_secret = '';


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
            <form action="refund-form" method="get">
                <div class="form-group row">
                    <label for="app_id" class="col-sm-2 col-form-label">Business App ID</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="app_id" value="<?php echo $app_id ?>" name="app_id" placeholder="">
                        <small><em>You can leave this field.</em></small>
                        <p class="text-danger"></p>
                    </div>
                    <div class="col-sm-4">
                        How to get Business App ID -: <a href="https://support.payhere.lk/api-&-mobile-sdk/payhere-retrieval">Retrieval
                            API</a> and Read the First Step
                    </div>
                </div>
                <div class="form-group row">
                    <label for="app_secret" class="col-sm-2 col-form-label">Business App Secret</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="app_secret" value="<?php echo $app_secret ?>" name="app_secret" placeholder="">
                        <small><em>You can leave this field.</em></small>
                        <p class="text-danger"></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="merchant_id" class="col-sm-2 col-form-label text-right">Payment ID <small>(3200xxxxxxxxxxxx)</small></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="payment_id" name="payment_id" placeholder="" required value="<?php echo isset($_GET['id']) ? $_GET['id'] : (isset($_GET['payment_id']) ? $_GET['payment_id'] : '') ?>">
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
            <h3>Preview (JSON)</h3>
            <div class="bg-dark text-white">
                <div style="display: none" id="payment_div"><a href="" target="_blank">View Payment Details</a></div>
                <pre class="bg-dark text-white"><?php echo $json_string ?></pre>
            </div>
        </div>
    </div>
</div>


<?php include '../common/footer.php' ?>