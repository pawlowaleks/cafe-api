<?php

namespace App\Controller;

use App\Entity\Check;
use App\Entity\Client;
use App\Entity\Dish;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckController
{
    /**
     * @Route("/check/new", name="app_check_new", methods: ["POST"])
     */
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $clients = $doctrine->getRepository(Client::class);
        $client = $clients->findOneBy(['id' => $request->request->get('clientId')]);

        $check = new Check();
        $check->setClient($client);
        $check->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($check);
        $entityManager->flush();

        return $this->json($check);
    }

    /**
     * @Route("/check/add-dish", name="app_check_add_dish", methods: ["POST"])
     */
    public function addDish(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $checks = $doctrine->getRepository(Check::class);
        /**
         * @var Check $check
         */
        $check = $checks->findOneBy(['id' => $request->request->get('checkId')]);
        $dish = $doctrine->getRepository(Dish::class)->findOneBy(['id' => $request->request->get('dishId')]);
        $check->addDish($dish);

        $entityManager->persist($check);
        $entityManager->flush();

        return $this->json($check);
    }
}