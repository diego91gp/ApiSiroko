<?php

namespace App\Shop\Infrastructure\Controller\CartControllers;

use App\Shop\Application\Command\UpdateCartCommand;
use App\Shop\Application\Command\UpdateCartCommandHandler;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateCartController extends AbstractController
{
    public function __construct(private readonly UpdateCartCommandHandler $updateCommand)
    {
    }

    #[Route('/update/{userid}', name: 'product_update', methods: ['PUT'])]
    public function updateCart(Request $request, int $userid): JsonResponse
    {
        try {

            $productid = $request->request->get('productid');
            $uds = $request->request->get('units');

            $result = ($this->updateCommand)(
                new UpdateCartCommand($productid, $userid, $uds)
            );

            return new JsonResponse($result, Response::HTTP_OK);
        } catch (CartExceptions $e) {
            return new JsonResponse($e->getMessage());
        }

    }

}
