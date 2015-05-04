<!DOCTYPE html>
<!--

	PERFUM-ECOMMERCE 
	
-->

<html>

    <head>
        <meta charset="UTF-8"> 
        <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script type="application/javascript" src="js/jquery-1.11.2.min.js"></script>
        <script type="application/javascript" src="js/base.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </head>
    
    <body>
        <nav>
            <div class="navbar clearfix">
                <ul id="navToggle" class="burger">
                    <li></li><li></li><li></li>
                </ul>
                <a id="logo" href="#"></a>
                <ul class="nav-menu"> 
                    <li><a href="index.php">PRODUCT</a></li>
                    <li><a href="index.php">CLIENT</a></li>
                    <li><a href="index.php">VENDOR</a></li>
                </ul>
                <ul class="platform">
                    <li><a><i class="fa fa-search fa-fw"></i></a>
                        <form class="search-box">
                            <input type="text" placeholder="Search...">
                            <input type="submit">
                        </form>
                    </li>
                    <li><a><i class="fa fa-shopping-cart fa-fw"></i></a></li>
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
                                    <a class="login-form-btn">Create one now</a>
                                </div>
                                
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        
        
        <div class="filter close">
            <div class="filter-switcher">
                <ul class="toggle">
                    <li><a href="#"><i class="fa fa-clock-o"></i> LATEST</a></li>
                    <li class="active"><a href="#"><i class="fa fa-fire"></i> POPULAR</a></li>
                </ul>
                <div class="select-category">
                    <span>All categories</span>
                    <select>
                        <option>All categories</option>
                        <option>Parfum homme</option>
                        <option>Parfum femme</option>
                        <option>Parfum bebe</option>
                    </select>
                </div>
                <div class="options">
                    <span class="selection-option">- MARQUE</span>
                    
                    <div class="ch-input-field">
                        <input type="checkbox" id="marque-1">
                        <label for="marque-1">Diesel</label>
                    </div>
                    <div class="ch-input-field">
                        <input type="checkbox" id="marque-2">
                        <label for="marque-2">Calvin Klein</label>
                    </div>
                    <div class="ch-input-field">
                        <input type="checkbox" id="marque-3">
                        <label for="marque-3">Pierre Cardin</label>
                    </div>
                    <div class="ch-input-field">
                        <input type="checkbox" id="marque-4">
                        <label for="marque-4">One Million</label>
                    </div>
                    <div class="ch-input-field">
                        <input type="checkbox" id="marque-5">
                        <label for="marque-5">BOSS</label>
                    </div>
                    <span class="selection-option">- PRICE</span>
                    <div id="slider">
                        <p>
                          <label for="amount">Price range:</label>
                          <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        </p>
                        <div id="slider-range"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="filter-ghost" class="filter-ghost close"></div>
        <div class="container">
            <div class="content close">
                <div class="tx-input-field" style="display:block">
                    <input id="first_name" type="text" class="validate">
                    <label for="first_name" class="">First Name</label>
                </div>
                <div class="article">
                    <div class="article-content-img">
                        <a href="#">
                            <img src="img/thumbs/art-1-thumb.jpg" width="520" height="245">
                        </a>
                    </div>
                    <div class="article-content-byline">
                        <span class="date">6 Apr, 01:25pm — By </span>
                        <span class="vendor"><a href="#" title="Posts by Fouad Wahabi">Fouad Wahabi</a></span>
                    </div>
                    <h2><a href="#">First part</a></h2>
                </div>
                <div class="article">
                    <div class="article-content-img">
                        <a href="#">
                            <img src="img/thumbs/art-1-thumb.jpg" width="520" height="245">
                        </a>
                    </div>
                    <div class="article-content-byline">
                        <span class="date">6 Apr, 01:25pm — By </span>
                        <span class="vendor"><a href="#" title="Posts by Fouad Wahabi">Fouad Wahabi</a></span>
                    </div>
                    <h2><a href="#">First part</a></h2>
                </div>
                 
            </div>
        </div>
        
        
    </body>

</html>