@extends('layouts.app')
@section('style')
    #app > nav{ margin-bottom: 60px;}
    .result > th,td {
    border-bottom:solid 1px black ;
    }
    .col-lg-6 > p { font-size:40px;
                    margin:50px}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6" style="position: relative">
            <p>正答数　<span style="font-size: 90px;color: @if($correct_count<80 and $correct_count>=64)#CEF6CE @elseif($correct_count<64 and $correct_count>=48)#FFCA00 @elseif($correct_count<40)#F6CECE @else red @endif">{{$correct_count}}</span>/80</p>
            <p>正答率　<span style="font-size: 90px;color: @if($correct_count<80 and $correct_count>=64)#CEF6CE @elseif($correct_count<64 and $correct_count>=48)#FFCA00 @elseif($correct_count<40)#F6CECE @else red @endif">{{$result}}</span>%</p>
            <a class="btn btn-default" href="/" role="button" style="font-size: 30px; position: absolute; top:600px ;left:300px">試験終了</a>
            <div class="result_image" style="margin-left:150px;font-size:100px;color:green;display: none">
                合格
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                @for($j=0;$j<4;$j++)
                    <div class="col-lg-3" style="padding: 0">
                        <table>
                            <thead>
                                <tr class="result">
                                    @if($j==0)
                                        <th></th>
                                        <th>解答</th>
                                        <th>答案</th>
                                        <th>正誤</th>
                                    @else
                                        <th></th>
                                        <th style="color: white">解答</th>
                                        <th style="color: white">答案</th>
                                        <th style="color: white">正誤</th>
                                    @endif
                                </tr>
                            </thead>
                                    @if($j==0)
                                        <?php $i=0 ?>
                                    @elseif($j==1)
                                        <?php $i=20 ?>
                                    @elseif($j==2)
                                        <?php $i=40 ?>
                                    @elseif($j==3)
                                        <?php $i=60 ?>
                                    @endif
                                @foreach($problem_id as $item)
                                    <tr class="result"@if($judgment($session_item[$i],$item->correct)=="○") style="background:#CEF6CE"
                                        @else style="background:#F6CECE"@endif>
                                        <td style="padding-left: 10px;">{{$i+1}}　</td>
                                        <td>{{$session_item[$i]}}</td>
                                        <td>{{$item->correct}}</td>
                                        <td style="font-size: 20px;">{{$judgment($session_item[$i],$item->correct)}}</td>
                                    </tr>
                                    @if($i==19 or $i==39 or $i==59 or $i==79)
                                        @break
                                    @endif
                                <?php $i++?>
                                @endforeach

                        </table>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/learning.js" type="text/javascript"></script>
@endsection