<html><head>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
	<link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet">
	
	<link href="https://fonts.cdnfonts.com/css/aachen" rel="stylesheet">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');
		body{
			background:var(--secondary);
		}

		#contentbox{
			position:absolute;
			height:90dvh;width:100vw;
			top:11vh;display:grid;
		}
		#userbar{
			height:min(80vh,100%);
/*			box-shadow: 0 0 6px #27272732;*/
			outline:2px solid red;
			display:flex;flex-direction: column;
			align-items:center;justify-content:center;
			gap:2rem;
		}
		#userbar > .userinfo{
			font-size:2.2rem;color:#393E41;
			background:white;
			border-top-left-radius:min(5rem,50%);
			border-top-right-radius:min(5rem,50%);
			padding:.6rem;
			width:80%;height:50% !important;
			display:flex;flex-direction: column;
			align-items: center;
		}
		.userinfo > div:first-child{
			border-top-left-radius:min(5rem,50%);
			border-top-right-radius:min(5rem,50%);
		}
		#contentbox > #contentbar{
			height:100%;width:100%;
			display:flex;flex-direction: column;
			align-items:center;justify-content:start !important;
			gap:4rem;
		}
		.newpost{
			height:200px;
			width:80%;display:grid;
			place-items: center;gap:0;
			grid-template-rows: auto 82% ;
			background:#ddd;
		}
		.newpost > *{
			height:80%;
			width:100%;
		}
		.newpost .textarea{
			height:100%;
			background:white;
			grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
		}
		.newpost .edit{
			display:flex;
			width:95%;padding:.4rem;
		}
		.ql-toolbar{min-height:90px;}
		#newpost-modal .ql-toolbar .ql-formats{
			display:flex;flex-direction: row!important;
			flex-wrap: wrap;
			overflow:hidden !important;
		}
		#newpost-modal .ql-toolbar button{
			width:100% !important;
			height:clamp(10px,50%,30px) !important;
		}
		#newpost-modal:not(.pointer-events-none) .postform{
			pointer-events:auto !important;
		}
		#newpost-modal .ql-size{
			z-index:100 important;
			height:fit-content !important;
		}
		.edit img{
			border-radius:50%;
		}
		.edit img:hover{
			background:#27272722;
		}
		#contentbar > strong {
			min-width:80% !important;
			max-width:300px !important;
		}
		#contentbar > strong > strong,#contentbar > strong > strong > strong{
			width:100% !importanta;
		}
		.post{
			max-height:700px !important;
			min-height:400px !important;
			max-width:580px !important;
			display:flex;align-items:center;
			flex-direction: column;
			align-content:center;
		}
		.post strong{
			width:65vw !important;
		}
		.post img{
			max-height:350px !important;
			font-family:bahnschrift;
		}

		.newpost span img{
			height:35px;
		}
		[contenteditable]:empty:not(:focus):before{
			content:'Add a comment ...';color:grey;
			font-size:1rem;
		}
		[contenteditable]{
			border-bottom-color: grey;
		}
		[contenteditable]:focus{
			animation:focusing .3s ease-out forwards 1;
		}
		[contenteditable]:empty +span{
			display:none;
		}
		[contenteditable]:not(:empty) +span{
			display:flex;
		}
		@keyframes focusing{
			to{
				border-bottom-color:black;
			}
		}
		@media screen and (max-width:700px){
			#contentbox{
				top:14vh !important;
			grid-template-rows:clamp(250px,18vh,300px) auto;
			outline:2px solid red;
			}
			#userbar{
/*				background:orange;*/
			}
			.userinfo{
				min-height: 200px;
			}
		}
		@media screen and (min-width:700px){
			#contentbox{
			grid-template-columns: clamp(200px,18vw,300px) auto;
			}
			.userinfo{
				min-height: 300px;
			}
		}
	</style>
	<link rel="stylesheet"
  href="{{asset('css/material-tailwind.css')}}"
/>
<script src="{{asset('js/tailwind.min.js')}}"></script>
<script defer src="{{asset('js/dialog.js')}}"></script>
<link href="{{asset('css/quill.snow.css')}}" rel="stylesheet" />
</head>

