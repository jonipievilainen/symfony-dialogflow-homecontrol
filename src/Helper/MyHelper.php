<?php

namespace App\Helper;

use Doctrine\ORM\EntityManager;

class MyHelper
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function hojo() {
        echo "helppaa";
    }
}