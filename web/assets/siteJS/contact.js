var uri = window.location.pathname.split( '/' );

var r1 = document.referrer.split('/')[3];
var r2 = document.referrer.split('/')[4];
var ref =   ((typeof r1 != 'undefined') ? r1 : '') +
            ((typeof r2 != 'undefined') ? '/' + r2 + '/' : '/');
var str = '', e = '#direct_contact';
var err = "none";
switch (uri[2]) {
    case 'issue':
        $.getJSON('/assets/config/issues.json', function (data){
            err = (data[uri[3]]!==null)?data[uri[3]]:'none';
            str =   '<hr>'+
                '<div class="panel panel-danger">'+
                    '<div class="panel-heading">'+
                        '<h2 style="font-size:28" class="panel-title">Theres an Error ?</h2>'+
                    '</div>'+
                    '<div class="panel-body">'+
                        '<p>It seems that you may have encountered an error:</p>'+
                        '<code>'+data[uri[3]]+'</code>'+
                        '<p>This error was found here:</p>'+
                        '<code>'+ref+'</code>'+
                        '<br>'+
                        '<p>Do you want to inform us about it ?</p>'+
                        '<p>'+
                            '<button id="error_contact" class="btn btn-lg btn-primary" role="button">contact support &raquo;</button>'+
                        '</p>'+
                    '</div>'+
                '</div>';
            e += ', #error_contact';
            append();
        });
        break;
    case 'contribute':
        str =   '<hr>'+
            '<div class="panel panel-default">'+
                '<div class="panel-heading">'+
                    '<h2 style="font-size:28" class="panel-title">One does not simply contribute...</h2>'+
                '</div>'+
                '<div class="panel-body">'+
                    '<p>Yes! You seem to want to contribute to this Project!</p>'+
                    '<p>For this, we use GitHub for a better Teamwork.</p>'+
                    '<p><a href="https://github.com/mindsolution/omf" target="blank" class="btn btn-lg btn-primary" role="button">contibute &raquo;</a></p>'+
                '</div>'+
            '</div>';
        append();
        break;
    case 'submit':
        submit();
        break;
    default:
        append();
}

function append(){
    $(str).appendTo('#form').end( $.getScript( "/assets/siteJS/terms.js", function (){
        loadTerms(e,
            function (){
                tos_success();
            },
            function (){
                tos_fail();
        });
    }));
}



function tos_success(){
    bootbox.alert('Thank you for accepting our terms!', function () {
        var p = {
            "referrer"  : ref,
            "status"    : "Error: "+err+"<br>"+
                            "Referrer: /"+ref+"<br>"+
                            "is valid: "+true+"<br>",
            "error"     : err
        };
        $.omf.post("/contact/submit/",p);
    });
}


function tos_fail(){
    $.getScript("/assets/siteJS/bootbox_fail.js");
}


function submit () {
    //alert();
}