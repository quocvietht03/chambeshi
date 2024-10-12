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

	protected function register_content_section_controls() {}

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
				'label' => esc_html__( 'Choose Home Image', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'media_types' => ['svg'],
			]
		);

		$this->add_control(
			'icon_color',
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
			'icon_color',
			[
				'label' => __('Icon Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-breadcrumb .bt-deli' => 'color: {{VALUE}};',
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
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$svg_url = $settings['icon_breadcrumb']['url'];
?>
		<div class="bt-elwg-page-breadcrumb">
			<?php if ( !empty($svg_url) && 'svg' === pathinfo($svg_url, PATHINFO_EXTENSION) ) { ?>
				<div class="icon-breadcrumb">
					<?php echo file_get_contents($svg_url); ?>
				</div>
			<?php } ?>
			
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
