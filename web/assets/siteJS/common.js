Array.prototype.foreach = function (callback){
    for (var i = 0;i<this.length;i++){
        callback(this[i]);
    }
};

$.omf = {
    loadCSS:function (url){
        if($('head').size()>0){
            if (document.createStyleSheet){
                document.createStyleSheet(url);
            } else {
                $("head").append($("<link rel='stylesheet' href='"+url+"' type='text/css' media='screen' />"));
            }
        }
    },
    getLang:function (){
        var browserlangArray = window.navigator.languages || [window.navigator.language || window.navigator.userLanguage];
        var browserlang = browserlangArray[0];
        var realbrowserlang = browserlang.substring(0,2);
        return realbrowserlang;
        
    },
    async:function (f, c) {
        setTimeout(function() {
            f();
            if (c) {c();}
        }, 0);
    },
    post:function(a, b) {
        var f = document.createElement("form");
        f.setAttribute("method", "post");
        f.setAttribute("action", a);
        for(var k in b) {
            if(b.hasOwnProperty(k)) {
                var h = document.createElement("input");
                h.setAttribute("type", "hidden");
                h.setAttribute("name", k);
                h.setAttribute("value", b[k]);
                f.appendChild(h);
            }
        }
        document.body.appendChild(f);
        f.submit();
    }
};
