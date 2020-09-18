<?php include 'header.php' ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Preapproval Notification</h4>
            <p>Here is the Preapproval Notification Data</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8 offset-2">
            <?php
            if (isset($_SESSION['customer_token'])) {
                ?>
                <div class="alert alert-info">
                    <h4>Here is the Customer Token generate by Payhere for Automated(Tokenize) Payments </h4>
                    <strong><?php echo $_SESSION['customer_token'] ?></strong><br>
                    <em>Save this Token according to the customer for future use. This token will need for charging API</em>
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
