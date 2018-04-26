<div class="container" style="margin:10px;">
    <div class="content clearfix" style="height:190%">
        <h2 class="headline">STATS</h2>
        <hr style="border-color:#ff3c1f">
        <div class="stats draggable clearfix">
            <div id="marque_stats" style="margin:10px;float:left;display: inline-block;"></div>
            <div id="gain_stats" style="margin:10px;float:right;display: inline-block;"></div>
            <div style="font-weight: font-weight(medium);font-size: 20px;padding-top: 10px;">Total profit : <span id="sales" style="color:#ff3c1f"></span>  $</div>
        </div>
        <h2 class="headline">WARNINGS</h2>
        <hr style="border-color:#ff3c1f">
        <div class="warnings draggable">
            <h2 style="margin-left:40%;margin-bottom:10px" id="warning-empty">No warnings exist !</h2>
        </div>

       <!-- <h2 class="headline">COMMANDS</h2>
        <hr style="border-color:#ff3c1f">
        <div class="commands draggable">
            <h2 style="margin-left:40%;margin-bottom:10px" id="command-empty">No commands exist !</h2>
        </div> -->

        <div class="add_prod">
            <h2 class="headline">ADD PROD</h2>
            <hr style="border-color:#ff3c1f">
            <h2 style="margin-bottom:10px;font-size:15px" id="empty">Entrer les infos sur le produit :</h2>
            <form id="add-form" method="post" name="add" action="<?php echo URL ?>admin/addProd" style="margin-top:20px" enctype="multipart/form-data">
                <div class="tx-input-field">
                    <input id="prod_short_desc" type="text" class="validate" name="prod_short_desc">
                    <label for="prod_short_desc" class="">Product name</label>
                </div>
                <div class="tx-input-field">
                    <input id="prod_long_desc" type="text" class="validate" name="prod_long_desc">
                    <label for="prod_long_desc" class="">Product description</label>
                </div>
                <div class="tx-input-field">
                    <input id="product_ref" type="text" class="validate" name="product_ref">
                    <label for="product_ref" class="">Product reference</label>
                </div>
                <div class="tx-input-field">
                    <input id="product_stock" type="text" class="validate" name="product_stock">
                    <label for="product_stock" class="">Product stock</label>
                </div>
                <div class="tx-input-field">
                    <input id="product_qte" type="text" class="validate" name="product_qte">
                    <label for="product_qte" class="">Product qte</label>
                </div>
                <div class="tx-input-field">
                    <input id="product_price" type="text" class="validate" name="product_price">
                    <label for="product_price" class="">Product price</label>
                </div>
                <label id=""></label>

                <div style="display:block;margin-bottom:20px">
                    <select id="marque-select">
                        <option></option>
                    </select>
                    <label for="marque-add">Select or add new brand</label>
                    <input type="text" id="marque-add">
                </div>

                <input type="hidden" name="marque_name" id="marque_name" value="" hidden="hidden">
                <input type="file" name="product_thumb" id="product_thumb">
                <a id="add-btn" class="login-form-btn" style="margin-top:40px">ADD PROD</a>
                <input id="submit-add" type="submit" value="submit" hidden="hidden">
            </form>
            <hr style="border-color:#ff3c1f;margin-top:40px">
            <a id="disconnect-btn" class="login-form-btn" style="margin-top:40px;display:inline-block;float:right">DISCONNECT</a>
        </div>
    </div>
</div>
