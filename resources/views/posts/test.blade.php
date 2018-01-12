@extends("layouts.app")

@section('css')
    <link rel="stylesheet" href="/css/learning.css">
@endsection

@section('flash')
    @if(session('flash_message')== '記録しました。')
        <div class="flash_message" style="text-align: center;padding: 5px;color: green;background: #CCFFCC; " onclick="this.classList.add('hidden')">{{ session('flash_message') }}</div>
    @endif
@endsection

@section('content')


            <div class="row">



                <div class="col-lg-1"></div>

                <div class="col-lg-8" style="margin-top:60px ">


                    <h2 style="margin-bottom: 30px">問{{$id}}</h2>
                    <p style="margin-bottom: 50px">
                        @if(isset($error))
                            {!! $error !!}
                        @elseif(isset($problem_id))
                            {!! $problem_id->question !!}
                    </p>
                    @if($problem_id->pic_que != 'NULL')
                        <div style="text-align: center;margin-bottom: 70px"><img src="{{$problem_id->pic_que}}" ></div>
                    @endif
                    @endif


                    <div class="row">
                        <div class="col-lg-6">
                            @if(isset($problem_id))
                                <ul class="select-list">
                                    <li><a href='/exam/{{$exam_id}}/{{$block_id}}/{{$mode_id}}/{{$problem_id->problem_number}}/ア' class="select-btn"><button>ア</button></a><span>{{$problem_id->answer1}}</span></li>
                                    <li><a href='/exam/{{$exam_id}}/{{$block_id}}/{{$mode_id}}/{{$problem_id->problem_number}}/イ' class="select-btn"><button>イ</button></a><span>{{$problem_id->answer2}}</span></li>
                                    <li><a href='/exam/{{$exam_id}}/{{$block_id}}/{{$mode_id}}/{{$problem_id->problem_number}}/ウ' class="select-btn"><button>ウ</button></a><span>{{$problem_id->answer3}}</span></li>
                                    <li><a href='/exam/{{$exam_id}}/{{$block_id}}/{{$mode_id}}/{{$problem_id->problem_number}}/エ' class="select-btn"><button>エ</button></a><span>{{$problem_id->answer4}}</span></li>
                                </ul>
                            @endif
                            <ul class="select-list2">
                                <form method="post" name="answer_list" action="/exam/{{$exam_id}}/{{$block_id}}/{{$mode_id}}">
                                    {{csrf_field()}}
                                    <li><a href="javascript:answer_list.submit()"><button>試験終了</button></a></li>
                                </form>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            @if($problem_id->pic_ans != 'NULL')<img src="{{$problem_id->pic_ans}}" >@endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="margin-top: 100px">
                    <div>
                        <div class="scrollbox" style="height:350px;overflow:auto;border:1px solid #aaa;padding:10px;">
                                 @for($i = 1; $i < $problem_count+1; $i++)
                                        <p><a href='/exam/{{$exam_id}}/{{$block_id}}/{{$mode_id}}/{{$i}}' style="text-decoration: none ;color:black;">問{{$i}} コンテンツ
                                                @if(isset($session_item))
                                                    @if($session_item[$i-1]!='-')
                                                        <span style="margin-left: 10px">{{$session_item[$i-1]}}</span>
                                                    @endif
                                                @endif
                                        </a></p>
                                @endfor
                        </div>
                    </div>
                    <div class="problem-btm" style="margin-top: 30px">
                        <a href='/exam/{{$exam_id}}/{{$block_id}}/{{$mode_id}}/{{$Previous_btn}}'><button>前の問題</button></a>
                        <a href='/exam/{{$exam_id}}/{{$block_id}}/{{$mode_id}}/{{$Next_btn}}'><button>次の問題</button></a>
                    </div>
                </div>
            </div>



@endsection

@section('script')
    <script src="/js/learning.js" type="text/javascript"></script>
@endsection

