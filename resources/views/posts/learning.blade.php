@extends("layouts.default")

@section('link')
    <link rel="stylesheet" href="/css/learning.css">
@endsection


@section('navbar-1') <!--　基本情報各年度別選択sidebarを出す   -->

    <div class="attr-nav">
        <ul>
            <li class="side-menu"><a href="#"><i class="fa fa-bars" aria-hidden="true" style="font-size:30px "></i></a></li>
        </ul>
    </div>

@endsection

@section('side') <!--  サイドメニュー本体 -->
        <div class="side">

            <a href="#" class="close-side"><i class="fa fa-times"></i></a>

            <div class="widget">
                <h6 class="title">各年度別試験</h6>
                <ul class="link">
                    @for($i=0;$i<10;$i++)
                    <li><a href="#">平成2{{$i}}年春</a></li>
                    <li><a href="#">平成2{{$i}}年秋</a></li>
                    @endfor
                </ul>
            </div>
        </div>
@endsection


@section('contents')
    @if (session('flash_message')=='Great!')
        <div class="flash_message" style="text-align: center;padding: 5px;color: green;background: #CCFFCC; " onclick="this.classList.add('hidden')">{{ session('flash_message') }}</div>
    @elseif(session('flash_message')=='Fuck!')
        <div class="flash_message" style="text-align: center;padding: 5px;color: green;background: #FFCCCC; " onclick="this.classList.add('hidden')">{{ session('flash_message') }}</div>
    @endif
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-8" style="margin-top:60px ">
                    <h2 style="margin-bottom: 30px">問{{$problem_number->id}}</h2>
                    <p style="margin-bottom: 50px">
                        @if(isset($error))
                            {!! $error !!}
                        @elseif(isset($problem_id))
                            {!! $problem_id->question !!}
                        @else
                            最新問題が表じされます。
                        @endif
                    </p>　　
                    <div class="row">

                        <div class="col-lg-6">
                            @if(isset($problem_id))
                            <ul class="select-list">
                                <li><a href='/{{$exam_id}}/exam/learning/answer/{{$problem_id->id}}/ア' class="select-btn"><button>ア</button></a><span>{{$problem_id->answer1}}</span></li>
                                <li><a href='/{{$exam_id}}/exam/learning/answer/{{$problem_id->id}}/イ' class="select-btn"><button>イ</button></a><span>{{$problem_id->answer2}}</span></li>
                                <li><a href='/{{$exam_id}}/exam/learning/answer/{{$problem_id->id}}/ウ' class="select-btn"><button>ウ</button></a><span>{{$problem_id->answer3}}</span></li>
                                <li><a href='/{{$exam_id}}/exam/learning/answer/{{$problem_id->id}}/エ' class="select-btn"><button>エ</button></a><span>{{$problem_id->answer4}}</span></li>
                            </ul>
                            @endif
                        </div>
                        <div class="col-lg-6 button-list">
                            <div class="button-layout-parent">
                                  <div class="button-layout-kids">
                                       <ul class="select-list2" >
                                            <li style="margin-bottom: 10px"><a href="#1"><button class="box">解答</button></a></li>
                                            <li><a href="#"><button>モード選択</button></a></li>
                                       </ul>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="margin-top: 100px">
                    <div>
                        <div class="scrollbox" style="height:350px;overflow:auto;border:1px solid #aaa;padding:10px;">
                                 @for($i = 1; $i < 81; $i++)
                                        <p><a href='/{{$exam_id}}/exam/learning/{{$i}}' style="text-decoration: none ;color:black;">問{{$i}} コンテンツ<input type="checkbox"  name="check[]" style="margin-left:10px ;"></a></p>
                                @endfor
                        </div>
                    </div>
                    <div class="problem-btm" style="margin-top: 30px">
                        <a href='/{{$exam_id}}/exam/learning/{{$Previous_btn}}'><button>前の問題</button></a>
                        <a href='/{{$exam_id}}/exam/learning/{{$Next_btn}}'><button>次の問題</button></a>
                    </div>
                </div>
            </div>
            <div class="row" id="1" style="margin-top: 50px;margin-left:90px;position: relative">
                <div id="answer_content" style="display: none">
                    <p style="font-size: 15px;line-height: 35px">
                        {!! $problem_id->correct !!}
                    </p>
                    <div style="position: absolute;left: 610px;margin-top: 50px; margin-bottom: 50px; font-size: 30px; border-bottom: solid 3px red;">A.<span style="margin-left:10px;padding-right:10px  ">{{$problem_id->explain}}</span></div>
                </div>
            </div>
        </div>





@endsection

