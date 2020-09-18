<?php include 'header.php' ?>

<div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h2 class="display-3">Welcome to Payhere Automated Payments Guide</h2>
        <p class="lead">From here developer can test Automated payments.First of all please visit our knowledge base.</p>
        <a href="https://support.payhere.lk/api-&-mobile-sdk/payhere-preapproval" class="btn btn-primary btn-lg">Preapproval API</a>
        <a href="https://support.payhere.lk/api-&-mobile-sdk/payhere-charging" class="btn btn-primary btn-lg">Charging API</a>
    </header>


    <div class="row text-center">

        <div class="col-lg-6 col-md-6 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">Pre Approval From</h4>
                    <p class="card-text">PayHere Preapproval API allows you to get your customers preapproved for Automated Payments. It's a simple HTML form based POST API to redirect your customer to PayHere Payment Gateway to securely pre approve the future payments. </p>
                </div>
                <div class="card-footer">
                    <a href="pre-approval-form" class="btn btn-primary">Visit</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">Charging From</h4>
                    <p class="card-text">PayHere Charging API lets you charge your preapproved customers programatically on demand using the encrypted tokens you retrieved from Preapproval API. If you're new to Charging API, please refer <a href="https://support.payhere.lk/faq/automated-charging">Automated Charging</a> introduction first.</p>
                </div>
                <div class="card-footer">
                    <a href="chaging-form" class="btn btn-primary">Visit</a>
                </div>
            </div>
        </div>

    </div>


</div>

<?php include 'footer.php' ?>
