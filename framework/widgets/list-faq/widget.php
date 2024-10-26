<?php

namespace chambeshiElementorWidgets\Widgets\ListFaq;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;


class Widget_ListFaq extends Widget_Base
{

    public function get_name()
    {
        return 'bt-list-faq';
    }

    public function get_title()
    {
        return __('List FAQ', 'chambeshi');
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
            'faq_title',
            [
                'label' => __('Text', 'chambeshi'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('FAQ title', 'chambeshi'),
            ]
        );

        $repeater->add_control(
            'faq_content',
            [
                'label' => __('Content', 'chambeshi'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('FAQ content', 'chambeshi'),
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __('List Faq', 'chambeshi'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'faq_title' => __('FAQ title 01', 'chambeshi'),
                        'faq_content' => 'Quisque imperdiet dignissim enim dictum finibus. Sed consectetutr convallis enim eget laoreet. Aenean vitae nisl mollis, porta risus vel, dapibus lectus. Etiam ac suscipit eros, eget maximus.'
                    ],
                    [
                        'faq_title' => __('FAQ title 02', 'chambeshi'),
                        'faq_content' => 'Quisque imperdiet dignissim enim dictum finibus. Sed consectetutr convallis enim eget laoreet. Aenean vitae nisl mollis, porta risus vel, dapibus lectus. Etiam ac suscipit eros, eget maximus.'
                    ],
                    [
                        'faq_title' => __('FAQ title 03', 'chambeshi'),
                        'faq_content' => 'Quisque imperdiet dignissim enim dictum finibus. Sed consectetutr convallis enim eget laoreet. Aenean vitae nisl mollis, porta risus vel, dapibus lectus. Etiam ac suscipit eros, eget maximus.'
                    ],
                ],
                'title_field' => '{{{ faq_title }}}',
            ]
        );


        $this->end_controls_section();


    }

    protected function register_style_section_controls()
    {
        $this->start_controls_section(
            'section_style_item',
            [
                'label' => esc_html__('General', 'chambeshi'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_item_color',
            [
                'label' => __('Background Color', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F0F7F3',
                'selectors' => [
                    '{{WRAPPER}} .item-faq-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_gap',
            [
                'label' => __('Space Between', 'chambeshi'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-list-faq--default .item-faq:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
            'title_style',
            [
                'label' => esc_html__('Title', 'chambeshi'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'list_title_color',
            [
                'label' => __('Color', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'list_title_active_color',
            [
                'label' => __('Color Active', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-title.active h3' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'list_title_active_bg_color',
            [
                'label' => __('Background Color Active', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4F6A35',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-title.active' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'list_title_hover_color',
            [
                'label' => __('Color Hover', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-title:hover h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_title_typography',
                'label' => __('Typography', 'chambeshi'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-item-title h3 ',
            ]
        );
        $this->add_control(
            'content_style',
            [
                'label' => esc_html__('Content', 'chambeshi'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'list_content_color',
            [
                'label' => __('Color', 'chambeshi'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_content_typography',
                'label' => __('Typography', 'chambeshi'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-item-content',
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

        if (empty($settings['list'])) {
            return;
        }

        ?>
        <div class="bt-elwg-list-faq--default">
            <div class="bt-elwg-list-faq-inner">
                <?php foreach ($settings['list'] as $index => $item): ?>
                    <div class="item-faq">
                        <div class="item-faq-inner">
                            <div class="bt-item-title">
                                <?php if (!empty($item['faq_title'])): ?>
                                    <h3> <?php echo esc_html($item['faq_title']) ?> </h3>
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path
                                        d="M16 31C7.729 31 1 24.271 1 16C1 7.729 7.729 1 16 1C24.271 1 31 7.729 31 16C31 24.271 24.271 31 16 31ZM16 2C8.28 2 2 8.28 2 16C2 23.72 8.28 30 16 30C23.72 30 30 23.72 30 16C30 8.28 23.72 2 16 2Z"
                                        fill="#4F6A35" />
                                    <path
                                        d="M16 25.5C15.837 25.5 15.685 25.421 15.591 25.289L9.59104 16.789C9.48404 16.636 9.47004 16.436 9.55604 16.27C9.64204 16.104 9.81304 16 10 16H12V10.5C12 10.224 12.224 10 12.5 10C12.776 10 13 10.224 13 10.5V16.5C13 16.776 12.776 17 12.5 17H10.965L16 24.133L21.035 17H19.5C19.224 17 19 16.776 19 16.5V8.5C19 8.224 19.224 8 19.5 8C19.776 8 20 8.224 20 8.5V16H22C22.187 16 22.358 16.104 22.444 16.27C22.53 16.436 22.516 16.636 22.409 16.789L16.409 25.289C16.315 25.421 16.163 25.5 16 25.5Z"
                                        fill="#4F6A35" />
                                    <path
                                        d="M12.5 9C12.7761 9 13 8.77614 13 8.5C13 8.22386 12.7761 8 12.5 8C12.2239 8 12 8.22386 12 8.5C12 8.77614 12.2239 9 12.5 9Z"
                                        fill="#4F6A35" />
                                </svg>
                            </div>
                            <?php if (!empty($item['faq_content'])): ?>
                                <div class="bt-item-content">
                                    <?php echo esc_html($item['faq_content']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php }

    protected function content_template()
    {

    }
}
