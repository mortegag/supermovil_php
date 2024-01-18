<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$factory = (new Factory)->withServiceAccount('firebase-connect.json')
 ->withDatabaseUri('https://supermovil-da749-default-rtdb.firebaseio.com/');

 $database = $factory->createDatabase();
 $auth = $factory->createAuth();

?>
