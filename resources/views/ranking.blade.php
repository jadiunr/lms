@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6"></div>
    {{Form::open(['method' => 'get'])}}
        <div class="form-group">
            <select class="form-control" name="exam_id">
                @foreach($exam_id as $e_id)
                    <option value={{$e_id->id}}>{{$e_id->id}}</option>
                @endforeach
            </select>
            <select class="form-control" name="block_id">
                @foreach($block_id as $b_id)
                    <option value={{$b_id->id}}>{{$b_id->id}}</option>
                @endforeach
            </select>
        </div>
        <div class="submit-group">
            <button class="btn btn-default" type="submit" formaction="/ranking/percentage">試験別正答率</button>
        </div>
    {{Form::close()}}
    </div>
    <br>
    {{Form::open(['method' => 'get','action' => 'RankingController@total'])}}
        <div class="submit-group">
            <button class="btn btn-default" type="submit">総合正答数</button>
        </div>
    {{Form::close()}}<br>

    @if($flag == 0)
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

    @endif
    @if($flag == 1)
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
    @endif
@endsection