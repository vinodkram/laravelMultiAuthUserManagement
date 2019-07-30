<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //$client = User::where('id', $user->id)->first();
        $client = User::findOrFail($user->id);
        return view('client.index',compact('client')); 
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
        //$client = User::where('id', $user->id)->first();
        $client = User::findOrFail($user->id);
        return view('client.edit',compact('client')); 
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
                $user->trading_account_number = $request->trading_account_number;
                $user->balance = $request->balance;
                $user->open_trades = $request->open_trades;
                $user->close_trades = $request->close_trades;
                $user->save();
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Details updated successfully!!');
                return redirect()->route('client');

            }
            else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Email already exit!!');
                return redirect()->route('client.edit');
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
