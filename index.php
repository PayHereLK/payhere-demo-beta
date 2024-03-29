<html>
<head>
    <title>PayHere Demo Site</title>
    <meta charset="utf-8">
    <link rel="icon" href="./images/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Inline CSS -->
    <style>
        .container>.jumbotron {
            background-color: transparent;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">PayHere Demo Site</h1>
            <p class="lead">This is a website for testing PayHere API Implementations.</p>


            <hr class="my-4">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Checkout API Guide</h5>
                            <p class="card-text">Here you can find how to Checkout API(One time Payment)</p>
                            <a href="./checkout-api" class="card-link">Try this &rightarrow;</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Automated Payment Guide</h5>
                            <p class="card-text">Here you can find how to do a automated payments with tokenizer</p>
                            <a href="./automated-payment" class="card-link">Try this &rightarrow;</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recurring Payment Guide</h5>
                            <p class="card-text">Here you can find how to do Recurring Payments(Subscriptions)</p>
                            <a href="./recurring-payments" class="card-link">Try this &rightarrow;</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Payment Retrieval Guide</h5>
                            <p class="card-text">Here you can find how to Retrieve Payment details of successful payments</p>
                            <a href="./retreival-api" class="card-link">Try this &rightarrow;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</footer>

</html>