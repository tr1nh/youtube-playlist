
<?php
add_action( 'admin_menu', 'share4happy_add_admin_menu' );
add_action( 'admin_init', 'share4happy_settings_init' );


function share4happy_add_admin_menu(  ) { 

	add_menu_page( 'Youtube Playlist', 'Youtube Playlist', 'manage_options', 'youtube_playlist', 'share4happy_options_page' );

}


function share4happy_settings_init(  ) { 

	register_setting( 'pluginPage', 'share4happy_settings' );

	add_settings_section(
		'share4happy_pluginPage_section', 
		__( 'Your section description', 'share4happy-youtube' ), 
		'share4happy_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'share4happy_textarea_field_0', 
		__( 'Settings field description', 'share4happy-youtube' ), 
		'share4happy_textarea_field_0_render', 
		'pluginPage', 
		'share4happy_pluginPage_section' 
	);


}


function share4happy_textarea_field_0_render(  ) { 

	$options = get_option( 'share4happy_settings' );
	?>
	<textarea cols='40' rows='5' name='share4happy_settings[share4happy_textarea_field_0]'> 
		<?php echo $options['share4happy_textarea_field_0']; ?>
 	</textarea>
	<?php

}


function share4happy_settings_section_callback(  ) { 

	echo __( 'This section description', 'share4happy-youtube' );

}


function share4happy_options_page(  ) { 

		?>
      <h1>Youtube Playlist</h1>
    <div class="card">

			<?php
			// settings_fields( 'pluginPage' );
			// do_settings_sections( 'pluginPage' );
			// submit_button();
			?>

      <h2>Instructions</h2>
      <p>Share4Happy Youtube Playlist is a simple plugin for get all video in a Youtube playlist and embered in Wordpress via shortcode.</p>
      <p>You can use shortcode <code>[share4happy-youtube-playlist]</code> in post, widget or PHP code.</p>
      <p>You also have to provide a Youtube API key and playlist id, look like this: <code>[share4happy-youtube-playlist api_key=&quot;your api key&quot; playlist_id=&quot;playlist id&quot;]</code></p>
      <p>source code is available on Github: <a href="https://github.com/tr1nh/youtube-playlist">https://github.com/tr1nh/youtube-playlist</a></p>
    </div>

		<?php
}
