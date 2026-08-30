@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <x-form.layout>
            <form method="post"
                  x-data="{ type: '@if(isset($listing->type)){{$listing->type}}@else{{'subscribe'}}@endif' }">
                @csrf

                <div class="mb-4">

                    <x-form.label for="name" :value="__('Name')"/>
                    <x-form.input id="name" name="name" type="text" class="mt-1 block w-full"
                                  :value="old('name', $listing->name ?? '')" required placeholder="{{__('Name')}}"/>
                    <x-form.error class="mt-2" :messages="$errors->get('name')"/>
                </div>

                <div class="mb-4">

                    <x-form.label for="email" :value="__('Email')"/>
                    <x-form.input id="email" name="email" type="email" class="mt-1 block w-full"
                                  :value="old('email', $listing->email ?? '')" required
                                  placeholder="{{__('Email')}}"/>
                    <x-form.error class="mt-2" :messages="$errors->get('email')"/>
                </div>
                <div class="mb-4">
                    <x-form.label for="username" :value="__('Username')"/>
                    <x-form.input id="username" name="username" type="text" class="mt-1 block w-full"
                                  :value="old('username', $listing->username ?? '')" required
                                  placeholder="{{__('Username')}}"/>
                    <x-form.error class="mt-2" :messages="$errors->get('username')"/>
                </div>
                <div class="mb-4">
                    <x-form.label for="account_type" :value="__('Account type')"/>
                    <x-form.select name="account_type">
                        <option value="user"
                                @if(isset($listing->account_type) AND $listing->account_type == 'user') selected @endif>{{__('User')}}</option>
                        <option value="admin"
                                @if(isset($listing->account_type) AND $listing->account_type == 'admin') selected @endif>{{__('Admin')}}</option>
                    </x-form.select>
                    <x-form.error class="mt-2" :messages="$errors->get('account_type')"/>
                </div>
                @if(empty($listing->id))
                    <div class="mb-4">
                        <x-form.label for="password" :value="__('Password')"/>
                        <x-form.input id="password" name="password" type="password" class="mt-1 block w-full"
                                      autocomplete="password" required placeholder="{{__('Password')}}"/>
                        <x-form.error class="mt-2" :messages="$errors->get('password')"/>
                        <div
                            class="mt-3 text-sm text-gray-400 dark:text-gray-300">{{__('Leave empty if you don\'t want to change it')}}</div>
                    </div>
                @endif

                <div class="mb-4">

                    <x-form.label for="about" :value="__('About')"/>
                    <x-form.textarea id="about" name="about"
                                     placeholder="{{__('About')}}">{{old('about') ?? ($listing->about ?? null)}}</x-form.textarea>
                    <x-form.error class="mt-2" :messages="$errors->get('about')"/>
                </div>

                @if(isset($listing->id))
                    <hr class="my-4 lg:my-6 border-gray-100 dark:border-gray-800">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-10">
                        <div class="mb-4 lg:col-span-12">

                            <x-form.label for="address" :value="__('Address')"/>
                            <x-form.input id="address" name="billing[address]" type="text" class="mt-1 block w-full"
                                          :value="old('address') ?? ($listing->billing->address ?? null)"
                                          placeholder="{{__('Address')}}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('address')"/>
                        </div>
                        <div class="mb-4 lg:col-span-4">

                            <x-form.label for="city" :value="__('City')"/>
                            <x-form.input id="city" name="billing[city]" type="text" class="mt-1 block w-full"
                                          :value="old('city') ?? ($listing->billing->city ?? null)"
                                          placeholder="{{__('City')}}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('city')"/>
                        </div>
                        <div class="mb-4 lg:col-span-4">

                            <x-form.label for="zip_code" :value="__('Postal code')"/>
                            <x-form.input id="zip_code" name="billing[zip_code]" type="text"
                                          class="mt-1 block w-full"
                                          :value="old('zip_code') ?? ($listing->billing->zip_code ?? null)"
                                          placeholder="{{__('Postal code')}}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('zip_code')"/>
                        </div>
                        <div class="mb-4 lg:col-span-4">

                            <x-form.label for="country" :value="__('Country')"/>
                            <x-form.select name="billing[country]">
                                @foreach(config('countries') as $key => $value)
                                    <option value="{{ $key }}"
                                            @if(old('country') ?? (isset($listing->billing->country) AND $listing->billing->country == $key ?? null)) selected @endif>{{ $value }}</option>
                                @endforeach
                            </x-form.select>
                            <x-form.error class="mt-2" :messages="$errors->get('country')"/>
                        </div>
                    </div>
                    <hr class="my-4 lg:my-6 border-gray-100 dark:border-gray-800">
                    <div class="mb-4">
                        <x-form.label for="new_password" :value="__('New password')"/>
                        <x-form.input id="new_password" name="new_password" type="password"
                                      class="mt-1 block w-full"
                                      autocomplete="password" placeholder="{{__('New password')}}"/>
                        <x-form.error class="mt-2" :messages="$errors->get('new_password')"/>
                        <div
                            class="mt-3 text-sm text-gray-400 dark:text-gray-300">{{__('Leave empty if you don\'t want to change it')}}</div>
                    </div>
                @endif
                <x-form.primary class="w-full mt-5">{{__('Save change')}}</x-form.primary>
            </form>
        </x-form.layout>
    </div>
@endsection
