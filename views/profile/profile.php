<?php
if(!isset($this->data) || count($this->data) != 1) {
    // error handler
    die();
}
$data = $this->data[0];
?>

<div class="container" style="margin:10px">
    <div class="content" >
        <div id="<?php echo $data['product_id'] ?>" class="product">
            <div class="product-content-img">
                <a href="#">
                    <img src="<?php echo $data['product_image']?>" width="520" height="245">
                </a>
            </div>
            <div class="prod-info">
                <h2><a href="#"><?php echo $data['product_short_desc']?></a></h2>
                <div class="product-content-byline">
                    <span class="date"><?php echo $data['product_update_date']?> — By </span>
                    <span class="vendor"><a href="#"><?php echo $data['vendor_fname']?></a></span>
                </div>
                <p>RATING</p>
                <span>Quantity : </span>
                <p><?php echo $data['product_qte'] ?></p>
                <span>Stock : </span>
                <p><?php if(isset($data['product_stock'])) echo $data['product_stock']; else echo 'Unlimited'; ?></p>
                <span>Description : </span>
                <p class="prod-desc"><?php echo $data['product_long_desc']?></p>
                <a class="login-form-btn" href="#" onclick="addToBasket()">Add to cart</a>
            </div>
        </div>
    <div class="comments">
        <span>Comments</span>
        <hr style="border-top: 1px dotted #c8cbcc;">
        <div class="comment">
            <div class="comment-info clearfix">
                <span class="comment-title">Chaussure de ville comme de soirée</span>
                <div class="comment-ud">
                    <span class="comment-date">3 MARS 2015</span>
                    <span class="comment-user">Fouad</span>
                </div>
                <div class="comment-rating">STARS</div>
            </div>
            <div class="comment-content clearfix">
                <div class="com-vote">
                    <a class="fa fa-caret-up" href="#"></a>
                    <span>2</span>
                    <a class="fa fa-caret-down" href="#"></a>
                </div>
                <div class="com-content clearfix"><span>Très bonne chaussure et Tres agreable a porter, je recommande vivement ce modèle pouvant créer un look sportwear et un look classe et distinguer</span></div>
            </div>
        </div>

        <hr style="border-top: 1px dotted #c8cbcc;">
        <div class="comment">
            <div class="comment-info clearfix">
                <span class="comment-title">Chaussure de ville comme de soirée</span>
                <div class="comment-ud">
                    <span class="comment-date">3 MARS 2015</span>
                    <span class="comment-user">Fouad</span>
                </div>
                <div class="comment-rating">STARS</div>
            </div>
            <div class="comment-content clearfix">
                <div class="com-vote">
                    <a class="fa fa-caret-up" href="#"></a>
                    <span>2</span>
                    <a class="fa fa-caret-down" href="#"></a>
                </div>
                <div class="com-content clearfix"><span>Très bonne chaussure et Tres agreable a porter, je recommande vivement ce modèle pouvant créer un look sportwear et un look classe et distinguer</span></div>
            </div>
        </div>

        <hr style="border-top: 1px dotted #c8cbcc;">

        <textarea style="width:100%; height:150px;margin-top:20px"></textarea>
        <input type="submit">
    </div>
    </div>
</div>
