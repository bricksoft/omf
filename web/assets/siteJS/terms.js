function loadTerms (e, success, fail){
    $.omf.loadCSS("/assets/termsJS/css/terms.min.css");
    $.omf.loadCSS("/assets/termsJS/css/font-awesome.min.css");
    $.getScript( "/assets/termsJS/js/terms.core.jquery.js", function (){
        $(e).click(function(){
            var lang = $.omf.getLang();
            $.omf.options = {
                data: '/assets/config/terms_'+lang+'.json',
                lang: lang
            };
            $.getJSON('/assets/config/termsOptions_'+lang+'.json', function (data) {
                data.forEach(function(o){
                    if (o.name !== null)
                    $.terms('set',o.name, o[o.name]);
                });
                $.terms($.omf.options,
                    function (){ //success
                        success();
                    },
                    function (){ //fail
                        fail();
                });
            });
        });
    });
}

function retryTerms (success,fail){
    $.terms($.omf.options,
        function (){ //success
            success();
        },
        function (){ //fail
            fail();
        }
    );
}