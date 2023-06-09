<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use App\Shop\Application\Command\UpdateCartCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class UpdateCartController extends AbstractController
{
    public function __construct(private readonly HandlerEventDispatcher $command)
    {
    }

    #[Route('/update/{userid}', name: 'product_update', methods: ['PUT'])]
    public function updateCart(Request $request, int $userid): JsonResponse
    {
        try {

            $productid = $request->request->get('productid');
            $uds = $request->request->get('units');

            $this->command->dispatchCommand(new UpdateCartCommand($productid, $userid, $uds));

            return new JsonResponse("Carrito Actualizado Correctamente", Response::HTTP_OK);

        } catch (Throwable $e) {
            return new JsonResponse($e->getMessage());
        }

    }

}
