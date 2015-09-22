$.getJSON('/assets/config/bootbox_fail.json',
    function (data) {
        data.buttons.abort.callback = function (){
            return;
        };
        data.buttons.retry.callback = function (){
            retryTerms(
                function (){
                    tos_success();
            },
                function (){
                    tos_fail();
                }
            );
        };
        bootbox.dialog(data);
    }
);