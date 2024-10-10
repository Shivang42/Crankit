<html>
<head>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
	<link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet">
	<link href="https://fonts.cdnfonts.com/css/aachen" rel="stylesheet">
	<style>@import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
		
		body{
			display:grid;
			place-items:center;
			background:url('./bg.jpg');
			background-size: cover;
			background-position: center;
			background-repeat:no-repeat;
		}
		.welcome{
			overflow: hidden;
			display:grid;
			grid-template-columns: max(100px,30%) auto;
			grid-template-rows: 90% 10%;
			width:60vw;aspect-ratio:calc(1.96 / 1.08);
			max-height:80vh;
			background:#ffffffc3;
/*			outline:.4rem solid #272727;*/
		}
		#svgdiv{
			transition:.8s ease-in; 
			background:var(--primary);

		}
		.welcome img{
/*			outline:2px solid green;*/
			fill:white;
			height:80%;
			display:block;
			place-self:end;
			aspect-ratio:1;
			transform:translateY(-50px);
/*			animation:drop 1 .8s ease-in-out forwards,tingle infinite 2s ease-in-out;*/
			animation-delay: 0s,.8s;
		}
		.welcome #icard{
			scroll-behavior: smooth;
			overflow-x:scroll;
			color:white;
			flex-wrap:nowrap;
			flex:1;
			font:monospace .6rem;
			background:#272727d3;
			display:none;align-items: center;
			grid-row: 1/3;grid-column: 1 / 3;
			opacity:0;
			transform:translateY(-100px);
			animation: drop 1 forwards ease-in .35s;
		}
		#icard::-webkit-scrollbar,#auth::-webkit-scrollbar,#signupform::-webkit-scrollbar{
			display:none;
		}
		#icard #about{
			background:var(--primary);
			flex-shrink:0;
			background:#272727;
			overflow-y:scroll;
			flex-direction: column;
			display:flex;align-items: center;
			padding:.8rem;font-size:1.2rem;
			height:100%;width:65%;
		}
		#about blockquote{
			font-family:bahnschrift;
			background:radial-gradient( #272727c2, #272727),
    url(https://grainy-gradients.vercel.app/noise.svg);padding-bottom:.4rem;
			border-bottom:.3rem solid white;
		}
		#icard #auth{
			flex-shrink:0;
			display:grid;place-items: center;
			background:white;height:100%;width:35%;
		}
		#icard #sform{
			transition:.2s ease-in;
			font-size:1.6rem;
			color:white;cursor:pointer;
			border-radius:.5rem;
			padding:.4rem;
			width:70%;aspect-ratio:calc(1.96/0.8);
			background:#DC143C;
			font-family:bahnschrift;
			border:5px double white;
		}

		#sform:hover{
			transform:scale(1.2);
			box-shadow:2px 2px 15px #DC143Cd3;
		}
		#lform{
			font-size:1.6rem;
			color:#272727;cursor:pointer;
			border-radius:.5rem;
			padding:.4rem;
			width:70%;aspect-ratio:calc(1.96/0.8);
		}
		#icard #signupform{
			display:grid;
			grid-template-columns: 50% 50%;
			background:#171314;
			flex-shrink:0;
			width:100%;height:100%;
		}
		#signupform img{
			place-self:end;height:100%;
		}
		#signupform form{
			place-self:end center;
		}
		.authform fieldset{
			height:80%;width:100%;
			display:flex;flex-direction: column;
			justify-content: space-between;
			border:none;
			font-family:bahnschrift;
		}
		.authform fieldset span:has(input){
			align-self: stretch;
		}
		.authform fieldset span:has(select){
			align-self: end;padding:0rem 10%;
		}
		.authform fieldset label{
			display:inline-block;
			width:max(80px,30%);
		}
		.authform fieldset input{
			background:#ffffff34;
			width:60%;border-radius:.3rem;
			border:2px solid white;
			margin-left:.5rem;
			color:white;
		}
		.authform fieldset select{
			margin-right:.6rem;
		}
		.authform fieldset button{
			font-family:'Aachen';
			border:.2rem double white;
			color:white;
			font:monsopace;
			border-radius:.2rem;
			font-size:1.2rem;
			background:#ee7600;
			cursor:pointer;
		}
		.welcome article{
			grid-column: 1 / span 2;
			/*background: repeating-conic-gradient(
  from 45deg at 10% 50%,
  var(--primary) 0deg 1deg,
  white 1deg 2deg,
  var(--primary) 2deg 3deg
);*/
			background:var(--primary);
			display:flex;align-items:center;
			justify-content: center;
			padding:.1rem;
			width:100%;gap:max(2rem,8%);
			outline:2px solid orange;
			font-family:bahnschrift;
			font-size:2rem;
			color:#272727;
			transition:.8s ease-in; 
		}
		article h1{
			font-size:5rem;color:white;
			text-align:center;
			font-family:"Jost",bahnschrift;
			text-shadow:5px 5px #272727a3;
			animation:drop .8s 1 forwards ease-out;
		}
		article p{
			display:none;text-align: center;
		}
		.errmodal{
			transform:translateY(-20%);
			animation-name:dropmodal,raisemodal;
			animation-delay:0s,3s;
			animation-duration:.9s,1s;
			animation-timing-function: ease-in;
			animation-fill-mode: forwards;
		}
		#footer{
			grid-column: 1 / 3;
			height:100%;width:100%;
			transition:all .2s ease-in-out;
			opacity:0;
			display:grid;place-content: center;
		}
		#footer label{
			font-family:monospace;
			font-weight:800;
		}
		#footer:hover{
			transform:translateY(50%) scaleY(150%);
			background:#fcc212D2;
			cursor:pointer;
			opacity:1;
		}
		.message{
			height:min-content;min-height:50px;
			width:80vh;animation:drop alternate 2 2s ease-in-out forwards;
			font-family:bahnschrift;font-size:1.3rem;
		}
		.error{
			background:var(--primary);color:white;
		}
		@keyframes dropmodal{
			from{
				opacity:0;
			transform:translateY(-20%);
			}
			to{
				opacity:1;
				transform:translateY(20%);
			}
		}
		@keyframes raisemodal{
			to{
				opacity:0;
				transform:translateY(-20%);
			}
		}
		@keyframes drop{
			from{
				opacity:0;transform:translateY(-100px);
			}
			to{
				opacity:1;transform:translateY(0px);
			}
		}
		@keyframes tingle{
			0%{
				transform:rotate(0deg);
			}
			10%{
transform:rotate(-15deg);
			}
			30%{
transform:rotate(15deg);

			}
			40%{
transform:rotate(0deg);

			}
			100%{
				transform:rotate(360deg);
			}

		}
	</style>
