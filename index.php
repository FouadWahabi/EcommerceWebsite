<?php

// load libs
require 'libs/bootstrap.php';
require 'libs/controller.php';
require 'libs/view.php';
require 'libs/database.php';
require 'libs/model.php';
require 'libs/session.php';

// load config
require 'config/paths.php';
require 'config/database.php';
require 'config/global.php';

// entry point
$app = new Bootstrap();
Session::init();

?>