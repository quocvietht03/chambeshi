<?php

namespace ChambeshiElementorWidgets\Widgets\ProjectGrid;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_ProjectGrid extends Widget_Base
{

	public function get_name()
	{
		return 'bt-project-grid';
	}

	public function get_title()
	{
		return __('Project Grid', 'chambeshi');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['chambeshi'];
	}

	protected function get_supported_ids()
	{
		$supported_ids = [];

		$wp_query = new \WP_Query(array(
			'post_type' => 'project',
			'post_status' => 'publish'
		));

		if ($wp_query->have_posts()) {
			while ($wp_query->have_posts()) {
				$wp_query->the_post();
				$supported_ids[get_the_ID()] = get_the_title();
			}
		}

		return $supported_ids;
	}

	public function get_supported_taxonomies()
	{
		$supported_taxonomies = [];

		$categories = get_terms(array(
			'taxonomy' => 'project_categories',
			'hide_empty' => false,
		));
		if (!empty($categories)  && !is_wp_error($categories)) {
			foreach ($categories as $category) {
				$supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __('Layout', 'chambeshi'),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __('Posts Per Page', 'chambeshi'),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
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
					'size' => 0.66,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					//'{{WRAPPER}} .bt-post--featured .bt-cover-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label' => __('Pagination', 'chambeshi'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'chambeshi'),
				'label_off' => __('Hide', 'chambeshi'),
				'default' => '',
			]
		);

		$this->end_controls_section();
	}

	protected function register_query_section_controls()
	{
		$this->start_controls_section(
			'section_query',
			[
				'label' => __('Query', 'chambeshi'),
			]
		);

		$this->start_controls_tabs('tabs_query');

		$this->start_controls_tab(
			'tab_query_include',
			[
				'label' => __('Include', 'chambeshi'),
			]
		);

		$this->add_control(
			'ids',
			[
				'label' => __('Ids', 'chambeshi'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __('Category', 'chambeshi'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_query_exnlude',
			[
				'label' => __('Exclude', 'chambeshi'),
			]
		);

		$this->add_control(
			'ids_exclude',
			[
				'label' => __('Ids', 'chambeshi'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category_exclude',
			[
				'label' => __('Category', 'chambeshi'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => __('Offset', 'chambeshi'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'description' => __('Use this setting to skip over posts (e.g. \'2\' to skip over 2 posts).', 'chambeshi'),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'orderby',
			[
				'label' => __('Order By', 'chambeshi'),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => __('Date', 'chambeshi'),
					'post_title' => __('Title', 'chambeshi'),
					'menu_order' => __('Menu Order', 'chambeshi'),
					'rand' => __('Random', 'chambeshi'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __('Order', 'chambeshi'),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __('ASC', 'chambeshi'),
					'desc' => __('DESC', 'chambeshi'),
				],
			]
		);

		$this->end_controls_section();
	}


	protected function register_style_section_controls()
	{
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Image', 'chambeshi'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __('Border Radius', 'chambeshi'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .bt-post--featured .bt-cover-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('thumbnail_effects_tabs');

		$this->start_controls_tab(
			'thumbnail_tab_normal',
			[
				'label' => __('Normal', 'chambeshi'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .bt-post--featured img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'thumbnail_tab_hover',
			[
				'label' => __('Hover', 'chambeshi'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .bt-post:hover .bt-post--featured img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'chambeshi'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'date_style',
			[
				'label' => __('Date', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'date_color',
			[
				'label' => __('Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--publish' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => __('Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--publish',
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
				'label' => __('Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __('Color Hover', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--title',
			]
		);

		$this->add_control(
			'meta_style',
			[
				'label' => __('Meta', 'chambeshi'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __('Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_color_hover',
			[
				'label' => __('Color Hover', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __('Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--meta',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_pagination',
			[
				'label' => esc_html__('Pagination', 'chambeshi'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination!' => '',
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label' => __('Color', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pagination .page-numbers:not(.current)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_color_hover',
			[
				'label' => __('Color Hover', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pagination .page-numbers:not(.current, .dots):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_color_current',
			[
				'label' => __('Color Current', 'chambeshi'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pagination .page-numbers.current' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pagination_typography',
				'label' => __('Typography', 'chambeshi'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pagination .page-numbers',
			]
		);

		$this->add_responsive_control(
			'pagination_space',
			[
				'label' => __('Space', 'chambeshi'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 60,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{

		$this->register_layout_section_controls();
		$this->register_query_section_controls();

		$this->register_style_section_controls();
	}

	public function query_posts()
	{
		$settings = $this->get_settings_for_display();

		$args = [
			'post_type' => 'project',
			'post_status' => 'publish',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
		];

		if ($settings['show_pagination'] == 'yes') {
			$args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}

		if (!empty($settings['ids'])) {
			$args['post__in'] = $settings['ids'];
		}

		if (!empty($settings['ids_exclude'])) {
			$args['post__not_in'] = $settings['ids_exclude'];
		}

		if (!empty($settings['category'])) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'project_categories',
					'terms' 		=> $settings['category'],
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
			);
		}

		if (!empty($settings['category_exclude'])) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'project_categories',
					'terms' 		=> $settings['category_exclude'],
					'field' 		=> 'term_id',
					'operator' 		=> 'NOT IN'
				)
			);
		}

		if (0 !== absint($settings['offset'])) {
			$args['offset'] = $settings['offset'];
		}

		return $query = new \WP_Query($args);
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$query = $this->query_posts();

?>
		<div class="bt-elwg-project-grid--default">
			<?php
			if ($query->have_posts()) {
			?>
				<div class="bt-project-grid">
					<?php
					while ($query->have_posts()) : $query->the_post();
						get_template_part('framework/templates/project-grid', 'style', array('image-size' => $settings['thumbnail_size'], 'layout' => 'default'));
					endwhile;
					?>
				</div>
			<?php
				if ($settings['show_pagination'] == 'yes') {
					chambeshi_paginate_links($query);
				}
			} else {
				get_template_part('framework/templates/post', 'none');
			}
			?>
		</div>
<?php
		wp_reset_postdata();
	}

	protected function content_template()
	{
	}
}
