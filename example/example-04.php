<?php
/**
 * Created by PhpStorm.
 * User: azder
 * Date: 25/08/2015
 * Time: 11:04
 */


error_reporting( E_ALL );

require_once '../src/fun.php';

function println( $expression )
{
    print var_export( $expression, true ) . PHP_EOL;
}

use function F\curry;
use function F\lcirc;
use function F\lcomp;
use function F\rcirc;
use function F\rcomp;


$plus = function ( $a, $b ) {
    return $a + $b;
};

$mul = function ( $a, $b ) {
    return $a * $b;
};

$twice = function ( $a ) {
    return [ $a, $a ];
};


$increase = curry( $plus, 1 );
$double   = curry( $mul, 2 );

$rcomp = rcomp( $double, $increase );
$rc    = rcirc( $double, $increase );

$lcomp = lcomp( $double, $increase );
$lc    = lcirc( $double, $increase );

println( $rcomp( 4 ) ); // = (4 + 1) * 2
println( $rc( 4 ) ); // = (4 + 1) * 2

println( $lcomp( 4 ) ); // = (4 * 2) + 1
println( $lc( 4 ) ); // = (4 * 2) + 1


println( $double( $increase( 1 ) ) ); // 4
println( call_user_func( rcirc( $double, $increase ), 1 ) ); // 4
println( call_user_func( rcomp( $double, $increase ), 1 ) ); // 4


println( call_user_func_array( $mul, $twice( call_user_func_array( $plus, $twice( 3 ) ) ) ) ); // 36
println( call_user_func( rcomp( $mul, $twice, $plus, $twice ), 3 ) ); // 36



