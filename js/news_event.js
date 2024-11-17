//Getting news post for index page
window.addEventListener('load',function (){
    var hr = ajaxObj('POST','requests/login.php');
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
            if(d.failed){
                _("#row").innerHTML = '<h4 style="color:red;">'+ d.failed +'</h4>';
            } else{
                for(var o in d){
                    if(d[o].img){
                        _(".row").innerHTML += '<div class="col-sm-6"><div class="card my-2"><img src="post_img/'+d[o].img+'" class="img-fluid card-img" alt="'+d[o].title+'"><div class="card-block"><h5 class="font-weight-bold d-inline">'+d[o].title+'</h5></div><div class="card-block pt-0"><p>'+d[o].content+'</p></div><div class="card-block pt-0"><em class="card-text">'+d[o].date_created+'</em></div></div></div>';  
                    } else{
                        _(".row").innerHTML += '<div class="col-sm-6"><div class="card my-2"><div class="card-block"><h5 class="font-weight-bold d-inline">'+d[o].title+'</h5></div><div class="card-block pt-0"><p>'+d[o].content+'</p></div><div class="card-block pt-0"><em class="card-text">'+d[o].date_created+'</em></div></div></div>';  
                    }
                }
            }
        }
    }
    hr.send("getNews="+10);
});