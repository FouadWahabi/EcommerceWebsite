<div class="container" style="margin:10px">
    <div class="content" >
        <div class="register" style="width:50%;float:left;padding:17px;padding-right:35px;border-right: 1px solid #eee;">
            <h2 class="headline">REGISTRE</h2>
            <form id="reg-form" method="post" name="reg" action="<?php echo URL ?>register/addUser">
                <div class="tx-input-field">
                    <input id="first_name" type="text" class="validate" name="first_name">
                    <label for="first_name" class="">First Name</label>
                </div>
                <div class="tx-input-field">
                    <input id="last_name" type="text" class="validate" name="last_name">
                    <label for="last_name" class="">Last Name</label>
                </div>
                <div class="tx-input-field">
                    <input id="email-reg" type="text" class="validate" name="email-reg">
                    <label for="email-reg" class="">Email</label>
                </div>
                <div class="tx-input-field">
                    <input id="password-reg" type="password" class="validate" name="password-reg">
                    <label for="password-reg" class="">Password</label>
                </div>
                <div class="tx-input-field">
                    <input id="phone" type="text" class="validate" name="phone">
                    <label for="phone" class="">Phone numbre</label>
                </div>
                <div class="tx-input-field">
                    <input id="city" type="text" class="validate" name="city">
                    <label for="city" class="">City</label>
                </div>
                <div class="tx-input-field">
                    <input id="state" type="text" class="validate" name="state">
                    <label for="state" class="">State</label>
                </div>
                <div class="tx-input-field">
                    <input id="zip" type="text" class="validate" name="zip">
                    <label for="zip" class="">Zip code</label>
                </div>
               <div class="tx-input-field">
                    <input id="adress" type="text" class="validate" name="adress">
                    <label for="adress" class="">Adress</label>
                </div>
                <a id="register-btn" class="login-form-btn" style="margin-top:40px">REGISTRE</a>
                <input id="submit-reg" type="submit" value="submit" hidden="hidden" disabled>
            </form>
        </div>
        
        <div class="signin" style="width:50%;float:right;padding:17px;padding-left:35px;border-left: 1px solid #eee;">
            <h2 class="headline">SIGN-IN</h2>
            <form id="sign-form" method="post" name="sign" action="<?php echo URL ?>register/signIn">
                <div class="tx-input-field">
                    <input id="email-sign" type="text" class="validate" name="email-sign">
                    <label for="email-sign" class="">Email</label>
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