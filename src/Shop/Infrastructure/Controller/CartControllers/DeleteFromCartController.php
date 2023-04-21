<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use App\Shop\Application\Command\DeleteProductFromCartCommand;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteFromCartController extends AbstractController
{
    public function __construct(private readonly HandlerEventDispatcher $handler)
    {
    }

    #[Route('/delete/{userid}/{productid}', name: 'product_delete', methods: ['DELETE'])]
    public function deleteFromCart(int $userid, int $productid): JsonResponse
    {
        try {
            $this->handler->dispatchCommand(new DeleteProductFromCartCommand($userid, $productid));

            return new JsonResponse("Borrado correctamente ", Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse($e->getMessage());
        }

    }

}
