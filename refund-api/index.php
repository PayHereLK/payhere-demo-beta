<?php include '../common/header.php' ?>

<div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h2 class="display-3">Refund API</h2>
        <p class="lead">PayHere Refund API lets you refund your existing payment programmatically.</p>
        <a href="https://support.payhere.lk/api-&-mobile-sdk/refund-api" class="btn btn-primary btn-lg">Refund API</a>
    </header>


    <div class="row text-center">

        <div class="col-lg-12 col-md-12 mb-12">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">Retrieval API</h4>
                    <p class="card-text">Unlike other PayHere APIs, Refund API is a RESTful API where you can directly send a HTTP Request with POST JSON body to an API end point & process a payment. You will get the refund status from HTTP Response for the above request. This API is secured with OAuth authentication & therefore you need first generate a pair of App ID & App Secret from your PayHere account, derive an Authorization code from them & finally retrieve an Access Token from the Authorization code in order to consume the Refund API.</p>
                </div>
                <div class="card-footer">
                    <a href="refund-form" class="btn btn-primary">Visit</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../common/footer.php' ?>