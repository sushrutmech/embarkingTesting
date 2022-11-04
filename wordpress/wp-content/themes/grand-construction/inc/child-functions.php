<?php
/**
 * Travel Agency Customizer Functions
*/
function grand_construction_customize_register( $wp_customize ){

    // Load our custom control.
    require_once get_stylesheet_directory() . '/inc/custom-controls/repeater/class-repeater-setting.php';
    require_once get_stylesheet_directory() . '/inc/custom-controls/repeater/class-control-repeater.php';

    //Modify default parent theme controls
    $wp_customize->get_control( 'construction_landing_page_phone' )->priority   =  30;

    /** Enable/Disable services Section */
    $wp_customize->add_setting(
        'grand_construction_header_ed_search',
        array(
            'default'           => false,
            'sanitize_callback' => 'construction_landing_page_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'grand_construction_header_ed_search',
        array(
            'label'    => __( 'Enable header search', 'grand-construction' ),
            'section'  => 'construction_landing_page_phone_number',
            'type'     => 'checkbox',
            'priority' => 10
        )
    );
    /** Header Phone Label */
    $wp_customize->add_setting(
        'grand_construction_header_phone_label',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'grand_construction_header_phone_label',
        array(
            'type'     => 'text',
            'section'  => 'construction_landing_page_phone_number',
            'label'    => __( 'Phone Label', 'grand-construction' ),
            'priority' => 20
            
        )
    );

    /** Header Email Address */
    $wp_customize->add_setting(
        'grand_construction_header_email',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_email',
        )
    );

    $wp_customize->add_control(
        'grand_construction_header_email',
        array(
            'type'     => 'email',
            'section'  => 'construction_landing_page_phone_number',
            'label'    => __( 'Email Address', 'grand-construction' ),
            'priority' => 40
        )
    );

    /** Enable Social Links */
    $wp_customize->add_setting(
        'grand_construction_ed_header_social_links',
        array(
            'default'           => false,
            'sanitize_callback' => 'construction_landing_page_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'grand_construction_ed_header_social_links',
        array(
            'label'       => __( 'Enable Social Links', 'grand-construction' ),
            'description' => __( 'Enable to show social links at header.', 'grand-construction' ),
            'section'     => 'construction_landing_page_phone_number',
            'type'        => 'checkbox',
            'priority' => 70
        )
    );

    /** Add social link repeater control */
    $wp_customize->add_setting( 
        new Grand_Construction_Repeater_Setting( 
            $wp_customize, 
            'grand_construction_header_social_links', 
            array(
                'default'           => array(),
                'sanitize_callback' => array( 'Grand_Construction_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );

    $wp_customize->add_control(
        new Grand_Construction_Control_Repeater(
            $wp_customize,
            'grand_construction_header_social_links',
            array(
                'section' => 'construction_landing_page_phone_number',               
                'label'   => __( 'Social Links', 'grand-construction' ),
                'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'grand-construction' ),
                        'description' => __( 'Example: fa-bell', 'grand-construction' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'grand-construction' ),
                        'description' => __( 'Example: http://facebook.com', 'grand-construction' ),
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'links', 'grand-construction' ),
                    'field' => 'link'
                ),
                'choices'   => array(
                    'limit' => 10
                ),             
                'active_callback' => 'grand_construction_customizer_active_callback',      
                'priority' => 80,           
            )
        )
    );
}
add_action( 'customize_register', 'grand_construction_customize_register', 100);

function grand_construction_header_phone_label(){
    $phone_label  = get_theme_mod( 'grand_construction_header_phone_label');

    if( ! empty( $phone_label ) ){
        return esc_html( $phone_label );
    }
    return false; 
}

/**
* Callback for Social Links
*/
function grand_construction_social_links_cb(){
    $social_icons = get_theme_mod( 'grand_construction_header_social_links', array() );

    if( $social_icons ){ 
        echo '<ul class="social-networks">';
            foreach( $social_icons as $socials ){
                if( $socials['link'] ){ ?>
                    <li>
                        <a href="<?php echo esc_url( $socials['link'] );?>" <?php if( $socials['font'] != 'skype' ) echo 'target="_blank"'; ?> title="<?php echo esc_attr( $socials['font'] ); ?>">
                            <i class="<?php echo esc_attr( $socials['font'] );?>"></i>
                        </a>
                    </li> <?php
                }
            }
        echo '</ul>';
    }
}
add_action( 'grand_construction_social_link', 'grand_construction_social_links_cb' );

/**
 * Customizer active callback function
 */
function grand_construction_customizer_active_callback( $control ){
    $ed_social_link = $control->manager->get_setting( 'grand_construction_ed_header_social_links' )->value();
    $control_id     = $control->id;
    // Phone number, Address, Email and Custom Link controls
    if ( $control_id == 'grand_construction_header_social_links' && $ed_social_link ) return true;
    return false;
}

if ( ! function_exists( 'grand_construction_get_fontawesome_ajax' ) ) :
    /**
     * Return an array of all icons.
     */
    function grand_construction_get_fontawesome_ajax() {
        // Bail if the nonce doesn't check out
        if ( ! isset( $_POST['grand_construction_customize_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['grand_construction_customize_nonce'] ), 'grand_construction_customize_nonce' ) ) {
            wp_die();
        }
    
        // Do another nonce check
        check_ajax_referer( 'grand_construction_customize_nonce', 'grand_construction_customize_nonce' );
    
        // Bail if user can't edit theme options
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_die();
        }
    
        // Get all of our fonts
        $fonts = grand_construction_get_fontawesome_list();
        
        ob_start();
        if( $fonts ){ ?>
            <ul class="font-group">
                <?php 
                    foreach( $fonts as $font ){
                        echo '<li data-font="' . esc_attr( $font ) . '"><i class="' . esc_attr( $font ) . '"></i></li>';                        
                    }
                ?>
            </ul>
            <?php
        }
        echo ob_get_clean();
    
        // Exit
        wp_die();
    }
    endif;
add_action( 'wp_ajax_grand_construction_get_fontawesome_ajax', 'grand_construction_get_fontawesome_ajax' );


function grand_construction_customize_script(){
    wp_localize_script( 'grand-construction-repeater', 'grand_construction_customize',
        array(
            'nonce' => wp_create_nonce( 'grand_construction_customize_nonce' )
        )
    );
}
add_action( 'customize_controls_enqueue_scripts', 'grand_construction_customize_script' );