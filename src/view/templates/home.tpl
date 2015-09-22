{% include_template "global_head" %}
{#_ start of index template #}
<div class="jumbotron">
<h1>Welcome</h1>
<p>This is the main homepage of this mvc-framework</p>
<p><a class="btn btn-lg btn-primary" href="{$project_uri$}about#docs" role="button">View docs &raquo;</a></p><br/>
</div>

<div id="progressbar" style="height:20px">
  <div id="dlprogress" class="progress-bar" role="progressbar" style="width: 0%;"></div>
</div>
<script>
$("#dlstart").click(function(){
    $("#progressbar").addClass("progress");
    $("#dlprogress").addClass("progress-bar-striped active");
    download("50MB.zip","#dlprogress",function(){
        
    });
});
</script>

{#_ end of index template #}
{% include_template "global_body" %}