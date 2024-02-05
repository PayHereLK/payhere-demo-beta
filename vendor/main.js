function generateHash(formID, element) {
    const form = document.querySelector(formID);
    let form_data = Object.values(form).reduce((obj, field) => { obj[field.name] = field.value; return obj }, {});
    let pre_hash = form_data.merchant_id + form_data.order_id + form_data.amount + form_data.currency + MD5(form_data.merchant_secret).toUpperCase();
    let hash = MD5(pre_hash).toUpperCase();
    if (element){
        document.querySelector(element).value = hash;
    }
    return hash;
}

function formatNumber(amount) {
    return parseFloat(amount).toLocaleString('en-us', { minimumFractionDigits: 2 }).replaceAll(',', '');
}


function syntaxHighlight(json) {
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                console.log(match);
                if (/item_name_\d{1,2}/.test(match) || /amount_\d{1,2}/.test(match) || /quantity_\d{1,2}/.test(match)) {
                    cls = 'key itemname';
                } else {
                    cls = 'key';
                }
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}