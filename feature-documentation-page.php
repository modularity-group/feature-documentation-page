<?php

add_action('admin_menu',function(){
  add_submenu_page(
    'modularity',
    __('Documentation Page','modularity'),
    __('Documentation Page','modularity'),
    'manage_options',
    'documentation-page-settings', // page slug
    'feature_documentation_page_settings'
  );
});

function feature_documentation_page_settings(){

	echo '<div class="wrap">
	<h1>'.__('Documentation Page - Settings','modularity').'</h1>
	<form method="post" action="options.php">';

		settings_fields( 'documentations-page-settings__settings' ); // settings group name
		do_settings_sections( 'documentation-page-settings' ); // just a page slug
		submit_button();

	echo '</form></div>';

}

add_action( 'admin_init',  function(){

	register_setting(
		'documentations-page-settings__settings', // settings group name
		'feature_documentation_page__content', // option name
		'feature_documentation_page__sanitizecontent' // sanitization function
	);

	add_settings_section(
		'settings_section_main', // section ID
		'', // title (if needed)
		'', // callback function (if needed)
		'documentation-page-settings' // page slug
	);

	add_settings_field(
		'feature_documentation_page__content',
		'Content',
		'feature_documentation_page__content__fieldhtml', // function which prints the field
		'documentation-page-settings', // page slug
		'settings_section_main', // section ID
		array(
			'label_for' => 'feature_documentation_page__content',
			'class' => 'feature-documentation-page__content', // for <tr> element
		)
	);

} );

function feature_documentation_page__sanitizecontent($content){
  $content = wp_kses_post($content);
  return $content;
}

function feature_documentation_page__content__fieldhtml(){
	$content = get_option( 'feature_documentation_page__content' );
  wp_editor(
    $content,
    'feature_documentation_page__content',
    $settings = array(
      'media_buttons' => false,
      'drag_drop_upload' => false,
      'textarea_rows' => '25',
      'wpautop' => false
      )
  );
	/*printf(
		'<input type="text" id="feature_documentation_page__content" name="feature_documentation_page__content" value="%s" />',
		esc_attr( $text )
	);*/
}

add_action('admin_menu',function(){
  if(get_option( 'feature_documentation_page__content' )){
    add_submenu_page(
      'index.php',
      'Dokumentation',
      'Dokumentation',
      'edit_pages',
      'documentation-page',
      'feature_documentation_page'
    );
  }
});

function feature_documentation_page(){
  ?>
  <style>
    .wrap ul {
      list-style-type: disc;
      list-style-position: inside;
    }

    .wrap ol {
      list-style-type: decimal;
      list-style-position: inside;
      margin-left: 0 !important;
    }

    .wrap ul ul,
    .wrap ol ol {
      margin-left: 1em !important;
    }
  </style>
  <?php
  $content = get_option( 'feature_documentation_page__content' );
  echo '<div class="wrap"><h1>Dokumentation</h1>'.html_entity_decode($content).'</div>';
}

// https://rudrastyh.com/wordpress/creating-options-pages.html
