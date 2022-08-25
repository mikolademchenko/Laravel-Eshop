<?php

namespace Tests\Feature\Modules\Cart\Http\Controllers;

use Tests\TestCase;

/**
 * @see \Modules\Cart\Http\Controllers\CartController
 */
class CartControllerTest extends TestCase
{
    /**
     * @test
     */
    public function add_to_cart_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('add-to-cart', ['slug' => $slug]));

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function cart_delete_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('cart-delete', ['id' => $id]));

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function cart_update_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->post(route('cart-update'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function checkout_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('checkout'));

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function single_add_to_cart_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->post(route('single-add-to-cart'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function singleaddtocart_validates_with_a_form_request()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Cart\Http\Controllers\CartController::class,
            'singleAddToCart',
            \Modules\Cart\Http\Requests\AddToCartSingle::class
        );
    }

    // test cases...
}
