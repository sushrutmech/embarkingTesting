<?php

/**
 * Register custom fonts.
 */
function construction_landing_page_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by PT Sans, translate this to 'off'. Do not translate into your own language.
    */
    $rubik = _x( 'on', 'Rubik: on or off', 'grand-construction' );
    $hind  = _x( 'on', 'Hind Siliguri: on or off', 'grand-construction' );
    
    $font_families = array();


    if( 'off' !== $rubik ){
        $font_families[] = 'Rubik:400,500,400italic,600,700italic,700';
    }

    if( 'off' !== $hind ){
        $font_families[] = 'Hind Siliguri:300,400,400italic,500,600,700italic,700';
    }

    $query_args = array(
        'family'  => urlencode( implode( '|', $font_families ) ),
        'display' => urlencode( 'fallback' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    
    return esc_url( $fonts_url );
}

/**
 * Site Header
 */
function construction_landing_page_site_header(){
    $phonelabel       = get_theme_mod( 'grand_construction_header_phone_label');
    $phonenumber      = get_theme_mod( 'construction_landing_page_phone' );
    $emailaddress     = get_theme_mod( 'grand_construction_header_email' );
    $ed_social        = get_theme_mod( 'grand_construction_ed_header_social_links', false );
    $site_title       = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    $header_text      = get_theme_mod( 'header_text', 1 );
    ?>
    <header id="masthead" class="site-header header-3" role="banner" itemscope itemtype="https://schema.org/WPHeader">
        <?php if( $phonenumber || $phonelabel || $emailaddress || $ed_social ){ ?>
            <div class="top-bar">
                <div class="container">
                    <div class="contact-info">     
                        <?php if ( $phonenumber || $phonelabel ) { ?>    
                            <span>
                                <svg class="fa-phone" width="20" height="20" aria-hidden="true" data-icon="phone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z"></path></svg>
                                <?php if( ! empty( $phonelabel ) ) echo esc_html( $phonelabel ); ?> <a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phonenumber ) ); ?>"><b><?php echo esc_html( $phonenumber ); ?></b></a>
                            </span>   
                        <?php } 
                        if ( $emailaddress ) { ?>       
                            <span>
                                <svg class="fa-envelope" width="20" height="20" aria-hidden="true" data-prefix="fas" data-icon="envelope" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z"></path></svg>
                                <a href="<?php echo esc_url( 'mailto:'. sanitize_email( $emailaddress ) ); ?>"><?php echo sanitize_email( $emailaddress ); ?></a>
                            </span>    
                        <?php } ?>         
                    </div>
                    <?php if( $ed_social ) do_action( 'grand_construction_social_link' ); ?>
                </div>
            </div>
        <?php } ?>
		<div class="header-t">
			<div class="container">
                <?php if( has_custom_logo() || $site_title || $site_description || $header_text ){?>
                    <div class="site-branding" itemscope itemtype="https://schema.org/Organization">				
                        <?php 
                        if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                            the_custom_logo();
                        } 
                        if( $site_title || $site_description  ){ ?>
                            <div class="text-logo">
                                <?php if ( is_front_page() ) : ?>
                                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php else : ?>
                                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                                <?php endif;
                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description" itemprop="description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                                <?php
                                endif; ?>
                            </div>
                        <?php } 
                        ?>
                    </div><!-- .site-branding -->               
                    <div class="right">
                        <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                        </nav><!-- #site-navigation -->   
                        <?php if( get_theme_mod( 'grand_construction_header_ed_search', false ) ) { ?>
                            <div class="form-holder">
                                <button type="button" class="search-btn" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal .search-field">
                                    <i class="fa fa-search"></i>
                                </button type="button">
                                <div class="head-search-form search header-searh-wrap header-search-modal cover-modal" data-modal-target-string=".header-search-modal">
                                    <?php get_search_form(); ?>
                                    <button class="btn-form-close" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal">  </button>
                                </div>
                            </div>  
                        <?php } ?>   
			        </div>
                <?php } ?>
            </div>
		</div>
	</header>    
    <?php
}

/**
 * Theme Info
 */
