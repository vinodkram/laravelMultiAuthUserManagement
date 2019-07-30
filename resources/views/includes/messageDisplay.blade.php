@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if(session()->has('message.level'))
<div class="alert alert-{{ session('message.level') }}">
        {!! session('message.content') !!}
</div>
@endif