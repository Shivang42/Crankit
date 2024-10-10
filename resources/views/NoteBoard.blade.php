<html>
<head>
    <style></style>
    <link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet">
    <link rel="stylesheet"
  href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css"
/>
<script src="https://cdn.tailwindcss.com"></script>
<script defer>
    let chats = @json($chats);
    Object.keys(chats).forEach((ele)=>{
        chats[ele].sort(function (a,b){
        if(a.created_at < b.created_at){return -1;}
        else if (a.created_at > b.created_at){return 1;}
        else{return 0;}
    })
    });
</script>
<style>
    .user:not(.activeuser){background:#ca3c25;color:white;}
    .user:is(.activeuser){background:white;color:#ca4c25;}
    .schat{background:#ca3c25;align-self:end !important;}
    .rchat{background:#ca3c25d2;align-self:start !important;}
</style>
</head>
<body class="bg-[#f4f2ee]">
@include('mainnav')
<div class="fixed flex top-[15vh] flex-col bg-[#E2C2FF] border-2 items-start w-[22%] max-w-[200px] h-[80%] max-h-[500px]">
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
    @foreach($chats as $user=>$uchats)
        <button class="{{$user==='Crankin'?'activeuser':''}} user p-[.4rem] text-[1.2rem] text-center w-full border-white-400 border-2 cursor-pointer">{{$user}}</button>
    @endforeach
</div>

<div class="grid grid-rows-7 max-h-[480px] fixed text-md flex top-[17vh] left-[25vw] flex-col bg-white shadow-black border-2 w-[70%] min-w-[300px] h-[80%]">
<div class="chatspace row-start-1 row-end-7 text-md p-[.6rem] border-red flex flex-col bg-white shadow-black border-2 gap-[.5rem] overflow-y-scroll ">
</div>
<div class="flex justify-around bg-stone-200 px-[.6rem] py-[.4rem]">
    <input id="chatbox" type="textarea" placeholder='Type a message ....' class="w-[80%] p-[.4rem] focus:outline-[#ca3c25] focus:outline-4" />
    <emoji-picker class='hidden emote ml-[-5px]'></emoji-picker>
    <button class="emote self-start bg-white h-full ml-[-8px]">
            <img src="https://api.iconify.design/mingcute:emoji-fill.svg?color=%2327272742" class="h-[65%] aspect-square"></img>
    </button>
    <button class="chat p-[.4rem] text-[1.2rem] text-white text-center w-[15%] border-white-400 border-2 bg-[#ca3c25] rounded-[.6rem] cursor-pointer">Submit</button>
</div>
</div>
<script>
        let cspace = document.querySelector(".chatspace");
        chats['Crankit'].forEach((chat)=>{
            cspace.innerHTML+='<div class="p-[1rem] max-w-[400px] rounded-[1.1rem] text-[#272727] text-center w-[90%] border-white-400 border-2 bg-stone-400 cursor-pointer">'+`<strong>${chat.from} wants to follow you </strong> <button class="follow bg-red-800 text-white text-md p-[.2rem] rounded-[.4rem]" data-target=${chat.fromid}>Friend</button>`+'</div>';
           
        });
        cspace.scrollBy(0,cspace.scrollHeight);
</script>
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
            Array.from(document.querySelectorAll("emoji-picker")).forEach((ele)=>{
                ele.addEventListener('emoji-click',(e)=>{
                    insertText(document.querySelector('#chatbox'),e.detail.unicode);
                    document.body.addEventListener('click',emoji);
                });
            });
</script>
<script src="{{asset('js/chats.js')}}">  </script>
</body>
</html>
