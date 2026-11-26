<?php
/**
 * Contact form & location section.
 *
 * Expects $contactErrors, $contactData, $contactSent, $contactDeliveryFailed
 * and $contactServices from includes/contact-handler.php.
 */
?>
<section class="contact-three" style="padding: 76px 0 48px; background: #f8faf8; font-weight: 600;">
	<div class="auto-container">
		<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; align-items: stretch; width: 100%;">

			<!-- Left Column: Editorial Info & Direct Channels -->
			<div class="contact-three_title-column" style="min-width: 0;">
				<div style="height: 100%; display: flex; flex-direction: column; justify-content: space-between; padding: 36px 32px; border-radius: 20px; background: linear-gradient(155deg, #063f39 0%, #0a5848 100%); color: #ffffff; box-shadow: 0 18px 44px rgba(6, 63, 57, 0.14);">
					<div>
						<div style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 12px; margin-bottom: 18px; border-radius: 999px; background: rgba(169, 232, 117, 0.14); border: 1px solid rgba(169, 232, 117, 0.3); color: #a9e875; font-size: 11px; font-weight: 600; letter-spacing: 0.14em; text-transform: uppercase;">
							<span style="width: 7px; height: 7px; border-radius: 50%; background: #a9e875;"></span>
							Contact Us
						</div>

						<h2 class="sec-title_heading" style="margin: 0 0 14px; color: #ffffff; font-size: clamp(28px, 3.2vw, 38px); font-weight: 600; line-height: 1.18;">
							Have a Question or a Correction?
						</h2>

						<p style="margin: 0 0 28px; color: #d8ebe0; font-size: 15px; font-weight: 600; line-height: 1.75;">
							Send a message about an article, a correction, a project inquiry, or a software engineering topic you would like covered.
						</p>

						<ul class="contact-three_list" style="list-style: none; margin: 0; padding: 0; display: grid; gap: 16px;">
							<li style="display: flex; align-items: flex-start; gap: 14px; padding: 16px; border-radius: 14px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.1);">
								<span style="width: 40px; height: 40px; flex: 0 0 40px; display: grid; place-items: center; border-radius: 10px; background: #a9e875; color: #063f39;">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<rect x="2" y="4" width="20" height="16" rx="2"></rect>
										<path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
									</svg>
								</span>
								<div style="min-width: 0;">
									<div style="font-size: 12px; font-weight: 600; color: #b9d7c6; margin-bottom: 3px; text-transform: uppercase; letter-spacing: 0.08em;">Email the Editors</div>
									<strong style="font-size: 15px; font-weight: 600; word-break: break-word;">
										<a href="mailto:<?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?>" style="color: #ffffff; font-weight: 600; text-decoration: none;">
											<?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?>
										</a>
									</strong>
								</div>
							</li>

							<li style="display: flex; align-items: flex-start; gap: 14px; padding: 16px; border-radius: 14px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.1);">
								<span style="width: 40px; height: 40px; flex: 0 0 40px; display: grid; place-items: center; border-radius: 10px; background: rgba(169, 232, 117, 0.18); color: #a9e875;">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<circle cx="12" cy="12" r="10"></circle>
										<polyline points="12 6 12 12 16 14"></polyline>
									</svg>
								</span>
								<div>
									<div style="font-size: 12px; font-weight: 600; color: #b9d7c6; margin-bottom: 3px; text-transform: uppercase; letter-spacing: 0.08em;">Response Window</div>
									<strong style="font-size: 15px; font-weight: 600; color: #ffffff;">Monday – Saturday, 9:00 AM – 6:00 PM</strong>
								</div>
							</li>
						</ul>
					</div>

					<div style="margin-top: 28px; padding-top: 18px; border-top: 1px solid rgba(255, 255, 255, 0.12); color: #c7e2d3; font-size: 13px; font-weight: 600; line-height: 1.65;">
						Include relevant URLs, error details, or article titles so our team can review and respond accurately.
					</div>
				</div>
			</div>

			<!-- Right Column: Contact Form -->
			<div class="contact-three_form-column" style="min-width: 0;">
				<div class="contact-three_form-outer" style="height: 100%; padding: 38px 36px; border: 1px solid #e0e9e1; border-radius: 20px; background: #ffffff; box-shadow: 0 18px 44px rgba(18, 59, 36, 0.07);">
					<div style="margin-bottom: 26px;">
						<h3 style="margin: 0 0 6px; color: #173b35; font-size: 24px; font-weight: 600; line-height: 1.25;">Send a Message</h3>
						<p style="margin: 0; color: #66766f; font-size: 14px; font-weight: 600;">Fill out the details below and we will get back to you shortly.</p>
					</div>

					<div class="default-form contact-form" style="width: 100%; max-width: none;">
						<?php render_contact_status(); ?>

						<form method="post" action="<?php echo htmlspecialchars(form_action(), ENT_QUOTES, 'UTF-8'); ?>#contact-form" id="contact-form" style="width: 100%; max-width: none;">
							<input type="hidden" name="form_type" value="contact">
							<input type="hidden" name="form_return" value="<?php echo htmlspecialchars(basename(form_action()), ENT_QUOTES, 'UTF-8'); ?>">
							<?php csrf_field(); ?>

							<div style="position:absolute;left:-9999px;" aria-hidden="true">
								<label for="website">Website</label>
								<input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
							</div>

							<!-- Row 1: Full Name + Email Address (2 wide boxes in 1 line) -->
							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; width: 100%; margin-bottom: 18px;">
								<div class="form-group" style="width: 100%; max-width: none; min-width: 0; margin: 0;">
									<label for="contact-username" style="display: block; margin-bottom: 8px; color: #173b35; font-size: 14px; font-weight: 600;">Full Name <span style="color: #e94c3d;">*</span></label>
									<input id="contact-username" type="text" name="username" value="<?php echo old_value($contactData, 'username'); ?>" placeholder="Enter your full name" required style="width: 100% !important; min-width: 100% !important; max-width: none !important; box-sizing: border-box; display: block; min-height: 54px; padding: 13px 16px; border: 1px solid #d5e0d7; border-radius: 12px; background: #fbfdfb; color: #173b35; font-size: 15px; font-weight: 600;">
									<?php field_error($contactErrors, 'username'); ?>
								</div>

								<div class="form-group" style="width: 100%; max-width: none; min-width: 0; margin: 0;">
									<label for="contact-email" style="display: block; margin-bottom: 8px; color: #173b35; font-size: 14px; font-weight: 600;">Email Address <span style="color: #e94c3d;">*</span></label>
									<input id="contact-email" type="email" name="email" value="<?php echo old_value($contactData, 'email'); ?>" placeholder="you@example.com" required style="width: 100% !important; min-width: 100% !important; max-width: none !important; box-sizing: border-box; display: block; min-height: 54px; padding: 13px 16px; border: 1px solid #d5e0d7; border-radius: 12px; background: #fbfdfb; color: #173b35; font-size: 15px; font-weight: 600;">
									<?php field_error($contactErrors, 'email'); ?>
								</div>
							</div>

							<!-- Row 2: Mobile Number + Topic Select (2 wide boxes in 1 line) -->
							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; width: 100%; margin-bottom: 18px;">
								<div class="form-group" style="width: 100%; max-width: none; min-width: 0; margin: 0;">
									<label for="contact-phone" style="display: block; margin-bottom: 8px; color: #173b35; font-size: 14px; font-weight: 600;">Mobile Number</label>
									<input id="contact-phone" type="tel" name="phone" value="<?php echo old_value($contactData, 'phone'); ?>" placeholder="+92 300 0000000" style="width: 100% !important; min-width: 100% !important; max-width: none !important; box-sizing: border-box; display: block; min-height: 54px; padding: 13px 16px; border: 1px solid #d5e0d7; border-radius: 12px; background: #fbfdfb; color: #173b35; font-size: 15px; font-weight: 600;">
									<?php field_error($contactErrors, 'phone'); ?>
								</div>

								<div class="form-group" style="width: 100%; max-width: none; min-width: 0; margin: 0;">
									<label for="contact-topic" style="display: block; margin-bottom: 8px; color: #173b35; font-size: 14px; font-weight: 600;">Topic <span style="color: #e94c3d;">*</span></label>
									<select id="contact-topic" name="topic" required style="width: 100% !important; min-width: 100% !important; max-width: none !important; box-sizing: border-box; display: block; min-height: 54px; padding: 13px 16px; border: 1px solid #d5e0d7; border-radius: 12px; background: #fbfdfb; color: #173b35; font-size: 15px; font-weight: 600;">
										<?php foreach ($contactServices as $service): ?>
										<option value="<?php echo htmlspecialchars($service, ENT_QUOTES, 'UTF-8'); ?>"<?php echo (isset($contactData['topic']) && $contactData['topic'] === $service) ? ' selected' : ''; ?>><?php echo htmlspecialchars($service, ENT_QUOTES, 'UTF-8'); ?></option>
										<?php endforeach; ?>
									</select>
									<?php field_error($contactErrors, 'topic'); ?>
								</div>
							</div>

							<!-- Row 3: Full-Width Message Box -->
							<div class="form-group" style="width: 100%; max-width: none; min-width: 0; margin: 0 0 22px;">
								<label for="contact-message" style="display: block; margin-bottom: 8px; color: #173b35; font-size: 14px; font-weight: 600;">Message <span style="color: #e94c3d;">*</span></label>
								<textarea id="contact-message" name="message" placeholder="Write your question, feedback, or project details..." required style="width: 100% !important; min-width: 100% !important; max-width: none !important; box-sizing: border-box; display: block; min-height: 150px; padding: 14px 16px; border: 1px solid #d5e0d7; border-radius: 12px; background: #fbfdfb; color: #173b35; font-size: 15px; font-weight: 600; resize: vertical;"><?php echo old_value($contactData, 'message'); ?></textarea>
								<?php field_error($contactErrors, 'message'); ?>
							</div>

							<!-- Submit -->
							<div class="form-group" style="width: 100%; margin: 0;">
								<button type="submit" class="theme-btn btn-style-one" style="display: inline-flex; align-items: center; justify-content: center; gap: 10px; min-height: 52px; padding: 0 32px; border: 1px solid #278944; border-radius: 999px; background: #278944; color: #ffffff; font-size: 15px; font-weight: 600; cursor: pointer;">
									<span class="btn-wrap">
										<span class="text-one">Send Now</span>
										<span class="text-two">Send Now</span>
									</span>
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								</button>
							</div>
						</form>
					</div>

				</div>
			</div>

		</div>
	</div>
