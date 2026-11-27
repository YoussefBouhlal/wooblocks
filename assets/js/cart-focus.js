( () => {
	const drawerSelector = '.wc-block-mini-cart__drawer';
	const openerSelector =
		'.wc-block-mini-cart__button, .add_to_cart_button, .single_add_to_cart_button';
	let drawer;
	let isOpen = false;
	let opener;
	let lastOutside = document.body.ownerDocument.activeElement;
	let pendingOpener;
	let labelledHeading;
	let headingSequence = 0;

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
		const heading = Array.from(
			drawer.querySelectorAll( 'h1, h2, h3, [role="heading"]' )
		).find( canFocus );
		const labelledBy = drawer.getAttribute( 'aria-labelledby' );
		if (
			heading &&
			! drawer.hasAttribute( 'aria-label' ) &&
			( ! labelledBy || labelledBy === labelledHeading?.id )
		) {
			if ( ! heading.id ) {
				do {
					headingSequence++;
				} while (
					document.getElementById(
						`wooblocks-cart-heading-${ headingSequence }`
					)
				);
				heading.id = `wooblocks-cart-heading-${ headingSequence }`;
			}
			if ( labelledBy !== heading.id ) {
				drawer.setAttribute( 'aria-labelledby', heading.id );
			}
			labelledHeading = heading;
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

	const cart = document.querySelector( '.wp-block-woocommerce-cart' );
	if ( ! cart ) {
		return;
	}
	let pendingCartAction;
	const decreaseSelector =
		'.wc-block-components-quantity-selector__button--minus';
	const removeSelector = '.wc-block-cart-item__remove-link';
	const isRemovalTable = ( element ) =>
		pendingCartAction?.control.matches( removeSelector ) &&
		element.matches( '.wc-block-cart-items' ) &&
		cart.contains( element );

	document.addEventListener(
		'click',
		( event ) => {
			pendingCartAction = null;
			const control = event.target.closest(
				`${ decreaseSelector }, ${ removeSelector }`
			);
			if (
				! control ||
				! cart.contains( control ) ||
				control !== cart.ownerDocument.activeElement ||
				( control.matches( removeSelector ) &&
					cart.querySelectorAll( '.wc-block-cart-items__row' )
						.length !== 1 )
			) {
				return;
			}
			const row = control.closest( '.wc-block-cart-items__row' );
			pendingCartAction = {
				control,
				row,
				value: row?.querySelector( 'input[type="number"]' )?.value,
			};
		},
		true
	);
	document.addEventListener( 'keydown', () => {
		pendingCartAction = null;
	} );
	document.addEventListener( 'focusin', ( event ) => {
		if (
			event.target !== pendingCartAction?.control &&
			! isRemovalTable( event.target )
		) {
			pendingCartAction = null;
		}
	} );

	new window.MutationObserver( () => {
		if ( ! pendingCartAction ) {
			return;
		}
		const { control, row, value } = pendingCartAction;
		const active = cart.ownerDocument.activeElement;
		if (
			active !== document.body &&
			active !== control &&
			! isRemovalTable( active )
		) {
			pendingCartAction = null;
			return;
		}
		let target;
		if ( control.matches( decreaseSelector ) ) {
			const quantity = row?.querySelector( 'input[type="number"]' );
			if ( ! canFocus( quantity ) || quantity.value === value ) {
				return;
			}
			pendingCartAction = null;
			if ( control.disabled ) {
				target = quantity;
			}
		} else if ( ! control.isConnected ) {
			target = cart
				.querySelector( '.wp-block-woocommerce-empty-cart-block' )
				?.querySelector( 'h1, h2, h3, [role="heading"]' );
			if ( canFocus( target ) && ! target.hasAttribute( 'tabindex' ) ) {
				target.setAttribute( 'tabindex', '-1' );
			}
		}
		if ( canFocus( target ) ) {
			pendingCartAction = null;
			target.focus();
		}
	} ).observe( cart, {
		subtree: true,
		childList: true,
		attributes: true,
		attributeFilter: [ 'disabled', 'value' ],
	} );
} )();
