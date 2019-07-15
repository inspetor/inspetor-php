<?php

return [
    'inspetor_config' => [
        'collectorHost'               => 'analytics-dev.useinspetor.com',
        'protocol'                    => 'https',
        'emitMethod'                  => 'POST',
        'bufferSize'                  => 1,
        'trackerName'                 => null,
        'appId'                       => null,
        'encode64'                    => true,
        'debugMode'                   => false,
        'inspetorAuthSchema'          => 'iglu:com.inspetor/inspetor_auth_backend/jsonschema/1-0-0',
        'inspetorPassRecoverySchema'  => 'iglu:com.inspetor/inspetor_pass_recovery_backend/jsonschema/1-0-0',
        'inspetorSaleSchema'          => 'iglu:com.inspetor/inspetor_sale_backend/jsonschema/1-0-1',
        'inspetorTransferSchema'      => 'iglu:com.inspetor/inspetor_transfer_backend/jsonschema/1-0-0',
        'inspetorAccountSchema'       => 'iglu:com.inspetor/inspetor_account_backend/jsonschema/1-0-0',
        'inspetorEventSchema'         => 'iglu:com.inspetor/inspetor_event_backend/jsonschema/1-0-1',
        'inspetorContext'             => 'iglu:com.inspetor/inspetor_context/jsonschema/1-0-0'
    ]
];