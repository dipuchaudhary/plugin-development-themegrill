<?php
/** 
* plugin name: dipu-plugin
* plugin URI: www.dipuchaudhary.com.np/plugin
* description: This is my first attempt to writing wordpress plugin
* version: 1.0.0
* Author: Dipu Chaudhary
* Author URI: dipuchaudhary.com.np
* License: GPLV2 or later
* Text Domain: dipu-plugin
*/

defined ( 'ABSPATH') or die('hey you silly man!, What are you trying to do?');

class dipuPlugin {

    public function __construct(){
        add_action('admin_menu', array($this,'custom_menu_pages'));
        add_action('admin_notices',array($this,'plugin_active_msg'));
        add_action('init',array($this,'custom_post_type'));
        add_action('admin_init',array($this,'update_description'));
        add_filter('description_update',array($this,'custom_email_description'));
        add_shortcode('my_shortcode',array($this,'dipu_shortcode'));
        add_action('admin_init',array($this,'custom_settings'));
        
    }

   public function custom_menu_pages(){
        add_menu_page('test email','Test Email','manage_options','email_slug',array($this,'testemail'));
        add_submenu_page('email_slug','send email','Send Email','manage_options','send_email_slug',array($this,'sendemail'));
        add_submenu_page('email_slug','Setting api','Custom Setting Api','manage_options','custom_setting_api',array($this,'custom_setting_page'));
        
    }
    
    public function activate() {
        $this->custom_post_type();
        flush_rewrite_rules();
    }
    public function deactivate() {
        flush_rewrite_rules();
    }

    public function custom_post_type() {
        register_post_type('book',['public'=> true,'label'=>'Books']);
    }

    public function plugin_active_msg(){
        echo '<div class="notice notice-success is-dismissible"><p>Dipu Plugin is now activated</p></div>';
    }

    public function testemail() {
        echo "<h1>Test Email</h1>";
    }

    public function sendemail() {
        echo '
        <form action="" method="post">
        <div class="mb-3">
            <label for="subject" class="form-label">Email Subject</label>
            <input type="text" name="subject" class="form-control" placeholder="Email Subject">
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Description</label>
            <textarea class="form-control" name="description"cols="30" rows="5" placeholder="description"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Send To</button>
      </form>
        ';
    }

    public function update_description(){
        
        if( isset ($_POST['submit'] ) ) {
            $desc = apply_filters('description_update',$_POST['description']);
            echo '<div class="container"><div class="notice is-dismissable"><p class="text-center">'.$desc.'</p></div></div>';
        
        }
    }

    public function custom_email_description($content) {
        $content .= 'is modified';
        return $content;
    }

    public function dipu_shortcode() {
        ob_start();
        include_once 'templates/custom-register.php';
        return ob_get_clean();
       
    }

    // setting api
    public function custom_setting_page() {
        require_once "templates/custom-settings.php";
        
    }

    public function custom_settings() {
        register_setting('custom-setting-group','setting_options');
        add_settings_section('custom-setting-section','Custom Setting Option',array($this,'manage_setting_option'),'email_slug');
        add_settings_field('fname','First Name',array($this,'setting_first_name'),'email_slug','custom-setting-section');
        add_settings_field('lname','Last Name',array($this,'setting_last_name'),'email_slug','custom-setting-section');
        add_settings_field('textarea','TextArea',array($this,'setting_textarea'),'email_slug','custom-setting-section');
        add_settings_field('checkbox','Checkbox',array($this,'setting_checkbox'),'email_slug','custom-setting-section');
        add_settings_field('radio','Radio Button',array($this,'setting_radio'),'email_slug','custom-setting-section');
        add_settings_field('dropdown','Dropdown Button',array($this,'setting_dropdown'),'email_slug','custom-setting-section');
        
    }

    public function manage_setting_option() {
        echo 'customize your settings information';
    }

    public function setting_first_name() {
        $fname = esc_attr( get_option('setting_options') );
        echo "<input type='text' name='setting_options['fname']' placeholder='First Name' value=''/>";
    }

    public function setting_last_name() {
        $lname = esc_attr( get_option('setting_options') );
        echo "<input type='text' name='setting_options['lname']' placeholder='Last Name' value=''/>";
    }

    public function setting_textarea(){
        echo "<textarea name='setting_options['textarea']' cols='30' rows='5' placeholder='TextArea'></textarea>";
    }

    public function setting_checkbox(){
        $chk = get_option('setting_options');
        $items = array("PHP","python","java");
        foreach($items as $item){
	   if($chk['chkbox1']) { $checked = ' checked="checked" '; }
	   echo "<label><input type='checkbox' ".$checked." id='plugin_chk1' value='$item' name='setting_options['chkbox1']>$item</label> <br>";
        }
    }

    public function setting_radio(){
        $rd = get_option('setting_options');
	    $items = array("wordpress", "Laravel", "CodeIgniter");
	foreach($items as $item) {
		// $checked = ($rd['radio1']==$item) ? ' checked="checked" ' : '';
		echo "<label><input ".$checked." value='$item' name='plugin_options[radio1]' type='radio' /> $item</label><br />";
	 }
        
    }

    public function setting_dropdown() {
        $options = get_option('plugin_options');
	$items = array("Red", "Green", "Blue", "Orange", "White", "Violet", "Yellow");
	echo "<select id='drop_down1' name='plugin_options[dropdown1]'>";
	foreach($items as $item) {
		$selected = ($options['dropdown1']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
    }


}

if ( class_exists ('dipuPlugin') ){
    $dipuplugin = new dipuPlugin();
}

register_activation_hook(__FILE__,array($dipuplugin,'activate'));

register_deactivation_hook(__FILE__,array($dipuplugin,'deactivate'));