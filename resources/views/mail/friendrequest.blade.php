<html>
<head>
	<style></style>
	<link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet">
	<link rel="stylesheet"
  href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css"
/>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div style="padding-left:4rem;padding-right:4rem;color:#ca3c25;justify-content: space-evenly;align-items:center;background:#eee;width:800px;height:300px;">
	<strong style="position:absolute;top:50vh;left:50vw;transform:translate(-50%);margin-top:1rem;margin-bottom:2rem;font-family:bahnschrift;font-size:1.1rem;">Hey, you have a friend request from {{$from}} on Crankit</strong>
	<div><a style="position:absolute;top:60vh;left:50vw;transform:translate(-50%);display:grid;place-content: center;font-size:1.6rem;font-family:bahnschrift;text-decoration: none;background:rgb(3,105,161);border-radius:.4rem;color:white;border:4px solid white;width:150px;height:50px;" href={{$redirectURL}}>Follow</a></div>
</div>
</body>
</html>