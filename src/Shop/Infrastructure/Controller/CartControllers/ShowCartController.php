<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use App\Shop\Application\Query\ShowCartQuery;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowCartController extends AbstractController
{
    public function __construct(private readonly HandlerEventDispatcher $handler)
    {
    }

    #[Route('/show/{userid}', name: 'product_show', methods: ['GET'])]
    public function showCart(int $userid): JsonResponse
    {
        try {
            $cartDTO = $this->handler->dispatchQuery(new ShowCartQuery($userid));

            return new JsonResponse($cartDTO->getProducts(), Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse($e->getMessage());
        }
    }
}
