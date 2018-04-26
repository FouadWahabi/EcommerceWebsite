var current_page = 1;
var pages = 1;
var url = '/';
var marque_list = Array();
var $price;

function getArticle(product_id, thumb_url, publish_date, marque_name, product_name, product_price, product_solde) {
        return '<div class="article"><div class="article-content-img"><a href="product/prod/' + product_id + '"><div class="clearfix" style="position: relative; left: 0; top: 0;"><img src="' + thumb_url +'" width="520" height="245";position: relative; top: 0; left: 0;"/><div style="position: absolute; bottom: 10px; right: 5px;width: 82px;display:' + (product_solde > 0 ? 'block' : 'none') + '"><img src="' + url + 'img/promo.png"/><span id="promo" style="position:absolute;right:24px;top:31px;color:white;font-weight:600;font-size:18px;">-' + product_solde + '%</span></div></div></a></div><div class="article-content-byline"><span class="date">' + publish_date + ' — By </span><span class="vendor"><a href="#" title="">' + marque_name + '</a></span><span style="float: right;margin-right: 20px;color: orange;font-weight: 600;font-size: 15px;">' + (parseFloat(product_price) - (parseFloat(product_solde) / 100) * parseFloat(product_price)) + ' $</span></div><h2><a href="product/prod/' + product_id + '">' + product_name + '</a></h2></div>';
}

function getMarque($marque_name, $id) {
    return '<div class="ch-input-field" name="marque-' + $id + '"><input type="checkbox" id="marque-' + $id +'" value="'+$marque_name+'"><label for="marque-' + $id + '">' + $marque_name +'</label></div>';
}


function loadPage(page, marque, price) {
    $.post( url + 'product/page/' + page, {marque_list: marque, price: price} , function(o) {
        $('.content').text(function(i, oldText) {
            return '';
        });
        current_page = page;
        pages = parseInt((o.length) / 6) + 1;
        for(var i = 0 ; i < o.length ; i++) {
           $('.content').append(getArticle(o[i].product_id, o[i].product_thumb, o[i].product_update_date, o[i].marque_name, o[i].product_short_desc, o[i].product_price, o[i].product_solde));
        }
        $('#page').text(current_page);
        setNavBtn();
    }, 'json');
}

function loadMarques() {
    $.get( url + 'product/marque', function(o) {
        for(var i = 0 ; i < o.length ; i++) {
           $('#marque-list').append(getMarque(o[i]['marque_name'], i));
            $('#marque-' + i).change(function() {
                if(this.checked) {
                    marque_list.push('"' + this.value + '"');
                    loadPage(current_page, marque_list);
                } else {
                    marque_list.splice(marque_list.indexOf('"' + this.value + '"'), 1);
                    loadPage(current_page, marque_list);
                }
            });
        }

    }, 'json');
}

function setNavBtn() {
    if(current_page >= pages)
        $('#next').css('display', 'none');
    else
        $('#next').css('display', 'inline');
    if(current_page === 1)
        $('#previous').css('display', 'none');
    else
        $('#previous').css('display', 'inline');
}

// worker thread
$(function() {
    loadPage(1);
    loadMarques();

    // navigation
    setNavBtn();

    $('#next').on('click', function() {
        $('.content').text(function(i, oldText) {
            return oldText === '' ? '' : '';
        });
        loadPage(current_page + 1, marque_list,$price);
    });

    $('#previous').on('click', function() {
        $('.content').text(function(i, oldText) {
            return oldText === '' ? '' : '';
        });
        loadPage(current_page - 1, marque_list, $price);
    });

    // get  ajax data synchronisly
    function getData(url) {
        var data;
            $.ajax({
                async: false, //thats the trick
                url: url,
                dataType: 'text',
                success: function(response){
                   data = response;
                }
            });
            return data;
    }


    // price range
    var param = {
          range: true,
          min: 0,
        };
    param.max = getData('product/maxPrice');
    param.values = [ 0, param.max ];
    param.slide = function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            if(ui.values[ 0 ] != param.min || ui.values[ 1 ] != param.max) {
                $price = {min: '"' + ui.values[ 0 ] + '"', max: '"' + ui.values[ 1 ] + '"'};
                loadPage(current_page, marque_list, $price);
            }
          }

    $( "#slider-range" ).slider(param);
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
          " - $" + $( "#slider-range" ).slider( "values", 1 ) );


});
