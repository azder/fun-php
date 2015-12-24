<?php
/**
 * Created by PhpStorm.
 * User: azder
 * Date: 23/12/2015
 * Time: 22:25
 */

namespace F\test;


class TrilTest extends \PHPUnit_Framework_TestCase
{

    public function test_true_returns()
    {

        foreach ([ 1, true, 'on', 'yes', 'true', new \stdClass(), [ 'non empty array' ] ] as $value) {
            $this->assertEquals(
                true,
                \F\tril( $value ),
                'tril() should return `true` for `' . var_export( $value, true ) . '`'
            );
        }

    }

    public function test_yes()
    {
        foreach ([ 1, true, 'on', 'yes', 'true', new \stdClass(), [ 'non empty array' ]] as $value) {
            $this->assertTrue( \F\yes( $value ), 'yes() should return `true` for `' . var_export( $value, true ) . '``' );
        }
    }

    public function test_false_returns()
    {

        foreach ([ 0, false, 'off', 'no', 'false', [ /*'empty array'*/ ] ] as $value) {
            $this->assertEquals(
                false,
                \F\tril( $value ),
                'tril() should return `false` for `' . var_export( $value, true ) . '`'
            );
        }

    }

    public function test_no()
    {
        foreach ([ 0, false, 'off', 'no', 'false', [ /*'empty array'*/ ] ] as $value) {
            $this->assertTrue( \F\no( $value ), 'no() should return `true` for `' . var_export( $value, true ) . '``' );
        }
    }

    public function test_null_returns()
    {

        foreach ([ null, '', 'maybe', 'null', NAN ] as $value) {
            $this->assertEquals(
                null,
                \F\tril( $value ),
                'tril() should return `null` for `' . var_export( $value, true ) . '`'
            );
        }

    }

    public function test_nil()
    {
        foreach ([ null, '', 'maybe', 'null', NAN ] as $value) {
            $this->assertTrue( \F\nil( $value ), 'nil() should return `true` for `' . var_export( $value, true ) . '``' );
        }
    }

    public function test_random_returns()
    {
        $this->assertEquals( true, \F\tril( 'asdf' ), 'tril() should return `true` for `\'asdf\'`' );
    }



}