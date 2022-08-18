<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://devs.redux.io/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = 'dhepa';  // YOU MUST CHANGE THIS.  DO NOT USE 'redux_demo' IN YOUR PROJECT!!!

// Uncomment to disable demo mode.
/* Redux::disable_demo(); */  // phpcs:ignore Squiz.PHP.CommentedOutCode

$dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

/*
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 */

// Background Patterns Reader.
$sample_patterns_path = Redux_Core::$dir . '../sample/patterns/';
$sample_patterns_url  = Redux_Core::$url . '../sample/patterns/';
$sample_patterns      = array();

if ( is_dir( $sample_patterns_path ) ) {
	$sample_patterns_dir = opendir( $sample_patterns_path );

	if ( $sample_patterns_dir ) {

		// phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition
		while ( false !== ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) ) {
			if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
				$name              = explode( '.', $sample_patterns_file );
				$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
				$sample_patterns[] = array(
					'alt' => $name,
					'img' => $sample_patterns_url . $sample_patterns_file,
				);
			}
		}
	}
}

// Used to except HTML tags in description arguments where esc_html would remove.
$kses_exceptions = array(
	'a'      => array(
		'href' => array(),
	),
	'strong' => array(),
	'br'     => array(),
	'code'   => array(),
);

/*
 * ---> BEGIN ARGUMENTS
 */

/**
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://devs.redux.io/core/arguments/
 */
$theme = wp_get_theme(); // For use with some settings. Not necessary.

// TYPICAL -> Change these values as you need/desire.
$args = array(
	// This is where your data is stored in the database and also becomes your global variable name.
	'opt_name'                  => $opt_name,

	// Name that appears at the top of your panel.
	'display_name'              => $theme->get( 'Name' ),

	// Version that appears at the top of your panel.
	'display_version'           => $theme->get( 'Version' ),

	// Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
	'menu_type'                 => 'menu',

	// Show the sections below the admin menu item or not.
	'allow_sub_menu'            => true,

	// The text to appear in the admin menu.
	'menu_title'                => esc_html__( 'Dhepa Theme Options', 'dhepa-functions' ),

	// The text to appear on the page title.
	'page_title'                => esc_html__( 'Dhepa Theme Options', 'dhepa-functions' ),

	// Disable to create your own Google fonts loader.
	'disable_google_fonts_link' => false,

	// Show the panel pages on the admin bar.
	'admin_bar'                 => true,

	// Icon for the admin bar menu.
	'admin_bar_icon'            => 'dashicons-portfolio',

	// Priority for the admin bar menu.
	'admin_bar_priority'        => 50,

	// Sets a different name for your global variable other than the opt_name.
	'global_variable'           => $opt_name,

	// Show the time the page took to load, etc. (forced on while on localhost or when WP_DEBUG is enabled).
	'dev_mode'                  => false,

	// Enable basic customizer support.
	'customizer'                => false,

	// Allow the panel to open expanded.
	'open_expanded'             => false,

	// Disable the save warning when a user changes a field.
	'disable_save_warn'         => false,

	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_priority'             => 90,

	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
	'page_parent'               => 'themes.php',

	// Permissions needed to access the options panel.
	'page_permissions'          => 'manage_options',

	// Specify a custom URL to an icon.
	'menu_icon'                 => '',

	// Force your panel to always open to a specific tab (by id).
	'last_tab'                  => '',

	// Icon displayed in the admin panel next to your menu_title.
	'page_icon'                 => 'icon-themes',

	// Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
	'page_slug'                 => $opt_name,

	// On load save the defaults to DB before user clicks save.
	'save_defaults'             => true,

	// Display the default value next to each field when not set to the default value.
	'default_show'              => false,

	// What to print by the field's title if the value shown is default.
	'default_mark'              => '*',

	// Shows the Import/Export panel when not used as a field.
	'show_import_export'        => true,

	// The time transients will expire when the 'database' arg is set.
	'transient_time'            => 60 * MINUTE_IN_SECONDS,

	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
	'output'                    => true,

	// Allows dynamic CSS to be generated for customizer and google fonts,
	// but stops the dynamic CSS from going to the page head.
	'output_tag'                => true,

	// Disable the footer credit of Redux. Please leave if you can help it.
	'footer_credit'             => '',

	// If you prefer not to use the CDN for ACE Editor.
	// You may download the Redux Vendor Support plugin to run locally or embed it in your code.
	'use_cdn'                   => true,

	// Set the theme of the option panel.  Use 'wp' to use a more modern style, default is classic.
	'admin_theme'               => 'wp',

	// Enable or disable flyout menus when hovering over a menu with submenus.
	'flyout_submenus'           => true,

	// Mode to display fonts (auto|block|swap|fallback|optional)
	// See: https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display.
	'font_display'              => 'swap',

	// HINTS.
	'hints'                     => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	),

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'database'                  => '',
	'network_admin'             => true,
	'search'                    => true,
);


// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
// PLEASE CHANGE THEME BEFORE RELEASING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['admin_bar_links'][] = array(
	'id'    => 'redux-docs',
	'href'  => '//devs.redux.io/',
	'title' => __( 'Documentation', 'dhepa-functions' ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'redux-support',
	'href'  => '//github.com/ReduxFramework/redux-framework/issues',
	'title' => __( 'Support', 'dhepa-functions' ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'redux-extensions',
	'href'  => 'redux.io/extensions',
	'title' => __( 'Extensions', 'dhepa-functions' ),
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
// PLEASE CHANGE THEME BEFORE RELEASING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['share_icons'][] = array(
    'url'   => 'https://github.com/shakilopu',
    'title' => 'Visit us on GitHub',
    'icon'  => 'el el-github'
);
$args['share_icons'][] = array(
    'url'   => 'https://www.facebook.com/DhepaCodingStudio',
    'title' => 'Like us on Facebook',
    'icon'  => 'el el-facebook'
);
$args['share_icons'][] = array(
    'url'   => 'http://twitter.com/dhepa',
    'title' => 'Follow us on Twitter',
    'icon'  => 'el el-twitter'
);
$args['share_icons'][] = array(
    'url'   => 'http://www.linkedin.com/company/dhepa',
    'title' => 'Find us on LinkedIn',
    'icon'  => 'el el-linkedin'
);

// Panel Intro text -> before the form
if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace('-', '_', $args['opt_name']);
    }
    $args['intro_text'] = sprintf(__('<p>Hello! Welcome to Dhepa Newspaper Theme.</p>', 'dhepa-functions'), $v);
} else {
    $args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'dhepa-functions');
}

