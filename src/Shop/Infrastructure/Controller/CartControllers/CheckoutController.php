<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shop\Application\services\Cart\CheckoutService;
use App\Shop\Domain\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    public function __construct(private readonly CheckoutService $checkoutService)
    {
    }

    #[Route('/checkout/{userid}', name: 'product_checkout', methods: ['GET'])]
    public function checkCart(int $userid): JsonResponse
    {
        try {

            $cartDto = ($this->checkoutService)($userid);
            return new JsonResponse($cartDto->getProducts(), Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse('error', Response::HTTP_OK);
        }

    }

}
