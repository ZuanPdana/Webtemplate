<?php

it('shows the checkout page', function () {
    $response = $this->get('/checkout');

    $response->assertOk();
    $response->assertSee('Checkout');
    $response->assertSee('Kembali ke produk');
});
