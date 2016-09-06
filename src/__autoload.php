<?php

// Define GEARSPATH
define( 'GEARSPATH', __DIR__ . DIRECTORY_SEPARATOR );

// Load Gears Helper Manually
require 'Helper.php';

/**
 * Gears Autoload
 *
 * @param $className
 */
spl_autoload_register(
	function ( $className )
	{
		$className = ltrim( $className, '\\' );
		$filePath  = '';

		if ( $lastNsPos = strripos( $className, '\\' ) )
		{
			$namespace = substr( $className, 0, $lastNsPos );
			$className = substr( $className, $lastNsPos + 1 );
			$filePath  = str_replace( '\\', DIRECTORY_SEPARATOR, $namespace ) . DIRECTORY_SEPARATOR;
		}

		$filePath .= str_replace( '_', DIRECTORY_SEPARATOR, $className ) . '.php';

		// Fixed Path
		$filePath = str_replace( 'O2System\Gears\\', GEARSPATH, $filePath );

		if ( file_exists( $filePath ) )
		{
			require $filePath;
		}

	}, TRUE, TRUE );
