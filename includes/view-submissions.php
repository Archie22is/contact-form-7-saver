<?php
function cf7_add_menu_page() {
    add_menu_page(
        'CF7 Submissions',
        'CF7 Submissions',
        'manage_options',
        'cf7-submissions',
        'cf7_render_submissions_page',
        'dashicons-list-view',
        6
    );
}
add_action('admin_menu', 'cf7_add_menu_page');

function cf7_render_submissions_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf7_submissions';
    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC");

    echo '<div class="wrap">';
    echo '<h1>Contact Form 7 Submissions</h1>';
    echo '<table class="widefat fixed" cellspacing="0">';
    echo '<thead><tr><th>ID</th><th>Form Name</th><th>Submitted At</th><th>Actions</th></tr></thead>';
    echo '<tbody>';
    foreach ($submissions as $submission) {
        echo '<tr>';
        echo '<td>' . esc_html($submission->id) . '</td>';
        echo '<td>' . esc_html($submission->form_name) . '</td>';
        echo '<td>' . esc_html($submission->submitted_at) . '</td>';
        echo '<td><a href="' . admin_url('admin.php?page=cf7-submission-details&id=' . $submission->id) . '">View</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
