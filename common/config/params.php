<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    'clientOptions' => [
        'info' => true,
        'responsive' => true,
        'dom' => 'lfTrtip',
        'tableTools' =>
        [
            'aButtons' =>
            [
                [
                    'sExtends' =>'copy',
                    'sButtonText' => Yii::t('app', 'Copy to clipboard')
                ],
                [
                    'sExtends' => 'csv',
                    'sButtonText' => Yii::t('app', 'Save to CSV')
                ],
                [
                    'sExtends' => 'pdf',
                    'sButtonText' => Yii::t('app', 'Save to PDF')
                ],
                [
                    'sExtends' => 'print',
                    'sButtonText' => Yii::t('app', 'Print')
                ]
            ]
        ]
    ],
];
