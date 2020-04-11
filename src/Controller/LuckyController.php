<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Device;
use App\Repository\DeviceRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var DeviceRepository
     */
    private $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
        echo 111;
    }

    function __destruct() {
        echo 222;
    }

    public function number()
    {
        echo '<pre>';
        $id = 1;
        // $product = $this->getDoctrine()
        //     ->getRepository(Device::class)
        //     ->find($id);

        // var_dump($product);

        $device = $this->deviceRepository->find($id);

        print_r($device);

        echo '</pre>';


        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}