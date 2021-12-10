<?php

function timesTwo(int $value): int
{
    return $value * 2;
}

test('data_set_with_callback and no stars', function () {
    $arr = [1, "foo" => ["bar" => 1], "baz" => 1, "boo" => [1, 1]];

    data_set_with_callback($arr, "noop", "timesTwo");
    $this->assertEquals($arr, [1, "foo" => ["bar" => 1], "baz" => 1, "boo" => [1, 1]]);

    data_set_with_callback($arr, "foo.noop", "timesTwo");
    $this->assertEquals($arr, [1, "foo" => ["bar" => 1], "baz" => 1, "boo" => [1, 1]]);

    data_set_with_callback($arr, "0", "timesTwo");
    $this->assertEquals($arr, [2, "foo" => ["bar" => 1], "baz" => 1, "boo" => [1, 1]]);

    data_set_with_callback($arr, "boo.1", "timesTwo");
    $this->assertEquals($arr, [2, "foo" => ["bar" => 1], "baz" => 1, "boo" => [1, 2]]);

    data_set_with_callback($arr, "baz", "timesTwo");
    $this->assertEquals($arr, [2, "foo" => ["bar" => 1], "baz" => 2, "boo" => [1, 2]]);

    data_set_with_callback($arr, "foo.bar", "timesTwo");
    $this->assertEquals($arr, [2, "foo" => ["bar" => 2], "baz" => 2, "boo" => [1, 2]]);
});

test('data_set_with_callback and one star', function () {
    $arr = [1, 1, 1];

    data_set_with_callback($arr, "*", "timesTwo");
    $this->assertEquals($arr, [2, 2, 2]);

    data_set_with_callback($arr, "foo.*", "timesTwo");
    $this->assertEquals($arr, [2, 2, 2]);

    $arr = ["foo" => [1, 1], "bar" => []];

    data_set_with_callback($arr, "bar.*", "timesTwo");
    $this->assertEquals($arr, ["foo" => [1, 1], "bar" => []]);

    data_set_with_callback($arr, "foo.*", "timesTwo");
    $this->assertEquals($arr, ["foo" => [2, 2], "bar" => []]);

    data_set_with_callback($arr, "foo.*.bar", "timesTwo");
    $this->assertEquals($arr, ["foo" => [2, 2], "bar" => []]);
});

test('data_set_with_callback and two stars', function () {
    $arr = [[1, 1, 1], [1, 1], [1, 1]];

    data_set_with_callback($arr, "*.*", "timesTwo");
    $this->assertEquals($arr, [[2, 2, 2], [2, 2], [2, 2]]);

    $arr = ["foo" => [ ["bar" => 1], ["bar" => 1] ]];

    data_set_with_callback($arr, "foo.*.bar", "timesTwo");
    $this->assertEquals($arr, ["foo" => [ ["bar" => 2], ["bar" => 2] ]]);

    data_set_with_callback($arr, "foo.*.baz", "timesTwo");
    $this->assertEquals($arr, ["foo" => [ ["bar" => 2], ["bar" => 2] ]]);

    data_set_with_callback($arr, "foo.*.baz.bar", "timesTwo");
    $this->assertEquals($arr, ["foo" => [ ["bar" => 2], ["bar" => 2] ]]);

    data_set_with_callback($arr, "foo.*.*.bar", "timesTwo");
    $this->assertEquals($arr, ["foo" => [ ["bar" => 2], ["bar" => 2] ]]);
});


