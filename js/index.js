//Getting news post for index page
window.addEventListener('load',function (){
    var hr = ajaxObj('POST','requests/login.php');
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
            if(d.failed){
                _("#newsDeck").innerHTML = '<h4 style="color:red;">'+ d.failed +'</h4>';
            } else{
                for(var o in d){
                    if(d[o].img){
                        _("#newsDeck").innerHTML += '<div class="col-sm-4 col-xs-12"><div class="card"><img src="post_img/'+d[o].img+'" class="img-fluid card-img" alt="'+d[o].title+'"><div class="card-block"><h5 class="font-weight-bold d-inline">'+d[o].title+'</h5></div><div class="card-block pt-0"><p>'+d[o].content.substr(0, 150)+'.......</p></div></div></div>';  
                    } else{
                        _("#newsDeck").innerHTML += '<div class="col-sm-4 col-xs-12"><div class="card"><div class="card-block"><h5 class="font-weight-bold d-inline">'+d[o].title+'</h5></div><div class="card-block pt-0"><p>'+d[o].content.substr(0, 150)+'.......</p></div></div></div>';  
                    } 
                }
                _("#newsDeck").innerHTML += '<div class="col s12 text-xs-center mt-2"><a class="btn btn-outline-info btn-lg" href="news-events.html">See More</a></div>'
            }
        }
    }
    hr.send("getIndex="+3);
});

//Getting last five testimony post
window.addEventListener('load',function (){
    var hr = ajaxObj('POST','requests/login.php');
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
            if(d.failed){
                alert(d.failed);
            } else if(d.not_logged){
                window.location = 'login.html';
            } else{
                var activ = 0;
                for(var o in d){
                    activ ++;
                    if(activ === 1){
                        _("#testimonials").innerHTML += '<div class="carousel-item active"><blockquote class="blockquote"><p>'+d[o].testimony+'</p><footer>'+d[o].fname+'</footer></blockquote></div>';  
                    } else{
                        _("#testimonials").innerHTML += '<div class="carousel-item"><blockquote class="blockquote"><p>'+d[o].testimony+'</p><footer>'+d[o].fname+'</footer></blockquote></div>'; 
                    }
                }
            }
        }
    }
    hr.send("gett="+5);
});

//News subscription
_('#btnLetter').addEventListener('click',function (){
    var hr = ajaxObj('POST','requests/login.php');
    var formdata = new FormData(_('#new_Letter'));
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
            if(d.failed){
                _("#statusLoading").style.display = "none";
                _("#status").innerHTML = '<h4>'+d.failed+'</h4>';
            } else{
                _("#statusLoading").style.display = "none";
                _("#status").innerHTML = '<h4>'+d.success+'</h4>';
            }
        }
    }
    hr.send(formdata);
    _("#statusLoading").style.display = "block";
});