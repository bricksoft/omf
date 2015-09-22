{#_ start of global head template #}
<html>
<head
<meta name="google-site-verification" content="P3GnnI_kp0fST5BtLZ9gr5NewRPPTEJun9xr_L3lpxE" />
<title>{$project_name$}</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="{$project_uri$}assets/main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{$project_uri$}assets/siteJS/common.js"></script>
<script src="{$project_uri$}assets/siteJS/bootbox.min.js"></script>
</head>
<div class="container">
<!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=" {$project_uri$}">
			{$project_name$}</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li id="home"><a href="{$project_uri$}">Home</a></li>
              <li id="about"><a href="{$project_uri$}about">About</a></li>
              <li id="contact"><a href="{$project_uri$}contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Useractions<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header">OMF Features</li>
                  <li role="separator" class="divider"></li>
                  <li><a id="dlstart" href="#">Download-Tester</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
{#_ end of global head template #}