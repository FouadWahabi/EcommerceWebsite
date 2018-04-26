var url = '/';
function getWarning(product_id, thumb_url, product_name, product_price, product_stock, publish_date) {
    return '<div class="clearfix"><div id="panier_art"><div id="product_img" style="float: left !important;"><img src="' + thumb_url +'" width="120px"></div><div id="product_desc" class="product" style="float: left !important;width: 35%;"><h2><a href="' + url + 'product/prod/' + product_id + '">' + product_name + '</a></h2><div class="product-content-byline"><span class="date">' + publish_date + ' — By </span><span class="vendor"><a href="#">GUCCI</a></span></div></div><div id="product_price" style="float: left !important;text-align:right;font-size: 16px;padding: 13px 15px 0;"><span style="float: right;margin-right: 20px;color: orange;font-weight: 600;font-size: 15px;">' + parseFloat(product_price) + ' DT</span></div><div id="product_qte" style="float: left !important;text-align:right;font-size: 16px;padding: 13px 15px 0;"><span>' + product_stock + '</span></div><input type="text" id="stock_to_add-' + product_id +'" style="float: left !important;text-align:center;width: 20px;font-size: 16px;padding: 13px 15px 0;"><div id="prod_tot_price" style="float: left !important;text-align:right;width: 45px;font-size: 16px;padding: 13px 15px 0;"><a id="add-' + product_id + '" href="#" style="color:#4e5860"><i class="fa fa-check"></a></i></div></div></div><hr style="border-top: 1px dotted #c8cbcc;margin-top:20px">';
}

function getMarque($marque) {
    return '<option>' + $marque + '</option>';
}

var error = false;
$(function() {
    var sign_in = $("#sign-btn");

    $('#disconnect-btn').on('click', function() {
        $.get(url + 'admin/disconnect', function() {
            window.location.reload();
        });
    });

    $('#add-btn').on('click', function() {

        if($('#marque-select').val().length == 0) {
            $('#marque_name').attr('value', $('#marque-add').val());
        } else {
            $('#marque_name').attr('value', $('#marque-select').val());
        }
        $('#add-form').submit();
    });

    // listen for input focusing
    $(document).on('focus', 'input', function () {
      $(this).siblings('label, i').addClass('active');
    });

    // listen for input bluring to enable validation
    $(document).on('blur', 'input', function () {
      if ($(this).val().length === 0) {
        $(this).siblings('label, i').removeClass('active');
        $(this).removeClass('valid');
        $(this).removeClass('invalid');
      }
    });

    // validate signing forms
    $('#email-sign, #password-sign').keyup(validate_sign);

    function validate_sign() {
        if($('#email-sign').val().length > 0 &&
          $('#password-sign').val().length > 0) {
            $("#submit-sign").prop("disabled", false);
        } else {
            $("#submit-sign").prop("disabled", true);
        }
    }

    // sign in
    sign_in.on('click', function(object) {
        if(!$('#submit-sign').is(':disabled')) {
            $("#sign-form").submit();
        }
    });

    // get total vente
    $.get(url + 'admin/getTotalSales', function(o) {
        $('#sales').text(function() {
            return parseFloat(o[0].total).toFixed(2);
        })
    }, 'json');


    // get warnings
    getData(url + 'admin/getWarnings', function(o) {
        if(o.length > 0) {
            $('#warning-empty').css('display', 'none');
        } else {
            $('#warning-empty').css('display', 'block');
        }

        for(var i = 0 ; i < o.length ; i++) {
            $('.warnings').append(getWarning(o[i].product_id, o[i].product_thumb, o[i].product_short_desc, o[i].product_price, o[i].product_stock, o[i].product_update_date));
            var id = o[i].product_id;
            $('#add-' + id).on('click', function() {
                if($('#stock_to_add-' + id).val().length > 0) {
                    $.post(url + 'admin/addToStock/' + id, {stock: parseInt($('#stock_to_add-' + id).val())} , function() {
                        window.location.reload();
                    }, 'json');
                }
            });
        }
    });


    // get marque list
    $.get(url + 'product/marque', function(o) {

        for(var i = 0 ; i< o.length ; i++) {
            $('#marque-select').append(getMarque(o[i].marque_name));
        }
    }, 'json');


/*    // get commands
    getData(url + 'admin/getCommands', function(o) {
        if(o.length > 0) {
            $('#commands-empty').css('display', 'none');
        } else {
            $('#commands-empty').css('display', 'block');
        }

        for(var i = 0 ; i < o.length ; i++) {
            $('.commands').append(getCommand(o[i].product_id, o[i].product_thumb, o[i].product_short_desc, o[i].product_price, o[i].product_stock, o[i].product_update_date));
            var id = o[i].product_id;
            $('#val-' + id).on('click', function() {
                $.post(url + 'admin/validateCommand/' + id, function() {
                    window.location.reload();
                }, 'json');
            });
        }
    }); */


});

// Load the Visualization API and the piechart package.
              google.load('visualization', '1.0', {'packages':['corechart']});

              google.setOnLoadCallback(drawCharts);

              function drawCharts() {

                var data1 = new google.visualization.DataTable();
                data1.addColumn('string', 'Marque');
                data1.addColumn('number', 'Sales');

                  $.get(url + 'admin/getSalesByMarque', function(o) {
                      for(var i = 0 ; i < o.length ; i++) {
                          data1.addRows([[o[i].marque_name, parseInt(o[i].sum)]]);
                      }

                    var options1 = {'title':'Pourcentage des ventes par marque',
                                   'width':330,
                                   'height':300};

                    var chart = new google.visualization.PieChart(document.getElementById('marque_stats'));
                    chart.draw(data1, options1);
                  }, 'json');

                var data2 = new google.visualization.DataTable();
                data2.addColumn('string', 'Month');
                data2.addColumn('number', 'Gain');

                  $.get(url + 'admin/getGainStats', function(o) {
                      for(var i = 0 ; i < o.length ; i++) {
                          data2.addRows([[o[i].month, parseFloat(parseFloat(o[i].price).toFixed(2))]]);
                      }

                      var options2 = {'title':'Taux des gains par mois',
                                   'width':330,
                                   'height':300};

                    var chart2 = new google.visualization.BarChart(document.getElementById('gain_stats'));
                    chart2.draw(data2, options2);
                  }, 'json');
              }


// get  ajax data synchronisly
    function getData(url, fn) {
        var data;
            $.ajax({
                async: false, //thats the trick
                url: url,
                dataType: 'json',
                success: fn
            });
            return data;
}
