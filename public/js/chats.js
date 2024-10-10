function showOptions(e){
    e.preventDefault();
    console.log(e.target.className);
    if(e.target.className.includes('menu')){
        e.stopImmediatePropagation();return;
    }
    let chat = e.target;let cords = chat.getBoundingClientRect();
    let menu = document.createElement('div');menu.className = `menu fixed left-[${Math.floor(cords.x)}] top-[${Math.floor(cords.y + cords.height/2)}px] h-[200px] w-[160px] flex flex-col rounded-md bg-white text-[#272727] font-light shadow-[-1px_-1px_10px_black]`;
    [{'label':'Reply','listener':createReply},{'label':'Save','listener':delText},{'label':'Delete','listener':delText}].forEach((but)=>{
        let opt = document.createElement('button');
        opt.className = `menuitem hover:bg-stone-200 p-2 font-light text-center border-b-1 border-black border-solid w-full min-h-[10px]`;
        opt.innerText = but.label;
        menu.appendChild(opt);
        opt.addEventListener('click',but.listener);
    });
    
    chat.appendChild(menu);
    
    chat.addEventListener('mouseleave',(e)=>{
        chat.removeChild(menu);
        let nchat = chat.cloneNode(true);nchat.oncontextmenu = showOptions;
        chat.parentElement.replaceChild(nchat,chat);
    });
    document.body.addEventListener('click',function (e){
        chat.removeChild(menu);
        document.body.removeEventListener('click',this);
    });
}

function changeUser(e){
		let cspace = document.querySelector(".chatspace"),currdate = '';
        cspace.innerHTML = '';
        chats[e.target.innerText].forEach(function(chat){
            let cat = new Date(chat.created_at);
            if(this.currdate!=cat.toLocaleDateString()){
                this.currdate = cat.toLocaleDateString();
                cspace.innerHTML+=`<strong class='self-center text-white p-[1rem] rounded-full text-[#272727] w-fit border-white-400 border-2 bg-stone-400'>${this.currdate}</strong>`;
            }
            let created = cat.getHours().toString().padStart(2,0)+":"+cat.getMinutes().toString().padStart(2,0);
            let msg = e.target.innerText=='Crankin'?`<strong>${chat.from} wants to follow you </strong><button class="bg-red-800 text-white text-md p-[.2rem] rounded-[.4rem]">Friend</button>`:`<strong class="self-end text-grey-200 text-[.75rem]">${created}</strong><strong class="content text-white">${chat.content} </strong>`;
            let header = document.createElement('div');
            header.setAttribute('class',`flex flex-col ${chat.type=='sent'?'schat':'rchat'} chat p-[1rem] w-fit min-w-[80px] max-w-[400px] rounded-[1.1rem] text-[#272727] w-[90%] border-white-400 border-2 cursor-pointer`);
            header.setAttribute('data-ref',chat.id);
            header.innerHTML = msg;
            header.oncontextmenu =  showOptions;
            if(e.target.innerText=='Crankin'){
                cspace.appendChild(header);
            }
            else{
                cspace.appendChild(header);
            }
        },this);
        this.currdate = '';
        cspace.setAttribute('data-user',e.target.innerText);
        
        Array.from(document.querySelectorAll(".user")).forEach((ele)=>{
            if(ele.innerText!==e.target.innerText){ele.classList.remove('activeuser')}
        })
        e.target.classList.toggle('activeuser');
        cspace.scrollBy(0,cspace.scrollHeight);
}
async function sendText(e){
        let cspace = document.querySelector(".chatspace"),cbox = document.querySelector("#chatbox");
        let profile = cspace.getAttribute("data-user");
        let url = encodeURI(window.location.origin+`/chats/create`);
        // Add emoji functionality here
        let resp = await axios.put(url,{uname:profile,content:cbox.value},{withCredentials:true});
        if(resp.status==200){
            window.location.reload();
        }
        else{
            // create notification message here
            window.alert(`couldn't send message`);
        }
}
function createReply(e){
    let chat = e.target.parentElement.parentElement;
    let cspace = document.querySelector('.chatspace');
    cspace.scrollTo(0,cspace.scrollHeight);
    let reply = document.createElement('div');
    // Change chat field state to reply
    reply.className = `grid grid-rows-[16px_auto] bottom-[-3px] mb-[-55px] ml-[-5%] p-1 text-md transform translate-y-[-20px] transition-transform duration-1000 font-normal text-white rounded-t-lg bg-stone-200 overflow-ellipsis border-2 border-2 border-white w-[90%]`;
    reply.innerHTML+= `<span class='w-full flex justify-end'><button class='close h-full aspect-square'><img src='https://api.iconify.design/material-symbols:close-small-rounded.svg?color=%23272727'></button></span>`;
    reply.innerHTML+= `<strong class='w-full pl-3 font-lg'>${chat.className.includes('content')?chat.innerText:chat.querySelector('.content').innerText}</strong>`;
    reply.querySelector('.close').addEventListener('click',deleteReply.bind(reply));
    cspace.appendChild(reply);
}
function deleteReply(e){
    // Remove the reply state from the chat field
    this.remove();
}
async function delText(e){
        let chat = e.target.parentElement.parentElement;
        let cref = chat.getAttribute("data-ref");
        let url = encodeURI(window.location.origin+`/chats/destroy`);
        // Add emoji functionality here
        console.log(cref);
        let resp = await axios.put(url,{cref},{withCredentials:true});
        if(resp.status==200){
            window.location.reload();
        }
        else{
            // create notification message here
            window.alert(`couldn't delete message`);
        }
}
async function follow(e){
        let profile = e.target.getAttribute("data-target");
        let url = encodeURI(window.location.origin+`/friends/follow/${profile}`);
        let resp = await axios.get(url,{withCredentials:true});
        if(resp.status==200){
            window.location.reload();
        }
        else{
            // create notification message here
            console.log(resp);
            window.alert(`couldn't follow back`);
        }
}
Array.from(document.querySelectorAll(".user")).forEach((e)=>{
    e.addEventListener("click",changeUser);
})
Array.from(document.querySelectorAll(".follow")).forEach((e)=>{
    e.addEventListener("click",follow);
})
Array.from(document.querySelectorAll(".chat")).forEach((e)=>{
    e.addEventListener("click",sendText);
})
console.log(chats);