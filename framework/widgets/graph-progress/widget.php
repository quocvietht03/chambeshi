<?php

namespace ChambeshiElementorWidgets\Widgets\GraphProgress;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class Widget_GraphProgress extends Widget_Base
{

	public function get_name()
	{
		return 'bt-graph-progress';
	}

	public function get_title()
	{
		return __('Graph Progress', 'chambeshi');
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
			'graph_title',
			[
				'label' => __('Title', 'chambeshi'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('2024', 'chambeshi'),
			]
		);

		$repeater->add_control(
			'graph_percentage',
			[
				'label' => __('Percentage', 'chambeshi'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
			]
		);



		$this->add_control(
			'graph',
			[
				'label' => __('Graph Progress', 'chambeshi'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'graph_title' => __('2021', 'chambeshi'),
						'graph_percentage' => [
							'size' => 65,
						],
					],
					[
						'graph_title' => __('2022', 'chambeshi'),
						'graph_percentage' => [
							'size' => 100,
						],
					],
					[
						'graph_title' => __('2023', 'chambeshi'),
						'graph_percentage' => [
							'size' => 79,
						],
					],
					[
						'graph_title' => __('2024', 'chambeshi'),
						'graph_percentage' => [
							'size' => 65,
						],
					],
				],
				'title_field' => '{{{ graph_title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_section_controls()
	{
		$this->start_controls_section(
			'section_style_progress',
			[
				'label' => esc_html__('Progress', 'chambeshi'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'graph_gap',
			[
				'label' => __('Space Between', 'chambeshi'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-graph-progress' => 'column-gap: {{SIZE}}{{UNIT}}',
				],

			]
		);
		$this->add_control(
			'progress_color',
			[
				'label' => __('Progress Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-graph-progress--default .bt-graph-progress li .bt-progress-bar' => 'background-color: {{VALUE}};',
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
			'graph_title_style',
			[
				'label' => __('Title', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'graph_title_color',
			[
				'label' => __('Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-progress-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'graph_title_typography',
				'label' => __('Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-elwg-graph-progress--default .bt-graph-progress .bt-progress-bar .bt-progress-text',
			]
		);

		$this->add_control(
			'graph_percentage_style',
			[
				'label' => __('Percentage', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'graph_percentage_color',
			[
				'label' => __('Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-progress-percentage' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'graph_percentage_typography',
				'label' => __('Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-progress-percentage',
			]
		);
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
		$site_information = get_field('site_information', 'options');
		if (empty($settings['graph'])) {
			return;
		}
?>
		<div class="bt-elwg-graph-progress--default">
			<ul class="bt-graph-progress">

				<?php foreach ($settings['graph'] as $index => $item) {
				?>
					<li class="bt-progress--item">

						<div class="bt-progress-bar" data-percentage="<?php echo esc_html($item['graph_percentage']['size']) ?>">
							<?php if ($item['graph_percentage']['size'] > 20) { ?>
								<span class="bt-progress-percentage"><?php echo esc_html($item['graph_percentage']['size']) ?>%</span>
							<?php } ?>
							<?php if ($item['graph_percentage']['size'] > 30) { ?>
								<span class="bt-progress-text"><?php echo esc_html($item['graph_title']) ?></span>
							<?php } ?>
						</div>
					</li>
				<?php } ?>
			</ul>
		</div>
<?php
	}

	protected function content_template() {}
}
