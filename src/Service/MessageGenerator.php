<?php

// src/Service/MessageGenerator.php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Apikey;

class MessageGenerator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getHappyMessage()
    {

        // $records = $this->entityManager->getRepository(Key::class)->test();

        $records = $this->entityManager->getRepository(Apikey::class)->find(1);

        var_dump($records);



        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        echo '<br>';
        echo '<br>';

        $index = array_rand($messages);

        return $messages[$index];
    }
}