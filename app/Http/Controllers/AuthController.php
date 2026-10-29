<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\bidder;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{
    public function index()
    {
        return view('Authform');

    }
    public function indexadmin()
    {
        return view('Authadmin');
    }
    public function proseslogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->level == 'bidder') {
                return redirect()->route('home');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
        protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

    }

        protected function authenticated(Request $request, $user)
    {
        if($user->level=='bidder'){
            return redirect()->route('home');
        }
    }
    public function prosesloginadmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->route('dashboardadmin');
            } elseif ($user->level == 'officer') {
                return redirect()->route('dashboardofficer');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
        protected function sendLoginResponseadmin(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticatedadmin($request, $this->guard()->user())) {
            return $response;
        }

    }

        protected function authenticatedadmin(Request $request, $user)
    {
        if($user->level=='admin'){
            return redirect()->route('dashboardadmin');
        }else
        if($user->level =='officer'){
            return redirect()->route('dashboardofficer');
        }
    }
        protected function guard()
    {
        return Auth::guard();
    }
    public function logout(Request $request, $user) {
        $request->session()->flush();
        Auth::logout();
        if($user->level =='admin'){
        return redirect('Authadmin');
        }else
        if($user->level =='officer'){
        return redirect('Authadmin');
        }else
        if($user->level =='bidder'){
            return redirect('Authform');
        }
    }

    public function postregister(Request $request)
    {
        
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $cek = DB::table('users')->where('id', \DB::raw("(select max(`id`) from users)"))->first();
        DB::table('bidder')->insert([
            'id_bidder'=>$cek->id,
            'Full_name'=>$cek->name,
            'telp'=>$request->telp,
        ]);

        $this->guard()->login($user);
        

        if ($response = $this->registered($request, $user)) {
            return $response ;
        
        
            
        }
    }
    protected function registered(Request $request, $user)
    {
        
            return redirect()->back()->withSuccess('Data Berhasil Tersimpan Silahkan Login');
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' =>['required'],
            'telp' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
         return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'level' => 'bidder',
        ]);

    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
