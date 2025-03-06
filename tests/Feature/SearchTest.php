<?php

namespace Feature;

use App\Models\Apartment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @dataProvider dataProvider
     */
    public function can_get_results_search_by_price($data)
    {
        Apartment::factory(5)->create([
            'price' => 20000
        ]);
        Apartment::factory(5)->create([
            'price' => 50000
        ]);

        $response = $this->postJson(route('search'), $data);
        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('data')
                ->has('pagination')
            );

        $this->assertNotEmpty($response->json('data'));
    }

    public static function dataProvider(): array
    {
        return [
            [
                ['price' => [0, 5000]],
                ['price' => [2000, 5000]],
                ['name' => 'name'],
                ['bathrooms' => 2],
                ['bedrooms' => 4],
                ['storeys' => 5],
                ['garages' => 1],
            ]
        ];
    }
}
