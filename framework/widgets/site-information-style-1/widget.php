<?php
namespace ChambeshiElementorWidgets\Widgets\SiteInformationStyle1;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_SiteInformationStyle1 extends Widget_Base {

	public function get_name() {
		return 'bt-site-information-style-1';
	}

	public function get_title() {
		return __( 'Site Information Style 1', 'chambeshi' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'chambeshi' ];
	}

	protected function register_content_section_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'chambeshi' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Show Elements', 'chambeshi' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'phone'  => esc_html__( 'Phone', 'chambeshi' ),
					'email' => esc_html__( 'Email', 'chambeshi' ),
					'address' => esc_html__( 'Address', 'chambeshi' ),
				],
				'default' => [ 'phone', 'email' ],
			]
		);

		$this->end_controls_section();
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'chambeshi' ),
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label' => __( 'Space Between', 'chambeshi' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => __( 'Space Between', 'chambeshi' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls() {

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'chambeshi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_style',
			[
				'label' => __('Icon', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => __('Title', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item-content h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'chambeshi' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-elwg-site-infor--item-content h4',
			]
		);
		$this->add_control(
			'description_style',
			[
				'label' => __('Description', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item-content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Typography', 'chambeshi' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-elwg-site-infor--item-content p',
			]
		);
		$this->add_control(
			'text_style',
			[
				'label' => __('Text', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item-content span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'Color Hover', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item a:hover span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'Typography', 'chambeshi' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-elwg-site-infor--item-content span',
			]
		);

		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_content_section_controls();
		$this->register_layout_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if(empty($settings['list'])) {
			return;
		}
	?>
			<div class="bt-elwg-site-infor bt-elwg-site-infor--style-1">  
				<?php get_template_part( 'framework/templates/site-information', 'style', array('layout' => 'style-1', 'data' => $settings['list'])); ?>
			</div>
		<?php
	}

	protected function content_template() {

	}
}
