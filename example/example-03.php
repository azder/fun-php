<?php
/**
 * Created by PhpStorm.
 * User: azder
 * Date: 24/08/2015
 * Time: 7:05
 */

error_reporting( E_ALL );

require_once '../src/fun.php';

function println( $expression )
{
    print var_export( $expression, true ) . PHP_EOL;
}

use function F\circ;
use function F\curry;

$has_null         = curry( 'F\any', 'is_null' );
$doesnt_have_null = circ( '\F\not', $has_null );

println(
    $has_null( [ 1, 2, 3, 4, 5 ] )
); // false

println(
    $has_null( [ 1, 2, 3, null, 4, 5 ] )
); // true

println(
    $doesnt_have_null( [ 1, 2, 3, 4, 5 ] )
); // true

println(
    $doesnt_have_null( [ 1, 2, 3, null, 4, 5 ] )
); // false