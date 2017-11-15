@extends('master')

@section('content')
<div class="w3-card">
    <div class="w3-container">
        <h3>Login</h3>
        <form class="" method="POST" action="{{ route('login') }}">
            <div class="w3-section">
                {{ csrf_field() }}

                <label><b>E-Mail Address</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="email" name="email" id="email" autofocus>

                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" name="password" id="password" >

                <input class="w3-check w3-margin-top" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me

                       <button class="w3-btn w3-block w3-green w3-section w3-padding" type="submit">Login</button>

            </div>
        </form>
    </div>
</div>


@endsection
