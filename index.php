<?php

declare(strict_types=1);

require_once('./vendor/autoload.php');
require_once('./headers.php');
require_once('./classes/Token.php');
require_once('./classes/Menus.php');


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client_secret = $_ENV['client_secret'];
$client_id = $_ENV['client_id'];
$grant_type = $_ENV['grant_type'];

# Uncomment if you want run any functions
# Set the BASE_URL value in the .env file
# First run the the 'GET TOKEN' to get the auth_token


/**
 *  GET TOKEN
 *  Uncomment the below code
 */

$authenticate = new Library\Token();
echo $authenticate->getAuthToken($client_secret, $client_id, $grant_type);



/**
 *  GET MENUS
 *  Uncomment the below code
 */

// $menus = new Library\Menus();
// echo $menus->getMenus();



/**
 *  GET ONE MENUS
 *  Uncomment the below code
 */

// $menu_id = 1;
// $menus = new Library\Menus();
// echo $menus->getOneMenu($menu_id);



/**
 *  UPDATE THE NAME A MENUS
 *  Uncomment the below code
 */

// $menu_id = 1;
// $product_name = "Chips";
// $product_id = 84;

// $update_menu = [
//     'menu_id' => $menu_id,
//     'product_id' => $product_id,
//     'product_name' => $product_name,
    
// ];

// $menus = new Library\Menus();
// echo $menus->updateOneMenu($update_menu);
