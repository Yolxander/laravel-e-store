<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/shop');
        
        $response->assertSee('In stock');


    }

    public function featured_product_is_visible()
    {
        
        $featuredProduct = factory(Product::class)->create([
            'name' => 'Laptop 1',
        ]);

        
        $response = $this->get('/shop');

        $response->assertSee($featuredProduct->name);
        $response->assertSee('$1499.99');
    }
}
