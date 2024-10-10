<script src="{{asset('js/axios.min.js')}}"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>

@php
	$primary = 'ca3c25';$secondary = 'd8c99b';
@endphp
@if(session()->has('msg'))
		<div class="error message">{{session('msg')}}</div>
@endif
	<nav class="mainmenu items-center bg-opacity-80 fixed h-min-[20%] h-max-[20%] w-full flex justify-between flex-row">
		<span class="flex flex-row justify-between items-center">
			<img src="{{asset('cube.svg')}}" style="background:#ca3c25;filter:hue-rotate(20deg);" class="w-20 h-100 rounded-full w-min-100">
			<label class="text-center
     text-[#272727]
     text-xl h-fit font-bold">{{($user->name)}}</label>
		</span>
		<span id="tabs" class="flex flex-row justify-between w-[50%] max-w-[250px]">
		<a href="http://localhost:8000"><img  class="h-[50px]" src="https://api.iconify.design/material-symbols-light:home.svg?color=%23{{$primary}}"></img></a>
		<a href="http://localhost:8000/profile"><img  class="h-[50px]" src="https://api.iconify.design/material-symbols:supervisor-account-rounded.svg?color=%23{{$primary}}"></img></a>
		<a href="http://localhost:8000/chats"><img  class="h-[50px]" src="https://api.iconify.design/material-symbols:android-messages.svg?color=%23{{$primary}}"></img></a>
		<a href="http://localhost:8000/listings"><img  class="h-[50px]" src="https://api.iconify.design/bx:bxs-briefcase.svg?color=%23{{$primary}}"></object></a>
	</span>
		<span class="flex align-center">
			<input type="text" id="search" class="rounded-lg">
			<button class="rounded-full border-4 border border-s-4 w-10 h-10"><img src="https://api.iconify.design/material-symbols:search-rounded.svg?color=%23272727" class="w-full">
			</button>
		</span>
	</nav>
