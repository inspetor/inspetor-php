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

        'inspetorOrderSchema'         => 'iglu:com.inspetor/inspetor_order/jsonschema/1-0-0',
        'inspetorAuthSchema'          => 'iglu:com.inspetor/inspetor_auth/jsonschema/1-0-0',
        'inspetorPassRecoverySchema'  => 'iglu:com.inspetor/inspetor_pass_recovery/jsonschema/1-0-0',
        'inspetorTransactionSchema'   => 'iglu:com.inspetor/inspetor_transaction/jsonschema/1-0-0',
        'inspetorTransferSchema'      => 'iglu:com.inspetor/inspetor_transfer/jsonschema/1-0-0',
        'inspetorUserSchema'          => 'iglu:com.inspetor/inspetor_account/jsonschema/1-1-0',
        'inspetorContext'             => 'iglu:com.inspetor/inspetor_context/jsonschema/1-0-0'
    ]
];