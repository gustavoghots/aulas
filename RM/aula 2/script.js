$(document).ready(function () {
    $('#Vid_Play').click(function () { 
        if($(".video").get(0).paused){
            $(".video").get(0).play();
        }else{
            $(".video").get(0).pause();
        }
    });

    $('#Vid_Aum').click(function (e) { 
        e.preventDefault();
        $('.video').width($('.video').width()+10);
    });
    $('#Vid_Dim').click(function (e) { 
        e.preventDefault();
        $('.video').width($('.video').width()-10);
    });
    $('#Vid_Info').click(function (e) { 
        e.preventDefault();
        console.log(
            'Source: '+$('.Video').get(0).currentSrc,
            '\nControls: '+$('.Video').get(0).controls,
            '\nautoplay: '+$('.Video').get(0).autoplay,
            '\nloop: '+$('.Video').get(0).loop,
            '\nposter: '+$('.Video').get(0).poster,
            '\nid: '+$('.Video').get(0).id,
            '\nwidth: '+$('.Video').width(),
            '\nheight: '+$('.Video').height()
        );
    });
    $('#Vid_Back').click(function (e) { 
        e.preventDefault();
        if($('.Video').attr('poster')=='Poster1.png'){
            $('.Video').attr('poster', 'Poster2.png');
        }else{
            $('.Video').attr('poster', 'Poster1.png');
        }
    });
    $('.video').get(0).onpause = function () {
        if(!$('.video').get(0).ended){
            alert('Video Paused');
        }
    }
    $('.video').get(0).onended = function () {
        alert('Video ended');
    }
});