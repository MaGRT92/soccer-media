@if ($errors->any())
<div>
    <ul class="w3-ul w3-padding">
        @foreach ($errors->all() as $error)
        <li class="w3-panel w3-red w3-round">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif