(function() {
    console.log('Payhere button');
    var _payhere_script = document.getElementById("payhere-button");
    var id = _payhere_script.src.split("id=")[1];

    var form = document.createElement('form');
    var button = document.createElement('input');
    var attrs = {
        name: 'submit',
        type: 'image',
        src: 'https://www.payhere.lk/downloads/images/pay_with_payhere.png',
        style: 'width: 200px'
    };

    for (var key in attrs) {
        button.setAttribute(key, attrs[key]);
    }
    button.value = 'Buy Now';
    form.setAttribute('action', 'https://sandbox.payhere.lk/stag_pay/' + id);
    form.setAttribute('method', 'get');

    var target = document.getElementById('payhere-form');
    form.append(button);
    target.append(form);

})(window)