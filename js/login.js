//Admin login script  
_('#loginBtn').addEventListener('click',function (){
    var hr = ajaxObj('POST','../requests/login.php');
    var formdata = new FormData(_('#login_form'));
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
        if(d.failed){
            _('#status').innerHTML = d.failed;
            _("#status").style.display = "block";
            _('#status').classList.add('in');
        } else if(d.logged){
            window.location = 'https://noblehall.com/admin/news.html';
        } else{
            var un;
            for(var o in d){
                if(d[o].username){
                    localStorage.setItem("u",d[o].username);
                }
            }
            window.location = 'https://noblehall.com/admin/news.html';
        }
    }
    }
    hr.send(formdata);
    _("#status").style.display = '<span class="fa fa-spin fa-spinner fa-2x"></span>';
});