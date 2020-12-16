<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Calon;
use App\Suara;
use App\User;
use Auth;

class ViewController extends BaseController
{
    public function home()
    {
        $data['calon'] = Calon::where('status', 'Kandidat')->get();

    	return view('home', $data);
    }

    public function vote()
    {

        $data['kandidat'] = Calon::where('status', 'Kandidat')->get();
    	return view('vote', $data);
    }

    public function login()
    {
    	return view('login');
    }

    public function register()
    {
        return view('register');
    }

     public function hitungsuara(Request $request)
    {
        $nama = Auth::user()->name;
        $suaraku = Calon::where('nama', $request->suara)->get();
        foreach ($suaraku as $s) {
            $suaranya = $s->suara;
        }
        $suaranya++;

        $incr = Calon::where('nama', $request->suara)->update(['suara' => $suaranya]);
        $masuksuara = new Suara;
        $masuksuara->suara = "1";
        $masuksuara->save();

        $udahan = User::where('name', $nama)->update(['udah'=> 'Udah']);

        return redirect('/logout');

        
    }

    public function reg()
    {
        $register = new User;
        $register->name = $_POST['nama'];
        $register->nim = $_POST['nim'];
        $register->password = bcrypt($_POST['password']);
        $register->save();
        return redirect('/register/registereuy');
    }

    public function masuk(Request $request)
    {
        if(!\Auth::attempt(['nim'=>$request->nim, 'password'=>$request->password])){
            return redirect()->back();
        }
        else{
            return redirect ('/hitung');
            
        }
    }

    public function logout(Request $request)
    {
        \Auth::logout();
        return redirect('/hitung');
    }

    public function hitung()
    {
        $found = 0;
        $user = Auth::user()->name;

        $cekrole = User::join('user_role','user_role.id_user','=','users.id')->where('users.name','=',$user)->join('cus_permiss', 'cus_permiss.id_role', '=', 'user_role.id_role')->select('users.name', 'user_role.id_role', 'cus_permiss.id_permis')->get();
        
        foreach ($cekrole as $cc) {
            $ddd = $cc->id_permis;
            if($ddd == 6){
                $found = 1;
            }
        }

        if($found == 1){
            $data['hitung'] = Calon::where('status', 'Kandidat')->get();
            $data['suarasemua'] = Suara::where('suara', '1')->count();
            $data['banyak'] = Calon::where('status', 'Kandidat')->count();
            return view('perhitungan', $data);
        }
        else{
            dd($found);
        }
    }

    public function op()
    {
        $data['ajukan'] = Calon::all();
        return view('operator', $data);
    }

    public function ajukan($id)
    {
        $calon = Calon::where('id', $id)->update(['status' => 'Kandidat']);

        return redirect('/operator/operator/operator');
    }

    public function batalkan($id)
    {
        $calon = Calon::where('id', $id)->update(['status' => 'Calon']);

        return redirect('/operator/operator/operator');
    }

}

