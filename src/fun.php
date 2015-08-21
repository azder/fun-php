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
    return empty( $field ) ? null : @( is_array( $objarray ) ? $objarray[$field] : $objarray->$field );
}

function curry()
{

    $fixtures = func_get_args();
    $function = array_shift( $fixtures );

    return function () use ( $function, $fixtures ) {
        return call_user_func_array( $function, array_merge( $fixtures, func_get_args() ) );
    };

}

