@extends('layouts.admin')
@section('content')
    <div class="container-fluid" x-data="notificationsPage()">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{__('Notifications')}}
                    </h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{__('Manage all your notifications')}}
                    </p>
                </div>
                
                <div class="flex items-center gap-3">
                    <span x-show="unreadCount > 0" 
                          class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                        <span x-text="unreadCount"></span>
                        <span class="ml-1" x-text="unreadCount === 1 ? 'unread' : 'unread'"></span>
                    </span>
                    
                    <button 
                        x-show="unreadCount > 0"
                        @click="markAllAsRead"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white rounded-lg transition-all duration-200 hover:opacity-90"
                        style="background: {{ config('settings.theme_color', '#8B5CF6') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{__('Mark all as read')}}
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="-mb-px flex gap-6">
                    <button 
                        @click="currentFilter = 'all'; loadNotifications()"
                        class="py-3 px-1 border-b-2 font-medium text-sm transition-colors"
                        :class="currentFilter === 'all' ? 'border-current text-gray-900 dark:text-gray-100' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                        :style="currentFilter === 'all' ? 'color: {{ config('settings.theme_color', '#8B5CF6') }}; border-color: {{ config('settings.theme_color', '#8B5CF6') }}' : ''">
                        {{__('All')}}
                        <span x-show="stats.all > 0" x-text="'(' + stats.all + ')'" class="ml-1"></span>
                    </button>
                    
                    <button 
                        @click="currentFilter = 'unread'; loadNotifications()"
                        class="py-3 px-1 border-b-2 font-medium text-sm transition-colors"
                        :class="currentFilter === 'unread' ? 'border-current text-gray-900 dark:text-gray-100' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                        :style="currentFilter === 'unread' ? 'color: {{ config('settings.theme_color', '#8B5CF6') }}; border-color: {{ config('settings.theme_color', '#8B5CF6') }}' : ''">
                        {{__('Unread')}}
                        <span x-show="unreadCount > 0" x-text="'(' + unreadCount + ')'" class="ml-1"></span>
                    </button>
                    
                    <button 
                        @click="currentFilter = 'read'; loadNotifications()"
                        class="py-3 px-1 border-b-2 font-medium text-sm transition-colors"
                        :class="currentFilter === 'read' ? 'border-current text-gray-900 dark:text-gray-100' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                        :style="currentFilter === 'read' ? 'color: {{ config('settings.theme_color', '#8B5CF6') }}; border-color: {{ config('settings.theme_color', '#8B5CF6') }}' : ''">
                        {{__('Read')}}
                        <span x-show="stats.read > 0" x-text="'(' + stats.read + ')'" class="ml-1"></span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
            <!-- Loading State -->
            <div x-show="loading" class="py-12 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                    <svg class="animate-spin w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{__('Loading notifications...')}}</p>
            </div>

            <!-- Empty State -->
            <div x-show="!loading && notifications.length === 0" class="py-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{__('No notifications')}}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="currentFilter === 'unread' ? '{{__('All caught up!')}}' : '{{__('No notifications to show')}}'"></p>
            </div>

            <!-- Notifications -->
            <div x-show="!loading && notifications.length > 0">
                <template x-for="notification in notifications" :key="notification.id">
                    <a 
                        :href="getNotificationLink(notification)"
                        @click="!notification.read && markAsRead(notification.id)"
                        class="group relative border-b border-gray-100 dark:border-gray-800 last:border-b-0 transition-all duration-150 block"
                        :class="{
                            'bg-blue-50/50 hover:bg-blue-100 dark:bg-blue-900/20 dark:hover:bg-blue-800/40': !notification.read,
                            'bg-white hover:bg-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800/50': notification.read
                        }">
                        
                        <div class="flex items-start gap-4 p-5">
                            <!-- Icon -->
                            <div class="flex-shrink-0">
                                <div class="relative w-12 h-12 rounded-full flex items-center justify-center"
                                     :class="notification.type === 'order' ? 'bg-green-100 dark:bg-green-900/20' : (notification.type === 'review' ? 'bg-yellow-100 dark:bg-yellow-900/20' : 'bg-blue-100 dark:bg-blue-900/20')">
                                    <template x-if="notification.type === 'order'">
                                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </template>
                                    <template x-if="notification.type === 'user'">
                                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </template>
                                    <template x-if="notification.type === 'review'">
                                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </template>
                                    <span x-show="!notification.read" class="absolute -top-1 -right-1 w-3 h-3 rounded-full border-2 border-white dark:border-gray-900" style="background: {{ config('settings.theme_color', '#8B5CF6') }}"></span>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-1 group-hover:underline" x-text="notification.message"></p>
                                        
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span x-show="notification.type === 'order'" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">
                                                {{__('Order')}}
                                            </span>
                                            <span x-show="notification.type === 'user'" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                                {{__('User')}}
                                            </span>
                                            <span x-show="notification.type === 'review'" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300">
                                                {{__('Review')}}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400" x-text="notification.created_at"></span>
                                        </div>
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <button 
                                            x-show="!notification.read"
                                            @click.prevent.stop="markAsRead(notification.id)"
                                            class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-800 transition-colors"
                                            title="{{__('Mark as read')}}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                        
                                        <button 
                                            @click.prevent.stop="deleteNotification(notification.id)"
                                            class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:text-red-400 dark:hover:bg-red-900/20 transition-colors"
                                            title="{{__('Delete')}}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </template>
            </div>

            <!-- Pagination -->
            <div x-show="!loading && pagination.last_page > 1" class="px-6 py-4 border-t border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span x-text="'Showing ' + pagination.from + ' to ' + pagination.to + ' of ' + pagination.total + ' notifications'"></span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <button 
                            @click="loadPage(pagination.current_page - 1)"
                            :disabled="pagination.current_page === 1"
                            class="px-3 py-1.5 text-sm font-medium rounded-lg border transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            :class="pagination.current_page === 1 ? 'border-gray-200 dark:border-gray-700 text-gray-400 dark:text-gray-500' : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'">
                            {{__('Previous')}}
                        </button>
                        
                        <div class="flex items-center gap-1">
                            <template x-for="page in getPageNumbers()" :key="page">
                                <button 
                                    @click="typeof page === 'number' ? loadPage(page) : null"
                                    :disabled="page === '...'"
                                    class="w-8 h-8 text-sm font-medium rounded-lg transition-colors disabled:cursor-default"
                                    :class="page === pagination.current_page ? 'text-white' : (page === '...' ? 'text-gray-400 dark:text-gray-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700')"
                                    :style="page === pagination.current_page ? 'background: {{ config('settings.theme_color', '#8B5CF6') }}' : ''"
                                    x-text="page">
                                </button>
                            </template>
                        </div>
                        
                        <button 
                            @click="loadPage(pagination.current_page + 1)"
                            :disabled="pagination.current_page === pagination.last_page"
                            class="px-3 py-1.5 text-sm font-medium rounded-lg border transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            :class="pagination.current_page === pagination.last_page ? 'border-gray-200 dark:border-gray-700 text-gray-400 dark:text-gray-500' : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'">
                            {{__('Next')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function notificationsPage() {
            return {
                notifications: [],
                loading: true,
                currentFilter: 'all',
                unreadCount: 0,
                stats: {
                    all: 0,
                    read: 0,
                    unread: 0
                },
                pagination: {
                    current_page: 1,
                    last_page: 1,
                    from: 0,
                    to: 0,
                    total: 0,
                    per_page: 5
                },
                
                init() {
                    this.loadNotifications();
                    this.getUnreadCount();
                },
                
                async loadNotifications(page = 1) {
                    this.loading = true;
                    try {
                        const response = await fetch(`/admin/notifications/all?page=${page}&per_page=${this.pagination.per_page}&filter=${this.currentFilter}`);
                        const data = await response.json();
                        
                        if (data.success) {
                            this.notifications = data.notifications.data;
                            this.pagination = {
                                current_page: data.notifications.current_page,
                                last_page: data.notifications.last_page,
                                from: data.notifications.from || 0,
                                to: data.notifications.to || 0,
                                total: data.notifications.total,
                                per_page: data.notifications.per_page
                            };
                            
                            this.updateStats();
                        }
                    } catch (error) {
                        console.error('Error loading notifications:', error);
                    } finally {
                        this.loading = false;
                    }
                },
                
                async getUnreadCount() {
                    try {
                        const response = await fetch('/admin/notifications/unread-count');
                        const data = await response.json();
                        if (data.success) {
                            this.unreadCount = data.unread_count;
                        }
                    } catch (error) {
                        console.error('Error getting unread count:', error);
                    }
                },
                
                async markAsRead(notificationId) {
                    try {
                        const response = await fetch(`/admin/notifications/${notificationId}/mark-as-read`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        
                        const data = await response.json();
                        if (data.success) {
                            const notification = this.notifications.find(n => n.id === notificationId);
                            if (notification) {
                                notification.read = true;
                            }
                            this.unreadCount = data.unread_count;
                            this.updateStats();
                            
                            if (this.currentFilter === 'unread') {
                                this.notifications = this.notifications.filter(n => n.id !== notificationId);
                            }
                        }
                    } catch (error) {
                        console.error('Error marking notification as read:', error);
                    }
                },
                
                async markAllAsRead() {
                    try {
                        const response = await fetch('/admin/notifications/mark-all-as-read', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        
                        const data = await response.json();
                        if (data.success) {
                            this.notifications.forEach(n => n.read = true);
                            this.unreadCount = 0;
                            this.updateStats();
                            
                            if (this.currentFilter === 'unread') {
                                this.loadNotifications();
                            }
                        }
                    } catch (error) {
                        console.error('Error marking all as read:', error);
                    }
                },
                
                async deleteNotification(notificationId) {
                    if (!confirm('{{__('Are you sure you want to delete this notification?')}}')) {
                        return;
                    }
                    
                    try {
                        const response = await fetch(`/admin/notifications/${notificationId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        
                        const data = await response.json();
                        if (data.success) {
                            this.notifications = this.notifications.filter(n => n.id !== notificationId);
                            this.unreadCount = data.unread_count;
                            this.pagination.total--;
                            this.updateStats();
                            
                            if (this.notifications.length === 0 && this.pagination.current_page > 1) {
                                this.loadPage(this.pagination.current_page - 1);
                            }
                        }
                    } catch (error) {
                        console.error('Error deleting notification:', error);
                    }
                },
                
                updateStats() {
                    this.stats.all = this.pagination.total;
                    this.stats.unread = this.unreadCount;
                    this.stats.read = this.stats.all - this.stats.unread;
                },
                
                loadPage(page) {
                    if (page >= 1 && page <= this.pagination.last_page) {
                        this.loadNotifications(page);
                    }
                },
                
                getPageNumbers() {
                    const pages = [];
                    const currentPage = this.pagination.current_page;
                    const lastPage = this.pagination.last_page;
                    
                    if (lastPage <= 7) {
                        for (let i = 1; i <= lastPage; i++) {
                            pages.push(i);
                        }
                    } else {
                        pages.push(1);
                        
                        if (currentPage > 3) {
                            pages.push('...');
                        }
                        
                        for (let i = Math.max(2, currentPage - 1); i <= Math.min(lastPage - 1, currentPage + 1); i++) {
                            pages.push(i);
                        }
                        
                        if (currentPage < lastPage - 2) {
                            pages.push('...');
                        }
                        
                        pages.push(lastPage);
                    }
                    
                    return pages;
                },
                
                getNotificationLink(notification) {
                    if (notification.data.url) {
                        return notification.data.url;
                    }
                    if (notification.type === 'order') {
                        const orderId = notification.data.payment_id;
                        if (orderId) {
                            return `/admin/payment/${orderId}/edit`;
                        }
                    } else if (notification.type === 'user' && notification.data.user_id) {
                        return `/admin/user/${notification.data.user_id}/edit`;
                    } else if (notification.type === 'review') {
                        return '/admin/testimonials';
                    }
                    return '#';
                }
            };
        }
    </script>
@endsection
