<?php

use PHPUnit\Framework\TestCase;

class ArraysTest extends TestCase
{
    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     */
    public function testIntegerKey()
    {
        $arr = [];
        $arr[] = 'a';
        $arr[] = 'b';
        $arr[] = 'c';

        // Which index will have 'c'?
        $this->assertEquals(2, array_key_last($arr));

        $arr[10] = 'd';
        $arr[] = 'e';

        // Which index will have 'e'?
        $this->assertEquals(11, array_key_last($arr));

        $arr['string'] = 'f';
        $arr[] = 'h';

        // Which index will have 'h'?
        $this->assertEquals(12, array_key_last($arr));
    }

    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     */
    public function testKeyCasting()
    {
        $arr = [];
        $arr[] = 'a';
        $arr["1"] = 'b';
        $arr["01"] = 'c';
        $arr[true] = 'd';
        $arr[0.5] = 'e';
        $arr[false] = 'f';
        $arr[null] = 'g';

        // Which keys will have $arr
        $this->assertEquals([0,1,'01',''], array_keys($arr));

        // Which values will have $arr
        $this->assertEquals(['f','d','c','g'], array_values($arr));
    }

    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     * @see https://www.php.net/manual/en/language.operators.array.php
     * @see https://www.php.net/manual/en/function.array-merge.php
     * @see https://www.php.net/manual/en/function.array-replace.php
     */
    public function testArraysOperations()
    {
        // Union
        $arr1 = ['a', 'b'];
        $arr2 = ['c', 'd', 'e', 'key' => 'value'];
        $this->assertEquals(['a', 'b', 'e', 'key' => 'value'], $arr1 + $arr2);

        // array_merge — Merge one or more arrays
        $arr1 = ['a', 'b', 'key1' => 'value1', 'key2' => 'value2'];
        $arr2 = [1, 'key1' => 'value3', 'key3' => 'value4'];
        $this->assertEquals(['a','b','key1' => 'value3','key2' => 'value2',1,'key3' => 'value4'], array_merge($arr1, $arr2));

        // array_replace — Replaces elements from passed arrays into the first array
        $arr1 = ['a', 'b', 'key1' => 'value1', 'key2' => 'value2'];
        $arr2 = [1, 'key1' => 'value3', 'key3' => 'value4'];
        $this->assertEquals([1, 'b','key1' => 'value3','key2' => 'value2','key3' => 'value4'], array_replace($arr1, $arr2));
    }

    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     * @see https://www.php.net/manual/en/book.array.php
     */
    public function testArrayFunctions()
    {
        // list - Assign variables as if they were an array
        list(,, list($var)) = ['a', 'b', ['c', 'd']];
        $this->assertEquals('c', $var);

        // implode — Join array elements with a string
        $var = implode([1, 2, 3, 4]);
        $this->assertEquals('1234', $var);

        // sizeof — Alias of count
        $array = [1,5,4,3,4,3,4,5];
        $this->assertCount(8,$array);

        // unset — Unset a given variable
        $arr = [1, 2, 3, 4];
        unset($arr[0]);
        $this->assertEquals([1,2,3], array_keys($arr));

        // isset — Determine if a variable is declared and is different than NULL
        $arr = [1, 2, 'key' => 'value', null];
        $this->assertEquals(true, isset($arr[0]));
        $this->assertEquals(true, isset($arr['key']));
        $this->assertEquals(false, isset($arr[2]));

        // array_key_exists — Checks if the given key or index exists in the array
        $arr = [1, 2, 'key' => 'value', null];
        $this->assertEquals(true, array_key_exists(0, $arr));
        $this->assertEquals(true, array_key_exists('key', $arr));
        $this->assertEquals(true, array_key_exists(2, $arr));

        // in_array — Checks if a value exists in an array
        $arr = [1, 2, 'key' => 'value', null];
        $this->assertEquals(true, in_array(2,$arr));

        // array_flip — Exchanges all keys with their associated values in an array
        $arr2 = [1, 2, 'key' => 'value', 'null'];
        $this->assertEquals([1 => 0, 2 => 1, 'value' => 'key', 'null' => 2], array_flip($arr2));

        // array_reverse — Return an array with elements in reverse order
        $this->assertEquals([null, 'key' => 'value', 2, 1], array_reverse($arr));

        // array_keys — Return all the keys or a subset of the keys of an array
        $this->assertEquals([0, 1, 'key', 2], array_keys($arr));

        // array_values — Return all the values of an array
        $this->assertEquals([1, 2, 'value', null], array_values($arr));

        // array_filter — Filters elements of an array using a callback function
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $this->assertEquals([0 => 1, 2 => 3, 4 => 5, 6 => 7, 8 => 9], array_filter($arr, function ($value) {
            return $value % 2 > 0;
        }));

        // array_map — Applies the callback to the elements of the given arrays
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $this->assertEquals([2, 4, 6, 8, 10, 12, 14, 16, 18, 20], array_map(function ($value) {
            return $value * 2;
        }, $arr));

        // sort — Sort an array
        $this->assertEquals(true, sort($arr) == $arr);

        // rsort — Sort an array in reverse order
        $this->assertEquals(true, rsort($arr) == [10, 9, 8, 7, 6, 5, 4, 3, 2, 1]);

        // ksort — Sort an array by key
        $arr = [1, 2, 3, 4, 99 => 5, 6, 7, 8, 9, 10];
        $this->assertEquals(true, ksort($arr) == [1, 2, 3, 4, 6, 7, 8, 9, 10, 5]);

        // usort — Sort an array by values using a user-defined comparison function
        $arr = [1, 2, 3, 4, 10, 6, 7, 8, 9, 5];
        $this->assertEquals(true, usort($arr, function ($a, $b) {
                if ($a == $b) return 0;
                return ($a < $b) ? -1 : 1;
            }) == [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        // array_push — Push one or more elements onto the end of array
        $stack = ["orange", "banana"];
        array_push($stack, "apple", "raspberry");
        $this->assertEquals(["orange", "banana","apple", "raspberry"], $stack);

        // array_pop — Pop the element off the end of array
        array_pop($stack);
        $this->assertEquals(["orange", "banana","apple"], $stack);

        // array_shift — Shift an element off the beginning of array
        array_shift($stack);
        $this->assertEquals(["banana","apple"], $stack);

        // array_unshift — Prepend one or more elements to the beginning of an array
        array_unshift($stack, "lemon");
        $this->assertEquals(["lemon","banana","apple"], $stack);

    }
}