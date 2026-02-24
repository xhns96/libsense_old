<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\University;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class RegisterController extends Controller
{


    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'passport_number' => ['required', 'string', 'max:255','unique:users'],
            'passport_pin' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return back() // Replace 'registration' with your route name
            ->withErrors($validator)
                ->withInput();
        }
        $passport_pin = $data['passport_pin'];
        
        $passport_number = strtoupper($data['passport_number']);
        $currentUniversity = University::where('univer_short_name', "AndMI")->first();
        $url = 'https://student.andmiedu.uz/rest/v1/data/student-list?passport_pin='.$passport_pin.'&passport_number='.$passport_number;
        $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();
        if ($response['data']['pagination']['totalCount'] != 0){
            foreach ($response['data']['items'] as $item){
                $user_check = User::where('student_id_number',$item['student_id_number'])->first();
                if ($user_check) {
                    $user = User::find($user_check->id);
                    $user->update([
                        'name' => $item['full_name'],
                        'user_university_name' => "Andijon mashinasozlik instituti",
                        'email' => $data['email'],
                        'user_faculty_name' => $item['department']['name'],
                        'user_profile_image' => $item['image'],
                        'user_specialty_name' => $item['specialty']['name'],
                        'user_course_name' => $item['level']['name'],
                        'user_group_name' => $item['group']['name'],
                        'passport_number' => $passport_number,
                        'passport_pin' => $passport_pin,
                        "user_university_id"=>$currentUniversity->id,
                        'user_profile_status' => "pending",
                        'student_id_number' => $item['student_id_number'],
                        'password' => Hash::make($data['password']),
                    ]);
                    if ($user->hashed_user_id == "") {
                        $user->hashed_user_id = $uuid = Str::uuid();
                        $user->update();
                    }
                }
                else{
                    $user = User::create([
                        'name' => $item['full_name'],
                        'user_university_name' => "Andijon mashinasozlik instituti",
                        'email' => $data['email'],
                        'user_faculty_name' => $item['department']['name'],
                        'user_profile_image' => $item['image'],
                        'user_specialty_name' => $item['specialty']['name'],
                        'user_course_name' => $item['level']['name'],
                        'user_group_name' => $item['group']['name'],
                        'passport_number' => $passport_number,
                        'passport_pin' => $passport_pin,
                        "user_university_id"=>$currentUniversity->id,
                        'user_profile_status' => "pending",
                        'student_id_number' => $item['student_id_number'],
                        "user_hashed_id" => $uuid,
                        'password' => Hash::make($data['password']),
                    ]);
                }
            }
//            event(new Registered($user));
            
            if ($user) {
                Auth::login($user);
                return redirect(RouteServiceProvider::BOOK);
            }
            // if ($user_check) {
            //     Auth::login($user);
            //     return redirect(RouteServiceProvider::BOOK);
            // }

            
        } else {
            return back()->with("HEMIS_error","HEMISDA XATOLIK");
        }
    }


    ///////////////////// OLD REGISTER /////////////////////

    //    use RegistersUsers;

//    protected $redirectTo = RouteServiceProvider::BOOK;
//
//    public function __construct()
//    {
//        $this->middleware('guest');
//    }
//
//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//            'passport_number' => ['required', 'string', 'max:255'],
//            'passport_pin' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
//        ]);
//    }
//
//    protected function create(array $data)
//    {
//        $passport_pin = $data['passport_pin'];
//        $passport_number = strtoupper($data['passport_number']);
//        $currentUniversity = University::where('univer_short_name', "AndMI")->first();
//        $url = 'https://student.andmiedu.uz/rest/v1/data/student-list?passport_pin='.$passport_pin.'&passport_number='.$passport_number;
//        $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();
//        if ($response['data']['pagination']['totalCount'] != 0){
//            foreach ($response['data']['items'] as $item){
//                return User::create([
//                    'name' => $item['full_name'],
//                    'user_university_name' => "Andijon mashinasozlik instituti",
//                    'email' => $data['email'],
//                    'user_faculty_name' => $item['department']['name'],
//                    'user_profile_image' => $item['image'],
//                    'user_specialty_name' => $item['specialty']['name'],
//                    'user_course_name' => $item['level']['name'],
//                    'user_group_name' => $item['group']['name'],
//                    'passport_number' => $passport_number,
//                    'passport_pin' => $passport_pin,
//                    "user_university_id"=>$currentUniversity->id,
//                    'user_profile_status' => "active",
//                    'password' => Hash::make($data['password']),
//                ]);
//            }
//        } else {
//            return response()->json(['answer'=>'success']);
//        }
//    }
}
