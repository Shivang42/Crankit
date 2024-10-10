<html><head>
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	<link href="https://fonts.cdnfonts.com/css/aachen" rel="stylesheet">
	<style>
		:root{
			--primary:#ca3c25;
			--secondary:#d8c99b;
		}
		body{
			display:grid;place-items: center;
			background:#d8c99b;
		}
		#error{
			height:80vh;width:80vw;
			backdrop-filter:;
			min-height:200px;min-width:200px;
			background:var(--primary);
			color:white;font-size:3rem;
			font-family:bahnschrift;
			padding:1.6rem;
		}
	</style>
<script src="https://cdn.tailwindcss.com"></script></head>

<body>
	<div id="error">
		{{$msg}}
	</div>
</body></html>