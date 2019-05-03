<?php

return [
    'collectorHost' => 'analytics-staging.useinspetor.com',
    'protocol' => 'https',
    'emitMethod' => 'POST',
    'bufferSize' => 1,
    'encode64' => TRUE,
    'debugMode' => FALSE,
    'ingresseAccountSchema' => 'iglu:com.inspetor/ingresse_account/jsonschema/1-0-6',
    'ingresseOrderSchema' => 'iglu:com.inspetor/ingresse_order/jsonschema/1-0-11',
    'ingresseSaleSchema' => 'iglu:com.inspetor/ingresse_sale/jsonschema/1-0-8',
    'ingresseSerializationError' => 'iglu:com.inspetor_dev/ingresse_serialization_error/jsonschema/1-0-0',
    'ingresseUserContext' => 'iglu:com.inspetor/ingresse_user_context/jsonschema/1-0-1',
    'ingresseOrderContext' => 'iglu:com.inspetor/ingresse_order_context/jsonschema/1-0-0',
    'ingresseSaleContext' => 'iglu:com.inspetor/ingresse_sale_context/jsonschema/1-0-0'
];