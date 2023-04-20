<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shop\Application\services\Cart\UpdateCartService;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateCartController extends AbstractController
{
    public function __construct(private readonly UpdateCartService $updateCartService)
    {
    }

    #[Route('/update/{userid}', name: 'product_update', methods: ['PUT'])]
    public function updateCart(Request $request, int $userid): JsonResponse
    {
        $productid = $request->request->get('productid');
        $uds = $request->request->get('units');

        try {
            $result = $this->updateCartService->updateCart($userid, $productid, $uds);
            return new JsonResponse($result, Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse($e->getMessage());
        }

    }

}