function construction_landing_page_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info' , array(
		'title'       => __( 'Demo and Documentation' , 'grand-construction' ),
		'priority'    => 6,
		));

	$wp_customize->add_setting('theme_info_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));
    
    $theme_info = '';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Documentation', 'grand-construction' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/grand-construction/' ) . '" target="_blank">' . __( 'here', 'grand-construction' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Demo', 'grand-construction' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/previews/?theme=grand-construction' ) . '" target="_blank">' . __( 'here', 'grand-construction' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Info', 'grand-construction' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/grand-construction/' ) . '" target="_blank">' . __( 'here', 'grand-construction' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support Ticket', 'grand-construction' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/support-ticket/' ) . '" target="_blank">' . __( 'here', 'grand-construction' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Rate this theme', 'grand-construction' ) . ': </label><a href="' . esc_url( 'https://wordpress.org/support/theme/grand-construction/reviews/' ) . '" target="_blank">' . __( 'here', 'grand-construction' ) . '</a></span><br />';

	$wp_customize->add_control( new Construction_Landing_Page_Theme_Info( $wp_customize ,'theme_info_theme',array(
		'section'     => 'theme_info',
		'description' => $theme_info
	)));
}

/**
 * Mobile Header
 */
function construction_landing_page_mobile_header(){
    $phonelabel       = get_theme_mod( 'grand_construction_header_phone_label');
    $phonenumber      = get_theme_mod( 'construction_landing_page_phone' );
    $emailaddress     = get_theme_mod( 'grand_construction_header_email' );
    $site_title       = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    $header_text      = get_theme_mod( 'header_text', 1 );
    ?>
    <div class="mobile-header">
        <div class="container">
            <?php if( has_custom_logo() || $site_title || $site_description || $header_text ){?>
                <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
                    <?php if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                        echo '<div class="custom-logo">';
                        the_custom_logo();
                        echo '</div>';
                    } 
                    if( $site_title || $site_description ) {?>
                    <div class="text-logo">
                        <?php if ( is_front_page() ) : ?>
                            <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php endif;
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description" itemprop="description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                        <?php
                        endif; ?>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <button class="menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="mobile-menu">
                <!-- This is primary-menu -->
                <nav id="mobile-navigation" class="primary-navigation">        
                    <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                    <button class="close-mobile-menu" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                    <div class="mobile-menu-title" aria-label="<?php esc_attr_e( 'Mobile', 'grand-construction' ); ?>">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'mobile-primary-menu',
                                'menu_class'     => 'nav-menu main-menu-modal',
                            ) );
                        ?>
                    </div>
                    <?php if( $phonelabel || $phonenumber ){ ?>
                        <div class="phone-holder">
                            <?php 
                                if( ! empty( $phonelabel ) ){ 
                                    echo esc_html( $phonelabel ); 
                                }if( ! empty( $phonenumber ) ){ ?>
                                    <a href="<?php echo esc_url( 'tel:'.preg_replace( '/[^\d+]/', '', $phonenumber ) ); ?>">
                                        <?php echo esc_html( $phonenumber ); ?>
                                    </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ( ! empty( $emailaddress ) ) { ?>
                        <div class="email-holder">
                            <a href="<?php echo esc_url( 'mailto:'.sanitize_email( $emailaddress ) ); ?>"><?php echo esc_html( $emailaddress ); ?></a> 
                        </div>
                    <?php } ?>
                    </div>
                </nav><!-- #mobile-site-navigation -->
            </div>
        </div>
    </div>
    <?php
}

/**
 * Footer Bottom
*/
function construction_landing_page_footer_bottom(){
	$copyright_text = get_theme_mod( 'construction_landing_page_footer_copyright_text' ); ?>

	<div class="site-info">
		<div class="container">
			<div class="copyright">
				<?php 
					if( $copyright_text ){ 
						echo wp_kses_post( $copyright_text );  
					}else{
						echo esc_html__( '&copy; Copyright ', 'grand-construction' ) . esc_html( date_i18n( __( 'Y', 'grand-construction' ) ) ); ?> 
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
					<?php } 
				?> 
			</div>
			<div class="by">
				<?php esc_html_e( 'Grand Construction | Developed By ', 'grand-construction' ); ?>
				<a href="<?php echo esc_url( 'https://rarathemes.com/' ); ?>" rel="nofollow" target="_blank">
					<?php esc_html_e( 'Rara Themes', 'grand-construction' ); ?>
				</a>                       
				<?php esc_html_e( 'Powered by ', 'grand-construction' ); ?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'grand-construction' ) ); ?>" target="_blank"><?php esc_html_e( 'WordPress', 'grand-construction' ); ?></a>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link();
				}
				?>
				</div>
		</div>
	</div>
	<?php
}