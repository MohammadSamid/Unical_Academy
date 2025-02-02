<?php
if(isset($_GET['ays_quiz_tab'])){
    $ays_quiz_tab = $_GET['ays_quiz_tab'];
}else{
    $ays_quiz_tab = 'tab1';
}
$action = (isset($_GET['action'])) ? sanitize_text_field($_GET['action']) : '';
$heading = '';

$id = (isset($_GET['quiz'])) ? absint(intval($_GET['quiz'])) : null;

$user_id = get_current_user_id();
$user = get_userdata($user_id);

$author = array(
    'id' => $user->ID,
    'name' => $user->data->display_name
);

$quiz = array(
    'title' => '',
    'author_id' => $user_id,
    'description' => '',
    'quiz_image' => '',
    'quiz_category_id' => '1',
    'question_ids' => '',
    'create_date' => current_time( 'mysql' ),
    'published' => 1
);
$options = array(
    'color' => '#27AE60',
    'bg_color' => '#fff',
    'text_color' => '#000',
    'height' => 350,
    'width' => 400,
    'timer' => 100,
    'information_form' => 'disable',
    'form_name' => '',
    'form_email' => '',
    'form_phone' => '',
    'enable_logged_users' => '',
    'image_width' => '',
    'image_height' => '',
    'enable_correction' => '',
    'enable_questions_counter' => 'on',
    'limit_users' => '',
    'limitation_message' => '',
    'redirect_url' => '',
    'redirection_delay' => '',
    'enable_progress_bar' => '',
    'randomize_questions' => '',
    'randomize_answers' => '',
    'enable_questions_result' => '',
    'custom_css' => '',
    'enable_restriction_pass' => '',
    'restriction_pass_message' => '',
    'user_role' => '',
    'result_text' => '',
    'enable_result' => '',
    'enable_timer' => 'off',
    'enable_pass_count' => 'on',
    'enable_quiz_rate' => '',
    'enable_rate_avg' => '',
    'enable_rate_comments' => '',
    'hide_score' => 'off',
    'rate_form_title' => '',
    'enable_box_shadow' => 'on',
    'box_shadow_color' => '#000',
    'quiz_border_radius' => '0',
    'quiz_bg_image' => '',
    'enable_border' => '',
    'quiz_border_width' => '1',
    'quiz_border_style' => 'solid',
    'quiz_border_color' => '#000',
    'quiz_timer_in_title' => '',
    'enable_restart_button' => 'off',
    'quiz_loader' => 'default',
    'autofill_user_data' => 'off',
    'quest_animation' => 'shake',
    'enable_bg_music' => 'off',
    'quiz_bg_music' => '',
    'answers_font_size' => '15',
    'show_create_date' => 'off',
    'show_author' => 'off',
    'enable_early_finish' => 'off',
    'answers_rw_texts' => 'on_passing',
    'disable_store_data' => 'off',
    'enable_background_gradient' => 'off',
    'background_gradient_color_1' => '#000',
    'background_gradient_color_2' => '#fff',
    'quiz_gradient_direction' => 'vertical',
    'redirect_after_submit' => 'off',
    'submit_redirect_url' => '',
    'submit_redirect_delay' => '',
    'progress_bar_style' => 'first',
    'enable_exit_button' => 'off',
    'exit_redirect_url' => '',
    'image_sizing' => 'cover',
    'quiz_bg_image_position' => 'center center',
    'custom_class' => '',
    'enable_social_links' => 'off',
    'social_links' => array(
        'linkedin_link' => '',
        'facebook_link' => '',
        'twitter_link' => ''
    ),
    'show_quiz_title' => 'on',
    'show_quiz_desc' => 'on',
    'show_login_form' => 'off',
    'mobile_max_width' => '',
    'limit_users_by' => 'ip',
	'explanation_time' => '4',
	'enable_clear_answer' => 'off',
	'show_category' => 'off',
	'show_question_category' => 'off',
    'display_score' => 'by_percentage',
    'enable_rw_asnwers_sounds' => 'off',
    'enable_enter_key' => 'on',
    'show_rate_after_rate' => 'on',
    'buttons_text_color' => '#333',
    'enable_audio_autoplay' => 'off',
    'enable_leave_page' => 'on',
    'show_only_wrong_answer' => 'off',
    'quiz_max_pass_count' => 1,
    'questions_hint_icon_or_text' => 'default',
    'questions_hint_value' => '',
    'progress_live_bar_style' => 'default',
    'show_questions_explanation' => 'on_results_page',

    //Buttons Styles
    'buttons_size' => 'medium',
    'buttons_font_size' => '17',
    'buttons_left_right_padding' => '20',
    'buttons_top_bottom_padding' => '10',
    'buttons_border_radius' => '3',

    //Answers styles
    'answers_padding' => '10',
    'answers_border' => 'on',
    'answers_border_width' => '1',
    'answers_border_style' => 'solid',
    'answers_border_color' => '#444',
    'ans_img_height' => '150',
    'ans_img_caption_style' => 'outside',
    'ans_img_caption_position' => 'bottom',
    'answers_box_shadow' => 'off',
    'answers_box_shadow_color' => '#000',
    'show_answers_caption' => 'on',
    'answers_margin' => '10',
    'ans_right_wrong_icon' => 'default',
    'quiz_bg_img_in_finish_page' => 'off',
    'finish_after_wrong_answer' => 'off',
    'answers_object_fit' => 'cover',

    // Develpoer version options
    'enable_copy_protection' => '',
	'activeInterval' => '',
	'deactiveInterval' => '',
	'active_date_check' => 'off',
	'active_date_message' => __("The quiz has expired!", $this->plugin_name),
    'active_date_pre_start_message' => __("The quiz will be available soon!", $this->plugin_name),
    'checkbox_score_by' => 'on',
    'calculate_score' => 'by_correctness',
    'question_bank_type' => 'general',
    'enable_tackers_count' => 'off',
    'tackers_count' => '',
    'show_interval_message' => 'on',
    'allow_collecting_logged_in_users_data' => 'off',
    'quiz_pass_score' => 0,
    'make_questions_required' => 'off',
    'enable_password' => 'off',
    'password_quiz'   => '',
    'generate_password' => 'general',
    'display_score_by' => 'by_percentage',
    'show_schedule_timer' => 'off',
    'show_timer_type' => 'countdown',
    'enable_negative_mark' => 'off',
    'negative_mark_point' => 0,


    // Integration option
    'enable_paypal' => '',
    'paypal_amount' => '',
    'paypal_currency' => '',
    'enable_mailchimp' => '',
    'mailchimp_list' => '',
	'enable_monitor' => '',
	'monitor_list' => '',
	'enable_slack' => '',
	'slack_conversation' => '',
	'active_camp_list' => '',
	'active_camp_automation' => '',
	'enable_active_camp' => '',
    'enable_google_sheets' => '',
	'spreadsheet_id' => '',

    // Email config options
    'send_results_user' => 'off', //AV
    'send_interval_msg' => 'off',
    'send_results_admin' => 'on',
    'send_interval_msg_to_admin' => 'off',
    'send_certificate_to_admin' => 'off',
    'additional_emails' => '',
    'email_config_from_email' => '',
    'email_config_from_name' => '',
    'email_config_from_subject' => '',
    'email_config_replyto_email' => '',
    'email_config_replyto_name' => '',
    'send_mail_to_site_admin' => 'on',

    'quiz_attributes' => array(),
    "certificate_title" => '<span style="font-size:50px; font-weight:bold">Certificate of Completion</span>',
    "certificate_body" => '<span style="font-size:25px"><i>This is to certify that</i></span><br><br>
            <span style="font-size:30px"><b>%%user_name%%</b></span><br/><br/>
            <span style="font-size:25px"><i>has completed the quiz</i></span><br/><br/>
            <span style="font-size:30px">"%%quiz_name%%"</span> <br/><br/>
            <span style="font-size:20px">with a score of <b>%%score%%</b></span><br/><br/>
            <span style="font-size:25px"><i>dated</i></span><br>
            <span style="font-size:30px">%%current_date%%</span><br/><br/><br/>',
    "certificate_image" => '',
    "certificate_frame" => 'default',
    "certificate_orientation" => 'l',

);
$question_ids = '';
$question_id_array = array();
$quiz_intervals_defaults = array(
    array(
        'interval_min' => '0',
        'interval_max' => '25',
        'interval_text' => '',
        'interval_image' => '',
        'interval_keyword' => 'A',
    ),
    array(
        'interval_min' => '26',
        'interval_max' => '50',
        'interval_text' => '',
        'interval_image' => '',
        'interval_keyword' => 'B',
    ),
    array(
        'interval_min' => '51',
        'interval_max' => '75',
        'interval_text' => '',
        'interval_image' => '',
        'interval_keyword' => 'C',
    ),
    array(
        'interval_min' => '76',
        'interval_max' => '100',
        'interval_text' => '',
        'interval_image' => '',
        'interval_keyword' => 'D',
    ),
);

