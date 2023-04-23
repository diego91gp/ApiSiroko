<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use App\Shop\Application\Command\CheckoutCommand;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    public function __construct(private readonly HandlerEventDispatcher $handler)
    {
    }

    #[Route('/checkout/{userid}', name: 'product_checkout', methods: ['GET'])]
    public function checkCart(int $userid): JsonResponse
    {
        try {
            $cartDTO = $this->handler->dispatchCommand(new CheckoutCommand($userid));

            return new JsonResponse($cartDTO->getProducts(), Response::HTTP_OK);
        } catch (Exception $e) {
            return new JsonResponse('error', Response::HTTP_OK);
        }

    }

}
