<?php

namespace Tests\Feature\Phones;

use Tests\FeatureTestCase;
use Illuminate\Foundation\Testing\WithFaker;

class PhoneTests extends FeatureTestCase
{
    /**
     * @test
     */
    public function phoneTest() {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
