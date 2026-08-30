@extends('layouts.auth')
@section('content')
    <div class="max-w-lg mx-auto w-full px-4 my-6">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full mb-2" 
                         style="background: linear-gradient(135deg, {{ setting('color', '#f27e1f') }} 0%, {{ setting('icon_color', '#3791a1') }} 100%);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1.5">{{__('Create Account')}}</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{__('Join us today and get started')}}
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-form.label for="name" :value="__('Full Name')" class="text-sm font-semibold"/>
                        <div class="mt-1.5 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <x-form.input id="name" 
                                          class="block w-full pl-12" 
                                          style="border-radius: 0.75rem; padding-top: 0.875rem; padding-bottom: 0.875rem;"
                                          type="text" 
                                          name="name" 
                                          :value="old('name')"
                                          required 
                                          autofocus 
                                          autocomplete="name" 
                                          placeholder="{{__('Enter your full name')}}"/>
                        </div>
                        <x-form.error :messages="$errors->get('name')" class="mt-1"/>
                    </div>

                    <div>
                        <x-form.label for="username" :value="__('Username')" class="text-sm font-semibold"/>
                        <div class="mt-1.5 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                </svg>
                            </div>
                            <x-form.input id="username" 
                                          class="block w-full pl-12" 
                                          style="border-radius: 0.75rem; padding-top: 0.875rem; padding-bottom: 0.875rem;"
                                          type="text" 
                                          name="username" 
                                          :value="old('username')"
                                          required 
                                          placeholder="{{__('Choose a username')}}"/>
                        </div>
                        <x-form.error :messages="$errors->get('username')" class="mt-1"/>
                    </div>

                    <div>
                        <x-form.label for="email" :value="__('Email Address')" class="text-sm font-semibold"/>
                        <div class="mt-1.5 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <x-form.input id="email" 
                                          class="block w-full pl-12" 
                                          style="border-radius: 0.75rem; padding-top: 0.875rem; padding-bottom: 0.875rem;"
                                          type="email" 
                                          name="email" 
                                          :value="old('email')"
                                          required 
                                          autocomplete="username" 
                                          placeholder="{{__('Enter your email')}}"/>
                        </div>
                        <x-form.error :messages="$errors->get('email')" class="mt-1"/>
                    </div>

                    <div>
                        <x-form.label for="password" :value="__('Password')" class="text-sm font-semibold"/>
                        <div class="mt-1.5 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <x-form.input id="password" 
                                          class="block w-full pl-12"
                                          style="border-radius: 0.75rem; padding-top: 0.875rem; padding-bottom: 0.875rem;"
                                          type="password"
                                          name="password"
                                          required 
                                          autocomplete="new-password" 
                                          placeholder="{{__('Create a strong password')}}"/>
                        </div>
                        <x-form.error :messages="$errors->get('password')" class="mt-1"/>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                                class="w-full flex items-center justify-center px-5 py-3.5 text-sm font-semibold text-white rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                                style="background: linear-gradient(135deg, {{ setting('color', '#f27e1f') }} 0%, {{ setting('icon_color', '#3791a1') }} 100%); padding-top: 0.875rem; padding-bottom: 0.875rem;"
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            {{ __('Create Account') }}
                        </button>
                    </div>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-800 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{__("Already have an account?")}}
                        <a href="{{route('login')}}" 
                           class="font-semibold hover:underline ml-1"
                           style="color: {{ setting('color', '#f27e1f') }};">
                            {{__('Sign In')}}
                        </a>
                    </p>
                </div>

                @if(setting('register') != 'disable' AND env('GOOGLE_CLIENT_ID'))
                    <div class="mt-4">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200 dark:border-gray-800"></div>
                            </div>
                            <div class="relative flex justify-center text-xs">
                                <span class="px-3 bg-white dark:bg-gray-900 text-gray-500 dark:text-gray-400">{{__('Or sign up with')}}</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{route('auth.google')}}" 
                               class="w-full inline-flex items-center justify-center px-5 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-200"
                               style="padding-top: 0.875rem; padding-bottom: 0.875rem;">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M113.47 309.408 95.648 375.94l-65.139 1.378C11.042 341.211 0 299.9 0 256c0-42.451 10.324-82.483 28.624-117.732h.014L86.63 148.9l25.404 57.644c-5.317 15.501-8.215 32.141-8.215 49.456.002 18.792 3.406 36.797 9.651 53.408z" fill="#fbbb00"/>
                                    <path d="M507.527 208.176C510.467 223.662 512 239.655 512 256c0 18.328-1.927 36.206-5.598 53.451-12.462 58.683-45.025 109.925-90.134 146.187l-.014-.014-73.044-3.727-10.338-64.535c29.932-17.554 53.324-45.025 65.646-77.911h-136.89V208.176h245.899z" fill="#518ef8"/>
                                    <path d="m416.253 455.624.014.014C372.396 490.901 316.666 512 256 512c-97.491 0-182.252-54.491-225.491-134.681l82.961-67.91c21.619 57.698 77.278 98.771 142.53 98.771 28.047 0 54.323-7.582 76.87-20.818l83.383 68.262z" fill="#28b446"/>
                                    <path d="m419.404 58.936-82.933 67.896C313.136 112.246 285.552 103.82 256 103.82c-66.729 0-123.429 42.957-143.965 102.724l-83.397-68.276h-.014C71.23 56.123 157.06 0 256 0c62.115 0 119.068 22.126 163.404 58.936z" fill="#f14336"/>
                                </svg>
                                {{ __('Sign up with Google') }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
