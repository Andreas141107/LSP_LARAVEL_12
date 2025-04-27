<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class AdminController extends Controller
{
    public function tambah(){
        if(request()->routeIs('admin.meja')){
            return view('admin.create');
        }elseif(request()->routeIs('menu.tambah')){
            return view('admin.createmenu');
        }elseif(request()->routeIs('user.tambah')){
            return view('admin.createuser');
        }
        
    }
    public function storeMeja(Request $request){
        $validator = Validator::make($request->all(),[
            'kapasitas'=>'required|integer|min:1|max:255',
            'status'=>'required|string'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $meja = Meja::create([
            'kapasitas'=>$request->kapasitas,
            'status'=>$request->status,
        ]);
        return redirect()->route('admin.index')->with('success',"meja $meja->id berhasil ditambahkan");
    }
    public function edit($id,Request $request){
        if(request()->routeIs('edit.meja')){
            $meja = Meja::find($id);
        return view('admin.edit',compact('meja'));
        }elseif(request()->routeIs('edit.menu')){
            $menu = Menu::find($id);
            return view('admin.edit',compact('menu'));
        }elseif(request()->routeIs('edit.user')){
            $user = User::find($id);
            return view('admin.edit',compact('user'));
        };
        
    }
    public function updateMeja($id, Request $request){
        $meja = Meja::find($id);
    
        // Memastikan bahwa meja yang dimaksud ada di database
        if(!$meja) {
            return redirect()->route('admin.index')->with('error', 'Meja tidak ditemukan');
        }
    
        $validator = Validator::make($request->all(),[
            'kapasitas' => 'required|integer|min:1|max:255',
            'status' => 'required|string'
        ]);
    
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $meja->update([
            'kapasitas' => $request->kapasitas,
            'status' => $request->status
        ]);
    
        return redirect()->route('admin.index')->with('success', "Meja $meja->id berhasil diubah");
    }
    public function updateMenu($id, Request $request){
        $menu = Menu::find($id);
        $validator = Validator::make($request->all(),[
            'nama'=>'required|string|unique:menus,nama,'.$id,
            'harga'=>'integer|required|min:1000',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $menu->update([
            'nama' =>$request->nama,
            'harga'=>$request->harga,
        ]);
        return redirect()->route('admin.menu')->with('success',"Berhasil Mengubah Menu $menu->id");
    }
    public function updateUser($id,Request $request){
        $user = User::find($id);
        $validator = Validator::make($request->all(),[
            'nama'=>'required|string|unique:users,name,'.$id,
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'string|required|min:8',
            'role'=>'string|required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->update([
            'name' =>$request->nama,
            'role'=>$request->role,
            'email'=>$request->email,
            'harga'=>$request->harga,
        ]);
        return redirect()->route('admin.user')->with('success',"Berhasil Mengubah Menu $user->id");
    }
    public function hapusMeja($id){
        $meja = Meja::find($id);
        $meja->delete();
        return redirect()->route('admin.index')->with('success',"Meja $meja->id berhasil di hapus ");
    }
    public function storeMenu(Request $request){
        $validator = validator::make($request->all(),[
            'nama'=>'required|string|unique:menus,nama',
            'harga'=>'required|integer|min:1000'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $menu = Menu::create([
            'nama'=>$request->nama,
            'harga' =>$request->harga,
        ]);
        return redirect()->route('admin.menu')->with('success',"Menu $menu->nama berhasil ditambahkan");
    }
    public function storeUser(Request $request){
        $validator = validator::make($request->all(),[
            'nama'=>'required|string|unique:users,name',
            'email'=>'required|email|max:250|unique:users,email',
            'password'=>'required|min:8|string',
            'role' =>'string|required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::create([
            'name'=>$request->nama,
            'email' =>$request->email,
            'password'=>$request->password,
            'role'=>$request->role,
        ]);
        return redirect()->route('admin.user')->with('success',"User $user->name berhasil ditambahkan");
    }
    public function deleteMenu($id){
        $menu = Menu::find($id);
        $menu->delete();
        return redirect()->route('admin.menu')->with('success',"Menu $menu->id berhasil dihapus");
    }
    public function deleteUser($id){
        $menu = User::find($id);
        $menu->delete();
        return redirect()->route('admin.user')->with('success',"User $menu->id berhasil dihapus");
    }
    
}
