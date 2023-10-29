<?php

define('APPNAME','FAREFLEX');


if($_SERVER['SERVER_NAME'] == 'localhost')
{
    define('DBHOST','localhost');
    define('DBNAME','fareflex');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','mysql');
    define('ROOT','http://localhost/FAREFLEX/public');

}else{
    define('DBHOST','localhost');
    define('DBNAME','fareflex');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','mysql');
    define('ROOT',$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/FAREFLEX/public');
}