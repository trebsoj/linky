@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">{{ __('Verify Your Email Address') }}</h2>

        <div>
            @if (session('resent'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p class="mb-4">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            <p>{{ __('If you did not receive the email') }},
                <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="text-blue-500 hover:text-blue-700 underline">{{ __('click here to request another') }}</button>.
                </form>
            </p>
        </div>
    </div>
</div>
@endsection
