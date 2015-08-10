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
function bool( $value )
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