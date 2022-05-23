<?php
/**
 * Plugin Name: CBQ App Manager
 * Plugin URI: https://github.com/atuls-dev
 * Description: This Plugin is used for WPFusion plugin custom api endpoints
 * Version: 1.0.1
 * Author: Atul
 * Author URI: https://github.com/atuls-dev
 * Text Domain: cbq-app-manager
 * */
defined("ABSPATH") or die();
define("CBQ_APP", plugin_dir_url(__FILE__));
define("CBQ_APP_PATH", plugin_dir_path(__FILE__));
define("CAM_TEXTDOMAIN", "cbq-app-manager");
define("CAM_ASSETS_PATH", CBQ_APP_PATH . "assets/");
define("CAM_INCLUDE_PATH", CBQ_APP_PATH . "includes/");


include_once CAM_INCLUDE_PATH . "api/endpoint.php";

class CBQ_App_Manager
{
    public function __construct()
    {
        add_action("admin_menu", [$this, "cbq_add_menu_pages"]);
    }

    public function cbq_add_menu_pages()
    {
        add_menu_page(
          "CBQ App Manager",
          "CBQ App Manager",
          "manage_options",
          "cbq_main_page",
          [$this, "cbq_api_page_fn"],
          "dashicons-book",
          12
        );

    }

    public function cbq_api_page_fn()
    {
        require_once CAM_INCLUDE_PATH . "api/documentation.php";
    }
}
$CBQ_App_Manager = new CBQ_App_Manager();

