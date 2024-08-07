<?php $__env->startSection('title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/js/jscolor.js')); ?> "></script>
    <script>
        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function () {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('#invoice_frame').attr('src', '<?php echo e(url('/invoices/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='estimation_template'], input[name='estimation_color']", function () {
            var template = $("select[name='estimation_template']").val();
            var color = $("input[name='estimation_color']:checked").val();
            $('#estimation_frame').attr('src', '<?php echo e(url('/estimations/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='mdf_template'], input[name='mdf_color']", function () {
            var template = $("select[name='mdf_template']").val();
            var color = $("input[name='mdf_color']:checked").val();
            $('#mdf_frame').attr('src', '<?php echo e(url('/mdf/preview')); ?>/' + template + '/' + color);
        });

    </script>
    <script>
        $(document).ready(function () {
            if ($('.gdpr_fulltime').is(':checked') ) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

            $('#gdpr_cookie').on('change', function() {
                if ($('.gdpr_fulltime').is(':checked') ) {

                    $('.fulltime').show();
                } else {

                    $('.fulltime').hide();
                }
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li>
                    <a class="active" id="contact-tab2" data-toggle="tab" href="#business-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Site Setting')); ?></a>
                </li>
                <li>
                    <a id="contact-tab4" data-toggle="tab" href="#system-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('System Setting')); ?></a>
                </li>
                <li>
                    <a id="profile-tab3" data-toggle="tab" href="#company-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Company Setting')); ?></a>
                </li>
                <!-- <li>
                    <a id="profile-tab4" data-toggle="tab" href="#company-payment-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Payment Setting')); ?></a>
                </li>
                <li>
                    <a id="profile-tab6" data-toggle="tab" href="#invoice-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Invoice Print Setting')); ?></a>
                </li> -->
                <!-- <li>
                    <a id="profile-tab7" data-toggle="tab" href="#estimation-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Estimation Print Setting')); ?></a>
                </li> -->
                <!-- <li>
                    <a id="profile-tab8" data-toggle="tab" href="#mdf-setting" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('MDF Print Setting')); ?></a>
                </li> -->
            </ul>
            <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade fade show active" id="business-setting" role="tabpanel" aria-labelledby="profile-tab3">
                    <form method="post" action="<?php echo e(route('site.settings.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <h4 class="small-title"><?php echo e(__('Site Settings')); ?></h4>
                                <div class="card setting-card">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="logo" class="form-control-label"><?php echo e(__('Favicon')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-center my-auto">
                                            <!-- <img src="<?php echo e(asset(Storage::url('logo/favicon.png'))); ?>" class="setting-img"/> -->
                                            <img src="<?php echo e(asset('/storage/logo/favicon.png')); ?>" class="setting-img"/>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="input-file btn-file"><?php echo e(__('Select image')); ?>

                                                    <input type="file" name="favicon" id="favicon" class="form-control <?php echo e(($errors->has('favicon')) ? 'is-invalid' : ''); ?>" accept="image/png" data-filename="favicon_update"/>
                                                </div>
                                                <p class="favicon_update text-xs"></p>
                                                <?php if($errors->has('favicon')): ?>
                                                    <span class="invalid-feedback text-xs d-block"><?php echo e($errors->first('favicon')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="full_logo" class="form-control-label"><?php echo e(__('Logo')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-center my-auto">
                                            <!-- <img src="<?php echo e(asset(Storage::url('logo/logo-full.png'))); ?>" class="setting-img"/> -->
                                            <img src="<?php echo e(asset('/storage/logo/logo-full.png')); ?>" class="setting-img"/>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="input-file btn-file"><?php echo e(__('Select image')); ?>

                                                    <input type="file" name="full_logo" id="full_logo" class="form-control <?php echo e(($errors->has('full_logo')) ? 'is-invalid' : ''); ?>" accept="image/png" data-filename="logo_update"/>
                                                </div>
                                                <p class="logo_update text-xs"></p>
                                                <?php if($errors->has('full_logo')): ?>
                                                    <span class="invalid-feedback text-xs d-block"><?php echo e($errors->first('full_logo')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="landing_logo" class="form-control-label"><?php echo e(__('Landing Page Logo')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-center my-auto">
                                            <img src="<?php echo e(asset(Storage::url('logo/landing_logo.png'))); ?>" class="setting-img"/>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="input-file btn-file"><?php echo e(__('Select image')); ?>

                                                    <input type="file" name="landing_logo" id="landing_logo" class="form-control <?php echo e(($errors->has('landing_logo')) ? 'is-invalid' : ''); ?>" accept="image/png" data-filename="landing_logo_update"/>
                                                </div>
                                                <p class="landing_logo_update text-xs"></p>
                                                <?php if($errors->has('landing_logo')): ?>
                                                    <span class="invalid-feedback text-xs d-block"><?php echo e($errors->first('landing_logo')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-6 my-auto">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="enable_landing" value="yes" class="custom-control-input" id="enable_landing" <?php echo e((Utility::getValByName('enable_landing') == 'yes') ? 'checked' : ''); ?>>
                                                    <label class="custom-control-label font-weight-bold text-dark text-xs" for="enable_landing"><?php echo e(__('Enable Landing Page')); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="row">
                                        <div class="col-12 my-auto">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="SITE_RTL" id="SITE_RTL" <?php echo e(env('SITE_RTL') == 'on' ? 'checked="checked"' : ''); ?>>

                                                    <label class="custom-control-label form-control-label" for="SITE_RTL"></label>
                                                    <?php echo e(Form::label('SITE_RTL',__('RTL'),array('class'=>'form-control-label'))); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <?php echo e(Form::label('gdpr_cookie',__('GDPR Cookie'))); ?>


                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input gdpr_fulltime gdpr_type" name="gdpr_cookie" id="gdpr_cookie" <?php echo e(isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                <label class="custom-control-label form-control-label" for="gdpr_cookie"></label>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <?php echo e(Form::label('cookie_text',__('GDPR Cookie Text'),array('class'=>'fulltime') )); ?>

                                            <input type="text" name="cookie_text" class="form-control fulltime" value="<?php echo e(isset($settings['cookie_text']) && $settings['cookie_text'] ? $settings['cookie_text'] : ''); ?>" style="display: hidden;">
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <h4 class="small-title"><?php echo e(__('Mailer Settings')); ?></h4>
                                <div class="card setting-card">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_driver" class="form-control-label"><?php echo e(__('Mail Driver')); ?></label>
                                                <input type="text" name="mail_driver" id="mail_driver" class="form-control <?php echo e(($errors->has('mail_driver')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('MAIL_DRIVER')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder')); ?>"/>
                                                <?php if($errors->has('mail_driver')): ?>
                                                    <span class="invalid-feedback text-xs text-xs d-block">
                                                        <?php echo e($errors->first('mail_driver')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_host" class="form-control-label"><?php echo e(__('Mail Host')); ?></label>
                                                <input type="text" name="mail_host" id="mail_host" class="form-control <?php echo e(($errors->has('mail_host')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('MAIL_HOST')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder')); ?>"/>
                                                <?php if($errors->has('mail_host')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                        <?php echo e($errors->first('mail_host')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_port" class="form-control-label"><?php echo e(__('Mail Port')); ?></label>
                                                <input type="number" name="mail_port" id="mail_port" class="form-control <?php echo e(($errors->has('mail_port')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('MAIL_PORT')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder')); ?>"/>
                                                <?php if($errors->has('mail_port')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                                        <?php echo e($errors->first('mail_port')); ?>

                                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_username" class="form-control-label"><?php echo e(__('Mail Username')); ?></label>
                                                <input type="text" name="mail_username" id="mail_username" class="form-control <?php echo e(($errors->has('mail_username')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('MAIL_USERNAME')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder')); ?>"/>
                                                <?php if($errors->has('mail_username')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                                        <?php echo e($errors->first('mail_username')); ?>

                                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_password" class="form-control-label"><?php echo e(__('Mail Password')); ?></label>
                                                <input type="text" name="mail_password" id="mail_password" class="form-control <?php echo e(($errors->has('mail_password')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('MAIL_PASSWORD')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder')); ?>"/>
                                                <?php if($errors->has('mail_password')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                                        <?php echo e($errors->first('mail_password')); ?>

                                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_encryption" class="form-control-label"><?php echo e(__('Mail Encryption')); ?></label>
                                                <input type="text" name="mail_encryption" id="mail_encryption" class="form-control <?php echo e(($errors->has('mail_encryption')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('MAIL_ENCRYPTION')); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder')); ?>"/>
                                                <?php if($errors->has('mail_encryption')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                                        <?php echo e($errors->first('mail_encryption')); ?>

                                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_from_address" class="form-control-label"><?php echo e(__('Mail From Address')); ?></label>
                                                <input type="text" name="mail_from_address" id="mail_from_address" class="form-control <?php echo e(($errors->has('mail_from_address')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('MAIL_FROM_ADDRESS')); ?>" placeholder="<?php echo e(__('Enter Mail From Address')); ?>"/>
                                                <?php if($errors->has('mail_from_address')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                    <?php echo e($errors->first('mail_from_address')); ?>

                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_from_name" class="form-control-label"><?php echo e(__('Mail From Name')); ?></label>
                                                <input type="text" name="mail_from_name" id="mail_from_name" class="form-control <?php echo e(($errors->has('mail_from_name')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('MAIL_FROM_NAME')); ?>" placeholder="<?php echo e(__('Enter Mail From Name')); ?>"/>
                                                <?php if($errors->has('mail_from_name')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                    <?php echo e($errors->first('mail_from_name')); ?>

                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <a href="#" class="btn btn-xs bg-warning btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="<?php echo e(__('Send Test Mail')); ?>" data-url="<?php echo e(route('test.email')); ?>">
                                                <?php echo e(__('Send Test Mail')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <h4 class="small-title"><?php echo e(__('Pusher Settings')); ?></h4>
                                <div class="card setting-card">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="enable_chat" value="yes" class="custom-control-input" id="enable_chat" <?php if(env('CHAT_MODULE') =='yes'): ?> checked <?php endif; ?>>
                                                    <label class="custom-control-label font-weight-bold text-dark text-sm" for="enable_chat"><?php echo e(__('Enable Chat')); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="pusher_app_id" class="form-control-label"><?php echo e(__('Pusher App Id')); ?></label>
                                                <input type="text" name="pusher_app_id" id="pusher_app_id" class="form-control <?php echo e(($errors->has('pusher_app_id')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('PUSHER_APP_ID')); ?>" placeholder="<?php echo e(__('Pusher App Id')); ?>"/>
                                                <?php if($errors->has('pusher_app_id')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                    <?php echo e($errors->first('pusher_app_id')); ?>

                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="pusher_app_key" class="form-control-label"><?php echo e(__('Pusher App Key')); ?></label>
                                                <input type="text" name="pusher_app_key" id="pusher_app_key" class="form-control <?php echo e(($errors->has('pusher_app_key')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('PUSHER_APP_KEY')); ?>" placeholder="<?php echo e(__('Pusher App Key')); ?>"/>
                                                <?php if($errors->has('pusher_app_key')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                    <?php echo e($errors->first('pusher_app_key')); ?>

                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="pusher_app_secret" class="form-control-label"><?php echo e(__('Pusher App Secret')); ?></label>
                                                <input type="text" name="pusher_app_secret" id="pusher_app_secret" class="form-control <?php echo e(($errors->has('pusher_app_secret')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('PUSHER_APP_SECRET')); ?>" placeholder="<?php echo e(__('Pusher App Secret')); ?>"/>
                                                <?php if($errors->has('pusher_app_secret')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                    <?php echo e($errors->first('pusher_app_secret')); ?>

                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="pusher_app_cluster" class="form-control-label"><?php echo e(__('Pusher App Cluster')); ?></label>
                                                <input type="text" name="pusher_app_cluster" id="pusher_app_cluster" class="form-control <?php echo e(($errors->has('pusher_app_cluster')) ? 'is-invalid' : ''); ?>" value="<?php echo e(env('PUSHER_APP_CLUSTER')); ?>" placeholder="<?php echo e(__('Pusher App Cluster')); ?>"/>
                                                <?php if($errors->has('pusher_app_cluster')): ?>
                                                    <span class="invalid-feedback text-xs d-block">
                                                    <?php echo e($errors->first('pusher_app_cluster')); ?>

                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="https://pusher.com/channels" class="text-xs" target="_blank"><?php echo e(__('You can Make Pusher channel Account from here and Get your App Id and Secret key')); ?></a>
                                        </div>
                                        <div class="form-group col-md-12 text-right">
                                            <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-create badge-blue">
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="system-setting" role="tabpanel" aria-labelledby="profile-tab3">
                    <form id="setting-form" method="post" action="<?php echo e(route('settings.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="card bg-none">
                            <div class="row company-setting">
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Title Text')); ?></label>
                                    <input type="text" name="header_text" class="form-control" id="header_text" value="<?php echo e(Utility::getValByName('header_text')); ?>" placeholder="<?php echo e(__('Enter Header Title Text')); ?>">
                                    <?php $__errorArgs = ['header_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-header_text text-xs" role="alert"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Footer Text')); ?></label>
                                    <input type="text" name="footer_text" class="form-control" id="footer_text" value="<?php echo e(Utility::getValByName('footer_text')); ?>" placeholder="<?php echo e(__('Enter Footer Text')); ?>">
                                    <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-header_text text-xs" role="alert"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Default Language')); ?></label>
                                    <select name="default_language" id="default_language" class="form-control select2">
                                        <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(Utility::getValByName('default_language') == $language): ?> selected <?php endif; ?> value="<?php echo e($language); ?>"><?php echo e(Str::upper($language)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['default_language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-header_text text-xs" role="alert"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <!-- <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Currency')); ?> *</label>
                                    <input type="text" name="site_currency" class="form-control" id="site_currency" value="<?php echo e($settings['site_currency']); ?>" required>
                                    <small class="text-xs">
                                        <?php echo e(__('Note: Add currency code as per three-letter ISO code')); ?>.
                                        <a href="https://stripe.com/docs/currencies" target="_blank"><?php echo e(__('you can find out here..')); ?></a>
                                    </small>
                                </div> -->
                                <!-- <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Currency Symbol')); ?> *</label>
                                    <input type="text" name="site_currency_symbol" class="form-control" id="site_currency_symbol" value="<?php echo e($settings['site_currency_symbol']); ?>" required>
                                </div> -->
                                <!-- <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Currency Symbol Position')); ?> *</label>
                                    <div class="d-flex radio-check">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="pre" value="pre" name="site_currency_symbol_position" class="custom-control-input" <?php if($settings['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?>>
                                            <label class="custom-control-label form-control-label" for="pre"><?php echo e(__('Pre')); ?></label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="post" value="post" name="site_currency_symbol_position" class="custom-control-input" <?php if($settings['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>>
                                            <label class="custom-control-label form-control-label" for="post"><?php echo e(__('Post')); ?></label>
                                        </div>
                                    </div>
                                </div> -->


                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="site_date_format" class="form-control-label"><?php echo e(__('Date Format')); ?></label>
                                    <select type="text" name="site_date_format" class="form-control select2" id="site_date_format">
                                        <option value="M j, Y" <?php if($settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>><?php echo e(date('M d Y')); ?></option>
                                        <option value="d-m-Y" <?php if($settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>><?php echo e(date('d-m-y')); ?></option>
                                        <option value="m-d-Y" <?php if($settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>><?php echo e(date('m-d-y')); ?></option>
                                        <option value="Y-m-d" <?php if($settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>><?php echo e(date('y-m-d')); ?></option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="site_time_format" class="form-control-label"><?php echo e(__('Time Format')); ?></label>
                                    <select type="text" name="site_time_format" class="form-control select2" id="site_time_format">
                                        <option value="g:i A" <?php if($settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>><?php echo e(date('H:s A')); ?> </option>
                                        <option value="g:i a" <?php if($settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>><?php echo e(date('H:s a')); ?></option>
                                        <option value="H:i" <?php if($settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>><?php echo e(date('G:s')); ?></option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="invoice_prefix" class="form-control-label"><?php echo e(__('Invoice Prefix')); ?> *</label>
                                    <input type="text" name="invoice_prefix" class="form-control" id="invoice_prefix" value="<?php echo e($settings['invoice_prefix']); ?>" required>
                                </div>
                                <!-- <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="estimation_prefix" class="form-control-label"><?php echo e(__('Estimation Prefix')); ?> *</label>
                                    <input type="text" name="estimation_prefix" class="form-control" id="estimation_prefix" value="<?php echo e($settings['estimation_prefix']); ?>" required>
                                </div> -->
                                <!-- <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Invoice/Estimation/MDF Title')); ?> *</label>
                                    <input type="text" name="footer_title" class="form-control" id="footer_title" value="<?php echo e($settings['footer_title']); ?>">
                                </div> -->
                                <!-- <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="footer_note" class="form-control-label"><?php echo e(__('Invoice/Estimation/MDF Note')); ?> *</label>
                                    <textarea name="footer_note" id="footer_note" class="form-control"><?php echo e($settings['footer_note']); ?></textarea>
                                </div> -->
                                <div class="form-group col-md-12 text-right">
                                    <input type="submit" id="save-btn" value="<?php echo e(__('Save Changes')); ?>" class="btn-create badge-blue">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="company-setting" role="tabpanel" aria-labelledby="contact-tab4">
                    <form id="setting-form" method="post" action="<?php echo e(route('settings.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="card bg-none">
                            <div class="row company-setting">
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="company_name" class="form-control-label"><?php echo e(__('Company Name')); ?> *</label>
                                    <input type="text" name="company_name" class="form-control" id="company_name" value="<?php echo e($settings['company_name']); ?>" required>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="company_address" class="form-control-label"><?php echo e(__('Address')); ?></label>
                                    <input type="text" name="company_address" class="form-control" id="company_address" value="<?php echo e($settings['company_address']); ?>">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="company_city" class="form-control-label"><?php echo e(__('City')); ?></label>
                                    <input type="text" name="company_city" class="form-control" id="company_city" value="<?php echo e($settings['company_city']); ?>">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="company_state" class="form-control-label"><?php echo e(__('State')); ?></label>
                                    <input type="text" name="company_state" class="form-control" id="company_state" value="<?php echo e($settings['company_state']); ?>">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="company_zipcode" class="form-control-label"><?php echo e(__('Zip/Post Code')); ?></label>
                                    <input type="text" name="company_zipcode" class="form-control" id="company_zipcode" value="<?php echo e($settings['company_zipcode']); ?>">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="company_country" class="form-control-label"><?php echo e(__('Country')); ?></label>
                                    <input type="text" name="company_country" class="form-control" id="company_country" value="<?php echo e($settings['company_country']); ?>">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="company_telephone" class="form-control-label"><?php echo e(__('Telephone')); ?></label>
                                    <input type="text" name="company_telephone" class="form-control" id="company_telephone" value="<?php echo e($settings['company_telephone']); ?>">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="company_email" class="form-control-label"><?php echo e(__('System Email')); ?> *</label>
                                    <input type="email" name="company_email" class="form-control" id="company_email" value="<?php echo e($settings['company_email']); ?>" required>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label for="company_email_from_name" class="form-control-label"><?php echo e(__('Email (From Name)')); ?> *</label>
                                    <input type="text" name="company_email_from_name" class="form-control" id="company_email_from_name" value="<?php echo e($settings['company_email_from_name']); ?>" required>
                                </div>
                                <div class="form-group col-md-12 text-right">
                                    <input type="submit" id="save-btn" value="<?php echo e(__('Save Changes')); ?>" class="btn-create badge-blue">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="company-payment-setting" role="tabpanel" aria-labelledby="contact-tab4">
                    <small class="text-dark font-weight-bold"><?php echo e(__("This detail will use for collect payment on invoice from clients. On invoice client will find out pay now button based on your below configuration.")); ?></small></br></br>



                    <form id="setting-form" method="post" action="<?php echo e(route('payment.settings')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label class="form-control-label"><?php echo e(__('Currency')); ?> *</label>
                                                <input type="text" name="currency" class="form-control" id="currency" value="<?php echo e((!isset($payment['currency']) || is_null($payment['currency'])) ? '' : $payment['currency']); ?>" required>
                                                <small class="text-xs">
                                                    <?php echo e(__('Note: Add currency code as per three-letter ISO code')); ?>.
                                                    <a href="https://stripe.com/docs/currencies" target="_blank"><?php echo e(__('you can find out here..')); ?></a>
                                                </small>
                                            </div> -->
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="currency_symbol" class="form-control-label"><?php echo e(__('Currency Symbol')); ?></label>
                                                <input type="text" name="currency_symbol" class="form-control" id="currency_symbol" value="<?php echo e((!isset($payment['currency_symbol']) || is_null($payment['currency_symbol'])) ? '' : $payment['currency_symbol']); ?>" required>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="accordion-2" class="accordion accordion-spaced">
                            <!-- Strip -->
                            <div class="card">
                                <div class="card-header py-4" id="heading-2-2" data-toggle="collapse" role="button" data-target="#collapse-2-2" aria-expanded="false" aria-controls="collapse-2-2">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('Stripe')); ?></h6>

                                </div>
                                <div id="collapse-2-2" class="collapse" aria-labelledby="heading-2-2" data-parent="#accordion-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Stripe')); ?></h5>
                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_stripe_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_stripe_enabled" id="is_stripe_enabled" <?php echo e(isset($payment['is_stripe_enabled']) && $payment['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_stripe_enabled"><?php echo e(__('Enable Stripe')); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="stripe_key"><?php echo e(__('Stripe Key')); ?></label>
                                                    <input class="form-control" placeholder="<?php echo e(__('Stripe Key')); ?>" name="stripe_key" type="text" value="<?php echo e((!isset($payment['stripe_key']) || is_null($payment['stripe_key'])) ? '' : $payment['stripe_key']); ?>" id="stripe_key">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="stripe_secret"><?php echo e(__('Stripe Secret')); ?></label>
                                                    <input class="form-control " placeholder="<?php echo e(__('Stripe Secret')); ?>" name="stripe_secret" type="text" value="<?php echo e((!isset($payment['stripe_secret']) || is_null($payment['stripe_secret'])) ? '' : $payment['stripe_secret']); ?>" id="stripe_secret">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="stripe_secret"><?php echo e(__('Stripe_Webhook_Secret')); ?></label>
                                                    <input class="form-control " placeholder="<?php echo e(__('Enter Stripe Webhook Secret')); ?>" name="stripe_webhook_secret" type="text" value="<?php echo e((!isset($payment['stripe_webhook_secret']) || is_null($payment['stripe_webhook_secret'])) ? '' : $payment['stripe_webhook_secret']); ?>" id="stripe_webhook_secret">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Paypal -->
                            <div class="card">
                                <div class="card-header py-4" id="heading-2-3" data-toggle="collapse" role="button" data-target="#collapse-2-3" aria-expanded="false" aria-controls="collapse-2-3">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('Paypal')); ?></h6>
                                </div>
                                <div id="collapse-2-3" class="collapse" aria-labelledby="heading-2-3" data-parent="#accordion-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Paypal')); ?></h5>
                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_paypal_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_paypal_enabled" id="is_paypal_enabled" <?php echo e(isset($payment['is_paypal_enabled']) && $payment['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_paypal_enabled"><?php echo e(__('Enable Paypal')); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 pb-4">
                                                <label class="paypal-label form-control-label" for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label> <br>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-primary btn-sm <?php echo e(!isset($payment['paypal_mode']) || $payment['paypal_mode'] == '' || $payment['paypal_mode'] == 'sandbox' ? 'active' : ''); ?>">
                                                        <input type="radio" name="paypal_mode" value="sandbox" <?php echo e(!isset($payment['paypal_mode']) || $payment['paypal_mode'] == '' || $payment['paypal_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>><?php echo e(__('Sandbox')); ?>

                                                    </label>
                                                    <label class="btn btn-primary btn-sm <?php echo e(isset($payment['paypal_mode']) && $payment['paypal_mode'] == 'live' ? 'active' : ''); ?>">
                                                        <input type="radio" name="paypal_mode" value="live" <?php echo e(isset($payment['paypal_mode']) && $payment['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>><?php echo e(__('Live')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_client_id"><?php echo e(__('Client ID')); ?></label>
                                                    <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="<?php echo e((!isset($payment['paypal_client_id']) || is_null($payment['paypal_client_id'])) ? '' : $payment['paypal_client_id']); ?>" placeholder="<?php echo e(__('Client ID')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_secret_key"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="<?php echo e((!isset($payment['paypal_secret_key']) || is_null($payment['paypal_secret_key'])) ? '' : $payment['paypal_secret_key']); ?>" placeholder="<?php echo e(__('Secret Key')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Paystack -->
                            <div class="card">
                                <div class="card-header py-4" id="heading-2-6" data-toggle="collapse" role="button" data-target="#collapse-2-6" aria-expanded="false" aria-controls="collapse-2-6">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('Paystack')); ?></h6>
                                </div>
                                <div id="collapse-2-6" class="collapse" aria-labelledby="heading-2-6" data-parent="#accordion-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Paystack')); ?></h5>

                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_paystack_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_paystack_enabled" id="is_paystack_enabled" <?php echo e(isset($payment['is_paystack_enabled']) && $payment['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_paystack_enabled"><?php echo e(__('Enable Paystack')); ?> </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_client_id"><?php echo e(__('Public Key')); ?></label>
                                                    <input type="text" name="paystack_public_key" id="paystack_public_key" class="form-control" value="<?php echo e((!isset($payment['paystack_public_key']) || is_null($payment['paystack_public_key'])) ? '' : $payment['paystack_public_key']); ?>" placeholder="<?php echo e(__('Public Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paystack_secret_key"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="paystack_secret_key" id="paystack_secret_key" class="form-control" value="<?php echo e((!isset($payment['paystack_secret_key']) || is_null($payment['paystack_secret_key'])) ? '' : $payment['paystack_secret_key']); ?>" placeholder="<?php echo e(__('Secret Key')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FLUTTERWAVE -->
                            <div class="card">
                                <div class="card-header py-4" id="heading-2-7" data-toggle="collapse" role="button" data-target="#collapse-2-7" aria-expanded="false" aria-controls="collapse-2-7">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('Flutterwave')); ?></h6>
                                </div>
                                <div id="collapse-2-7" class="collapse" aria-labelledby="heading-2-7" data-parent="#accordion-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Flutterwave')); ?></h5>

                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_flutterwave_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_flutterwave_enabled" id="is_flutterwave_enabled" <?php echo e(isset($payment['is_flutterwave_enabled']) && $payment['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_flutterwave_enabled"><?php echo e(__('Enable Flutterwave')); ?></label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_client_id"><?php echo e(__('Public Key')); ?></label>
                                                    <input type="text" name="flutterwave_public_key" id="flutterwave_public_key" class="form-control" value="<?php echo e((!isset($payment['flutterwave_public_key']) || is_null($payment['flutterwave_public_key'])) ? '' : $payment['flutterwave_public_key']); ?>" placeholder="Public Key">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paystack_secret_key"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="flutterwave_secret_key" id="flutterwave_secret_key" class="form-control" value="<?php echo e((!isset($payment['flutterwave_secret_key']) || is_null($payment['flutterwave_secret_key'])) ? '' : $payment['flutterwave_secret_key']); ?>" placeholder="Secret Key">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Razorpay -->
                            <div class="card">
                                <div class="card-header py-4" id="heading-2-8" data-toggle="collapse" role="button" data-target="#collapse-2-8" aria-expanded="false" aria-controls="collapse-2-8">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('Razorpay')); ?></h6>
                                </div>
                                <div id="collapse-2-8" class="collapse" aria-labelledby="heading-2-7" data-parent="#accordion-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Razorpay')); ?></h5>

                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_razorpay_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_razorpay_enabled" id="is_razorpay_enabled" <?php echo e(isset($payment['is_razorpay_enabled']) && $payment['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_razorpay_enabled">Enable Razorpay</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_client_id">Public Key</label>

                                                    <input type="text" name="razorpay_public_key" id="razorpay_public_key" class="form-control" value="<?php echo e((!isset($payment['razorpay_public_key']) || is_null($payment['razorpay_public_key'])) ? '' : $payment['razorpay_public_key']); ?>" placeholder="Public Key">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paystack_secret_key">Secret Key</label>
                                                    <input type="text" name="razorpay_secret_key" id="razorpay_secret_key" class="form-control" value="<?php echo e((!isset($payment['razorpay_secret_key']) || is_null($payment['razorpay_secret_key'])) ? '' : $payment['razorpay_secret_key']); ?>" placeholder="Secret Key">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Paytm -->
                            <div class="card">
                                <div class="card-header py-4" id="heading-2-14" data-toggle="collapse" role="button" data-target="#collapse-2-14" aria-expanded="false" aria-controls="collapse-2-14">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('Paytm')); ?></h6>
                                </div>
                                <div id="collapse-2-14" class="collapse" aria-labelledby="heading-2-14" data-parent="#accordion-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Paytm')); ?></h5>

                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_paytm_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_paytm_enabled" id="is_paytm_enabled" <?php echo e(isset($payment['is_paytm_enabled']) && $payment['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_paytm_enabled">Enable Paytm</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 pb-4">
                                                <label class="paypal-label form-control-label" for="paypal_mode">Paytm Environment</label> <br>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-primary btn-sm <?php echo e(!isset($payment['paytm_mode']) || $payment['paytm_mode'] == '' || $payment['paytm_mode'] == 'local' ? 'active' : ''); ?>">
                                                        <input type="radio" name="paytm_mode" value="local" <?php echo e(!isset($payment['paytm_mode']) || $payment['paytm_mode'] == '' || $payment['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>Local
                                                    </label>
                                                    <label class="btn btn-primary btn-sm <?php echo e(isset($payment['paytm_mode']) && $payment['paytm_mode'] == 'production' ? 'active' : ''); ?>">
                                                        <input type="radio" name="paytm_mode" value="production" <?php echo e(isset($payment['paytm_mode']) && $payment['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>Production
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_public_key">Merchant ID</label>
                                                    <input type="text" name="paytm_merchant_id" id="paytm_merchant_id" class="form-control" value="<?php echo e((!isset($payment['paytm_merchant_id']) || is_null($payment['paytm_merchant_id'])) ? '' : $payment['paytm_merchant_id']); ?>" placeholder="Merchant ID">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_secret_key">Merchant Key</label>
                                                    <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" class="form-control" value="<?php echo e((!isset($payment['paytm_merchant_key']) || is_null($payment['paytm_merchant_key'])) ? '' : $payment['paytm_merchant_key']); ?>" placeholder="Merchant Key">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_industry_type">Industry Type</label>
                                                    <input type="text" name="paytm_industry_type" id="paytm_industry_type" class="form-control" value="<?php echo e((!isset($payment['paytm_industry_type']) || is_null($payment['paytm_industry_type'])) ? '' : $payment['paytm_industry_type']); ?>" placeholder="Industry Type">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mercado Pago-->
                            <div class="card">
                                <div class="card-header py-4" id="heading-2-12" data-toggle="collapse" role="button" data-target="#collapse-2-12" aria-expanded="false" aria-controls="collapse-2-12">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('Mercado Pago')); ?></h6>
                                </div>
                                <div id="collapse-2-12" class="collapse" aria-labelledby="heading-2-12" data-parent="#accordion-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Mercado Pago')); ?></h5>
                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_mercado_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_mercado_enabled" id="is_mercado_enabled" <?php echo e(isset($payment['is_mercado_enabled']) && $payment['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_mercado_enabled">Enable Mercado Pago</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mercado_app_id">App ID</label>
                                                    <input type="text" name="mercado_app_id" id="mercado_app_id" class="form-control" value="<?php echo e((!isset($payment['mercado_app_id']) || is_null($payment['mercado_app_id'])) ? '' : $payment['mercado_app_id']); ?>" placeholder="App ID">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mercado_secret_key">App Secret KEY</label>
                                                    <input type="text" name="mercado_secret_key" id="mercado_secret_key" class="form-control" value="<?php echo e((!isset($payment['mercado_secret_key']) || is_null($payment['mercado_secret_key'])) ? '' : $payment['mercado_secret_key']); ?>" placeholder="App Secret Key">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mollie -->
                            <div class="card">
                                <div class="card-header py-4" id="heading-2-8" data-toggle="collapse" role="button" data-target="#collapse-2-10" aria-expanded="false" aria-controls="collapse-2-10">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('Mollie')); ?></h6>
                                </div>
                                <div id="collapse-2-10" class="collapse" aria-labelledby="heading-2-7" data-parent="#accordion-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Mollie')); ?></h5>

                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_mollie_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_mollie_enabled" id="is_mollie_enabled" <?php echo e(isset($payment['is_mollie_enabled']) && $payment['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_mollie_enabled">Enable Mollie</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mollie_api_key">Mollie Api Key</label>
                                                    <input type="text" name="mollie_api_key" id="mollie_api_key" class="form-control" value="<?php echo e((!isset($payment['mollie_api_key']) || is_null($payment['mollie_api_key'])) ? '' : $payment['mollie_api_key']); ?>" placeholder="Mollie Api Key">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mollie_profile_id">Mollie Profile Id</label>
                                                    <input type="text" name="mollie_profile_id" id="mollie_profile_id" class="form-control" value="<?php echo e((!isset($payment['mollie_profile_id']) || is_null($payment['mollie_profile_id'])) ? '' : $payment['mollie_profile_id']); ?>" placeholder="Mollie Profile Id">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mollie_partner_id">Mollie Partner Id</label>
                                                    <input type="text" name="mollie_partner_id" id="mollie_partner_id" class="form-control" value="<?php echo e((!isset($payment['mollie_partner_id']) || is_null($payment['mollie_partner_id'])) ? '' : $payment['mollie_partner_id']); ?>" placeholder="Mollie Partner Id">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Skrill -->
                            <div class="card">
                                <div class="card-header py-4" id="heading-2-8" data-toggle="collapse" role="button" data-target="#collapse-2-13" aria-expanded="false" aria-controls="collapse-2-10">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('Skrill')); ?></h6>
                                </div>
                                <div id="collapse-2-13" class="collapse" aria-labelledby="heading-2-7" data-parent="#accordion-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Skrill')); ?></h5>

                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_skrill_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_skrill_enabled" id="is_skrill_enabled" <?php echo e(isset($payment['is_skrill_enabled']) && $payment['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_skrill_enabled">Enable Skrill</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mollie_api_key">Skrill Email</label>
                                                    <input type="text" name="skrill_email" id="skrill_email" class="form-control" value="<?php echo e((!isset($payment['skrill_email']) || is_null($payment['skrill_email'])) ? '' : $payment['skrill_email']); ?>" placeholder="Enter Skrill Email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CoinGate -->
                            <div class="card">
                                <div class="card-header py-4 collapsed" id="heading-2-8" data-toggle="collapse" role="button" data-target="#collapse-2-15" aria-expanded="false" aria-controls="collapse-2-10">
                                    <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i><?php echo e(__('CoinGate')); ?></h6>
                                </div>
                                <div id="collapse-2-15" class="collapse" aria-labelledby="heading-2-7" data-parent="#accordion-2" style="">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('CoinGate')); ?></h5>
                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_coingate_enabled" value="off">
                                                    <input type="checkbox" class="custom-control-input" name="is_coingate_enabled" id="is_coingate_enabled" <?php echo e(isset($payment['is_coingate_enabled']) && $payment['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="is_coingate_enabled">Enable CoinGate</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 pb-4">
                                                <label class="coingate-label form-control-label" for="coingate_mode">CoinGate Mode</label> <br>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-primary btn-sm <?php echo e(!isset($payment['coingate_mode']) || $payment['coingate_mode'] == '' || $payment['coingate_mode'] == 'sandbox' ? 'active' : ''); ?>">
                                                        <input type="radio" name="coingate_mode" value="sandbox" <?php echo e(!isset($payment['coingate_mode']) || $payment['coingate_mode'] == '' || $payment['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>Sandbox
                                                    </label>
                                                    <label class="btn btn-primary btn-sm <?php echo e(isset($payment['coingate_mode']) && $payment['coingate_mode'] == 'live' ? 'active' : ''); ?>">
                                                        <input type="radio" name="coingate_mode" value="live" <?php echo e(isset($payment['coingate_mode']) && $payment['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>Live
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="coingate_auth_token">CoinGate Auth Token</label>
                                                    <input type="text" name="coingate_auth_token" id="coingate_auth_token" class="form-control" value="<?php echo e((!isset($payment['coingate_auth_token']) || is_null($payment['coingate_auth_token'])) ? '' : $payment['coingate_auth_token']); ?>" placeholder="CoinGate Auth Token">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <div class="form-group">
                                <input class="btn-create badge-blue" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="invoice-setting" role="tabpanel" aria-labelledby="profile-tab6">
                    <div class="card bg-none">
                        <div class="row company-setting">
                            <div class="col-md-2">
                                <form id="setting-form" method="post" action="<?php echo e(route('template.setting')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="invoice_template" class="form-control-label"><?php echo e(__('Invoice Template')); ?></label>
                                        <select class="form-control select2" name="invoice_template" id="invoice_template">
                                            <?php $__currentLoopData = Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e((isset($settings['invoice_template']) && $settings['invoice_template'] == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label"><?php echo e(__('Color Input')); ?></label>
                                        <div class="row gutters-xs">
                                            <?php $__currentLoopData = Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input name="invoice_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((isset($settings['invoice_color']) && $settings['invoice_color'] == $color) ? 'checked' : ''); ?>>
                                                        <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                    </label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label"><?php echo e(__('Invoice Logo')); ?></label>
                                        <div class="choose-file form-group">
                                            <label for="invoice_logo" class="form-control-label">
                                                <div><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control" name="invoice_logo" id="invoice_logo" data-filename="invoice_logo_update" accept=".jpeg,.jpg,.png,.doc,.pdf">
                                            </label><br>
                                            <p class="invoice_logo_update"></p>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn-create badge-blue">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10">
                                <?php if(isset($settings['invoice_template']) && isset($settings['invoice_color'])): ?>
                                    <iframe id="invoice_frame" class="w-100 h-1050" frameborder="0" src="<?php echo e(route('invoice.preview',[$settings['invoice_template'],$settings['invoice_color']])); ?>"></iframe>
                                <?php else: ?>
                                    <iframe id="invoice_frame" class="w-100 h-1050" frameborder="0" src="<?php echo e(route('invoice.preview',['template1','ffffff'])); ?>"></iframe>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="estimation-setting" role="tabpanel" aria-labelledby="profile-tab7">
                    <div class="card bg-none">
                        <div class="row company-setting">
                            <div class="col-md-2">
                                <form id="setting-form" method="post" action="<?php echo e(route('template.setting')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="estimation_template" class="form-control-label"><?php echo e(__('Estimation Template')); ?></label>
                                        <select class="form-control select2" name="estimation_template" id="estimation_template">
                                            <?php $__currentLoopData = Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e((isset($settings['estimation_template']) && $settings['estimation_template'] == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label"><?php echo e(__('Color Input')); ?></label>
                                        <div class="row gutters-xs">
                                            <?php $__currentLoopData = Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input name="estimation_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((isset($settings['estimation_color']) && $settings['estimation_color'] == $color) ? 'checked' : ''); ?>>
                                                        <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                    </label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="estimation_logo" class="form-control-label"><?php echo e(__('Estimation Logo')); ?></label>
                                        <div class="choose-file form-group">
                                            <label for="estimation_logo" class="form-control-label">
                                                <div><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control" name="estimation_logo" id="estimation_logo" data-filename="estimation_logo_update" accept=".jpeg,.jpg,.png,.doc,.pdf">
                                            </label><br>
                                            <p class="estimation_logo_update"></p>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn-create badge-blue">
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="mdf-setting" role="tabpanel" aria-labelledby="profile-tab8">
                    <div class="card bg-none">
                        <div class="row company-setting">
                            <div class="col-md-2">
                                <form id="setting-form" method="post" action="<?php echo e(route('template.setting')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="mdf_template" class="form-control-label"><?php echo e(__('MDF Template')); ?></label>
                                        <select class="form-control select2" name="mdf_template" id="mdf_template">
                                            <?php $__currentLoopData = Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e((isset($settings['mdf_template']) && $settings['mdf_template'] == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label"><?php echo e(__('Color Input')); ?></label>
                                        <div class="row gutters-xs">
                                            <?php $__currentLoopData = Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input name="mdf_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((isset($settings['mdf_color']) && $settings['mdf_color'] == $color) ? 'checked' : ''); ?>>
                                                        <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                    </label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mdf_logo" class="form-control-label"><?php echo e(__('MDF Logo')); ?></label>
                                        <div class="choose-file form-group">
                                            <label for="mdf_logo" class="form-control-label">
                                                <div><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control" name="mdf_logo" id="mdf_logo" data-filename="mdf_logo_update" accept=".jpeg,.jpg,.png,.doc,.pdf">
                                            </label><br>
                                            <p class="mdf_logo_update"></p>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn-create badge-blue">
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/users/system_settings.blade.php ENDPATH**/ ?>