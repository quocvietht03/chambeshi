<?php

namespace ChambeshiElementorWidgets\Widgets\PageBreadcrumb;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_PageBreadcrumb extends Widget_Base
{

	public function get_name()
	{
		return 'bt-page-breadcrumb';
	}

	public function get_title()
	{
		return __('Page Breadcrumb', 'chambeshi');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['chambeshi'];
	}


	protected function register_style_content_section_controls()
	{

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'chambeshi'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_breadcrumb',
			[
				'label' => esc_html__('Choose Home Image', 'chambeshi'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'media_types' => ['svg'],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __('Background Color Home Image', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-breadcrumb' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_color_breadcrumb',
			[
				'label' => __('Background Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-page-breadcrumb' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-breadcrumb' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __('Text Color Hover', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-breadcrumb' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __('Text Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-page-breadcrumb',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{

		$this->register_style_content_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$svg_url = $settings['icon_breadcrumb']['url'];
?>
		<div class="bt-elwg-page-breadcrumb">
			<?php if (!empty($svg_url) && 'svg' === pathinfo($svg_url, PATHINFO_EXTENSION)) { ?>
				<div class="icon-breadcrumb">
					<?php echo file_get_contents($svg_url); ?>
				</div>
			<?php } else {
			?>
				<div class="icon-breadcrumb">
					<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
						<g clip-path="url(#clip0_23_8643)">
							<path d="M18.525 8.22699C18.5244 8.22656 18.524 8.22598 18.5236 8.22554L10.7731 0.47532C10.4427 0.144814 10.0035 -0.0371094 9.53628 -0.0371094C9.06907 -0.0371094 8.62985 0.144814 8.29934 0.47532L0.552892 8.22163C0.550283 8.22424 0.547529 8.22699 0.545064 8.2296C-0.133343 8.91192 -0.132183 10.019 0.548398 10.6996C0.859335 11.0106 1.26986 11.1907 1.70894 11.2097C1.72691 11.2114 1.74489 11.2123 1.76301 11.2123H2.07177V16.9158C2.07177 18.0446 2.99023 18.9629 4.11902 18.9629H7.15127C7.45873 18.9629 7.70791 18.7136 7.70791 18.4063V13.9346C7.70791 13.4196 8.12699 13.0006 8.64203 13.0006H10.4305C10.9456 13.0006 11.3645 13.4196 11.3645 13.9346V18.4063C11.3645 18.7136 11.6137 18.9629 11.9211 18.9629H14.9534C16.0823 18.9629 17.0006 18.0446 17.0006 16.9158V11.2123H17.2871C17.7541 11.2123 18.1934 11.0303 18.524 10.6997C19.2053 10.0181 19.2056 8.90902 18.525 8.22699ZM17.7367 9.91257C17.6166 10.0327 17.4568 10.099 17.2871 10.099H16.444C16.1365 10.099 15.8874 10.3482 15.8874 10.6556V16.9158C15.8874 17.4307 15.4684 17.8496 14.9534 17.8496H12.4778V13.9346C12.4778 12.8058 11.5595 11.8873 10.4305 11.8873H8.64203C7.51309 11.8873 6.59463 12.8058 6.59463 13.9346V17.8496H4.11902C3.60413 17.8496 3.18505 17.4307 3.18505 16.9158V10.6556C3.18505 10.3482 2.93587 10.099 2.62841 10.099H1.79983C1.79113 10.0984 1.78258 10.098 1.77374 10.0978C1.6079 10.0949 1.45236 10.0291 1.33581 9.91243C1.08794 9.66455 1.08794 9.26113 1.33581 9.0131C1.33596 9.0131 1.33596 9.01296 1.3361 9.01281L1.33654 9.01238L9.08676 1.26245C9.20679 1.14228 9.36639 1.07617 9.53628 1.07617C9.70602 1.07617 9.86562 1.14228 9.98579 1.26245L17.7343 9.01078C17.7354 9.01194 17.7367 9.0131 17.7379 9.01426C17.9845 9.26258 17.984 9.66513 17.7367 9.91257Z" fill="white"></path>
						</g>
						<defs>
							<clipPath id="clip0_23_8643">
								<rect width="19" height="19" fill="white"></rect>
							</clipPath>
						</defs>
					</svg>
				</div>
			<?php
			} ?>

			<div class="bt-page-breadcrumb">
				<?php
				$home_text = esc_html__('Home', 'chambeshi');
				$delimiter = '>';
				echo chambeshi_page_breadcrumb($home_text, $delimiter);
				?>
			</div>
		</div>
<?php
	}

	protected function content_template() {}
}
