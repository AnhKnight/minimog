(
	function ($) {
		'use strict';

		var SwiperHandler = function ($scope, $) {
			var $element = $scope.find('.tm-slider-widget');

			$element.minimogSwiper();
		};

		var SwiperHandlerVertical = function ($scope, $) {
			var $element = $scope.find('.minimog-product-widget');

			$element.minimogSwiper();
		};

		var SwiperLinkedHandler = function ($scope, $) {
			var $element = $scope.find('.tm-slider-widget');

			if ($scope.hasClass('minimog-swiper-linked-yes')) {
				var thumbsSlider = $element.filter('.minimog-thumbs-swiper').minimogSwiper();
				var mainSlider = $element.filter('.minimog-main-swiper').minimogSwiper({
					thumbs: {
						swiper: thumbsSlider,
						slidesPerGroup: 3
					}
				});
			} else {
				$element.minimogSwiper();
			}
		};

		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/tm-image-carousel.default', SwiperHandler);
			elementorFrontend.hooks.addAction('frontend/element_ready/tm-modern-carousel.default', SwiperHandler);
			elementorFrontend.hooks.addAction('frontend/element_ready/tm-modern-slider.default', SwiperHandler);
			elementorFrontend.hooks.addAction('frontend/element_ready/tm-team-member-carousel.default', SwiperHandler);
			elementorFrontend.hooks.addAction('frontend/element_ready/tm-portfolio-carousel.default', SwiperHandler);
			elementorFrontend.hooks.addAction('frontend/element_ready/tm-product-carousel.default', SwiperHandler);
			elementorFrontend.hooks.addAction('frontend/element_ready/tm-product-widget.default', SwiperHandlerVertical);

			elementorFrontend.hooks.addAction('frontend/element_ready/tm-testimonial.default', SwiperLinkedHandler);
		});
	}
)(jQuery);
