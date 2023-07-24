<?php
  
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\Movie;

class AuthMovieController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showRegisterForm()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('movies');
        } else {
            // Check if the email exists in the database
            $user = User::where('email', $request->email)->first();
    
            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => 'The provided email does not exist in our records.',
                ]);
            }
    
            // Authentication failed, add error message for invalid password
            throw ValidationException::withMessages([
                'password' => 'Invalid password.',
            ]);
        }
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("login");
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function dashboard()
    // {
    //     if(Auth::check()){
    //         $movies = Movie::paginate(10);
    //         return view('movies.index', compact('movies'));
    //     }
  
    //     return redirect("login");
    // }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}