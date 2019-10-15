<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Divine_Post_navigation2 extends Widget_Base {

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_name() {

		return 'divine-posts';
	}

	public function get_title() {
		return __( 'Divine Post Navigation 2', 'elementor-custom-widget' );
	}

	public function get_icon() {
		return 'fas fa-arrows-alt-h';
	}

	protected function _register_controls() {

		/* Link label Section */
		$this->start_controls_section(
			'btn_settings_section',
			[
				'label' => __( 'Button Settings', 'divine-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hide_label',
			[
				'label' => __( 'Hide Button', 'divine-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'divine-addons-for-elementor' ),
				'label_off' => __( 'Show', 'divine-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'prev_label',
			[
				'label' => __( 'Previous Label', 'divine-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Previous', 'divine-addons-for-elementor' ),
				'placeholder' => __( 'Type your label here', 'divine-addons-for-elementor' ),
			]
		);
		$this->add_control(
			'next_label',
			[
				'label' => __( 'Next Label', 'divine-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Next', 'divine-addons-for-elementor' ),
				'placeholder' => __( 'Type your label here', 'divine-addons-for-elementor' ),
			]
		);

		$this->end_controls_section();
		/* End of Btn Section */

		/* Info Section */
		$this->start_controls_section(
			'info_section',
			[
				'label' => esc_html__( 'Info', 'elementor-custom-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$html =
			'<div calss="info_section">
				<div style="text-align:center;">
					Coded with ❤ by <a href="https://divinesites.co.il">Divine</a>
				</div>
			</div>';
		$this->add_control(
			'info',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( $html, 'divine-addons-for-elementor' ),
			]
		);
		$this->end_controls_section();
		/* End of Info Section */

		/** STYLE TAB */
$this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title', 'divine-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'divine-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'divine-addons-for-elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'btn_style_section',
			[
				'label' => __( 'Button', 'divine-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'btn_style_tabs'
		);
		$this->start_controls_tab(
			'btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'divine-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'btn_text_color',
			[
				'label' => __( 'Label Color', 'divine-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .sale-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' => __( 'Typography', 'divine-addons-for-elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .sale-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_background',
				'label' => __( 'Background', 'divine-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sale-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'label' => __( 'Border', 'divine-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .sale-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_shadow',
				'label' => __( 'Box Shadow', 'divine-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .sale-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'divine-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'btn_text_color_hvr',
			[
				'label' => __( 'Label Color', 'divine-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .sale-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography_hvr',
				'label' => __( 'Typography', 'divine-addons-for-elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .sale-btn:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_background_hvr',
				'label' => __( 'Background', 'divine-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sale-btn:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border_hvr',
				'label' => __( 'Border', 'divine-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .sale-btn:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_shadow_hvr',
				'label' => __( 'Box Shadow', 'divine-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .sale-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'radius',
			[
				'label' => __( 'Rounding Corners', 'divine-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sale-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		/** END STYLE TAB */
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$prev_p = get_previous_post();
		$next_p = get_next_post();
		$prev_label = $settings['prev_label'];
		$next_label = $settings['next_label'];
		$prev_title = '<span class="post-navigation__prev--title">%title</span>';
		$next_title = '<span class="post-navigation__next--title">%title</span>';

		$prev_thumb = '';
		$next_thumb = '';
		echo '<div class="divine-post-navigation-wrapper">';
		if($prev_p){
			$prev_thumb = get_the_post_thumbnail($prev_p->ID,'thumbnail', array( 'class' => 'round' ));
			?>
			<div class="divine-prev-post">
				<?php previous_post_link( '%link', '<span><span class="divine-post-navigation-prev">'. $prev_label.'</span>'.$prev_title.'</span>' .$prev_thumb ); ?>
				</a>
			</div>
			<?php
		}
		if($next_p){
			$next_thumb = get_the_post_thumbnail($next_p->ID,'thumbnail', array( 'class' => 'round' ));
			?>
			<div class="divine-next-post">
				<?php next_post_link( '%link', '<span><span class="divine-post-navigation-next">'. $next_label.'</span>'.$next_title.'</span>' .$next_thumb ); ?>
				</a>
			</div>
			<?php
		}

		echo '</div>';
	}

	protected function _content_template() {

	}

	public function render_plain_content( $instance = [] ) {}

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_Divine_Post_navigation2() );
