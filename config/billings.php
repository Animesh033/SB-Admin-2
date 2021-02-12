<?php

return [

    'admin' => [
        'prefix' => 'admins',
        'route' => 'admins'
    ],

    'billing' => [
        'prefix' => 'billings',
        'route' => 'billings'
    ],

    'quotation' => [
        'prefix' => 'quotations',
        'route' => 'quotations',
        'pdf_path' => 'public/pdf/quotations/',
        'storage_path' => 'storage/pdf/quotations/',
    ],

    'receipt' => [
        'prefix' => 'receipts',
        'route' => 'receipts',
        'pdf_path' => 'public/pdf/receipts/',
        'storage_path' => 'storage/pdf/receipts/',
    ],

    'customer' => [
        'prefix' => 'customers',
        'route' => 'customers'
    ],

];