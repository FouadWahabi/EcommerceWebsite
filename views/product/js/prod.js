var url = '/ecommerce-project/';

function addToBasket($id) {
    var result = postData(url + 'checkout/addToBasket', { prod : $id, qte : $('#quantity').val() });

    if(!result) {
        $('.fa-shopping-cart').text(function(i, oldText) {
            return oldText === '' ? '1' : Number(oldText) + 1;
        });
    }
}

function getComment(comment_id, comment_title, comment_date, comment_user, comment_vote, comment_content) {
    return '<div><hr style="border-top: 1px dotted #c8cbcc;"><div class="comment" style="margin-bottom:80px"><div class="comment-info clearfix"><span class="comment-title">' + comment_title + '</span><div class="comment-ud"><span class="comment-date">' + comment_date + '</span><span class="comment-user">' + comment_user + '</span></div><div class="comment-rating"><div id="jRate' + comment_id + '"></div></div></div><div class="comment-content clearfix"><div class="com-content clearfix"><span>' + comment_content + '</span></div></div></div></div>';
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


$(function() {
    $("#jRate").jRate({
      min: 0,
      max: 5,
      onChange: function(rating) {
        $('#jRate').attr('value', rating);
      }
    });
    
    $('#product_rating').jRate( {
        rating: $('#product_rating').attr('value'), 
        readOnly: true
    });
    
    $.get(url + 'product/loadComments/' + window.location.href.split('/')[6] , function(o) {
        for(var i = 0 ; i < o.length ; i++) {
            $('.comments').append(getComment(o[i].comment_id, o[i].comment_title, o[i].comment_date, o[i].user_fname, o[i].comment_vote, o[i].comment_content));
            $("#jRate" + o[i].comment_id).jRate({
              rating: o[i].comment_rating, 
              readOnly: true
            });
        }
    }, 'json');
    
    $('#add_comment').on('click', function() {
        if($('#comment_title').val().length > 0 && $('#comment_content').val().length > 0) {
            $.post(url + 'product/addComment/' + window.location.href.split('/')[6], {comment_title: $('#comment_title').val(), comment_content: $('#comment_content').val(), comment_rating : $('#jRate').attr('value')} , function() {
            },'json').always(function() {
                window.location.reload();
            });
        }
    });
    
});