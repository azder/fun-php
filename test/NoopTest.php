<?php

/**
 * Created by PhpStorm.
 * User: azder
 * Date: 22/08/2015
 * Time: 5:55
 */


namespace F\Test;

class NoopTest extends \PHPUnit_Framework_TestCase
{
    public function test_default_return()
    {

        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $this->assertEquals( null, \F\noop() );

    }

    public function test_void_return_with_parameters()
    {
        foreach ([ null, 1, true, 'asdf', new \stdClass(), NAN, '', 0 ] as $value) {
            /** @noinspection PhpMethodParametersCountMismatchInspection */
            $this->assertNull(
                \F\noop( $value ),
                'noop() should return `null` for `' . var_export( $value, true ) . '`'
            );
        }
    }

}