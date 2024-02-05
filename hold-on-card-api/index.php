<?php include '../common/header.php' ?>

<div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h2 class="display-3">Authorize API</h2>
        <p class="lead">PayHere Authorize API allows you to get your customer authorization for Hold on Card payments.
            It's a simple HTML form based POST API to redirect your customer to PayHere Payment Gateway to securely authorize Hold on Card payments.</p>
        <a href="https://support.payhere.lk/api-&-mobile-sdk/authorize-api" class="btn btn-primary btn-lg">Subscription Manager API</a>
    </header>


    <div class="row text-center">

        <div class="col-lg-12 col-md-12 mb-12">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">Retrieval API</h4>
                    <p class="card-text">Once the payment is authorized, it notifies your given URL (notify_url) about the authorization status &
                        an authorization token for the particular payment by a server callback.
                        You can fetch that authorization token from the notification & store it in your database securely to programmatically
                        capture the authorized or lesser amount later via PayHere Capture API.</p>
                </div>
                <div class="card-footer">
                    <a href="hold-on-card-form" class="btn btn-primary">Visit</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../common/footer.php' ?>