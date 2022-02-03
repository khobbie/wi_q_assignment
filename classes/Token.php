<?php
namespace Library;


use Symfony\Component\HttpClient\HttpClient;

class Token
{
    public $dotenv;
    public  $basic_url;

    public function __construct()
    {
        $this->basic_url = $_ENV['BASE_URL'];
    } 


    public function getAuthToken($client_secret, $client_id, $grant_type)
    {

        try {

            $client = HttpClient::create([
                'max_redirects' => 3,
            ]);

            $response = $client->request(
                'POST',
                $this->basic_url . '/auth_token',
                [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'body' => [
                        'client_secret' => $client_secret,
                        'client_id' => $client_id,
                        'grant_type' => $grant_type,
                    ],

                ]
            );

            $result = (object) $response->toArray();
            $token = $result->access_token;

            putenv("auth_token=$token");

            return $response;
            

        } catch (\Exception $e) {

            return json_encode([
                "message" => $e->getMessage(),
            ]);

        }
    }
}
