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
                    <img src="<?php echo $data['product_thumb']?>" width="520" height="245">
                </a>
            </div>
            <div class="prod-info">
                <h2><a href="#"><?php echo $data['product_short_desc']?></a></h2>
                <div class="product-content-byline">
                    <span class="date"><?php echo $data['product_update_date']?> — By </span>
                    <span class="vendor"><a href="#"><?php echo $data['marque_name']?></a></span>
                </div>
                <div id="product_rating" style="margin:10px;display:block;margin-left:0" value="<?php echo $data['product_rating'] ?>"></div>
                <span>Quantity : </span>
                <p><?php echo $data['product_qte'] ?></p>
                <span>Stock : </span>
                <p><?php if(isset($data['product_stock'])) echo $data['product_stock']; else echo 'Unlimited'; ?></p>
                <span>Description : </span>
                <p class="prod-desc"><?php echo $data['product_long_desc']?></p>

                <?php if(Session::get('admin')) {
                    echo "<form style='margin-top:20px;margin-bottom:20px' method='post' action='" .URL . "admin/addPromo'><input type='text' name='promo'><input type='hidden' name='id' value=" . $data['product_id'] ."><input type='submit' value='add promo'></form>";
                } ?>
                <select style="margin-bottom:20px" id="quantity" name="quantity">
                    <option value="1">1
                    </option><option value="2">2
                    </option><option value="3">3
                    </option><option value="4">4
                    </option><option value="5">5
                    </option><option value="6">6
                    </option><option value="7">7
                    </option><option value="8">8
                    </option><option value="9">9
                    </option><option value="10">10
                    </option>
                </select>
                <a class="login-form-btn" href="#" onclick="addToBasket(<?php echo $data['product_id']; ?>)">Add to cart</a>
            </div>
        </div>
    <div class="comments">
        <span>Comments</span>
    </div>

        <?php if(!Session::get('user')) die(); ?>
        <hr style="border-top: 1px dotted #c8cbcc;">
        <label for="comment_title">Comment title</label>
        <input id="comment_title" name="comment_title" style="margin:10px;display:block;margin-left:0">
        <div id="jRate" style="margin:10px;display:block;margin-left:0"></div>
        <label for="comment_content">Comment content</label>
        <textarea style="width:100%; height:150px;margin-top:20px;margin-bottom:20px" id="comment_content"></textarea>
        <a id="add_comment" class="login-form-btn">Add comment</a>
    </div>
</div>
