$(function() {
    var content = $('.content');
    function getArticle(product_id, thumb_url, publish_date, vendor_name, product_name) {
        return '<div class="article"><div class="article-content-img"><a href="product/prod/' + product_id + '"><img src="' + thumb_url +'" width="520" height="245"></a></div><div class="article-content-byline"><span class="date">' + publish_date + ' — By </span><span class="vendor"><a href="#" title="">' + vendor_name + '</a></span></div><h2><a href="product/prod/' + product_id + '">' + product_name + '</a></h2></div>';
    }
    
    
    $.get('product/ajaxLoadProds', function(o) {
        for(var i = 0 ; i < o.length ; i++) {
           content.append(getArticle(o[i].product_id, o[i].product_thumb, o[i].product_update_date, o[i].vendor_id, o[i].product_short_desc));   
        }
    }, 'json');
    
});