<?php

/**
 * BuddyPress Member Settings
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

	<div id="content" role="main" class="<?php do_action( 'content_class' ); ?>">
		<div class="padder">

			<?php do_action( 'bp_before_member_settings_template' ); ?>

			<div id="item-header">

				<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>

						<?php bp_get_displayed_user_nav(); ?>

						<?php do_action( 'bp_member_options_nav' ); ?>

					</ul>
				</div>
			</div><!-- #item-nav -->

			<div id="item-body" role="main">

				<?php do_action( 'bp_before_member_body' ); ?>

				<div class="item-list-tabs no-ajax" id="subnav">
					<ul>

						<?php bp_get_options_nav(); ?>

						<?php do_action( 'bp_member_plugin_options_nav' ); ?>

					</ul>
				</div><!-- .item-list-tabs -->

				<h3><?php _e( 'General Settings', 'buddypress' ); ?></h3>

				<?php do_action( 'bp_template_content' ); ?>

				<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>" method="post" class="standard-form" id="settings-form">

					<label for="email"><?php _e( 'Account Email', 'buddypress' ); ?></label>
					<input type="text" name="email" id="email" value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input" />

					<h3>Password</h3>

					<?php if ( ! is_super_admin() ) : ?>

						<label for="pwd"><?php _e( 'Current Password <span>(required to update email or change current password)</span>', 'buddypress' ); ?></label>
						<input type="password" name="pwd" id="pwd" size="16" value="" class="settings-input small" /> &nbsp;<a href="<?php echo wp_lostpassword_url(); ?>" title="<?php _e( 'Password Lost and Found', 'buddypress' ); ?>"><?php _e( 'Lost your password?', 'buddypress' ); ?></a>

					<?php endif; ?>

					<p class="text"><?php esc_html_e( 'Click on the "Generate Password" button to change your password.', 'buddypress' ); ?></p>

					<div class="user-pass1-wrap">
						<button type="button" class="button wp-generate-pw ignore-color">
							<?php esc_html_e( 'Generate Password', 'buddypress' ); ?>
						</button>

						<div class="wp-pwd">
							<label for="pass1"><?php esc_html_e( 'Add Your New Password', 'buddypress' ); ?></label>
							<span class="password-input-wrapper">
								<input type="password" name="pass1" id="pass1" size="24" class="settings-input small password-entry" value="" <?php bp_form_field_attributes( 'password', array( 'data-pw' => wp_generate_password( 24 ), 'aria-describedby' => 'pass-strength-result' ) ); ?> />
							</span>
							<button type="button" class="button wp-hide-pw ignore-color" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password', 'buddypress' ); ?>">
								<span class="dashicons dashicons-hidden" aria-hidden="true"></span>
								<span class="text bp-screen-reader-text"><?php esc_html_e( 'Hide', 'buddypress' ); ?></span>
							</button>
							<button type="button" class="button wp-cancel-pw ignore-color" data-toggle="0" aria-label="<?php esc_attr_e( 'Cancel password change', 'buddypress' ); ?>">
								<span class="text"><?php esc_html_e( 'Cancel', 'buddypress' ); ?></span>
							</button>
							<div id="pass-strength-result" aria-live="polite"></div>
						</div>
					</div>

					<div class="user-pass2-wrap">
						<label class="label" for="pass2"><?php esc_html_e( 'Repeat Your New Password', 'buddypress' ); ?></label>
						<input name="pass2" type="password" id="pass2" size="24" class="settings-input small password-entry-confirm" value="" <?php bp_form_field_attributes( 'password' ); ?> />
					</div>

					<div class="pw-weak">
						<label>
							<input type="checkbox" name="pw_weak" class="pw-checkbox" />
							<span id="pw-weak-text-label"><?php esc_html_e( 'Confirm use of potentially weak password', 'buddypress' ); ?></span>
						</label>
					</div>

					<?php do_action( 'bp_core_general_settings_before_submit' ); ?>

					<div class="submit">
						<input type="submit" name="submit" value="<?php _e( 'Save Changes', 'buddypress' ); ?>" id="submit" class="auto" />
					</div>

					<?php do_action( 'bp_core_general_settings_after_submit' ); ?>

					<?php wp_nonce_field( 'bp_settings_general' ); ?>

				</form>

				<?php do_action( 'bp_after_member_body' ); ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_settings_template' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_sidebar( 'buddypress' ); ?>

<?php get_footer( 'buddypress' ); ?>