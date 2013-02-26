<?php
/*
 * IMPORTANT - PLEASE READ **************************************************************************
 * All the mechanics to control this plugin are automatically generated from the extension name.	*
 * You do not need to modify this page, unless you wish to add additional customisable parameters	*
 * for the extension. Removing/changing any of the pre defined functions will cause import errors,	*
 * and possible other unexpected or unwanted behaviour.												*
 * For information on bebop_tables:: functions, please see bebop/core/bebop-tables.php				*
 * **************************************************************************************************
 */
/*
 * '$extension' controls content on this page and is set to whatever admin-settings.php file is being viewed.
 * i.e. if you extension name is 'my_extension', the value of $extension will be 'my_extension'.
 *  Make sure the extension name is in lower case.
 */
$extension = bebop_extensions::bebop_get_extension_config_by_name( strtolower( $extension ) );

//Include the admin menu.
include_once( WP_PLUGIN_DIR . '/bebop/core/templates/admin/bebop-admin-menu.php' ); ?>
<div id='bebop_admin_container'>
	<div class="postbox center_margin margin-bottom_22px bebop_provider_helper hidden">
		<h3><?php echo sprintf( __( '%1$s Settings', 'bebop' ), $extension['display_name'] ); ?> API Setup</h3>
		<div class="inside">
			<?php echo sprintf( __( '%1$s Settings', 'bebop' ), $extension['display_name'] ); ?> Requires an application to be setup in order to obtain the required API token/secret. Follow these steps:
			<ol>
				<li>Go to the <a target="_blank" href="http://www.flickr.com/services/">Flickr services page</a>. Click <b>Create an app</b>.</li>
				<li>Click <b>Request an API Key</b>. Choose whether you want a commercial or non-commercial key.</li>
				<li>Complete and submit the form as instructed.</li>
				<li>Copy the <b>Key</b> into the <b>Flickr API Token</b> field on this page.</li>
				<li>Click <b>Save Changes</b> and then test by adding a user on the front end. For more help, visit the <a target="_blank" href="http://wordpress.org/support/plugin/bebop">support forum.</a></li>
			</ol>
		</div>
	</div>
	<form class='bebop_admin_form' method='post'>
		<fieldset>
			<span class='header'><?php echo sprintf( __( '%1$s Import Settings', 'bebop' ), $extension['display_name'] );?></span>
			<label for='bebop_<?php echo $extension['name']; ?>_consumer_key'><?php echo sprintf( __( '%1$s API Token', 'bebop' ), $extension['display_name'] );?>:</label>
			<input type='text' id='bebop_<?php echo $extension['name']; ?>_consumer_key' name='bebop_<?php echo $extension['name']; ?>_consumer_key' value='<?php echo bebop_tables::get_option_value( 'bebop_' . $extension['name'] . '_consumer_key' ); ?>' size='50'>			
			<a href="#" class="button-primary bebop_provider_helper_trigger">API Token/Secret help</a><br><br>
			
			<?php $should_users_verify_content = bebop_tables::get_option_value( 'bebop_' . $extension['name'] . '_content_user_verification' ); ?>
			<label for='bebop_<?php echo $extension['name']; ?>_content_user_verification'><?php _e( 'Should imported content be user verified?', 'bebop' ); ?></label>
			<select id='bebop_<?php echo $extension['name']; ?>_content_user_verification' name='bebop_<?php echo $extension['name']; ?>_content_user_verification'>
				<option value='yes'<?php if ( $should_users_verify_content === 'yes' ) { echo 'SELECTED'; } ?>><?php _e( 'Yes', 'bebop' ); ?></option>
				<option value='no'<?php if ( $should_users_verify_content === 'no' ) { echo 'SELECTED'; } ?>><?php _e( 'No', 'bebop' ); ?></option>
			</select>
			<br><br>
			
			<?php $bebop_hide_sitewide = bebop_tables::get_option_value( 'bebop_' . $extension['name'] . '_hide_sitewide' ); ?>
			<label for='bebop_<?php echo $extension['name']; ?>_hide_sitewide'><?php _e( 'Hide content on the sitewide activity stream?', 'bebop' ); ?></label>
			<select id='bebop_<?php echo $extension['name']; ?>_hide_sitewide' name='bebop_<?php echo $extension['name']; ?>_hide_sitewide'>
				<option value='no'<?php if ( $bebop_hide_sitewide === 'no' ) { echo 'SELECTED'; } ?>><?php _e( 'No', 'bebop' ); ?></option>
				<option value='yes'<?php if ( $bebop_hide_sitewide === 'yes' ) { echo 'SELECTED'; } ?>><?php _e( 'Yes', 'bebop' ); ?></option>
			</select>
			<br><br>
			
			<label for='bebop_<?php echo $extension['name']; ?>_maximport'><?php _e( 'Imports per day (blank = unlimited)', 'bebop') ?>:</label>
			<input type='text' id='bebop_<?php echo $extension['name']; ?>_maximport' name='bebop_<?php echo $extension['name']; ?>_maximport' value='<?php echo bebop_tables::get_option_value( 'bebop_' . $extension['name'] . '_maximport' ); ?>' size='5'><br>
		</fieldset>
		
		<fieldset>
			<span class='header'><?php echo sprintf( __( '%1$s RSS Settings', 'bebop' ), $extension['display_name'] );?></span>
			<?php
			if ( bebop_tables::get_option_value( 'bebop_' . $extension['name'] . '_provider' ) == 'on' ) {
				echo "<label for='bebop_" . $extension['name'] . "_rss_feed'>" . __( 'RSS Enabled', 'bebop' ) . ":</label><input id='bebop_" .$extension['name'] . "_rss_feed' name='bebop_".$extension['name'] . "_rss_feed' type='checkbox'";
				if ( bebop_tables::get_option_value( 'bebop_' . $extension['name'] . '_rss_feed' ) == 'on' ) {
					echo 'CHECKED';
				}
				echo '><br>';
			}
			else {
				echo '<p>' . sprintf( __( 'RSS feeds cannot be enabled because %1$s is not an active extension.', 'bebop' ), $extension['display_name'] ) . '</p>';
			}
			?>
		</fieldset>
		
		<?php wp_nonce_field( 'bebop_' . $extension['name'] . '_admin_settings' ); ?>
		
		<input class='button-primary' type='submit' id='submit' name='submit' value='<?php _e( 'Save Changes', 'bebop' ); ?>'>
		
	</form>
	
	<?php
	$user_metas = bebop_tables::get_user_ids_from_meta_name( 'bebop_' . $extension['name'] . '_active_for_user' );
	if ( count( $user_metas ) > 0 ) {
		?>
		
		<table class="widefat margin-top_22px margin-bottom_22px">
			<thead>
				<tr>
					<th colspan='5'><?php echo sprintf( __( '%1$s Users', 'bebop' ), $extension['display_name'] ); ?></th>
				</tr>
				<tr>
					<td class='bold'><?php _e( 'User ID', 'bebop' ); ?></td>
					<td class='bold'><?php _e( 'Username', 'bebop' ); ?></td>
					<td class='bold'><?php _e( 'User email', 'bebop' ); ?></td>
					<td class='bold'><?php echo sprintf( __( '%1$s name(s)', 'bebop' ), $extension['display_name'] ); ?></td>
					<td class='bold'><?php _e( 'Options', 'bebop' ); ?></td>
				</tr>
			</thead>
			<?php if ( count( $user_metas ) >= 10 ) { ?>
			<tfoot>
				<tr>
					<td class='bold'><?php _e( 'User ID', 'bebop' ); ?></td>
					<td class='bold'><?php _e( 'Username', 'bebop' ); ?></td>
					<td class='bold'><?php _e( 'User email', 'bebop' ); ?></td>
					<td class='bold'><?php echo sprintf( __( '%1$s name(s)', 'bebop' ), $extension['display_name'] ); ?></td>
					<td class='bold'><?php _e( 'Options', 'bebop' ); ?></td>
				</tr>
			</tfoot>
			<?php } ?>
			<tbody>
				<?php
				/*
				 * Loops through each user and prints their details to the screen.
				 */
				foreach ( $user_metas as $user ) {
					$this_user = get_userdata( $user->user_id );
					$user_feeds = bebop_tables::get_user_feeds( $user->user_id , $extension['name'] );
					$feed_array = array();
					foreach ( $user_feeds as $user_feed ) {
						$feed_array[] = $user_feed->meta_value;
					}
					$user_feeds = implode( ',', $feed_array );
					echo '<tr>
						<td>' . bebop_tables::sanitise_element( $user->user_id ) . '</td>
						<td>' . bebop_tables::sanitise_element( $this_user->user_login ) . '</td>
						<td>' . bebop_tables::sanitise_element( $this_user->user_email ) . '</td>
						<td>' . bebop_tables::sanitise_element( $user_feeds ) . "</td>
						<td><a href='?page=bebop_providers&provider=" . $extension['name'] . "&reset_user_id=" . bebop_tables::sanitise_element( $user->user_id ) . "'>" . __( 'Reset User', 'bebop' ) . "</a></td>
					</tr>";
				}
			?>
			<!-- <End bebop_table -->
			</tbody>
		</table>
		<?php
	}
	else {
		echo sprintf( __( 'No users found for the %1$s extension.', 'bebop' ), $extension['display_name'] );
	}
	?>
<!-- End bebop_admin_container -->
</div>
