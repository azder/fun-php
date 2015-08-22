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

    public function test_null_return_with_parameters()
    {
        foreach ([ null, 1, true, 'asdf' ] as $value) {
            /** @noinspection PhpMethodParametersCountMismatchInspection */
            $this->assertNull( \F\noop( $value ), 'noop() should return `null` for `' . $value . '`' );
        }
    }

}