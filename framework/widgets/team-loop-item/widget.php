<?php
namespace ChambeshiElementorWidgets\Widgets\TeamLoopItem;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_TeamLoopItem extends Widget_Base {


	public function get_name() {
		return 'bt-team-loop-item';
	}

	public function get_title() {
		return __( 'Team Loop Item', 'chambeshi' );
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
					'size' => 0.5,
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
			'content_background',[
				'label'     => esc_html__( 'Background Content', 'chambeshi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--infor' => 'background: {{VALUE}};',
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
			'job_style',[
				'label' => esc_html__( 'Job', 'chambeshi' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'job_color',[
				'label'     => esc_html__( 'Color', 'chambeshi' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--job' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'job_typography',
				'label'    => esc_html__( 'Typography', 'chambeshi' ),
				'default'  => '',
				'selector' => '{{WRAPPER}} .bt-post--job',
			]
		);

		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			<div class="bt-elwg-team-loop-item--default bt-image-effect">
				<?php get_template_part( 'framework/templates/team', 'style', array('image-size' => $settings['thumbnail_size'])); ?>
	    	</div>
		<?php
	}

	protected function content_template() {

	}
}