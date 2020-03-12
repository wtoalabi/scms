<?php

namespace Tests\Feature\Groups;

use Tests\FeatureTestCase;
use Illuminate\Foundation\Testing\WithFaker;

class GroupTests extends FeatureTestCase
{
    /**
     * @test
     */
    public function groupTest() {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
