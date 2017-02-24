<?php
/**
 * Created by PhpStorm.
 * User: azder
 * Date: 23/02/2017
 * Time: 18:34
 */

namespace F\test;


class XferTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param $dfld
     * @param $dest
     * @param $ofld
     * @param $orig
     *
     * @dataProvider test_regular_transfer_provider
     *
     */
    public function test_regular_transfer( $dfld, $dest, $ofld, $orig )
    {

        $result = \F\xfer( $dfld, $dest, $ofld, $orig );

        if (is_array( $dest )) {
            $this->assertArrayHasKey( $dfld, $result, json_encode( $result ) );
        } else {
            $this->assertObjectHasAttribute( $dfld, $result );
        }

    }

    public function test_regular_transfer_provider()
    {

        $k1 = 'key1';
        $v1 = 'value1';
        $k2 = 'key2';
        $v2 = 'value2';

        $o1 = (object) [];

        return [
            '2 arrays'           => [ $k1, [], $k1, [ $k1 => $v1 ] ],
            '2 objects'          => [ $k1, $o1, $k1, (object) ( [ $k1 => $v1 ] ) ],
            '1 array + 1 object' => [ $k1, [], $k2, (object) [ $k2 => $v2 ] ],
            '1 object + 1 array' => [ $k1, (object) [], $k2, [ $k2 => $v2 ] ],
        ];

    }

    public function test_transfer_mutability()
    {

        $k1 = 'key1';
        $k2 = 'key2';
        $v2 = 'value2';

        $array  = [];
        $object = (object) [];

        $result1 = \F\xfer( $k1, $array, $k2, [ $k2 => $v2 ] );
        $result2 = \F\xfer( $k1, $object, $k2, [ $k2 => $v2 ] );

        $this->assertNotSame( $array, $result1 );
        $this->assertSame( $object, $result2 );

    }

}