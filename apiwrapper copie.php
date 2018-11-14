<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 30/03/2018
 * Time: 16:05
 */

return [
    'visiotalent' => [
        'description' => [
            'baseUrl' => 'http://api.visiotalent.com',
            'operations' => [
                'listInterviews' => [
                    'httpMethod' => 'GET',
                    'uri' => '/v2/users/{userId}/recruitments/{recruitmentId}/interviews/{interviewId}',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'userId' => [
                            'type' => 'string',
                            'location' => 'uri'
                        ],
                        'recruitmentId' => [
                            'type' => 'string',
                            'location' => 'uri'
                        ],
                        'interviewId' => [
                            'type' => 'string',
                            'location' => 'uri'
                        ],
                        'token' => [
                            'type' => 'string',
                            'location' => 'header',
                            'sentAs' => 'X-VisioToken'
                        ],
                    ]
                ],
                'createInterviews' => [
                    'httpMethod' => 'POST',
                    'uri' => '/v2/users/{userId}/recruitments/{recruitementId}/interviews',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'userId' => [
                            'type' => 'string',
                            'location' => 'uri'
                        ],
                        'recruitementId' => [
                            'type' => 'string',
                            'location' => 'uri'
                        ],
                        'interviews' => [
                            'type' => 'array',
                            'location' => 'postField',
                            'items' => [
                                'firstName',
                                'lastName',
                                'email',
                                'gender'
                            ]
                        ],
                        'token' => [
                            'type' => 'string',
                            'location' => 'header',
                            'sentAs' => 'X-VisioToken'
                        ],
                    ]
                ],
                'listCampaigns' => [
                    'httpMethod' => 'GET',
                    'uri' => '/v2/users/{userId}/recruitments',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'userId' => [
                            'type' => 'string',
                            'location' => 'uri'
                        ],
                        'token' => [
                            'type' => 'string',
                            'location' => 'header',
                            'sentAs' => 'X-VisioToken'
                        ],
                    ]
                ]
            ],
            'models' => [
                'getResponse' => [
                    'type' => 'class',
                    'className' => \App\Classes\ApiWrapper\ResponseModel\Visiotalent::class,
                ]
            ]
        ]
    ],
    'easyrecrue' => [
        'description' => [
            'baseUrl' => 'https://api.easyrecrue.com',
            'operations' => [
                'authenticate' => [
                    'httpMethod' => 'POST',
                    'uri' => '/v1/auth.json',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'email' => [
                            'type' => 'string',
                            'location' => 'postField'
                        ],
                        'password' => [
                            'type' => 'string',
                            'location' => 'postField'
                        ]
                    ]
                ],
                'createInterviews' => [
                    'httpMethod' => 'POST',
                    'uri' => '/v1/candidate/invite',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'email' => [
                            'type' => 'string',
                            'location' => 'postField',
                        ],
                        'campaign_id' => [
                            'type' => 'string',
                            'location' => 'postField',
                        ],
                        'first_name' => [
                            'type' => 'string',
                            'location' => 'postField',
                        ],
                        'last_name' => [
                            'type' => 'string',
                            'location' => 'postField',
                        ],
                        'external_data' => [
                            'type' => 'string',
                            'location' => 'postField',
                        ],
                        'token' => [
                            'type' => 'string',
                            'location' => 'header',
                            'sentAs' => 'apikey'
                        ],
                    ]
                ],
                'listInterviews' => [
                    'httpMethod' => 'GET',
                    'uri' => '/v1/application/{id}',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'id' => [
                            'type' => 'string',
                            'location' => 'uri'
                        ],
                        'token' => [
                            'type' => 'string',
                            'location' => 'header',
                            'sentAs' => 'apikey'
                        ],
                    ]
                ],
                'listCampaigns' => [
                    'httpMethod' => 'GET',
                    'uri' => '/v1/campaign/list?status=active',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'token' => [
                            'type' => 'string',
                            'location' => 'header',
                            'sentAs' => 'apikey'
                        ],
                    ]
                ],
                'deleteInterview' => [
                    'httpMethod' => 'POST',
                    'uri' => '/v1/application/erase',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'id' => [
                            'location' => 'postField',
                        ],
                        'token' => [
                            'type' => 'string',
                            'location' => 'header',
                            'sentAs' => 'apikey'
                        ],
                    ]
                ],
                'publicLink' => [
                    'httpMethod' => 'POST',
                    'uri' => '/v1/share/public',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'applications_id' => [
                            'type' => 'array',
                            'location' => 'postField'
                        ],
                        'validity_weeks' => [
                            'type' => 'string',
                            'location' => 'postField'
                        ],
                        'token' => [
                            'type' => 'string',
                            'location' => 'header',
                            'sentAs' => 'apikey'
                        ],

                    ]
                ]
            ],
            'models' => [
                'getResponse' => [
                    'type' => 'class',
                    'className' => \App\Classes\ApiWrapper\ResponseModel\Easyrecrue::class,
                ]
            ]
        ]
    ]
];