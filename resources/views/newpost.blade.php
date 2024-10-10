
<script src="{{asset('js/quill.js')}}"></script>

<script src="{{asset('js/markup.js')}}" defer></script>
<script>
	window.onload = ()=>{
		document.querySelector(".submit-post").addEventListener('click',(e)=>{
			// Include some other validation for the Posts
			let content = e.target.parentElement.parentElement.querySelector(".postfield");
			let images = [...Array.from(content.querySelectorAll("img"))];
			let invImages = images.filter((image)=>{
				let binArr = atob(image.src.split(',')[1]);
				let mb = binArr.length/(1024*1024);
				return (mb > 2.0);
			});
			if(invImages.length>0 || invImages.length>10){
				console.log("Image size > 2MB");
				invImages.forEach((image)=>{
					image.classList.add('outline-orange-400','outline-solid','outline-4','grayscale');
				});
			}else{
				document.querySelector("input[name='post_content']").value = content.children[0].innerHTML;
				document.forms['post'].submit();
			}
		});
		document.querySelector(".submit-media").addEventListener('click',(e)=>{
			// Include some other validation for the Posts
			let content = document.querySelector(".mediatext");
			let image = document.querySelector("#mediaframe");
			let valid = (async (im)=>{
				let imfile = await axios.get(im.src);
				let mb = imfile.headers['content-length']/(1024*1024);
				return (mb > 2.0);
			})(image);
			if(!valid){
					console.log("Image size > 2MB");
					image.classList.add('outline-orange-400','outline-solid','outline-4','grayscale');
			}else{
				document.querySelector("input[name='media_content']").value = content.innerText;
				document.forms['mediaform'].submit();
			}
		});
	}
	
</script>
<style>
	.active{box-shadow:inset 0 0 6px black;}
	#newpost-modal{
		z-index:100 !important;
	}
	#newpost-modal:hover{
		z-index:110 !important;
	}
	#newmedia-modal:hover *{
		z-index:110 !important;
		pointer-events:auto ;
	}
	#newmedia-modal{
		z-index:100 !important;
	}
</style>
<div id="newpost-modal" data-dialog-backdrop="dialog" data-dialog-backdrop-close="true" class="size-full fixed top-0 left-0 overflow-x-hidden overflow-y-auto pointer-events-none grid place-items-center backdrop-blur-sm duration-300 inset-0" role="dialog" tabindex="-1" aria-labelledby="newpost-modal-label">
	<form class="hidden" name="post" id="postform" method="POST" action="posts">@csrf<input type="hidden" name="post_content"></form>
	<div data-dialog="dialog" class="relative transition-all m-4 w-[40vw] h-[80%] max-h-[80vh] min-w-[600px] bg-white ">
		<div class="postform pointer-events-none h-full w-full flex flex-column justify-center" data-states="">
				<article class="textarea grid grid-rows-6 bg-white p-4 w-full h-full">
					<input type="text" class="
					w-full text-4xl text-black placeholder:text-slate-400 font-bold border-b-4 border-[#27272723]" placeholder="Title" form="postform" name="post_title">
					<article contenteditable="true" class="postfield text-3xl row-span-3 break-words w-full max-w-full" data-markup=""></article>
					<span class="w-full border-t-4 border-[#27272723] flex flex-row items-center row-span-2"><button class="submit-post bg-red-400 text-white h-[80%] w-[120px] hover:bg-red-800 font-bold" type="submit" form="post">Publish</button></span>
				</article>
			</div>
		</div>
	</div>
<div id="newmedia-modal" data-dialog-backdrop="dialog2" data-dialog-backdrop-close="true" class="size-full fixed top-0 left-0 overflow-x-hidden overflow-y-auto pointer-events-none grid place-items-center backdrop-blur-sm duration-300 inset-0" role="dialog" tabindex="-1" aria-labelledby="newmedia-modal-label">
	<form class="hidden" name="mediaform" id="postform2" method="POST" action="posts" enctype='multipart/form-data'>@csrf<input type="hidden" name="media_content"></form>
	<div data-dialog="dialog2" class="relative transition-all m-4 w-[60vw] h-[80%] max-h-[80vh] min-w-[600px] max-h-[800px] bg-white ">
		<div class="postform pointer-events-none h-full w-full flex flex-column justify-center" data-states="">
				<article class="textarea grid grid-rows-6 bg-white p-4 w-full h-full">
					<div class='row-span-6 grid grid-cols-2 grid-rows-1' data-state='inactive'>
							<div id="mediafile" class="grid place-self-center place-items-center absolute w-[97%] h-[63%] text-2xl text-white bg-blue-400 font-bold border-b-8 border-[#27272723]"><span class="flex w-1/2 justify-around items-center">Upload a picture<object data="https://api.iconify.design/material-symbols-light:imagesmode-outline.svg?color=%23ffffff" class="h-[50px]"></object></span></div>
							<input type="file" class="
							absolute w-[97%] h-[63%] text-4xl text-black bg-transparent placeholder:text-slate-400 font-bold opacity-0 cursor-pointer z-10" form="postform2" name="media_cont">
							<div id="mediacaption" class='hidden h-full w-full bg-white flex flex-col justify-between items-center p-4'>
								<article contenteditable="true" class='mediatext h-[80%] w-full min-h-[300px] bg-transparent text-slate-600 text-[1.6rem]' data-markup=""></article>
								<span class="w-full h-[18%] border-t-4 border-[#27272723] flex flex-row items-center row-span-2 p-2">
									<button class="w-[50px] submit-media" type="submit" form="post"><img class="h-[80%]" src='https://api.iconify.design/mingcute:send-line.svg?color=%23272727'></img></button>
									<button class="w-[50px]" type="submit" form="post"><img class="h-[80%]" src='https://api.iconify.design/mdi:share-outline.svg?color=%23272727'></img></button>
								</span>
							</div>
					</div>
				</article>
			</div>
		</div>
	</div>
	<script>
		document.querySelector("input[name='media_cont']").addEventListener('input',(e)=>{
			let media = e.target.files[0];
			let contbox = e.target.parentElement;
			if(contbox.getAttribute('data-state')=='inactive'){
				let localURL = URL.createObjectURL(media);
				let slate = document.querySelector("#mediafile");
				slate.classList.toggle('place-self-center');
				slate.innerHTML = `<img id="mediaframe" src=${localURL} class='w-[90%]'></img>`;
				slate.classList.toggle('absolute');slate.classList.toggle('bg-blue-400');slate.classList.toggle('bg-slate-200');
				slate.classList.toggle((new RegExp('h-\[[0-9]+\%\]')).exec(slate.className)[0]);slate.classList.toggle('h-full');
				e.target.classList.toggle('hidden');
				document.querySelector("#mediacaption").classList.toggle('hidden');

				contbox.classList.add('w-full');
				contbox.setAttribute('data-state','active');
			}else{
				let localURL = URL.createObjectURL(media);
				document.querySelector("#mediaframe").src = localURL;
			}
			
		});
	</script>