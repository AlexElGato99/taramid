<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if(isset($config['title'])){{$config['title']}}@else{{setting('title')}}@endif</title>
        @php $favV = setting('favicon_version', '1'); $favType = setting('favicon_type', 'png'); @endphp
        @if($favType === 'svg' && file_exists(public_path('favicon/favicon.svg')))
        <link rel="icon" type="image/svg+xml" href="{{asset('favicon/favicon.svg')}}?v={{ $favV }}">
        @endif
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}?v={{ $favV }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}?v={{ $favV }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}?v={{ $favV }}">
        <link rel="manifest" href="{{asset('site.webmanifest')}}?v={{ $favV }}">
        
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                500: '#2563eb',
                            }
                        }
                    }
                }
            }
        </script>
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <script>
            if (localStorage.getItem('dark-mode') == 'true' || !('dark-mode' in localStorage)) {
                document.querySelector('html').classList.add('dark');
            } else {
                document.querySelector('html').classList.remove('dark');
            }
        </script>
        <style>
            :root {

            @if(setting('palette'))
                @foreach(config('attr.colors.'.setting('palette')) as $color => $value)
                    {{'--color-gray-'.$color.':'.hexToRgb('#'.$value)}};
            @endforeach
        @else
            @foreach(config('attr.colors.zinc') as $color => $value)
                {{'--color-gray-'.$color.':'.hexToRgb('#'.$value)}};
                @endforeach
            @endif
--color-primary-500: @if(setting('color')){{hexToRgb(setting('color'))}}@else{{hexToRgb('#6366f1')}}@endif;
            }
        </style>
        @include('partials.theme-colors')
        
        <!-- Custom Scrollbar Styling -->
        <style>
            /* Admin compact sizing (excludes Quill editor) */
            .lg\:pl-60 h1:not(.ql-editor h1), .lg\:pl-60 .text-2xl { font-size: 1.25rem; line-height: 1.75rem; }
            .lg\:pl-60 h2:not(.ql-editor h2), .lg\:pl-60 .text-xl { font-size: 1.1rem; line-height: 1.5rem; }
            .lg\:pl-60 h3:not(.ql-editor h3), .lg\:pl-60 .text-lg { font-size: 0.95rem; line-height: 1.35rem; }
            .lg\:pl-60 table { font-size: 0.8rem; }
            .lg\:pl-60 table th { padding: 0.5rem 0.75rem; font-size: 0.7rem; }
            .lg\:pl-60 table td { padding: 0.5rem 0.75rem; }
            .lg\:pl-60 .text-sm { font-size: 0.8rem; line-height: 1.15rem; }
            .lg\:pl-60 label, .lg\:pl-60 .text-xs { font-size: 0.7rem; }
            .lg\:pl-60 input:not([type="checkbox"]):not([type="radio"]):not(.ql-toolbar input):not(.ql-editor input), .lg\:pl-60 select:not(.ql-toolbar select), .lg\:pl-60 textarea:not(.ql-editor textarea) { font-size: 0.8rem; padding: 0.4rem 0.65rem; }
            .lg\:pl-60 input[type="checkbox"].shrink-0 { padding: 0 !important; width: 2.75rem !important; height: 1.5rem !important; min-width: 2.75rem; }
            .lg\:pl-60 .paygate-checkbox, .lg\:pl-60 .paygate-radio { padding: 0 !important; }
            .lg\:pl-60 .px-6 { padding-left: 1rem; padding-right: 1rem; }
            .lg\:pl-60 .py-6 { padding-top: 1.15rem; padding-bottom: 1.15rem; }
            .lg\:pl-60 .p-6 { padding: 1.15rem; }
            .lg\:pl-60 .mb-6 { margin-bottom: 1.15rem; }
            .lg\:pl-60 .gap-6 { gap: 1.15rem; }

            /* Quill editor reset - undo Tailwind CDN preflight */
            .ql-toolbar.ql-snow svg { display: inline-block !important; width: 18px !important; height: 18px !important; }
            .ql-toolbar.ql-snow button { display: inline-block !important; width: 28px !important; height: 24px !important; padding: 3px 5px !important; float: left; }
            .ql-toolbar.ql-snow .ql-formats { display: inline-block !important; vertical-align: middle; margin-right: 15px; }
            .ql-toolbar.ql-snow .ql-picker { display: inline-block !important; float: left; }
            .ql-toolbar.ql-snow .ql-picker-label { display: inline-block !important; }
            .ql-toolbar.ql-snow .ql-picker-label svg { width: 18px !important; height: 18px !important; }
            .ql-toolbar.ql-snow .ql-picker-options { padding: 4px 8px !important; }
            .ql-snow .ql-editor img { display: inline-block !important; max-width: 100%; }
            .ql-snow .ql-editor { font-size: 1rem !important; padding: 12px 15px !important; }
            .ql-snow .ql-editor h1 { font-size: 2em !important; font-weight: bold; margin-bottom: 0.5em; line-height: 1.3 !important; }
            .ql-snow .ql-editor h2 { font-size: 1.5em !important; font-weight: bold; margin-bottom: 0.5em; line-height: 1.3 !important; }
            .ql-snow .ql-editor h3 { font-size: 1.17em !important; font-weight: bold; margin-bottom: 0.5em; line-height: 1.3 !important; }

            /* Quill dark mode toolbar colors */
            .dark .ql-toolbar .ql-stroke { stroke: #d1d5db !important; }
            .dark .ql-toolbar .ql-fill { fill: #d1d5db !important; }
            .dark .ql-toolbar .ql-picker-label { color: #d1d5db !important; }
            .dark .ql-toolbar .ql-picker-options { background: #374151 !important; }
            .dark .ql-toolbar .ql-picker-item { color: #d1d5db !important; }
            .dark .ql-toolbar button:hover .ql-stroke,
            .dark .ql-toolbar .ql-picker-label:hover .ql-stroke { stroke: #fff !important; }
            .dark .ql-toolbar button:hover .ql-fill,
            .dark .ql-toolbar .ql-picker-label:hover .ql-fill { fill: #fff !important; }
            .dark .ql-toolbar button.ql-active .ql-stroke { stroke: #60a5fa !important; }
            .dark .ql-toolbar button.ql-active .ql-fill { fill: #60a5fa !important; }
            .dark .ql-editor.ql-blank::before { color: #9ca3af !important; }
            .dark .ql-snow .ql-editor { color: #fff !important; }
            .dark #quill-editor { background: #374151 !important; border-color: #4b5563 !important; color: #fff !important; }
            .dark .ql-toolbar.ql-snow { border-color: #4b5563 !important; background: #1f2937 !important; }

            /* Sidebar Navigation Scrollbar */
            #sidebar ul::-webkit-scrollbar {
                width: 6px;
            }
            
            #sidebar ul::-webkit-scrollbar-track {
                background: transparent;
            }
            
            #sidebar ul::-webkit-scrollbar-thumb {
                background: rgba(156, 163, 175, 0.4);
                border-radius: 10px;
                transition: background 0.2s ease;
            }
            
            #sidebar ul::-webkit-scrollbar-thumb:hover {
                background: rgba(156, 163, 175, 0.6);
            }
            
            /* Dark mode scrollbar */
            html.dark #sidebar ul::-webkit-scrollbar-thumb {
                background: rgba(107, 114, 128, 0.5);
            }
            
            html.dark #sidebar ul::-webkit-scrollbar-thumb:hover {
                background: rgba(107, 114, 128, 0.7);
            }
        </style>
        @stack('styles')
    </head>
    <body class="min-h-screen bg-white dark:bg-gray-950" x-data="{'sidebarToggle': false, cookiePolicy: localStorage.getItem('cookiePolicy')}" x-bind:class="{ 'false': cookiePolicy }" x-init="$watch('cookiePolicy', val => localStorage.setItem('cookiePolicy', val))">

        @include('admin.partials.sidenav')
        <div class="flex flex-col">
            @include('admin.partials.navbar')
            <div class="w-full pb-6 md:px-6 lg:pl-60">
                @yield('content')
            </div>
        </div>
        <script src="{{asset('static/js/lazysizes.js')}}" onerror="console.log('lazysizes not found')"></script>
        @include('admin.partials.scripts')
        @stack('javascript')
        
        <script>
            function notificationBell() {
                return {
                    dropdownOpen: false,
                    notifications: [],
                    unreadCount: 0,
                    pollingInterval: null,

                    init() {
                        this.fetchNotifications();
                        // Poll for new notifications every 30 seconds
                        this.pollingInterval = setInterval(() => {
                            this.fetchNotifications();
                        }, 30000);
                    },

                    toggleDropdown() {
                        this.dropdownOpen = !this.dropdownOpen;
                        if (this.dropdownOpen) {
                            this.fetchNotifications();
                        }
                    },

                    async fetchNotifications() {
                        try {
                            const response = await fetch('{{ route("admin.notifications.index") }}', {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });
                            
                            if (response.ok) {
                                const data = await response.json();
                                this.notifications = data.notifications;
                                this.unreadCount = data.unread_count;
                            }
                        } catch (error) {
                            console.error('Error fetching notifications:', error);
                        }
                    },

                    async markAsRead(notificationId) {
                        try {
                            const response = await fetch(`{{ route("admin.notifications.mark-as-read", ":id") }}`.replace(':id', notificationId), {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });
                            
                            if (response.ok) {
                                const data = await response.json();
                                this.unreadCount = data.unread_count;
                                // Remove the notification from the list
                                this.notifications = this.notifications.filter(n => n.id !== notificationId);
                            }
                        } catch (error) {
                            console.error('Error marking notification as read:', error);
                        }
                    },

                    async markAllAsRead() {
                        try {
                            const response = await fetch('{{ route("admin.notifications.mark-all-as-read") }}', {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });
                            
                            if (response.ok) {
                                this.unreadCount = 0;
                                this.notifications = [];
                                this.dropdownOpen = false;
                            }
                        } catch (error) {
                            console.error('Error marking all notifications as read:', error);
                        }
                    },

                    handleNotificationClick(notification) {
                        // Mark as read if unread
                        if (!notification.read) {
                            this.markAsRead(notification.id);
                        }
                        
                        // Navigate using the URL from notification data
                        if (notification.data.url) {
                            window.location.href = notification.data.url;
                        } else if (notification.type === 'order' && notification.data.payment_id) {
                            window.location.href = `/admin/payment/${notification.data.payment_id}/edit`;
                        } else if (notification.type === 'user' && notification.data.user_id) {
                            window.location.href = `/admin/user/${notification.data.user_id}/edit`;
                        } else if (notification.type === 'review') {
                            window.location.href = '/admin/testimonials';
                        }
                        
                        // Close dropdown after navigation
                        this.dropdownOpen = false;
                    },

                    destroy() {
                        if (this.pollingInterval) {
                            clearInterval(this.pollingInterval);
                        }
                    }
                }
            }
        </script>
    </body>
</html>
