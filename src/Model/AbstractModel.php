<?php
// src/Model/AbstractModel.php
namespace App\Model;

use Symfony\Component\ErrorHandler\ErrorHandler;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use App\Entity\Apikey;

class AbstractModel
{
    protected $client;
    protected $requestOptions;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->client = new Client();
        
        $key = (isset($_GET['key']) ? $_GET['key'] : '');
        
        if(!$this->auth($key))
            throw new \RuntimeException('Access denied');
    }


    private function auth($key) {
        return (bool) $this->em->getRepository(Apikey::class)->findBy([
            'api_key' => $key
        ]);
    }

    public function request($url, $parms = array(), $method = 'GET', $isJson = false){

        $query = array();
        
        if($method === 'GET'){
            if($isJson){
                $query = array(
                    'body' => json_encode($parms),
                    'headers' => [
                        'Content-Type'     => 'application/json',
                    ]
                );
            }else{
                foreach($parms as $key => $val){
                    $query['query'][$key] = $val;
                }
            }

        }elseif($method === 'POST'){

            if($isJson){
                $query = array(
                    'body' => json_encode($parms),
                    'headers' => [
                        'Content-Type'     => 'application/json',
                    ]
                );
            }else{
                foreach($parms as $key => $val){
                    $query['form_params'][$key] = $val;
                }
            }
        }
        
        $res = $this->client->request($method, $url, $query);
        // error_log($res->getStatusCode());
        // error_log(print_r($res->getHeader('content-type')));
        // error_log($res->getBody()->getContents());
        // error_log(get_object_vars($res->getBody()));

        return $res->getBody();
    }
}