$quiz_intervals_numbers = 4;
$quiz_settings = $this->settings_obj;

switch ($action) {
    case 'add':
        $heading = __('Add new quiz', $this->plugin_name);
        $quiz_intervals = $quiz_intervals_defaults;
        $quiz_default_options = ($quiz_settings->ays_get_setting('quiz_default_options') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('quiz_default_options');
        if (! empty($quiz_default_options)) {
            $quiz_default_options = json_decode($quiz_default_options, true);
        }
        if (! empty($quiz_default_options)) {
            $options = $quiz_default_options;
        }
        if( ! isset( $options['certificate_title'] ) || $options['certificate_title'] == '' ){
            $options['certificate_title'] = '<span style="font-size:50px; font-weight:bold">Certificate of Completion</span>';
        }
        if( ! isset( $options['certificate_body'] ) || $options['certificate_body'] == '' ){
            $options['certificate_body'] = '<span style="font-size:25px"><i>This is to certify that</i></span><br><br>
                <span style="font-size:30px"><b>%%user_name%%</b></span><br/><br/>
                <span style="font-size:25px"><i>has completed the quiz</i></span><br/><br/>
                <span style="font-size:30px">"%%quiz_name%%"</span> <br/><br/>
                <span style="font-size:20px">with a score of <b>%%score%%</b></span><br/><br/>
                <span style="font-size:25px"><i>dated</i></span><br>
                <span style="font-size:30px">%%current_date%%</span><br/><br/><br/>';
        }
        break;
    case 'edit':
        $heading = __('Edit quiz', $this->plugin_name);
        $quiz = $this->quizes_obj->get_quiz_by_id($id);
        $options = json_decode($quiz['options'], true);
        $question_ids = $quiz['question_ids'];
        $question_id_array = explode(',', $question_ids);
        $question_id_array = ($question_id_array[0] == '' && count($question_id_array) == 1) ? array() : $question_id_array;
        $quiz_intervals = json_decode($quiz['intervals'], true);
        $post_id = $quiz['post_id'];
        $ays_quiz_view_post_url = get_permalink($post_id);
        $ays_quiz_edit_post_url = get_edit_post_link($post_id);

        break;
}

$author_id = intval( $quiz['author_id'] );
$owner = false;
if( $user_id == $author_id ){
    $owner = true;
}

if( current_user_can( 'manage_options' ) ){
    $owner = true;
}

if( !$owner ){
    $url = esc_url_raw( remove_query_arg( array('action', 'quiz') ) );
    wp_redirect( $url );
}

$disabled_option = '';
$readonly_option = '';
if( !$owner ){
    $disabled_option = ' disabled ';
    $readonly_option = ' readonly ';
}


$quiz_intervals = ($quiz_intervals == null) ? $quiz_intervals_defaults : $quiz_intervals;
$questions = $this->quizes_obj->get_published_questions();
$total_questions_count = $this->quizes_obj->published_questions_record_count();
$quiz_categories = $this->quizes_obj->get_quiz_categories();
$question_categories = $this->get_questions_categories();
$question_categories_array = array();
foreach($question_categories as $cat){
    $question_categories_array[$cat['id']] = $cat['title'];
}

$used_questions = $this->get_published_questions_used();
$question_bank_categories = $this->quizes_obj->get_question_bank_categories($question_ids);

$settings_options = $this->settings_obj->ays_get_setting('options');
if($settings_options){
    $settings_options = json_decode($settings_options, true);
}else{
    $settings_options = array();
}
$right_answer_sound = (isset($settings_options['right_answer_sound']) && $settings_options['right_answer_sound'] != '') ? true : false;
$wrong_answer_sound = (isset($settings_options['wrong_answer_sound']) && $settings_options['wrong_answer_sound'] != '') ? true : false;
$rw_answers_sounds_status = false;
if($right_answer_sound && $wrong_answer_sound){
    $rw_answers_sounds_status = true;
}


$quiz_integrations = (get_option( 'ays_quiz_integrations' ) != null) ? json_decode( get_option( 'ays_quiz_integrations' ), true ) : array();
$quiz_paypal = array(
    'state' => (isset($quiz_integrations['paypal_client_id']) && $quiz_integrations['paypal_client_id'] != '') ? true : false,
    'clientId' => isset($quiz_integrations['paypal_client_id']) ? $quiz_integrations['paypal_client_id'] : null,
);

$mailchimp_res = ($quiz_settings->ays_get_setting('mailchimp') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('mailchimp');
$mailchimp = json_decode($mailchimp_res, true);
$mailchimp_username = isset($mailchimp['username']) ? $mailchimp['username'] : '' ;
$mailchimp_api_key = isset($mailchimp['apiKey']) ? $mailchimp['apiKey'] : '' ;
$mailchimp_lists = $this->ays_get_mailchimp_lists($mailchimp_username, $mailchimp_api_key);

$mailchimp_select = array();
if($mailchimp_lists['total_items'] > 0){
    foreach($mailchimp_lists['lists'] as $list){
        $mailchimp_select[] = array(
            'listId' => $list['id'],
            'listName' => $list['name']
        );
    }
}else{
    $mailchimp_select = __( "There are no lists", $this->plugin_name );
}

$monitor_res     = ($quiz_settings->ays_get_setting('monitor') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('monitor');
$monitor         = json_decode($monitor_res, true);
$monitor_client  = isset($monitor['client']) ? $monitor['client'] : '';
$monitor_api_key = isset($monitor['apiKey']) ? $monitor['apiKey'] : '';
$monitor_lists   = $this->ays_get_monitor_lists($monitor_client, $monitor_api_key);
$monitor_select  = !isset($monitor_lists['Code']) ? $monitor_lists : __("There are no lists", $this->plugin_name);


$slack_res           = ($quiz_settings->ays_get_setting('slack') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('slack');
$slack               = json_decode($slack_res, true);
$slack_client        = isset($slack['client']) ? $slack['client'] : '';
$slack_secret        = isset($slack['secret']) ? $slack['secret'] : '';
$slack_token         = isset($slack['token']) ? $slack['token'] : '';
$slack_conversations = $this->ays_get_slack_conversations($slack_token);
$slack_select        = !isset($slack_conversations['Code']) ? $slack_conversations : __("There are no conversations", $this->plugin_name);

$active_camp_res               = ($quiz_settings->ays_get_setting('active_camp') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('active_camp');
$active_camp                   = json_decode($active_camp_res, true);
$active_camp_url               = isset($active_camp['url']) ? $active_camp['url'] : '';
$active_camp_api_key           = isset($active_camp['apiKey']) ? $active_camp['apiKey'] : '';
$active_camp_lists             = $this->ays_get_active_camp_data('lists', $active_camp_url, $active_camp_api_key);
$active_camp_automations       = $this->ays_get_active_camp_data('automations', $active_camp_url, $active_camp_api_key);
$active_camp_list_select       = !isset($active_camp_lists['Code']) ? $active_camp_lists['lists'] : __("There are no lists", $this->plugin_name);
$active_camp_automation_select = !isset($active_camp_automations['Code']) ? $active_camp_automations['automations'] : __("There are no automations", $this->plugin_name);

$zapier_res  = ($quiz_settings->ays_get_setting('zapier') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('zapier');
$zapier      = json_decode($zapier_res, true);
$zapier_hook = isset($zapier['hook']) ? $zapier['hook'] : '';

// Google Sheets
$google_res           = ($quiz_settings->ays_get_setting('google') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('google');
$google               = json_decode($google_res, true);
$google_client        = isset($google['client']) ? $google['client'] : '';
$google_secret        = isset($google['secret']) ? $google['secret'] : '';
$google_token         = isset($google['token']) ? $google['token'] : '';
$google_refresh_token = isset($google['refresh_token']) ? $google['refresh_token'] : '';

if (isset($_POST['ays_submit']) || isset($_POST['ays_submit_top'])) {
    $_POST['id'] = $id;
    $this->quizes_obj->add_or_edit_quizes($_POST);
}
if (isset($_POST['ays_apply_top']) || isset($_POST['ays_apply'])) {
    $_POST["id"] = $id;
    $_POST['ays_change_type'] = 'apply';
    $this->quizes_obj->add_or_edit_quizes($_POST);
}
if (isset($_POST['ays_default'])) {
    $_POST["id"] = $id;
    $_POST['ays_change_type'] = 'apply';
    $_POST['ays_default_option'] = 'ays_default_option';
    $this->quizes_obj->add_or_edit_quizes($_POST);
}

$ays_user = wp_get_current_user();
$ays_super_admin_email = get_option('admin_email'); //$user->data->user_email;

$style = null;
$image_text = __('Add Image', $this->plugin_name);
$bg_image_text = __('Add Image', $this->plugin_name);
if ($quiz['quiz_image'] != '') {
    $style = "display: block;";
    $image_text = __('Edit Image', $this->plugin_name);
}

global $wp_roles;
$ays_users_roles = $wp_roles->roles;
$ays_users_search = get_users();


$all_attributes = $this->quizes_obj->get_al_attributes();
$quiz_attributes = (isset($options['quiz_attributes'])) ? $options['quiz_attributes'] : array();
$required_fields = (isset($options['required_fields'])) ? $options['required_fields'] : array();
$quiz_attributes_active_order = (isset($options['quiz_attributes_active_order'])) ? $options['quiz_attributes_active_order'] : array();
$quiz_attributes_passive_order = (isset($options['quiz_attributes_passive_order'])) ? $options['quiz_attributes_passive_order'] : array();
$default_attributes = array("ays_form_name", "ays_form_email", "ays_form_phone");
$quiz_attributes_checked = array();
$quiz_form_attrs = array();

//var_dump($quiz_attributes_order);
if(isset($options['form_name']) && $options['form_name'] == 'on'){
    $quiz_attributes_checked[] = "ays_form_name";
}
if(isset($options['form_email']) && $options['form_email'] == 'on'){
    $quiz_attributes_checked[] = "ays_form_email";
}
if(isset($options['form_phone']) && $options['form_phone'] == 'on'){
    $quiz_attributes_checked[] = "ays_form_phone";
}

$quiz_form_attrs[] = array(
    "id" => null,
    "slug" => "ays_form_name",
    "name" => __( "Name", $this->plugin_name ),
    "type" => 'text'
);
$quiz_form_attrs[] = array(
    "id" => null,
    "slug" => "ays_form_email",
    "name" => __( "Email", $this->plugin_name ),
    "type" => 'email'
);
$quiz_form_attrs[] = array(
    "id" => null,
    "slug" => "ays_form_phone",
    "name" => __( "Phone", $this->plugin_name ),
    "type" => 'text'
);

$all_attributes = array_merge($quiz_form_attrs, $all_attributes);
$custom_fields = array();
foreach($all_attributes as $key => $attr){
    $attr_checked = in_array(strval($attr['id']), $quiz_attributes) ? 'checked' : '';
    $attr_required = in_array(strval($attr['id']), $required_fields) ? 'checked' : '';
    if(in_array($attr['slug'], $quiz_attributes_checked)){
        $attr_checked = 'checked';
    }
    if(in_array($attr['slug'], $required_fields)){
        $attr_required = 'checked';
    }
    $custom_fields[$attr['slug']] = array(
        'id' => $attr['id'],
        'name' => $attr['name'],
        'type' => $attr['type'],
        'slug' => $attr['slug'],
        'checked' => $attr_checked,
        'required' => $attr_required,
    );
}


$custom_fields_active = array();
$custom_fields_passive = array();
foreach($custom_fields as $key => $attr){
    if($attr['checked'] == 'checked'){
        $custom_fields_active[$attr['slug']] = $attr;
    }else{
        $custom_fields_passive[$attr['slug']] = $attr;
    }
}

uksort($custom_fields_active, function($key1, $key2) use ($quiz_attributes_active_order) {
	return ((array_search($key1, $quiz_attributes_active_order) > array_search($key2, $quiz_attributes_active_order)) ? 1 : -1);
});
uksort($custom_fields_passive, function($key1, $key2) use ($quiz_attributes_passive_order) {
	return ((array_search($key1, $quiz_attributes_passive_order) > array_search($key2, $quiz_attributes_passive_order)) ? 1 : -1);
});
//var_dump($custom_fields);

$enable_pass_count = (isset($options['enable_pass_count'])) ? $options['enable_pass_count'] : '';
$enable_timer = (isset($options['enable_timer'])) ? $options['enable_timer'] : 'off';
$enable_quiz_rate = (isset($options['enable_quiz_rate'])) ? $options['enable_quiz_rate'] : '';
$enable_rate_avg = (isset($options['enable_rate_avg'])) ? $options['enable_rate_avg'] : '';
$enable_rate_comments = (isset($options['enable_rate_comments'])) ? $options['enable_rate_comments'] : '';
$enable_copy_protection = (isset($options['enable_copy_protection'])) ? $options['enable_copy_protection'] : '';

// Paypal
$enable_paypal = (isset($options['enable_paypal'])) ? $options['enable_paypal'] : '';
$paypal_amount = (isset($options['paypal_amount'])) ? $options['paypal_amount'] : '';
$paypal_currency = (isset($options['paypal_currency'])) ? $options['paypal_currency'] : '';

// MailChimp
$enable_mailchimp = (isset($options['enable_mailchimp']) && $options['enable_mailchimp'] == 'on') ? true : false;
$mailchimp_list = (isset($options['mailchimp_list'])) ? $options['mailchimp_list'] : '';

// Campaign Monitor
$enable_monitor = (isset($options['enable_monitor']) && $options['enable_monitor'] == 'on') ? true : false;
$monitor_list   = (isset($options['monitor_list'])) ? $options['monitor_list'] : '';

// Slack
$enable_slack       = (isset($options['enable_slack']) && $options['enable_slack'] == 'on') ? true : false;
$slack_conversation = (isset($options['slack_conversation'])) ? $options['slack_conversation'] : '';

// ActiveCampaign
$enable_active_camp     = (isset($options['enable_active_camp']) && $options['enable_active_camp'] == 'on') ? true : false;
$active_camp_list       = (isset($options['active_camp_list'])) ? $options['active_camp_list'] : '';
$active_camp_automation = (isset($options['active_camp_automation'])) ? $options['active_camp_automation'] : '';

// Zapier
$enable_zapier = (isset($options['enable_zapier']) && $options['enable_zapier'] == 'on') ? true : false;

// Google Sheets
$enable_google_sheets       = (isset($options['enable_google_sheets']) && $options['enable_google_sheets'] == 'on') ? true : false;

$enable_box_shadow = (!isset($options['enable_box_shadow'])) ? 'on' : $options['enable_box_shadow'];
$box_shadow_color = (!isset($options['box_shadow_color'])) ? '#000' : $options['box_shadow_color'];
$quiz_border_radius = (isset($options['quiz_border_radius']) && $options['quiz_border_radius'] != '') ? $options['quiz_border_radius'] : '0';
$quiz_bg_image = (isset($options['quiz_bg_image']) && $options['quiz_bg_image'] != '') ? $options['quiz_bg_image'] : '';
$enable_border = (isset($options['enable_border']) && $options['enable_border'] == 'on') ? true : false;
$quiz_border_width = (isset($options['quiz_border_width']) && $options['quiz_border_width'] != '') ? $options['quiz_border_width'] : '1';
$quiz_border_style = (isset($options['quiz_border_style']) && $options['quiz_border_style'] != '') ? $options['quiz_border_style'] : 'solid';
$quiz_border_color = (isset($options['quiz_border_color']) && $options['quiz_border_color'] != '') ? $options['quiz_border_color'] : '#000';
$quiz_timer_in_title = (isset($options['quiz_timer_in_title']) && $options['quiz_timer_in_title'] == 'on') ? true : false;
$enable_restart_button = (isset($options['enable_restart_button']) && $options['enable_restart_button'] == 'on') ? true : false;

$rate_form_title = (isset($options['rate_form_title'])) ? $options['rate_form_title'] : __('Please click the stars to rate the quiz', $this->plugin_name);
$quiz_loader = (isset($options['quiz_loader']) && $options['quiz_loader'] != '') ? $options['quiz_loader'] : 'default';

$quiz_create_date = (isset($quiz['create_date']) && $quiz['create_date'] != '') ? $quiz['create_date'] : "0000-00-00 00:00:00";

$autofill_user_data = (isset($options['autofill_user_data']) && $options['autofill_user_data'] == 'on') ? true : false;

$quest_animation = (isset($options['quest_animation'])) ? $options['quest_animation'] : "shake";
$enable_bg_music = (isset($options['enable_bg_music']) && $options['enable_bg_music'] == "on") ? true : false;
$quiz_bg_music = (isset($options['quiz_bg_music']) && $options['quiz_bg_music'] != "") ? $options['quiz_bg_music'] : "";
$answers_font_size = (isset($options['answers_font_size']) && $options['answers_font_size'] != "") ? $options['answers_font_size'] : '15';

// Strong calculation of checkbox answers
$options['checkbox_score_by'] = ! isset($options['checkbox_score_by']) ? 'on' : $options['checkbox_score_by'];
$checkbox_score_by = (isset($options['checkbox_score_by']) && $options['checkbox_score_by'] == "on") ? true : false;

$show_create_date = (isset($options['show_create_date']) && $options['show_create_date'] == "on") ? true : false;
$show_author = (isset($options['show_author']) && $options['show_author'] == "on") ? true : false;
$enable_early_finish = (isset($options['enable_early_finish']) && $options['enable_early_finish'] == "on") ? true : false;
$answers_rw_texts = (isset($options['answers_rw_texts']) && $options['answers_rw_texts'] != '') ? $options['answers_rw_texts'] : 'on_passing';
$disable_store_data = (isset($options['disable_store_data']) && $options['disable_store_data'] == 'on') ? true : false;


// Background gradient
$options['enable_background_gradient'] = (!isset($options['enable_background_gradient'])) ? 'off' : $options['enable_background_gradient'];
$enable_background_gradient = (isset($options['enable_background_gradient']) && $options['enable_background_gradient'] == 'on') ? true : false;
$background_gradient_color_1 = (isset($options['background_gradient_color_1']) && $options['background_gradient_color_1'] != '') ? $options['background_gradient_color_1'] : '#000';
$background_gradient_color_2 = (isset($options['background_gradient_color_2']) && $options['background_gradient_color_2'] != '') ? $options['background_gradient_color_2'] : '#fff';
$quiz_gradient_direction = (isset($options['quiz_gradient_direction']) && $options['quiz_gradient_direction'] != '') ? $options['quiz_gradient_direction'] : 'vertical';


//Schedule of Quiz
$options['active_date_check'] = isset($options['active_date_check']) ? $options['active_date_check'] : 'off';
$active_date_check = (isset($options['active_date_check']) && $options['active_date_check'] == 'on') ? true : false;
if ($active_date_check) {
	$activateTime   = strtotime($options['activeInterval']);
	$activeQuiz     = date('Y-m-d H:i:s', $activateTime);
	$deactivateTime = strtotime($options['deactiveInterval']);
	$deactiveQuiz   = date('Y-m-d H:i:s', $deactivateTime);
} else {
	$activeQuiz   = current_time( 'mysql' );
	$deactiveQuiz = current_time( 'mysql' );
}

// WooCommerce integration
$quiz_intervals_wc = in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')));

$wc_for_js = "";
if($quiz_intervals_wc){
    $wc_for_js = "with-woo-product";
}

// Email configuration

$additional_emails = (isset($options['additional_emails']) && $options['additional_emails'] != '') ? $options['additional_emails'] : '';
$email_config_from_email = (isset($options['email_config_from_email']) && $options['email_config_from_email'] != '') ? $options['email_config_from_email'] : '';
$email_config_from_name = (isset($options['email_config_from_name']) && $options['email_config_from_name'] != '') ? stripslashes(htmlentities($options['email_config_from_name'], ENT_QUOTES, "UTF-8")) : '';
$email_config_from_subject = (isset($options['email_config_from_subject']) && $options['email_config_from_subject'] != '') ? stripslashes(htmlentities($options['email_config_from_subject'], ENT_QUOTES, "UTF-8")) : '';
$email_config_replyto_email = (isset($options['email_config_replyto_email']) && $options['email_config_replyto_email'] != '') ? $options['email_config_replyto_email'] : '';
$email_config_replyto_name = (isset($options['email_config_replyto_name']) && $options['email_config_replyto_name'] != '') ? stripslashes(htmlentities($options['email_config_replyto_name'], ENT_QUOTES, "UTF-8")) : '';

// Calculate the score option
$options['calculate_score'] = (!isset($options['calculate_score'])) ? 'by_correctness' : $options['calculate_score'];
$calculate_score = (isset($options['calculate_score']) && $options['calculate_score'] != '') ? $options['calculate_score'] : 'by_correctness';

// Quiz theme
$quiz_theme = isset($options['quiz_theme']) && $options['quiz_theme'] != "" ? $options['quiz_theme'] : 'classic_light';

// Redirect after submit
$options['redirect_after_submit'] = (!isset($options['redirect_after_submit'])) ? 'off' : $options['redirect_after_submit'];
$redirect_after_submit = isset($options['redirect_after_submit']) && $options['redirect_after_submit'] == 'on' ? true : false;
$submit_redirect_url = isset($options['submit_redirect_url']) ? $options['submit_redirect_url'] : '';
$submit_redirect_delay = isset($options['submit_redirect_delay']) ? $options['submit_redirect_delay'] : '';

// Progress bar style
$progress_bar_style = (isset($options['progress_bar_style']) && $options['progress_bar_style'] != "") ? $options['progress_bar_style'] : 'first';

// Exit button in finish page
$options['enable_exit_button'] = (!isset($options['enable_exit_button'])) ? 'off' : $options['enable_exit_button'];
$enable_exit_button = isset($options['enable_exit_button']) && $options['enable_exit_button'] == 'on' ? true : false;
$exit_redirect_url = isset($options['exit_redirect_url']) ? $options['exit_redirect_url'] : '';

// Question image sizing
$image_sizing = (isset($options['image_sizing']) && $options['image_sizing'] != "") ? $options['image_sizing'] : 'cover';

// Quiz background image position
$quiz_bg_image_position = (isset($options['quiz_bg_image_position']) && $options['quiz_bg_image_position'] != "") ? $options['quiz_bg_image_position'] : 'center center';

// Custom class for quiz container
$custom_class = (isset($options['custom_class']) && $options['custom_class'] != "") ? $options['custom_class'] : '';

// Social Media links
$enable_social_links = (isset($options['enable_social_links']) && $options['enable_social_links'] == "on") ? true : false;
$social_links = (isset($options['social_links'])) ? $options['social_links'] : array(
    'linkedin_link' => '',
    'facebook_link' => '',
    'twitter_link' => ''
);
$linkedin_link = isset($social_links['linkedin_link']) && $social_links['linkedin_link'] != '' ? $social_links['linkedin_link'] : '';
$facebook_link = isset($social_links['facebook_link']) && $social_links['facebook_link'] != '' ? $social_links['facebook_link'] : '';
$twitter_link = isset($social_links['twitter_link']) && $social_links['twitter_link'] != '' ? $social_links['twitter_link'] : '';

// Show quiz head information
// Show quiz title and description
$options['show_quiz_title'] = isset($options['show_quiz_title']) ? $options['show_quiz_title'] : 'on';
$options['show_quiz_desc'] = isset($options['show_quiz_desc']) ? $options['show_quiz_desc'] : 'on';
$show_quiz_title = (isset($options['show_quiz_title']) && $options['show_quiz_title'] == "on") ? true : false;
$show_quiz_desc = (isset($options['show_quiz_desc']) && $options['show_quiz_desc'] == "on") ? true : false;


// Show login form for not logged in users
$options['show_login_form'] = isset($options['show_login_form']) ? $options['show_login_form'] : 'off';
$show_login_form = (isset($options['show_login_form']) && $options['show_login_form'] == "on") ? true : false;


// Quiz container max-width for mobile
$mobile_max_width = (isset($options['mobile_max_width']) && $options['mobile_max_width'] != "") ? $options['mobile_max_width'] : '';


// Quiz theme
$quiz_theme = (isset($options['quiz_theme']) && $options['quiz_theme'] != '') ? $options['quiz_theme'] : 'classic_light';


// Limit users by option
$limit_users_by = (isset($options['limit_users_by']) && $options['limit_users_by'] != '') ? $options['limit_users_by'] : 'ip';

//Send results to user
$options['send_results_user'] = !isset($options['send_results_user']) ? 'off' : $options['send_results_user'];
$send_results_user = isset($options['send_results_user']) && $options['send_results_user'] == 'on' ? 'checked' : '';

//Send interval message to user
$options['send_interval_msg'] = !isset($options['send_interval_msg']) ? 'off' : $options['send_interval_msg'];
$send_interval_msg = isset($options['send_interval_msg']) && $options['send_interval_msg'] == 'on' ? 'checked' : '';

// Question bank options
// Question bank type
$question_bank_type = (isset($options['question_bank_type']) && $options['question_bank_type'] != '') ? $options['question_bank_type'] : 'general';
$questions_bank_cat_count = (isset($options['questions_bank_cat_count']) && !empty($options['questions_bank_cat_count'])) ? $options['questions_bank_cat_count'] : array();

foreach($question_bank_categories as $cid => $cat){
    if(! array_key_exists($cid, $questions_bank_cat_count)){
        $questions_bank_cat_count[$cid] = '';
    }
}

// Limitation tackers of quiz
$options['enable_tackers_count'] = !isset($options['enable_tackers_count']) ? 'off' : $options['enable_tackers_count'];
$enable_tackers_count = (isset($options['enable_tackers_count']) && $options['enable_tackers_count'] == 'on') ? true : false;
$tackers_count = (isset($options['tackers_count']) && $options['tackers_count'] != '') ? $options['tackers_count'] : '';

//AV Get post categories
$cat_list = get_categories(
    array(
        'hide_empty' => false,
    )
);


// Right/wrong answer text showing time option
$explanation_time = (isset($options['explanation_time']) && $options['explanation_time'] != '') ? $options['explanation_time'] : '4';

// Enable claer answer button
$options['enable_clear_answer'] = isset($options['enable_clear_answer']) ? $options['enable_clear_answer'] : 'off';
$enable_clear_answer = (isset($options['enable_clear_answer']) && $options['enable_clear_answer'] == "on") ? true : false;

//Send results to admin
$options['send_results_admin'] = !isset($options['send_results_admin']) ? 'on' : $options['send_results_admin'];
$send_results_admin = isset($options['send_results_admin']) && $options['send_results_admin'] == 'on' ? 'checked' : '';

//Send interval message to admin
$options['send_interval_msg_to_admin'] = !isset($options['send_interval_msg_to_admin']) ? 'off' : $options['send_interval_msg_to_admin'];
$send_interval_msg_to_admin = isset($options['send_interval_msg_to_admin']) && $options['send_interval_msg_to_admin'] == 'on' ? 'checked' : '';

// Show quiz category
$options['show_category'] = isset($options['show_category']) ? $options['show_category'] : 'off';
$show_category = (isset($options['show_category']) && $options['show_category'] == "on") ? true : false;

// Show question category
$options['show_question_category'] = isset($options['show_question_category']) ? $options['show_question_category'] : 'off';
$show_question_category = (isset($options['show_question_category']) && $options['show_question_category'] == "on") ? true : false;

/*
 * Answers images styles
 **********************************************
 */
// Answers padding option
$answers_padding = (isset($options['answers_padding']) && $options['answers_padding'] != '') ? $options['answers_padding'] : '10';
// Answers margin option
$answers_margin = (isset($options['answers_margin']) && $options['answers_margin'] != '') ? $options['answers_margin'] : '10';
// Answers border options
$options['answers_border'] = (isset($options['answers_border'])) ? $options['answers_border'] : 'on';
$answers_border = (isset($options['answers_border']) && $options['answers_border'] == 'on') ? true : false;
$answers_border_width = (isset($options['answers_border_width']) && $options['answers_border_width'] != '') ? $options['answers_border_width'] : '1';
$answers_border_style = (isset($options['answers_border_style']) && $options['answers_border_style'] != '') ? $options['answers_border_style'] : 'solid';
$answers_border_color = (isset($options['answers_border_color']) && $options['answers_border_color'] != '') ? $options['answers_border_color'] : '#444';

$answers_box_shadow = (isset($options['answers_box_shadow']) && $options['answers_box_shadow'] == 'on') ? true : false;
$answers_box_shadow_color = (isset($options['answers_box_shadow_color']) && $options['answers_box_shadow_color'] != '') ? $options['answers_box_shadow_color'] : '#000';

// Answers image options
$ans_img_height = (isset($options['ans_img_height']) && $options['ans_img_height'] != '') ? $options['ans_img_height'] : '150';
$ans_img_caption_style = (isset($options['ans_img_caption_style']) && $options['ans_img_caption_style'] != '') ? $options['ans_img_caption_style'] : 'outside';
$ans_img_caption_position = (isset($options['ans_img_caption_position']) && $options['ans_img_caption_position'] != '') ? $options['ans_img_caption_position'] : 'bottom';

// Show answers caption
$options['show_answers_caption'] = isset($options['show_answers_caption']) ? $options['show_answers_caption'] : 'on';
$show_answers_caption = (isset($options['show_answers_caption']) && $options['show_answers_caption'] == 'on') ? true : false;

// Answers right/wrong answers icons
$ans_right_wrong_icon = (isset($options['ans_right_wrong_icon']) && $options['ans_right_wrong_icon'] != '') ? $options['ans_right_wrong_icon'] : 'default';

/*************************************************/

// Show interval message
$options['show_interval_message'] = isset($options['show_interval_message']) ? $options['show_interval_message'] : 'on';
$show_interval_message = (isset($options['show_interval_message']) && $options['show_interval_message'] == 'on') ? true : false;

// Display score option
$display_score = (isset($options['display_score']) && $options['display_score'] != "") ? $options['display_score'] : 'by_percentage';

// Right / Wrong answers sound option
$options['enable_rw_asnwers_sounds'] = isset($options['enable_rw_asnwers_sounds']) ? $options['enable_rw_asnwers_sounds'] : 'off';
$enable_rw_asnwers_sounds = (isset($options['enable_rw_asnwers_sounds']) && $options['enable_rw_asnwers_sounds'] == "on") ? true : false;

// Allow collecting logged in users data
$options['allow_collecting_logged_in_users_data'] = isset($options['allow_collecting_logged_in_users_data']) ? $options['allow_collecting_logged_in_users_data'] : 'off';
$allow_collecting_logged_in_users_data = (isset($options['allow_collecting_logged_in_users_data']) && $options['allow_collecting_logged_in_users_data'] == "on") ? true : false;

// Pass score of the quiz
$quiz_pass_score = (isset($options['quiz_pass_score']) && $options['quiz_pass_score'] != "") ? $options['quiz_pass_score'] : 0;

// Hide quiz background image on the result page
$options['quiz_bg_img_in_finish_page'] = isset($options['quiz_bg_img_in_finish_page']) ? $options['quiz_bg_img_in_finish_page'] : 'off';
$quiz_bg_img_in_finish_page = (isset($options['quiz_bg_img_in_finish_page']) && $options['quiz_bg_img_in_finish_page'] == "on") ? true : false;

// Finish the quiz after making one wrong answer
$options['finish_after_wrong_answer'] = isset($options['finish_after_wrong_answer']) ? $options['finish_after_wrong_answer'] : 'off';
$finish_after_wrong_answer = (isset($options['finish_after_wrong_answer']) && $options['finish_after_wrong_answer'] == "on") ? true : false;

// Text after timer ends
$after_timer_text = (isset($options['after_timer_text']) && $options['after_timer_text'] != '') ? wpautop(stripslashes($options['after_timer_text'])) : '';

// Send certificate to admin too
$options['send_certificate_to_admin'] = isset($options['send_certificate_to_admin']) ? $options['send_certificate_to_admin'] : 'off';
$ays_send_certificate_to_admin = (isset($options['send_certificate_to_admin']) && $options['send_certificate_to_admin'] == "on") ? true : false;

// Enable to go next by pressing Enter key
$options['enable_enter_key'] = isset($options['enable_enter_key']) ? $options['enable_enter_key'] : 'on';
$enable_enter_key = (isset($options['enable_enter_key']) && $options['enable_enter_key'] == "on") ? true : false;

// Certificate title
$certificate_title = wpautop(stripslashes((isset($options['certificate_title'])) ? $options['certificate_title'] : ''));

// Certificate body
$certificate_body = wpautop(stripslashes((isset($options['certificate_body'])) ? $options['certificate_body'] : ''));

// Certificate background image
$certificate_image = (isset($options['certificate_image']) && $options['certificate_image'] != '') ? $options['certificate_image'] : '';

// Certificate background frame
$certificate_frame = (isset($options['certificate_frame']) && $options['certificate_frame'] != '') ? $options['certificate_frame'] : 'default';

$pdfapi_url = "https://ays-pro.com/pdfapi"; // rtrim(AYS_QUIZ_BASE_URL, '/') . '-pdfapi/pdfapi/',
//$pdfapi_url = "http://localhost/pdfapi";
$certificate_frames_url = apply_filters( 'ays_quiz_pdfapi_api_url', $pdfapi_url );
$certificate_frames_url = rtrim($certificate_frames_url, '/') . '/frames/';

// Certificate orientation
$certificate_orientation = (isset($options['certificate_orientation']) && $options['certificate_orientation'] != '') ? $options['certificate_orientation'] : 'l';

// Make the questions required
$options['make_questions_required'] = isset($options['make_questions_required']) ? $options['make_questions_required'] : 'off';
$make_questions_required = (isset($options['make_questions_required']) && $options['make_questions_required'] == "on") ? true : false;

// Show average rate after rate
$options['show_rate_after_rate'] = isset($options['show_rate_after_rate']) ? $options['show_rate_after_rate'] : 'on';
$show_rate_after_rate = (isset($options['show_rate_after_rate']) && $options['show_rate_after_rate'] == "on") ? true : false;

// Text color
$text_color = (isset($options['text_color']) && $options['text_color'] != '') ? $options['text_color'] : '#333';

// Buttons text color
$buttons_text_color = (isset($options['buttons_text_color']) && $options['buttons_text_color'] != '') ? $options['buttons_text_color'] : $text_color;

// Buttons position
$buttons_position = (isset($options['buttons_position']) && $options['buttons_position'] != '') ? $options['buttons_position'] : 'center';

// Password quiz
$options['enable_password'] = !isset($options['enable_password']) ? 'off' : $options['enable_password'];
$enable_password = (isset($options['enable_password']) && $options['enable_password'] == 'on') ? true : false;
$password_quiz = (isset($options['password_quiz']) && $options['password_quiz'] != '') ? $options['password_quiz'] : '';

$mail_message_admin = (isset($options['mail_message_admin']) && $options['mail_message_admin'] != '') ? wpautop(stripslashes($options['mail_message_admin'])) : '';

// Enable audio autoplay
$enable_audio_autoplay = (isset($options['enable_audio_autoplay']) && $options['enable_audio_autoplay'] == 'on') ? true : false;

// =========== Buttons Styles Start ===========

// Buttons size
$buttons_size = (isset($options['buttons_size']) && $options['buttons_size'] != "") ? $options['buttons_size'] : 'medium';

// Buttons font size
$buttons_font_size = (isset($options['buttons_font_size']) && $options['buttons_font_size'] != "") ? $options['buttons_font_size'] : '17';

// Buttons Left / Right padding
$buttons_left_right_padding = (isset($options['buttons_left_right_padding']) && $options['buttons_left_right_padding'] != '') ? $options['buttons_left_right_padding'] : '20';

// Buttons Top / Bottom padding
$buttons_top_bottom_padding = (isset($options['buttons_top_bottom_padding']) && $options['buttons_top_bottom_padding'] != '') ? $options['buttons_top_bottom_padding'] : '10';

// Buttons border radius
$buttons_border_radius = (isset($options['buttons_border_radius']) && $options['buttons_border_radius'] != "") ? $options['buttons_border_radius'] : '3';

// =========== Buttons Styles End ===========

//Send mail to site admin
$options['send_mail_to_site_admin'] = !isset($options['send_mail_to_site_admin']) ? 'on' : $options['send_mail_to_site_admin'];
$send_mail_to_site_admin = isset($options['send_mail_to_site_admin']) && $options['send_mail_to_site_admin'] == 'on' ? 'checked' : '';

// Enable leave page
$options['enable_leave_page'] = isset($options['enable_leave_page']) ? $options['enable_leave_page'] : 'on';
$enable_leave_page = (isset($options['enable_leave_page']) && $options['enable_leave_page'] == "on") ? true : false;

// Show only wrong answer
$options['show_only_wrong_answer'] = isset($options['show_only_wrong_answer']) ? $options['show_only_wrong_answer'] : 'off';
$show_only_wrong_answer = (isset($options['show_only_wrong_answer']) && $options['show_only_wrong_answer'] == "on") ? true : false;

// Pass Score
$pass_score = (isset($options['pass_score']) && $options['pass_score'] != '') ? absint(intval($options['pass_score'])) : '0';

// Quiz pass message
$pass_score_message = isset($options['pass_score_message']) ? stripslashes($options['pass_score_message']) : '<h4 style="text-align: center;">'. __("Congratulations!", $this->plugin_name) .'</h4><p style="text-align: center;">'. __("You passed the quiz!", $this->plugin_name) .'</p>';

// Quiz pass message
$fail_score_message = isset($options['fail_score_message']) ? stripslashes($options['fail_score_message']) : '<h4 style="text-align: center;">'. __("Oops!", $this->plugin_name) .'</h4><p style="text-align: center;">'. __("You are not passed the quiz! <br> Try again!", $this->plugin_name) .'</p>';

// Maximum pass score of the quiz
$quiz_max_pass_count = (isset($options['quiz_max_pass_count']) && $options['quiz_max_pass_count'] != "") ?  absint(intval($options['quiz_max_pass_count'])) : 1;

// Question Font Size
$question_font_size = (isset($options['question_font_size']) && $options['question_font_size'] != '') ? absint(intval($options['question_font_size'])) : '16';

// Quiz Width by percentage or pixels
$quiz_width_by_percentage_px = (isset($options['quiz_width_by_percentage_px']) && $options['quiz_width_by_percentage_px'] != '') ? $options['quiz_width_by_percentage_px'] : 'pixels';

// Text instead of question hint
$questions_hint_icon_or_text = (isset($options['questions_hint_icon_or_text']) && $options['questions_hint_icon_or_text'] != '') ? $options['questions_hint_icon_or_text'] : 'default';
$questions_hint_value = (isset($options['questions_hint_value']) && $options['questions_hint_value'] != '') ? stripslashes(esc_attr($options['questions_hint_value'])) : '';

// Generated password
$ays_passwords_quiz = (isset($options['generate_password']) && $options['generate_password'] != '') ? $options['generate_password'] : 'general';
$generated_passwords = (isset($options['generated_passwords']) && $options['generated_passwords'] != '') ? $options['generated_passwords'] : array();
if(!empty($generated_passwords)){
    $created_passwords = (isset( $generated_passwords['created_passwords']) && !empty( $generated_passwords['created_passwords'])) ?  $generated_passwords['created_passwords'] : array();
    $active_passwords = (isset( $generated_passwords['active_passwords']) && !empty( $generated_passwords['active_passwords'])) ?  $generated_passwords['active_passwords'] : array();
    $used_passwords = (isset( $generated_passwords['used_passwords']) && !empty( $generated_passwords['used_passwords'])) ?  $generated_passwords['used_passwords'] : array();
}

// Display score by
$display_score_by = (isset($options['display_score_by']) && $options['display_score_by'] != '') ? $options['display_score_by'] : 'by_percentage';

// Show schedule timer
$options['show_schedule_timer'] = isset($options['show_schedule_timer']) ? $options['show_schedule_timer'] : 'off';
$schedule_show_timer = (isset($options['show_schedule_timer']) && $options['show_schedule_timer'] == 'on') ? true : false;
$show_timer_type = isset($options['show_timer_type']) && $options['show_timer_type'] != '' ? $options['show_timer_type'] : 'countdown';


$keyword_arr = array();
$char_min_val = 'A';
$char_max_val = 'F';
for($x = $char_min_val; $x <= $char_max_val; $x++){
    $keyword_arr[] = $x;
}

// Enable Finish Button Comfirm Box
$options['enable_early_finsh_comfirm_box'] = isset($options['enable_early_finsh_comfirm_box']) ? $options['enable_early_finsh_comfirm_box'] : 'on';
$enable_early_finsh_comfirm_box = (isset($options['enable_early_finsh_comfirm_box']) && $options['enable_early_finsh_comfirm_box'] == "on") ? true : false;

// Enable Negative Mark
//$options['enable_negative_mark'] = isset($options['enable_negative_mark']) ? $options['enable_negative_mark'] : 'off';
//$enable_negative_mark = (isset($options['enable_negative_mark']) && $options['enable_negative_mark'] == 'on') ? true : false;

// Negative Mark Point
//$negative_mark_point = (isset($options['negative_mark_point']) && $options['negative_mark_point'] != '') ? abs($options['negative_mark_point']) : 0;

// Progress live bar style
$progress_live_bar_style = (isset($options['progress_live_bar_style']) && $options['progress_live_bar_style'] != "") ? $options['progress_live_bar_style'] : 'default';

// Show all questions result in finish page
$options['enable_questions_result'] = isset($options['enable_questions_result']) ? $options['enable_questions_result'] : 'off';
$enable_questions_result = (isset($options['enable_questions_result']) && $options['enable_questions_result'] == 'on') ? true : false;

// Hide correct answers
$options['hide_correct_answers'] = isset($options['hide_correct_answers']) ? $options['hide_correct_answers'] : 'off';
$hide_correct_answers = (isset($options['hide_correct_answers']) && $options['hide_correct_answers'] == 'on') ? true : false;

// Quiz loader text value
$quiz_loader_text_value = (isset($options['quiz_loader_text_value']) && $options['quiz_loader_text_value'] != '') ? stripslashes(esc_attr($options['quiz_loader_text_value'])) : '';

// Show information form to logged in users
$options['show_information_form'] = isset($options['show_information_form']) ? $options['show_information_form'] : 'on';
$show_information_form = (isset($options['show_information_form']) && $options['show_information_form'] == 'on') ? true : false;

// Show questions explanation on
$show_questions_explanation = (isset($options['show_questions_explanation']) && $options['show_questions_explanation'] != '') ? $options['show_questions_explanation'] : 'on_results_page';
