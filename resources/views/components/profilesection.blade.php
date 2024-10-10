<div id="newpost-modal" data-dialog-backdrop="dialog-{{$type}}" data-dialog-backdrop-close="true" class="size-full fixed top-0 left-0 overflow-x-hidden overflow-y-auto pointer-events-none grid place-items-center backdrop-blur-sm duration-300 inset-0" role="dialog" tabindex="-1" aria-labelledby="newpost-modal-label">
                        <div data-dialog="dialog-{{$type}}" class="relative transition-all m-4 w-[40vw] h-[80%] max-h-[80vh] min-w-[600px] bg-white ">
                            <div class="experience pointer-events-none h-full w-full flex flex-column justify-center" data-states="">
                                    <article class="textarea grid grid-rows-6 bg-slate-800 p-4 w-full h-full rounded-xl text-white ">
                                        <strong class="w-full text-3xl font-dark border-b-4 border-[#27272723] text-grey-200 grid place-items-center" placeholder="Title" form="postform" name="post_title">{{$section["header"]}}</strong>
                                        <form enctype="multipart/form-data" class="flex flex-col gap-y-2 justify-around items-center p-2 row-span-4 w-full-h-full text-white text-lg" name="post" id="{{$type}}" method="POST" action="../../{{$type}}">@csrf
                                            <img class="block min-h-[60px] h-[35%] aspect-square rounded-full outline-4 outline-white outline-solid" src={{$section["icon"]}}></img>
                                            @foreach($section['fields'] as $field)
                                                <span class="block flex justify-between w-full shadow-[0px_1px_1px_3px_#27272712]">
                                                    @foreach($field as $tag)
                                                        @if(isset($tag['label']))
                                                            <strong class="text-center">{{$tag['label']}}</strong>
                                                        @endif
                                                        @if($tag['type']=='multfiles')
                                                            <span class='preview flex gap-x-2 flex-wrap max-w-[80%]'>
                                                            </span>
                                                            <input type='file' class='updmedia rounded-[.6rem] bg-slate-200 w-[80px] h-[40px] text-white border-2 border-solid border-white' multiple />
                                                            <input type="file" name={{$tag["name"]}} class='projmedia hidden' multiple />
                                                            <script>limits[{{$type}}]={{$tag['limit']}};</script>
                                                        @else                                       
                                                           <input name={{$tag["name"]}} type={{$tag["type"]}} placeholder="{{$tag['type']=='text'?$tag['placeholder']:''}}" class='w-[{{100 / count($field)}}%]'/>
                                                    @endif               
                                                @endforeach
                                        </span>
                                
                                        @endforeach
                                    
                                    </form>
                                    <span class="w-full border-t-4 border-[#27272723] flex flex-row items-center">
                                        <button class="submit-post bg-red-400 text-white h-[80%] w-[120px] hover:bg-red-800 font-bold" type="submit" form="{{$type}}">Publish</button>
                                    </span>
                    </article>
            </div>
    </div>
</div>