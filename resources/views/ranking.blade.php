@extends('layouts.app')
@section('content')
    {{Form::open(['method' => 'get','action' => 'RankingController@percentage'])}}
        <div class="form-group">
            <select class="form-control" name="block_id">
                @foreach($block_id as $id)
                    <option value={{$id->block_id}}>{{$id->block_id}}</option>
                @endforeach
            </select>
        </div>
        <div class="submit-group">
            <button class="btn btn-default" type="submit" formaction="/ranking/percentage">試験別正答率</button>
            <button class="btn btn-default" type="submit" formaction="/ranking/category">試験別カテゴリ正答率</button>
        </div>
    {{Form::close()}}
    <br>
    {{Form::open(['method' => 'get','action' => 'RankingController@total'])}}
        <div class="submit-group">
            <button class="btn btn-default" type="submit">総合正答数</button>
        </div>
    {{Form::close()}}<br>

    @if($flag == 0)
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>順位</th>
                        <th>名前</th>
                        <th>総合正答数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $index => $record)
                        <tr>
                            <td>
                                {{++$index}}位
                            </td>
                            <td>
                                @foreach($users as $user)
                                    @if($user->id == $record->user_id)
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                {{$record->total}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if($flag == 1)
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>順位</th>
                    <th>名前</th>
                    <th>試験</th>
                    <th>正答率</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $index => $record)
                    <tr>
                        <td>
                            {{++$index}}位
                        </td>
                        <td>
                            @foreach($users as $user)
                                @if($user->id == $record->user_id)
                                    {{$user->name}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{$block}}
                        </td>
                        <td>
                            {{substr($record->total,0,4)}}%
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if($flag == 2)
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>順位</th>
                    <th>名前</th>
                    <th>試験</th>
                    <th>tech</th>
                    <th>manage</th>
                    <th>str</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $index => $record)
                    <tr>
                        <td>
                            {{++$index}}位
                        </td>
                        <td>
                            @foreach($users as $user)
                                @if($user->id == $record->user_id)
                                    {{$user->name}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{$block}}
                        </td>
                        <td>
                            {{--{{substr(,0,4)}}%--}}
                            {{$record->category1}}
                        </td>
                        <td>
                            {{$record->category2}}
                        </td>
                        <td>
                            {{$record->category3}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection