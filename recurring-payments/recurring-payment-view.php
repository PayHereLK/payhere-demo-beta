<?php include 'header.php' ?>
<style>
    div.sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 30px;
        padding: 50px;
    }
</style>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Recurring Payment Notification</h4>
            <p>Here is the Payment Notification Data</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-7">
            <div class="alert alert-info">
                <h4>You can find the recurring payment response bellow. </h4>
                <p>There will 2 responses bellow ,because sandbox will not process recurring payments as after in 1 Week
                    or
                    1 Month.
                    So the sandbox will run the next recurring payment after minute of the initial request. </p>
                <p>
                    <?php
                    if (isset($_SESSION['post_values'])) {
                        $_post_value = $_SESSION['post_values'][0];
                        $post_value = unserialize($_post_value);
                        $order_id = $post_value['order_id'];
                    }
                    ?>
                    <a href="/retreival-api/retrieval-form?id=<?php echo $order_id?>">View Payment Details</a>
                </p>
            </div>
            <div class="">
                <h3>POST Data</h3>
                <br/>
                <?php
                if (isset($_SESSION['post_values'])) {
                    foreach ($_SESSION['post_values'] as $value) {
                        $json_string = json_encode(unserialize($value['data']), JSON_PRETTY_PRINT);
                        ?>
                        <h4> <?php echo date("F j, Y, g:i a", $value['time']) ?></h4>
                        <pre class="bg-dark text-white p-3"><?php echo $json_string; ?></pre>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="sticky">
                <h4>Response Messages</h4>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success">
                        <strong>AUTHORIZATION_SUCCESS</strong><br/>
                        <small>Initial Payment Success.
                            Payhere can run recurring Payments.</small>
                    </li>
                    <li class="list-group-item list-group-item-danger">
                        <strong>AUTHORIZATION_FAILED</strong><br/>
                        <small>Initial Payment Failed.
                            Payhere can't run recurring Payments.</small>
                    </li>
                    <li class="list-group-item list-group-item-success">
                        <strong>RECURRING_INSTALLMENT_SUCCESS</strong><br/>
                        <small>Recurring Payment Done.
                            This message will Receive everytime a recurring payment charged.</small>
                    </li>
                    <li class="list-group-item list-group-item-danger">
                        <strong>RECURRING_INSTALLMENT_FAILED</strong><br/>
                        <small>Recurring Payment Failed.
                            This message will Receive when a recurring payment failed. After Failed payment Payhere
                            gives a
                            7 day grace period.
                            In that 7 day period payhere will try to charge the payment one time per day and if success
                            sends the
                            "RECURRING_INSTALLMENT_SUCCESS" response.</small>
                    </li>
                    <li class="list-group-item list-group-item-danger">
                        <strong>RECURRING_STOPPED</strong><br/>
                        <small>Recurring Payment Fails.
                            After Failed payment Payhere gives a 7 day grace period.
                            In that 7 day period payhere will try to charge the payment and if payhere couldn't charge
                            this
                            message receive in the response
                            and payhere will stops the recurring process.</small>
                    </li>
                    <li class="list-group-item list-group-item-success">
                        <strong>RECURRING_COMPLETE</strong><br/>
                        <small>All the Payments are Done.
                            All the recurring payments are done in the given duration.</small>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

<script>
    setTimeout(() => {
        window.location.reload();
    }, 65000)
</script>

<?php include 'footer.php' ?>
