<?php include 'header.php' ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Checkout Notification</h4>
            <p>Here is the Checkout Notification Data</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8 offset-2">
            <?php
            if (isset($_SESSION['customer_token'])) {
                ?>
                <div class="alert alert-info">
                    <h4>Here is the Checkout Response Sends to the notify_url generate by Payhere after the successfull Payments </h4>
                </div>
                <?php
            }
            ?>
            <div class="">
                <h3>POST Data</h3>
                <br/>
                <pre class="bg-dark text-white p-3">
<?php
$_data = isset($_SESSION['post_values'])?$_SESSION['post_values']:[];
$json_string = json_encode(unserialize($_data), JSON_PRETTY_PRINT);
if ($_data) {
    echo $json_string;
} else {
    echo 'No Data';
}
?>
                </pre>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php' ?>