</section>

<!-- Location Section After Contact Form -->
<section class="he-contact-location" style="padding: 0 0 76px; background: #f8faf8; margin-bottom: 0; font-weight: 600;">
	<div class="auto-container">
		<div style="border: 1px solid #e0e9e1; border-radius: 20px; background: #ffffff; overflow: hidden; box-shadow: 0 16px 40px rgba(18, 59, 36, 0.06);">
			<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); align-items: stretch; margin: 0;">

				<!-- Location Details -->
				<div style="padding: 36px 34px; display: flex; flex-direction: column; justify-content: center; min-width: 0;">
					<div style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px; color: #278944; font-size: 11px; font-weight: 600; letter-spacing: 0.16em; text-transform: uppercase;">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
							<circle cx="12" cy="10" r="3"></circle>
						</svg>
						Our Location
					</div>

					<h3 style="margin: 0 0 12px; color: #173b35; font-size: clamp(22px, 2.5vw, 28px); font-weight: 600; line-height: 1.25;">
						Where to Find Us
					</h3>

					<p style="margin: 0 0 22px; color: #66766f; font-size: 14px; font-weight: 600; line-height: 1.75;">
						Reach out online anytime or connect with our editorial and engineering team at our office location.
					</p>

					<div style="display: grid; gap: 14px; margin-bottom: 24px;">
						<div style="display: flex; align-items: flex-start; gap: 12px;">
							<span style="width: 34px; height: 34px; flex: 0 0 34px; display: grid; place-items: center; border-radius: 8px; background: #edf7e9; color: #278944;">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
									<circle cx="12" cy="10" r="3"></circle>
								</svg>
							</span>
							<div>
								<div style="color: #173b35; font-size: 14px; font-weight: 600;">Office Address</div>
								<div style="color: #66766f; font-size: 13px; font-weight: 600; line-height: 1.6;">Peshawar, Khyber Pakhtunkhwa, Pakistan</div>
							</div>
						</div>

						<div style="display: flex; align-items: flex-start; gap: 12px;">
							<span style="width: 34px; height: 34px; flex: 0 0 34px; display: grid; place-items: center; border-radius: 8px; background: #edf7e9; color: #278944;">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<rect x="2" y="4" width="20" height="16" rx="2"></rect>
									<path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
								</svg>
							</span>
							<div>
								<div style="color: #173b35; font-size: 14px; font-weight: 600;">Direct Email</div>
								<a href="mailto:<?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?>" style="color: #278944; font-size: 13px; font-weight: 600; text-decoration: none;">
									<?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?>
								</a>
							</div>
						</div>
					</div>

					<div>
						<a href="https://maps.google.com/?q=Peshawar,Pakistan" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 10px; min-height: 42px; padding: 0 18px; border-radius: 999px; background: #a9e875; color: #14392b; font-size: 13px; font-weight: 600; text-decoration: none;">
							<span>Open in Google Maps</span>
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M7 17 17 7"></path>
								<path d="M7 7h10v10"></path>
							</svg>
						</a>
					</div>
				</div>

				<!-- Embedded Map -->
				<div style="padding: 0; min-height: 320px; min-width: 0;">
					<iframe
						title="Office Location Map"
						src="https://www.google.com/maps?q=Peshawar,Pakistan&output=embed"
						width="100%"
						height="100%"
						style="border: 0; min-height: 320px; width: 100%; display: block;"
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade">
					</iframe>
				</div>

			</div>
		</div>
	</div>
</section>