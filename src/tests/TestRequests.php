<?php

//    Copyright 2012 Urban Airship
//
//    Licensed under the Apache License, Version 2.0 (the "License");
//    you may not use this file except in compliance with the License.
//    You may obtain a copy of the License at
//
//    http://www.apache.org/licenses/LICENSE-2.0
//
//    Unless required by applicable law or agreed to in writing, software
//    distributed under the License is distributed on an "AS IS" BASIS,
//    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//    See the License for the specific language governing permissions and
//    limitations under the License.


use Httpful\Http;

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Push\Request\IosRegisterTokenRequest;
use UrbanAirship\Push\Request\IosTokenInformationRequest;
use UrbanAirship\Push\Request\IosDeactivateTokenRequest;

class TestRequests extends PHPUnit_Framework_TestCase {

    protected $key;
    protected $secret;
    protected $token;
    protected $payload;

    protected function setUp()
    {
        $this->key = "key";
        $this->secret = "secret";
        $this->token = "token";
        $this->payload = array("payload" => "stuff");
    }

    public function testTokenInformationRequest()
    {

        $infoRequest = IosTokenInformationRequest::request()
            ->setAppKey($this->key)
            ->setAppSecret($this->secret)
            ->setDeviceToken($this->token);
        $request = $infoRequest->buildTokenInformationRequest();
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $request->uri) == 0, "bad url");
        $this->assertTrue(strcmp($request->username, $this->key) == 0, "bad key");
        $this->assertTrue(strcmp($request->password, $this->secret) == 0, "bad secret");
        $this->assertTrue(strcmp($request->method, "GET") == 0, "wront http method");
    }

    public function testIosRegisterTokenRequest(){

        $registrationRequest = IosRegisterTokenRequest::request()
            ->setAppKey($this->key)
            ->setAppSecret($this->secret)
            ->setDeviceToken($this->token);

        $request = $registrationRequest->buildRegistrationRequest();
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $request->uri) == 0, "bad url");
        $this->assertTrue(strcmp($request->username, $this->key) == 0, "bad username");
        $this->assertTrue(strcmp($request->password, $this->secret) == 0, "bad secret");
        $this->assertTrue(strcmp($request->method, "PUT") == 0, "wrong http method");
    }


    public function testDeactivateTokenRequest()
    {
        $deactivateRequest = IosDeactivateTokenRequest::request()
            ->setAppKey($this->key)
            ->setAppSecret($this->secret)
            ->setDeviceToken($this->token);

        $request = $deactivateRequest->buildRegistrationRequest();
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $request->uri) == 0, "bad url");
        $this->assertTrue(strcmp($request->username, $this->key) == 0, "bad username");
        $this->assertTrue(strcmp($request->password, $this->secret) == 0, "bad secret");
        $this->assertTrue(strcmp($request->method, "DELETE") == 0, "wrong http method");

    }




}
