<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class BackOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $backoffice = User::findOrFail($user->id);
        return view('backoffice.index',compact('backoffice')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function clients(Request $request)
    {
        
        $query = DB::table('users')->where('role_id', '3')->orderBy('id', 'desc');
        $users = $query->paginate(1);
        $countBuilds = count($users);
        return view('backoffice.clients', ['users' => $users]);
    }  

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function clientsAdd(Request $request)
    {
        return view('backoffice.clientAdd');
    }

   /**
     * Add the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function clientsSave(Request $request)
    {
        if (strtolower($request->method()) != 'post'){
            return view('errors.forbidden');    
        }
        $user = new User();
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:6|confirmed',
            'role_id' => 'required',
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Client created successfully!!');
        return redirect()->route('backoffice.clients');
    }     

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function clientsEdit($id)
    {
        $client = User::find($id);
        return view('backoffice.clientEdit', ['client' => $client]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function clientsDelete(Request $request)
    {
        $client = User::find($request->id);
        $client->delete($client->id);
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', $client->name. ' deleted successfully!!');
        return redirect()->back(); 
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function clientsUpdate(Request $request)
    {
        if (strtolower($request->method()) != 'post'){
            return view('errors.forbidden');    
        }
        $user = User::find($request->id);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'nullable|numeric',
        ]);
        // find if your updated user email already exists 
        $new_user = $user->firstOrNew(['email'=>$request->email]);
        // Update if the no changes has been made or if no user have been founded
        if($new_user->id == $request->id || !$new_user->exists){
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            if($request->password && $request->password_confirmation && ($request->password == $request->password_confirmation))
            {
                $user->password = bcrypt($request->password);    
            }
            $user->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('m/d/Y');
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->country = $request->country;
            $user->trading_account_number = $request->trading_account_number;
            $user->balance = $request->balance;
            $user->open_trades = $request->open_trades;
            $user->close_trades = $request->close_trades;
            $user->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Client Details updated successfully!!');
            return redirect()->route('backoffice.clients');

        }
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Email already exit!!');
            return redirect()->route('backoffice.clients.edit',[$request->id]);
        }
    }    

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();
        $backoffice = User::findOrFail($user->id);
        return view('backoffice.edit',compact('backoffice')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $loggedUser = Auth::user();
        if (strtolower($request->method()) != 'post'){
            return view('errors.forbidden');    
        }
        
        // check if session user id and posted id is same else throw tamper error issue
        if($request->id != $loggedUser->id){
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Some invalid activity detected!!');
            return redirect()->route('client');
        }
        else{

            $user = User::find($request->id);
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'nullable|string|min:6|confirmed',
                'date_of_birth' => 'required|date',
                'phone_number' => 'required|numeric',
            ]);
            // find if your updated user already exists 
            $new_user = $user->firstOrNew(['email'=>$request->email]);
            // Update if the no changes has been made or if no user have been founded
            if($new_user->id == $request->id || !$new_user->exists){
                $user->name = $request->name;
                $user->surname = $request->surname;
                $user->email = $request->email;
                if($request->password && $request->password_confirmation && ($request->password == $request->password_confirmation))
                {
                    $user->password = bcrypt($request->password);    
                }
                $user->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('m/d/Y');
                $user->phone_number = $request->phone_number;
                $user->address = $request->address;
                $user->country = $request->country;
                $user->save();
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Details updated successfully!!');
                return redirect()->route('backoffice');

            }
            else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Email already exit!!');
                return redirect()->route('backoffice.edit');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
