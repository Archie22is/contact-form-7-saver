<?php
/**
 * Plugin Name:    Contact Form 7 Saver
 * Description:    Saves Contact Form 7 submissions and provides export functionality.
 * Version:        1.0.0
 * Author:         Archie22is (Archie Makuwa)
 *
 */

if (!defined('ABSPATH')) {
    exit;
}

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/save-submissions.php';
include_once plugin_dir_path(__FILE__) . 'includes/view-submissions.php';
include_once plugin_dir_path(__FILE__) . 'includes/export-submissions.php';
