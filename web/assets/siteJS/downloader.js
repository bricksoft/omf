function download (file,feedback,callback){
    $.ajax({
        xhr: function(){
            var xhr = new window.XMLHttpRequest();
            //Download progress
            xhr.addEventListener("progress", function(evt){
                if (evt.lengthComputable) {
                    $(feedback).removeClass("progress-bar-success");
                    $(feedback).removeClass("progress-bar-warning");
                    $(feedback).removeClass("progress-bar-danger");
                    $(feedback).width(evt.loaded / evt.total*100+"%");
                }
            }, false);
            return xhr;
        },
        type: 'GET', // kann auch POST sein
        url: "/assets/"+file,
        data: {},
        success: function(data){
            $(feedback).width("100%");
            $(feedback).addClass('progress-bar-success');
            $(feedback).removeClass("active");
            callback(data);
        }
    });
}