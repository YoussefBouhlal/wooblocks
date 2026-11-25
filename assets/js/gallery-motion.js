( () => {
	const motion = window.matchMedia( '(prefers-reduced-motion: reduce)' );

	function ReducedMotionUI( gallery, framework ) {
		const zoomTo = gallery.zoomTo;
		gallery.zoomTo = function ( level, point, duration, ...args ) {
			return zoomTo.call(
				this,
				level,
				point,
				motion.matches ? 0 : duration,
				...args
			);
		};
		return new window.PhotoSwipeUI_Default( gallery, framework );
	}

	document.addEventListener(
		'click',
		( event ) => {
			if (
				! motion.matches ||
				! ( event.target instanceof window.Element ) ||
				typeof window.PhotoSwipe !== 'function' ||
				typeof window.PhotoSwipeUI_Default !== 'function' ||
				! window.jQuery ||
				! window.wc_single_product_params
			) {
				return;
			}
			const trigger = event.target.closest(
				'.woocommerce div.product .woocommerce-product-gallery__trigger'
			);
			if ( ! trigger ) {
				return;
			}
			const root = trigger.closest( '.woocommerce-product-gallery' );
			const productGallery = window
				.jQuery( root )
				.data( 'product_gallery' );
			const template = document.querySelector( '.pswp' );
			if (
				! template ||
				! productGallery?.photoswipe_enabled ||
				typeof productGallery.getGalleryItems !== 'function' ||
				typeof productGallery.trapFocusPhotoswipe !== 'function'
			) {
				return;
			}
			const items = productGallery.getGalleryItems();
			if ( ! items.length ) {
				return;
			}
			const slider = productGallery.flexslider_enabled
				? window.jQuery( root ).data( 'flexslider' )
				: null;
			const active = root.querySelector( '.flex-active-slide' );
			const index =
				typeof slider?.currentSlide === 'number'
					? slider.currentSlide
					: Math.max( 0, productGallery.$images.index( active ) );
			const options = {
				index,
				timeToIdle: 0,
				addCaptionHTMLFn( item, caption ) {
					caption.children[ 0 ].textContent = item.title || '';
					return Boolean( item.title );
				},
				...window.wc_single_product_params.photoswipe_options,
				showAnimationDuration: 0,
				hideAnimationDuration: 0,
			};
			const gallery = new window.PhotoSwipe(
				template,
				ReducedMotionUI,
				items,
				options
			);
			const syncVideo = () => {
				productGallery.syncPhotoswipeVideoPlayback?.( gallery );
			};
			gallery.listen( 'afterInit', () => {
				productGallery.trapFocusPhotoswipe( true );
				syncVideo();
			} );
			gallery.listen( 'afterChange', syncVideo );
			gallery.listen( 'close', () => {
				template
					.querySelectorAll(
						'video.woocommerce-product-gallery__photoswipe-video'
					)
					.forEach( ( video ) => video.pause() );
				productGallery.trapFocusPhotoswipe( false );
				trigger.focus();
			} );
			event.preventDefault();
			event.stopImmediatePropagation();
			gallery.init();
		},
		true
	);
} )();
