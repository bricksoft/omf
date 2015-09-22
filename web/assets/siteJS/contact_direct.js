var r1 = document.referrer.split('/')[3];
var r2 = document.referrer.split('/')[4];
var ref =   ((typeof r1 != 'undefined') ? r1 : '') +
            ((typeof r2 != 'undefined') ? '/' + r2 + '/' : '/');

$.getScript("/assets/siteJS/nbp.js");  
            
function getPost (container){
    var postStr = $(container).text().slice(0, - 1);
    if (postStr !== ''){
        var postArr = postStr.split('|');
        var newArr = [];
        postArr.foreach(function(entry){
            var e = entry.split('=');
            newArr[e[0]] = e[1];
        });
        return newArr;
    } else return null;
}
function extractPost(container){
    var p = getPost(container);
    $(container).remove();
    return p;
}
function retryTerms(){
    window.location.href = '/contact/issue/151';
}


$(function(){
    var r = window.location.pathname.split( '/' )[3];
    if (r === 'success'){
        $('#submittor').remove();
        var msg =   '<p>Thank you for sending us this message.<br>'+
                    'We will reply you as soon as possible!</p>'+
                    '<a href="/" class="btn btn-default" role="button">Home</a>';
        $('#panel-body').html(msg);
    } else {
        var POST = getPost('#post');
        if (POST !== null){
            $("#status").val(POST.referrer+"|"+POST.error);
            if (POST.error !== 'none' && POST.error !== '' && POST.error !== ' '){ // if POST.error is set with a valid text, check "yes" radio-button
                $('#radio_err_y').prop('checked', 'checked');
            }
        } else {
            $("#submit").remove();
            $('#return').show();
            $.getScript("/assets/siteJS/bootbox_fail.js");
        }
    
        $('#return').click(function (e) {
            retryTerms();
        });
    }
});