// Add content after the form.
$args['footer_text'] = __('<p>Thank you for choosing us</p>', 'dhepa-functions');
Redux::set_args( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */
$help_tabs = array(
	array(
		'id'      => 'redux-help-tab-1',
		'title'   => esc_html__( 'Theme Information 1', 'dhepa-functions' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'dhepa-functions' ) . '</p>',
	),
	array(
		'id'      => 'redux-help-tab-2',
		'title'   => esc_html__( 'Theme Information 2', 'dhepa-functions' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'dhepa-functions' ) . '</p>',
	),
);
Redux::set_help_tab( $opt_name, $help_tabs );

// Set the help sidebar.
$content = '<p>' . esc_html__( 'This is the sidebar content, HTML is allowed.', 'dhepa-functions' ) . '</p>';

Redux::set_help_sidebar( $opt_name, $content );

/*
 * <--- END HELP TABS
 */

/*
 * ---> START SECTIONS
 */

// -> START Basic Fields

// require_once Redux_Core::$dir . '../sample/sections/basic-fields/checkbox.php';
// require_once Redux_Core::$dir . '../sample/sections/basic-fields/radio.php';
// require_once Redux_Core::$dir . '../sample/sections/basic-fields/sortable.php';
// require_once Redux_Core::$dir . '../sample/sections/basic-fields/text.php';
// require_once Redux_Core::$dir . '../sample/sections/basic-fields/multi-text.php';
// require_once Redux_Core::$dir . '../sample/sections/basic-fields/password.php';
// require_once Redux_Core::$dir . '../sample/sections/basic-fields/textarea.php';

// -> START Basic Fields
Redux::setSection($opt_name, array(
    'title'            => __('Theme Validation', 'dhepa-functions'),
    'id'               => 'theme-code',
    'desc'             => __('', 'dhepa-functions'),
    'customizer_width' => '400px',
    'icon'             => 'el el-edit',
    'fields'     => array(
        // Archive page top
        array(
            'id'       => 'purchase-code',
            'type'     => 'password',
            'title'    => __('Purchase Code', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
        array(
            'id'       => 'bkash-code',
            'type'     => 'text',
            'title'    => __('Bkash Transaction Number', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'            => __('General Settings', 'dhepa-functions'),
    'id'               => 'general-settings',
    'desc'             => __('', 'dhepa-functions'),
    'customizer_width' => '400px',
    'icon'             => 'el el-cogs'
));

Redux::setSection($opt_name, array(
    'title'      => __('Header Settings', 'dhepa-functions'),
    'id'         => 'header-settings',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-caret-up',
    'fields'     => array(
        array(
            'id'       => 'header-logo-image',
            'type'     => 'media',
            'title'    => __('Header Image Logo', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/logo.png'
                        ),
        ),
        array(
            'id'       => 'header-logo-text',
            'type'     => 'text',
            'title'    => __('Header Text Logo', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'dhepa-functions',
        ),
		array(
            'id'       => 'header-mobile-logo-image',
            'type'     => 'media',
            'title'    => __('Header Image Logo (Mobile)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/logo.png'
                        ),
        ),
        array(
            'id'       => 'header-mobile-logo-text',
            'type'     => 'text',
            'title'    => __('Header Text Logo (Mobile)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'dhepa-functions',
        ),
		array(
            'id'       => 'favicon-image',
            'type'     => 'media',
            'title'    => __('Favicon (deprecated)', 'dhepa-functions'),
            'subtitle' => __('You need to upload favicon image using WordPress core option in Appearance -> Customize -> Site identity -> Site icon.', 'dhepa-functions'),
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Social Links', 'dhepa-functions'),
    'id'         => 'social-links',
    'desc'       => __('', 'dhepa-functions'),
    'icon'      => 'el el-braille',
    'subsection' => true,
    'fields'     => array(

        array(
            'id'       => 'social-facebook',
            'type'     => 'text',
            'title'    => __('Facebook Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://www.facebook.com/DhepaCodingStudio',
        ),
        array(
            'id'       => 'social-twitter',
            'type'     => 'text',
            'title'    => __('Twitter Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'shakilopu',
        ),
        array(
            'id'       => 'social-youtube',
            'type'     => 'text',
            'title'    => __('Youtube Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://www.youtube.com/',
        ),
        array(
            'id'       => 'social-instagram',
            'type'     => 'text',
            'title'    => __('Instagram Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://www.instagram.com/',
        ),
        array(
            'id'       => 'social-linkedin',
            'type'     => 'text',
            'title'    => __('Linkedin Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://www.linkedin.com/',
        ),
        array(
            'id'       => 'social-pinterest',
            'type'     => 'text',
            'title'    => __('Pinterest Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://www.pinterest.com/',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Prayer Time Settings', 'dhepa-functions'),
    'id'         => 'prayer-time',
    'desc'       => __('', 'dhepa-functions'),
    'icon'      => 'el el-time-alt',
    'subsection' => true,
    'fields'     => array(

        array(
            'id'       => 'fazr',
            'type'     => 'text',
            'title'    => __('ফজর', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '৫:০৫',
        ),
        array(
            'id'       => 'dohar',
            'type'     => 'text',
            'title'    => __('জোহর', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '১১:৪৬',
        ),
        array(
            'id'       => 'asar',
            'type'     => 'text',
            'title'    => __('আসর', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '৪:০৮',
        ),
        array(
            'id'       => 'magrib',
            'type'     => 'text',
            'title'    => __('মাগরিব', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '৫:১১',
        ),
        array(
            'id'       => 'esha',
            'type'     => 'text',
            'title'    => __('ইশা', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '৬:২৬',
        ),
        array(
            'id'       => 'sunrise',
            'type'     => 'text',
            'title'    => __('সূর্যাস্ত', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '৫:১১',
        ),
        array(
            'id'       => 'sunset',
            'type'     => 'text',
            'title'    => __('সূর্যোদয়', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => ' ৬:২১',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Footer Settings', 'dhepa-functions'),
    'id'         => 'footer-settings',
    'desc'       => __('', 'dhepa-functions'),
    'icon'      => 'el el-caret-down',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'footer-logo-image',
            'type'     => 'media',
            'title'    => __('Footer Image Logo', 'dhepa-functions'),
            'subtitle' => __('Image Size Should not more than 350x100 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/dark-logo.png'
                        ),
        ),
        array(
            'id'       => 'footer-logo-text',
            'type'     => 'text',
            'title'    => __('Footer Text Logo', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'dhepa-functions',
        ),
        array(
            'id'       => 'android-app',
            'type'     => 'text',
            'title'    => __('Android App Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'validate' => 'url',
        ),
        array(
            'id'       => 'ios-app',
            'type'     => 'text',
            'title'    => __('IOS App Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'validate' => 'url',

        ),
        array(
            'id'       => 'footer-long-text',
            'type'     => 'textarea',
            'title'    => __('Footer Text ', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'প্রকাশক কর্তৃক ক-২৪৪ প্রগতি সরণি, কুড়িল (বিশ্বরোড), বারিধারা, ঢাকা-১২২৯ থেকে প্রকাশিত এবং যমুনা প্রিন্টিং এন্ড পাবলিশিং লিঃ থেকে মুদ্রিত। পিএবিএক্স : ৯৮২৪০৫৪-৬১, রিপোর্টিং : ৯৮২৩০৭৩, বিজ্ঞাপন : ৯৮২৪০৬২, ফ্যাক্স : ৯৮২৪০৬৩, সার্কুলেশন : ৯৮২৪০৭২। ফ্যাক্স : ৯৮২৪০৬৬',

        ),
        array(
            'id'       => 'editor-name',
            'type'     => 'text',
            'title'    => __('Editor Name', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'বিপ্লব মেহেদী',
        ),
        array(
            'id'       => 'publisher-name',
            'type'     => 'text',
            'title'    => __('Publisher Name', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'অপু চৌধুরী',
        ),
        array(
            'id'       => 'copyright-text',
            'type'     => 'text',
            'title'    => __('Copyright Text', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'কপিরাইট। ধিপা কর্তৃক সর্বসত্ব সংরক্ষিত ',
        ),
        array(
            'id'       => 'company-address',
            'type'     => 'text',
            'title'    => __('Company Address', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'ঢাকা, বাংলাদেশ',
        ),
        array(
            'id'       => 'alert-text',
            'type'     => 'text',
            'title'    => __('Footer alert text', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'এই ওয়েবসাইটের কোনো লেখা, ছবি, অডিও, ভিডিও অনুমতি ছাড়া ব্যবহার বেআইনি।',
        ),

        array(
            'id'       => 'email-address',
            'type'     => 'text',
            'title'    => __('Company Email', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'bd@dhepa.com',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('SEO Settings', 'dhepa-functions'),
    'id'         => 'seo-settings',
    'desc'       => __('', 'dhepa-functions'),
    'icon'      => 'el el-search',
    'subsection' => true,
    'fields'     => array(


        array(
            'id'       => 'meta-description',
            'type'     => 'textarea',
            'title'    => __('Meta Description ', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default' =>'Dhepa Newspaper is your news, entertainment, music fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry. Fashion fades, only style remains the same. Fashion never stops. There are always projects, opportunities. Clothes mean nothing until someone lives in them.',

        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Single Page Settings', 'dhepa-functions'),
    'id'         => 'singlepage-settings',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-blind',
    'fields'     => array(
		array(
            'id'       => 'enable-bottom-share-btn',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide Social Share Button From Bottom of Article', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',

            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'after-post-text',
            'type'     => 'textarea',
            'title'    => __('After post Special text', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'We use all content from others website just for demo purpose. We suggest to remove all content after building your demo website. And Dont copy our content without our permission.'
        ),
		array(
            'id'       => 'enable-comments',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide Comment', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',

            ),
            'default'  => '2'
        ),
        
        array(
            'id'       => 'youtube-channel-id',
            'type'     => 'text',
            'title'    => __('Youtube Channel ID', 'dhepa-functions'),
            'subtitle' => __('https://www.youtube.com/channel/<strong style="color:red">UC2QhpOqQBJ0RM-NVI7QWjxw</strong>', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
			'default'  => 'UC2QhpOqQBJ0RM-NVI7QWjxw',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Facebook Like Box Settings', 'dhepa-functions'),
    'id'         => 'fb-like-box-settings',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-facebook',
    'fields'     => array(

        array(
            'id'       => 'facebook-page-id',
            'type'     => 'text',
            'title'    => __('Facebook Page ID', 'dhepa-functions'),
            'subtitle' => __('http://facebook.com/<strong style="color:red">DhepaCodingStudio</strong>', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
			'default'  => 'sarabanglain',
        ),
		array(
            'id'       => 'facebook-App-id',
            'type'     => 'text',
            'title'    => __('Facebook App ID', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
			'default'  => '990820421296464',
        ),

    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Post Settings', 'dhepa-functions'),
    'id'         => 'post-settings',
    'desc'       => __('', 'dhepa-functions'),
    'icon'      => 'el el-book',
    'subsection' => true,
    'fields'     => array(

        array(
            'id'       => 'default-post-image',
            'type'     => 'media',
            'title'    => __('Pre Load Post Image', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/dhepa-default.jpg'
                        ),
        ),
        array(
            'id'       => 'defaults-post-image',
            'type'     => 'media',
            'title'    => __('Default Post Image', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/dhepa-no-image.jpg'
                        ),
        ),
        array(
            'id'       => 'post-meta-enable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide Post Meta', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),

    )
));
Redux::setSection($opt_name, array(
    'title'      => __('News Ticker Settings', 'dhepa-functions'),
    'id'         => 'news-tricker-settings',
    'desc'       => __('', 'dhepa-functions'),
    'icon'      => 'el el-book',
    'subsection' => true,
    'fields'     => array(
		array(
            'id'       => 'tricker-enable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide News Ticker', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
		array(
                'id'       => 'select-categories-for-tricker',
                'type'     => 'select',
                'data'     => 'categories',
                'multi'    => true,
                'title'    => __( 'Select Categories For News Ticker', 'dhepa-functions' ),
                'subtitle' => __( '', 'dhepa-functions' ),
                'desc'     => __( '', 'dhepa-functions' ),
                'default'  => ['40', '39','25']
            ),
		
		 array(
				'id'       => 'ticker-bg',
				'type'     => 'background',
				'title'    => __('News Ticker Background', 'dhepa-functions'),
				'subtitle' => __('Please Set News Ticker Background Color', 'dhepa-functions'),
// 				'output' => array('.container.ticker-area, .tricker, .tricker-head span, span.ticker-num, ul.video_category_list li a'),
 				'output' =>array('.scroll-news'),
				'background-image'=> false,
				'background-attachment'=> false,
				'background-repeat'=> false,
				'background-size'=> false,
				'background-position'=> false,
				'default'  => array(
                    'background-color'       => '#fbd0d0',
 
                ),
			),
		 array(
				'id'       => 'ticker-heading-bg',
				'type'     => 'background',
				'title'    => __('News Ticker Heading Background', 'dhepa-functions'),
				'subtitle' => __('Please Set News Ticker Background Color', 'dhepa-functions'),
// 				'output' => array('.container.ticker-area, .tricker, .tricker-head span, span.ticker-num, ul.video_category_list li a'),
 				'output' =>array('.scroll-news::before'),
				'background-image'=> false,
				'background-attachment'=> false,
				'background-repeat'=> false,
				'background-size'=> false,
				'background-position'=> false,
				'default'  => array(
                    'background-color'       => '#fbd0d0',
                 ),
			),
		array(
                'id'       => 'ticker-head-font',
                'type'     => 'typography',
                'title'    => __( 'Ticker Heading Font Style', 'dhepa-functions' ),
                'subtitle' => __( 'Specify the News Ticker font properties.', 'dhepa-functions' ),
                'google'   => true,
                'output' => array('.scroll-news::before'),
                'default'  => array(
                    'color'       => '#000',
                    'font-size'   => '20px',
                    'font-family' => 'SolaimanLipi',
                    'font-weight' => '500',
					'line-height' => '27px',
					'google'      => true,
                ),
            ),
		array(
                'id'       => 'ticker-news-font',
                'type'     => 'typography',
                'title'    => __( 'Ticker News Font Style', 'dhepa-functions' ),
                'subtitle' => __( 'Specify the News Ticker font properties.', 'dhepa-functions' ),
                'google'   => true,
                'output' => array('.scroll-news ul li a'),
                'default'  => array(
                    'color'       => '#000',
                    'font-size'   => '20px',
                    'font-family' => 'SolaimanLipi',
                    'font-weight' => 'Normal',
					'line-height' => '18px',
					'google'      => true,
                ),
            ),

    )
));
Redux::setSection($opt_name, array(
    'title'            => __('Home Page Settings', 'dhepa-functions'),
    'id'               => 'homepage',
    'desc'             => __('These are really basic fields!', 'dhepa-functions'),
    'customizer_width' => '400px',
    'icon'             => 'el el-home'
));

Redux::setSection($opt_name, array(
    'title'      => __('First Section', 'dhepa-functions'),
    'id'         => 'first-section',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-th-list',
    'fields'     => array(
        array(
            'id'       => 'first-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',

            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'lead-news-section',
            'type'     => 'select',
            'data'     => 'categories',
			'multi'    => true,
            'title'    => __('Lead News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('This section created for showing lead news but you can change it from here', 'dhepa-functions'),
            'default'  => ['3','29','25']
        ),
        
    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Second Section', 'dhepa-functions'),
    'id'         => 'second-section',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-th-list',
    'fields'     => array(
        array(
            'id'       => 'second-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',

            ),
            'default'  => '1'
        ),

        array(
            'id'       => 'second-section-left-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('First Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '3'
        ),
        array(
            'id'       => 'second-section-right-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Second Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '30'
        ),
        
    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Third Section', 'dhepa-functions'),
    'id'         => 'third-section',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-th-list',
    'fields'     => array(
        array(
            'id'       => 'third-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'third-section-left-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('First Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '40'
        ),
        array(
            'id'       => 'third-section-right-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Second Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '33'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Forth Section', 'dhepa-functions'),
    'id'         => 'forth-section',
    'desc'       => __(''),
    'icon'      => 'el el-th-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'forth-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'forth-section-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('News From', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '25'
        ),
    )
));


Redux::setSection($opt_name, array(
    'title'      => __('Fifth Section', 'dhepa-functions'),
    'id'         => 'fifth-section',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-th-list',
    'fields'     => array(
        array(
            'id'       => 'fifth-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'fifth-section-left-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('First Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '13'
        ),
        array(
            'id'       => 'fifth-section-right-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Second Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '29'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Sixth Section', 'dhepa-functions'),
    'id'         => 'sixth-section',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-th-list',
    'fields'     => array(
        array(
            'id'       => 'sixth-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'sixth-section-left-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('First Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '28'
        ),
        array(
            'id'       => 'sixth-section-right-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Second Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '24'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Seventh Section', 'dhepa-functions'),
    'id'         => 'seventh-section',
    'desc'       => __(''),
    'icon'      => 'el el-th-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'seventh-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'seventh-section-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('News From', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '26'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Eighth Section', 'dhepa-functions'),
    'id'         => 'eighth-section',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-th-list',
    'fields'     => array(
        array(
            'id'       => 'eighth-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'eighth-section-left-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('First Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '41'
        ),
        array(
            'id'       => 'eighth-section-right-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Second Block News Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '14'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Ninth Section', 'dhepa-functions'),
    'id'         => 'ninth-section',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-th-list',
    'fields'     => array(
        array(
            'id'       => 'ninth-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '.', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),

        array(
            'id'       => 'ninth-section-first-block-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('First Block News From', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post ', 'dhepa-functions'),
            'default'  => '20',
        ),

        array(
            'id'       => 'ninth-section-second-block-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Second Block News From', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post ', 'dhepa-functions'),
            'default'  => '17',
        ),

        array(
            'id'       => 'ninth-section-third-block-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Third Block News From', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post ', 'dhepa-functions'),
            'default'  => '16',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Tenth Section', 'dhepa-functions'),
    'id'         => 'tenth-section',
    'desc'       => __(''),
    'icon'      => 'el el-th-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tenth-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'tenth-section-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('News From', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '12'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Eleventh Section', 'dhepa-functions'),
    'id'         => 'eleventh-section',
    'desc'       => __(''),
    'icon'      => 'el el-th-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'eleventh-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'eleventh-section-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('News From', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '22'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Twelfth Section', 'dhepa-functions'),
    'id'         => 'twelfth-section',
    'desc'       => __(''),
    'icon'      => 'el el-th-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'twelfth-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'twelfth-section-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('News From', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post from', 'dhepa-functions'),
            'default'  => '18'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Thirteen Section', 'dhepa-functions'),
    'id'         => 'thirteen-section',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      => 'el el-photo',
    'fields'     => array(
        array(
            'id'       => 'thirteen-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '.', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),

        array(
            'id'       => 'thirteen-section-news',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Photo Gallery Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post', 'dhepa-functions'),
            'default'  => '6',
        ),
        array(
            'id'       => 'thirteen-section-video',
            'type'     => 'select',
            'data'     => 'categories', 'args'      => array('taxonomy' => 'video_cat'),
            'title'    => __('Video Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('Select category to show post', 'dhepa-functions'),
            'default'  => '2',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Map News Section', 'dhepa-functions'),
    'id'         => 'map-section',
    'desc'       => __(''),
    'icon'      => 'el el-th-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'map-section-enable-disable',
            'type'     => 'button_set',
            'title'    => __( 'Show/Hide This Section', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Show',
                '2' => 'Hide',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'map-section-map-title',
            'type'     => 'text',
            'title'    => __('Map News Title', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'সারাবাংলা',
        ),
        array(
            'id'       => 'rangpur-url',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Rangpur Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '32'

        ),

        array(
            'id'       => 'rajshahi-url',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Rajshahi Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '37'

        ),

        array(
            'id'       => 'mymensingh-url',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Mymensingh Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '31'

        ),

        array(
            'id'       => 'sylhet-url',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Sylhet Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '34'

        ),

        array(
            'id'       => 'dhaka-url',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Dhaka Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '39'

        ),

        array(
            'id'       => 'khulna-url',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Khulna Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '36'

        ),

        array(
            'id'       => 'barishal-url',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Barishal Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '35'

        ),

        array(
            'id'       => 'chittagong-url',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __('Chittagong Category', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => '38'

        ),
    )
));
Redux::setSection($opt_name, array(
    'title'            => __('Contact Page Settings', 'dhepa-functions'),
    'id'               => 'contactpage-settings',
    'desc'             => __('', 'dhepa-functions'),
    'customizer_width' => '400px',
    'icon'             => 'el el-address-book',
    'fields'     => array(
		array(
			'id'        => 'contact-form-title',
			'type'      => 'text',
			'title'     => __('Contact Form Headline', 'dhepa-functions'),
			'default' => 'আমাদের সাথে যোগাযোগ ',
		),
		array(
			'id'        => 'wca-contact-form',
			'type'      => 'select',
			'data'      => 'posts',
			'args'      => array( 'post_type' => 'wpcf7_contact_form', ),
			'title'     => __('Select Contact Form', 'dhepa-functions'),
			'default' => '6',
		),
		array(
			'id'        => 'contact-form-g-map',
			'type'      => 'textarea',
			'title'     => __('Add Google Map Embed Code', 'dhepa-functions'),
			'default' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14013.403591211865!2d77.25717977562388!3d28.58924821757713!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce30c0e0e30c7%3A0x265ca54f44005f1e!2sSarai%20Kale%20Khan%2C%20New%20Delhi%2C%20Delhi%2C%20India!5e0!3m2!1sen!2sbd!4v1627987380314!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
		),
    )
));



Redux::setSection($opt_name, array(
    'title'            => __('Ads Settings', 'dhepa-functions'),
    'id'               => 'ads-settings',
    'desc'             => __('These are really basic fields!', 'dhepa-functions'),
    'customizer_width' => '400px',
    'icon'             => 'el el-adjust'
));

Redux::setSection($opt_name, array(
    'title'      => __('Header Top Ads', 'dhepa-functions'),
    'id'         => 'header-ads',
    'desc'       => __('You can choose only one type of ads from here. Image ads Or Google Ads','dhepa-functions'),
    'subsection' => true,
    'icon'             => 'el el-hand-up',
    'fields'     => array(
        array(
            'id'       => 'enable-header-top-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Header Top Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'header-top-ads',
            'type'     => 'media',
            'title'    => __('Image Ads', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728*90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'header-top-ads-url',
            'type'     => 'text',
            'title'    => __('Ads Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'header-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Google Ads', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),

    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page First Section Ads', 'dhepa-functions'),
    'id'         => 'first-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-first-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-first-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('First Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-first-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('First Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-first-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('First Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Second Section Ads', 'dhepa-functions'),
    'id'         => 'second-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-second-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-second-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Second Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-second-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Second Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-second-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Second Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Third Section Ads', 'dhepa-functions'),
    'id'         => 'third-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-third-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-third-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Third Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-third-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Third Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-third-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Third Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Forth Section Ads', 'dhepa-functions'),
    'id'         => 'forth-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-forth-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-forth-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Forth Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-forth-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Forth Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-forth-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Forth Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Fifth Section Ads', 'dhepa-functions'),
    'id'         => 'fifth-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-fifth-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-fifth-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Fifth Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-fifth-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Fifth Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-fifth-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Fifth Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Sixth Section Ads', 'dhepa-functions'),
    'id'         => 'sixth-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-sixth-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-sixth-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Sixth Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-sixth-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Sixth Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-sixth-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Sixth Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Seventh Section Ads', 'dhepa-functions'),
    'id'         => 'seventh-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-seventh-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-seventh-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Seventh Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-seventh-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Seventh Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-seventh-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Seventh Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Eighth Section Ads', 'dhepa-functions'),
    'id'         => 'eighth-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-eighth-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-eighth-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Eighth Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-eighth-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Eighth Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-eighth-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Eighth Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Ninth Section Ads', 'dhepa-functions'),
    'id'         => 'ninth-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-ninth-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-ninth-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Ninth Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-ninth-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Ninth Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-ninth-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Ninth Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Tenth Section Ads', 'dhepa-functions'),
    'id'         => 'tenth-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-tenth-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-tenth-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Tenth Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-tenth-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Tenth Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-tenth-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Tenth Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Eleventh Section Ads', 'dhepa-functions'),
    'id'         => 'eleventh-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-eleventh-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-eleventh-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Eleventh Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-eleventh-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Eleventh Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-eleventh-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Eleventh Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Home Page Twelfth Section Ads', 'dhepa-functions'),
    'id'         => 'twelfth-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-right',
    'fields'     => array(
        array(
            'id'       => 'enable-twelfth-sec-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'home-twelfth-section-top-ads-img',
            'type'     => 'media',
            'title'    => __('Twelfth Section Top- (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 728x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-728x90.jpg'
                        ),
        ),
        array(
            'id'       => 'home-twelfth-section-top-ads-img-url',
            'type'     => 'text',
            'title'    => __('Twelfth Section Top Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'home-twelfth-section-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Twelfth Section Top- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => __('Footer Top Ads', 'dhepa-functions'),
    'id'         => 'footer-top-section-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-hand-down',
    'fields'     => array(
        array(
            'id'       => 'enable-footer-top-ads',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Ads', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'footer-top-image-ads',
            'type'     => 'media',
            'title'    => __('Footer Top Ads (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 970x250 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-970x250.jpg'
                        ),
        ),
        array(
            'id'       => 'footer-top-image-ads-url',
            'type'     => 'text',
            'title'    => __('Footer Top Ads Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'footer-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Footer Top Ads- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),

    )
));

Redux::setSection($opt_name, array(
    'title'      => __('Single Page Ads', 'dhepa-functions'),
    'id'         => 'single-page-ads',
    'desc'       => __('', 'dhepa-functions'),
    'subsection' => true,
    'icon'      =>  'el el-website-alt',
    'fields'     => array(
        // Before Post Ad
        array(
            'id'       => 'single-top-image-ads',
            'type'     => 'media',
            'title'    => __('Before Post Ads (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 460x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-460x90.jpg'
                        ),
        ),
        array(
            'id'       => 'single-top-image-ads-url',
            'type'     => 'text',
            'title'    => __('Before Post Ads Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'single-top-ads-html',
            'type'     => 'textarea',
            'title'    => __('Before Post Ads- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
        // after Post Ad
        array(
            'id'       => 'after-post-image-ads',
            'type'     => 'media',
            'title'    => __('After Post Ads (Image)', 'dhepa-functions'),
            'subtitle' => __('Image Size Should be 460x90 pixel', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => array(
                            'url'=>plugin_dir_url( __FILE__ ).'/demo/newspaper-460x90.jpg'
                        ),
        ),
        array(
            'id'       => 'after-post-image-ads-url',
            'type'     => 'text',
            'title'    => __('After Post Ads Url', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'https://dhepa.com/bd-newspaper-themes/',
        ),
        array(
            'id'       => 'after-post-ads-html',
            'type'     => 'textarea',
            'title'    => __('After Post Ads- (Google Ads)', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
              
    )
));

Redux::setSection($opt_name, array(
    'title'            => __('Translation', 'dhepa-functions'),
    'id'               => 'translation',
    'desc'             => __('', 'dhepa-functions'),
    'customizer_width' => '400px',
    'icon'             => 'el el-edit',
    'fields'     => array(
        // Archive page top
        array(
            'id'       => 'latest-post',
            'type'     => 'text',
            'title'    => __('Latest Post', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'এইমাত্র পাওয়া',
        ),
        array(
            'id'       => 'popular-post',
            'type'     => 'text',
            'title'    => __('Popular Post', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'জনপ্রিয় খবর',
        ),
        array(
            'id'       => 'latest-in',
            'type'     => 'text',
            'title'    => __('Latest In', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'Latest In',
        ),
        array(
            'id'       => 'popular-in',
            'type'     => 'text',
            'title'    => __('Popular In', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'Popular In',
        ),
        array(
            'id'       => 'recommended-for-you',
            'type'     => 'text',
            'title'    => __('Recommended For You', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'আপনার জন্য নির্বাচিত',
        ),
        array(
            'id'       => 'publish',
            'type'     => 'text',
            'title'    => __('Publish', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'প্রকাশিত',
        ),
		array(
            'id'       => 'trending-now',
            'type'     => 'text',
            'title'    => __('Trending Now', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'ব্রেকিং নিউজ',
        ),
		array(
            'id'       => 'all-post',
            'type'     => 'text',
            'title'    => __('All Post', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'সকল খবর',
        ),
		array(
            'id'       => 'all-from',
            'type'     => 'text',
            'title'    => __('All From', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'All From',
        ),
		array(
            'id'       => 'all-videos-in-our-channel',
            'type'     => 'text',
            'title'    => __('All Videos in Our channel', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'সকল ভিডিও দেখুন আমাদের চ্যানেলে',
        ),
		array(
            'id'       => 'editor',
            'type'     => 'text',
            'title'    => __('Editor', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'সম্পাদক',
        ),
        array(
            'id'       => 'publisher',
            'type'     => 'text',
            'title'    => __('Publisher', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'প্রকাশক',
        ),
        array(
            'id'       => 'email',
            'type'     => 'text',
            'title'    => __('Email', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'Email',
        ),
		array(
            'id'       => 'see-our-latest-posts',
            'type'     => 'text',
            'title'    => __('See Our Latest Posts', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'আমাদের  সাম্প্রতিক খবর ',
        ),
		array(
            'id'       => 'error-404',
            'type'     => 'text',
            'title'    => __('Ooops... Error 404', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'ওহ!!! .... ইরর ৪০৪ ',
        ),
		array(
            'id'       => 'does-not-exist',
            'type'     => 'text',
            'title'    => __('Sorry, but the page you are looking for does not exist.', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'দুঃখিত, আপনি যেটা খুঁজছেন তা পাওয়া যায়নি',
        ),
		array(
            'id'       => 'go-to-home-page',
            'type'     => 'text',
            'title'    => __('GO TO THE HOMEPAGE', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'মূল পাতায় ফিরে যান',
        ),
		array(
            'id'       => 'latest-video',
            'type'     => 'text',
            'title'    => __('Latest Video', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'লেটেস্ট ভিডিও',
        ),
		array(
            'id'       => 'all-video',
            'type'     => 'text',
            'title'    => __('All Videos', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'সকল ভিডিও',
        ),
		array(
            'id'       => 'most-popular-video',
            'type'     => 'text',
            'title'    => __('Most Popular Video', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'খুব জনপ্রিয় ভিডিও', 'dhepa-functions',
        ),
		array(
            'id'       => 'popular-video',
            'type'     => 'text',
            'title'    => __('Popular Video', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'জনপ্রিয় ভিডিও', 'dhepa-functions',
        ),
		array(
            'id'       => 'prev-post',
            'type'     => 'text',
            'title'    => __('Previous', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'পূর্বের খবর ',
        ),
		array(
            'id'       => 'next-post',
            'type'     => 'text',
            'title'    => __('Next', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'পরবর্তী খবর ',
        ),
		array(
            'id'       => 'written-by',
            'type'     => 'text',
            'title'    => __('Written By', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'লিখেছেন',
        ),
		array(
            'id'       => 'total-view',
            'type'     => 'text',
            'title'    => __('Total View', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
            'default'  => 'মোট দেখা হয়েছে',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'            => __('Custom Code', 'dhepa-functions'),
    'id'               => 'custom-code',
    'desc'             => __('', 'dhepa-functions'),
    'customizer_width' => '400px',
    'icon'             => 'el el-edit',
    'fields'     => array(
        // Archive page top
        array(
            'id'       => 'header-code',
            'type'     => 'textarea',
            'title'    => __('Header Code', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
        array(
            'id'       => 'footer-code',
            'type'     => 'textarea',
            'title'    => __('Footer Code', 'dhepa-functions'),
            'subtitle' => __('', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),

    )
));
Redux::setSection($opt_name, array(
    'title'            => __('Google Ads Setup', 'dhepa-functions'),
    'id'               => 'google-ads-setup',
    'desc'             => __('', 'dhepa-functions'),
    'customizer_width' => '400px',
    'icon'             => 'el el-book',
    'fields'     => array(
        array(
            'id'       => 'enable-tag-manager',
            'type'     => 'button_set',
            'title'    => __( 'Enable/Desable Google Tag Manager', 'dhepa-functions' ),
            'subtitle' => __( '', 'dhepa-functions' ),
            'desc'     => __( '', 'dhepa-functions' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => 'Enable',
                '2' => 'Disable',
            ),
            'default'  => '1'
        ),
        
        // Google Ads
        array(
            'id'       => 'google-tag-manager',
            'type'     => 'text',
            'title'    => __('Google Tag Manager ID', 'dhepa-functions'),
            'subtitle' => __('Its Like > UA-xxxxxxx-x', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
        array(
            'id'       => 'google-ad-client',
            'type'     => 'text',
            'title'    => __('Google Ads Client ID', 'dhepa-functions'),
            'subtitle' => __('Its Like > ca-pub-XXXXXXXXX', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),
        array(
            'id'       => 'dataLayer-id',
            'type'     => 'text',
            'title'    => __('DataLayer ID', 'dhepa-functions'),
            'subtitle' => __('Its Like > GTM-xxxxxx', 'dhepa-functions'),
            'desc'     => __('', 'dhepa-functions'),
        ),

        
    )
));
/**
 * Raw README
 */
if ( file_exists( $dir . '/../README.md' ) ) {
	$section = array(
		'icon'   => 'el el-list-alt',
		'title'  => esc_html__( 'Documentation', 'dhepa-functions' ),
		'fields' => array(
			array(
				'id'           => 'opt-raw-documentation',
				'type'         => 'raw',
				'markdown'     => true,
				'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please.
			),
		),
	);

	Redux::set_section( $opt_name, $section );
}

Redux::set_section(
	$opt_name,
	array(
		'icon'            => 'el el-list-alt',
		'title'           => esc_html__( 'Customizer Only', 'dhepa-functions' ),
		'desc'            => '<p class="description">' . esc_html__( 'This Section should be visible only in Customizer', 'dhepa-functions' ) . '</p>',
		'customizer_only' => true,
		'fields'          => array(
			array(
				'id'              => 'opt-customizer-only',
				'type'            => 'select',
				'title'           => esc_html__( 'Customizer Only Option', 'dhepa-functions' ),
				'subtitle'        => esc_html__( 'The subtitle is NOT visible in customizer', 'dhepa-functions' ),
				'desc'            => esc_html__( 'The field desc is NOT visible in customizer.', 'dhepa-functions' ),
				'customizer_only' => true,
				'options'         => array(
					'1' => esc_html__( 'Opt 1', 'dhepa-functions' ),
					'2' => esc_html__( 'Opt 2', 'dhepa-functions' ),
					'3' => esc_html__( 'Opt 3', 'dhepa-functions' ),
				),
				'default'         => '2',
			),
		),
	)
);

/*
 * <--- END SECTIONS
 */

/*
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR OTHER CONFIGS MAY OVERRIDE YOUR CODE.
 */

/*
 * --> Action hook examples.
 */

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
// add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
//
// Change the arguments after they've been declared, but before the panel is created.
// add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
//
// Change the default value of a field after it's been set, but before it's been used.
// add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
//
// Dynamically add a section. Can be also used to modify sections/fields.
// add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
// .
if ( ! function_exists( 'compiler_action' ) ) {
	/**
	 * This is a test function that will let you see when the compiler hook occurs.
	 * It only runs if a field's value has changed and compiler=>true is set.
	 *
	 * @param array  $options        Options values.
	 * @param string $css            Compiler selector CSS values  compiler => array( CSS SELECTORS ).
	 * @param array  $changed_values Any values changed since last save.
	 */
	function compiler_action( array $options, string $css, array $changed_values ) {
		echo '<h1>The compiler hook has run!</h1>';
		echo '<pre>';
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions
		print_r( $changed_values ); // Values that have changed since the last save.
		// echo '<br/>';
		// print_r($options); //Option values.
		// echo '<br/>';
		// print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS ).
		echo '</pre>';
	}
}

if ( ! function_exists( 'redux_validate_callback_function' ) ) {
	/**
	 * Custom function for the callback validation referenced above
	 *
	 * @param array $field          Field array.
	 * @param mixed $value          New value.
	 * @param mixed $existing_value Existing value.
	 *
	 * @return array
	 */
	function redux_validate_callback_function( array $field, $value, $existing_value ): array {
		$error   = false;
		$warning = false;

		// Do your validation.
		if ( 1 === (int) $value ) {
			$error = true;
			$value = $existing_value;
		} elseif ( 2 === (int) $value ) {
			$warning = true;
			$value   = $existing_value;
		}

		$return['value'] = $value;

		if ( true === $error ) {
			$field['msg']    = 'your custom error message';
			$return['error'] = $field;
		}

		if ( true === $warning ) {
			$field['msg']      = 'your custom warning message';
			$return['warning'] = $field;
		}

		return $return;
	}
}


if ( ! function_exists( 'dynamic_section' ) ) {
	/**
	 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
	 * Simply include this function in the child themes functions.php file.
	 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
	 * so you must use get_template_directory_uri() if you want to use any of the built-in icons.
	 *
	 * @param array $sections Section array.
	 *
	 * @return array
	 */
	function dynamic_section( array $sections ): array {
		$sections[] = array(
			'title'  => esc_html__( 'Section via hook', 'dhepa-functions' ),
			'desc'   => '<p class="description">' . esc_html__( 'This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'dhepa-functions' ) . '</p>',
			'icon'   => 'el el-paper-clip',

			// Leave this as a blank section, no options just some intro text set above.
			'fields' => array(),
		);

		return $sections;
	}
}

if ( ! function_exists( 'change_arguments' ) ) {
	/**
	 * Filter hook for filtering the args.
	 * Good for child themes to override or add to the args array. Can also be used in other functions.
	 *
	 * @param array $args Global arguments array.
	 *
	 * @return array
	 */
	function change_arguments( array $args ): array {
		$args['dev_mode'] = true;

		return $args;
	}
}

if ( ! function_exists( 'change_defaults' ) ) {
	/**
	 * Filter hook for filtering the default value of any given field. Very useful in development mode.
	 *
	 * @param array $defaults Default value array.
	 *
	 * @return array
	 */
	function change_defaults( array $defaults ): array {
		$defaults['str_replace'] = esc_html__( 'Testing filter hook!', 'dhepa-functions' );

		return $defaults;
	}
}

if ( ! function_exists( 'redux_custom_sanitize' ) ) {
	/**
	 * Function to be used if the field sanitize argument.
	 * Return value MUST be the formatted or cleaned text to display.
	 *
	 * @param string $value Value to evaluate or clean.  Required.
	 *
	 * @return string
	 */
	function redux_custom_sanitize( string $value ): string {
		$return = '';

		foreach ( explode( ' ', $value ) as $w ) {
			foreach ( str_split( $w ) as $k => $v ) {
				if ( ( $k + 1 ) % 2 !== 0 && ctype_alpha( $v ) ) {
					$return .= mb_strtoupper( $v );
				} else {
					$return .= $v;
				}
			}

			$return .= ' ';
		}

		return $return;
	}
}
