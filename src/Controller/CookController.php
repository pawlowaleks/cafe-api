<?php

namespace App\Controller;

use App\Repository\CookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookController
{

    /**
     * @var CookRepository $cooks
     */
    private $cooks;

    public function __construct(CookRepository $cooks)
    {
        $this->cooks = $cooks;
    }

    /**
     * @Route("/cook/top", name="app_cook_top", methods: ["GET"])
     */
    public function top(): Response
    {

        $data = $this->cooks->findTopByDishes();
        return $this->json($data);
    }
}