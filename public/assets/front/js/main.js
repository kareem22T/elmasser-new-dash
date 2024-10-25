$(function(){
    'use strict';

    // start upPage
    $(".upPage").click(function(e){
        e.preventDefault();
        $("html,body").animate({
            scrollTop:0
        },1500)
    });
    // End upPage

    // start search card
    $("header .nav-sm .search-sm .search-i").click(function(e){
        e.preventDefault();
        $("header .nav-sm  form.search-form").toggleClass("active-hidden");
        $("header nav").toggleClass("active-hidden");
    });
    $("header .nav-sm form.search-form i.search-times").click(function(e){
        e.preventDefault();
        $("header .nav-sm  form.search-form").addClass("active-hidden");
        $("header nav").removeClass("active-hidden");

    });
    // End search card

    // start navbar .tools-navbar i
    $("header i.menu-icon").click(function(e){
        e.preventDefault();
        $(".navbar-sm").toggleClass("active-hidden");
    });
    $(".navbar-sm i.remove-menu").click(function(e){
        e.preventDefault();
        $(".navbar-sm").toggleClass("active-hidden");
    });
    // End navbar .tools-navbar i


    // start Poll
        // زرار النتائج
        $(".Poll .poll-form button.vote-button").click(function(e){
            e.preventDefault();
            $(".Poll .poll-vote-all").toggleClass("not-active");
            $(".Poll .poll-form").toggleClass("not-active");
        });
        // زرار التصويت
        $('.Poll .poll-form .poll-button').click(function (e) {
            e.preventDefault();
            if ($('.Poll .poll-form #radioNO').prop("checked") == true
                || $('.Poll .poll-form #radioYES').prop("checked")  == true ) {
                    Pullsubmit();
            }
            else {
                alert("please vote");
            }
        });
        function Pullsubmit(){
            $(".Poll .poll-form").submit(function(ee){ee.preventDefault();});
            $(".Poll .poll-vote-all").toggleClass("not-active");
            $(".Poll .poll-form").toggleClass("not-active");
        }
    // End Poll


});