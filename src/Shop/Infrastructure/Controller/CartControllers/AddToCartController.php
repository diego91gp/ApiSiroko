<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;


use App\Shared\Infrastructure\Services\HandlerEventDispatcher;
use App\Shop\Application\Command\AddProductToCartCommand;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddToCartController extends AbstractController
{

    public function __construct(private readonly HandlerEventDispatcher $handler)
    {
    }

    #[Route('/add/{userid}', name: 'product_add', methods: ['POST'])]
    public function addToCart(Request $request, int $userid): JsonResponse
    {
        try {
            $productID = $request->request->get('productid');
            $units = $request->request->get('units');

            $this->handler->dispatchCommand(new AddProductToCartCommand($productID, $units, $userid));

            return new JsonResponse("Agregado con exito", Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse($e->getMessage());
        }

    }

}
