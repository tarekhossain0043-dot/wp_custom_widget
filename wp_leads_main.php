
     <?php
     /**
      * Plugin Name: My Custom Elementor Widget
      * Description: Elementor Widget।
      * Version: 1.0.0
      * Author: Tanvir Hasan
      */

     if (! defined('ABSPATH')) exit; // direct access is bad 

     function register_my_custom_widget($widgets_manager)
     {

          class My_Custom_Widget extends \Elementor\Widget_Base
          {
               public function get_name()
               {
                    return 'my_widget';
               }
               public function get_title()
               {
                    return 'home';
               }
               public function get_icon()
               {
                    return 'eicon-person';
               }
               public function get_categories()
               {
                    return ['general'];
               }

               // controls only use for custom field
               // protected function register_controls()
               // {
               //      $this->start_controls_section('section_content', ['label' => 'Content']);
               //      $this->add_control('title', [
               //           'label' => 'Title',
               //           'type' => \Elementor\Controls_Manager::TEXT,
               //           'default' => 'Hello World',
               //      ]);
               //      $this->end_controls_section();
               //      // style tab start new section
               //      $this->start_controls_section(
               //           'section_title_style',
               //           [
               //                'label' => 'Title Style',
               //                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
               //           ]
               //      );

               //      // colors controll
               //      $this->add_control(
               //           'title_color',
               //           [
               //                'label' => 'Text Color',
               //                'type' => \Elementor\Controls_Manager::COLOR,
               //                'selectors' => [
               //                     '{{WRAPPER}} .my-title' => 'color: {{VALUE}};',
               //                ],
               //           ]
               //      );

               //      // font size and family
               //      $this->add_group_control(
               //           \Elementor\Group_Control_Typography::get_type(),
               //           [
               //                'name' => 'title_typography',
               //                'selector' => '{{WRAPPER}} .my-title',
               //           ]
               //      );

               //      //control of image adding
               //      $this->add_control(
               //           'image',
               //           [
               //                'label' => 'Choose Image',
               //                'type' => \Elementor\Controls_Manager::MEDIA,
               //                'default' => [
               //                     'url' => \Elementor\Utils::get_placeholder_image_src(),
               //                ],
               //           ]
               //      );

               //      $this->end_controls_section();
               // }

               // code with full organaised
               protected function register_controls()
               {

                    // card content
                    $this->start_controls_section(
                         'section_content',
                         [
                              'label' => 'Content',
                              'tab' => \Elementor\Controls_Manager::TAB_CONTENT, // Eta default tab
                         ]
                    );

                    $this->add_control('title', [
                         'label' => 'Title',
                         'type' => \Elementor\Controls_Manager::TEXT,
                         'default' => 'Hello World',
                    ]);

                    // card image
                    $this->add_control('image', [
                         'label' => 'Choose Image',
                         'type' => \Elementor\Controls_Manager::MEDIA,
                         'default' => [
                              'url' => \Elementor\Utils::get_placeholder_image_src(),
                         ],
                    ]);

                    $this->end_controls_section(); // Content section shesh


                    // style tab adding

                    $this->start_controls_section(
                         'section_title_style',
                         [
                              'label' => 'Title Style',
                              'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                         ]
                    );

                    $this->add_control('title_color', [
                         'label' => 'Text Color',
                         'type' => \Elementor\Controls_Manager::COLOR,
                         'selectors' => [
                              '{{WRAPPER}} .my-title' => 'color: {{VALUE}};',
                         ],
                    ]);

                    $this->add_group_control(
                         \Elementor\Group_Control_Typography::get_type(),
                         [
                              'name' => 'title_typography',
                              'selector' => '{{WRAPPER}} .my-title',
                         ]
                    );

                    $this->end_controls_section();
               }

               // render use only for output
               protected function render()
               {
                    $settings = $this->get_settings_for_display();


                    $image_url = !empty($settings['image']['url']) ? $settings['image']['url'] : '';

                    // responsive cart

                    echo '<div class="card_group">';
                    echo '<div class="custom-card">';
                    if ($image_url) {
                         echo '<div class="card-image"><img src="' . esc_url($image_url) . '" alt="card image"></div>';
                    }
                    echo '<div class="card-content">';
                    echo '<h3 class="card-title">' . esc_html($settings['title']) . '</h3>';
                    echo '<p class="card-desc">It has survived not only five centuries</p>';
                    echo '<a href="#" class="card-btn">read more</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
               }
          }
     }


     add_action('elementor/widgets/register', 'register_my_custom_widget');
     function register_my_home_widget($widgets_manager)
     {
          $widgets_manager->register(new \My_Custom_Widget());
     }
     add_action('elementor/widgets/register', 'register_my_home_widget');


     function my_widget_enqueue_scripts()
     {
          wp_enqueue_style(
               'my-widget-style',
               plugins_url('assets/css/cart.css', __FILE__)
          );
          // style css file active
          wp_enqueue_style(
               'my-widget-style',
               plugins_url('assets/css/style.css', __FILE__)
          );
     }
     // $widgets_manager->register(new \My_Custom_Widget());

     add_action('wp_enqueue_scripts', 'my_widget_enqueue_scripts');
     add_action('elementor/editor/after_enqueue_styles', 'my_widget_enqueue_scripts');
     ?>