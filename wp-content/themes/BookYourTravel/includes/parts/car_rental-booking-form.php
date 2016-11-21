<?php global $car_rental_obj, $bookyourtravel_theme_globals, $current_user, $booking_form_fields, $enable_extra_items, $bookyourtravel_theme_of_custom;$enc_key = $bookyourtravel_theme_globals->get_enc_key();$add_captcha_to_forms = $bookyourtravel_theme_globals->add_captcha_to_forms();$price_decimal_places = $bookyourtravel_theme_globals->get_price_decimal_places();$default_currency_symbol = $bookyourtravel_theme_globals->get_default_currency_symbol();$show_currency_symbol_after = $bookyourtravel_theme_globals->show_currency_symbol_after();$c_val_1_cr = mt_rand(1, 20);$c_val_2_cr = mt_rand(1, 20);$c_val_1_cr_str = BookYourTravel_Theme_Utils::encrypt($c_val_1_cr, $enc_key);$c_val_2_cr_str = BookYourTravel_Theme_Utils::encrypt($c_val_2_cr, $enc_key);if (!isset($current_user))	$current_user = wp_get_current_user();$booking_form_fields = $bookyourtravel_theme_globals->get_booking_form_fields();?>	<script>		window.currencySymbol = <?php echo json_encode($default_currency_symbol); ?>;		window.currencySymbolShowAfter = <?php echo json_encode($show_currency_symbol_after); ?>;		window.priceDecimalPlaces = <?php echo json_encode($price_decimal_places); ?>;		window.bookingFormDatesError = <?php echo json_encode(esc_html__('Please select booking dates', 'bookyourtravel')); ?>;				window.bookingFormRequiredError = <?php echo json_encode(esc_html__('This is a required field', 'bookyourtravel')); ?>;		window.bookingFormEmailError = <?php echo json_encode(esc_html__('You have not entered a valid email', 'bookyourtravel')); ?>;		window.bookingFormFields = <?php echo json_encode($booking_form_fields)?>;		window.bookingFormDateFromError = <?php echo json_encode(esc_html__('Please select a date from', 'bookyourtravel')); ?>;			window.bookingFormDateToError = <?php echo json_encode(esc_html__('Please select a date to', 'bookyourtravel')); ?>;			window.InvalidCaptchaMessage = <?php echo json_encode(esc_html__('Invalid captcha, please try again!', 'bookyourtravel')); ?>;			window.bookingFormDropOffError = <?php echo json_encode(esc_html__('Please select a drop-off location!', 'bookyourtravel')); ?>;				</script>	<?php do_action( 'bookyourtravel_show_car_rental_booking_form_before' ); ?><form id="car_rental-booking-form" method="post" action="<?php echo BookYourTravel_Theme_Utils::get_current_page_url(); ?>" class="car_rental-booking-form booking" style="display:none">	<fieldset>		<h3><?php esc_html_e('Booking details', 'bookyourtravel') ?></h3>		<div class="row">			<div class="output one-half">				<p><?php esc_html_e('Car name', 'bookyourtravel') ?>: 					<strong class="booking_form_car_name_p"></strong>				</p>			</div>			<div class="output one-half">				<p><?php esc_html_e('Car type', 'bookyourtravel') ?>: 					<strong class="booking_form_car_type_p"></strong>				</p>			</div>			<div class="output one-half">				<p><?php esc_html_e('Date from', 'bookyourtravel') ?>: 					<strong class="booking_form_date_from_p"></strong>				</p>			</div>			<div class="output one-half">				<p><?php esc_html_e('Date to', 'bookyourtravel') ?>: 					<strong class="booking_form_date_to_p"></strong>				</p>			</div>						<div class="output one-half">				<label><?php esc_html_e('Pick up', 'bookyourtravel') ?></label>				<span class="booking_form_pick_up_from_p"></span>			</div>			<div class="output one-half">				<label><?php esc_html_e('Drop off', 'bookyourtravel') ?></label>				<span class="booking_form_drop_off_p"></span>			</div>						<div class="totals">				<?php if ($enable_extra_items) { ?>				<div class="output full-width">					<p><?php esc_html_e('Reservation total', 'bookyourtravel') ?>: 						<strong class="booking_form_reservation_total_p"></strong>					</p>				</div>				<div class="output full-width">					<p><?php esc_html_e('Extra items total', 'bookyourtravel') ?>: 						<strong class="booking_form_extra_items_total_p"></strong>					</p>				</div>				<?php } ?>				<div class="output full-width">					<p><?php esc_html_e('Total', 'bookyourtravel') ?>: 						<strong class="booking_form_total_p"></strong>					</p>				</div>			</div>			</div>				<h3><?php esc_html_e('Submit booking', 'bookyourtravel') ?></h3>		<div class="error" style="display:none;"><div><p></p></div></div>						<?php 			foreach ($booking_form_fields as $booking_field) { 					$field_type = $booking_field['type'];			$field_hidden = isset($booking_field['hide']) && $booking_field['hide'] == 1 ? true : false;			$field_id = $booking_field['id'];			$field_label = isset($booking_field['label']) ? $booking_field['label'] : '';			$field_label = $bookyourtravel_theme_of_custom->get_translated_dynamic_string($bookyourtravel_theme_of_custom->get_option_id_context('booking_form_fields') . ' ' . $field_label, $field_label);									$field_value = isset($user_info->{$field_id}) ? $user_info->{$field_id} : '';			if (empty($field_value)) {				$field_value = isset($user_info->{'billing_' . $field_id}) ? $user_info->{'billing_' . $field_id} : '';			}			if (empty($field_value)) { 				if ($field_id == 'zip') {					$field_value = isset($user_info->{'billing_postcode'}) ? $user_info->{'billing_postcode'} : '';				} elseif ($field_id == 'town') {					$field_value = isset($user_info->{'billing_city'}) ? $user_info->{'billing_city'} : '';				} elseif ($field_id == 'address') {					$field_value = isset($user_info->{'billing_address_1'}) ? $user_info->{'billing_address_1'} : '';				}			}						if (!$field_hidden) {				if ($field_type == 'email') { ?>			<div class="row">				<div class="f-item one-half">					<label for="<?php echo esc_attr($field_id) ?>"><?php echo esc_html($field_label); ?></label>					<input value="<?php echo esc_attr($field_value); ?>" <?php echo isset($booking_field['required']) && $booking_field['required'] == '1' ? 'data-required' : ''; ?> type="email" id="<?php echo esc_attr($field_id) ?>" name="<?php echo esc_attr($field_id) ?>" />				</div>			</div>			<?php } else if ($field_type == 'textarea') { ?>			<div class="row">				<div class="f-item full-width">					<label><?php echo esc_html($field_label); ?></label>					<textarea <?php echo isset($booking_field['required']) && $booking_field['required'] == '1' ? 'data-required' : ''; ?> name='<?php echo esc_attr($field_id) ?>' id='<?php echo esc_attr($field_id) ?>' rows="10" cols="10" ><?php echo esc_html($field_value); ?></textarea>				</div>				</div>			<?php } else { ?>			<div class="row">				<div class="f-item one-half">					<label for="<?php echo esc_attr($field_id) ?>"><?php echo esc_html($field_label); ?></label>					<input value="<?php echo esc_attr($field_value); ?>" <?php echo isset($booking_field['required']) && $booking_field['required'] == '1' ? 'data-required' : ''; ?> type="text" name="<?php echo esc_attr($field_id) ?>" id="<?php echo esc_attr($field_id) ?>" />				</div>			</div>			<?php 					}			}		}		?>									<?php if ($add_captcha_to_forms) { ?>		<div class="row captcha">			<div class="f-item full-width">				<label><?php echo sprintf(esc_html__('How much is %d + %d', 'bookyourtravel'), $c_val_1_cr, $c_val_2_cr) ?>?</label>				<input type="text" required="required" id="c_val_s_cr" name="c_val_s_cr" />				<input type="hidden" name="c_val_1_cr" id="c_val_1_cr" value="<?php echo esc_attr($c_val_1_cr_str); ?>" />				<input type="hidden" name="c_val_2_cr" id="c_val_2_cr" value="<?php echo esc_attr($c_val_2_cr_str); ?>" />			</div>		</div>		<?php } ?>		<input type="hidden" name="car_rental_id" id="car_rental_id" />		<div class="booking-commands">			<?php BookYourTravel_Theme_Utils::render_link_button("#", "gradient-button cancel-car_rental-booking", "cancel-car_rental-booking", esc_html__('Go Back', 'bookyourtravel')); ?>			<?php BookYourTravel_Theme_Utils::render_submit_button("gradient-button", "submit-car_rental-booking", esc_html__('Submit booking', 'bookyourtravel')); ?>		</div>	</fieldset></form>	<div class="loading" id="wait_loading" style="display:none">		<div class="ball"></div>		<div class="ball1"></div>	</div><?php do_action( 'bookyourtravel_show_car_rental_booking_form_after' );