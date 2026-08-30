<?php
    $contactBadge = setting('contact_badge', __('Contact Us'));
    $contactHeading1 = setting('contact_heading_line1', __("Let's talk about"));
    $contactHeading2 = setting('contact_heading_line2', __('your project'));
    $contactDesc = setting('contact_description', __('Distributor, professional or individual — our team is at your disposal for any order or partnership.'));
    $contactPhone = setting('contact_phone', '+212 661 436 621');
    $contactEmail = setting('contact_email', 'ste.taramide@gmail.com');
    $contactAddress = setting('contact_address', __("Ksar Ousroutou, Sidi Aayad\nEr-rich, Midelt, Maroc"));
    $contactManager = setting('contact_manager', __('Ayoub Sabbane'));
    $contactFormTitle = setting('contact_form_title', __('Send a message'));
    $contactButtonText = setting('contact_button_text', __('Send Message'));
    $contactSuccessMsg = setting('contact_success_message', __('Your message has been sent successfully. We will get back to you as soon as possible.'));
?>

<section id="contact" class="py-24 lg:py-32 relative overflow-hidden" style="background-color: var(--btn-color, #2B5F3F);">
    <div class="max-w-6xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-20">

            <div class="reveal text-center lg:text-start">
                <div class="inline-flex items-center gap-2 text-xs font-medium text-white/40 bg-white/5 px-3.5 py-1.5 rounded-full mb-6"><?php echo e($contactBadge); ?></div>
                <h2 class="font-display text-heading text-white leading-tight mb-6">
                    <?php echo e($contactHeading1); ?><br><?php echo e($contactHeading2); ?>

                </h2>
                <p class="text-base text-white/50 leading-relaxed mb-12 max-w-sm mx-auto lg:mx-0">
                    <?php echo e($contactDesc); ?>

                </p>

                <div class="space-y-5">
                    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-2.5 lg:gap-3.5 group">
                        <div class="w-10 h-10 rounded-xl bg-white/8 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                        </div>
                        <div>
                            <div class="text-[11px] text-white/30 mb-0.5"><?php echo e(__('Phone')); ?></div>
                            <?php $__currentLoopData = array_map('trim', explode(',', $contactPhone)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="tel:<?php echo e(preg_replace('/\s+/', '', $phone)); ?>" class="text-sm text-white hover:text-accent transition-colors block"><?php echo e($phone); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-2.5 lg:gap-3.5 group">
                        <div class="w-10 h-10 rounded-xl bg-white/8 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                        </div>
                        <div>
                            <div class="text-[11px] text-white/30 mb-0.5"><?php echo e(__('Email')); ?></div>
                            <?php $__currentLoopData = array_map('trim', explode(',', $contactEmail)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="mailto:<?php echo e($email); ?>" class="text-sm text-white hover:text-accent transition-colors block"><?php echo e($email); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-2.5 lg:gap-3.5 group">
                        <div class="w-10 h-10 rounded-xl bg-white/8 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                        </div>
                        <div>
                            <div class="text-[11px] text-white/30 mb-0.5"><?php echo e(__('Address')); ?></div>
                            <p class="text-sm text-white leading-relaxed"><?php echo nl2br(e($contactAddress)); ?></p>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-2.5 lg:gap-3.5 group">
                        <div class="w-10 h-10 rounded-xl bg-white/8 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                        </div>
                        <div>
                            <div class="text-[11px] text-white/30 mb-0.5"><?php echo e(__('Manager')); ?></div>
                            <p class="text-sm text-white"><?php echo e($contactManager); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal reveal-delay-2 bg-white/[0.06] border border-white/[0.08] rounded-2xl p-8 lg:p-10" x-data="contactForm()">
                <div class="text-sm font-medium text-white/40 mb-8"><?php echo e($contactFormTitle); ?></div>

                <div x-show="success" x-cloak class="mb-6 p-4 bg-leaf/20 border border-leaf/30 rounded-xl text-white text-sm">
                    <?php echo e($contactSuccessMsg); ?>

                </div>

                <div x-show="error" x-cloak class="mb-6 p-4 bg-red-500/20 border border-red-500/30 rounded-xl text-white text-sm" x-text="error"></div>

                <form @submit.prevent="submit">
                    <input type="hidden" name="_token" :value="csrfToken">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] text-white/40 mb-1.5"><?php echo e(__('First Name')); ?></label>
                                <input type="text" x-model="form.first_name" required placeholder="<?php echo e(__('John')); ?>" class="inp-dark">
                            </div>
                            <div>
                                <label class="block text-[11px] text-white/40 mb-1.5"><?php echo e(__('Last Name')); ?></label>
                                <input type="text" x-model="form.last_name" required placeholder="<?php echo e(__('Smith')); ?>" class="inp-dark">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] text-white/40 mb-1.5"><?php echo e(__('Email')); ?></label>
                            <input type="email" x-model="form.email" required placeholder="<?php echo e(__('you@example.com')); ?>" class="inp-dark">
                        </div>

                        <div>
                            <label class="block text-[11px] text-white/40 mb-1.5"><?php echo e(__('Message')); ?></label>
                            <textarea rows="4" x-model="form.message" required placeholder="<?php echo e(__('Describe your project or needs...')); ?>" class="inp-dark resize-none"></textarea>
                        </div>

                        <button type="submit" :disabled="loading" class="w-full bg-accent text-white text-sm font-medium py-3.5 rounded-xl hover:bg-accent-light transition-all duration-300 flex items-center justify-center gap-2.5 group disabled:opacity-50">
                            <span x-show="!loading"><?php echo e($contactButtonText); ?></span>
                            <span x-show="loading" x-cloak><?php echo e(__('Sending...')); ?></span>
                            <svg x-show="!loading" class="w-4 h-4 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
function contactForm() {
    const urlParams = new URLSearchParams(window.location.search);
    const productName = urlParams.get('product');
    return {
        form: { first_name: '', last_name: '', email: '', message: productName ? `Hi, I am interested in ${productName}. ` : '' },
        loading: false,
        success: false,
        error: '',
        csrfToken: document.querySelector('meta[name="csrf-token"]').content,
        async submit() {
            this.loading = true;
            this.success = false;
            this.error = '';
            try {
                const res = await fetch('<?php echo e(route("contact.send")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(this.form),
                });
                const data = await res.json();
                if (res.ok) {
                    this.success = true;
                    this.form = { first_name: '', last_name: '', email: '', type: '', message: '' };
                } else {
                    this.error = data.message || <?php echo json_encode(__('Something went wrong.'), 15, 512) ?>;
                }
            } catch (e) {
                this.error = <?php echo json_encode(__('Something went wrong. Please try again.'), 15, 512) ?>;
            }
            this.loading = false;
        }
    };
}
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/sections/contact.blade.php ENDPATH**/ ?>