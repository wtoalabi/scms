<?php

namespace Tests\Feature\Contacts\Contacts;

use Tests\FeatureTestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ContactTests extends FeatureTestCase
{
    /**
     * @test
     */
    public function contactTest() {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
