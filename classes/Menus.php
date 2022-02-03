<?php
namespace Library;


use Symfony\Component\HttpClient\HttpClient;

class Menus
{
    public $dotenv;
    public  $basic_url;

    public $auth_token;

    public function __construct()
    {
        $this->basic_url = $_ENV['BASE_URL'];
        $this->auth_token = $_ENV['auth_token'];
    } 


    public function getMenus()
    {

        try {

            $client = HttpClient::create([
                'max_redirects' => 3,
            ]);

            $response = $client->request(
                'GET',
                $this->basic_url . '/menus',
                [
                    'headers' => [
                        'auth_bearer' => $this->auth_token,
                    ]
                ]
            );

            $result = (object) $response->toArray();

            return json_encode([
                'takeaway' =>  $result->data
            ]);
            

        } catch (\Exception $e) {

            return json_encode([
                "message" => $e->getMessage(),
            ]);

        }
    }

    
    public function getOneMenu($menu_id)
    {

        try {

            $client = HttpClient::create([
                'max_redirects' => 3,
            ]);

            $response = $client->request(
                'GET',
                $this->basic_url . "/menu/$menu_id/products",
                [
                    'headers' => [
                        'auth_bearer' => $this->auth_token,
                    ]
                ]
            );

            $result = (object) $response->toArray();

            return json_encode([
                'takeaway' =>  $result->data
            ]);
            

        } catch (\Exception $e) {

            return json_encode([
                "message" => $e->getMessage(),
            ]);

        }
    }

    
    
    public function updateOneMenu($product_model)
    {

        $product_model = (object) $product_model;

        $menu_id = $product_model->menu_id;
        $product_name = $product_model->product_name;
        $product_id = $product_model->product_id;

        try {

            $client = HttpClient::create([
                'max_redirects' => 3,
            ]);

            $response = $client->request(
                'GET',
                $this->basic_url . "/menu/$menu_id/products/$product_id",
                [
                    'headers' => [
                        'auth_bearer' => $this->auth_token,
                    ],
                    'body' => [
                        'name' => $product_name
                    ]
                ]
            );

            if($response->getStatusCode == 200){

                //PROOF THAT PRODUCT IS UPDATED
                return $this->getOneMenu($menu_id);

            }else{

                return json_encode([
                    "message" => "Failed to update product menu name",
                ]);

            }
            

        } catch (\Exception $e) {

            return json_encode([
                "message" => $e->getMessage(),
            ]);

        }
    }

}
