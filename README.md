# data_set_with_callback()

[![Latest Stable Version](http://poser.pugx.org/lurza/data-set-with-callback/v)](https://packagist.org/packages/lurza/data-set-with-callback)
[![Total Downloads](http://poser.pugx.org/lurza/data-set-with-callback/downloads)](https://packagist.org/packages/lurza/data-set-with-callback)
![Tests](https://github.com/lurza/data-set-with-callback/actions/workflows/tests.yaml/badge.svg)
![StyleCI](https://github.styleci.io/repos/436657038/shield?style=flat)

## Installation

You can install the package via composer

```bash
composer require lurza/data-set-with-callback 
```

## Documentation

The **data_set_with_callback** function sets a value within a nested array using "dot" notation by passing the original value to a callback:

```php
$data = ['products' => ['desk' => ['price' => 100]]];

data_set_with_callback($data, 'products.desk.price', fn($value) => $value * 2);

// ['products' => ['desk' => ['price' => 200]]]
```

This function also accepts wildcards using asterisks and will set values on the target accordingly:

```php
$data = [
    'products' => [
        ['name' => 'Desk 1', 'price' => 100],
        ['name' => 'Desk 2', 'price' => 150],
    ],
];

data_set_with_callback($data, 'products.*.price', fn($value) => $value * 2);

/*
    [
        'products' => [
            ['name' => 'Desk 1', 'price' => 200],
            ['name' => 'Desk 2', 'price' => 300],
        ],
    ]
*/
```

The function is heavily inspired by the Laravel **data_set** function.
