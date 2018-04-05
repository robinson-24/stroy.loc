$(document).ready(function(){
    
    dates();

    $(".deleteImage").click(function(){
        var id = $(this).attr('data-id');
        var token = $("[name='_token']").val();

        $.ajax({
            url: '/deletePhotoCategory',
            method: 'post',
            data: {
                _token: token,
                id: id
            },
            success:function(resp){
                if(resp == 'true'){
                    $(".deleteImage").parent().html('Логотип категории (100х100 рх)<input type="file" name="image" accept="image/*">');
                    $("input[name='alt']").val('');
                }
            }
        });
    });

    $(".deleteImageItem").click(function(){
        var id = $(this).attr('data-id');
        var token = $("[name='_token']").val();

        $.ajax({
            url: '/deletePhotoItem',
            method: 'post',
            data: {
                _token: token,
                id: id
            },
            success:function(resp){
                alert(resp);
                if(resp == 'true'){
                    $(".deleteImageItem").parent().html('Логотип товара<input type="file" name="image" accept="image/*">');
                    $("input[name='alt']").val('');
                }
            }
        });
    });

    $(".call-box").click(function(){
        $("#popUpForm").css('display', 'block');
    });

    $(".oneClick").click(function(){
        $("#popUpForm").css('display', 'block');
    });
    $(".closePopUp").click(function(){
        $(this).parent().css('display', 'none');
    });

    $(".to-cart").click(function(){
        var email = $("input[name='f1']").val();
        var name = $("input[name='f2']").val();
        var tel = $("input[name='f3']").val();
        var token = $("input[name='_token']").val();

        if(name.length < 3){
            $("input[name='f2']").after('<br><span style="color:red;">Поле должно быть заполнено</span>')
            return false;
        }

        if(tel.length < 3){
            $("input[name='f2']").after('<br><span style="color:red;">Поле должно быть заполнено</span>')
            return false;
        }

        $.ajax({
            url: '/addOrder',
            method: 'post',
            data: {
                _token: token,
                name: name,
                email: email,
                tel: tel
            }, success:function(resp){
                if(resp == 'true'){
                    location.reload();
                }
            }
        });
    });

    $(".noVisit").mouseout(function(){
        if($(this).hasClass('noVisit')){
            var token = $("input[name='_token']").val();
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/visit',
                method: 'post',
                data: {
                    _token: token,
                    id: id
                }, success:function(){
                    $(".noVisit[data-id='"+id+"'").removeClass('noVisit');
                    var count = parseInt($(".countOrder").text())-1;
                    if(count > 0){
                        $(".countOrder").text(count);
                    }else{
                        $(".countOrder").text('');
                    }
                }
            });
        }
    });

});
    function dates(){
        var now = new Date();

        var curr_date = now.getDate();
        if((''+curr_date).length == 1){
            curr_date = '0'+curr_date;
        }
        var curr_month = now.getMonth() + 1;
        if((''+curr_month).length == 1){
            curr_month = '0'+curr_month;
        }
        var curr_year = now.getFullYear();

        $(".priceDate").text(curr_date+'.'+curr_month+'.'+curr_year);
    }