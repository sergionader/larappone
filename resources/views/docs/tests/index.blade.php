@extends('layouts.master') 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Tests</h1>
            <p>This section shows the API tests, app tests and browser tests. 
                <br>App tests contains some unit test via <a href="https://phpunit.de/">PHPUnit</a> 
                and browser tests via <a href="https://laravel.com/docs/5.5/dusk">Laravel Dusk</a>.
            </p>
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                    <h2 class="box-title">API Tests</h2>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button> -->
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <p>
                        <strong>Tools:</strong>
                        <a href="https://www.getpostman.com/docs/postman/scripts/test_scripts" target="_blank">Postman test scripts</a> and
                        <a href="https://www.npmjs.com/package/newman" target="_blank">newman</a>
                        <br>The test scripts can be found at this
                        <a href="https://www.getpostman.com/collections/0785ce129b2a49ca61bb" target="_blank">Postman collection</a> (search for "tests").
                        <br>Make sure to check the
                        <a href="https://documenter.getpostman.com/view/1542077/laravel_productvisit/6taa4ws" target="_blank">API Documentation</a>
                        <pre><code class="default hljs">
                    newman
                    
                    laravel_productvisit
                    
                    ❏ Users
                    ↳ SIGN IN User api/v1/user/signin/
                      POST http://0.0.0.0:3000/api/v1/user/signin/ [200 OK, 837B, 1396ms]
                      ┌
                      │ 'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiO
                      │ jEsImlzcyI6Imh0dHA6Ly8wLjAuMC4wOjMwMDAvYXBpL3YxL3VzZXI
                      │ vc2lnbmluIiwiaWF0IjoxNTA2ODAwMzIwLCJleHAiOjE1MDY4MTExM
                      │ jAsIm5iZiI6MTUwNjgwMDMyMCwianRpIjoiRVgwajdMZVlySktKNjh
                      │ oaCJ9.19iAa3Gy6Jy2o12lF1L305LF7XVAfAb2ykNwRvIqARc'
                      └
                      ✓  Body matches string <token>
                      ✓  Response Code 200
                    
                    ↳ STORE user /api/v1/user/
                      POST http://0.0.0.0:3000/api/v1/user [201 Created, 842B, 1151ms]
                      ┌
                      │ 'msg: User created'
                      └
                      ✓  Response Code 200
                      ✓  Gets the correct success msg
                    
                    ❏ Visits
                    ↳ SHOW ALL visits /api/v1/visit/
                      GET http://0.0.0.0:3000/api/v1/visit/ [200 OK, 213.59KB, 835ms]
                      ┌
                      │ 'msg: List of all visits'
                      └
                      ✓  Response Code 200
                      ✓  Gets the correct success msg
                    
                    ↳ SHOW /api/v1/visit/{id}
                      GET http://0.0.0.0:3000/api/v1/visit/1 [200 OK, 2.49KB, 714ms]
                      ┌
                      │ 'msg: Visit fetched. ID: 1'
                      └
                      ✓  Response Code 200
                      ✓  Gets the correct success msg
                    
                    ↳ STORE  a visit api/v1/visit/
                      POST http://0.0.0.0:3000/api/v1/visit?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly8wLjAuMC4wOjMwMDAvYXBpL3YxL3VzZXIvc2lnbmluIiwiaWF0IjoxNTA2ODAwMzIwLCJleHAiOjE1MDY4MTExMjAsIm5iZiI6MTUwNjgwMDMyMCwianRpIjoiRVgwajdMZVlySktKNjhoaCJ9.19iAa3Gy6Jy2o12lF1L305LF7XVAfAb2ykNwRvIqARc [201 Created, 1.13KB, 917ms]
                      ┌
                      │ 'msg: Visit created. ID: 324'
                      └
                      ✓  Response Code 201
                      ✓  Gets the correct success msg
                    
                    ↳ UPDATE  a visit api/v1/visit/{id}
                      PUT http://0.0.0.0:3000/api/v1/visit/280?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly8wLjAuMC4wOjMwMDAvYXBpL3YxL3VzZXIvc2lnbmluIiwiaWF0IjoxNTA2ODAwMzIwLCJleHAiOjE1MDY4MTExMjAsIm5iZiI6MTUwNjgwMDMyMCwianRpIjoiRVgwajdMZVlySktKNjhoaCJ9.19iAa3Gy6Jy2o12lF1L305LF7XVAfAb2ykNwRvIqARc [200 OK, 1.49KB, 896ms]
                      ┌
                      │ 'msg: Visit updated'
                      └
                      ✓  Response Code 200
                      ✓  Gets the correct success msg
                    
                    ↳ DESTROY a visit /api/v1/visit/{id}
                      DELETE http://0.0.0.0:3000/api/v1/visit/324?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly8wLjAuMC4wOjMwMDAvYXBpL3YxL3VzZXIvc2lnbmluIiwiaWF0IjoxNTA2ODAwMzIwLCJleHAiOjE1MDY4MTExMjAsIm5iZiI6MTUwNjgwMDMyMCwianRpIjoiRVgwajdMZVlySktKNjhoaCJ9.19iAa3Gy6Jy2o12lF1L305LF7XVAfAb2ykNwRvIqARc [200 OK, 1.02KB, 793ms]
                      ┌
                      │ 'msg: Visit deleted. ID: 324'
                      └
                      ✓  Response Code 200
                      ✓  Gets the correct success msg
                    
                    ❏ Products
                    ↳ SHOW ALL /api/v1/product/{id}
                      GET http://0.0.0.0:3000/api/v1/product/11 [200 OK, 730B, 620ms]
                      ┌
                      │ 'msg: Product fetched. ID: 11'
                      └
                      ✓  Response Code 200
                      ✓  Gets the correct success msg
                    
                    ↳ DESTROY (product(s) under visit) /api/v1/product/{visit_id}?product_id[]={id}&product_id[]={id}&token=\{\{jwt_token}}
                      DELETE http://0.0.0.0:3000/api/v1/product/280?product_id[]=31&product_id[]=11&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly8wLjAuMC4wOjMwMDAvYXBpL3YxL3VzZXIvc2lnbmluIiwiaWF0IjoxNTA2ODAwMzIwLCJleHAiOjE1MDY4MTExMjAsIm5iZiI6MTUwNjgwMDMyMCwianRpIjoiRVgwajdMZVlySktKNjhoaCJ9.19iAa3Gy6Jy2o12lF1L305LF7XVAfAb2ykNwRvIqARc [200 OK, 630B, 824ms]
                      ┌
                      │ 'msg: {"msg":"Product ID: [\\"31\\",\\"11\\"] deleted 
                      │ from visit id: 280"}'
                      └
                      ✓  Body matches string - Product ID:
                      ✓  Response Code 200
                    
                    ┌─────────────────────────┬──────────┬──────────┐
                    │                         │ executed │   failed │
                    ├─────────────────────────┼──────────┼──────────┤
                    │              iterations │        1 │        0 │
                    ├─────────────────────────┼──────────┼──────────┤
                    │                requests │        9 │        0 │
                    ├─────────────────────────┼──────────┼──────────┤
                    │            test-scripts │        9 │        0 │
                    ├─────────────────────────┼──────────┼──────────┤
                    │      prerequest-scripts │        0 │        0 │
                    ├─────────────────────────┼──────────┼──────────┤
                    │              assertions │       18 │        0 │
                    ├─────────────────────────┴──────────┴──────────┤
                    │ total run duration: 9s                        │
                    ├───────────────────────────────────────────────┤
                    │ total data received: 217.71KB (approx)        │
                    ├───────────────────────────────────────────────┤
                    │ average response time: 905ms                  │
                    └───────────────────────────────────────────────┘
                        </code></pre>
                    </p>
                    <p>
                    Test Results using Postman Runner
                    </p>
