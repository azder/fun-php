<?php
/**
 *CreatedbyPhpStorm.
 *User:azder
 *Date:10/08/2015
 *Time:3:32
 */


namespace F;

function noop()
{

}

function ident( $value )
{
    return $value;
}


/**
 * @param $value
 *
 * @return bool|null
 */
function tril( $value )
{

    if (null === $value || false === $value || true === $value) {
        return $value;
    }

    if (is_array( $value )) {
        return ! empty( $value );
    }

    if (is_object( $value )) {
        return true;
    }

    $value = trim( strtolower( $value ) );

    if (in_array( $value, [ '', 'null', 'maybe' ] )) {
        return null;
    }

    if (in_array( $value, [ 'no', 'off', '0' ] )) {
        return false;
    }

    if (in_array( $value, [ 'yes', 'on', '1' ] )) {
        return true;
    }

    return boolval( $value );

}

function dot( $field, $objarray )
{
    return is_null( $field ) ? null : @( is_array( $objarray ) ? $objarray[$field] : $objarray->$field );
}

function ddot( $default, $field, $objarray )
{
    return dot( $field, $objarray ) ?: $default;
}

function circ( $f, $g )
{
    return function () use ( $f, $g ) {
        return $f( call_user_func_array( $g, func_get_args() ) );
    };
}

function memoize( $f )
{

    return function () use ( $f ) {

        static $mem = [ ];

        $args = func_get_args();
        $sig  = serialize( $args );

        if ( ! array_key_exists( $sig, $mem )) {
            $mem[$sig] = call_user_func_array( $f, $args );
        }

        return $mem[$sig];

    };

}

function curry()
{

    $fixtures = func_get_args();
    $function = array_shift( $fixtures );

    return function () use ( $function, $fixtures ) {
        return call_user_func_array( $function, array_merge( $fixtures, func_get_args() ) );
    };

}

