<?php

namespace ChambeshiElementorWidgets\Widgets\OpenJobs;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class Widget_OpenJobs extends Widget_Base
{

	public function get_name()
	{
		return 'bt-open-jobs';
	}

	public function get_title()
	{
		return __('Open Jobs', 'chambeshi');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['chambeshi'];
	}

	public function get_script_depends()
	{
		return ['elementor-widgets'];
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'chambeshi'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'jobs_title',
			[
				'label' => __('Title', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Financial Planning Associate', 'chambeshi'),
			]
		);

		$repeater->add_control(
			'jobs_location',
			[
				'label' => __('Location', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Australia & New Zealand', 'chambeshi'),
			]
		);
		$repeater->add_control(
			'jobs_button',
			[
				'label' => __('Button', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Apply Now', 'chambeshi'),
			]
		);
		$repeater->add_control(
			'jobs_button_url',
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
			'list',
			[
				'label' => __('List Time', 'chambeshi'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'jobs_title' => __('Financial Analyst & Credit Analyst', 'chambeshi'),
						'jobs_location' => __('Australia & New Zealand', 'chambeshi'),
						'jobs_button' => __('Apply Now', 'chambeshi'),
					],
					[
						'jobs_title' => __('Financial Analyst & Credit Analyst', 'chambeshi'),
						'jobs_location' => __('Australia & New Zealand', 'chambeshi'),
						'jobs_button' => __('Apply Now', 'chambeshi'),
					],
					[
						'jobs_title' => __('Tax Accountant', 'chambeshi'),
						'jobs_location' => __('Mexico', 'chambeshi'),
						'jobs_button' => __('Apply Now', 'chambeshi'),
					],
				],
				'title_field' => '{{{ jobs_title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_section_controls()
	{

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__('Icon', 'chambeshi'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'time_enable_icon' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Size', 'chambeshi'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 54,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'column-gap: {{SIZE}}{{UNIT}}',
				],

				'condition' => [
					'time_enable_icon' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'icon_gap',
			[
				'label' => __('Space Between', 'chambeshi'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'column-gap: {{SIZE}}{{UNIT}}',
				],

				'condition' => [
					'time_enable_icon' => 'yes',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'chambeshi'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'jobs_title_style',
			[
				'label' => __('Title', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'jobs_title_color',
			[
				'label' => __('Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-jobs--title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'jobs_title_typography',
				'label' => __('Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-jobs--title',
			]
		);

		$this->add_control(
			'jobs_location_style',
			[
				'label' => __('Hours', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'jobs_location_color',
			[
				'label' => __('Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-jobs--location' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'jobs_location_typography',
				'label' => __('Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-jobs--location',
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
					'{{WRAPPER}} .bt-jobs--button' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bt-jobs--button' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
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
					'{{WRAPPER}} .bt-jobs--button:hover' => 'color: {{VALUE}} !important;',
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
					'{{WRAPPER}} .bt-jobs--button:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		if (empty($settings['list'])) {
			return;
		}
?>
		<div class="bt-elwg-open-jobs--default">
			<ul class="bt-jobs">
				<?php
				foreach ($settings['list'] as $index => $item) {
					$item_key = 'jobs_button_url_' . $index;
				?>
					<li class="bt-jobs--item">
						<div class="bt-jobs--number">
							<?php echo ($index + 1) . '.' ?>
						</div>
						<div class="bt-jobs--infor">
							<div class="bt-jobs--info">
								<div class="bt-jobs--title">
									<?php echo esc_html($item['jobs_title']); ?>
								</div>
								<div class="bt-jobs--location">
									<?php echo esc_html($item['jobs_location']); ?>
								</div>
							</div>
							<?php
							   if (!empty($item['jobs_button_url']['url'])) {
								$this->add_link_attributes($item_key, $item['jobs_button_url']);
							}
							if (!empty($item['jobs_button'])) {
								echo '<a class="bt-jobs--button" ' . $this->get_render_attribute_string($item_key) . '><span>' . esc_html($item['jobs_button']) . '</span></a>';
							}
							?>
						</div>
					</li>
				<?php }
				?>
			</ul>
		</div>
<?php
	}

	protected function content_template() {}
}
