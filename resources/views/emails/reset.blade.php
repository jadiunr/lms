<h3>
    <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
</h3>
<p>
    {{ __('下記のURLをクリックするとパスワードリセットのページへリンクします。') }}<br>
    {{ __('もし、パスワードリセットの変更をしない場合は無視してください。') }}
</p>
<p>
    {{ $actionText }}: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
</p>
<p>
    {{ config(app.name) }}
</p>