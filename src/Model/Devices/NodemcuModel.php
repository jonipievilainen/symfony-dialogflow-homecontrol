<?php
namespace App\Model\Devices;

use function GuzzleHttp\json_decode;
use GuzzleHttp\RequestOptions;
use App\Model\AbstractModel;

// class NodemcuModel extends AbstractModel
class NodemcuModel
{
    /**
     * @var AbstractModel
     */
    private $abstractmodel;

    public function __construct(AbstractModel $abstractmodel) {
        $this->abstractmodel = $abstractmodel;
    }

    public function getTest() {
        return "getTest";
    }
}