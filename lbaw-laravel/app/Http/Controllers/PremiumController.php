<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\PremiumSignature;
use Carbon\Carbon;

class PremiumController extends Controller
{
    public function show()
    {
        
        return view('premium', ['user' => Auth::user()]);
    }
    
    // TODO: fix premium add
    public function buy(Request $request){
        $idUser = Auth::user()->iduser;
        $current_time = date('Y-m-d H:i:s', strtotime(Carbon::now()));

        if ($current_time != null && $idUser != null){
            $premiumSignature = new PremiumSignature();
            $premiumSignature->iduser = $idUser;
            $premiumSignature->startdate = $current_time;
            $premiumSignature->duration = '1 Month';
            $premiumSignature->save();
        }
        
        return redirect('premium');
    }
}