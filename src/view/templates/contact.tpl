{% include_template "global_head" %}
{#_ start of index template #}
<div id="form" class="jumbotron">
<h1>Oh, you have questions ?</h1>
<p>If so, cou can ask your questions here or in the forum.</p>
<p><button id="direct_contact" class="btn btn-lg btn-primary" role="button">contact support &raquo;</button></p>
<p><button id="forum"  class="btn btn-lg btn-primary" role="button">ask question in forum support &raquo;</button></p>
</div>
{% output_post %}
<script>
$.getScript("/assets/siteJS/contact.js");
</script>
{#_ end of index template #}
{% include_template "global_body" %}
