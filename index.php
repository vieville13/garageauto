<?php

session_start();
require "vendor/autoload.php";
use Root\Garageauto\Dispatcher;
$content=new Dispatcher();
$content->dispatch();
