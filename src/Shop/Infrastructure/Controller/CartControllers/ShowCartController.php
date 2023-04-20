<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shop\Application\services\Cart\ShowCartService;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowCartController extends AbstractController
{
    public function __construct(private readonly ShowCartService $showCartService)
    {
    }

    #[Route('/show/{userid}', name: 'product_show', methods: ['GET'])]
    public function showCart(int $userid): JsonResponse
    {
        try {
            $cartDto = ($this->showCartService)($userid);
            return new JsonResponse($cartDto->getProducts(), Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse($e->getMessage());
        }
    }
}
