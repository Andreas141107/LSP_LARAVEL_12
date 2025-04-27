<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        $role = Auth::user()->role;
        return match($role){
            'admin' =>  redirect()->route('admin.index'),
            'waiter'=>redirect()->route('admin.menu'),
            'kasir'=>redirect()->route('kasir.index'),
            'owner'=>redirect()->route('waiter.laporan'),

        };  
    }
    public function afterLoginAdmin(){
        if(request()->routeIs('admin.index')){
            $meja = Meja::all();
            return view('admin.index',compact('meja'));
        }elseif(request()->routeIs('admin.menu')){
            $menu = Menu::all();
            return view('admin.menu',compact('menu'));
        }elseif(request()->routeIs('admin.user')){
            $user = User::where('id','!=',1)->get();
           
            return view('admin.user',compact('user'));
        }
    }
}
