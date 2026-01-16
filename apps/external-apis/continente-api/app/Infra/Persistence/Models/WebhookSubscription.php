<?php

namespace App\Infra\Persistence\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookSubscription extends Model
{
    use HasFactory;
    use HasUuids;

    public function uniqueIds()
    {
        return ['client_id'];
    }
}