<body>
	@include('mainnav')
	@include('newpost')
	<div id="contentbox">
		<div id="userbar">
			<div class="userinfo" class="flex flex-col items-center justify-around">
				<div class="bg-red-600 w-full flex justify-center ">
					<img src="{{asset('mole.jpg')}}" class="rounded-full w-24 self-end"></img>
				</div>
				<span class="flex justify-around w-full">
				<strong style='color:var(--primary)'>{{$user->uname}}</strong>
				<a href='profile/edit'>
					<img class="h-[70%] aspect-1" src="https://api.iconify.design/material-symbols:edit-square-outline-rounded.svg?color=%23ca3c25"></img>
				</a>
				</span>
				<div class="flex flex-col justify-center items-center w-full">
					<span class="flex justify-around font-bold align-baseline text ">
				<span class="text-base text-slate-800 h-fit text-pretty">Date joined: </span>
				<strong class="text-sm text-slate-600 h-fit text-center">
					{{$user->created_at->format('Y-m-d')}}
				</strong>
			</span>
				</div>
			</div>
		</div>
		<div id="contentbar">
			<div class="grid grid-rows-5 bg-white h-[120px] min-w-[80%] shadow-md shadow-slate-300 max-w-[300px]">
			<div class="row-span-3 w-[100%] h-[100%] flex flex-row items-center justify-around overflow-hidden">
				<img src="{{asset('mole.jpg')}}" class="rounded-full outlined h-3/5"></img>
				<input readonly type="textarea" onclick="(()=>{window.alert(123)})()" class="p-2 cursor-pointer w-[80%] h-3/5 border-slate-400 rounded-[1.2em] border-2 hover:bg-gray-200" placeholder="Write a new post ....">
			</div>	
			<div class="w-full h-full flex flex-row justify-around items-start row-span-2">
				<button id="media" data-dialog-target="dialog2" data-ripple-light="true" class="border-red w-[50px]"><span class="h-[100%] flex-row flex items-center"><img src="https://api.iconify.design/material-symbols:imagesmode-outline-rounded.svg?color=%23ca1212" class="h-[70%]"><strong>Media<strong></span></button>
				<button id="post" data-dialog-target="dialog" data-ripple-light="true" class="border-red w-50px"><span class="h-[100%] flex-row flex items-center"><img src="https://api.iconify.design/pixelarticons:article-multiple.svg?color=%233232ca" class="h-[50%]"><strong>Article<strong></span></button>
			</div>

		</div>
		<div class="w-full flex flex-col gap-y-2.5 items-center row-span-2">
				@foreach($posts as $post)
				<div class="post w-full bg-white p-4 shadow-md shadow-slate-300" data-id={{$post['id']}} >
					<input type="hidden" class="postid" value="{{$post['id']}}">
					<div class="postauth text-3xl w-full flex gap-x-4 h-[60px] border-b-4 border-slate-100 cursor-pointer" data-link={{$post['author']['link']}}>
						<img class="h-[80%] rounded-full" src={{isset($post['author']['ppic'])?$post['author']['ppic']:asset('mole.jpg')}} />
						<div class="text-1xl font text-sm text-slate-800 not-italic">
						<strong>{{$post['author']['name']}}</strong><br>
						<span title="{{$post['exactCreation']}}">{{$post['created_at']}}</span></div>
					</div>
					<!-- <strong class="text-5xl w-full block text-center">{{$post['title']}}</strong> -->
					<article class="w-full" style="font-family:'Lato',roboto,calibri,system-ui;letter-spacing:-.08em;">
						@if($post['image'])
							<img src={{asset('/postmedia/'.$post['image'])}}></img>
						@endif
						{!! $post['content'] !!}
					</article>
					<div class="text-3xl w-[80%] flex gap-x-4 h-[60px] items-center justify-between">
						<button class="flex h-[70%] text-sm items-center text-[#39ace7] like {{$post['like']?'disabled':''}}">
							<img class="h-full" src="{{$post['like']?'https://api.iconify.design/bi:hand-thumbs-up-fill.svg':'https://api.iconify.design/bi:hand-thumbs-up.svg'}}?color=%2339ace7">
							{{$post['likes']}} Likes
						</button>
						<button class="flex h-[70%] text-sm items-center text-[#39ace7] commentbutton">
							<img class="h-full" src="https://api.iconify.design/hugeicons:comment-01.svg?color=%2339ace7">
							{{count($post['comments'])}} Comments
						</button>
						<button class="flex h-[70%] text-sm items-center text-[#39ace7]">
							<img class="h-full" src="https://api.iconify.design/ic:outline-share.svg?color=%2339ace7">
							Share
						</button>
						
					</div>
					<div class="comments w-[98%] flex flex-col gap-y-2 hidden bg-neutral-50 overflow-y-scroll">
						<div class="grid min-h-[80px] gap-x-2 grid-cols-[50px_1fr] border-b-4 border-white border-solid bg-stone-200 ">
							<div class='grid justify-center p-2'>
								<img src={{asset('mole.jpg')}} class='w-[40px] aspect-1 rounded-full'></img>
							</div>
							<div class='flex flex-col justify-between p-2 w-full h-full items-center gap-y-2'>
								<article contenteditable class='com block font-light w-[90%] min-w-[320px] max-w-[320px] min-h-[1rem] brightness-[1.2] text-black text-sm border-b-2 outline-none'></article>
								<span class='justify-between w-full text-sm font-light w-[90%] min-w-[320px] max-w-[320px]'>
									<button class="rounded-full emote self-start">
										<img src="https://api.iconify.design/mingcute:emoji-fill.svg?color=%23FFD700" class="h-[92%]"></img>
									</button>
									<emoji-picker class="absolute hidden"></emoji-picker>
									<span class='flex justify-between 50% self-end'>
										<button class='cancel rounded-[3rem] border-black border-2 border-solid text-black min-w-[60px] p-1 active:bg-black active:text-white'>Cancel</button>
										<button class='postbut rounded-[3rem] bg-black text-white min-w-[60px] p-1'>Post</button>
									</span>
								</span>
							</div>
						</div>
						@foreach($post['comments'] as $comment)
						<div class="comment grid min-h-[80px] gap-x-2 grid-cols-[50px_1fr] bg-stone-100">
							<div class='grid justify-center p-2'>
								<img src={{asset('mole.jpg')}} class='w-[40px] aspect-1 rounded-full'></img>
							</div>
							<div class='flex-col justify-between py-2'>
								<strong class='text-sm'>{{$comment->creator->uname}}</strong>
								<article class='font-light'>{{$comment->content}}</article>
								<span class="flex w-4/5 justify-between">
									<button class="flex h-[70%] text-sm items-center text-[#39ace7] like {{$post['like']?'disabled':''}}">
										<img class="h-full" src="{{$post['like']?'https://api.iconify.design/bi:hand-thumbs-up-fill.svg':'https://api.iconify.design/bi:hand-thumbs-up.svg'}}?color=%2339ace7">
										{{$post['likes']}} Likes
									</button>
									<button class="flex h-[70%] text-sm items-center text-[#39ace7] commentbutton">
										<img class="h-full" src="https://api.iconify.design/hugeicons:comment-01.svg?color=%2339ace7">
										{{$post['likes']}} Comments
									</button>
									<button class="flex h-[70%] text-sm items-center text-[#39ace7]">
										<img class="h-full" src="https://api.iconify.design/ic:outline-share.svg?color=%2339ace7">
										Share
									</button>
								</span>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<script type="module">
			function emoji(e){
				if(e.target.tagName!='EMOJI-PICKER'){
					Array.from(document.querySelectorAll("emoji-picker")).forEach((ele)=>{
						if(!ele.className.includes('hidden')){
							ele.classList.add('hidden');
						}
						document.body.removeEventListener('click',emoji);
					})
				}
			}
			 import insertText from 'https://cdn.jsdelivr.net/npm/insert-text-at-cursor@0.3.0/index.js';
			 Array.from(document.querySelectorAll(".emote")).forEach((ele)=>{
				ele.addEventListener('click',(e)=>{
					ele.parentElement.querySelector("emoji-picker").classList.toggle('hidden');
				});
			});
			Array.from(document.querySelectorAll(".commentbutton")).forEach((ele)=>{
				ele.addEventListener('click',(e)=>{
					e.target.parentElement.parentElement.querySelector(".comments").classList.toggle('hidden');
					e.target.classList.toggle('brightness-50');
				});
			});
			Array.from(document.querySelectorAll("emoji-picker")).forEach((ele)=>{
				ele.addEventListener('emoji-click',(e)=>{
					insertText(document.querySelector('.com'),e.detail.unicode);
					document.body.addEventListener('click',emoji);
				});
			})
			Array.from(document.querySelectorAll(".cancel")).forEach((ele)=>{
				ele.addEventListener('click',(e)=>{
					e.target.parentElement.parentElement.parentElement.querySelector("article[contenteditable]").innerText = '';
				});
			})
			Array.from(document.querySelectorAll(".postbut")).forEach((ele)=>{
				ele.addEventListener('click',async (e)=>{
				
				// Include some other validation for the Posts
				let post = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
				let comment = e.target.parentElement.parentElement.parentElement.querySelector("article[contenteditable]").innerText;
				let resp = await axios.post(window.location.origin+`/posts/${post.getAttribute('data-id')}/comments`,{'comment':comment},{withCredentials:true});
				if(resp.status == 200){
					window.location.reload();
				}else{
					window.alert('COuldn\'t save the comment');
				}
		});
			});
		</script>
</div>
</div>
</body></html>
