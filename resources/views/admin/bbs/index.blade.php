@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <tr>
            <th>タイトル</th>
        </tr>
        @foreach($threads as $thread)
            <tr>
                <td width="70%">
                    {{ Html::link('/admin/bbs/show?id='.$thread->id, $thread->title) }}
                </td>
            </tr>
        @endforeach
    </table>
@endsection