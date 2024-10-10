<head>
<link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet">
    
    <link href="https://fonts.cdnfonts.com/css/aachen" rel="stylesheet">
    <style>
        #none{background:#c21807a3;}
        #none:hover{background:#c21807c3;}
        #pending{background:#c21807df;box-shadow: 0 0 8px #c21807;}
        span:has(.preview){
            background:#dddddd82 !important;
            padding:3px !important;
        }
        span:has(.preview) *{
            pointer-events: auto !important;
        }
        .mediabar {
              --bgRGB: 73, 89, 99;
              --bg: rgb(var(--bgRGB));
              --bgTrans: rgba(var(--bgRGB), 0);
              
              --shadow: rgba(41, 50, 56, 0.5);
              
              max-height: 200px;
              overflow: auto;

              background:
                /* Shadow Cover TOP */
                linear-gradient(
                  var(--bgTrans),
                  var(--bg) 30%
                ) center left,
                
                /* Shadow Cover BOTTOM */
                linear-gradient(
                  var(--bg) 70%,
                  var(--bgTrans)
                ) center right,
                
                /* Shadow TOP */
                radial-gradient(
                  farthest-side at 0 50%,
                  var(--shadow),
                  rgba(0, 0, 0, 0)
                ) center left,
                
                /* Shadow BOTTOM */
                radial-gradient(
                  farthest-side at 100% 50%,
                  var(--shadow),
                  rgba(0, 0, 0, 0)
                ) center right;
              
              background-repeat: no-repeat;
              background-size: 100% 40px, 100% 40px, 100% 14px, 100% 14px;
              background-attachment: local, local, scroll, scroll;
            }

        .mediabar::-webkit-scrollbar{
            display:none;
        }
        .updmedia::file-selector-button{
            display:none !important;
        }
        .updmedia{
            color:#00000000 !important;
        }
        .updmedia::after{
            transform:translateY(-100%) scaleY(2) !important;
            background:white !important;content:'+';
            color:gray;display:grid;
            place-items: center;
            cursor:pointer;font-weight: bold;
        }
        #newpost-modal{
            z-index:100 !important;
/*            pointer-events:auto;*/
        }
        #newpost-modal *{
            z-index:101 !important;
/*            pointer-events:auto;*/
        }
        .experience input,.experience button{
            background:#ffffff32;border-radius:.3rem;
            pointer-events: auto;
        }
        #friends{}
    </style>
</head>
<script defer src="{{asset('js/dialog.js')}}"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{asset('js/profile.js')}}" defer></script>
<body>
    @include('mainnav')
@if(session()->has('error'))
        <div class="error message">{{session('error')}}</div>
    @endif
    @if(!$errors->isEmpty())
        <script>window.alert(123);</script>
        <div class="error message">{{implode("<br>",$errors->all())}}</div>
    @endif
    <script>let limits = {};</script>
