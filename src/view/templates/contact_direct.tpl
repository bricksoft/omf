{% include_template "global_head" %}
{#_ start of index template #}
<div id="form" class="jumbotron">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h2 style="font-size:28" class="panel-title">Contact submission</h2>
        </div>
        <div id="panel-body" class="panel-body">
            <form id="submittor" method="POST" action="success">
                {#_ input + label #}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Please fill in your name, so we can address you better.">
                </div>
                {#_ input + label #}
                <div class="form-group">
                    <label for="email">email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Please enter your email-address so we can contact you." required>
                </div>
                {#_ input + label #}
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Please write here what you want to tell us about." required style="resize:vertical"></textarea>
                </div>
                <p>I had an error :
                    <div class="radio">
                        <label><input id="radio_err_y" type="radio" value="true" name="had_error" required>Yes</label>
                    </div>
                    <div class="radio">
                        <label><input id="radio_err_n" type="radio" value="false" name="had_error">No</label>
                    </div>
                </p>
                <p>Also, the following will be appended:</p>
                <code id="status_report" style="color:grey"><b>{$ status_report $}</b></code>
                <input type="hidden" id="status" name="status">
                <hr>
                <button id="submit" type="submit" class="btn button button-default">submit</button>
                <button id="return" class="btn button button-default" style="display:none">Return</button>
            </form>
        </div>
    </div>
</div>
<div id="post" style="display:none">{% output_post %}</div>
<script src="{$project_uri$}assets/siteJS/contact_direct.js"></script>
{#_ end of index template #}
{% include_template "global_body" %}
