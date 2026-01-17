<?php

namespace Tests\Unit\Application\UseCases;

use App\Application\UseCases\Webhooks\WebhookSubscriptionInput;
use App\Application\UseCases\Webhooks\WebhookSubscriptionUseCase;
use App\Domain\Contracts\Repositories\WebhookRepositoryInterface;
use App\Domain\Entity\WebhookEntity;
use Mockery;
use Tests\TestCase;

class WebhookSubscriptionTest extends TestCase
{
    public function test_webhook_subscription_success()
    {
        $repo = Mockery::mock(WebhookRepositoryInterface::class);
        $repo->shouldReceive('create')
            ->andReturn(new WebhookEntity(
                url: 'https://example.com/webhook',
                method: 'POST',
                secret: 'secret',
                event: 'event',
                isActive: true,
                clientId: 'client_id',
            )
        );
        $webhookSubscriptionUseCase = new WebhookSubscriptionUseCase($repo);
        $webhookSubscriptionInput = new WebhookSubscriptionInput([
            'url' => 'https://example.com/webhook',
            'method' => 'POST',
            'secret' => 'secret',
            'event' => 'event',
            'is_active' => true,
        ]);
        $output = $webhookSubscriptionUseCase->execute($webhookSubscriptionInput);

        $this->assertIsObject($output);
        $this->assertObjectHasProperty('webhookSubscription', $output);
        $this->assertArrayHasKey('client_id', $output->webhookSubscription);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}