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
                    <li><a href="<?php echo URL; ?>register">CLIENT</a></li>
                    <li><a href="#">VENDOR</a></li>
                </ul>
                <ul class="platform">
                    <li><a><i class="fa fa-search fa-fw"></i></a>
                        <form class="search-box">
                            <input type="text" placeholder="Search...">
                            <input type="submit">
                        </form>
                    </li>
                    <li><a><i class="fa fa-shopping-cart fa-fw" id="panier"></i></a></li>
                    <li class="user-account">
                        <a><i class="fa fa-user fa-fw"></i></a>
                        <div class="login-form">
                            <form method="post">
                                <div class="login">
                                    <div>
                                        <label for="email">E-mail address</label>
                                        <input type="text" name="user[username]" id="user-email">
                                    </div>

                                    <div>
                                        <label for="password">Password</label>
                                        <input type="password" name="user[password]" id="user-password">
                                    </div>
                                    <button type="submit" class="login-form-btn">LOG IN</button>
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