<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Divine_Iframe_Grid extends Widget_Base {

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_name() {

		return 'divine-iframe-grid-widget';
	}

	public function get_title() {
		return __( 'Divine Iframe Grid', 'elementor-custom-widget' );
	}

	public function get_icon() {
		return 'fa fa-th';
	}

	protected function _register_controls() {

		/* List Section */
		$this->start_controls_section(
			'list_section',
			[
				'label' => esc_html__( 'List', 'elementor-custom-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_demo_link',
			[
				'label' => __( 'Demo Page Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'list_sale_link',
			[
				'label' => __( 'Sale Page Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'list_img',
			[
				'label' => __( 'Thumbnail', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],

			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Iframes List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'plugin-domain' ),
					],
					[
						'list_title' => __( 'Title #2', 'plugin-domain' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);
		$this->end_controls_section();
		/* End of List Section */

		/* Layout Section */
		$this->start_controls_section(
			'grid_layout_section',
			[
				'label' => __( 'Grid', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_responsive_control(
			'num_of_columns',
			[
				'label' => __( 'Number of Columns', 'divine-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 8,
				'step' => 1,
				'desktop_default' => 4,
				'mobile_default' => 1,
				'selectors' => [
					'{{WRAPPER}} .divine-iframes-grid.list-grid-wrapper' => 'grid-template-columns: repeat({{VALUE}},1fr);display: grid;grid-column-gap: 50px;grid-row-gap: 50px;',
				],
			]
		);
		$this->add_responsive_control(
			'columns_gap',
			[
				'label' => __( 'Columns Gap', 'divine-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .divine-iframes-grid.list-grid-wrapper' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'rows_gap',
			[
				'label' => __( 'Rows Gap', 'divine-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .divine-iframes-grid.list-grid-wrapper' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		/* End of Grid Layout Section */

		/* btn_title_layout_section Section */
		$this->start_controls_section(
			'btn_title_layout_section',
			[
				'label' => __( 'Button and Title', 'divine-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'btn_title_separated_rows',
			[
				'label' => __( 'Separate Rows for Title and Button', 'divine-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'divine-addons-for-elementor' ),
				'label_off' => __( 'No', 'divine-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
		/* End of btn_txt_layout_section Section */

		/* Btn Section */
		$this->start_controls_section(
			'btn_settings_section',
			[
				'label' => __( 'Button Settings', 'divine-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hide_btn',
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
			'btn_label',
			[
				'label' => __( 'Button label', 'divine-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Buy Now', 'divine-addons-for-elementor' ),
				'placeholder' => __( 'Type your label here', 'divine-addons-for-elementor' ),
			]
		);

		$this->end_controls_section();
		/* End of Btn Section */

		/* Thumbnail Section */
		$this->start_controls_section(
			'img_size_section',
			[
				'label' => esc_html__( 'Thumbnail Settings', 'elementor-custom-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $this->add_control(
			'img_dimension',
			[
				'label' => __( 'Image Dimension', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width' => '300',
					'height' => '300',
				],
			]
		);

		$this->add_control(
			'img_size_rule',
			[
				'label' => __( 'Choose Image Size Rule', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'custome_size' => [
						'title' => __( 'Use Custome Size', 'plugin-domain' ),
						'icon' => 'fa fa-chevron-up',
					],
					'predefined_size' => [
						'title' => __( 'Use Predefined Size', 'plugin-domain' ),
						'icon' => 'fa fa-chevron-down',
					],
				],
				'default' => 'predefined_size',
				'toggle' => true,
			]
		);

		$img_size = '<div style="direction:ltr;color: #3e3e3e;text-align:left">Avaliable sizes:<br />'.implode('<br />',get_intermediate_image_sizes()).'</div>';
		$this->add_control(
			'img_size',
			[
				'label' => __( 'Image Size', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => $img_size,
				'default' => 'large',
			]
		);
		$this->end_controls_section();
		/* End of thumbnail Section */

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
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['list'] ) {
			echo '<div class="divine-iframes-grid list-grid-wrapper">';
			foreach (  $settings['list'] as $item ) {
				$target = $item['list_sale_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['list_sale_link']['nofollow'] ? ' rel="nofollow"' : '';
				$demo_href = '';
				$sale_href = '';
				$demo_link = $item['list_demo_link']['url'];
				$sale_link = $item['list_sale_link']['url'];
				if($sale_link){
					$sale_href = 'href="'.$sale_link.'"';
				}
				if($demo_link){
					$demo_href = 'href="'.$demo_link.'"';
				}

				if($settings['img_size_rule'] == "predefined_size"){
					$thumbnail_size = $settings['img_size'];
				}else{
					$thumbnail_size = Array ($settings['img_dimension']['width'], $settings['img_dimension']['height'] );
				}
        $thumbnail_img = wp_get_attachment_image( $item['list_img']['id'], $thumbnail_size );
				$btn_txt_layout_class = '';
				$btn = '';
				if('yes' == $settings['btn_title_separated_rows']){
					$btn_txt_layout_class = 'title-btn-layout-br';
				}
				$btn_label = $settings['btn_label'];
				if('yes' != $settings['hide_btn']){
					$btn = '<button class="sale-btn">'.$btn_label.'</button>';
				}
				echo '<div class="list-item-wrapper">';
					echo '<div class="img-wrapper">
									<a class="lightbox" data-type="iframe" '.$demo_href.'><span class="demoBtn">תצוגה מקדימה</span>'.$thumbnail_img.'</a>
								</div>';
					echo '<div class="list-item-title '.$btn_txt_layout_class.' ifram-list-item-' . $item['_id'] . '">
									<a '. $sale_href . ' ' . $target . $nofollow . '><h3 class="title">' . $item['list_title'] . '</h3>'.$btn.'</a>
								</div>';
				echo '</div>';
			}
			echo '</div>';
		}
	}

	protected function _content_template() {

	}

	public function render_plain_content( $instance = [] ) {}

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_Divine_Iframe_Grid() );
