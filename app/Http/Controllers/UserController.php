<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;use App\Models\Posts;
use App\Models\Like;use App\Models\Friends;
use Illuminate\Support\Facades\Hash;

function getTag($cdate){
$curr = new \DateTime();
$prev = new \DateTime($cdate);
$diff = date_diff($curr,$prev);
$maxstr = '';
foreach(['year'=>'y','month'=>'m','day'=>'d','hour'=>'h','minute'=>'i','second'=>'s'] as $tag=>$param){
    $num = $diff->$param;
    $prefix = $num;$suffix = "";
    if($num > 0){
        $max = $num;
        if($num == 1){
            $prefix = ((preg_match("/^[aeiouyh]/",$tag)==1)?"an":"a");
        }else{
        $suffix = "s";}
        if(array_search($param, ['M','s'])){
                $prefix = "few";
        }
        $maxstr = $prefix." ".$tag.$suffix." ago";
        break;
    }   
}
return $maxstr;
}
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $req){
        $validation = $req->validate([
            'uname'=>'required|not_regex:/.+\-.+/i',
            'upwd'=>'string|required|max:32'
        ]);
        $newuser = User::where('uname','=',$req->input('uname'))->get()[0];
        // Check if newuser was created here
        if($newuser && $newuser->password){
            $ismatch = Hash::check($req->input('upwd'), $newuser->password);
            if($ismatch){
                $user = cookie('userid',$newuser->id,1000);
                return redirect()->route('user.show');
            }
            else{
                session()->flash('error','Incorrect password');
                return redirect()->route('main.show');
            }
            
        }
        else{
            session()->flash('error','User not found');
                return redirect()->route('main.show');
        }
        
    }
    public function store(Request $req)
    {
        $validation = $req->validate([
            'uname'=>'required|not_regex:/.+\-.+/i',
            'uuname'=>'required|alpha',
            'umail'=>'required|email',
            'upwd'=>'string|required|max:32',
            'upwd2'=>'string|required|max:32',
            'ustatus'=>'string|required'
        ]);
        $newuser = User::create(array(
            'name'=>$req->input('uname'),
            'email'=>$req->input('umail'),
            'password'=>$req->input('upwd'),
            'uname'=>$req->input('uuname'),
            'status'=>$req->input('ustatus')
        ));
        // Check if newuser was created here

        return redirect()->route('user.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $req,string $userid = '')
    {
        // $user = $req->cookie('userid');
        // $cuser = User::find($user);
        if(!Auth::check()){
            session()->flash('error','Not logged in');
            return redirect()->route('main.show');
        }
        else if($userid!=''){
            $profile = User::cursor()->filter(function ($user) use($userid) {
                return $user['identifier'] == $userid;
            })->first();
            if($profile && $profile->id!=Auth::user()->id){
                $friendship = Friends::where(['friend1'=>Auth::user()->id,'friend2'=>$profile->id])->first();
                if(!$friendship){
                    $status = 'none';
                }else{
                    $status = $friendship->type;
                }
                $feed = Posts::query()->where('creator','=',$profile->id)->orderByDesc('updated_at')->limit(10)->get()->toArray();
                $nfeed = [];
                foreach($feed as $post){
                $npost = $post;
                $npost['exactCreation'] = $npost['created_at'];
                $npost['created_at'] = getTag($npost['created_at']);
                $posterobj = User::where('id',$post['creator'])->get()[0];$npost['author'] = [];
                if(isset($posterobj)){
                    error_log($posterobj);
                    $npost['author']['joined'] = $posterobj->created_at;
                    // $npost['author']['ppic'] = "{{asset('mole.jpg')}}";
                    $isLiked = Like::where('user_id',Auth::user()->id)->where('post_id',$post['id'])->exists();
                    $npost['like']= $isLiked;
                    array_push($nfeed,$npost);
                }
                else{
                    array_push($nfeed, []);
                }
            }
            foreach($nfeed as $newpost){
                error_log($newpost['like']);
            }
                $user = Auth::user();
                unset($user->password);
                unset($profile->password);
                return view('profile',[
                'user'=>$user,
                'profile'=>$profile,
                'status'=>$status,
                'posts'=>$nfeed
                ]); 
            }  
            elseif(!$profile){
                return redirect()->back();
            }
                
        }
            $cuser = $req->user();
            $feed = [];$comm  = [];
            foreach($cuser->friendWith->merge($cuser->friendOf) as $friend){
                $post = Posts::query()->where('creator','=',$friend->id)->orderByDesc('updated_at')->limit(10)->get();

                for($j = 0;$j < count($post);$j++){
                    $comm[$j] = $post[$j]->comments->sortByDesc('created_at');
                }

                $post = $post->toArray();
                for($i = 0;$i < count($comm);$i++){
                    $post[$i]['comments'] = $comm[$i]; 
                }
                $feed = array_merge($feed,$post);
            } 
            // $feed = Posts::query()->orderByDesc('updated_at')->limit(10)->get()->toArray();
            $nfeed = [];
            foreach($feed as $post){
                $npost = $post;
                $npost['exactCreation'] = $npost['created_at'];
                $npost['created_at'] = getTag($npost['created_at']);
                $posterobj = User::where('id',$post['creator'])->get()[0];$npost['author'] = [];
                if(isset($posterobj)){
                    error_log($posterobj);
                    $npost['author']['name'] = $posterobj->uname;
                    $npost['author']['joined'] = $posterobj->created_at;
                    $npost['author']['link'] = $posterobj->identifier;
                    // $npost['author']['ppic'] = "{{asset('mole.jpg')}}";
                    $isLiked = Like::where('user_id',$cuser->id)->where('post_id',$post['id'])->exists();
                    $npost['like']= $isLiked;
                    array_push($nfeed,$npost);
                }
                else{
                    array_push($nfeed, []);
                }
            }
            foreach($nfeed as $newpost){
                error_log($newpost['like']);
            }
            unset($cuser->password);
            return view('display',[
            'user'=>$cuser,
            'posts'=>$nfeed
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req)
    {
        $cuser = $req->user();
        $education = $cuser->institutes;$eds = $education->toArray();
        for($i = 0;$i < count($eds);$i++){
            $eds[$i]['institute_name'] = $education[$i]->institute->institute_name;
            $eds[$i]['course_name'] = $education[$i]->course->course_name;
        }
        usort($eds,function ($a,$b){
            if($a['start_date']==$b['start_date']){return 0;}
            if($a['start_date']<$b['start_date']){return 1;}
            else{return -1;}
        });
        $work = $cuser->jobs;$jobs = $work->toArray();
        for($i = 0;$i < count($jobs);$i++){
            $jobs[$i]['org_name'] = $work[$i]->organization->organization_name;
            $jobs[$i]['position_name'] = $work[$i]->position->position_name;
        }
        usort($jobs,function ($a,$b){
            if($a['start_date']==$b['start_date']){return 0;}
            if($a['start_date']<$b['start_date']){return 1;}
            else{return -1;}
        });
        $projects = $cuser->projects;$projs = $projects->toArray();
        for($i = 0;$i < count($projects);$i++){
            $projs[$i]['media'] = [];
            foreach($projects[$i]->media as $media){
                array_push($projs[$i]['media'],'/projectmedia/'.$media->user_id.'/'.$media->project_id.'/'.$media->file_path);
            }
        }
        usort($projs,function ($a,$b){
            if($a['start_date']==$b['start_date']){return 0;}
            if($a['start_date']<$b['start_date']){return 1;}
            else{return -1;}
        });
        unset($cuser->password);
        return view('editprofile',[
            'user'=>$cuser,'work'=>$jobs,
            'education'=>$eds,'projects'=>$projs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
