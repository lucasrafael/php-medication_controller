<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class BasicTest
 * @package Tests\Feature
 * @author lucasrafael
 */
class BasicTest extends TestCase
{
    /**
     * A basic test for online site.
     *
     * @return void
     */
    public function testSiteUp()
    {
        $response = $this->get('http://[::1]:8080/medicamentos');
        $response->assertStatus(200);
    }
}
