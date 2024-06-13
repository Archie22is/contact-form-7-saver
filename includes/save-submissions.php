<?php
function cf7_save_submission($contact_form) {
    $submission = WPCF7_Submission::get_instance();
    
    if ($submission) {
        global $wpdb;

        $data = $submission->get_posted_data();
        $uploaded_files = $submission->uploaded_files();

        $form_id = $contact_form->id();
        $form_name = $contact_form->name();

        $data_serialized = maybe_serialize($data);
        $files_serialized = maybe_serialize($uploaded_files);

        $wpdb->insert(
            $wpdb->prefix . 'cf7_submissions',
            array(
                'form_id' => $form_id,
                'form_name' => $form_name,
                'submission_data' => $data_serialized,
                'uploaded_files' => $files_serialized,
                'submitted_at' => current_time('mysql')
            )
        );
    }
}
add_action('wpcf7_mail_sent', 'cf7_save_submission');

function cf7_create_database_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf7_submissions';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        form_id mediumint(9) NOT NULL,
        form_name varchar(255) NOT NULL,
        submission_data longtext NOT NULL,
        uploaded_files longtext NOT NULL,
        submitted_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'cf7_create_database_table');
