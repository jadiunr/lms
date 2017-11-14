@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>名前</th>
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
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->icon)
                                <img src="{{ asset('storage/img/' . $user->icon) }}" alt="icon" width="24" height="24" />
                            @else
                                <img src="/default_icon/animal_serval.png" alt="icon" width="24" height="24">
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
                        <td><a href="{{ route('admin.editUser', ['id' => $user->id]) }}"><button type="button" class="btn btn-primary">編集</button></a></td>
                        <td><a href="#"><button type="button" class="btn btn-danger">削除</button></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
