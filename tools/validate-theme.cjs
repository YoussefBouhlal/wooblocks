const { readFileSync } = require( 'node:fs' );
const Ajv = require( 'ajv' );

async function main() {
	const response = await fetch( 'https://schemas.wp.org/wp/6.7/theme.json' );
	if ( ! response.ok ) {
		throw new Error( `Schema download failed: HTTP ${ response.status }` );
	}
	const schema = await response.json();
	const ajv = new Ajv( {
		allErrors: true,
		strict: false,
		validateFormats: false,
	} );
	const validate = ajv.compile( schema );
	const theme = JSON.parse( readFileSync( 'theme.json', 'utf8' ) );
	if (
		theme.$schema !== 'https://schemas.wp.org/wp/6.7/theme.json' ||
		theme.version !== 3
	) {
		throw new Error(
			'Expected theme.json version 3 and the WordPress 6.7 schema.'
		);
	}
	if ( ! validate( theme ) ) {
		throw new Error(
			ajv.errorsText( validate.errors, { separator: '\n' } )
		);
	}
	process.stdout.write( 'theme.json passes the WordPress 6.7 schema.\n' );
}

main().catch( ( error ) => {
	process.stderr.write( `${ error.message }\n` );
	process.exitCode = 1;
} );
