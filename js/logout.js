//Logout script
_('#signout').addEventListener('click',function (){
    var hr = ajaxObj('POST','../requests/getter.php');
    hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var u = localStorage.getItem("u");
    hr.onreadystatechange = function(){
        if(ajaxReturn(hr) == true){
            //alert(hr.responseText);
            var d = JSON.parse(hr.responseText);
        if(d.failed){
            _('#status #message').innerHTML = d.failed;
            _("#status").style.display = "block";
            _('#status').classList.add('in');
        } else{
            alert(d.success);
            window.location = '../index.html';
                }
            }
        }
    hr.send("un="+u);
});