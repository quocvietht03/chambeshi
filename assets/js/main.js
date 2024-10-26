!(function ($) {
	"use strict";

	/* Toggle submenu align */
	function ChambeshiSubmenuAuto() {
		if ($('.bt-site-header .bt-container').length > 0) {
			var container = $('.bt-site-header .bt-container'),
				containerInfo = { left: container.offset().left, width: container.innerWidth() },
				contLeftPos = containerInfo.left,
				contRightPos = containerInfo.left + containerInfo.width;

			$('.children, .sub-menu').each(function () {
				var submenuInfo = { left: $(this).offset().left, width: $(this).innerWidth() },
					smLeftPos = submenuInfo.left,
					smRightPos = submenuInfo.left + submenuInfo.width;

				if (smLeftPos <= contLeftPos) {
					$(this).addClass('bt-align-left');
				}

				if (smRightPos >= contRightPos) {
					$(this).addClass('bt-align-right');
				}

			});
		}
	}

	/* Toggle menu mobile */
	function ChambeshiToggleMenuMobile() {
		$('.bt-site-header .bt-menu-toggle').on('click', function (e) {
			e.preventDefault();

			if ($(this).hasClass('bt-menu-open')) {
				$(this).addClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').addClass('bt-is-active');
			} else {
				$('.bt-menu-open').removeClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').removeClass('bt-is-active');
			}
		});
	}

	/* Toggle sub menu mobile */
	function ChambeshiToggleSubMenuMobile() {
		var hasChildren = $('.bt-site-header .page_item_has_children, .bt-site-header .menu-item-has-children');

		hasChildren.each(function () {
			var $btnToggle = $('<div class="bt-toggle-icon"></div>');

			$(this).append($btnToggle);

			$btnToggle.on('click', function (e) {
				e.preventDefault();
				$(this).toggleClass('bt-is-active');
				$(this).parent().children('ul').toggle();
			});
		});
	}

	/* Orbit effect */
	function ChambeshiOrbitEffect() {
		if ($('.bt-orbit-enable').length > 0) {
			var html = '<div class="bt-orbit-effect">' +
				'<div class="bt-orbit-wrap">' +
				'<div class="bt-orbit red"><span></span></div>' +
				'<div class="bt-orbit blue"><span></span></div>' +
				'<div class="bt-orbit yellow"><span></span></div>' +
				'<div class="bt-orbit purple"><span></span></div>' +
				'<div class="bt-orbit green"><span></span></div>' +
				'</div>' +
				'</div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Cursor effect */
	function ChambeshiCursorEffect() {
		if ($('.bt-bg-pattern-enable').length > 0) {
			var html = '<div class="bt-bg-pattern-effect"></div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Buble effect */
	function ChambeshiBubleEffect() {
		if ($('.bt-bg-buble-enable').length > 0) {
			var html = '<div class="bt-bg-buble-effect">' +
				'<div class="bt-bubles-beblow"></div>' +
				'<div class="bt-bubles-above"></div>'
			'</div>';

			$('.bt-social-mcn-ss').append(html);

			for (let i = 0; i < 40; i++) {
				$('.bt-bubles-beblow').append('<span class="buble"></span>');
				$('.bt-bubles-above').append('<span class="buble"></span>');
			}
		}
	}

	/* Shop */
	function ChambeshiShop() {
		if ($('.single-product').length > 0) {
			$('.woocommerce-product-zoom__image').zoom();

			$('.woocommerce-product-gallery__slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				arrows: false,
				asNavFor: '.woocommerce-product-gallery__slider-nav',
				prevArrow: '<button type=\"button\" class=\"slick-prev\">Prev</button>',
				nextArrow: '<button type=\"button\" class=\"slick-next\">Next</button>'
			});
			$('.woocommerce-product-gallery__slider-nav').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				focusOnSelect: true,
				asNavFor: '.woocommerce-product-gallery__slider'
			});
		}
		if ($('.quantity input').length > 0) {
			/* Plus Qty */
			$(document).on('click', '.qty-plus', function () {
				var parent = $(this).parent();
				$('input.qty', parent).val(parseInt($('input.qty', parent).val()) + 1);
				$('input.qty', parent).trigger('change');
			});
			/* Minus Qty */
			$(document).on('click', '.qty-minus', function () {
				var parent = $(this).parent();
				if (parseInt($('input.qty', parent).val()) > 1) {
					$('input.qty', parent).val(parseInt($('input.qty', parent).val()) - 1);
					$('input.qty', parent).trigger('change');
				}
			});
		}

	}

	/* Units custom */
	function ChambeshiUnitsCustom() {
		if ($('.wp-block-search__button').length > 0) {
			$('.wp-block-search__button svg').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">' +
				'<path d="M8.19119 16.3902C9.87762 16.3902 11.4356 15.8762 12.7365 15.0089L17.4424 19.7149C17.812 20.0843 18.4223 20.0843 18.8076 19.7149L19.7231 18.7994C20.0925 18.43 20.0925 17.8196 19.7231 17.4342L15.0011 12.7443C15.8683 11.4434 16.3824 9.88543 16.3824 8.19901C16.3824 3.68582 12.7044 0.0078125 8.19119 0.0078125C3.67801 0.0078125 0 3.68582 0 8.19901C0 12.712 3.66195 16.3902 8.19119 16.3902ZM8.19119 3.22004C10.9377 3.22004 13.1702 5.45255 13.1702 8.19901C13.1702 10.9455 10.9377 13.178 8.19119 13.178C5.44474 13.178 3.21223 10.9455 3.21223 8.19901C3.21223 5.45255 5.44474 3.22004 8.19119 3.22004Z" fill="white"/>' +
				'</svg>');
		}
	}
	/* Checkbox Custom Newsletter */
	function ChambeshiCheckboxCustom() {
		const $itemcheckbox = $('.tnp-privacy-field .tnp-privacy')
		if (!$itemcheckbox.length) return;
		const $divcheckbox = '<div class="checkmark"></div>';
		$itemcheckbox.parent().append($divcheckbox);

		if ($('.bt-newsletter-no-privacy').length > 0) {
			var privacyCheckbox = $('.bt-newsletter-no-privacy input.tnp-privacy');
			if (privacyCheckbox.length > 0 && !privacyCheckbox.prop('checked')) {
				privacyCheckbox.prop('checked', true);
			}
		}
	}
	/* Border Top arch */
	function ChambeshiBorderTop() {
		var elements = document.querySelectorAll('.bt-border-top-arch');
		if (window.innerWidth >= 768) {
			elements.forEach(function (element) {
				var width = element.offsetWidth;
				var borderRadius = width / 2 + 'px';
				element.style.borderTopLeftRadius = borderRadius;
				element.style.borderTopRightRadius = borderRadius;
			});
		} else {
			elements.forEach(function (element) {
				element.style.borderTopLeftRadius = '';
				element.style.borderTopRightRadius = '';
			});
		}
	};
	/* Get width body */
	function ChambeshiUpdateBodyWidthVariable() {
		var widthBody = $(window).width();
		$('.bt-col-container-left').css('--width-body', widthBody + 'px');
		$('.bt-col-container-right').css('--width-body', widthBody + 'px');
	}
	/* Counter Run */
	function ChambeshiCounter() {
		if ($('.bt-post--counter').length) {
			$('.bt-counter').each(function () {
				var $number = $(this).find('.bt-number');
				var countTo = $number.data('count');
	
				$({ countNum: 0 }).animate({
					countNum: countTo
				},
				{
					duration: 3000,
					easing: 'swing',
					step: function () {
						$number.text(Math.floor(this.countNum).toLocaleString());
					},
					complete: function () {
						$number.text(this.countNum.toLocaleString());
					}
				});
			});
		}
	}
	
	jQuery(document).ready(function ($) {
		ChambeshiSubmenuAuto();
		ChambeshiToggleMenuMobile();
		ChambeshiToggleSubMenuMobile();
		ChambeshiOrbitEffect();
		ChambeshiCursorEffect();
		ChambeshiBubleEffect();
		ChambeshiShop();
		ChambeshiUnitsCustom();
		ChambeshiCheckboxCustom();
		ChambeshiBorderTop();
		ChambeshiUpdateBodyWidthVariable();
		ChambeshiCounter();
	});

	jQuery(window).on('resize', function () {
		ChambeshiSubmenuAuto();
		ChambeshiBorderTop();
		ChambeshiUpdateBodyWidthVariable();
	});

	jQuery(window).on('scroll', function () {

	});

})(jQuery);
