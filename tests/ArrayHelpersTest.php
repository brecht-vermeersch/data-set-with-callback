<?php

use Lurza\ArrayHelpers\ArrayHelpers;

test('setWithCallback', function () {
    $callback = fn($value) => $value * 2;

    $array = ['products' => ['desk' => ['price' => 100]]];
    ArrayHelpers::setWithCallback($array, 'products.desk.price', $callback);
    $this->assertEquals(['products' => ['desk' => ['price' => 200]]], $array);

    // No key is given
    $array = ['products' => ['desk' => ['price' => 100]]];
    ArrayHelpers::setWithCallback($array, null, $callback);
    $this->assertSame(['products' => ['desk' => ['price' => 100]]], $array);

    // The key doesn't exist at the depth
    $array = ['products' => 'desk'];
    ArrayHelpers::setWithCallback($array, 'products.desk.price', $callback);
    $this->assertSame(['products' => 'desk'], $array);

    // No corresponding key exists
    $array = ['products'];
    ArrayHelpers::setWithCallback($array, 'products.desk.price', $callback);
    $this->assertSame(['products'], $array);

    $array = ['products' => ['desk' => ['price' => 100]]];
    ArrayHelpers::setWithCallback($array, 'table', $callback);
    $this->assertSame(['products' => ['desk' => ['price' => 100]]], $array);

    $array = ['products' => ['desk' => ['price' => 100]]];
    ArrayHelpers::setWithCallback($array, 'table.price', $callback);
    $this->assertSame(['products' => ['desk' => ['price' => 100]]], $array);

    $array = [];
    ArrayHelpers::setWithCallback($array, 'products.desk.price', $callback);
    $this->assertSame([], $array);

    // Override not possible
    $array = ['products' => 'table'];
    ArrayHelpers::setWithCallback($array, 'products.desk.price', $callback);
    $this->assertSame(['products' => 'table'], $array);
});

