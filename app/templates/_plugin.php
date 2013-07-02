<?php
/*
Plugin Name: <%= TitleCaseWidgetName %>
Plugin URI: TODO
Description: <%= widgetDescription %>
Version: 1.0
Author: TODO
Author URI: TODO
Author Email: TODO
Text Domain: <%= _.slugify(widgetName) %>-locale
Domain Path: /lang/
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2012 TODO (email@domain.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class <%= classWidgetName %>_Widget extends WP_Widget {

    /*--------------------------------------------------*/
    /* Constructor
    /*--------------------------------------------------*/

    /**
     * Specifies the classname and description, instantiates the widget,
     * loads localization files, and includes necessary stylesheets and JavaScript.
     */
    public function __construct() {

        // load plugin text domain
        add_action( 'init', array( $this, 'widget_textdomain' ) );

        // Hooks fired when the Widget is activated and deactivated
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        parent::__construct(
            '<%= _.slugify(underscoredWidgetName) %>',
            __( '[<%= domainPrefix %>] <%= TitleCaseWidgetName %>', '<%= _.slugify(widgetName) %>-locale' ),
            array(
                'classname'     =>  '<%= underscoredWidgetName.toLowerCase() %>',
                'description'   =>  __( '<%= widgetDescription %>', '<%= _.slugify(widgetName) %>-locale' )
            )
        );

        // Register admin styles and scripts
        add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

        // Register site styles and scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

    } // end constructor

    /*--------------------------------------------------*/
    /* Widget API Functions
    /*--------------------------------------------------*/

    /**
     * Outputs the content of the widget.
     *
     * @param   array   args        The array of form elements
     * @param   array   instance    The current instance of the widget
     */
    public function widget( $args, $instance ) {

        extract( $args, EXTR_SKIP );

        echo $before_widget;

        // TODO:    Here is where you manipulate your widget's values based on their input fields

        include( plugin_dir_path( __FILE__ ) . '/views/widget.php' );

        echo $after_widget;

    } // end widget

    /**
     * Processes the widget's options to be saved.
     *
     * @param   array   new_instance    The previous instance of values before the update.
     * @param   array   old_instance    The new instance of values to be generated via the update.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        // TODO:    Here is where you update your widget's old values with the new, incoming values

        return $instance;

    } // end widget

    /**
     * Generates the administration form for the widget.
     *
     * @param   array   instance    The array of keys and values for the widget.
     */
    public function form( $instance ) {

        // TODO:    Define default values for your variables
        $instance = wp_parse_args(
            (array) $instance
        );

        // TODO:    Store the values of the widget in their own variable

        // Display the admin form
        include( plugin_dir_path(__FILE__) . '/views/admin.php' );

    } // end form

    /*--------------------------------------------------*/
    /* Public Functions
    /*--------------------------------------------------*/

    /**
     * Loads the Widget's text domain for localization and translation.
     */
    public function widget_textdomain() {

        load_plugin_textdomain( '<%= _.slugify(widgetName) %>-locale', false, plugin_dir_path( __FILE__ ) . '/lang/' );

    } // end widget_textdomain

    /**
     * Fired when the plugin is activated.
     *
     * @param       boolean $network_wide   True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
     */
    public function activate( $network_wide ) {
        // TODO define activation functionality here
    } // end activate

    /**
     * Fired when the plugin is deactivated.
     *
     * @param   boolean $network_wide   True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
     */
    public function deactivate( $network_wide ) {
        // TODO define deactivation functionality here
    } // end deactivate

    /**
     * Registers and enqueues admin-specific styles.
     */
    public function register_admin_styles() {

        $plugin_url = get_template_directory_uri().'/inc/widgets/<%= _.slugify(widgetName) %>/css/admin.css';
        wp_enqueue_style( '<%= _.slugify(widgetName) %>-admin-styles', $plugin_url);

    } // end register_admin_styles

    /**
     * Registers and enqueues admin-specific JavaScript.
     */
    public function register_admin_scripts() {

        $plugin_url = get_template_directory_uri().'/inc/widgets/<%= _.slugify(widgetName) %>/js/admin.js';
        wp_enqueue_script( '<%= _.slugify(widgetName) %>-admin-script', $plugin_url, array('jquery'), false, true );

    } // end register_admin_scripts

    /**
     * Registers and enqueues widget-specific styles.
     */
    public function register_widget_styles() {

        $plugin_url = get_template_directory_uri().'/inc/widgets/<%= _.slugify(widgetName) %>/css/widget.css';
        wp_enqueue_style( '<%= _.slugify(widgetName) %>-widget-styles', $plugin_url);

    } // end register_widget_styles

    /**
     * Registers and enqueues widget-specific scripts.
     */
    public function register_widget_scripts() {

        $plugin_url = get_template_directory_uri().'/inc/widgets/<%= _.slugify(widgetName) %>/js/widget.js';
        wp_enqueue_script( '<%= _.slugify(widgetName) %>-script', $plugin_url, array('jquery'), false, true );

    } // end register_widget_scripts

} // end class

add_action( 'widgets_init', create_function( '', 'register_widget("<%= classWidgetName %>_Widget");' ) );
