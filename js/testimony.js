//Deleting tesimony
function deleteThis(elem){
    var all_data = "pid="+elem.id;
    if(elem.id === ""){
        alert("Please reload page, and try again!");
    } else{
        var hr = ajaxObj('POST','../requests/getter.php');
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        hr.onreadystatechange = function(){
            if(ajaxReturn(hr) == true){
                //alert(hr.responseText);
                var d = JSON.parse(hr.responseText);
                if(d.not_logged){
                    alert(d.not_logged);
                    window.location = 'index.html';
                } else if(d.failed){
                    alert(d.failed);
                } else{
                    alert(d.success);
                    window.location = 'testimonials.html';
                }
            }
        }
        hr.send(all_data);
        _("#d").innerHTML = 'Please wait...';
    }
}


//Getting last five testimony post
window.addEventListener('load',function (){
    var hr = ajaxObj('POST','../requests/getter.php');
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
            if(d.failed){
                alert(d.failed);
            } else if(d.not_logged){
                window.location = '../login.html';
            } else{
                for(var o in d){
                    if(d[o].id){
                        _("#eventsdeck").innerHTML += '<div class="col-sm-5 py-2"><div class="card"><div class="card-block"><h3 class="font-weight-bold d-inline">'+d[o].fname+'</h3></div><div class="card-block pt-0"><p>'+d[o].testimony+' !</p></div><hr class="m-0"><div class="card-block"><button class="btn btn-link p-0" id="'+d[o].id+'" onclick="deleteThis(this);"><span class="fa fa-fw fa-trash-o" id="d"> Delete</span></div></div></div>';  
                    }
                }
            }
        }
    }
    hr.send("gett="+10);
});


//Creating news post to database 
_('#btn-post').addEventListener('click',function (){
    var hr = ajaxObj('POST','../requests/uploader.php');
    var formdata = new FormData(_('#testimony_post'));
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
            if(d.failed){
                _("#statusLoading").style.display = 'none';
                _("#status").innerHTML = d.failed;
            } else if(d.not_logged){
                window.location = '../login.html';
            } else{
                _("#statusLoading").style.display = 'none';
                _("#status").innerHTML = '<h3 style="color:#32cd32;">'+d.success+'</h3>';
                _("#title").value = "";
                _("#event-details").value = "";
                window.location = 'testimonials.html';
            }
        }
    }
    hr.send(formdata);
    _("#statusLoading").style.display = 'block';
});
