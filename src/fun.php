<?php
/**
 *CreatedbyPhpStorm.
 *User:azder
 *Date:10/08/2015
 *Time:3:32
 */


namespace F;

/**
 * @return void
 */
function noop()
{

}

/**
 * @param mixed $value
 *
 * @return mixed
 */
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

    if (is_double( $value ) && is_nan( $value )) {
        return null;
    }

    $value = trim( strtolower( $value ) );

    if (in_array( $value, [ '', 'null', 'maybe' ] )) {
        return null;
    }

    if (in_array( $value, [ 'no', 'off', '0', 'false' ] )) {
        return false;
    }

    if (in_array( $value, [ 'yes', 'on', '1', 'true' ] )) {
        return true;
    }

    return boolval( $value );

}

/**
 * @param $expression
 *
 * @return bool
 */
function yes( $expression )
{
    return true === tril( $expression );
}

/**
 * @param $expression
 *
 * @return bool
 */
function no( $expression )
{
    return false === tril( $expression );
}

/**
 * @param $expression
 *
 * @return bool
 */
function nil( $expression )
{
    return null === tril( $expression );
}

/**
 * @param $expression
 *
 * @return bool
 */
function not( $expression )
{
    return ! $expression;
}

/**
 * @param string $field
 * @param \stdClass|array|object $objarray
 *
 * @return null
 */
function val( $field, $objarray )
{
    return is_null( $field ) ? null : @( is_array( $objarray ) ? $objarray[$field] : $objarray->$field );
}

/**
 * @param mixed $default
 * @param string $field
 * @param \stdClass|array $objarray
 *
 * @return mixed
 */
function vald( $default, $field, $objarray )
{
    return val( $field, $objarray ) ?: $default;
}


/**
 * @param $path
 * @param \stdClass|array|object $value
 *
 * @return mixed|null
 */
function nav( $path, $value )
{

    if (empty( $value )) {
        return $value;
    }

    $segments = array_map( function ( $segment ) {
        return trim( $segment );
    }, explode( '->', $path ) );

    foreach ($segments as $segment) {
        if (is_array( $value )) {
            $value = array_key_exists( $segment, $value ) ? $value[$segment] : null;
        } else if (is_object( $value )) {
            $value = isset( $value->$segment ) ? $value->$segment : null;
        } else {
            return null;
        }
    }

    return $value;

}

/**
 * @param callable $test
 * @param array $array
 *
 * @return null|mixed
 */
function first( $test, array $array )
{
    foreach ($array as $value) {
        if ($test( $value )) {
            return $value;
        }
    }

    return null;

}

/**
 * @param callable $test
 * @param array $array
 *
 * @return null|mixed
 */
function last( $test, array $array )
{
    return first( $test, array_reverse( $array ) );
}

/**
 * @param callable $test
 * @param array $array
 *
 * @return bool
 */
function any( $test, array $array )
{

    foreach ($array as $value) {
        if ($test( $value )) {
            return true;
        }
    }

    return false;

}

/**
 * @param callable $test
 * @param array $array
 *
 * @return bool
 */
function all( $test, array $array )
{

    foreach ($array as $v) {
        if ( ! $test( $v )) {
            return false;
        }
    }

    return true;

}


/**
 * @param callable $function
 *
 * @return \Closure
 */
function unr( $function )
{
    return function ( array $args = [ ] ) use ( $function ) {
        return call_user_func_array( $function, $args );
    };
}

/**
 * @param callable $f
 * @param callable $g
 *
 * @return \Closure
 */
function rcirc( $f, $g )
{
    return function () use ( $f, $g ) {
        return $f( call_user_func_array( $g, func_get_args() ) );
    };
}

/**
 * @param callable $f
 * @param callable $g
 *
 * @return \Closure
 */
function lcirc( $f, $g )
{
    return function () use ( $f, $g ) {
        return $g( call_user_func_array( $f, func_get_args() ) );
    };
}

/**
 *
 * @param callable ...
 *
 * @return \Closure
 */
function rcomp()
{

    $fns = func_get_args();

    return function () use ( $fns ) {

        return array_reduce( array_reverse( $fns ), function ( $args, $fn ) {
            return is_array( $args ) ? call_user_func_array( $fn, $args ) : call_user_func( $fn, $args );
        }, func_get_args() );

    };

}

/**
 * @param callable ...
 *
 * @return \Closure
 */
function lcomp()
{

    $fns = func_get_args();

    return function () use ( $fns ) {

        return array_reduce( $fns, function ( $args, $fn ) {
            return is_array( $args ) ? call_user_func_array( $fn, $args ) : call_user_func( $fn, $args );
        }, func_get_args() );

    };

}

/**
 * @param callable $f
 *
 * @return \Closure
 */
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

/**
 * @param callable $fn
 * @param mixed ...
 *
 * @return \Closure
 */
function curry( $fn )
{

    $fixtures = func_get_args();
    $function = array_shift( $fixtures );

    return function () use ( $function, $fixtures ) {
        return call_user_func_array( $function, array_merge( $fixtures, func_get_args() ) );
    };

}

/**
 * @param array $keys
 * @param \stdClass|array $objarray
 *
 * @return array
 */
function pick( array $keys = [ ], $objarray = [ ] )
{
    return array_intersect_key( $objarray, array_flip( $keys ) );
}

/**
 * @param array $keys
 * @param \stdClass|array $objarray
 *
 * @return array
 */
function omit( array $keys = [ ], $objarray = [ ] )
{
    return array_diff_key( $objarray, array_flip( $keys ) );
}

