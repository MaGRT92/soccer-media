@extends('master')

@section('content')
<div class="w3-card">
    <div class="w3-container">
        <h3>Registration</h3>
        <form class="" method="POST" action="{{ route('register') }}">
            <div class="w3-section">
                {{ csrf_field() }}

                <label><b>Name</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="name" id="name" value="{{ old('name') }}" autofocus >
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif

                <label><b>E-Mail Address</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="email" name="email" id="email" >

                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" name="password" id="password" >

                <label><b>Password Confirm</b></label>
                <input class="w3-input w3-border" type="password" name="password_confirmation" id="password_confirmation" >

                <button class="w3-btn w3-block w3-blue w3-section w3-padding" type="submit">Register</button>

            </div>
        </form>
    </div>
</div>


@endsection
