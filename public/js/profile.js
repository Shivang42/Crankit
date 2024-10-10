async function sendRequest(e){
	let resp = await axios.get('/friends/request',{
		params:{
			to:window.location.href.split('/profile/').at(-1)
		}
	});
	let data = resp.data;
	if(resp.status==200){
		e.target.id = 'pending';
		e.target.innerText = 'Pending';
		e.target.removeEventListener("click",this);
		e.target.addEventListener("click",unRequest);
	}
	else{
		window.alert("Couldn't request");
	}
}
async function unRequest(e){
	let resp = await axios.get('/friends/unrequest',{
		params:{
			to:window.location.href.split('/profile/').at(-1)
		}
	});
	let data = resp.data;
	if(resp.status==200){
		e.target.id = 'none';
		e.target.innerText = 'Follow';
		e.target.removeEventListener("click",this);
		e.target.addEventListener("click",sendRequest);
	}
	else{
		window.alert('Couldn\'t request');
	}
}


document.querySelector("#none").addEventListener("click",sendRequest);