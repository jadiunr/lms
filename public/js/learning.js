$(function(){

    $( "button[class*='box']" ).click(function() {
        $( "#answer_content" ).slideToggle( "slow" );
    });

    $('a[href^="#"]').click(function() {
        // スクロールの速度
        var speed = 400; // ミリ秒
        // アンカーの値取得
        var href= $(this).attr("href");
        // 移動先を取得
        var target = $(href == "#" || href == "" ? 'html' : href);
        // 移動先を数値で取得
        var position = target.offset().top;
        // スムーススクロール
        $('body,html').animate({scrollTop:position}, speed, 'swing');
        return false;
    });
    $('.result_image').fadeIn(1800);

    $("select[name='sort_form'] option[value='<?php echo $type; ?>']").attr("selected",true);

});
function dropsort() {
    var browser = document.sort_form.sort.value;
    location.href = browser
}


