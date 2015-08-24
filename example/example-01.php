<?php
/**
 * Created by PhpStorm.
 * User: azder
 * Date: 10/08/2015
 * Time: 5:04
 */

error_reporting( E_ALL );

require_once '../src/fun.php';

use function F\dot;

$values        = [ 1, 0, - 1, 'yes', 'no', 'on', 'off', '0.0' ];
$object        = new stdClass();
$object->test  = $values;
$object->test2 = 'test2';

array_map( function ( $value ) {
    echo '' . $value . ' -> ' . var_export( F\tril( $value ), true ) . PHP_EOL;
}, $values );

echo '-------------------' . PHP_EOL;

array_map( function ( $value ) {
    echo '' . $value . ' -> ' . var_export( F\ident( $value ), true ) . PHP_EOL;
}, $values );

echo '-------------------' . PHP_EOL;

echo F\dot( 4, $values ) . PHP_EOL;
echo var_export( F\dot( 'test', $object ), true ) . PHP_EOL;

$test2 = F\curry( 'F\dot', 'test2' );
echo var_export( $test2( $object ), true ) . PHP_EOL;

echo '-------------------' . PHP_EOL;

var_export( dot( 'test', $object ) );
var_export( dot( '', $object ) );
var_export( dot( null, $object ) );