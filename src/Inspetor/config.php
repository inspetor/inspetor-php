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
       
        'ingresseAuthSchema'          => 'iglu:com.inspetor/ingresse_account/jsonschema/1-0-6',
        'ingresseOrderSchema'         => 'iglu:com.inspetor/ingresse_order/jsonschema/1-0-12',
        'ingressePassRecoverySchema'  => 'iglu:com.inspetor/ingresse_pass_recovery/jsonschema/1-0-0',
        'ingresseSaleSchema'          => 'iglu:com.inspetor/ingresse_sale/jsonschema/1-0-8',
        'ingresseTransferSchema'      => 'iglu:com.inspetor/ingresse_transfer/jsonschema/1-0-0',
        'ingresseUserSchema'          => 'iglu:com.inspetor/ingresse_sale/jsonschema/1-0-8',
       
        'ingresseAuthContext'         => 'iglu:com.inspetor/ingresse_auth_context/jsonschema/1-0-0',
        'ingresseOrderContext'        => 'iglu:com.inspetor/ingresse_order_context/jsonschema/1-0-0',
        'ingressePassRecoveryContext' => 'iglu:com.inspetor/ingresse_pass_recovery_context/jsonschema/1-0-0',
        'ingresseSaleContext'         => 'iglu:com.inspetor/ingresse_sale_context/jsonschema/1-0-0',
        'ingresseTransferContext'     => 'iglu:com.inspetor/ingresse_transfer_context/jsonschema/1-0-0',
        'ingresseUserContext'         => 'iglu:com.inspetor/ingresse_user_context/jsonschema/1-0-3',
    ]
];