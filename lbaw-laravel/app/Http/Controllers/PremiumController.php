<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Request;
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
        $current_time = Carbon::now()->toDateTimeString();
        $duration = Carbon::now()->addDays(30)->toDateTimeString();
        
        if ($current_time != null && $idUser != null && $duration != null){
            $premiumSignature = PremiumSignature::create([
                'iduser' => $idUser,
                'startdate' => $current_time,
                'duration' => $duration
                ]);
                
                $premiumSignature.save();
            }
        }
    }