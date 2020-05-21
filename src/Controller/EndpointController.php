<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Класс контроллера с тестовыми данными.
 */
class EndpointController
{
    /**
     * Возвращает тестовый json.
     *
     * @Route("/endpoint")
     */
    public function endpoint(): Response
    {
        $ret = [
            ['team' => 'Axiom', 'scores'  => 88],
            ['team' => 'BnL', 'scores'    => 65],
            ['team' => 'Eva', 'scores'    => 99],
            ['team' => 'WALL-E', 'scores' => 99]
        ];

        $response = new Response(\json_encode($ret));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
