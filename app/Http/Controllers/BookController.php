<?php

namespace App\Http\Controllers;

use App\Book;
use App\Faculty;
use App\Group;
use App\Order;
use App\Specialty;
use App\University;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class  BookController extends Controller
{
    public function index()
    {
        $allUniversities = University::all();
        return view('book.index',['currentUser'=>$this->currentUser(),
                                       'allUniversities'=>$allUniversities,
                                        'allBooks'=>$this->allBooks()]);
    }

    public function index_post(Request $request)
    {
        if ($request->_for_what == 'allBooksRequest'){
            $searchedUniverID = $request['univer-id'];
            $allBooksForCurrentUniver = DB::select('SELECT * FROM libsense_uz.books WHERE book_university_id = ?',[$searchedUniverID]);
            $pathToStorage = Storage::url('public/book-images');

            return response()->json(['answer'=>'success','allBooks'=>$allBooksForCurrentUniver,'storagePath'=>$pathToStorage]);
        }
        if ($request->_for_what == 'filteredAllBooksRequest'){
            $searchedUniverID = $request['univer-id'];
            $allBooksForCurrentUniver = DB::select('SELECT books.id,books.book_name,books.book_author,books.book_year,books.book_image,books.book_file,books.book_lang, a_r_m_s.campus_name AS "campus_name" FROM libsense_uz.books,libsense_uz.a_r_m_s WHERE book_campus_id=a_r_m_s.id AND book_university_id = ? AND book_for_home=1',[$searchedUniverID]);
            $pathToStorage = Storage::url('public/book-images');

            return response()->json(['answer'=>'success','allBooks'=>$allBooksForCurrentUniver,'storagePath'=>$pathToStorage]);
        }
        if ($request->_for_what == 'bookOrder'){
            if (Auth::check()){
                $currentUser = User::find(Auth::user()->id);

                if ($currentUser->user_profile_status == "active"){
                    $nO = new Order();
                    $nO->order_book_id = $request->book_id;
                    $nO->order_user_id = $currentUser->id;
                    $nO->order_university_id = 13;
//                    return response()->json(['answer'=>$currentUser]);
                    $nO->save();
                    return response()->json(['answer'=>'success']);
                }
                if ($currentUser->user_profile_status == "pending"){
                    return response()->json(['answer'=>'pending']);
                }
                if ($currentUser->user_profile_status == "inactive"){
                    return response()->json(['answer'=>'inactive']);
                }
            }
            else{
                return response()->json(['answer'=>'not-signed']);
            }
        }

    }

    public function book_download($id)
    {
        if (Auth::check()){
            $currentBook = Book::find($id);
            $currentBookFile = 'storage/book-files/'.$currentBook->book_file;
            $currentUser = User::find(Auth::id());

            if ($currentUser->user_profile_status == "active"){
                // return $currentBook->book_science_type;
                if ($currentBook->book_science_type != 8){
                    $currentUser->user_down_count = $currentUser->user_down_count + 1;
                    $currentUser->save();
                    return response()->download($currentBookFile);
                }else{
                    return back()->with("download_error" , "download_error");
                }

                
            }
            if ($currentUser->user_profile_status == "pending"){
                return back()->with("pending" , "test");
                // return response()->json(['answer'=>'pending']);
            }
            if ($currentUser->user_profile_status == "inactive"){
                return back()->with("inactive" , "test");
                // return response()->json(['answer'=>'inactive']);
            }
            
        }else{
            return back()->with("not-signed" , "test");
            // return response()->json(['answer'=>'not-signed']);
        }
//        return 123;
        
        //return response()->download($currentBookFile,"Libsense.pdf");
    }

    public function profile()
    {
        $userOrders = DB::select("SELECT orders.*,books.book_name AS 'book_name' FROM libsense_uz.orders,libsense_uz.books WHERE order_user_id = ? AND order_book_id=books.id",[Auth::id()]);
        $rejectMsg = DB::select('SELECT * FROM libsense_uz.rejected_user_messages WHERE user_id=?',[Auth::id()]);

        if ($this->currentUser()->user_university_id){
            $universityID = $this->currentUser()->user_university_id;
            $currentUniver = University::find($universityID);
            $allFaculty = Faculty::all();
            $allSpecialties = Specialty::all();
            $allGroups = Group::all();
            $filteredFaculty = [];
            $filteredSpecialty = [];
            $filteredGroup = [];
            $conter = 0;
            foreach ($allFaculty as $currentFaculty){
                if ($currentFaculty->faculty_university_id == $universityID){
                    $filteredFaculty[$conter] = $currentFaculty;
                    ++$conter;
                }
            }
            $conter = 0;
            foreach ($allSpecialties as $currentSpecialty){
                if ($currentSpecialty->specialty_university_id == $universityID){
                    $filteredSpecialty[$conter] = $currentSpecialty;
                    ++$conter;
                }
            }
            $conter = 0;
            foreach ($allGroups as $currentGroup){
                if ($currentGroup->group_university_id == $universityID){
                    $filteredGroup[$conter] = $currentGroup;
                    ++$conter;
                }
            }
            $allUniversities = University::all();
            return view('book.profile',['currentUser'=>$this->currentUser(),
                'allUniversities'=>$allUniversities,
                'currentUniversity'=>$currentUniver,
                'allFaculties'=>$filteredFaculty,
                'allSpecialties'=>$filteredSpecialty,
                'allGroups'=>$filteredGroup,
                'userOrders'=>$userOrders,
                'rejectMsg'=>$rejectMsg
                ]);
        }
        else{
            $allUniversities = University::all();
            return view('book.profile',['currentUser'=>$this->currentUser(),
                'allUniversities'=>$allUniversities,'userOrders'=>$userOrders,'rejectMsg'=>$rejectMsg]);
        }

    }

    public function profile_post(Request $request)
    {
        if ($request->_for_what == 'orderReject'){
            $currOrder = Order::find($request->order_id);
            if ($currOrder){
                if ($currOrder->order_user_id == Auth::id()){
                    $currOrder->delete();
                    return response()->json(['answer'=>'success']);
                }
                else{
                    return response()->json(['answer'=>'hacked']);
                }
            }
            else
            {
                return response()->json(['answer'=>'empty']);
            }
        }
        if ($request->_for_what == 'getUniversityData'){
            $universityID = $request->university_id;
            $currentUniver = University::find($request->university_id);
            $allFaculty = Faculty::all();
            $allSpecialties = Specialty::all();
            $allGroups = Group::all();
            $filteredFaculty = [];
            $filteredSpecialty = [];
            $filteredGroup = [];
            $conter = 0;
            foreach ($allFaculty as $currentFaculty){
                if ($currentFaculty->faculty_university_id == $universityID){
                    $filteredFaculty[$conter] = $currentFaculty;
                    ++$conter;
                }
            }
            $conter = 0;
            foreach ($allSpecialties as $currentSpecialty){
                if ($currentSpecialty->specialty_university_id == $universityID){
                    $filteredSpecialty[$conter] = $currentSpecialty;
                    ++$conter;
                }
            }
            $conter = 0;
            foreach ($allGroups as $currentGroup){
                if ($currentGroup->group_university_id == $universityID){
                    $filteredGroup[$conter] = $currentGroup;
                    ++$conter;
                }
            }
            return response()->json(['answer'=>'success',
                                     'currentUniversity'=>$currentUniver,
                                     'allFaculties'=>$filteredFaculty,
                                     'allSpecialties'=>$filteredSpecialty,
                                     'allGroups'=>$filteredGroup]);
        }

        $currentUser = User::find(Auth::id());
        if ($request['user-passport-id']){
            $currentUser->user_passport_id = $request['user-passport-id'];
        }
        if ($request['user-phone']){
            $currentUser->user_phone = $request['user-phone'];
        }
        if ($request['user-university-id']){
            $currentUser->user_university_id = $request['user-university-id'];
        }
        if ($request['user-faculty-id']){
            $currentUser->user_faculty_id = $request['user-faculty-id'];
        }
        if ($request['user-specialty-id']){
            $currentUser->user_specialty_id = $request['user-specialty-id'];
        }
        if ($request['user-course-number']){
            $currentUser->user_course_number = $request['user-course-number'];
        }
        if ($request['user-group-id']){
            $currentUser->user_group_id = $request['user-group-id'];
        }
        if ($request['user-password']){
            $currentUser->password = Hash::make($request['user-password']);
        }
        if ($request->hasFile('user-profile-image')){
            if ($currentUser->user_profile_image){
                Storage::delete($currentUser->user_profile_image);
            }
            $imgName = Auth::id().'.'.$request->file('user-profile-image')->extension();
            $path = $request->file('user-profile-image')->storeAs('public/user-profile-images',$imgName);
            $currentUser->user_profile_image = $imgName;
        }
        if ($request['passport_number']){
            if ($request['passport_pin']){
                $passport_number = strtoupper($request['passport_number']);
                $url = 'https://student.andmiedu.uz/rest/v1/data/student-list?passport_pin='.$request['passport_pin'].'&passport_number='.$passport_number;
                $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();
                if ($response['data']['pagination']['totalCount'] == 0){
                    return response()->json(['answer'=>'empty']);
                }else{
                    foreach ($response['data']['items'] as $item){
                        $currentUser->user_faculty_name = $item['department']['name'];

                        $currentUser->user_specialty_name = $item['specialty']['name'];
                        $currentUser->user_course_name = $item['level']['name'];
                        $currentUser->user_group_name = $item['group']['name'];
                        $currentUser->passport_number = strtoupper($request['passport_number']);
                        $currentUser->passport_pin = $request['passport_pin'];
                        if ($item['image'] != ""){
                            $currentUser->user_profile_image = $item['image'];
                        }
                    }
                }
            }
        }
        $currentUser->user_profile_status = 'active';
        $currentUser->save();


        return response()->json(['answer'=>'success']);
    }
    /////////////////////////////////// Custom functions ///////////////////////////////
    private function currentUser(){
        return User::find(Auth::id());
    }
    private function allBooks(){
        $allBooks = DB::select('select * from libsense_uz.books where book_university_id=? AND book_for_home = 1',[13]);

        return $allBooks;
    }
}
