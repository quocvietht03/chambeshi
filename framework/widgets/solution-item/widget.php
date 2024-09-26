<?php

namespace ChambeshiElementorWidgets\Widgets\SolutionItem;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_SolutionItem extends Widget_Base
{

	public function get_name()
	{
		return 'bt-solution-item';
	}

	public function get_title()
	{
		return __('Solution Item', 'chambeshi');
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
			'solution_image',
			[
				'label' => esc_html__('Images', 'chambeshi'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'solution_image',
				'label' => __('Image Size', 'chambeshi'),
				'show_label' => true,
				'default' => 'medium',
				'exclude' => ['custom'],
			]
		);

		$this->add_responsive_control(
			'image_ratio',
			[
				'label' => __('Image Ratio', 'chambeshi'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' =>  0.53,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-solution--featured .bt-cover-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
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
			'description_info',
			[
				'label' => esc_html__('Description Info', 'chambeshi'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Learn More', 'chambeshi'),
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
					'{{WRAPPER}} .bt-solution' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .bt-solution',
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
			'heading_solution',
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
					'{{WRAPPER}} .bt-solution--heading' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bt-solution--heading:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __('Heading Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-solution--heading',
			]
		);
		$this->add_control(
			'description_info_solution',
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
					'{{WRAPPER}} .bt-solution--description' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __('Info Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-solution--description',
			]
		);
		$this->add_control(
			'button_solution',
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
					'{{WRAPPER}} .bt-solution--button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-solution--button:hover span:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .bt-solution--button svg' => 'fill: {{VALUE}};',
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
				'label' => __('Text Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-solution--button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-solution--button:hover span:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .bt-solution--button:hover svg' => 'fill: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .bt-solution--button',
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
		<div class="bt-elwg-solution-item--default">
			<div class="bt-solution">

				<div class="bt-solution--infor">
					<?php
					if (!empty($settings['heading'])) {
						echo '<h3 class="bt-solution--heading">' . esc_html($settings['heading']) . '</h3>';
					}
					?>
					<?php if (!empty($settings['description_info'])) {
						echo '<div class="bt-solution--description">' . $settings['description_info'] . '</div>';
					} ?>
					<?php
					if (!empty($settings['button_url']['url'])) {
						$this->add_link_attributes('button_url', $settings['button_url']);
					}

					if (!empty($settings['button_text'])) {
						echo '<a class="bt-solution--button bt-button-effect" ' . $this->get_render_attribute_string('button_url') . '><span>' . esc_html($settings['button_text']) . '</span><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="#4F6A35">
<path d="M20.8141 10.352L14.3974 3.9353C14.2245 3.76832 13.993 3.67592 13.7526 3.67801C13.5123 3.6801 13.2824 3.77651 13.1124 3.94646C12.9425 4.11642 12.8461 4.34633 12.844 4.58668C12.8419 4.82703 12.9343 5.05858 13.1013 5.23146L17.9532 10.0834H1.83268C1.58957 10.0834 1.35641 10.18 1.1845 10.3519C1.01259 10.5238 0.916016 10.7569 0.916016 11C0.916016 11.2432 1.01259 11.4763 1.1845 11.6482C1.35641 11.8201 1.58957 11.9167 1.83268 11.9167H17.9532L13.1013 16.7686C13.0137 16.8532 12.9439 16.9543 12.8958 17.0662C12.8478 17.178 12.8225 17.2983 12.8215 17.42C12.8204 17.5417 12.8436 17.6624 12.8897 17.7751C12.9358 17.8877 13.0038 17.9901 13.0899 18.0762C13.176 18.1622 13.2783 18.2303 13.391 18.2764C13.5036 18.3225 13.6243 18.3457 13.746 18.3446C13.8678 18.3436 13.988 18.3183 14.0999 18.2702C14.2117 18.2222 14.3129 18.1523 14.3974 18.0648L20.8141 11.6481C20.9859 11.4762 21.0825 11.2431 21.0825 11C21.0825 10.757 20.9859 10.5239 20.8141 10.352Z" />
</svg></a>';
					}
					?>
				</div>
				<div class="bt-solution--featured">
					<?php if (!empty($settings['solution_image'])) {
						$image = $settings['solution_image'];
						$image_url = Group_Control_Image_Size::get_attachment_image_src($image['id'], 'solution_image', $settings);
						if (!$image_url) {
							$image_url = $image['url'];
						}
					?>
						<div class="bt-cover-image">
							<img src="<?php echo esc_url($image_url) ?>" alt="" />
						</div>

					<?php } ?>
				</div>
			</div>
		</div>
<?php
	}

	protected function content_template() {}
}
