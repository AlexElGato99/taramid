<header
    class="sticky top-0 inset-x-0 w-full flex flex-wrap sm:justify-start sm:flex-nowrap z-30 bg-white text-xs dark:bg-gray-950 h-14">
    <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6 md:px-8" aria-label="Global">
        <div class="lg:hidden">
            <button
                class="hamburger text-gray-500 dark:text-gray-300"
                :class="{ 'active': sidebarToggle }"
                @click.stop="sidebarToggle = !sidebarToggle"
                aria-controls="mobile-nav"
                :aria-expanded="sidebarToggle"
            >
                <span class="sr-only">Menu</span>
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <rect y="4" width="24" height="2"/>
                    <rect y="11" width="24" height="2"/>
                    <rect y="18" width="24" height="2"/>
                </svg>
            </button>
        </div>
        <div class="shrink-0 ml-5 lg:ml-0 flex items-center">
            <a href="<?php echo e(route('admin.index')); ?>" class="text-gray-700 dark:text-gray-100 hover:text-gray-900">
                <img src="<?php echo e(asset('static/img/logo/light-mode-logo.svg')); ?>" alt="Logo" class="h-8 w-auto dark:hidden">
                <img src="<?php echo e(asset('static/img/logo/dark-mode-logo.svg')); ?>" alt="Logo" class="h-8 w-auto hidden dark:block">
            </a>
            <span
                class="text-gray-300 dark:text-gray-500 text-xxs font-semibold ml-4 hidden sm:block">v<?php echo e(env('APP_VERSION')); ?></span>
        </div>

        <div class="w-full flex items-center justify-end ml-auto sm:justify-between sm:gap-x-3 sm:order-3">

            <div class="flex grow justify-end flex-wrap items-center text-sm gap-x-2 text-gray-500 dark:text-gray-400">
                <a class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 font-medium rounded-full hover:bg-gray-100 dark:hover:bg-gray-800"
                   href="<?php echo e(route('admin.cache.clear')); ?>" data-tippy-content="Clear cache">
                    <?php if (isset($component)) { $__componentOriginal56804098dcf376a0e2227cb77b6cd00a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon','data' => ['name' => 'delete','class' => 'w-4 h-4','stroke' => 'currentColor','strokeWidth' => '1.75']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'delete','class' => 'w-4 h-4','stroke' => 'currentColor','stroke-width' => '1.75']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $attributes = $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $component = $__componentOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
                </a>
                <a href="<?php echo e(route('index')); ?>" target="_blank"
                   class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 font-medium rounded-full hover:bg-gray-100 dark:hover:bg-gray-800">
                    <?php if (isset($component)) { $__componentOriginal56804098dcf376a0e2227cb77b6cd00a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon','data' => ['name' => 'external','class' => 'w-4 h-4','stroke' => 'currentColor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'external','class' => 'w-4 h-4','stroke' => 'currentColor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $attributes = $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $component = $__componentOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
                </a>
                <input type="checkbox" name="light-switch" id="light-switch" class="light-switch sr-only"/>
                <label
                    class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 font-medium rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer"
                    for="light-switch">
                    <?php if (isset($component)) { $__componentOriginal56804098dcf376a0e2227cb77b6cd00a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon','data' => ['name' => 'moon-2','class' => 'w-4 h-4 dark:hidden','stroke' => 'currentColor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'moon-2','class' => 'w-4 h-4 dark:hidden','stroke' => 'currentColor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $attributes = $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $component = $__componentOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal56804098dcf376a0e2227cb77b6cd00a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon','data' => ['name' => 'sun-2','class' => 'w-4 h-4 dark:block hidden','stroke' => 'currentColor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sun-2','class' => 'w-4 h-4 dark:block hidden','stroke' => 'currentColor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $attributes = $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $component = $__componentOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
                </label>
                
                <!-- Notifications Bell -->
                <div class="relative inline-flex" x-data="notificationBell()" x-init="init()">
                    <button
                        class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 font-medium rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 relative"
                        @click.prevent="toggleDropdown"
                        aria-haspopup="true"
                        :aria-expanded="dropdownOpen">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span x-show="unreadCount > 0" 
                              x-text="unreadCount > 99 ? '99+' : unreadCount"
                              class="absolute -top-1 -right-1 flex items-center justify-center h-5 min-w-[1.25rem] px-1 text-xs font-bold text-white rounded-full"
                              style="background: <?php echo e(config('settings.theme_color', '#8B5CF6')); ?>">
                        </span>
                    </button>
                    
                    <!-- Notifications Dropdown -->
                    <div
                        x-show="dropdownOpen"
                        @click.outside="dropdownOpen = false"
                        @keydown.escape.window="dropdownOpen = false"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="origin-top-right z-50 absolute right-0 top-full mt-2 bg-white w-[32rem] max-w-[calc(100vw-2rem)] rounded-xl shadow-xl border border-gray-200 dark:bg-gray-950 dark:border-gray-800 overflow-hidden"
                        style="display: none;">
                        
                        <!-- Header -->
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                    <?php echo e(__('Notifications')); ?>

                                </h3>
                                <span x-show="unreadCount > 0" 
                                      x-text="unreadCount"
                                      class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold text-white rounded-full"
                                      style="background: <?php echo e(config('settings.theme_color', '#8B5CF6')); ?>">
                                </span>
                            </div>
                            <button 
                                x-show="unreadCount > 0"
                                @click="markAllAsRead"
                                class="text-xs font-semibold hover:underline transition-colors"
                                style="color: <?php echo e(config('settings.theme_color', '#8B5CF6')); ?>">
                                <?php echo e(__('Clear all')); ?>

                            </button>
                        </div>
                        
                        <!-- Notifications List -->
                        <div class="max-h-[28rem] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-700 bg-white dark:bg-gray-950">
                            <template x-if="notifications.length === 0">
                                <div class="px-6 py-12 text-center bg-white dark:bg-gray-950">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-900 mb-4">
                                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        <?php echo e(__('No new notifications')); ?>

                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <?php echo e(__("We'll notify you when something arrives")); ?>

                                    </p>
                                </div>
                            </template>
                            
                            <template x-for="notification in notifications" :key="notification.id">
                                <div 
                                    @click="handleNotificationClick(notification)"
                                    class="group relative px-5 py-3.5 border-b border-gray-100 dark:border-gray-800/50 cursor-pointer transition-all duration-150 bg-white dark:bg-gray-950"
                                    :class="{ 
                                        '!bg-blue-50 hover:!bg-blue-100 dark:!bg-blue-900/20 dark:hover:!bg-blue-800/30': !notification.read,
                                        'hover:!bg-gray-50 dark:hover:!bg-gray-900/70': notification.read 
                                    }">
                                    <div class="flex items-start gap-3.5">
                                        <!-- Icon -->
                                        <div class="flex-shrink-0">
                                            <div class="relative w-10 h-10 rounded-full flex items-center justify-center transition-transform group-hover:scale-110"
                                                 :class="notification.type === 'order' ? 'bg-green-100 dark:bg-green-900/20' : (notification.type === 'review' ? 'bg-yellow-100 dark:bg-yellow-900/20' : 'bg-blue-100 dark:bg-blue-900/20')">
                                                <template x-if="notification.type === 'order'">
                                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                </template>
                                                <template x-if="notification.type === 'user'">
                                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </template>
                                                <template x-if="notification.type === 'review'">
                                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                                    </svg>
                                                </template>
                                                <span x-show="!notification.read" class="absolute top-0 right-0 w-2.5 h-2.5 rounded-full border-2 border-white dark:border-gray-900" style="background: <?php echo e(config('settings.theme_color', '#8B5CF6')); ?>"></span>
                                            </div>
                                        </div>
                                        
                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 flex-nowrap">
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 whitespace-nowrap overflow-hidden text-ellipsis flex-shrink" x-text="notification.message"></p>
                                                <span x-show="notification.type === 'order'" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300 flex-shrink-0">
                                                    Order
                                                </span>
                                                <span x-show="notification.type === 'user'" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 flex-shrink-0">
                                                    User
                                                </span>
                                                <span x-show="notification.type === 'review'" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300 flex-shrink-0">
                                                    Review
                                                </span>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap flex-shrink-0" x-text="notification.created_at"></p>
                                            </div>
                                        </div>
                                        
                                        <!-- Dismiss button -->
                                        <button 
                                            @click.stop="markAsRead(notification.id)"
                                            class="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity p-1 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-700">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                        
                        <!-- View All Link -->
                        <div x-show="notifications.length > 0" class="border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50">
                            <a href="<?php echo e(route('admin.notifications.page')); ?>" 
                               class="block px-5 py-3 text-center text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-800/50 transition-colors"
                               style="color: <?php echo e(config('settings.theme_color', '#8B5CF6')); ?>">
                                <?php echo e(__('View all notifications')); ?>

                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="w-px h-5 bg-gray-200 hidden lg:block mx-4 dark:bg-gray-800"></div>
                <!-- User button -->
                <div class="relative inline-flex" x-data="{ open: false }">
                    <button
                        class="inline-flex justify-center items-center group"
                        aria-haspopup="true"
                        @click.prevent="open = !open" :aria-expanded="open" aria-expanded="false">
                        <?php echo gravatar(Auth::user()->name,Auth::user()->avatarurl,'h-8 w-8 rounded-full bg-primary-500 text-xs font-bold flex items-center justify-center text-white'); ?>

                    </button>
                    <div
                        class="origin-top-right z-10 absolute inset-x-0 top-full mt-3 bg-white py-6 w-56 px-3 left-auto right-0 lg:-mr-1.5 lg:rounded-lg rounded-lg shadow-lg border border-gray-100 text-sm divide-y divide-gray-100 dark:bg-gray-900 dark:border-gray-900"
                        @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
                        x-transition:enter="transition ease-out duration-200 transform"
                        x-transition:enter-start="opacity-0 -trangray-y-2"
                        x-transition:enter-end="opacity-100 trangray-y-0"
                        x-transition:leave="transition ease-out duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" style="display: none;">

                        <div class="">

                            <a class="w-full py-2.5 px-6 inline-flex items-center gap-5 text-sm text-center text-gray-500 rounded-lg hover:bg-gray-50 relative after:absolute after:-bottom-2 after:rounded-full after:left-0 after:right-0 after:h-0.5 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:bg-gray-700/50"
                               href="<?php echo e(route('logout')); ?>">
                                <?php echo e(__('Logout')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/admin/partials/navbar.blade.php ENDPATH**/ ?>