<?php

/**
 * Created by PhpStorm.
 * User: azder
 * Date: 22/08/2015
 * Time: 6:31
 */

namespace F\test;

class IdentTest extends \PHPUnit_Framework_TestCase
{

    public function test_literal_returns()
    {
        foreach ([ null, 0, '', true, false, INF, M_PI ] as $value) {
            $this->assertEquals( $value, \F\ident( $value ), 'ident(' . $value . ') should return `' . $value . '`' );
        }
    }

    public function test_nan_return()
    {
        // NAN doesn't equal NAN, so a special check is made
        $this->assertTrue( is_nan( \F\ident( NAN ) ), 'ident(NAN) should return `NAN`' );
    }

}