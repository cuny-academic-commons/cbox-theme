
<form action="" method="post" id="notifications-bulk-management">
	<table class="notifications">
		<thead>
			<tr>
				<th class="icon"></th>
				<th class="bulk-select-all"><input id="select-all-notifications" type="checkbox"><label class="bp-screen-reader-text" for="select-all-notifications"><?php
					/* translators: accessibility text */
					_e( 'Select all', 'buddypress' );
				?></label></th>
				<th class="title"><?php _e( 'Notification', 'buddypress' ); ?></th>
				<th class="date"><?php _e( 'Date Received', 'buddypress' ); ?></th>
				<th class="actions"><?php _e( 'Actions',    'buddypress' ); ?></th>
			</tr>
		</thead>

		<tbody>

			<?php while ( bp_the_notifications() ) : bp_the_notification(); ?>

				<tr>
					<td></td>
					<td class="bulk-select-check"><label for="<?php bp_the_notification_id(); ?>"><input id="<?php bp_the_notification_id(); ?>" type="checkbox" name="notifications[]" value="<?php bp_the_notification_id(); ?>" class="notification-check"><span class="bp-screen-reader-text"><?php
						/* translators: accessibility text */
						_e( 'Select this notification', 'buddypress' );
					?></span></label></td>
					<td class="notification-description"><?php bp_the_notification_description();  ?></td>
					<td class="notification-since"><?php bp_the_notification_time_since();   ?></td>
					<td class="notification-actions"><?php bp_the_notification_action_links(); ?></td>
				</tr>

			<?php endwhile; ?>

		</tbody>
	</table>

	<div class="notifications-options-nav">
		<?php bp_notifications_bulk_management_dropdown(); ?>
	</div><!-- .notifications-options-nav -->

	<?php wp_nonce_field( 'notifications_bulk_nonce', 'notifications_bulk_nonce' ); ?>
</form>

<script>
jQuery(function($){
	/* Selecting/Deselecting all notifications */
	$('#select-all-notifications').click(function(e) {
		if( this.checked ) {
			$('.notification-check').each(function() {
				this.checked = true;
			});
		} else {
			$('.notification-check').each(function() {
				this.checked = false;
			});
		}
	});

	/* Make sure a 'Bulk Action' is selected before submitting the form */
	$('#notification-bulk-manage').attr('disabled', 'disabled');

	/* Remove the disabled attribute from the form submit button when bulk action has a value */
	$('#notification-select').on('change', function(){
		$('#notification-bulk-manage').attr('disabled', $(this).val().length <= 0);
	});
});
</script>
