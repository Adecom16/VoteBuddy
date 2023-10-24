<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Lga;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


            $state = State::all();
            return view('home', compact('state'));

        // return view('home');
    }
    public function lga(Request $request)
    {

        if ($request->has(['id']) && $request->id != null) {
            $lga = Lga::where('state_id', $request->id)->get();
            return response()->json(['lga' => $lga]);
        }else return 'invalid data';
    }

    public function party(Request $request)
    {

        if ($request->has(['id']) && $request->id != null) {
            $party = Party::where('party_id', $request->id)->get();
            return response()->json(['party' => $party]);
        }else return 'invalid data';
    }
}
