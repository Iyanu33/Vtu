//Creating news post to database
_('#btn-post').addEventListener('click', function () {
        var hr = ajaxObj('POST', '../requests/uploader.php');
        var formdata = new FormData(_('#img_upload'));
        hr.onreadystatechange = function () {
            if (ajaxReturn(hr) == true) {
                //alert(hr.responseText);
                var d = JSON.parse(hr.responseText);
                if (d.failed) {
                    _("#statusLoading").style.display = 'none';
                    _("#status").innerHTML = d.failed;    
                } else if(d.not_logged){
                    window.location = 'login.html';
                } else {
                    _("#statusLoading").style.display = 'none';
                    _("#status").innerHTML = '<h3 style="color:#32cd32;">' + d.success + '</h3>';
                    window.location = 'gallery.html';
                }
            }
        }
        hr.send(formdata);
        _("#statusLoading").style.display = 'block';
    });