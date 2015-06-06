<?php

class GenreTest extends TestCase {

    /**
     * We correctly return the list of genres.
     *
     * @return void
     */
    public function testList()
    {
        $response = $this->call('GET', '/v1/genres');
        $this->assertResponseOk();

        $json = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $json);
        $this->assertGreaterThan(1, count($json['data']));
    }

}
