( () => {
	let labelSequence = 0;
	document
		.querySelectorAll(
			'.woocommerce div.product form.cart .quantity input'
		)
		.forEach( ( input ) => {
			const label = Array.from( input.labels || [] ).find(
				( candidate ) =>
					candidate.classList.contains( 'screen-reader-text' )
			);
			if ( ! label || input.type === 'hidden' ) {
				return;
			}
			label.classList.remove( 'screen-reader-text' );
			label.classList.add( 'wooblocks-quantity-label' );
			if ( ! input.hasAttribute( 'aria-labelledby' ) ) {
				if ( ! label.id ) {
					do {
						labelSequence++;
					} while (
						document.getElementById(
							`wooblocks-quantity-label-${ labelSequence }`
						)
					);
					label.id = `wooblocks-quantity-label-${ labelSequence }`;
				}
				input.setAttribute( 'aria-labelledby', label.id );
			}
		} );
} )();
