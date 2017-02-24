<?php
/**
 * Created by PhpStorm.
 * User: azder
 * Date: 23/02/2017
 * Time: 18:34
 */

namespace F\Test;


class ExistsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param $key
     * @param $value
     *
     * @dataProvider test_array_key_set_provider
     *
     */
    public function test_array_key_set( $key, $value )
    {
        $array = [ $key => $value ];

        $returned = \F\exists( $key, $array );

        $this->assertTrue(
            $returned,
            'exists(' . var_export( $key, true ) . ', ' . var_export( $array, true ) . ') has the key'
        );

    }

    public function test_array_key_set_provider()
    {
        return [
            'key with regular value'         => [ 'key', 'value' ],
            'key with null as value'         => [ 'key', null ],
            'null as key with null as value' => [ null, null ],
            'null as key with regular value' => [ null, 'value' ],
        ];
    }


    public function test_array_key_missing()
    {
        $key   = 'key';
        $array = [];

        $returned = \F\exists( $key, $array );

        $this->assertFalse(
            $returned,
            'exists(' . var_export( $key, true ) . ', ' . var_export( $array, true ) . ') does not have the key'
        );

    }

}