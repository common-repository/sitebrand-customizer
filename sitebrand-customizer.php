<?php

/**
 * Plugin Name: SiteBrand Customizer
 * Description: Plugin that helps your wordpress installation look more like your brand,includes a Page Loader and Custom Login Page using the same settings.
 * License: GPL2
 * Version: 1.4.1
 */

function sbc_customize_register($wp_customize)
{
    // Add Section
    $wp_customize->add_section('sbc_general', array(
        'title'      => __('SiteBrand Customizer', 'sbc'),
        'priority'   => 50,
    ));

    //Loader Status
    $wp_customize->add_setting('sbc_loader_status', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'sbc_loader_status', array(
        'label'      => __('Activate Loader', 'sbc'),
        'section'    => 'sbc_general',
        'settings'   => 'sbc_loader_status',
        'type'       => 'checkbox',
    )));

    //Login Custom Status
    $wp_customize->add_setting('sbc_login_status', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'sbc_login_status', array(
        'label'      => __('Activate Login Customization', 'sbc'),
        'section'    => 'sbc_general',
        'settings'   => 'sbc_login_status',
        'type'       => 'checkbox',
    )));

    //Loader Logo
    $wp_customize->add_setting('sbc_loader_logo', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sbc_loader_logo', array(
        'label'      => __('Loader Logo', 'sbc'),
        'section'    => 'sbc_general',
        'settings'   => 'sbc_loader_logo',
    )));

    //Loader Background Color
    $wp_customize->add_setting('sbc_loader_color', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sbc_loader_color', array(
        'label'      => __('Loader Background Color', 'sbc'),
        'section'    => 'sbc_general',
        'settings'   => 'sbc_loader_color',
    )));

    //Loader Background Image
    $wp_customize->add_setting('sbc_loader_bg_image', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sbc_loader_bg_image', array(
        'label'      => __('Loader Background Image', 'sbc'),
        'section'    => 'sbc_general',
        'settings'   => 'sbc_loader_bg_image',
    )));
}
add_action('customize_register', 'sbc_customize_register');
if (get_theme_mod('sbc_loader_status')) {
    function loader_html()
    {
        ?>
<div class="sbc-loader"
    style="background-color:<?php echo get_theme_mod('sbc_loader_color'); ?>;background-image:url('<?php echo get_theme_mod('sbc_loader_bg_image'); ?>')">
    <?php if (get_theme_mod('sbc_loader_logo')) : ?>
    <img src="<?php echo get_theme_mod('sbc_loader_logo'); ?>" alt="">
    <?php endif; ?>
</div>
<?php
        }
        add_action('wp_head', 'loader_html');

        function sbc_enqueue()
        {
            wp_enqueue_style("sbc-css", plugin_dir_url(__FILE__) . "/dist/css/main.css");
            wp_enqueue_script("sbc-js", plugin_dir_url(__FILE__) . "/dist/js/loader.js");
        }
        add_action('wp_enqueue_scripts', 'sbc_enqueue');
    }
    if (get_theme_mod('sbc_login_status')) {
        function sbc_login_logo()
        { ?>
<style type="text/css">
body.login {
    background-color: <?php echo get_theme_mod('sbc_loader_color');
    ?>;
    <?php if (get_theme_mod('sbc_loader_bg_image')): ?>background-image: <?php echo get_theme_mod('sbc_loader_bg_image');
    ?><?php endif;
    ?>
}

#login h1 a,
.login h1 a {
    background-image: url(<?php echo get_theme_mod('sbc_loader_logo');
    ?>);
    height: 120px;
    width: initial;
    max-width: 100%;
    background-size: contain;
    background-repeat: no-repeat;
    padding-bottom: 30px;
}
</style>
<?php }
    add_action('login_enqueue_scripts', 'sbc_login_logo');
}