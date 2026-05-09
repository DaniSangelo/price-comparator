<?php

namespace App\Infra\Messaging;

use App\Domain\Contracts\EventPublisher;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMQEventPublisher implements EventPublisher
{
    public function __construct(private RabbitMQConnection $connection) {}

    public function publish(object $event): void
    {
        $channel = $this->connection->channel();
        $channel->exchange_declare(
            'product.events',
            'topic',
            false,
            true,
            false,
        );

        $payload = json_encode([
            'event' => get_class($event),
            'payload' => [
                'product_id' => $event->productId,
                'updated_at' => $event->updatedAt->format(DATE_ATOM),
            ],
        ]);

        logger()->info('Publish message on RabbitMQ', [
            'payload' => $payload,
            'exchange' => 'product.events',
            'routing_key' => 'product.updated',
        ]);

        $message = new AMQPMessage($payload, ['content_type' => 'application/json']);
        $channel->basic_publish(
            $message,
            'product.events',
            'product.updated'
        );
    }
}