<?php

namespace App\Infra\Http\Controllers;

use App\Application\UseCases\Webhooks\WebhookSubscriptionInput;
use App\Application\UseCases\Webhooks\WebhookSubscriptionUseCase;
use App\Infra\Http\Requests\WebhookSubscriptionRegistrationRequest;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends Controller
{
    public function __construct(private WebhookSubscriptionUseCase $webhookSubscriptionUseCase){}

    public function store(WebhookSubscriptionRegistrationRequest $request)
    {
        try {
            $input = new WebhookSubscriptionInput($request->validated());
            $output = $this->webhookSubscriptionUseCase->execute($input);
            logger()->info('Webhook subscription created successfully', ['client_id' => $output->webhookSubscription['client_id']]);
            return response()->json([
                'message' => 'Webhook subscription created successfully',
                'data' => [
                    'client_id' => $output->webhookSubscription['client_id'],
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            logger()->error('Error creating webhook subscription', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
