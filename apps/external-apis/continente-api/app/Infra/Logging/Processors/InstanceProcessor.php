<?php

namespace App\Infra\Logging\Processors;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

class InstanceProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $record->extra['instance'] = gethostname();
        $record->extra['service'] = config('app.name', 'continente-api');
        $record->extra['environment'] = config('app.env', 'local');
        $record->extra['request_id'] = request()->header('X-REQUEST-ID');
        $record->extra['request_method'] = request()->method();
        $record->extra['request_path'] = request()->path();

        return $record;
    }
}