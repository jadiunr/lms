@extends('layouts.app')

<style>
.table .center {
    vertical-align: middle;
    text-align: center;
}
</style>

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

                    <table class="table table-striped">
                        <tr>
                            <th class="center">ID</th>
                            <th class="center">名前</th>
                            <th class="center">メールアドレス</th>
                            <th class="center">アイコン</th>
                            <th class="center">作成日</th>
                            <th class="center">更新日</th>
                            <th class="center">権限</th>
                            <th class="center">編集</th>
                            <th class="center">削除</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td class="center">{{ $user->id }}</td>
                                <td class="center">{{ $user->name }}</td>
                                <td class="center">{{ $user->email }}</td>
                                <td class="center">
                                    @if($user->icon)
                                        <img src="{{ asset('storage/img/' . $user->icon) }}" alt="icon" width="48" height="48" />
                                    @else
                                        <img src="/default_icon/animal_serval.png" alt="icon" width="48" height="48">
                                    @endif
                                </td>
                                <td class="center">{{ $user->created_at }}</td>
                                <td class="center">{{ $user->updated_at }}</td>
                                <td class="center">
                                    @if($user->admin == True)
                                        <span style="color:red;font-weight:bold">管理者</span>
                                    @else
                                        ユーザ
                                    @endif
                                </td>
                                <td class="center"><a href="{{ route('admin.editUser', ['id' => $user->id]) }}"><button type="button" class="btn btn-primary">編集</button></a></td>
                                <td class="center"><a href="#"><button type="button" class="btn btn-danger">削除</button></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
