<?php
/**
 * Created by PhpStorm.
 * User: azder
 * Date: 22/08/2015
 * Time: 6:45
 */

namespace F\Test;


class ValTest extends \PHPUnit_Framework_TestCase
{

    public function test_keyed_array()
    {

        $array = [
            'first key'  => 1,
            'second key' => new \stdClass(),
            2            => 'third value',
        ];

        foreach ($array as $key => $value) {
            $returned = \F\val( $key, $array );
            $this->assertSame( $value, $returned,
                '
                (' . var_export( $key, true ) . ', ' . var_export( $array, true ) . ') '
                . 'should return `'
                . var_export( $value, true ) . '`, not ' . var_export( $returned, true ) . ''
            );
        }

    }

    public function test_indexed_array()
    {

        $array = [
            'zero value',
            new \stdClass(),
            [ ]
        ];

        $aexpr = var_export( $array, true );
        $count = count( $array );

        for ($i = 0; $i < $count; $i += 1) {
            $returned = \F\val( $i, $array );
            $rexp     = var_export( $returned, true );
            $value    = $array[$i];
            $vexp     = var_export( $value, true );
            $this->assertSame( $value, $returned, "val($i, $aexpr ) should return `$vexp`, not `$rexp`" );
        }


    }

    public function test_mixed_array()
    {

        $k0 = 0;
        $v0 = '0value';

        $k1 = 'key1';
        $v1 = 'key1value';

        $k2 = 1;
        $v2 = '1value';

        $k3 = 'key2';
        $v3 = 'key2value';

        $array = [
            $v0,
            $k1 => $v1,
            $v2,
            $k3 => $v3,
        ];

        $assumed = [ 0 => '0value', 1 => '1value', 'key1' => 'key1value', 'key2' => 'key2value' ];

        $this->assertEquals( $assumed, $array, 'test array not as assumed' );


        $r0 = \F\val( $k0, $array );
        $this->assertSame( $v0, $r0, "value for `$k0` should be `$v0`, not `$r0`" );

        $r1 = \F\val( $k1, $array );
        $this->assertSame( $v1, $r1, "value for `$k1` should be `$v1`, not `$r1`" );

        $r2 = \F\val( $k2, $array );
        $this->assertSame( $v2, $r2, "value for `$k2` should be `$v2`, not `$r2`" );

        $r3 = \F\val( $k3, $array );
        $this->assertSame( $v3, $r3, "value for `$k3` should be `$v3`, not `$r3`" );

    }


}