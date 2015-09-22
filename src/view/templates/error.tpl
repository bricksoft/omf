{% include_template "global_head" %}
{#_ start of error template #}
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><span class="glyphicon glyphicon-exclamation-sign"></span> Error!</h3>
</div>
<div class="panel-body">
An error occured. Please check if the url is correct!<br/>
If you think this is an error which should not have occured, you can contact us.<br/>
<a href="/contact/issue/{$uri$}" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-star"></span> Contact</a>
</div>
</div>
{#_ end of error template #}
{% include_template "global_body" %} 