</head>
<script src="https://cdn.tailwindcss.com"></script>
<script>
	function start(){

	document.querySelector("#footer").addEventListener('click',(e)=>{
		Array.from(e.target.parentElement.children).forEach((child)=>{
			if(child.id!='icard'){
				child.style.transform = 'translateY(100%)';
				// setTimeout(1000,()=>{
				// 	child.style.display='none';
				// });
			}
			else{
				setTimeout(()=>{
					child.style.display = 'flex';
				},650);
				
			}
		})
	});
	document.querySelector("#sform").addEventListener('click',(e)=>{
		e.target.parentElement.parentElement.scrollLeft += 1500;
	});
	@if ($errors->any())
			document.querySelector("#footer").click();
			document.querySelector("#sform").click();
		@endif
	}
	function errorModal(msg){
		let modal = document.createElement('div');
		modal.setAttribute('data-dialog-backdrop','errormsg');
		modal.setAttribute('data-dialog-backdrop-close','true');
		modal.setAttribute('class','errmodal w-screen h-40 bg-zinc-800 bg-opacity-0 inset-0 z-999 fixed grid place-items-center transition-opacity duration-600')
		modal.innerHTML = `
		<div data-dialog="errormsg" class="bg-red-700 relative font-light min-w-[40%] max-w-[40%] bg-opacity-80 border-yellow-600 border-dotted border-4">
		<div class="text-white relative p-4 text-lg font-black font-sans">
		${msg}</div></div>`;
		document.body.appendChild(modal);
	}
	function inlistener(e){
		e.target.style.background = '#ffffff34';
		e.target.removeEventListener('input',inlistener);
	}
	function validateF(){
		let doc = document.forms["signup"];
		let msg = "";let flag = true;
		Object.values(doc).forEach((ele)=>{
			if(ele.type=='text'){
				let ff = true;
				if(ele.value==''){
					ff = false;
				}
				if(ele.value.length>50){
					msg+=`${ele.previousSibling.innerText} has to be smaller than 50 characters\n`;
					ff = false;
				}
				if(!ff){
					flag = false;
					ele.style.background = '#b22222c3';
				ele.addEventListener('input',inlistener);
				}
				}
			else if(ele.type=='email'){
				if(ele.value==''){
					flag = false;
				ele.style.background = '#b22222c3';
				ele.addEventListener('input',inlistener);
				}
				// Check if email is valid here using API calls
			}
});
		if(doc['upwd'].value!=doc['upwd2'].value){
			msg+='Passwords must match';
			flag = false;
			doc['upwd'].style.background = '#b22222c3';
				doc['upwd'].addEventListener('input',inlistener);
			doc['upwd2'].style.background = '#b22222c3';
				doc['upwd2'].addEventListener('input',inlistener);	
		}
		if(!flag){
			if(msg!=""){
				errorModal(msg);
			}
			return false;
		}

	}
	window.onload = start;
