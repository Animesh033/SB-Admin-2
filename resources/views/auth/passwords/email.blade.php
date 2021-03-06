<x-auth.layout>
    <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <x-go-back-to href="{{ url('/login') }}"></x-go-back-to>
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                <p class="mb-4">We get it, stuff happens. Just enter your email address below
                    and we'll send you a link to reset your password!</p>
            </div>
            <form class="user" method="POST" action="{{ route('password.email') }}">
                        @csrf
                <div class="form-group">
                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Enter Email Address...">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Reset Password') }}
                </button>
            </form>
            <hr>
            {{-- <div class="text-center">
                <a class="small" href="register.html">Create an Account!</a>
            </div> --}}
            <div class="text-center">
                <a class="small" href="{{ url('/login') }}">Already have an account? Login!</a>
            </div>
        </div>
    </div>
</x-auth.layout>
