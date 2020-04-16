<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Banks;
use App\BanksAcc;
use App\Branchs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\Repositories\RepositoryServiceProvider;


class UserController extends Controller
{
    /**
     * @var PostRepositoryInterface|\App\Repositories\Repository
     */
    protected $repository;
    
    public function __construct(Request $request,RepositoryServiceProvider $repository)
    {
        parent::__construct($request);
        $this->middleware('auth');
        $this->repository = $repository;
        
    }
    public function show(Request $request)
    {
    	//lay user + phan trang
        $this->data['user']=$this->repository->paginate(10);
    	// dd($user);
    	return view('layouts.user',$this->data);
    }
    public function showUsers($userId=null, $del=null)
    {
    	if($userId!=null){
            if($del == 'del'){
                $one = User::find($userId);
                if($one) $one->delete();
                return 1;
            }
           $user= User::find($userId);
            if($user){
               	return view('detal.user-detal',compact('user'));
            }else{
                return "";
            }
        }else{
            	return view('detal.user-detal');
        }
    }
    public function store(Request $request)
    {
    	// return $request->input();
    	 try{
            if(count($request->input()) >0){
                if(array_key_exists('id', $request->input())){
                    $validator = Validator::make($request->all(),
                        [   
                            'id'    =>  'integer|min:1|nullable',
                           	'Fullname'  =>  'required|string|max:100',
                            'email' =>  'required|string|email',
                            'Birthday'  =>  'required|date|before:yesterday',
                            'Gender'    =>  'required|boolean',
                            'adress'    =>  'string|nullable',
                            'Tel'   =>  'string|min:10|max:12|nullable',
                            'isAdmin' => 'required|boolean'
                        ]);
                }else{
                    $validator = Validator::make($request->all(),
                        [
                            'Fullname'  =>  'required|string|max:100',
                            'email' =>  'required|string|email',
                            'password' => 'required|string|min:6|confirmed',
                            'Birthday'  =>  'required|date|before:yesterday',
                            'Gender'    =>  'required|boolean',
                            'adress'    =>  'string|nullable',
                            'Tel'   =>  'string|min:10|max:12|nullable',
                            'isAdmin'  =>  'required|boolean',
                        ]);
                }

                if ($validator->fails())
                {
                    return response()->json(['errors'=>$validator->errors()->all()]);
                }

                $validated = $validator->validate();
                
                if(array_key_exists('id', $validated)){                
                    $user = User::find($validated['id']);
                }else{
                    $user = new User();
                   	
                }               
                foreach($validated as $key => $value){
                    if(Schema::hasColumn('users', $key))
                        $user->$key = $value;
                }

                if(!array_key_exists('id', $validated)){
                    $user->password = Hash::make($validated['password']);
                }
                // return $user;
                $user->save();
                return response()->json(['success' => route('user')]);
            }else{
                return abort('404');
            }
        }
        catch (\Exception $e){
            return $e->getMessage();
        }
    }
    public function showBanks(Request $request)
    {	
    	$name=$request->name;
    	$this->data['bank']=User::query()
    	->join('banksacc','users.id','banksacc.userid')
    	->join('branch','branch.id','banksacc.branchsid')
    	->join('banks','banks.id','branch.banksid')
    	->where('users.id',$name)
    	->select('users.id as usersid','users.Fullname','banksacc.id as banksaccid','banksacc.accName','banksacc.accNumber','branch.branchName','banks.banksName')
    	->get();
        $this->data['name']=$name;
    	// dd($bank->toArray());
    	// dd($user);
    	return view('layouts.bank',$this->data); 
    }
    public function Banks($bAccId=null, $del=null)
    {    	
    	$this->data['banks']=Banks::query()->get();
    	$this->data['user']=User::query()->get();
    	$this->data['branch']=Branchs::query()->get();
    	if($bAccId!=null){
    		if($del == 'del'){
                $one = BanksAcc::find($bAccId);
                if($one) $one->delete();
                return 1;
            }
    	 $bAcc= BanksAcc::query()
    	 ->where('id',$bAccId)
    	 ->first();
            if($bAcc){
                $this->data['bAcc']=$bAcc;
               	return view('detal.bank-detal',$this->data);
            }else{
                return "";
            }
        }else{
    		return view('detal.bank-detal',$this->data);
    	}
    }
    public function getBranch($id = null)
    {
    	if($id != null){
            $branch = Branchs::query()
                ->where('banksid', $id)
                ->get()
                ->toArray();
//        return json_encode($users);
            return $branch;
        }else{
            return array();
        }
    }

    public function storeBank(Request $request)
    {
    	 // return $request->input();
    	try{
            if(count($request->input()) >0){
                if(array_key_exists('id', $request->input())){
                    $validator = Validator::make($request->all(),
                        [   
                            'id'    =>  'integer|min:1|nullable',
                            'accNumber' => 'string|min:10|max:20|nullable',
                            'accName'  =>  'string|max:100',
                        ]);
                }else{
                    $validator = Validator::make($request->all(),
                        [
                            'userid'  =>  'required|integer|min:1',
                            'branchsid' =>  'required|integer|min:1',
                            'accNumber' => 'string|nullable',
                            'accName'  =>  'string|max:100',
                        ]);
                }

                if ($validator->fails())
                {
                    return response()->json(['errors'=>$validator->errors()->all()]);
                }

                $validated = $validator->validate();
                
                if(array_key_exists('id', $validated)){                
                    $bankacc = BanksAcc::find($validated['id']);
                }else{
                    $bankacc = new BanksAcc();
                   	
                }               
                foreach($validated as $key => $value){
                    if(Schema::hasColumn('banksacc', $key))
                        $bankacc->$key = $value;
                }

                
                // return $bankacc;
                $bankacc->save();
                return response()->json(['success' => route('user')]);
            }else{
                return abort('404');
            }
        }
        catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
