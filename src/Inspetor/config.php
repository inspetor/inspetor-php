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
        'inspetorAuthSchema'          => 'iglu:com.inspetor/inspetor_auth/jsonschema/1-0-3',
        'inspetorPassRecoverySchema'  => 'iglu:com.inspetor/inspetor_pass_recovery/jsonschema/1-0-1',
        'inspetorSaleSchema'          => 'iglu:com.inspetor/inspetor_sale/jsonschema/1-0-2',
        'inspetorTransferSchema'      => 'iglu:com.inspetor/inspetor_transfer/jsonschema/1-0-2',
        'inspetorAccountSchema'       => 'iglu:com.inspetor/inspetor_account/jsonschema/1-0-3',
        'inspetorEventSchema'         => 'iglu:com.inspetor/inspetor_event/jsonschema/1-0-2',
        'inspetorContext'             => 'iglu:com.inspetor/inspetor_context/jsonschema/1-0-0'
    ]
];