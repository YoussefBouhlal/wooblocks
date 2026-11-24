( () => {
	const drawerSelector = '.wc-block-mini-cart__drawer';
	const openerSelector =
		'.wc-block-mini-cart__button, .add_to_cart_button, .single_add_to_cart_button';
	let drawer;
	let isOpen = false;
	let opener;
	let lastOutside = document.body.ownerDocument.activeElement;
	let pendingOpener;

	const canFocus = ( element ) =>
		element instanceof window.HTMLElement &&
		element.isConnected &&
		! element.closest( '[hidden], [inert], [aria-hidden="true"]' ) &&
		! element.matches( ':disabled' ) &&
		element.getClientRects().length > 0;

	document.addEventListener( 'focusin', ( event ) => {
		if ( ! isOpen && ! event.target.closest( drawerSelector ) ) {
			lastOutside = event.target;
		}
	} );

	document.addEventListener(
		'click',
		( event ) => {
			const control = event.target.closest( openerSelector );
			if ( control && ! isOpen ) {
				pendingOpener = control;
			}
		},
		true
	);

	const reconcile = () => {
		if ( ! drawer?.isConnected ) {
			drawer = document.querySelector( drawerSelector );
		}
		if ( ! drawer ) {
			return;
		}

		const nowOpen = drawer.getAttribute( 'aria-hidden' ) === 'false';
		const active = drawer.ownerDocument.activeElement;
		if ( nowOpen && ! isOpen ) {
			opener = pendingOpener || lastOutside;
			pendingOpener = null;
		}
		if ( ! nowOpen && isOpen ) {
			isOpen = false;
			if (
				active === document.body ||
				drawer.contains( active ) ||
				active.matches( '.wc-block-mini-cart__button' )
			) {
				const target = canFocus( opener )
					? opener
					: document.querySelector( '.wc-block-mini-cart__button' );
				if ( canFocus( target ) ) {
					target.focus();
				}
			}
			return;
		}
		isOpen = nowOpen;
		if (
			isOpen &&
			( active === document.body ||
				( drawer.contains( active ) && ! canFocus( active ) ) )
		) {
			drawer
				.querySelector( '.wc-block-components-drawer__close' )
				?.focus();
		}
	};

	new window.MutationObserver( reconcile ).observe( document.body, {
		subtree: true,
		childList: true,
		attributes: true,
		attributeFilter: [ 'aria-hidden', 'hidden' ],
	} );
	reconcile();
} )();