<pre><code>
    {
        "id": "ea069ee7-b434-4c5a-9476-d12a7b72b328",
        "name": "larappone",
        "allTests": [],
        "timestamp": "2017-12-29T23:14:55.193Z",
        "collection_id": "2d1e4ee1-8a33-13d7-35d2-444db890d018",
        "folder_id": 0,
        "target_type": "collection",
        "environment_id": "3cf43e5f-faa7-9fd7-0a60-8a78ebee9322",
        "data": [],
        "delay": 0,
        "count": 1,
        "collection": {
            "id": "2d1e4ee1-8a33-13d7-35d2-444db890d018",
            "name": "larappone",
            "description": "",
            "order": [
                "998e2f77-2d9a-1e7d-ac33-04a1f5546055"
            ],
            "folders": [
                {
                    "owner": "1542077",
                    "lastUpdatedBy": "1542077",
                    "lastRevision": 2841540416,
                    "collection": "2d1e4ee1-8a33-13d7-35d2-444db890d018",
                    "folder": null,
                    "id": "a5555036-819c-f7fa-d30d-b35d082edbac",
                    "name": "Products",
                    "description": "",
                    "variables": null,
                    "auth": null,
                    "events": null,
                    "order": [
                        "ea37d0b1-2abb-e078-f5eb-530fb313f38c",
                        "38c45d93-4994-dd54-d708-b5d5178f583a"
                    ],
                    "folders_order": [],
                    "createdAt": "2017-12-20T02:13:20.000Z",
                    "updatedAt": "2017-12-20T02:13:21.000Z",
                    "write": true,
                    "collection_id": "2d1e4ee1-8a33-13d7-35d2-444db890d018"
                },
                {
                    "owner": "1542077",
                    "lastUpdatedBy": "1542077",
                    "lastRevision": 2841540417,
                    "collection": "2d1e4ee1-8a33-13d7-35d2-444db890d018",
                    "folder": null,
                    "id": "ef390923-ab85-930c-aef3-421f4bbc54e2",
                    "name": "Users",
                    "description": "",
                    "variables": null,
                    "auth": null,
                    "events": null,
                    "order": [
                        "47910895-857d-6799-a357-863655d8b7ec",
                        "23b85097-cc58-2fbd-af7f-468582086f93"
                    ],
                    "folders_order": [],
                    "createdAt": "2017-12-20T02:13:20.000Z",
                    "updatedAt": "2017-12-20T02:13:21.000Z",
                    "write": true,
                    "collection_id": "2d1e4ee1-8a33-13d7-35d2-444db890d018"
                },
                {
                    "owner": "1542077",
                    "lastUpdatedBy": "1542077",
                    "lastRevision": 2841540419,
                    "collection": "2d1e4ee1-8a33-13d7-35d2-444db890d018",
                    "folder": null,
                    "id": "d051fdb4-dfcb-a02a-4395-1c51ec219521",
                    "name": "Visits",
                    "description": "",
                    "variables": null,
                    "auth": null,
                    "events": null,
                    "order": [
                        "a135ea25-a5a7-c6b5-00be-32ebb715fef7",
                        "71ba1307-72a6-3ebe-2c58-d08aa82199bc",
                        "5297a560-4f04-d160-9e85-47e3530e7954",
                        "24417683-746c-7df1-08a6-734d6dce89d6",
                        "4f89ed03-8b1c-91f3-1ed9-f66cbe658616"
                    ],
                    "folders_order": [],
                    "createdAt": "2017-12-20T02:13:20.000Z",
                    "updatedAt": "2017-12-20T02:13:21.000Z",
                    "write": true,
                    "collection_id": "2d1e4ee1-8a33-13d7-35d2-444db890d018"
                }
            ],
            "folders_order": [
                "ef390923-ab85-930c-aef3-421f4bbc54e2",
                "d051fdb4-dfcb-a02a-4395-1c51ec219521",
                "a5555036-819c-f7fa-d30d-b35d082edbac"
            ],
            "timestamp": 0,
            "synced": true,
            "remote_id": 1056902,
            "owner": "1542077",
            "sharedWithTeam": false,
            "subscribed": false,
            "remoteLink": "https://www.getpostman.com/collections/0785ce129b2a49ca61bb",
            "remoteLinkUpdatedAt": 1514588066565,
            "public": false,
            "createdAt": "2017-12-20T02:13:20.000Z",
            "updatedAt": 1514588066584,
            "write": true,
            "published": false,
            "favorite": true,
            "permissions": {},
            "syncedPermissions": {},
            "events": null,
            "variables": null,
            "auth": null
        },
        "folder": null,
        "environment": null,
        "globals": [
            {
                "key": "token",
                "value": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly8wLjAuMC4wOjMwMDAvYXBpL3YxL3VzZXIvc2lnbmluIiwiaWF0IjoxNTA2Nzg2MjkzLCJleHAiOjE1MDY3OTcwOTMsIm5iZiI6MTUwNjc4NjI5MywianRpIjoiWEN4TUtxSjhsZWhMdmZEZiJ9.3zkeSjiugn1p6Vx4UJDMzlkTxJFF4y4uFhCihpgvDV0",
                "enabled": true,
                "type": "text"
            },
            {
                "key": "jwt_token",
                "value": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly8wLjAuMC4wOjMwMDAvYXBpL3YxL3VzZXIvc2lnbmluIiwiaWF0IjoxNTA2Nzg3MjM2LCJleHAiOjE1MDY3OTgwMzYsIm5iZiI6MTUwNjc4NzIzNiwianRpIjoiNXUyM0RVVE9uS08zWnJreiJ9.fE5ACpZb1JwJbxcq368gEK7BrciRF22e67RFMsnojc8",
                "enabled": true,
                "type": "text"
            }
        ],
        "results": [
            {
                "name": "SIGN IN User api/v1/user/signin/",
                "id": "47910895-857d-6799-a357-863655d8b7ec",
                "url": "http://app.thedevproject.info/api/v1/user/signin",
                "totalTime": 0,
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "tests": {
                    "Body matches string <token>": true,
                    "Response Code 200": true
                },
                "testPassFailCounts": {
                    "Body matches string <token>": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    }
                },
                "times": [
                    "235"
                ],
                "allTests": [
                    {
                        "Body matches string <token>": true,
                        "Response Code 200": true
                    }
                ],
                "time": "235",
                "totalRequestTime": "235",
                "iterationResults": {}
            },
            {
                "name": "STORE user /api/v1/user/",
                "id": "23b85097-cc58-2fbd-af7f-468582086f93",
                "url": "http://app.thedevproject.info/api/v1/user",
                "totalTime": 0,
                "responseCode": {
                    "code": 201,
                    "name": "Created",
                    "detail": {
                        "name": "Created",
                        "detail": "The request has been fulfilled and resulted in a new resource being created."
                    }
                },
                "tests": {
                    "Response Code 200": true,
                    "Gets the correct success msg": true
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                },
                "times": [
                    "171"
                ],
                "allTests": [
                    {
                        "Response Code 200": true,
                        "Gets the correct success msg": true
                    }
                ],
                "time": "171",
                "totalRequestTime": "171",
                "iterationResults": {}
            },
            {
                "name": "SHOW ALL visits /api/v1/visit/",
                "id": "a135ea25-a5a7-c6b5-00be-32ebb715fef7",
                "url": "http://app.thedevproject.info/api/v1/visit/",
                "totalTime": 0,
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "tests": {
                    "Response Code 200": true,
                    "Gets the correct success msg": true
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                },
                "times": [
                    "568"
                ],
                "allTests": [
                    {
                        "Response Code 200": true,
                        "Gets the correct success msg": true
                    }
                ],
                "time": "568",
                "totalRequestTime": "568",
                "iterationResults": {}
            },
            {
                "name": "SHOW /api/v1/visit/{id}",
                "id": "71ba1307-72a6-3ebe-2c58-d08aa82199bc",
                "url": "http://app.thedevproject.info/api/v1/visit/1",
                "totalTime": 0,
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "tests": {
                    "Response Code 200": true,
                    "Gets the correct success msg": true
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                },
                "times": [
                    "196"
                ],
                "allTests": [
                    {
                        "Response Code 200": true,
                        "Gets the correct success msg": true
                    }
                ],
                "time": "196",
                "totalRequestTime": "196",
                "iterationResults": {}
            },
            {
                "name": "STORE  a visit api/v1/visit/",
                "id": "5297a560-4f04-d160-9e85-47e3530e7954",
                "url": "http://app.thedevproject.info/api/v1/visit?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly9hcHAudGhlZGV2cHJvamVjdC5pbmZvL2FwaS92MS91c2VyL3NpZ25pbiIsImlhdCI6MTUxNDU4OTg5MCwiZXhwIjoxNTE0NjAwNjkwLCJuYmYiOjE1MTQ1ODk4OTAsImp0aSI6IjJmaTFtOVYzWnBacWl4aWMifQ.GprgqhqpJb7s77dZIEf1Z3Qt23I8T915O8t17kvAy8Y",
                "totalTime": 0,
                "responseCode": {
                    "code": 201,
                    "name": "Created",
                    "detail": {
                        "name": "Created",
                        "detail": "The request has been fulfilled and resulted in a new resource being created."
                    }
                },
                "tests": {
                    "Response Code 201": true,
                    "Gets the correct success msg": true
                },
                "testPassFailCounts": {
                    "Response Code 201": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                },
                "times": [
                    "659"
                ],
                "allTests": [
                    {
                        "Response Code 201": true,
                        "Gets the correct success msg": true
                    }
                ],
                "time": "659",
                "totalRequestTime": "659",
                "iterationResults": {}
            },
            {
                "name": "UPDATE  a visit api/v1/visit/{id}",
                "id": "24417683-746c-7df1-08a6-734d6dce89d6",
                "url": "http://app.thedevproject.info/api/v1/visit/2?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly9hcHAudGhlZGV2cHJvamVjdC5pbmZvL2FwaS92MS91c2VyL3NpZ25pbiIsImlhdCI6MTUxNDU4OTI5NSwiZXhwIjoxNTE0NjAwMDk1LCJuYmYiOjE1MTQ1ODkyOTUsImp0aSI6Ijhma3E2ZWFMYmlMam4xSTcifQ.KTqODGUtauF7XIvWVk8JSWXz4RsW6RODej19tRWNyTo",
                "totalTime": 0,
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "tests": {
                    "Response Code 200": true,
                    "Gets the correct success msg": true
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                },
                "times": [
                    "906"
                ],
                "allTests": [
                    {
                        "Response Code 200": true,
                        "Gets the correct success msg": true
                    }
                ],
                "time": "906",
                "totalRequestTime": "906",
                "iterationResults": {}
            },
            {
                "name": "DESTROY a visit /api/v1/visit/{id}",
                "id": "4f89ed03-8b1c-91f3-1ed9-f66cbe658616",
                "url": "http://app.thedevproject.info/api/v1/visit/20?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly9hcHAudGhlZGV2cHJvamVjdC5pbmZvL2FwaS92MS91c2VyL3NpZ25pbiIsImlhdCI6MTUxNDU4OTI5NSwiZXhwIjoxNTE0NjAwMDk1LCJuYmYiOjE1MTQ1ODkyOTUsImp0aSI6Ijhma3E2ZWFMYmlMam4xSTcifQ.KTqODGUtauF7XIvWVk8JSWXz4RsW6RODej19tRWNyTo",
                "totalTime": 0,
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "tests": {
                    "Response Code 200": true,
                    "Gets the correct success msg": true
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                },
                "times": [
                    "393"
                ],
                "allTests": [
                    {
                        "Response Code 200": true,
                        "Gets the correct success msg": true
                    }
                ],
                "time": "393",
                "totalRequestTime": "393",
                "iterationResults": {}
            },
            {
                "name": "SHOW /api/v1/product/{id}",
                "id": "ea37d0b1-2abb-e078-f5eb-530fb313f38c",
                "url": "http://app.thedevproject.info/api/v1/product/1",
                "totalTime": 0,
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "tests": {
                    "Response Code 200": true,
                    "Gets the correct success msg": true
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                },
                "times": [
                    "81"
                ],
                "allTests": [
                    {
                        "Response Code 200": true,
                        "Gets the correct success msg": true
                    }
                ],
                "time": "81",
                "totalRequestTime": "81",
                "iterationResults": {}
            },
            {
                "name": "DESTROY (product(s) under visit) /api/v1/product/{visit_id}?product_id[]={id}&product_id[]={id}&token=\{\{jwt_token}}",
                "id": "38c45d93-4994-dd54-d708-b5d5178f583a",
                "url": "http://app.thedevproject.info/api/v1/product/2?product_id[]=17&product_id[]=21&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly9hcHAudGhlZGV2cHJvamVjdC5pbmZvL2FwaS92MS91c2VyL3NpZ25pbiIsImlhdCI6MTUxNDU4OTI5NSwiZXhwIjoxNTE0NjAwMDk1LCJuYmYiOjE1MTQ1ODkyOTUsImp0aSI6Ijhma3E2ZWFMYmlMam4xSTcifQ.KTqODGUtauF7XIvWVk8JSWXz4RsW6RODej19tRWNyTo",
                "totalTime": 0,
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "tests": {
                    "Body matches string - Product ID:": true,
                    "Response Code 200": true
                },
                "testPassFailCounts": {
                    "Body matches string - Product ID:": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    }
                },
                "times": [
                    "290"
                ],
                "allTests": [
                    {
                        "Body matches string - Product ID:": true,
                        "Response Code 200": true
                    }
                ],
                "time": "290",
                "totalRequestTime": "290",
                "iterationResults": {}
            },
        ],
        "totalPass": 18,
        "totalFail": 0,
        "totalTime": 3224,
        "lifecycle": "done",
        "requests": [
            {
                "name": "SIGN IN User api/v1/user/signin/",
                "id": "47910895-857d-6799-a357-863655d8b7ec",
                "url": "http://app.thedevproject.info/api/v1/user/signin",
                "time": "2017-12-29T23:14:55.193Z",
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "testPassFailCounts": {
                    "Body matches string <token>": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    }
                }
            },
            {
                "name": "STORE user /api/v1/user/",
                "id": "23b85097-cc58-2fbd-af7f-468582086f93",
                "url": "http://app.thedevproject.info/api/v1/user",
                "time": "2017-12-29T23:14:55.193Z",
                "responseCode": {
                    "code": 201,
                    "name": "Created",
                    "detail": {
                        "name": "Created",
                        "detail": "The request has been fulfilled and resulted in a new resource being created."
                    }
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                }
            },
            {
                "name": "SHOW ALL visits /api/v1/visit/",
                "id": "a135ea25-a5a7-c6b5-00be-32ebb715fef7",
                "url": "http://app.thedevproject.info/api/v1/visit/",
                "time": "2017-12-29T23:14:55.193Z",
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                }
            },
            {
                "name": "SHOW /api/v1/visit/{id}",
                "id": "71ba1307-72a6-3ebe-2c58-d08aa82199bc",
                "url": "http://app.thedevproject.info/api/v1/visit/1",
                "time": "2017-12-29T23:14:55.193Z",
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                }
            },
            {
                "name": "STORE  a visit api/v1/visit/",
                "id": "5297a560-4f04-d160-9e85-47e3530e7954",
                "url": "http://app.thedevproject.info/api/v1/visit?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly9hcHAudGhlZGV2cHJvamVjdC5pbmZvL2FwaS92MS91c2VyL3NpZ25pbiIsImlhdCI6MTUxNDU4OTI5NSwiZXhwIjoxNTE0NjAwMDk1LCJuYmYiOjE1MTQ1ODkyOTUsImp0aSI6Ijhma3E2ZWFMYmlMam4xSTcifQ.KTqODGUtauF7XIvWVk8JSWXz4RsW6RODej19tRWNyTo",
                "time": "2017-12-29T23:14:55.193Z",
                "responseCode": {
                    "code": 201,
                    "name": "Created",
                    "detail": {
                        "name": "Created",
                        "detail": "The request has been fulfilled and resulted in a new resource being created."
                    }
                },
                "testPassFailCounts": {
                    "Response Code 201": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                }
            },
            {
                "name": "UPDATE  a visit api/v1/visit/{id}",
                "id": "24417683-746c-7df1-08a6-734d6dce89d6",
                "url": "http://app.thedevproject.info/api/v1/visit/2?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly9hcHAudGhlZGV2cHJvamVjdC5pbmZvL2FwaS92MS91c2VyL3NpZ25pbiIsImlhdCI6MTUxNDU4OTI5NSwiZXhwIjoxNTE0NjAwMDk1LCJuYmYiOjE1MTQ1ODkyOTUsImp0aSI6Ijhma3E2ZWFMYmlMam4xSTcifQ.KTqODGUtauF7XIvWVk8JSWXz4RsW6RODej19tRWNyTo",
                "time": "2017-12-29T23:14:55.193Z",
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                }
            },
            {
                "name": "DESTROY a visit /api/v1/visit/{id}",
                "id": "4f89ed03-8b1c-91f3-1ed9-f66cbe658616",
                "url": "http://app.thedevproject.info/api/v1/visit/20?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly9hcHAudGhlZGV2cHJvamVjdC5pbmZvL2FwaS92MS91c2VyL3NpZ25pbiIsImlhdCI6MTUxNDU4OTI5NSwiZXhwIjoxNTE0NjAwMDk1LCJuYmYiOjE1MTQ1ODkyOTUsImp0aSI6Ijhma3E2ZWFMYmlMam4xSTcifQ.KTqODGUtauF7XIvWVk8JSWXz4RsW6RODej19tRWNyTo",
                "time": "2017-12-29T23:14:55.193Z",
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                }
            },
            {
                "name": "SHOW /api/v1/product/{id}",
                "id": "ea37d0b1-2abb-e078-f5eb-530fb313f38c",
                "url": "http://app.thedevproject.info/api/v1/product/1",
                "time": "2017-12-29T23:14:55.193Z",
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "testPassFailCounts": {
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Gets the correct success msg": {
                        "pass": 1,
                        "fail": 0
                    }
                }
            },
            {
                "name": "DESTROY (product(s) under visit) /api/v1/product/{visit_id}?product_id[]={id}&product_id[]={id}&token=\{\{jwt_token}}",
                "id": "38c45d93-4994-dd54-d708-b5d5178f583a",
                "url": "http://app.thedevproject.info/api/v1/product/2?product_id[]=17&product_id[]=21&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly9hcHAudGhlZGV2cHJvamVjdC5pbmZvL2FwaS92MS91c2VyL3NpZ25pbiIsImlhdCI6MTUxNDU4OTI5NSwiZXhwIjoxNTE0NjAwMDk1LCJuYmYiOjE1MTQ1ODkyOTUsImp0aSI6Ijhma3E2ZWFMYmlMam4xSTcifQ.KTqODGUtauF7XIvWVk8JSWXz4RsW6RODej19tRWNyTo",
                "time": "2017-12-29T23:14:55.193Z",
                "responseCode": {
                    "code": 200,
                    "name": "OK",
                    "detail": {
                        "name": "OK",
                        "detail": "Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action."
                    }
                },
                "testPassFailCounts": {
                    "Body matches string - Product ID:": {
                        "pass": 1,
                        "fail": 0
                    },
                    "Response Code 200": {
                        "pass": 1,
                        "fail": 0
                    }
                }
            }
        ],
        "synced": false
    }
