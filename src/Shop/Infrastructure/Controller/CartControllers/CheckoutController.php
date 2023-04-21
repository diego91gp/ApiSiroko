<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shop\Application\Command\CheckoutCommand;
use App\Shop\Application\Command\CheckoutCommandHandler;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    public function __construct(private readonly CheckoutCommandHandler $checkoutHandler)
    {
    }

    #[Route('/checkout/{userid}', name: 'product_checkout', methods: ['GET'])]
    public function checkCart(int $userid): JsonResponse
    {
        try {
            $response = ($this->checkoutHandler)(
                new CheckoutCommand($userid)
            );

            return new JsonResponse($response, Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse('error', Response::HTTP_OK);
        }

    }

}
