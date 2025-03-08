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
        $attributes = $data;
        $attributes['price'] = $data['price'][1];
        Apartment::factory()->create($attributes);

        $response = $this->postJson(route('search'), $data);
        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('data')
                ->has('pagination')
                ->where('data.0.name', $attributes['name'])
                ->where('data.0.bedrooms', $attributes['bedrooms'])
                ->where('data.0.bathrooms', $attributes['bathrooms'])
                ->where('data.0.storeys', $attributes['storeys'])
                ->where('data.0.price', number_format($attributes['price']))
            );

        $this->assertNotEmpty($response->json('data'));
    }

    public static function dataProvider(): array
    {
        return [
            [
                [
                    'name' => 'name',
                    'price' => [0, 5000],
                    'bathrooms' => 2,
                    'bedrooms' => 4,
                    'storeys' => 5,
                    'garages' => 1
                ],
                [
                    'name' => 'name',
                    'price' => [1000, 3000],
                    'bathrooms' => 1,
                    'bedrooms' => 2,
                    'storeys' => 1,
                    'garages' => 2
                ],
            ]
        ];
    }
}
