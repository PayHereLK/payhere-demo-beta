<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'constants.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/heroic-features.css">
    <link rel="stylesheet" href="../vendor/main.css">

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <title>Payhere Playground</title>
    <style>
        table>tbody {
            font-size: 12px;
        }

        table>thead {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="./">
                <?php
                $url = $_SERVER['REQUEST_URI'];
                if (strpos($url, 'hold-on-card-api')) {
                    echo "Authorize API";
                }
                if (strpos($url, 'checkout-api')) {
                    echo "Checkout API";
                }
                if (strpos($url, 'automated-payment')) {
                    echo "Preapproval API / Charging API";
                }
                if (strpos($url, 'retreival-api')) {
                    echo "Payhere Retrieval API";
                }
                if (strpos($url, 'recurring-payments')) {
                    echo "Payhere Recurring API";
                }
                if (strpos($url, 'refund-api')) {
                    echo "Payhere Refund API";
                }

                ?>

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            APIs
                        </a>
                        <div class="dropdown-menu dropdown dropleft" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../checkout-api">Checkout API Guide</a>
                            <a class="dropdown-item" href="../automated-payment">Automated Payment Guide</a>
                            <a class="dropdown-item" href="../recurring-payments">Recurring Payment Guide</a>
                            <a class="dropdown-item" href="../retreival-api">Payment Retrieval Guide</a>
                            <a class="dropdown-item" href="../hold-on-card-api">Hold on Card Guide</a>
                            <a class="dropdown-item" href="../refund-api">Refund Guide</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Credentials
                        </a>
                        <ul id="login-dp" class="dropdown-menu right">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>