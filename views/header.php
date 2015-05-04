<!DOCTYPE html>
<!--

	PERFUM-ECOMMERCE 
	
-->

<html>

    <head>
        <meta charset="UTF-8"> 
        <link rel="stylesheet" type="text/css" href="<?php echo URL ?>stylesheets/style.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script type="application/javascript" src="<?php echo URL ?>js/jquery-1.11.2.min.js"></script>
        <script type="application/javascript" src="<?php echo URL ?>js/base.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        
        <?php 
        if(isset($this->js)) {
            foreach($this->js as $js) {
                echo '<script type="application/javascript" src="'.URL.'views/'.$js.'"></script>';
            }
        }
        ?>
        
    </head>
    
    <body>
        <nav>
            <div class="navbar clearfix">
                <ul id="navToggle" class="burger">
                    <li></li><li></li><li></li>
                </ul>
                <a id="logo" href="#"></a>
                <ul class="nav-menu"> 
                    <li><a href="<?php echo URL; ?>product">PRODUCT</a></li>
                    <li><a href="<?php echo URL; ?><?php if(!Session::get('user')) echo 'register'; else echo 'profile';?>"><?php if(!Session::get('user')) echo 'CLIENT'; else echo 'PROFILE';?></a></li>
                    <li><a href="<?php echo URL; ?>admin">ADMIN</a></li>
                </ul>
                <ul class="platform">
                    <li><a><i class="fa fa-search fa-fw"></i></a>
                        <form class="search-box">
                            <input type="text" placeholder="Search...">
                            <input type="submit">
                        </form>
                    </li>
                    <li><a><i class="fa fa-shopping-cart fa-fw" id="panier"><?php if(count(Session::get('panier')) > 0) echo count(Session::get('panier')); ?></i></a></li>
                    <li class="user-account">
                        <a><i id='user_account' class="fa <?php if(!Session::get('user')) echo 'fa-user'; else echo 'fa-sign-out';?> fa-fw"></i></a>
                        <div class="login-form">
                            <form id="login-form" method="post" action="<?php echo URL ?>register/signIn">
                                <div class="login">
                                    <div>
                                        <label for="email-sign-form">E-mail address</label>
                                        <input type="text" name="email-sign" id="email-sign-form">
                                    </div>

                                    <div>
                                        <label for="password-sign-form">Password</label>
                                        <input type="password" name="password-sign" id="password-sign-form">
                                    </div>
                                    <a id="login-sign-form" class="sign-form-btn">LOG IN</a>
                                    <input id="submit-sign-form" type="submit" value="submit" hidden="hidden" disabled>
                                </div>
                                <div class="registre">
                                    <span>No account yet?</span>
                                    <a class="login-form-btn" href="<?php echo URL ?>register">Create one now</a>
                                </div>
                                
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>