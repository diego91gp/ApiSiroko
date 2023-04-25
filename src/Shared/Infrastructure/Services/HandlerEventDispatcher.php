<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Services;

use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

class HandlerEventDispatcher
{
    public function __construct(
        private readonly MessageBusInterface $queryBus,
        private readonly MessageBusInterface $commandBus
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function dispatchCommand($event): mixed
    {
        return $this->dispatch($event, $this->commandBus);
    }

    /**
     * @throws Throwable
     */
    public function dispatchQuery($event): mixed
    {
        return $this->dispatch($event, $this->queryBus);
    }

    /**
     * @throws Throwable
     */
    private function dispatch(mixed $event, MessageBusInterface $bus): mixed
    {
        try {
            $envelope = $bus->dispatch($event);

        } catch (HandlerFailedException $e) {
            $this->processBusException($e);
        }
        return $this->processEnvelope($envelope);
    }

    private function processEnvelope($envelope): mixed
    {
        $handledStamps = $envelope->last(HandledStamp::class);
        return $handledStamps->getResult();
    }

    /**
     * @throws Throwable
     */
    private function processBusException(HandlerFailedException $e): void
    {
        while ($e instanceof HandlerFailedException) {

            $e = $e->getPrevious();
        }
        throw $e;
    }
}