

{!! Form::open(['url' => '/upload', 'method' => 'post', 'files' => true]) !!}

{{--成功時のメッセージ--}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
{{-- エラーメッセージ --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    @if ($user->icon)
        <p>
            <img src="{{ asset('storage/img/' . $user->icon) }}" alt="icon" />
        </p>
    @endif
    {!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
    {!! Form::file('file') !!}
</div>

<div class="form-group">
    {!! Form::submit('アップロード', ['class' => 'btn btn-default']) !!}
</div>
{!! Form::close() !!}