<div class="profile fixed top-[10%] bg-slate-200 w-full grid place-items-start h-full p-[1.4rem] overflow-y-scroll grid-cols-5">
    <div class="col-start-1 col-end-5 flex flex-col w-full items-center gap-y-2">
            <div id="userbar" class="w-5/6 max-h-[300px] h-full gap-y-2">
                    <div class="userinfo" class="flex flex-col items-center justify-between h-full gap-y-2">
                        <div class="bg-red-500 w-full flex justify-start rounded-t-[3em] p-[2rem] h-2/3">
                            <img src="{{asset('mole.jpg')}}" class="rounded-full h-[100px] self-end"></img>
                        </div>
                        <div class="grid grid-cols-2 h-1/3 bg-white">
                            <div class="text-[1.6rem] border-r-2 border-black px-[3.3rem] col-span-2">
                                <span class="flex justify-between flex-row items-center w-3/4">
                                    <strong class='text-slate-800 w-fit'>{{$user->uname}}</strong>
                                    <strong class="text-sm text-slate-600 h-fit text-center w-fit text-[1.1rem] ">
                                        Joined: {{$user->created_at->format('d m Y')}}
                                    </strong>
                                </span>
                                <div  class="flex justify-start w-3/4 h-1/2 items-center">
                                    <strong class='text-slate-700 w-fit text-[1.1rem] '>{{$user->name}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="w-5/6 bg-white rounded-[.3rem] min-h-[100px] h-fit p-1 shadow-[0px_1px_1px_2px_#27272718] flex flex-col gap-y-0">
                <span class="grid items-baseline p-1 h-[8%] min-h-[10px] bg-stone-100">
                    <strong class='row-start-1 row-end-2 text-[#334155] font-normal text-lg'>About </strong>
                    <button class='edit h-[30px] aspect-square row-start-1 row-end-2 justify-self-end'>
                    <img src='https://api.iconify.design/material-symbols:edit.svg?color=%23ca3c25' height=20 width=20 class='absolute'>
                    </button>
                </span>
                    
            </div>
            <script>let limits = {};</script>
            <div class="w-5/6 bg-white rounded-[.3rem] min-h-[100px] h-fit p-1 shadow-[0px_1px_1px_2px_#27272718]">
                    <x-profilesection type='education' />
                    <span class="grid items-baseline p-1 h-[8%] min-h-[10px] bg-stone-100 w-full">
                        <strong class='row-start-1 row-end-2 text-[#334155] font-normal text-lg'>Education </strong>
                        <span class='flex justify-between row-start-1 row-end-2 justify-self-end'>
                        <button data-dialog-target="dialog-education" data-ripple-light="true" class='addEdu h-[26px] w-[70px] border-2 border-solid border-red-600 text-red-600 hover:bg-red-600 hover:text-white rounded-[1.1rem]'>
                        Add
                        </button>
                        <button class='edit h-[30px] aspect-square grid place-items-center'>
                        <img src='https://api.iconify.design/material-symbols:edit.svg?color=%23ca3c25' height=20 width=20 class='absolute'>
                        </button>
                    </span>
                    <span class='flex flex-col gap-y-1 bg-stone-100 w-[90%]'>
                        @foreach($education as $course)
                            <div class='grid w-full min-h-[30px] grid-cols-[60px_auto] bg-white shadow-[0px_2px_1px_#00000018]'>
                                <div class='grid items-start justify-center p-[10%]'>
                                    <img src="{{asset('mole.jpg')}}" class='rounded-full w-[92%]'></img>
                                </div>
                                <div class='flex flex-col gap-y-1 p-[.1rem]'>
                                    <div class='flex flex-col leading-5 p-2'>
                                        <strong class='font-normal text-lg'>{{$course['course_name']}}</strong>
                                        <strong class='font-normal text-md text-stone-600'>{{$course['institute_name']}}</strong>
                                        <strong class='font-normal text-md text-stone-400'>{{date_create_from_format('Y-m-d',$course['start_date'])->format('M-Y')}} - {{date_create_from_format('Y-m-d',$course['end_date'])->format('M-Y')}}</strong>
                                    </div>
                                    <article class='text-sm text-black'>{{$course['description']}}</article>
                                </div>
                            </div>
                        @endforeach
                    </span>
                </span>
            </div>
            <div class="w-5/6 bg-white rounded-[.3rem] min-h-[100px] h-fit p-1 shadow-[0px_1px_1px_2px_#27272718]">
                    <x-profilesection type='work' />
                    <span class="grid items-baseline p-1 h-[8%] min-h-[10px] bg-stone-100">
                    <strong class='row-start-1 row-end-2 text-[#334155] font-normal text-lg'>Experience </strong>
                    <span class='flex justify-between row-start-1 row-end-2 justify-self-end'>
                    <button data-dialog-target="dialog-work" data-ripple-light="true" class='addEdu h-[26px] w-[70px] border-2 border-solid border-red-600 text-red-600 hover:bg-red-600 hover:text-white rounded-[1.1rem]'>
                    Add
                    </button>
                    <button class='edit h-[30px] aspect-square grid place-items-center'>
                    <img src='https://api.iconify.design/material-symbols:edit.svg?color=%23ca3c25' height=20 width=20 class='absolute'>
                    </button>
                    </span>
                    <span class='flex flex-col gap-y-1 bg-stone-100 w-[90%]'>
                        @foreach($work as $job)
                            <div class='grid w-full min-h-[30px] grid-cols-[60px_auto] bg-white shadow-[0px_2px_1px_#00000018]'>
                                <div class='grid items-start justify-center p-[10%]'>
                                    <img src="{{asset('mole.jpg')}}" class='rounded-full w-[92%]'></img>
                                </div>
                                <div class='flex flex-col gap-y-1 p-[.1rem]'>
                                    <div class='flex flex-col leading-5 p-2'>
                                        <strong class='font-normal text-lg'>{{$job['position_name']}}</strong>
                                        <strong class='font-normal text-md text-stone-600'>{{$job['org_name']}}</strong>
                                        <strong class='font-normal text-md text-stone-400'>{{date_create_from_format('Y-m-d',$job['start_date'])->format('M-Y')}} - {{date_create_from_format('Y-m-d',$job['end_date'])->format('M-Y')}}</strong>
                                    </div>
                                    <article class='text-sm text-black'>{{$job['description']}}</article>
                                </div>
                            </div>
                        @endforeach
                    </span>
                </span>
            </div>
            <div class="w-5/6 bg-white rounded-[.3rem] min-h-[100px] h-fit p-1 shadow-[0px_1px_1px_2px_#27272718]">
                <x-profilesection type='project' />
                <span class="grid items-baseline p-1 h-[8%] min-h-[10px] bg-stone-100">
                    <strong class='row-start-1 row-end-2 text-[#334155] font-normal text-lg'>Projects </strong>
                    <span class='flex justify-between row-start-1 row-end-2 justify-self-end'>
                    <button data-dialog-target="dialog-project" data-ripple-light="true" class='addEdu h-[26px] w-[70px] border-2 border-solid border-red-600 text-red-600 hover:bg-red-600 hover:text-white rounded-[1.1rem]'>
                    Add
                    </button>
                    <button class='edit h-[30px] aspect-square grid place-items-center'>
                    <img src='https://api.iconify.design/material-symbols:edit.svg?color=%23ca3c25' height=20 width=20 class='absolute'>
                    </button>
                    </span>
                    <span class='flex flex-col gap-y-1 bg-stone-100 w-[90%]'>
                        @foreach($projects as $project)
                            <div class='grid w-full min-h-[30px] grid-cols-[60px_auto] bg-white shadow-[0px_2px_1px_#00000018]'>
                                <div class='grid items-start justify-center p-[10%] w-full'>
                                    <img src="{{asset('mole.jpg')}}" class='rounded-full w-[92%]'></img>
                                </div>
                                <div class='flex flex-col gap-y-1 p-[.1rem] w-full'>
                                    <div class='flex flex-col leading-5 p-2'>
                                        <strong class='font-normal text-lg'>{{$project['name']}}</strong>
                                        <strong class='font-normal text-md text-stone-400'>{{date_create_from_format('Y-m-d',$project['start_date'])->format('M-Y')}} - {{date_create_from_format('Y-m-d',$project['end_date'])->format('M-Y')}}</strong>
                                    </div>
                                    <article class='text-sm text-black'>{{$project['description']}}</article>
                                    <article class='flex w-[90%] gap-x-1 rounded-[.8rem] overflow-x-scroll mediabar border-4 border-[#272727] border-solid p-2'>
                                        @foreach($project['media'] as $media)
                                            <img src = '{{asset($media)}}' class='max-h-[180px] aspect-auto'/>
                                        @endforeach
                                    </article>
                                </div>
                            </div>
                        @endforeach
                    </span>
                </span>
            </div>
            <script>
                function removePreview(inputmed,i){
                        let datatrans = new DataTransfer();
                        Array.from(inputmed.files).forEach((fl,ind)=>{
                            if(i!=ind){
                                datatrans.items.add(fl);
                            }
                        });
                        inputmed.files = datatrans.files;
                }
                function recalculate(){
                    Array.from(document.querySelector(".preview").children).forEach((cc,i)=>{
                        cc.setAttribute('data-index',i);
                    });
                }
                Array.from(document.querySelectorAll(".updmedia")).forEach((ele)=>{
                    ele.addEventListener('input',(e)=>{
                        let preview = e.target.parentElement.querySelector(".preview");
                        let inputmed = e.target.parentElement.querySelector(".projmedia");
                        let datatrans = new DataTransfer();
                        Array.from(inputmed.files).forEach((fl)=>{
                            datatrans.items.add(fl);
                        });
                        Array.from(e.target.files).forEach((fl)=>{
                            datatrans.items.add(fl);
                        });
                        inputmed.files = datatrans.files;
                        preview.innerHTML = '';
                        Array.from(inputmed.files).forEach((fl,ind)=>{
                            let src = URL.createObjectURL(fl);
                            let cont = document.createElement('div');
                            cont.style.background = `url(${src})`;cont.className = 'grid place-items-center h-[50px] w-fit min-w-[60px] bg-contain border-2 border-stone-800 border-solid';
                            cont.setAttribute('data-index',ind);
                            let rem = document.createElement('button');rem.className='hidden h-[30px] aspect-square text-white bg-[#27272732] rounded-full cursor-pointer';rem.innerHTML = 'x';
                            rem.addEventListener('click',(e)=>{
                                let par = e.target.parentElement.parentElement.parentElement;
                                if(par){
                                    removePreview(par.querySelector('.projmedia'),e.target.parentElement.getAttribute('data-index'));
                                    e.target.parentElement.remove();
                                    recalculate();
                                }
                            });rem.type='button';
                            cont.appendChild(rem);
                            cont.addEventListener('mouseover',(e)=>{
                                e.target.querySelector("button").classList.remove('hidden');
                                e.target.querySelector("button").classList.add('block');
                            });
                            cont.addEventListener('mouseleave',(e)=>{
                                e.target.querySelector("button").classList.add('hidden');
                                e.target.querySelector("button").classList.remove('block');
                            });
                            preview.appendChild(cont);
                        })
                    })
                });
                ['project'].forEach((form)=>{
                    let cform = document.querySelector(`form[name=${form}]`);
                    cform.onsubmit = (e)=>{
                        let preview = e.querySelector('.preview');
                        if(Array.from(e.querySelectorAll('img')).length > limits[form]){
                            window.alert("Maximum 5 allowed")
                            return false;
                        }
                    };
                });
            </script>
            <div class="w-7/8 flex flex-col gap-y-2.5 my-[20px] items-center row-span-2 max-w-[600px]">
                    
            </div>
        </div>
            <div class="w-full h-[80vh] col-start-5 col-end-6 bg-slate-600">
            <!-- Naya component bana madarchod -->
                <div class="w-4/5 bg-white h-[40%] max-h-[200px]">
                    Create chat box
                </div>
            </div>
        </div>

</div>
</body>