</code></pre>

                </div>
            </div>
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                    <h2 class="box-title">App Tests</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <p>Unit tests can be found at
                        <code>./tests/Feature</code>
                    </p>
                    <p>Below there is one of them:</p>
                    <pre><code class="php">
    /** PHP
    namespace Tests\Feature;

    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithoutMiddleware;
    use Illuminate\Foundation\Testing\DatabaseMigrations;
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use App\Visit;
    use App\Product;

    class VisitTest extends TestCase
    {
        /**
            * Add Visit and its products using a factory model. 
            *
            * @return void
            */
        public function testVisit()
        {
            $newRecord = factory(Visit::class)->create();
            $newRecordID = $newRecord->id;
            $max= rand(1,10);
            for ($i = 0; $i<$max ; $i++){
                $product_id = Product::inRandomOrder()->first()->id;
                $qtd    = rand(0,15);
                $amount =rand(0,500);
                if ($qtd== 0){
                    $amount = 0;
                }
                $newRecord->products()->attach([$product_id],  ['qtd' => $qtd, 'amount' => $amount]);
            }
            $model=[
                'data' =>Visit::find($newRecordID)
            ];
            $model  = (array)$model;
            $this->assertTrue($model['data']['id'] == $newRecordID);
        }
    }
                          </code>
                      </pre>
                      Here is the result: 
                      <pre><code class="bash">
    $ ./vendor/bin/phpunit
    PHPUnit 6.4.4 by Sebastian Bergmann and contributors.

    "visit id 371"
    "assertTrue($model['data']['id'] == 371)"
    .                                                                   1 / 1 (100%)

    Time: 317 ms, Memory: 24.00MB

    OK (1 test, 1 assertion)
                    </code></pre>

                      
                </div>
            </div>
            <div class="box box-primary collapsed-box">
                    <div class="box-header with-border">
                        <h2 class="box-title">Browser Tests</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                            <p>Unit tests can be found at
                                    <code>./tests/Browser</code>
                                </p>
                            Login page
                            <pre><code class="php">
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
            ->waitForText('Login')
            ->assertSee('Login');
        });
    }
                            </code></pre>

                            Login Test
                            <pre><code class="php">
    public function testLogin()
    {
        $user = 'user1@example.org';
        $password = 'test1234';
        $this->browse(function ($browser) use ($user, $password) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', $user)
                ->type('password', $password)
                ->click('@login-button')
                ->waitForText('John')
                ->assertSee('John');
        });
    }
                            </code></pre>
                        Adds a visit and tries to edit the visit id=1
                        <pre><code class="php">
    public function testVisitAdd()
    {
        $user = 'user1@example.org';
        $password = 'test1234';
        $this->browse(function ($first, $second) use ($user, $password) {
            $first->loginAs(User::find(1))
            ->visit('http://127.0.0.1:8000/login')
            ->waitForText('Login')
            ->type('email', $user)
            ->type('password', $password)
            ->click('@login-button')
            ->waitForText('LarAppOne')
            ->visit('http://127.0.0.1:8000/app/create')
            ->waitForText('Unit')
            ->type('#dt', '11-15-2017')
            ->type('#tm', '12:30:00')
            ->select('profile_id', rand(1, 10))
            ->select('origin_id', rand(1, 9))
            ->select('products[]', rand(1, 30))
            ->type('#qtd', rand(1, 6))
            ->type('#amount', rand(15, 500))
            ->type('avg', 10)
            ->type('max', 20)
            ->type('min', 30)
            ->type('prec', 40)
            ->type('comment', 'lorem ipsum')
            ->click('#save-button')
            ->waitForText('Data saved!')
            ->visit('http://127.0.0.1:8000/app/edit/1')
            ->waitForText('Data Edit')
            ->select('profile_id', 1)
            ->select('origin_id', 1)
            ->click('#submit-update')
            ->waitForText('Data updated!')
            ->assertSee('Data updated!');
        });
    }
                </code></pre>
                Results:
                <pre><code class="bash">
    $ php artisan dusk
    PHPUnit 6.4.4 by Sebastian Bergmann and contributors.
    
    ...                                                                 3 / 3 (100%)
    
    Time: 33.48 seconds, Memory: 12.00MB
    
    OK (3 tests, 3 assertions)
            </code></pre>

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection