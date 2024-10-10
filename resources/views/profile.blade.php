<head>
<link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet">
    
    <link href="https://fonts.cdnfonts.com/css/aachen" rel="stylesheet">
    <style>
        #none{background:#c21807a3;}
        #none:hover{background:#c21807c3;}
        #pending{background:#c21807df;box-shadow: 0 0 8px #c21807;}
        #friends{}
    </style>
</head>

<script src="https://cdn.tailwindcss.com"></script>
<script src="{{asset('js/profile.js')}}" defer></script>
<body>
    @include('mainnav')
<div class="profile fixed top-[10%] bg-slate-200 w-full grid place-items-start h-full p-[1.4rem] overflow-y-scroll grid-cols-5">
    <div class="col-start-1 col-end-4 flex flex-col w-full items-center ">
    <div id="userbar" class="w-5/6 max-h-[300px] h-fit">
            <div class="userinfo" class="flex flex-col items-center justify-around h-full">
                <div class="bg-red-500 w-full flex justify-start rounded-t-[3em] p-[2rem] h-2/3">
                    <img src="{{asset('mole.jpg')}}" class="rounded-full h-[100px] self-end"></img>
                </div>
                <div class="grid grid-cols-2 h-1/3 bg-white">
                    <div class="text-[1.6rem] border-r-2 border-black px-[3.3rem]">
                        <span class="flex justify-between flex-row items-center w-3/4"><strong class='text-slate-800 w-fit'>{{$profile->uname}}</strong>
                            <strong class="text-sm text-slate-600 h-fit text-center w-fit text-[1.1rem] ">
                                Joined: {{$profile->created_at->format('d m Y')}}
                            </strong>
                        </span>
                        <div  class="flex justify-start w-3/4 h-1/2 items-center">
                        <strong class='text-slate-700 w-fit text-[1.1rem] '>{{$profile->name}}</strong>
                        
                        </div>
                    </div>
                    <div class="flex flex-col justify-center align-center w-full px-[1.2rem]">
                        <span class="flex justify-end font-bold align-baseline text ">
                        
                            <button id="{{$status}}" class="border-red-800 text-[1.6rem] text-white flex items-center justify-around aspect-[3.15] w-[150px] rounded-lg active:border-white">
                            @if($status=='none')
                                Follow
                                <img class="h-[70%] aspect-1" src="https://api.iconify.design/carbon:user-follow.svg?color=%23ffffff"></img>
                            @else
                                {{ucwords($status)}}
                            @endif
                        </button>
                        </span>
                    </div>
            </div>
            </div>
        </div>
        <div class="w-7/8 flex flex-col gap-y-2.5 my-[20px] items-center row-span-2 max-w-[600px]">
                @foreach($posts as $post)
                <div class="post w-full bg-white p-4 shadow-md shadow-slate-300" >
                    <input type="hidden" class="postid" value="{{$post['id']}}">
                    <div class="postauth text-3xl w-full flex gap-x-4 h-[60px] border-b-4 border-slate-100 cursor-pointer">
                        <div class="text-1xl font text-sm text-slate-800 not-italic text-bold">
                        <span title="{{$post['exactCreation']}}">{{$post['created_at']}}</span></div>
                    </div>
                    <!-- <strong class="text-5xl w-full block text-center">{{$post['title']}}</strong> -->
                    <article class="w-full" style="font-family:'Lato',roboto,calibri,system-ui;letter-spacing:-.08em;">
                        {!! $post['content'] !!}
                    </article>
                    <div class="text-3xl w-[80%] flex gap-x-4 h-[60px] items-center justify-between">
                        <button class="flex h-[70%] text-sm items-center text-[#39ace7] like {{$post['like']?'disabled':''}}">
                            <img class="h-full" src="{{$post['like']?'https://api.iconify.design/bi:hand-thumbs-up-fill.svg':'https://api.iconify.design/bi:hand-thumbs-up.svg'}}?color=%2339ace7">
                            {{$post['likes']}} Likes
                        </button>
                        <button class="flex h-[70%] text-sm items-center text-[#39ace7]">
                            <img class="h-full" src="https://api.iconify.design/hugeicons:comment-01.svg?color=%2339ace7">
                            {{$post['likes']}} Comments
                        </button>
                        <button class="flex h-[70%] text-sm items-center text-[#39ace7]">
                            <img class="h-full" src="https://api.iconify.design/ic:outline-share.svg?color=%2339ace7">
                            Share
                        </button>
                        
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="w-full h-[80vh] col-start-4 col-end-6 bg-slate-600">
        <!-- Naya component bana madarchod -->
        <div class="w-4/5 bg-white h-[40%] max-h-[200px]">
            Create chat box
        </div>
    </div>
    </div>

</div>
</body>