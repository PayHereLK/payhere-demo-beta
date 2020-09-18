<?php include 'header.php' ?>
<style>
    table > tbody {
        font-size: 12px;
    }

    table > thead {
        font-size: 13px;
    }
</style>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Subscription List</h4>
            <p>Here is a sample list of subscriptions retrieve through Subscription API in html format</p>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p class="count"></p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Subscription ID</th>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Recurring</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="8"><p class="text-center"><em>Loading...</em></p></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="details-model">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subscription Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center" id="loader"><em>Loading...</em></div>
                <div id="content" style="display: none">
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
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody id="modal_tbody">
                                <tr>
                                    <td colspan="8"><p class="text-center"><em>Loading...</em></p></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-json" role="tabpanel" aria-labelledby="nav-json-tab">
                            <pre class="bg-dark text-white"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        getData();
    });

    function getData() {
        $.ajax({
            url: 'subscription-submit?app_id=<?php echo $_GET['app_id'] ?>&app_secret=<?php echo $_GET['app_secret']?>',
            type: 'POST',
            dataType: 'JSON',
            data: $("#submit-form").serialize(),
            success: function (data) {
                $('tbody').html('');
                $("#chargin-submit").removeClass('disabled').attr({disabled: false}).html('Submit');
                if (data.all_subscription_response.data) {
                    $(".count").html(data.all_subscription_response.msg);
                    if (data.all_subscription_response.data.length > 0) {
                        $.each(data.all_subscription_response.data, function (i, row) {
                            var subcription = row;
                            var tr = document.createElement('tr');
                            var td1 = document.createElement('td');
                            var td2 = document.createElement('td');
                            var td3 = document.createElement('td');
                            var td4 = document.createElement('td');
                            var td5 = document.createElement('td');
                            var td6 = document.createElement('td');
                            var td7 = document.createElement('td');
                            var td8 = document.createElement('td');

                            var span = document.createElement('span');
                            $(span).html(subcription.status).addClass(subcription.status == 'ACTIVE' ? 'badge badge-success' : 'badge badge-danger');

                            $(td1).html(subcription.subscription_id).append('<br/>', span);
                            $(td2).html(subcription.order_id);
                            $(td3).html(subcription.date);
                            $(td4).html(subcription.description);
                            $(td5).html(subcription.recurring);
                            $(td6).html(subcription.customer.fist_name + " " + subcription.customer.last_name);
                            $(td7).html(subcription.currency + ' ' + subcription.amount);
                            var action = document.createElement('a');
                            $(action).attr({
                                'href': '/payhere-demo-beta/retreival-api/retrieval-form?id=' + subcription.order_id,
                                target: '_BLANK'
                            }).addClass('btn btn-sm btn-primary').html('Details')
                            // .click(function (event) {
                            //         event.preventDefault();
                            //         getSubscription(subcription.subscription_id);
                            //     });

                            $(td8).html(action);

                            $(tr).append(td1, td2, td3, td4, td5, td6, td7, td8);
                            $('tbody').append(tr);
                        });
                    }
                }
            }
        });
    }

    function getSubscription(id) {
        $("#modal_tbody").html('');
        $("#loader").show();
        $("#content").hide();
        $('#details-model').modal({show: true});
        $.ajax({
            url: 'subscription-single-get',
            type: 'POST',
            dataType: 'JSON',
            data: {'subscription_id': id},
            success: function (data) {
                $("#loader").slideUp(500, function () {
                    $("#content").slideDown(500);
                });
                $('#details-model').find('h5.modal-title').html('Subscription Details : ' + id);

                if (data.subscription_payment_response.status == 1) {
                    for (let i = 0; i < data.subscription_payment_response.data.length; i++) {

                        var tr = document.createElement('tr');
                        var td1 = document.createElement('td');
                        var td2 = document.createElement('td');
                        var td3 = document.createElement('td');
                        var td4 = document.createElement('td');
                        var td5 = document.createElement('td');
                        var td6 = document.createElement('td');

                        var payment_data = data.subscription_payment_response.data[i];

                        var span = document.createElement('span');
                        $(span).html(payment_data.status).addClass(payment_data.status == 'RECEIVED' ? 'badge badge-success' : 'badge badge-danger');

                        var action = document.createElement('a');
                        $(action).html(payment_data.payment_id).attr({href: 'http://localhost/retreival-api/retrieval-form?payment_id=' + payment_data.payment_id});
                        $(td1).html(action).append('<br/>', span);
                        $(td2).html(payment_data.order_id);
                        $(td3).html(payment_data.date);
                        $(td4).html(payment_data.description);
                        $(td5).html(payment_data.currency + " " + payment_data.amount);
                        $(td6).html(payment_data.customer.fist_name + " " + payment_data.customer.last_name);

                        $(tr).append(td1, td2, td3, td4, td5, td6);
                        $("#modal_tbody").append(tr);
                    }
                }


                $('#details-model').find('pre').html(JSON.stringify(data, null, 2));

            }
        });
    }
</script>
<?php include 'footer.php' ?>
