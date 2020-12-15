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
use App\Urole;
use App\Role;
use App\Custom;
use App\Permis;
use Auth;

class PermisController extends BaseController
{
    public function home()
    {
        $data['ajukan'] = User::all();
        $data['role'] = Role::all();
        $data['permis'] = Permis::all();

    	return view('cuspermis.home', $data);
    }

    public function buatrole()
    {
        return view('cuspermis.role');
    }

    public function role(Request $request)
    {
        $role = new Role;
        $role->nama_role =$_POST['nama_role'];
        $role->save();

        return redirect('/buatrole');
    }

    public function buatcus(Request $request)
    {

        $data['role'] = Role::all();
        $data['permis'] = Permis::all();
        return view('cuspermis.cusperm',$data);
    }

    public function buatur(Request $request)
    {

        $data['role'] = Role::all();
        $data['user'] = User::all();
        return view('cuspermis.cusrole',$data);
    }

    public function c(Request $request)
    {
        $cus = new Custom;
        $cus->id_role =$_POST['id_role'];
        $cus->id_permis =$_POST['id_permis'];
        $cus->save();

        return redirect('/buatcus');
    }

    public function r(Request $request)
    {
        $rr = new Urole;
        $rr->id_user =$_POST['id_user'];
        $rr->id_role =$_POST['id_role'];
        $rr->save();

        return redirect('/buatur');
    }


}

