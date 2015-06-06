<?php

class UserTest extends TestCase {

    /**
     * We correctly create a new user given the auth token.
     */
    public function testCreate()
    {
        $auth_token = 'r56dc557c75';

        $serverParams = [
            'CONTENT_TYPE'      => 'application/json',
            'HTTP_X-AUTH-TOKEN' => $auth_token
        ];

        $response = $this->call('POST', '/v1/users',[],[],[], $serverParams);

        $this->assertResponseStatus(201, "The request is failing");

        $json = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $json, "The response has a wrong structure");
        $this->assertTrue(isset($json['data']['auth_token']), "It doesn't return the auth token");
        $this->assertEquals($json['data']['auth_token'], $auth_token, "The auth token is not the same");
    }

    /**
     * It detects correctly that we are not sending the auth token.
     */
    public function testCreateWithNoAuthToken()
    {
        $response = $this->call('POST', '/v1/users');

        $this->assertResponseStatus(400, "The request has passed through without auth token");
    }

    /**
     * We are sending detects correctly that we are not sending the auth token.
     */
    public function testCreateWithAuthTokenWhichExisted()
    {
        $auth_token = 'r56dc557c75';

        $serverParams = [
            'CONTENT_TYPE'      => 'application/json',
            'HTTP_X-AUTH-TOKEN' => $auth_token
        ];

        $response = $this->call('POST', '/v1/users',[],[],[], $serverParams);

        $this->assertResponseStatus(201, "The request is failing");
    }

}
