<?php
namespace ChambeshiElementorWidgets\Widgets\CompanyLoopItem;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_CompanyLoopItem extends Widget_Base {

	public function get_name() {
		return 'bt-company-loop-item';
	}

	public function get_title() {
		return __( 'Company Loop Item', 'chambeshi' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'chambeshi' ];
	}

	protected function register_layout_section_controls() {

	}

	protected function register_style_section_controls() {

		$this->start_controls_section(
			'section_style_box',
			[
				'label' => esc_html__( 'Box', 'chambeshi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_border_width',
			[
				'label' => __( 'Border Width', 'chambeshi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-post--inner' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'chambeshi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bt-post--inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'chambeshi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-post--inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .bt-post--inner',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bt-post--inner' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bt-post--inner' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function register_controls() {
		// $this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$logo = get_field('logo');
		$link = get_field('link');

		?>
			<div class="bt-elwg-company-loop-item--default">
				<?php get_template_part( 'framework/templates/company', 'style' ); ?>
	    </div>
		<?php
	}

	protected function content_template() {

	}
}