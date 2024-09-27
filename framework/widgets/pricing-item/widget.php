<?php

namespace ChambeshiElementorWidgets\Widgets\PricingItem;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_PricingItem extends Widget_Base
{

	public function get_name()
	{
		return 'bt-pricing-item';
	}

	public function get_title()
	{
		return __('Pricing Item', 'chambeshi');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['chambeshi'];
	}

	protected function register_content_section_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'chambeshi'),
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => esc_html__('Heading', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('This is the heading', 'chambeshi'),
			]
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'chambeshi'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Great for private individuals', 'chambeshi'),
			]
		);
		$this->add_control(
			'price',
			[
				'label' => esc_html__('Price', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('$200', 'chambeshi'),
			]
		);
		$this->add_control(
			'price_before',
			[
				'label' => esc_html__('Price Before', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Starting at', 'chambeshi'),
			]
		);
		$this->add_control(
			'price_after',
			[
				'label' => esc_html__('Price After', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__(' /mo', 'chambeshi'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_content',
			[
				'label' => __('Content', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('This is the info', 'chambeshi'),
			]
		);

		$this->add_control(
			'list_info',
			[
				'label' => __('List Info', 'chambeshi'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_content' => esc_html__('Up to 10 individual users', 'chambeshi')
					],
					[
						'list_content' => esc_html__('Basic reporting & analytics', 'chambeshi')
					],
					[
						'list_content' => esc_html__('Project Management', 'chambeshi')
					],
					[
						'list_content' => esc_html__('20GB individual data', 'chambeshi')
					],
				],
				'title_field' => '{{{ list_content }}}',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Try For Free', 'chambeshi'),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => esc_html__('Button Url', 'chambeshi'),
				'type' => Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'text_after_button',
			[
				'label' => esc_html__('Text After Button', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Free forever & can be upgraded.', 'chambeshi'),
			]
		);
		$this->end_controls_section();
	}

	protected function register_style_box_section_controls()
	{


		$this->start_controls_section(
			'section_style_box',
			[
				'label' => esc_html__('Box', 'chambeshi'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'box_border_radius',
			[
				'label' => __('Border Radius', 'chambeshi'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .bt-pricing-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .bt-pricing-item',
			]
		);

		$this->end_controls_section();
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
			'background_content',
			[
				'label' => __('Background Content', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing-item' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'background_box_price',
			[
				'label' => __('Background Box Price', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--box-price' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_pricing',
			[
				'label' => __('Heading', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' => __('Heading Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--heading' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_color_hover',
			[
				'label' => __('Heading Color Hover', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--heading:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __('Heading Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--heading',
			]
		);
		$this->add_control(
			'description_pricing',
			[
				'label' => __('Description', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => __('Description Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--description' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __('Description Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--description',
			]
		);
		$this->add_control(
			'price_pricing',
			[
				'label' => __('Price', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_color',
			[
				'label' => __('Price Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __('Price Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--price',
			]
		);
		$this->add_control(
			'price_before_pricing',
			[
				'label' => __('Price Before', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_before_color',
			[
				'label' => __('Price Before Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--price-before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_before_typography',
				'label' => __('Price Before Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--price-before',
			]
		);
		$this->add_control(
			'price_after_pricing',
			[
				'label' => __('Price After', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_after_color',
			[
				'label' => __('Price After Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--price-after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_after_typography',
				'label' => __('Price After Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--price-after',
			]
		);

		$this->add_control(
			'list_info_pricing',
			[
				'label' => __('List Info', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_info_color',
			[
				'label' => __('Icon Info Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--info li svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'info_color',
			[
				'label' => __('Info Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--info li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_typography',
				'label' => __('Info Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--info li',
			]
		);
		$this->add_control(
			'button_pricing',
			[
				'label' => __('Button', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->start_controls_tabs('button_style_tabs');

		$this->start_controls_tab(
			'style_normal',
			[
				'label' => __('Normal', 'chambeshi'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __('Text Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __('Background Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--button' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover',
			[
				'label' => __('Hover', 'chambeshi'),
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => __('Text Color Hover', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--button:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label' => __('Background Color Hover', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--button:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __('Button Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--button',
			]
		);
		$this->add_control(
			'text_after_button_pricing',
			[
				'label' => __('Text After Button', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'text_after_button_color',
			[
				'label' => __('Text After Button Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--text-after-button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_after_button_typography',
				'label' => __('Text After Button Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--text-after-button',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();
		$this->register_style_box_section_controls();
	}
	protected function render()
	{
		$settings = $this->get_settings_for_display();

?>
		<div class="bt-elwg-pricing-item--default">
			<div class="bt-pricing-item ">
				<div class="bt-pricing--header">
					<?php
					if (!empty($settings['heading'])) {
						echo '<h3 class="bt-pricing--heading">' . esc_html($settings['heading']) . '</h3>';
					}
					?>
					<?php
					if (!empty($settings['description'])) {
						echo '<div class="bt-pricing--description">' . esc_html($settings['description']) . '</div>';
					}
					?>
				</div>
				<div class="bt-pricing--box-price">
					<?php
					if (!empty($settings['price_before'])) {
						echo '<span class="bt-pricing--price-before">' . esc_html($settings['price_before']) . '</span>';
					}
					echo '<div class="bt-pricing--price">';
					if (!empty($settings['price'])) {
						echo esc_html($settings['price']);
					}
					if (!empty($settings['price_after'])) {
						echo '<span class="bt-pricing--price-after">' . esc_html($settings['price_after']) . '</span>';
					}
					echo '</div>';
					?>
				</div>
				<div class="bt-pricing--infor">
					<?php if (!empty($settings['list_info'])) { ?>
						<ul class="bt-pricing--info">
							<?php foreach ($settings['list_info'] as $item) { ?>
								<li>
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
										<path d="M3.05534 9.25979C2.71016 9.26076 2.37232 9.35944 2.08089 9.5444C1.78945 9.72937 1.55634 9.99307 1.40853 10.305C1.26071 10.6169 1.20422 10.9643 1.24561 11.307C1.28699 11.6497 1.42455 11.9736 1.64238 12.2414L6.28584 17.9296C6.4514 18.1352 6.66362 18.2983 6.90488 18.4054C7.14614 18.5125 7.40947 18.5605 7.67299 18.5454C8.23661 18.5151 8.74545 18.2136 9.06988 17.7179L18.7155 2.18356C18.7171 2.18099 18.7188 2.17841 18.7205 2.17587C18.811 2.03691 18.7816 1.76152 18.5948 1.58852C18.5435 1.54102 18.483 1.50452 18.417 1.48127C18.3511 1.45803 18.2811 1.44854 18.2113 1.45338C18.1415 1.45822 18.0735 1.47729 18.0114 1.50941C17.9493 1.54154 17.8944 1.58604 17.8501 1.64018C17.8466 1.64444 17.8431 1.64863 17.8394 1.65276L8.11164 12.6437C8.07463 12.6855 8.02967 12.7196 7.97939 12.7439C7.9291 12.7682 7.87448 12.7822 7.81871 12.7852C7.76294 12.7883 7.70713 12.7802 7.65451 12.7614C7.6019 12.7427 7.55353 12.7137 7.51222 12.6761L4.28376 9.73818C3.94846 9.43081 3.51021 9.26014 3.05534 9.25979Z" fill="#4F6A35" />
									</svg><?php echo esc_html($item['list_content']); ?>
								</li>
							<?php } ?>
						</ul>
					<?php
					}
					echo '<div class="bt-pricing--button-wrapper">';
					if (!empty($settings['button_url']['url'])) {
						$this->add_link_attributes('button_url', $settings['button_url']);
					}

					if (!empty($settings['button_text'])) {
						echo '<a class="bt-pricing--button bt-button-effect" ' . $this->get_render_attribute_string('button_url') . '>' . esc_html($settings['button_text']) . '</a>';
					}

					if (!empty($settings['text_after_button'])) {
						echo '<span class="bt-pricing--text-after-button">' . esc_html($settings['text_after_button']) . '</span>';
					}
					echo '</div>';
					?>
				</div>
			</div>
		</div>
<?php
	}

	protected function content_template() {}
}
