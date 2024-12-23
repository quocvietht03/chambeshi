<?php
namespace ChambeshiElementorWidgets\Widgets\ProjectLoopItem;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

class Widget_ProjectLoopItem extends Widget_Base {


	public function get_name() {
		return 'bt-project-loop-item';
	}

	public function get_title() {
		return __( 'Project Loop Item', 'chambeshi' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'chambeshi' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'chambeshi' ),
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'label' => __( 'Image Size', 'chambeshi' ),
				'show_label' => true,
				'default' => 'medium',
				'exclude' => [ 'custom' ],
			]
		);

		$this->add_responsive_control(
			'image_ratio',[
				'label' => __( 'Image Ratio', 'chambeshi' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.64,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-post--featured .bt-cover-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function register_style_section_controls() {

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'chambeshi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'chambeshi' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bt-post--featured .bt-cover-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab( 'thumbnail_tab_normal',
			[
				'label' => __( 'Normal', 'chambeshi' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .bt-post--featured img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'thumbnail_tab_hover',[
				'label' => __( 'Hover', 'chambeshi' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),[
				'name'     => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .bt-post:hover .bt-post--featured img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',[
				'label' => esc_html__( 'Content', 'chambeshi' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'background_hover',[
				'label'     => esc_html__( 'Background Hover', 'chambeshi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--content::before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_style',[
				'label' => esc_html__( 'Title', 'chambeshi' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',[
				'label'     => esc_html__( 'Color', 'chambeshi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',[
				'label'     => esc_html__( 'Color Hover', 'chambeshi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'chambeshi' ),
				'default'  => '',
				'selector' => '{{WRAPPER}} .bt-post--title a',
			]
		);

		$this->add_control(
			'category_style',[
				'label' => esc_html__( 'Category', 'chambeshi' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'category_color',[
				'label'     => esc_html__( 'Color', 'chambeshi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--category a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'category_background',[
				'label'     => esc_html__( 'Background', 'chambeshi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--category a' => 'Background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__( 'Typography', 'chambeshi' ),
				'default'  => '',
				'selector' => '{{WRAPPER}} .bt-post--category a',
			]
		);

		$this->add_control(
			'button_style',[
				'label' => esc_html__( 'Button', 'chambeshi' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'button_style_tabs' );

		$this->start_controls_tab( 'style_button_normal',
			[
				'label' => __( 'Normal', 'chambeshi' ),
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'label' => __( 'Icon Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--button svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'style_hover_button_normal',
			[
				'label' => __( 'Hover', 'chambeshi' ),
			]
		);

		$this->add_control(
			'button_icon_color_hover',
			[
				'label' => __( 'Background Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--button:hover' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label' => __( 'Icon Color', 'chambeshi' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--button:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			<div class="bt-elwg-project-loop-item--default">
				<?php get_template_part( 'framework/templates/project', 'style', array('image-size' => $settings['thumbnail_size'])); ?>
	    	</div>
		<?php
	}

	protected function content_template() {

	}
}
