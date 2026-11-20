const { readdirSync } = require( 'node:fs' );
const { join } = require( 'node:path' );
const { spawnSync } = require( 'node:child_process' );

function sourceFiles( directory ) {
	return readdirSync( directory, { withFileTypes: true } ).flatMap(
		( entry ) => {
			if (
				[ 'node_modules', 'vendor', 'tools' ].includes( entry.name ) ||
				entry.name.startsWith( '.' )
			) {
				return [];
			}
			const filename = join( directory, entry.name );
			if ( entry.isDirectory() ) {
				return sourceFiles( filename );
			}
			return /\.(?:[cm]?[jt]s|[jt]sx)$/.test( entry.name ) &&
				entry.name !== 'eslint.config.cjs'
				? [ filename ]
				: [];
		}
	);
}

if ( ! sourceFiles( '.' ).length ) {
	process.stdout.write(
		'No JavaScript source found; checking development scripts only.\n'
	);
}
const result = spawnSync(
	process.execPath,
	[
		require.resolve( '@wordpress/scripts/bin/wp-scripts.js' ),
		'lint-js',
		'.',
		...process.argv.slice( 2 ),
	],
	{ stdio: 'inherit' }
);
if ( result.error ) {
	throw result.error;
}
process.exit( result.status ?? 1 );
