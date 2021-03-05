<?php declare( strict_types=1 );

use Isolated\Symfony\Component\Finder\Finder;

$prefix = 'WpifyPluginDeps';

$whitelist = require_once __DIR__ . '/scoper.whitelist.php';

$whitelist_terms = array_filter( array_values( array_merge(
	array_values( $whitelist['classes'] ),
	array_values( $whitelist['interfaces'] ),
	array_values( $whitelist['constants'] ),
	array_values( $whitelist['functions'] )
) ), function ( $term ) {
	return strpos( 'Composer', $term ) === false;
} );

//var_dump(join(',', $whitelist_terms));

return array(
	'prefix'                     => $prefix,
	'finders'                    => array(
		Finder::create()
		      ->files()
		      ->ignoreVCS( true )
		      ->notName( '/LICENSE|.*\\.md|.*\\.dist|Makefile|composer\\.json|composer\\.lock/' )
		      ->exclude( [
			      'doc',
			      'test',
			      'test_old',
			      'tests',
			      'Tests',
			      'vendor-bin',
			      'node_modules',
			      'scoper.inc.php',
		      ] )
		      ->in( __DIR__ . '/deps/unprefixed' ),
		Finder::create()
		      ->append( array( __DIR__ . '/deps/unprefixed/composer.json' ) ),
	),
	'patchers'                   => array(
		function ( string $filePath, string $prefix, string $content ): string {
			if ( strpos( $filePath, 'guzzlehttp/guzzle/src/Handler/CurlFactory.php' ) !== false ) {
				$content = str_replace( 'stream_for($sink)', 'Utils::streamFor()', $content );
			}

			return $content;
		},
	),
	'whitelist'                  => $whitelist_terms,
	'whitelist-global-constants' => true,
	'whitelist-global-classes'   => true,
	'whitelist-global-functions' => true,
);
