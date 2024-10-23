<?php
namespace ChambeshiElementorWidgets\Widgets\ServiceLoopItemStyle2;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_ServiceLoopItemStyle2 extends Widget_Base
{


    public function get_name()
    {
        return 'bt-service-loop-item-style2';
    }

    public function get_title()
    {
        return __('Service Loop Item - Style 2', 'chambeshi');
    }

    public function get_icon()
    {
        return 'eicon-posts-ticker';
    }

    public function get_categories()
    {
        return ['chambeshi'];
    }

    protected function register_layout_section_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'chambeshi'),
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'chambeshi'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 70,
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bt-post--icon img, {{WRAPPER}} .bt-post--icon svg' => 'max-width: {{SIZE}}px;',
                ],
            ]
        );
        $this->add_control(
            'text_align_content',
            [
                'label' => esc_html__('Alignment', 'chambeshi'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'chambeshi'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'chambeshi'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'chambeshi'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .bt-post--inner, {{WRAPPER}} .bt-post--button' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_section_controls()
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
                'label' => esc_html__('Background Content', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-post--inner' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'margin',
            [
                'label' => esc_html__('Border Radius Content', 'chambeshi'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .bt-post--inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'title_style',
            [
                'label' => esc_html__('Title', 'chambeshi'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-post--title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Color Hover', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-post--title:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'chambeshi'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-post--title',
            ]
        );

        $this->add_control(
            'description_style',
            [
                'label' => esc_html__('Description', 'chambeshi'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-post--excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'chambeshi'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-post--excerpt',
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label' => esc_html__('Button', 'chambeshi'),
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
            'button_bg_color',
            [
                'label' => __('Background Color', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-post--button .bt-post--link' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_icon_color',
            [
                'label' => __('Icon Color', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-post--button svg path' => 'fill: {{VALUE}};',
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
            'button_bg_color_hover',
            [
                'label' => __('Background Color', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-post--link:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_color_hover',
            [
                'label' => __('Icon Color', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-post--button .bt-post--link:hover svg path' => 'fill: {{VALUE}};',
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
        ?>
        <div class="bt-elwg-service-loop-item--style2 bt-image-effect">
            <?php get_template_part('framework/templates/service', 'style2'); ?>
        </div>
        <?php
    }

    protected function content_template()
    {

    }
}
