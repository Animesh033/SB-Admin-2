<x-auth.layout>
    <div class="col-lg-4 d-none d-lg-block bg-password-image"></div>
    <div class="col-md-8">
        <div class="p-5">
            <x-go-back-to href="{{ url('/') }}"></x-go-back-to>
            {{ __('Verify Your Email Address') }}
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
</x-auth.layout>
