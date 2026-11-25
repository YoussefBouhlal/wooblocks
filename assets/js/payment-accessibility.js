( () => {
	const checkout = document.querySelector( '.wp-block-woocommerce-checkout' );
	if ( ! checkout ) {
		return;
	}
	const repaired = new WeakSet();
	const reconcile = () => {
		checkout
			.querySelectorAll(
				'input[type="radio"][name="radio-control-wc-payment-method-options"]'
			)
			.forEach( ( radio ) => {
				const contentId = `${ radio.id }__content`;
				const references = (
					radio.getAttribute( 'aria-describedby' ) || ''
				)
					.split( /\s+/ )
					.filter( Boolean );
				if ( document.getElementById( contentId ) ) {
					if (
						repaired.has( radio ) &&
						! references.includes( contentId )
					) {
						radio.setAttribute(
							'aria-describedby',
							[ ...references, contentId ].join( ' ' )
						);
					}
				} else if ( references.includes( contentId ) ) {
					const remaining = references.filter(
						( reference ) => reference !== contentId
					);
					if ( remaining.length ) {
						radio.setAttribute(
							'aria-describedby',
							remaining.join( ' ' )
						);
					} else {
						radio.removeAttribute( 'aria-describedby' );
					}
					repaired.add( radio );
				}
			} );
	};
	new window.MutationObserver( reconcile ).observe( checkout, {
		subtree: true,
		childList: true,
		attributes: true,
		attributeFilter: [ 'aria-describedby' ],
	} );
	reconcile();
} )();