</script>
<body>
	@auth
	<div class="fixed top-0 left-0 w-full z-4" style="background:#dddddd;">
		@include('mainnav')
		</div>
	@endauth
	@if(session()->has('error'))
		<div class="error message">{{session('error')}}</div>
	@endif
	@if(!$errors->isEmpty())
		<script>window.alert(123);</script>
		<div class="error message">{{implode("<br>",$errors->all())}}</div>
	@endif
	<div class="welcome">
	<article>
		<img src="./cube.svg"></img>
		<h1>Crankin</h1>
	</article>
	<div id="footer">
		<label>Read more</label>
	</div>
	<div id="icard">
		<div id="about">
			<blockquote>
				OUR VISION: To help you get the job that realizes your true potential. We're a dedicated job search site, connecting talented individuals with top employers and opportunities that align with their skills and aspirations. 
			</blockquote>
			<blockquote>
				Explore our vast job listings, get expert career advice, and take the first step towards a fulfilling career that brings you joy, satisfaction, and success! ...
			</blockquote>
		
	</div>
	<p id="auth">
		<button id="sform" onclick="signslide">Sign up now</button>
		<span  id="lform" >Already signed in ? , <a href="/?form=login">log in here</a>
	</p>
	<div id="signupform">
		@if($form=='signup')
			<form onsubmit = "return validateF();" action="/registeruser" method = "POST" name='signup' class='authform'>
			@csrf
			<fieldset>
				<span><label>First Name</label><input name="uname" type="text"></span>
				<span><label>Username</label><input name="uuname" type="text"></span>
				<span><label>Email-id</label><input name="umail" type="email"></span>
				<span>
					<select id="countries" name="ustatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
				    <option selected>Your status</option>
				    <option value="Student">Student</option>
				    <option value="Unemployed">Unemployed</option>
				    <option value="Employee">Employee</option>
				    <option value="hiring">Hiring personnel</option>
				    <option value="owner">Business Owner</option>
  				</select>
				</span>
				<span>
					<label>Password</label><input name="upwd" type="text"></span>
				<span><label>Confirm Password</label><input name="upwd2" type="text"></span>
				<span><button>Sign up</button>
				</span>
			</fieldset>
		</form>
		@else
			<form onsubmit = "return validateF();" action="/user/login" method = "POST" name='login' class='authform'>
			@csrf
			<fieldset>
				<span><label>Username</label><input name="uname" type="text"></span>
				<span>
					<label>Password</label><input name="upwd" type="text"></span>
				<span><button>Login</button>
				</span>
			</fieldset>
		</form>
		@endif
		
<img src="./mole2.jpg">
	</div>
	</div>
	</div>

</body>
</html>