<x-admin.layout>
    <x-slot name="title"></x-slot>
    <div class="col-lg-4 d-none d-lg-block bg-password-image"></div>
    <div class="col-lg-8">
        <div class="p-5">
            <x-go-back-to href="{{ route('dashboard') }}"></x-go-back-to>
            <div class="form-group  row">
                <div class="col-md-12">{{ __('Please confirm your password before continuing.') }}</div>
            </div>
            <form class="user" method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Confirm Password') }}
                        </button>

                        {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link btn-user btn-block" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-auth.layout>
