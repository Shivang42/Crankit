
const quilleditor = new Quill('.postfield',{
	theme:'snow',
	modules:{
		toolbar: [
			['bold', 'italic'],
			 ['underline', 'strike'],
			 ['link','image'],
			 ['blockquote','code-block'],
			[{'list':'ordered'},{'list':'bullet'},{'list':'check'}],
			[{'script':'super'},{'script':'sub'}],
			[{'size':['small',false,'large','huge']}]
		]
	}
});
Array.from(document.querySelectorAll(".like")).forEach((ele)=>{ele.addEventListener("click",async function (e){
	let post = e.target.parentElement.parentElement;
	let id = post.querySelector(".postid").value;
	try{
		let res ;
		if(Array.from(e.target.classList).includes('disabled')){
			res = await axios.delete(`/likes/${id}`);
		}
		else{
			res = await axios.get('/likes/create',{
			params:{
				id:id
			}
			});
		}
		if(res.data.status==200){
			window.location.reload();
		}else{
			console.log(res);
		}
	}catch(e){
		console.log(e);
	}
	
});
});
Array.from(document.querySelectorAll(".postauth")).forEach((pa)=>{
				pa.addEventListener('click',(e)=>{
					let link = e.target.getAttribute('data-link')?e.target.getAttribute('data-link'):e.target.parentElement.querySelector(".postauth").getAttribute('data-link');
					window.location.replace('/profile/'+link);
				});
		});