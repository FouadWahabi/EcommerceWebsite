<?php  if(Session::get('admin')) {
    die;
}?>
<div class="container" style="margin:10px">
    <div class="content" >
        <div class="signin" style="width:50%;margin-left:25%;margin-top:50px;">
            <h2 class="headline">SIGN-IN</h2>
            <form id="sign-form" method="post" name="sign" action="<?php echo URL ?>admin/signIn">
                <div class="tx-input-field">
                    <input id="email-sign" type="text" class="validate" name="email-sign">
                    <label for="email-sign" class="">Username</label>
                </div>
                <div class="tx-input-field">
                    <input id="password-sign" type="password" class="validate" name="password-sign">
                    <label for="password-sign" class="">Password</label>
                </div>
                <a id="sign-btn" class="login-form-btn" style="margin-top:40px">SIGN-IN</a>
                <input id="submit-sign" type="submit" value="submit" hidden="hidden" disabled>
            </form>
        </div>
    </div>
</div>