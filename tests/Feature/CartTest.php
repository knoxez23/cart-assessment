<?php
namespace Tests\Feature;

use Tests\TestCase;

class CartTest extends TestCase
{
    public function test_add_to_cart()
    {
        $response = $this->postJson('/api/cart/add', [
            'product' => ['id' => 1, 'name' => 'Product 1'],
            'quantity' => 2
        ]);
        $response->assertStatus(200);
    }
}