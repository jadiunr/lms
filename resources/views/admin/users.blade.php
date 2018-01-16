@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ユーザ一覧</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">{{ $users->links() }}</div>
                    <div class="col-md-6">
                        {!! Form::open(['method' => 'get', 'route' => 'admin.searchUser']) !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="key_w">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">検索</button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>名前</th>
                            <th>本名</th>
                            <th>メールアドレス</th>
                            <th>アイコン</th>
                            <th>作成日</th>
                            <th>更新日</th>
                            <th>権限</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->realname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->icon)
                                        <img src="{{ asset('storage/img/' . $user->icon) }}" alt="icon" width="48" height="48" />
                                    @else
                                        <img src="/default_icon/animal_serval.png" alt="icon" width="48" height="48">
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    @if($user->admin == True)
                                        <span style="color:red;font-weight:bold">管理者</span>
                                    @else
                                        ユーザ
                                    @endif
                                </td>
                                <td><a href="{{ route('admin.editUser', ['user_id' => $user->id]) }}"><button type="button" class="btn btn-primary">編集</button></a></td>
                                <td>
                                    {!! Form::open(['route' => ['admin.deleteUser']]) !!}
                                    {!! Form::hidden('user_id', $user->id) !!}
                                    {!! Form::submit('削除', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("本当によろしいですか？")']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
