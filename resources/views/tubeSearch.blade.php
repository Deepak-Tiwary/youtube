<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <title>Youtube Video Search</title>

        <!-- External Libs -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
		<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
		<!-- External Libs -->
	
		<script>
			$(document).ready(function()
			{
			 $("#search").keyup(function()
			 {
				 if($('#enable_live_tiles').is(":checked") == false)
				 {
					 return false;
				 }
				getVideoList();
			  });
			  
			  $("#btnSearch").click(function()
			  {
				getVideoList();
			  });
			  
			});
			
			
			function getVideoList()
			{
				$("#results").html("<br><br><center>Loading...</center>");
				var search_val = $("#search").val();
				$.post("{{url('search')}}", {search: search_val,_token: '{{csrf_token()}}'}, function(result)
				{
					console.log(result);
					$("#results").html("");
					var obj = JSON.parse(result);
					console.log(obj.items[0].id.videoId);
					for (var key in obj.items) 
					{
						console.log(obj.items[key].id.videoId);
						$("#results").append('<iframe data-fancybox="gallery" width="280px" height="180px" src="https://www.youtube.com/embed/'+obj.items[key].id.videoId+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="padding-right:28px;"></iframe>');
					}
					
				});
			}
		</script>
       
        </style>
    </head>
    <body>
        <div class="container">
        <div class="row">
        <div class="panel panel-default">
        <div class="panel-heading">
        <h3>Youtube Video Search </h3>
        </div>

        <div class="panel-body">
        <div class="form-group">
        <div class="input-group">
		  <span class="input-group-addon" id="basic-addon1" style="cursor:pointer;">
			<input type="checkbox" id="enable_live_tiles" > Enable Live Tiles
		  </span>
		  <input type="text" id="search" class="form-control" placeholder="search" aria-describedby="basic-addon1">
		  <span class="input-group-addon" id="btnSearch" style="cursor:pointer;">
			<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search
		  </span>
		</div>
        </div>
        <table class="table table-bordered table-hover">
			<thead>
			</thead>
			<tbody id='tbody'>
				<tr>
					<td id="results">
					</td>
				</tr>
			</tbody>
        </table>
        </div>
        </div>
        </div>
        </div>

        <div class="well well-sm"><center>Kindly Note : "Enable Live Tiles" is based on keyup event. It can consume more Google Youtube Free API quota because of every keypress in Search Box will consume the API.</center></div>
    </body>
</html>
