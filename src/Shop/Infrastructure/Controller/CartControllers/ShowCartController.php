<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shop\Application\Query\ShowCartQuery;
use App\Shop\Application\Query\ShowCartQueryHandler;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowCartController extends AbstractController
{
    public function __construct(private readonly ShowCartQueryHandler $showCartHandler)
    {
    }

    #[Route('/show/{userid}', name: 'product_show', methods: ['GET'])]
    public function showCart(int $userid): JsonResponse
    {
        try {
            $response = ($this->showCartHandler)(
                new ShowCartQuery($userid)
            );


            return new JsonResponse($response, Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse($e->getMessage());
        }
    }
}
