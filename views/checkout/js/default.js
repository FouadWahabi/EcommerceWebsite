var url = '/ecommerce-project/';

function getPanierArt(product_id, thumb_url, publish_date, marque_name, product_name, product_price, product_solde, product_qte) {
    return '<div class="clearfix"><hr style="border-top: 1px dotted #c8cbcc;margin-bottom:20px"><div id="panier_art"><div id="product_img" style="float: left !important;"><img src="' + thumb_url +'" width="120px"></div><div id="product_desc" class="product" style="float: left !important;width: 35%;"><h2><a href="' + url + 'product/prod/' + product_id + '">' + product_name + '</a></h2><div class="product-content-byline"><span class="date">' + publish_date + ' — By </span><span class="vendor"><a href="#">GUCCI</a></span></div></div><div id="product_price" style="float: left !important;text-align:right;font-size: 16px;padding: 13px 15px 0;"><span style="float: right;margin-right: 20px;color: orange;font-weight: 600;font-size: 15px;">' + (parseFloat(product_price) - (parseFloat(product_solde) / 100) * parseFloat(product_price)) + ' DT</span></div><div id="product_qte" style="float: left !important;text-align:right;font-size: 16px;padding: 13px 15px 0;"><span>' + product_qte + '</span></div><div id="prod_tot_price" style="float: left !important;text-align:right;font-size: 16px;padding: 13px 15px 0;"><span style="float: right;margin-right: 20px;color: orange;font-weight: 600;font-size: 15px;">' + (parseFloat(product_price) - (parseFloat(product_solde) / 100) * parseFloat(product_price)) * product_qte + ' DT</span></div><div id="prod_tot_price" style="float: left !important;text-align:right;width: 45px;font-size: 16px;padding: 13px 15px 0;"><a id="delete-' + product_id + '" href="#" style="color:#4e5860"><i class="fa fa-times"></a></i></div></div></div>';   
}

function removeFromPanier(product_id) {
    $.post(url + 'checkout/removeFromBascket/' + product_id, function() {
        loadPanier();
        $('.fa-shopping-cart').text(function(i, oldText) {
            return oldText === '1' ? '' : Number(oldText) - 1;
        });
    });   
}

function loadPanier() {
    $('.panier_content').text(function() {return '';});
    var total_price = 0;
    $.get(url + 'checkout/getBasketProds', function(o1) {
        var total = 0;
        for(var i = 0; i < o1.length ; i ++) {
            var o = getData(url + 'product/loadProduct/' + o1[i].prod);
            $('.panier_content').append(getPanierArt(o[0]['product_id'], o[0]['product_thumb'], o[0]['product_update_date'], o[0]['marque_name'], o[0]['product_short_desc'], o[0]['product_price'], o[0]['product_solde'], o1[i].qte));
            total_price += (parseFloat(o[0]['product_price']) - (parseFloat(o[0]['product_solde']) / 100) * parseFloat(o[0]['product_price'])) * o1[i].qte;
                $('#delete-' + o[0]['product_id']).on('click', function(event){
                    removeFromPanier(o[0]['product_id']);
                });
            total += (parseFloat(o[0]['product_price']) - (parseFloat(o[0]['product_solde']) / 100) * parseFloat(o[0]['product_price'])) * parseFloat(o1[i].qte);
        }

        if(o1 != 'null') {
            if(o1.length > 0) {
                $('#empty').css('display', 'none');
                $('#paiement_inf').css('display', 'block');
                
                $('#tot-price').text(function() {return total_price + ' DT';});
                
                $.get(url + 'register/getSession', function(o) {
                    $.get(url + 'register/getUserPf/' + o, function(o1) {
                        $('#red-price').text(function() {return (o1 * 0.001).toFixed(2)});
                        $('#fin-price').text(function() {return ( total_price - o1 * 0.001).toFixed(2)});
                        total_price = total_price - o1 * 0.001;
                    });
                });
                
                
                $('#checkout-btn').text(function() {return 'Checkout'});
                var user = false;
                user = getData(url + 'register/getSession');
                if(!user) {
                    $('#checkout-form').attr('action', url + 'register');
                } else {
                    $('#total_price').val(total);
                    $('#checkout-form').attr('action', url + 'checkout/checkout');
                }
            } else {

                $('#empty').css('display', 'block');
                $('#paiement_inf').css('display', 'none');
                
                $('#checkout-btn').text(function() {return 'Go buy'});
                $('#checkout-form').attr('action', url + 'product');
            }
        }
        $('#checkout-btn').on('click', function(event) {
            $.post(url + 'checkout/passCommand', {total_price: total_price} , function(o) {

                if(o === 'error') {
                    alert('Stock insuffisant');
                } else {
                    location.href = url + 'product';
                }
            }, 'text');
        });
    }, 'json');
}


$(function() {
    loadPanier();
});


// get  ajax data synchronisly
    function getData(url) {
        var data;
            $.ajax({
                async: false, //thats the trick
                url: url,
                dataType: 'json',
                success: function(response){
                   data = response;
                }
            });
            return data;
    }
