<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>情報変更ページ</title>
</head>
    <body>


    <h2>パスワード変更</h2>
    <form action="password" method="post">
        現在のパスワード:<input type="password" name="oldpassword"><br>
        @if($errors->has('oldpassword'))
            <span class="error">{{$errors->first('oldpassword')}}</span><br>
        @endif
        新しいパスワード:<input type="password" name="newpassword"><br>
        @if($errors->has('newpassword'))
            <span class="error">{{$errors->first('newpassword')}}</span><br>
        @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" value="変更" style="width:300px;height: 50px">
    </form>

    </body>
</html>