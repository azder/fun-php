<?php
/**
 * Created by PhpStorm.
 * User: azder
 * Date: 22/08/2015
 * Time: 6:45
 */

namespace F\Test;


class NavTest extends \PHPUnit_Framework_TestCase
{

    public function test_array_path()
    {
        $value    = 'value';
        $array    = [ 'some' => [ 'path' => $value ] ];
        $path     = [ 'some', 'path' ];
        $returned = \F\nav( $path, $array );
        $this->assertEquals(
            $value,
            $returned,
            'nav(' . var_export( $path, true ) . ', ' . var_export( $array, true ) . ') can use array as path'
        );
    }

    public function test_premature_end_of_values()
    {

        $array = [
            'string' => 'string',
            'number' => 1,
            'null'   => null,
        ];

        foreach ($array as $key => $value) {
            $path     = $key . '-> something_extra';
            $returned = \F\nav( $path, $array );
            $this->assertNull(
                $returned,
                'nav(' . var_export( $path, true ) . ', ' . var_export( $array, true )
                . ') should return `null`, not ' . var_export( $returned, true ) . ''
            );
        }

    }

}