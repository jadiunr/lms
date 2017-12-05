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

            <a href="{{ route('admin.exams') }}"><button type="button" class="btn btn-default">Back</button></a><hr/>

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">問題カテゴリ一覧</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th class="center">カテゴリID</th>
                            <th class="center">カテゴリ名</th>
                            <th class="center">作成日</th>
                            <th class="center">更新日</th>
                            <th class="center">編集</th>
                            <th class="center">削除</th>
                        </tr>
                        @foreach($categories as $category)
                            <tr>
                                <td class="center">{{ $category->id }}</td>
                                <td class="center">{{ $category->name }}</td>
                                <td class="center">{{ $category->created_at }}</td>
                                <td class="center">{{ $category->updated_at }}</td>
                                <td class="center"><a href="{{ route('admin.editCategory', $category->id) }}"><button type="button" class="btn btn-primary">編集</button></a></td>
                                <td class="center"><a href="#"><button type="button" class="btn btn-danger">削除</button></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <a href="{{ route('admin.getCreateCategory') }}"><button type="button" class="btn btn-success">カテゴリ追加</button></a>
        </div>
    </div>
@endsection