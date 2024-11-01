(function ($) {
	/**
	   * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	**/

	var SliderSyncingHandler = function ($scope, $) {

		var slideFor = $scope.find('.bt-slide-for-js'),
			slideNav = $scope.find('.bt-slide-nav-js');

		slideFor.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			autoplay: true,
			autoplaySpeed: 5000,
			arrows: false,
			fade: true,
			asNavFor: '.bt-slide-nav-js'
		});

		slideNav.slick({
			centerMode: true,
			centerPadding: '0px',
			slidesToShow: 3,
			asNavFor: '.bt-slide-for-js',
			focusOnSelect: true,
			arrows: true,
			prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg></button>',
			nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></button>',
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						centerMode: true,
						slidesToShow: 3
					}
				},
				{
					breakpoint: 768,
					settings: {
						centerMode: true,
						slidesToShow: 1
					}
				}
			]
		});

	};

	function lineProgressStep($scope) {
		var listStep = $scope.find('.bt-step-list-js'),
			listInfo = { top: listStep.offset().top, height: listStep.innerHeight() },
			lineProgress = $scope.find('.bt-line-progress-js'),
			currentScroll = $(window).scrollTop() + ($(window).height() / 2),
			percent = ((currentScroll - listInfo.top) / listInfo.height) * 100;

		if (percent > 0) {
			if (percent > 100) {
				lineProgress.css('height', '100%');
			} else {
				lineProgress.css('height', percent.toFixed(2) + '%');
			}
		} else {
			lineProgress.css('height', '0%');
		}
	}

	var MoreStepsHandler = function ($scope, $) {
		var moreBtn = $scope.find('.bt-show-more-btn-js'),
			listStep = $scope.find('.bt-step-list-js');

		lineProgressStep($scope);
		$(window).scroll(function () {
			lineProgressStep($scope);
		});

		if ($scope.find('.bt-has-show-more').length > 0) {

			moreBtn.on('click', function (e) {
				e.preventDefault();

				$(this).parent().hide();
				listStep.children().removeClass('bt-hide-item');

				lineProgressStep($scope);
				$(window).scroll(function () {
					lineProgressStep($scope);
				});
			});
		}

	};
	/* Graph Progress */
	var GraphProgressHandler = function ($scope, $) {
		const $progressBars = $scope.find('.bt-progress-bar');

		const observer = new IntersectionObserver((entries, observer) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					const $bar = $(entry.target);
					const percentage = $bar.data('percentage');

					if (!$bar.hasClass('animated')) {
						$bar.css('height', percentage + '%');
						$bar.addClass('animated');
						if (percentage > 3) {
							setTimeout(function () {
								$bar.addClass('show-text');
							}, 500);
						}
						observer.unobserve(entry.target);
					}
				}
			});
		}, { threshold: 0.5 });

		$progressBars.each(function () {
			observer.observe(this);
		});
	}
	var FaqHandler = function ($scope, $) {
		const $titleFaq = $scope.find('.bt-item-title');
		if ($titleFaq.length > 0) {
			$titleFaq.on('click', function (e) {
				e.preventDefault();
				if ($(this).hasClass('active')) {
					$(this).parent().find('.bt-item-content').slideUp();
					$(this).removeClass('active');
					$(this).parent().removeClass('active');
				} else {
					$(this).parent().find('.bt-item-content').slideDown();
					$(this).addClass('active');
					$(this).parent().addClass('active');
				}
			});
		}
	};
	var BrandSliderHandler = function ($scope, $) {
		const $brandslider = $scope.find('.bt-elwg-brand-slider--default');
		if ($brandslider.length > 0) {
			const $item = $brandslider.data('item');
			const $itemTablet = $brandslider.data('item-tablet');
			const $itemMobile = $brandslider.data('item-mobile');
			const $speed = $brandslider.data('speed');
			const $spaceBetween = $brandslider.data('spacebetween');

			const $swiper = new Swiper($brandslider[0], {
				slidesPerView: $itemMobile,
				loop: true,
				spaceBetween: $spaceBetween,
				speed: $speed,
				freeMode:true,
				allowTouchMove: true,
				autoplay:
				{
					delay: 0,
					disableOnInteraction: false,
				},
				breakpoints: {
					1024: {
						slidesPerView: $item,
					},
					768: {
						slidesPerView: $itemTablet,
					},
				},
			});
			$brandslider[0].addEventListener('mouseenter', () => {
				$swiper.autoplay.stop();
			});
			$brandslider[0].addEventListener('mouseleave', () => {
				$swiper.autoplay.start();
			});
		}
	};
	// Make sure you run this code under Elementor.
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-testimonial-slider.default', SliderSyncingHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-step-list.default', MoreStepsHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-graph-progress.default', GraphProgressHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-list-faq.default', FaqHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-brand-slider.default', BrandSliderHandler);
	});

})(jQuery);
