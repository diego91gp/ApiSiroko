<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;


use App\Shop\Application\services\Cart\AddToCartService;
use App\Shop\Domain\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddToCartController extends AbstractController
{

    public function __construct(private readonly AddToCartService $addToCartService)
    {
    }


    #[Route('/add/{userid}', name: 'product_add', methods: ['POST'])]
    public function addToCart(Request $request, int $userid): JsonResponse
    {
        $productID = $request->request->get('productid');
        $units = $request->request->get('units');
        try {
            $this->addToCartService->addToCart($userid, $productID, $units);
            return new JsonResponse("Agregado con exito", Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse($e->getMessage());
        }

    }

}
