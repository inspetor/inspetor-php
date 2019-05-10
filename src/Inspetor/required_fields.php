<?php

return [
    'account' => [
        'account_id',
        'account_company_id',
        'account_email',
        'account_holder_name',
        'account_holder_document',
        'account_holder_country',
        'account_holder_state',
        'account_holder_city',
        'account_holder_zipcode',
        'account_holder_telephone',
        'account_creation_datetime',
        'account_creation_ip_address',
        'account_modification_datetime',
        'account_modification_ip_address'
    ],
    
    'sale' => [
        'sale_id',
        'event_id',
        'event_date_id',
        'account_id',
        'app_id',
        'sale_status',
        'sale_status_id',
        'transaction_id',
        'sale_creation_datetime',
        'sale_value',
        'method_of_payment',
        'installments',
        'cc_number',
        'cc_brand',
        'cc_billing_state',
        'cc_billing_city',
        'cc_billing_zipcode',
        'cc_holder_cpf',
        'order_ip',
        'sale_ip',
        'order_device_id',
        'order_browser_id',
        'sale_device_id',
        'sale_browser_id'
    ],

    'order' => [
        'order_user',
        'order_customer',
        'order_event',
        'order_tickets',
        'order_extras',
        'order_passkey',
        'order_shippingPrice',
        'order_appId',
        'order_payment',
        'order_response',
        'order_transactionId',
        'order_saleId',
        'order_saleStatus',
        'order_total',
        'order_userIp',
        'order_date',
        'order_senderHash',
        'order_referrerDomain',
        'order_referrerPath',
        'order_fraudNetPayload',
        'order_price',
        'order_tax',
        'order_ticketQuantity',
        'order_interest',
        'order_postbackUrl',
        'order_companyId',
        'order_refund',
        'order_sale',
        'order_instructions'
    ],

    'transfer' => [
        'account_id',
        'recipient',
        'ticket_id'
    ],

    'login_logout' => [
        'account_id'
    ]
];