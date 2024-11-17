//Getting last five events
window.addEventListener('load',function (){
    var hr = ajaxObj('POST','../requests/getter.php');
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
            if(d.failed){
                _("#news-deck").innerHTML = '<h2 style="color:red;">'+d.failed+'</h2>';
            } else if(d.not_logged){
                window.location = '../login.html';
            } else{
                for(var o in d){
                    if(d[o].img){
                        _("#news-deck").innerHTML += '<div class="col-sm-6"><div class="card my-2"><img src="../post_img/'+d[o].img+'" class="img-fluid card-img" alt="'+d[o].title+'"><div class="card-block"><h5 class="font-weight-bold d-inline">'+d[o].title+'</h5></div><div class="card-block pt-0"><p>'+d[o].content+'</p></div><div class="card-block pt-0"><em class="card-text">'+d[o].date_created+'</em></div></div></div>';  
                    } else {
                        _("#news-deck").innerHTML += '<div class="col-sm-6"><div class="card my-2"><div class="card-block"><h5 class="font-weight-bold d-inline">'+d[o].title+'</h5></div><div class="card-block pt-0"><p>'+d[o].content+'</p></div><div class="card-block pt-0"><em class="card-text">'+d[o].date_created+'</em></div></div></div>';  
                    }
                }
            }
        }
    }
    hr.send("get="+10);
});

//Creating event post to database 
_('#btn-post').addEventListener('click',function (){
    var hr = ajaxObj('POST','../requests/uploader.php');
    var formdata = new FormData(_('#news_upload'));
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
            if(d.failed){
                _("#statusLoading").style.display = 'none';
                _("#status").innerHTML = d.failed;
            } else if(d.not_logged){
                window.location = 'login.html';
            } else{
                _("#statusLoading").style.display = 'none';
                _("#status").innerHTML = '<h3 style="color:#32cd32;">'+d.success+'</h3>';
                _("#title").value = "";
                _("#content").value = "";
                _("#img-preview").src = "";
                window.location = 'news.html';
            }
        }
    }
    hr.send(formdata);
    _("#statusLoading").style.display = 'block';
});