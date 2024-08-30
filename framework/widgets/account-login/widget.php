<?php

namespace ChambeshiElementorWidgets\Widgets\AccountLogin;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_AccountLogin extends Widget_Base
{

	public function get_name()
	{
		return 'bt-account-login';
	}

	public function get_title()
	{
		return __('Account Login', 'chambeshi');
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
			'section_layout',
			[
				'label'   => esc_html__('Layout', 'chambeshi'),
			]
		);

		$this->add_control(
			'acc_lg_layout_style',
			[
				'label'   => esc_html__('Layout Style', 'chambeshi'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => 'Default',
					'style-1' => 'Style 1',
				],
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__('Alignment', 'chambeshi'),
				'type'  => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'chambeshi'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'chambeshi'),
						'icon'  => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'chambeshi'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-account-login-inner ul' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'account_login_space',
			[
				'label'   => esc_html__('Space Between', 'chambeshi'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-account-login-inner ul' => 'gap: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .bt-elwg-account-login-inner ul li:before' => 'left: calc( -{{SIZE}}{{UNIT}} / 2 )',
				],
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
			'account_login_color',
			[
				'label'     => esc_html__('Color', 'chambeshi'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-account-login-inner ul li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-elwg-account-login-inner ul li span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-elwg-account-login-inner ul li:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'account_login_typography',
				'label'    => esc_html__('Typography', 'chambeshi'),
				'default'  => '',
				'selector' => '{{WRAPPER}} .bt-elwg-account-login-inner ul li a, {{WRAPPER}} .bt-elwg-account-login-inner ul li span',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>
		<div class="bt-elwg-account-login">
			<div class="bt-elwg-account-login-inner">
				<?php if (is_user_logged_in()) { ?>
					<?php $current_user = wp_get_current_user(); ?>
					<ul class="logout-menu status-login">
						<?php if ($settings['acc_lg_layout_style'] == 'default') : ?>
							<li>
								<?php if (class_exists('Woocommerce')) { ?>
									<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">
										<span><?php esc_html_e('Hi', 'chambeshi'); ?>, <?php echo esc_html($current_user->display_name) ?></span>
									</a>
								<?php } else { ?>
									<span><?php esc_html_e('Hi', 'chambeshi'); ?>, <?php echo esc_html($current_user->display_name) ?></span>
								<?php } ?>

							</li>
						<?php endif; ?>

						<li>
							<a href="<?php echo esc_url(wp_logout_url()); ?>"><?php esc_html_e('Logout', 'chambeshi'); ?></a>
						</li>
					</ul>
				<?php } else { ?>
					<ul class="login-menu">
						<li>
							<?php if (class_exists('Woocommerce')) { ?>
								<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">
									<?php esc_html_e('Login', 'chambeshi'); ?>
								</a>
							<?php } else { ?>
								<a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>">
									<?php esc_html_e('Login', 'chambeshi'); ?>
								</a>
							<?php } ?>
						</li>

						<?php if ($settings['acc_lg_layout_style'] == 'default') : ?>
							<li>
								<?php if (class_exists('Woocommerce')) { ?>
									<a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>"> <?php esc_html_e('Register', 'chambeshi'); ?> </a>
								<?php } else { ?>
									<a href="<?php echo esc_url(wp_registration_url()); ?>"> <?php esc_html_e('Register', 'chambeshi'); ?> </a>
								<?php } ?>
							</li>
						<?php endif; ?>
					</ul>
				<?php } ?>
			</div>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
