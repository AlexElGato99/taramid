@extends('layouts.auth')
@section('content')
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            @if(setting('logo'))
                <a href="{{ url('/') }}" class="inline-block mb-6">
                    <img src="{{ asset('static/img/' . setting('logo')) }}" alt="{{ setting('site_name', 'Taramide') }}" class="h-8 object-contain mx-auto">
                </a>
            @endif
            <h1 class="font-display text-3xl text-ink mb-2">{{__('Welcome Back')}}</h1>
            <p class="text-sm text-ash">{{__('Sign in to access your dashboard')}}</p>
        </div>

        <div class="bg-white rounded-2xl border border-border shadow-sm p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-ink mb-1.5">{{__('Email Address')}}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           placeholder="{{__('you@example.com')}}"
                           class="w-full px-4 py-3 rounded-xl border border-border bg-white text-ink text-sm placeholder:text-ash/50 focus:outline-none focus:ring-2 focus:ring-[var(--btn-color,#2B5F3F)]/20 focus:border-[var(--btn-color,#2B5F3F)] transition-colors">
                    <x-form.error :messages="$errors->get('email')" class="mt-1"/>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-medium text-ink">{{__('Password')}}</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-medium text-[var(--btn-color,#2B5F3F)] hover:underline">
                                {{__('Forgot password?')}}
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           placeholder="{{__('Enter your password')}}"
                           class="w-full px-4 py-3 rounded-xl border border-border bg-white text-ink text-sm placeholder:text-ash/50 focus:outline-none focus:ring-2 focus:ring-[var(--btn-color,#2B5F3F)]/20 focus:border-[var(--btn-color,#2B5F3F)] transition-colors">
                    <x-form.error :messages="$errors->get('password')" class="mt-1"/>
                </div>

                <input type="hidden" name="remember" value="1">

                <button type="submit" class="btn-fill w-full py-3 text-sm font-semibold rounded-xl">
                    {{__('Sign In')}}
                </button>
            </form>

            @if(setting('register') != 'disable' AND env('GOOGLE_CLIENT_ID'))
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-border"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-3 bg-white text-ash">{{__('Or continue with')}}</span>
                    </div>
                </div>

                <a href="{{route('auth.google')}}"
                   class="w-full inline-flex items-center justify-center gap-2.5 px-4 py-3 border border-border rounded-xl text-sm font-medium text-ink bg-white hover:bg-sand/30 transition-colors">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M113.47 309.408 95.648 375.94l-65.139 1.378C11.042 341.211 0 299.9 0 256c0-42.451 10.324-82.483 28.624-117.732h.014L86.63 148.9l25.404 57.644c-5.317 15.501-8.215 32.141-8.215 49.456.002 18.792 3.406 36.797 9.651 53.408z" fill="#fbbb00"/>
                        <path d="M507.527 208.176C510.467 223.662 512 239.655 512 256c0 18.328-1.927 36.206-5.598 53.451-12.462 58.683-45.025 109.925-90.134 146.187l-.014-.014-73.044-3.727-10.338-64.535c29.932-17.554 53.324-45.025 65.646-77.911h-136.89V208.176h245.899z" fill="#518ef8"/>
                        <path d="m416.253 455.624.014.014C372.396 490.901 316.666 512 256 512c-97.491 0-182.252-54.491-225.491-134.681l82.961-67.91c21.619 57.698 77.278 98.771 142.53 98.771 28.047 0 54.323-7.582 76.87-20.818l83.383 68.262z" fill="#28b446"/>
                        <path d="m419.404 58.936-82.933 67.896C313.136 112.246 285.552 103.82 256 103.82c-66.729 0-123.429 42.957-143.965 102.724l-83.397-68.276h-.014C71.23 56.123 157.06 0 256 0c62.115 0 119.068 22.126 163.404 58.936z" fill="#f14336"/>
                    </svg>
                    {{__('Sign in with Google')}}
                </a>
            @endif
        </div>

        <p class="text-center text-xs text-ash mt-6">
            <a href="{{ url('/') }}" class="hover:text-ink transition-colors">&larr; {{__('Back to website')}}</a>
        </p>
    </div>
@endsection
