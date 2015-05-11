<div class="container" style="margin:10px">
    <div class="content" >
        <h2 class="headline" style="margin-bottom:30px;margin-top:5px">Mon panier</h2>
        <h2 style="margin-left:40%" id="empty">Panier vide !</h2>
        <div class="panier_content" style="width:90%;margin-left:5%"></div>
        <div id="paiement_inf" style="display:none">
            <hr style="border-color:#ff3c1f;margin-top:40px">
            <h2>Total price : <span style="color:orange;" id="tot-price">30 DT</span></h2>
            <h2>Reduction fidelité : <span style="color:orange;" id="red-price"></span><span style="color:orange;"> DT</span></h2>
            <hr style="border-top: 1px dotted #c8cbcc;margin-bottom:20px">
            <h2>Total : <span style="color:orange;" id="fin-price"></span><span style="color:orange;"> DT</span></h2>
        </div>
        <a id="checkout-btn" class="login-form-btn" style="margin-top:40px;" >Checkout</a>
        
        <form id="checkout-form" action="" method="post">
            <input id="total_price" type="hidden" name="total_price">
            <input type="submit" hidden="hidden">
        </form>
    </div>
</div>

