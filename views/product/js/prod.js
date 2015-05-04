var url = '/ecommerce-project/';

function addToBasket($id) {
    var result = postData(url + 'checkout/addToBasket', { prod : $id, qte : $('#quantity').val() });

    if(!result) {
        $('.fa-shopping-cart').text(function(i, oldText) {
            return oldText === '' ? '1' : Number(oldText) + 1;
        });
    }
}

function postData($url, $data) {
    var result;
    $.ajax({
        method: 'POST',
        async: false, //thats the trick
        url: $url,
        data: $data,
        dataType: 'text',
        success: function(response){
           result = response;
        }
    });
    return result;
}