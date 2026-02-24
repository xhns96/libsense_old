<?php

namespace App\Http\Controllers;

use App\Abonement;
use App\Admin;
use App\Book;
use App\ARM;
use App\Borrow;
use App\BorrowHistory;
use App\EBook;
use App\Faculty;
use App\Group;
use App\OquvZali;
use App\Order;
use App\RejectedUserMessage;
use App\Specialty;
use App\University;
use App\User;
use Dotenv\Result\Success;
use http\Env\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\choose_handler;
use function SebastianBergmann\GlobalState\TestFixture\snapshotFunction;
use function Symfony\Component\String\u;
use Illuminate\Support\Str;
use Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {

        // TM -> To'liq matn
        $currentAdmin = Admin::find(Auth::id());
        $bookNameCounter = DB::select("SELECT COUNT(id) AS 'nomda_soni' FROM libsense_uz.books WHERE book_university_id = ?", [$this->currentUniversity()->id]);
        $bookTMCounter = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_university_id = ?", [$this->currentUniversity()->id]);
        $bookCopyCounter = DB::select("SELECT SUM(book_copy_count) AS 'nusxa_soni' FROM libsense_uz.books WHERE book_university_id = ?", [$this->currentUniversity()->id]);
        $usersCount = DB::select("SELECT COUNT(id) AS 'kitobxon_soni' FROM libsense_uz.users WHERE user_profile_status = 'active' AND user_university_id = ?", [$this->currentUniversity()->id]);

        $tmPercentage = 0;
        if ($bookNameCounter[0]->nomda_soni && $bookTMCounter[0]->tm_soni) {
            $tmPercentage = ($bookTMCounter[0]->tm_soni * 100) / $bookNameCounter[0]->nomda_soni;
            $tmPercentage = round($tmPercentage, 2);
        }

        $uz_latin = DB::select("SELECT COUNT(id) as 'uz_latin' FROM libsense_uz.books WHERE book_lang = 'uz_l' AND book_university_id = ?", [$this->currentUniversity()->id]);
        $uz_kirill = DB::select("SELECT COUNT(id) as 'uz_kirill' FROM libsense_uz.books WHERE book_lang = 'uz_k' AND book_university_id = ?", [$this->currentUniversity()->id]);
        $rus = DB::select("SELECT COUNT(id) as 'rus_lang' FROM libsense_uz.books WHERE book_lang = 'ru' AND book_university_id = ?", [$this->currentUniversity()->id]);
        $en = DB::select("SELECT COUNT(id) as 'eng_lang' FROM libsense_uz.books WHERE book_lang = 'en' AND book_university_id = ?", [$this->currentUniversity()->id]);
        $langs = ['uz_l' => $uz_latin[0]->uz_latin, 'ru' => $rus[0]->rus_lang, 'en' => $en[0]->eng_lang, 'uz_k' => $uz_kirill[0]->uz_kirill];
        if (!$uz_latin[0]->uz_latin) {
            $langs['uz_l'] = 0;
        }
        if (!$rus[0]->rus_lang) {
            $langs['ru'] = 0;
        }
        if (!$en[0]->eng_lang) {
            $langs['en'] = 0;
        }
        if (!$uz_kirill[0]->uz_kirill) {
            $langs['uz_k'] = 0;
        }


        $qwe = DB::table('books')->whereDate('created_at', '>', '2021-5-10')->whereDate('created_at', '<', '2021-5-30')->get();
        //dd(Request::ip());

        $tmDarslik = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_category = 1 AND book_university_id = ?", [$this->currentUniversity()->id]);
        $tmOquvQ = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_category = 2 AND book_university_id = ?", [$this->currentUniversity()->id]);
        $tmBadiiy = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_science_type = 8 AND book_university_id = ?", [$this->currentUniversity()->id]);
        $tmIlmiy = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_category = 4 AND book_university_id = ?", [$this->currentUniversity()->id]);
        $tmBoshqa = $bookTMCounter[0]->tm_soni - $tmDarslik[0]->tm_soni - $tmOquvQ[0]->tm_soni - $tmBadiiy[0]->tm_soni - $tmIlmiy[0]->tm_soni;
        $tmCategories = ['boshqa' => $tmBoshqa, 'darslik' => $tmDarslik[0]->tm_soni, 'oquvq' => $tmOquvQ[0]->tm_soni, 'badiiy' => $tmBadiiy[0]->tm_soni, 'ilmiy' => $tmIlmiy[0]->tm_soni];

        return view('admin.dashboard', [
            'currentAdmin' => $currentAdmin,
            'tmCategories' => $tmCategories,
            'langs' => $langs,
            'allAdmins' => $this->allAdmins(),
            'allEbooksCount' => $this->allEBooksCount(),
            'allEbooksPrimCount' => $this->allEBooksPrimCount(),
            'eachCampusStat' => $this->eachCampusStat(),
            'allCampusTMsCount' => $this->allCampusTMsCount(),
            'allCategories' => $this->allCategories(),
            'bookCategoryCount' => $this->bookCategoryCount(),
            'usersCount' => $usersCount[0]->kitobxon_soni,
            'tmPercentage' => $tmPercentage,
            'bookNameCount' => $bookNameCounter[0]->nomda_soni,
            'bookTMCount' => $bookTMCounter[0]->tm_soni,
            'bookCopyCount' => $bookCopyCounter[0]->nusxa_soni
        ]);
    }
    public function dashboard_post(Request $request)
    {
        if ($request->_for_what == 'lang-data') {
            $uz_latin = DB::select("SELECT COUNT(id) as 'uz_latin' FROM libsense_uz.books WHERE book_lang = 'uz_l' AND book_university_id = ?", [$this->currentUniversity()->id]);
            $uz_kirill = DB::select("SELECT COUNT(id) as 'uz_kirill' FROM libsense_uz.books WHERE book_lang = 'uz_k' AND book_university_id = ?", [$this->currentUniversity()->id]);
            $rus = DB::select("SELECT COUNT(id) as 'rus_lang' FROM libsense_uz.books WHERE book_lang = 'ru' AND book_university_id = ?", [$this->currentUniversity()->id]);
            $en = DB::select("SELECT COUNT(id) as 'eng_lang' FROM libsense_uz.books WHERE book_lang = 'en' AND book_university_id = ?", [$this->currentUniversity()->id]);
            if (!$uz_latin[0]->uz_latin) {
                $uz_latin = 0;
            }
            if (!$rus[0]->rus_lang) {
                $rus = 0;
            }
            if (!$en[0]->eng_lang) {
                $en = 0;
            }
            if (!$uz_kirill[0]->uz_kirill) {
                $uz_kirill = 0;
            }
            $bookTMCounter = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_university_id = ?", [$this->currentUniversity()->id]);
            $tmDarslik = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_category = 1 AND book_university_id = ?", [$this->currentUniversity()->id]);
            $tmOquvQ = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_category = 2 AND book_university_id = ?", [$this->currentUniversity()->id]);
            $tmBadiiy = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_science_type = 8 AND book_university_id = ?", [$this->currentUniversity()->id]);
            $tmIlmiy = DB::select("SELECT COUNT(id) AS 'tm_soni' FROM libsense_uz.books WHERE book_file != '' AND book_category = 4 AND book_university_id = ?", [$this->currentUniversity()->id]);
            $tmBoshqa = $bookTMCounter[0]->tm_soni - $tmDarslik[0]->tm_soni - $tmOquvQ[0]->tm_soni - $tmBadiiy[0]->tm_soni - $tmIlmiy[0]->tm_soni;
            $tmCategories = ['boshqa' => $tmBoshqa, 'darslik' => $tmDarslik[0]->tm_soni, 'oquvq' => $tmOquvQ[0]->tm_soni, 'badiiy' => $tmBadiiy[0]->tm_soni, 'ilmiy' => $tmIlmiy[0]->tm_soni];


            return response()->json([
                'answer' => 'success',
                'tmCategories' => $tmCategories,
                'uz_l' => $uz_latin[0]->uz_latin,
                'ru' => $rus[0]->rus_lang,
                'en' => $en[0]->eng_lang,
                'uz_k' => $uz_kirill[0]->uz_kirill,
                'ip' => $request->ip()
            ]);
        }
    }

    public function profile()
    {

        return view('admin.profile', [
            'currentAdmin' => $this->currentAdmin(),
            'currentUniversity' => $this->currentUniversity(),
            'allAdmins' => $this->allAdmins(),
            'allCampuses' => $this->allCampuses()
        ]);
    }
    public function profile_post(Request $request)
    {
        $me = Admin::find(Auth::id());
        if ($request['admin-name']) {
            $me->name = $request['admin-name'];
        }
        if ($request['admin-password']) {
            $me->password = $request['admin-password'];
        }
        if ($request['admin-campus']) {
            $me->admin_campus_id = $request['admin-campus'];
        }
        if ($request->hasFile('profile-image')) {
            if ($me->admin_profile_image) {
                $imgPath = 'public/admin-profile-images/' . $me->admin_profile_image;
                Storage::delete($imgPath);
            }
            $newImg = Auth::id() . '.' . $request->file('profile-image')->extension();
            $request->file('profile-image')->storeAs('public/admin-profile-images', $newImg);
            $me->admin_profile_image = $newImg;
        }
        $me->save();
        return response()->json(['answer' => 'success']);
    }

    public function chat()
    {
        $currentAdmin = Admin::find(Auth::id());

        return view('admin.chat', ['currentAdmin' => $currentAdmin]);
    }
    public function chat_post(Request $request)
    {

    }

    public function settings()
    {
        $currentAdmin = $this->currentAdmin();
        $allCampuses = $this->allCampuses();
        $currentUniversity = $this->currentUniversity();
        $allFaculties = $this->allFaculties();
        $allSpecialties = $this->allSpecialties();
        $allGroups = $this->allGroups();


        return view('admin.settings', [
            'currentAdmin' => $currentAdmin,
            'currentUniversity' => $currentUniversity,
            'allFaculties' => $allFaculties,
            'allSpecialties' => $allSpecialties,
            'allGroups' => $allGroups,
            'allCampuses' => $allCampuses
        ]);
    }
    public function settings_post(Request $request)
    {

        if ($request->_for_what == 'addNewCampus') {
            $equalCheck = DB::table('a_r_m_s')->select('campus_name')->where('campus_name', $request->campus_name)->where('campus_university_id', $this->currentUniversity()->id)->exists();
            if ($equalCheck) {
                return response()->json(['answer' => 'equal']);
            } else {
                $newARMCampus = new ARM();
                $newARMCampus->campus_name = $request->campus_name;
                $newARMCampus->campus_university_id = $this->currentUniversity()->id;
                if ($request->campus_type) {
                    $newARMCampus->campus_type = $request->campus_type;
                }
                $newARMCampus->save();
                return response()->json(['answer' => 'success']);
            }
            return response()->json(['answer' => 'success']);
        }
        if ($request['campus-id']) {
            $editedCampus = ARM::find($request['campus-id']);
            if (!$editedCampus) {
                return response()->json(['error' => '404']);
            }
            if (
                $editedCampus->campus_university_id == $this->currentUniversity()->id &&
                $editedCampus->id == $request['campus-id']
            ) {

                if ($request['campus-new-name']) {
                    $equalCheck = DB::table('a_r_m_s')->select('campus_name')->where('campus_name', $request['campus-new-name'])->where('campus_university_id', $this->currentUniversity()->id)->exists();
                    if ($equalCheck) {
                        return response()->json(['answer' => 'equal']);
                    }
                    $editedCampus->campus_name = $request['campus-new-name'];
                }
                if ($request['campus-type']) {
                    $editedCampus->campus_type = $request['campus-type'];
                }
                $editedCampus->save();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }
        }
        if ($request->_for_what == 'campusNameChange') {
            $editedCampus = ARM::find($request->campus_id);
            if (!$editedCampus) {
                return response()->json(['error' => '404']);
            }
            if (
                $editedCampus->campus_university_id == $this->currentUniversity()->id &&
                $editedCampus->id == $request->campus_id &&
                $editedCampus->campus_name == $request->campus_name
            ) {

                $equalCheck = DB::table('a_r_m_s')->select('campus_name')->where('campus_name', $request->campus_new_name)->where('campus_university_id', $this->currentUniversity()->id)->exists();
                if ($equalCheck) {
                    return response()->json(['answer' => 'equal']);
                }

                $editedCampus->campus_name = $request->campus_new_name;
                $editedCampus->save();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }
        }
        if ($request->_for_what == 'campusDelete') {
            $deletedCampus = ARM::find($request->campus_id);
            if (!$deletedCampus) {
                return response()->json(['error' => '404']);
            }
            if (
                $deletedCampus->campus_university_id == $this->currentUniversity()->id &&
                $deletedCampus->id == $request->campus_id &&
                $deletedCampus->campus_name == $request->campus_name
            ) {

                $deletedCampus->delete();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }
        }
        if ($request->_for_what == 'addNewFaculty') {
            $allFaculty = $this->allFaculties();
            if ($allFaculty) {
                foreach ($allFaculty as $key => $currentFaculty) {
                    if ($currentFaculty->faculty_name == $request->faculty_name && $currentFaculty->faculty_university_id == $this->currentUniversity()->id) {
                        return response()->json(['answer' => 'equal']);
                    }
                }
                $nF = new Faculty();
                $nF->faculty_name = $request->faculty_name;
                $nF->faculty_university_id = $this->currentUniversity()->id;
                $nF->save();
                return response()->json(['answer' => 'success']);
            } else {
                $nF = new Faculty();
                $nF->faculty_name = $request->faculty_name;
                $nF->faculty_university_id = Admin::find(Auth::id())->admin_university_id;
                $nF->save();
                return response()->json(['answer' => 'success']);
            }
        }
        if ($request->_for_what == 'facultyNameChange') {
            $editedFaculty = Faculty::find($request->faculty_id);
            if (!$editedFaculty) {
                return response()->json(['error' => '404']);
            }
            if (
                $request->faculty_name == $editedFaculty->faculty_name
                && $editedFaculty->faculty_university_id == $this->currentUniversity()->id
            ) {
                $allFac = $this->allFaculties();
                foreach ($allFac as $currentFaculty) {
                    if ($currentFaculty->faculty_name == $request->faculty_new_name && $currentFaculty->faculty_university_id == $this->currentUniversity()->id) {
                        return response()->json(['answer' => 'equal']);
                    }
                }
                $editedFaculty->faculty_name = $request->faculty_new_name;
                $editedFaculty->save();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }
        }
        if ($request->_for_what == 'facultyDelete') {
            $deletedFaculty = Faculty::find($request->faculty_id);
            if (!$deletedFaculty) {
                return response()->json(['error' => '404']);
            }
            if (
                $deletedFaculty->faculty_university_id == $this->currentUniversity()->id &&
                $deletedFaculty->id == $request->faculty_id &&
                $deletedFaculty->faculty_name == $request->faculty_name
            ) {
                $deletedFaculty->delete();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }
        }
        if ($request->_for_what == 'addNewSpecialty') {
            $allSpecialtiesDB = $this->allSpecialties();
            $findFaculty = Faculty::find($request->faculty_id);
            foreach ($allSpecialtiesDB as $currentSpecialty) {
                if (
                    $currentSpecialty->specialty_name == $request->specialty_name &&
                    $currentSpecialty->specialty_faculty_id == $request->faculty_id &&
                    $currentSpecialty->specialty_university_id == $this->currentUniversity()->id
                ) {
                    return response()->json(['answer' => 'equal']);
                }
            }
            if ($findFaculty && $findFaculty->faculty_university_id == $this->currentUniversity()->id) {
                $newSpec = new Specialty();
                $newSpec->specialty_name = $request->specialty_name;
                $newSpec->specialty_faculty_id = $request->faculty_id;
                $newSpec->specialty_university_id = $this->currentUniversity()->id;
                $newSpec->save();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }

        }
        if ($request->_for_what == 'specialtyNameChange') {
            $changedSpecialty = Specialty::find($request->specialty_id);
            $allSpecialties = $this->allSpecialties();
            if (!$allSpecialties) {
                return response()->json(['error' => '404']);
            }
            if (
                $changedSpecialty->id == $request->specialty_id &&
                $changedSpecialty->specialty_name == $request->specialty_name &&
                $changedSpecialty->specialty_university_id == $this->currentUniversity()->id
            ) {
                foreach ($allSpecialties as $currentSpecialty) {
                    if (
                        $currentSpecialty->specialty_name == $request->specialty_new_name &&
                        $currentSpecialty->specialty_faculty_id == $changedSpecialty->specialty_faculty_id
                    ) {
                        return response()->json(['answer' => 'equal']);
                    }
                }
                $changedSpecialty->specialty_name = $request->specialty_new_name;
                $changedSpecialty->save();

                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }
        }
        if ($request->_for_what == 'specialtyDelete') {
            $deletedSpecialty = Specialty::find($request->specialty_id);
            if (!$deletedSpecialty) {
                return response()->json(['error' => '404']);
            }
            if (
                $deletedSpecialty->specialty_university_id == $this->currentUniversity()->id &&
                $deletedSpecialty->id == $request->specialty_id &&
                $deletedSpecialty->specialty_name == $request->specialty_name
            ) {
                $deletedSpecialty->delete();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }
        }
        if ($request->_for_what == 'addNewGroup') {
            $facultyID = $request->faculty_id;
            $specialtyID = $request->specialty_id;
            $courseNumber = $request->course_number;
            $newGroupName = $request->group_name;
            $allGroups = $this->allGroups();
            $facultyUniverID = Faculty::find($facultyID)->faculty_university_id;
            foreach ($allGroups as $currentGroup) {
                if (
                    $currentGroup->group_name == $newGroupName &&
                    $currentGroup->group_course_number == $courseNumber &&
                    $currentGroup->group_specialty_id == $specialtyID
                ) {
                    return response()->json(['answer' => 'equal']);
                }
            }
            if ($facultyUniverID == $this->currentUniversity()->id) {
                $newGroup = new Group();
                $newGroup->group_name = $newGroupName;
                $newGroup->group_faculty_id = $facultyID;
                $newGroup->group_specialty_id = $specialtyID;
                $newGroup->group_course_number = $courseNumber;
                $newGroup->group_university_id = $this->currentUniversity()->id;
                $newGroup->save();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }

        }
        if ($request->_for_what == 'groupNameChange') {
            $changedGroup = Group::find($request->group_id);
            $allGroups = $this->allGroups();
            if (!$allGroups) {
                return response()->json(['error' => '404']);
            }
            if (
                $changedGroup->id == $request->group_id &&
                $changedGroup->group_name == $request->group_name &&
                $changedGroup->group_university_id == $this->currentUniversity()->id
            ) {
                foreach ($allGroups as $currentGroup) {
                    if (
                        $currentGroup->group_name == $request->group_new_name &&
                        $currentGroup->group_faculty_id == $changedGroup->group_faculty_id
                    ) {
                        return response()->json(['answer' => 'equal']);
                    }
                }
                $changedGroup->group_name = $request->group_new_name;
                $changedGroup->save();

                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }
        }
        if ($request->_for_what == 'groupDelete') {
            $deletedGroup = Group::find($request->group_id);
            if (!$deletedGroup) {
                return response()->json(['error' => '404']);
            }
            if (
                $deletedGroup->group_university_id == $this->currentUniversity()->id &&
                $deletedGroup->id == $request->group_id &&
                $deletedGroup->group_name == $request->group_name
            ) {
                $deletedGroup->delete();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['error' => 'hacked']);
            }
        }

        $rules = array(
            'univer-logo' => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['answer' => 'error', 'errors' => $error->errors()->all()]);
        }
        $logoName = $this->currentUniversity()->id . '.' . $request->file('univer-logo')->extension();
        if ($this->currentUniversity()->univer_logo == $logoName) {
            Storage::delete('public/university-logos/' . $logoName);
            $thisUniver = $this->currentUniversity();
            $request->file('univer-logo')->storeAs('public/university-logos', $logoName);
            $thisUniver->univer_logo = $logoName;
            $thisUniver->save();
            return response()->json(['answer' => 'success']);
        } else {
            $thisUniver = $this->currentUniversity();
            $request->file('univer-logo')->storeAs('public/university-logos', $logoName);
            $thisUniver->univer_logo = $logoName;
            $thisUniver->save();
            return response()->json(['answer' => 'success']);
        }
        //return redirect()->back();
    }
    public function settingsGetFSData()
    {
        $allFaculties = $this->allFaculties();
        $allSpecialties = $this->allSpecialties();
        return response()->json(['allFaculties' => $allFaculties, 'allSpecialties' => $allSpecialties]);
    }

    public function employee()
    {

        return view('admin.employee', [
            'currentAdmin' => $this->currentAdmin(),
            'allAdmins' => $this->allAdmins(),
            'allCampuses' => $this->allCampuses()
        ]);
    }
    public function employee_post(Request $request)
    {
        if ($request['admin-id']) {
            if ($request['admin-campus-change'] || $request['admin-profile-status-change']) {
                $changingAdmin = Admin::find($request['admin-id']);
                if ($changingAdmin->admin_university_id != $this->currentAdmin()->admin_university_id) {
                    return response()->json(['answer' => 'hacked']);
                } else {
                    if ($request['admin-campus-change']) {
                        $changingAdmin->admin_campus_id = $request['admin-campus-change'];
                    }
                    if ($request['admin-profile-status-change']) {
                        $changingAdmin->admin_profile_status = $request['admin-profile-status-change'];
                    }
                    $changingAdmin->save();
                    return response()->json(['answer' => 'success']);
                }
            } else {
                return response()->json(['answer' => 'empty']);
            }
        }
        if ($request->_for_what == 'getAllCamps') {
            return response()->json(['answer' => $this->allCampuses()]);
        }
        if ($request->_for_what == 'adminDelete') {
            $changingAdmin = Admin::find($request->admin_id);
            if ($changingAdmin->admin_university_id != $this->currentAdmin()->admin_university_id) {
                return response()->json(['answer' => 'hacked']);
            } else {
                $changingAdmin->delete();
                return response()->json(['answer' => 'success']);
            }
        }

        if ($request['new-admin-name'] && $request['new-admin-email'] && $request['new-admin-password']) {
            $equalCheck = DB::select('SELECT id FROM libsense_uz.admins WHERE email = ?', [$request['new-admin-email']]);
            if ($equalCheck) {
                return response()->json(['answer' => 'equal']);
            } else {
                $rules = [
                    'new-admin-name' => 'required',
                    'new-admin-email' => 'required|email',
                    'new-admin-password' => 'required|min:8'
                ];
                $error = Validator::make($request->all(), $rules);
                if ($error->fails()) {
                    return response()->json(['answer' => 'invalid', 'errors' => $error->errors()->all()]);
                }
                $newAdmin = new Admin();
                $newAdmin->name = $request['new-admin-name'];
                $newAdmin->email = $request['new-admin-email'];
                $newAdmin->password = Hash::make($request['new-admin-password']);
                $newAdmin->admin_university_id = $this->currentAdmin()->admin_university_id;
                $newAdmin->admin_profile_status = 'active';
                $newAdmin->save();
                return response()->json(['answer' => 'success']);
            }
        } else {
            return response()->json(['answer' => 'error']);
        }

    }

    public function add_book()
    {
        //dd($this->allBooks());
        $currentAdmin = Admin::find(Auth::id());
        return view('admin.add_book', [
            'currentAdmin' => $currentAdmin,
            'allCampuses' => $this->allCampuses()
        ]);
    }
    public function add_book_post(Request $request)
    {
        $rules = array(
            'book-name' => 'required',
            'book-author' => 'required',
            'book-year' => 'required|min:4',
            'book-copy-count' => 'required',
            'book-real-copy-count' => 'required',
            'book-publishing' => 'required',
            'book-page-count' => 'required',
            'book-type' => 'required',
            'book-for-home' => 'required',
            'book-lang' => 'required',
            'book-category' => 'required',
            'book-science-type' => 'required',
            'book-campus-id' => 'required'
        );
        if ($request['book-type'] == 1) {
            $rules = array(
                'book-name' => 'required',
                'book-author' => 'required',
                'book-year' => 'required|min:4',
                'book-copy-count' => 'required',
                'book-real-copy-count' => 'required',
                'book-publishing' => 'required',
                'book-page-count' => 'required',
                'book-type' => 'required',
                'book-for-home' => 'required',
                'book-lang' => 'required',
                'book-category' => 'required',
                'book-science-type' => 'required',
                'book-campus-id' => 'required'
            );
        }
        if ($request['book-type'] == 2) {
            $rules = array(
                'book-name' => 'required',
                'book-author' => 'required',
                'book-year' => 'required|min:4',
                'book-publishing' => 'required',
                'book-page-count' => 'required',
                'book-type' => 'required',
                'book-lang' => 'required',
                'book-category' => 'required',
                'book-science-type' => 'required',
                'book-campus-id' => 'required',
                'book-file' => 'required'
            );
        }
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['answer' => 'error', 'errors' => $error->errors()->all()]);
        }

        if ($request['book-type'] == 1) {
            if ($this->allBooks()) {
                $equalCheck = DB::table('books')->select('book_name')->where('book_name', $request['book-name'])->where('book_author', $request['book-author'])->where('book_campus_id', $request['book-campus-id'])->where('book_year', $request['book-year'])->where('book_university_id', $this->currentUniversity()->id)->exists();
                if ($equalCheck) {
                    return response()->json(['answer' => 'equal']);
                }
            }
            $newBook = new Book();
            $newBook->book_name = $request['book-name'];
            $newBook->book_author = $request['book-author'];
            $newBook->book_year = $request['book-year'];
            $newBook->book_copy_count = $request['book-copy-count'];
            $newBook->book_copy_count_now = $request['book-real-copy-count'];
            $newBook->book_publishing = $request['book-publishing'];
            $newBook->book_page_count = $request['book-page-count'];
            $newBook->book_type = $request['book-type'];
            $newBook->book_for_home = $request['book-for-home'];
            $newBook->book_lang = $request['book-lang'];
            $newBook->book_category = $request['book-category'];
            $newBook->book_science_type = $request['book-science-type'];
            $newBook->book_campus_id = $request['book-campus-id'];
            if ($request['book-isbn']) {
                $newBook->book_isbn = $request['book-isbn'];
            }
            $newBook->book_university_id = $this->currentAdmin()->admin_university_id;
            $newBook->book_added_admin_id = Auth::id();
            $newBook->save();

            $savedBook = Book::find($newBook->id);
            if ($request->hasFile('book-file')) {
                $bookFileName = $newBook->id . '.' . $request->file('book-file')->extension();
                $request->file('book-file')->storeAs('public/book-files', $bookFileName);
                $savedBook->book_file = $bookFileName;
            }
            if ($request->hasFile('book-image')) {
                $bookImageName = $newBook->id . '.' . $request->file('book-image')->extension();
                $request->file('book-image')->storeAs('public/book-images', $bookImageName);
                $savedBook->book_image = $bookImageName;
            }
            $savedBook->save();
            // Counter
            $tempAdmin = Admin::find(Auth::id());
            $tempAdmin->admin_added_book_count = (1 + $tempAdmin->admin_added_book_count);
            $tempAdmin->save();
        }
        if ($request['book-type'] == 2) {
            if ($this->allEBooks()) {
                $equalCheck = DB::table('e_books')->select('ebook_name')->where('ebook_name', $request['book-name'])->where('ebook_author', $request['book-author'])->where('ebook_year', $request['book-year'])->where('ebook_university_id', $this->currentUniversity()->id)->exists();
                $equalCheck2 = DB::table('books')->select('book_name')->where('book_name', $request['book-name'])->where('book_author', $request['book-author'])->where('book_year', $request['book-year'])->where('book_university_id', $this->currentUniversity()->id)->exists();
                if ($equalCheck || $equalCheck2) {
                    return response()->json(['answer' => 'equal']);
                }
            }
            $newBook = new EBook();
            $newBook->ebook_name = $request['book-name'];
            $newBook->ebook_author = $request['book-author'];
            $newBook->ebook_year = $request['book-year'];
            $newBook->ebook_publishing = $request['book-publishing'];
            $newBook->ebook_page_count = $request['book-page-count'];
            $newBook->ebook_type = $request['book-type'];
            $newBook->ebook_lang = $request['book-lang'];
            $newBook->ebook_category = $request['book-category'];
            $newBook->ebook_science_type = $request['book-science-type'];
            $newBook->ebook_campus_id = $request['book-campus-id'];
            if ($request['book-isbn']) {
                $newBook->ebook_isbn = $request['book-isbn'];
            }
            if ($request['is-book-primary']) {
                $newBook->is_book_primary = $request['is-book-primary'];
            }
            $newBook->ebook_university_id = $this->currentAdmin()->admin_university_id;
            $newBook->ebook_added_admin_id = Auth::id();
            $newBook->save();

            $savedBook = EBook::find($newBook->id);
            if ($request->hasFile('book-file')) {
                $bookFileName = $newBook->id . '.' . $request->file('book-file')->extension();
                $request->file('book-file')->storeAs('public/ebook-files', $bookFileName);
                $savedBook->ebook_file = $bookFileName;
            }
            if ($request->hasFile('book-image')) {
                $bookImageName = $newBook->id . '.' . $request->file('book-image')->extension();
                $request->file('book-image')->storeAs('public/ebook-images', $bookImageName);
                $savedBook->ebook_image = $bookImageName;
            }
            $savedBook->save();
            //Counter
            $tempAdmin = Admin::find(Auth::id());
            $tempAdmin->admin_added_book_count = (1 + $tempAdmin->admin_added_book_count);
            $tempAdmin->save();
        }
        return response()->json(['answer' => 'success']);
    }

    public function all_books(Request $request)
    {
        // 1) First request: return Blade page (NO 20k rows rendered)
        if (!$request->ajax()) {
            return view('admin.all_books', [
                'currentAdmin' => $this->currentAdmin(),
                'allAdmins' => $this->allAdmins(),
                'allCampuses' => $this->allCampuses(),
            ]);
        }

        // 2) DataTables server-side request
        $draw   = (int) $request->input('draw');
        $start  = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 25);
        $search = $request->input('search.value');

        // Base query with joins (your style)
        $baseQuery = Book::query()
            ->join('a_r_m_s', 'books.book_campus_id', '=', 'a_r_m_s.id')
            ->leftJoin('admins', 'books.book_added_admin_id', '=', 'admins.id')
            ->select([
                'books.id',
                'books.book_name',
                'books.book_author',
                'books.book_year',
                'books.book_added_admin_id',
                'books.book_file',
                'admins.name as admin_name',
                'a_r_m_s.campus_name',
            ]);

        // Total count (no filter)
        $recordsTotal = (clone $baseQuery)->count(DB::raw('distinct books.id'));

        // Filter
        if ($search) {
            $baseQuery->where(function ($q) use ($search) {
                $q->where('books.id', $search)
                    ->orWhere('books.book_name', 'like', "%{$search}%")
                    ->orWhere('books.book_author', 'like', "%{$search}%")
                    ->orWhere('books.book_year', 'like', "%{$search}%")
                    ->orWhere('a_r_m_s.campus_name', 'like', "%{$search}%")
                    ->orWhere('admins.name', 'like', "%{$search}%");
            });
        }

        $recordsFiltered = (clone $baseQuery)->count(DB::raw('distinct books.id'));

        // Ordering (map DataTables column index -> DB column)
        $orderColIndex = $request->input('order.0.column', 0);
        $orderDir      = $request->input('order.0.dir', 'desc');

        $columns = [
            0 => 'books.id',
            1 => 'books.book_name',
            2 => 'books.book_author',
            3 => 'books.book_year',
            4 => 'a_r_m_s.campus_name',
            5 => 'admins.name',
        ];

        $orderCol = $columns[$orderColIndex] ?? 'books.id';
        $baseQuery->orderBy($orderCol, $orderDir);

        // Paging
        $rows = $baseQuery->skip($start)->take($length)->get();

        // Data for DataTables
        $data = $rows->map(function ($r) {
            return [
                'id' => $r->id,
                'book_name' => $r->book_name,
                'book_author' => $r->book_author,
                'book_year' => $r->book_year,
                'campus_name' => $r->campus_name,
                'admin_name' => empty($r->book_added_admin_id) ? 'ARM hodimlari' : $r->admin_name,
                'has_file' => !empty($r->book_file),
            ];
        });

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function all_books_old()
    {
        $allBooks = Book::join('a_r_m_s', 'books.book_campus_id', '=', 'a_r_m_s.id')
            ->leftJoin('admins', 'books.book_added_admin_id', '=', 'admins.id')
            ->select('books.*', 'admins.name as admin_name', 'a_r_m_s.campus_name')
            ->get();
        return view('admin.all_books', [
            'currentAdmin' => $this->currentAdmin(),
            'allBooks' => $allBooks,
            'allAdmins' => $this->allAdmins(),
            'allCampuses' => $this->allCampuses()
        ]);
    }
    public function all_books_post(Request $request)
    {
        if ($request->_for_what == 'changeBook') {
            $choosedBook = Book::find($request['book-id']);
            if ($choosedBook->book_university_id == $this->currentAdmin()->admin_university_id) {
                $bookURL = null;
                $shorterBookName = null;
                $bookExtension = null;
                $fileSize = 0;
                $temp2 = 'book-files/pdf.png';
                $imgURL = Storage::url($temp2);
                if ($choosedBook->book_file) {
                    $bookNameTemp = 'public/book-files/' . $choosedBook->book_file;
                    $exists = Storage::disk('local')->exists($bookNameTemp);
                    if (!$exists) {
                        $choosedBook->book_file = '';
                        $choosedBook->save();
                        return response()->json(['answer' => 'bookNotFound']);
                    }
                    $temp = 'book-files/' . $choosedBook->book_file;

                    $bookURL = Storage::url($temp);

                    $temp = 'public/' . $temp;
                    $fileSize = (Storage::size($temp) / 1048576);
                    $fileSize = intval(ceil($fileSize));
                    $bookLength = strlen($choosedBook->book_name);
                    $shorterBookName = $choosedBook->book_name;
                    if ($bookLength > 15) {
                        //$shorterBookName = substr($choosedBook->book_name, 0,15);
                        $shorterBookName = mb_substr($choosedBook->book_name, 0, 15, 'utf-8');
                        $bookExtension = substr($choosedBook->book_file, -4);
                        switch ($bookExtension) {
                            case '.pdf':
                                $temp2 = 'book-files/pdf.png';
                                $imgURL = Storage::url($temp2);
                                break;
                            case '.doc':
                                $temp2 = 'book-files/doc.png';
                                $imgURL = Storage::url($temp2);
                                break;
                            case 'epub':
                                $temp2 = 'book-files/epub.png';
                                $imgURL = Storage::url($temp2);
                                break;
                            case 'djvu':
                                $temp2 = 'book-files/djvu.png';
                                $imgURL = Storage::url($temp2);
                                break;
                        }

                        $shorterBookName .= ".." . $bookExtension;
                        //$shorterBookName = json_encode($shorterBookName);
                    }
                }

                return response()->json(['bookURL' => $bookURL, 'imgUrl' => $imgURL, 'bookShortName' => $shorterBookName, 'fileSize' => $fileSize, 'answer' => $choosedBook, 'allCampuses' => $this->allCampuses()]);
            } else {
                return response()->json(['answer' => 'hacked']);
            }
        }
        if ($request->_for_what == 'deleteBook') {
            $bookForDelete = Book::find($request['book-id-for-delete']);
            if ($bookForDelete->book_university_id == $this->currentUniversity()->id) {
                $bookForDelete->delete();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['answer' => 'hacked']);
            }
        }
        if ($request['cbook-id']) {
            $rules = array(
                'cbook-id' => 'required',
                'cbook-copy-count' => 'required',
                'cbook-for-home' => 'required',
                'cbook-campus-id' => 'required',

            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json(['answer' => 'error', 'errors' => $error->errors()->all()]);
            }
            if ($request['cbook-copy-count'] < 1) {
                return response()->json(['answer' => 'error', 'errors' => $error->errors()->all()]);
            }
            $currentBook = Book::find($request['cbook-id']);
            $newBook = new Book();
            $newBook->book_name = $currentBook->book_name;
            $newBook->book_author = $currentBook->book_author;
            $newBook->book_isbn = $currentBook->book_isbn;
            $newBook->book_year = $currentBook->book_year;
            $newBook->book_publishing = $currentBook->book_publishing;
            $newBook->book_page_count = $currentBook->book_page_count;
            $newBook->book_copy_count = $request['cbook-copy-count'];
            $newBook->book_type = $currentBook->book_type;
            $newBook->book_for_home = $request['cbook-for-home'];
            $newBook->book_lang = $currentBook->book_lang;
            $newBook->book_category = $currentBook->book_category;
            $newBook->book_science_type = $currentBook->book_science_type;
            $newBook->book_campus_id = $request['cbook-campus-id'];
            $newBook->book_added_admin_id = Auth::id();
            $newBook->book_university_id = $this->currentUniversity()->id;
            $newBook->save();
            return response()->json(['answer' => 'success']);
        }
        if ($request['book-id']) {
            //return response()->json(['answer'=>$request->all()]);
            $rules = array(
                'book-name' => 'required',
                'book-author' => 'required',
                'book-year' => 'required|min:4',
                'book-copy-count' => 'required',
                'book-real-copy-count' => 'required',
                'book-publishing' => 'required',
                'book-page-count' => 'required',
                'book-type' => 'required',
                'book-for-home' => 'required',
                'book-lang' => 'required',
                'book-category' => 'required',
                'book-science-type' => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json(['answer' => 'error', 'errors' => $error->errors()->all()]);
            }
            if ($request['book-copy-count'] < 1) {
                return response()->json(['answer' => 'error', 'errors' => $error->errors()->all()]);
            }
            $currentBook = Book::find($request['book-id']);
            $currentBook->book_name = $request['book-name'];
            $currentBook->book_author = $request['book-author'];
            $currentBook->book_isbn = $request['book-isbn'];
            $currentBook->book_year = $request['book-year'];
            $currentBook->book_publishing = $request['book-publishing'];
            $currentBook->book_page_count = $request['book-page-count'];
            $currentBook->book_copy_count = $request['book-copy-count'];
            $currentBook->book_copy_count_now = $request['book-real-copy-count'];
            $currentBook->book_type = $request['book-type'];
            $currentBook->book_for_home = $request['book-for-home'];
            $currentBook->book_lang = $request['book-lang'];
            $currentBook->book_category = $request['book-category'];
            $currentBook->book_science_type = $request['book-science-type'];
            $currentBook->book_campus_id = $request['book-campus-id'];
            if ($request['book-file-delete']) {
                $bookFileDelete = 'public/book-files/' . $currentBook->book_file;
                Storage::delete($bookFileDelete);
                $currentBook->book_file = null;
            }
            if ($request['book-image-delete']) {
                $bookImageDelete = 'public/book-images/' . $currentBook->book_image;
                Storage::delete($bookImageDelete);
                $currentBook->book_image = null;
            }

            if ($request->hasFile('book-file')) {
                $bookFileName = $currentBook->id . '.' . $request->file('book-file')->extension();
                $request->file('book-file')->storeAs('public/book-files', $bookFileName);
                $currentBook->book_file = $bookFileName;
            }
            if ($request->hasFile('book-image')) {
                $bookImageName = $currentBook->id . '.' . $request->file('book-image')->extension();
                $request->file('book-image')->storeAs('public/book-images', $bookImageName);
                $currentBook->book_image = $bookImageName;
            }

            $currentBook->save();

            return response()->json(['answer' => 'success']);
        }

        if ($request->_for_what == "bookQRCodeDownload") {
            $book = Book::find($request->id);
            $book_id = $book->id;
            // Generate the QR code with your desired settings
            $qrcode = QrCode::format('png')
                ->size(1000)
                ->style('square')
                ->merge(public_path('images/andmi.png'), 0.3, true)
                ->eye('square')
                ->generate(route("admin.book.check", [$book_id]));
            // return $qrcode;

            // Save the QR code to a temporary file
            $tempFilePath = storage_path('app/public/' . time() . '.png');
            file_put_contents($tempFilePath, $qrcode);

            // Generate a filename for the downloaded QR code
            $filename = 'qrcode_' . $book_id . '.png';

            // Return the QR code as a downloadable response
            return response()->download($tempFilePath, $filename);
        }

        return response()->json(['answer' => 'no-data']);
    }

    function book_check(Request $request, $id)
    {
        $book = Book::find($id);
        return view('admin.book_check', [
            'currentAdmin' => $this->currentAdmin(),
            'allBooks' => $book,
            'allAdmins' => $this->allAdmins(),
            'allCampuses' => $this->allCampuses()
        ]);
    }

    function book_download_qr_code(Request $request, $id)
    {
        $book = Book::find($id);
        $book_id = $book->id;
        // Generate the QR code with your desired settings
        $qrcode = QrCode::format('png')
            ->size(1000)
            ->style('square')
            ->eye('square')
            ->generate(route("admin.book.check", [$id]));

        // Save the QR code to a temporary file

        $tempFilePath = storage_path('app/public/' . time() . '.png');
        file_put_contents($tempFilePath, $qrcode);

        // Generate a filename for the downloaded QR code
        $filename = 'qrcode_' . $id . '.png';

        // Return the QR code as a downloadable response
        return response()->download($tempFilePath, $filename);
    }

    public function all_ebooks()
    {
        return view('admin.all_ebooks', [
            'currentAdmin' => $this->currentAdmin(),
            'allCampuses' => $this->allCampuses(),
            'allAdmins' => $this->allAdmins(),
            'allEbooks' => $this->allEBooks()
        ]);
    }
    public function all_ebooks_post(Request $request)
    {
        if ($request->_for_what == 'changeBook') {
            $choosedBook = EBook::find($request['book-id']);
            if ($choosedBook->ebook_university_id == $this->currentAdmin()->admin_university_id) {

                return response()->json(['answer' => $choosedBook, 'allCampuses' => $this->allCampuses()]);
            } else {
                return response()->json(['answer' => 'hacked']);
            }
        }
        if ($request->_for_what == 'deleteBook') {
            $bookForDelete = EBook::find($request['book-id-for-delete']);
            if ($bookForDelete->ebook_university_id == $this->currentUniversity()->id) {
                $bookForDelete->delete();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['answer' => 'hacked']);
            }
        }

        if ($request['form-book-id']) {
            //return response()->json(['answer'=>$request->all()]);
            $rules = array(
                'book-name' => 'required',
                'book-author' => 'required',
                'book-year' => 'required|min:4',
                'book-publishing' => 'required',
                'book-page-count' => 'required',
                'book-lang' => 'required',
                'book-category' => 'required',
                'book-science-type' => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json(['answer' => 'error', 'errors' => $error->errors()->all()]);
            }

            $currentBook = EBook::find($request['form-book-id']);
            $currentBook->ebook_name = $request['book-name'];
            $currentBook->ebook_author = $request['book-author'];
            $currentBook->ebook_isbn = $request['book-isbn'];
            $currentBook->ebook_year = $request['book-year'];
            $currentBook->ebook_publishing = $request['book-publishing'];
            $currentBook->ebook_page_count = $request['book-page-count'];
            $currentBook->ebook_lang = $request['book-lang'];
            $currentBook->ebook_category = $request['book-category'];
            $currentBook->ebook_science_type = $request['book-science-type'];
            $currentBook->ebook_campus_id = $request['book-campus-id'];
            if ($request['book-file-delete']) {
                $bookFileDelete = 'public/book-files/' . $currentBook->book_file;
                Storage::delete($bookFileDelete);
                $currentBook->book_file = null;
            }
            if ($request['book-image-delete']) {
                $bookImageDelete = 'public/book-images/' . $currentBook->book_image;
                Storage::delete($bookImageDelete);
                $currentBook->book_image = null;
            }

            if ($request->hasFile('book-file')) {
                $bookFileName = $currentBook->id . '.' . $request->file('book-file')->extension();
                $request->file('book-file')->storeAs('public/book-files', $bookFileName);
                $currentBook->book_file = $bookFileName;
            }
            if ($request->hasFile('book-image')) {
                $bookImageName = $currentBook->id . '.' . $request->file('book-image')->extension();
                $request->file('book-image')->storeAs('public/book-images', $bookImageName);
                $currentBook->book_image = $bookImageName;
            }

            $currentBook->save();

            return response()->json(['answer' => 'success']);
        }

    }

    public function reports()
    {
        return view("admin.reports", [
            'currentAdmin' => $this->currentAdmin(),
            'allCampuses' => $this->allCampuses()
        ]);
    }
    public function reports_post(Request $request)
    {
        if ($request->_for_what == 'getReport') {
            if ($request->report_type == '1') {
                $campus_id = $request->campus_id;
                $book_category_id = $request->book_category_id;
                $book_science_type_id = $request->book_science_type_id;
                $book_lang_id = $request->book_lang_id;
                $book_tm = $request->book_tm;

                if ($book_category_id == 'all') {
                    if ($book_science_type_id == 'all') {
                        if ($book_lang_id == 'all') {
                            if ($book_tm == 'all') {
                                $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ?", [$this->currentUniversity()->id, $campus_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            } else {
                                if ($book_tm == "1") {
                                    $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file != ''", [$this->currentUniversity()->id, $campus_id]);
                                    return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                                } else {
                                    $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file IS NULL", [$this->currentUniversity()->id, $campus_id]);
                                    return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                                }
                            }
                        } elseif ($book_tm == 'all') {
                            $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_lang_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            if ($book_tm == "1") {
                                $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file != '' AND book_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_lang_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            } else {
                                $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file IS NULL AND book_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_lang_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            }
                        }
                    } elseif ($book_lang_id == 'all') {
                        if ($book_tm = 'all') {
                            $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            if ($book_tm == "1") {
                                $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file != '' AND book_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            } else {
                                $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file IS NULL AND book_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            }
                        }
                    } elseif ($book_tm == 'all') {
                        $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_lang = ? AND book_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_lang_id, $book_science_type_id]);
                        return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                    } else {
                        if ($book_tm == "1") {
                            $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file != '' AND book_science_type = ? AND book_lang = ? ", [$this->currentUniversity()->id, $campus_id, $book_science_type_id, $book_lang_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file IS NULL AND book_science_type = ? AND book_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id, $book_lang_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        }
                    }
                } elseif ($book_science_type_id == 'all') {
                    if ($book_lang_id == 'all') {
                        if ($book_tm == 'all') {
                            $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ?  AND book_category = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            if ($book_tm == "1") {
                                $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file != '' AND book_category = ? ", [$this->currentUniversity()->id, $campus_id, $book_category_id]);
                                return response()->json(['answer' => 'success', 'result' => $result]);
                            } else {
                                $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file IS NULL AND book_category = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            }
                        }
                    } else {
                        if ($book_tm == 'all') {
                            $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ?  AND book_category = ? AND book_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_lang_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            if ($book_tm == "1") {
                                $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file != '' AND book_category = ? AND book_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_lang_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            } else {
                                $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file IS NULL AND book_category = ? AND book_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_lang_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            }
                        }
                    }
                } elseif ($book_lang_id == 'all') {
                    if ($book_tm == 'all') {
                        $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ?  AND book_category = ? AND book_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_science_type_id]);
                        return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                    } else {
                        if ($book_tm == "1") {
                            $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file != '' AND book_category = ? AND book_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_science_type_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file IS NULL AND book_category = ? AND book_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_science_type_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        }
                    }
                } elseif ($book_tm == 'all') {
                    $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_category = ? AND book_lang = ? AND book_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_lang_id, $book_science_type_id]);
                    return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                } else {
                    if ($book_tm == "1") {
                        $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file != '' AND book_science_type = ? AND book_lang = ? AND book_category = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id, $book_lang_id, $book_category_id]);
                        return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                    }
                    if ($book_tm == "2") {
                        $result = DB::select("SELECT * FROM libsense_uz.books WHERE book_university_id = ? AND book_campus_id = ? AND book_file IS NULL AND book_science_type = ? AND book_lang = ? AND book_category = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id, $book_lang_id, $book_category_id]);
                        return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                    }
                }

            }
            if ($request->report_type == '2') {
                $campus_id = $request->campus_id;
                $book_category_id = $request->book_category_id;
                $book_science_type_id = $request->book_science_type_id;
                $book_lang_id = $request->book_lang_id;
                $book_tm = $request->book_tm;

                if ($book_category_id == 'all') {
                    if ($book_science_type_id == 'all') {
                        if ($book_lang_id == 'all') {
                            if ($book_tm == 'all') {
                                $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ?", [$this->currentUniversity()->id, $campus_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            } else {
                                if ($book_tm == "1") {
                                    $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file != ''", [$this->currentUniversity()->id, $campus_id]);
                                    return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                                } else {
                                    $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file IS NULL", [$this->currentUniversity()->id, $campus_id]);
                                    return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                                }
                            }
                        } elseif ($book_tm == 'all') {
                            $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_lang_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            if ($book_tm == "1") {
                                $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file != '' AND ebook_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_lang_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            } else {
                                $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file IS NULL AND ebook_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_lang_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            }
                        }
                    } elseif ($book_lang_id == 'all') {
                        if ($book_tm = 'all') {
                            $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            if ($book_tm == "1") {
                                $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file != '' AND ebook_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            } else {
                                $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file IS NULL AND ebook_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            }
                        }
                    } elseif ($book_tm == 'all') {
                        $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_lang = ? AND ebook_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_lang_id, $book_science_type_id]);
                        return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                    } else {
                        if ($book_tm == "1") {
                            $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file != '' AND ebook_science_type = ? AND ebook_lang = ? ", [$this->currentUniversity()->id, $campus_id, $book_science_type_id, $book_lang_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file IS NULL AND ebook_science_type = ? AND ebook_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id, $book_lang_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        }
                    }
                } elseif ($book_science_type_id == 'all') {
                    if ($book_lang_id == 'all') {
                        if ($book_tm == 'all') {
                            $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ?  AND ebook_category = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            if ($book_tm == "1") {
                                $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file != '' AND ebook_category = ? ", [$this->currentUniversity()->id, $campus_id, $book_category_id]);
                                return response()->json(['answer' => 'success', 'result' => $result]);
                            } else {
                                $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file IS NULL AND ebook_category = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            }
                        }
                    } else {
                        if ($book_tm == 'all') {
                            $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ?  AND ebook_category = ? AND ebook_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_lang_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            if ($book_tm == "1") {
                                $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file != '' AND ebook_category = ? AND ebook_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_lang_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            } else {
                                $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file IS NULL AND ebook_category = ? AND ebook_lang = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_lang_id]);
                                return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                            }
                        }
                    }
                } elseif ($book_lang_id == 'all') {
                    if ($book_tm == 'all') {
                        $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ?  AND ebook_category = ? AND ebook_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_science_type_id]);
                        return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                    } else {
                        if ($book_tm == "1") {
                            $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file != '' AND ebook_category = ? AND ebook_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_science_type_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        } else {
                            $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file IS NULL AND ebook_category = ? AND ebook_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_science_type_id]);
                            return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                        }
                    }
                } elseif ($book_tm == 'all') {
                    $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_category = ? AND ebook_lang = ? AND ebook_science_type = ?", [$this->currentUniversity()->id, $campus_id, $book_category_id, $book_lang_id, $book_science_type_id]);
                    return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                } else {
                    if ($book_tm == "1") {
                        $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file != '' AND ebook_science_type = ? AND ebook_lang = ? AND ebook_category = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id, $book_lang_id, $book_category_id]);
                        return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                    }
                    if ($book_tm == "2") {
                        $result = DB::select("SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ? AND ebook_campus_id = ? AND ebook_file IS NULL AND ebook_science_type = ? AND ebook_lang = ? AND ebook_category = ?", [$this->currentUniversity()->id, $campus_id, $book_science_type_id, $book_lang_id, $book_category_id]);
                        return response()->json(['answer' => 'success', 'result' => $result, 'result-count' => count($result)]);
                    }
                }

            }
        }
        if ($request->_for_what == 'deleteBook') {
            if ($request->book_type == 'book') {
                $bookForDelete = Book::find($request['book-id-for-delete']);
                if ($bookForDelete->book_university_id == $this->currentUniversity()->id) {
                    if ($bookForDelete->book_file) {
                        $bookPath = 'public/book-files/' . $bookForDelete->book_file;
                        Storage::delete($bookPath);
                    }
                    $bookForDelete->delete();
                    return response()->json(['answer' => 'success']);
                } else {
                    return response()->json(['answer' => 'hacked']);
                }
            }
            if ($request->book_type == 'ebook') {
                $bookForDelete = EBook::find($request['book-id-for-delete']);
                if ($bookForDelete->ebook_university_id == $this->currentUniversity()->id) {
                    if ($bookForDelete->ebook_file) {
                        $bookPath = 'public/ebook-files/' . $bookForDelete->ebook_file;
                        Storage::delete($bookPath);
                    }
                    $bookForDelete->delete();
                    return response()->json(['answer' => 'success']);
                } else {
                    return response()->json(['answer' => 'hacked']);
                }
            }
            return response()->json(['answer' => 'empty']);
        }

        return response()->json(['answer' => 'somethingWrong']);
    }

    public function all_orders()
    {
        $books = DB::table("books")->select('books.id', 'books.book_name', 'books.book_author', 'books.book_year')->get();
        // dd($books);
        return view('admin.all_orders', [
            'currentAdmin' => $this->currentAdmin(),
            'allCampuses' => $this->allCampuses(),
            'allOrders' => $this->allOrders(),
            'allUsers' => $this->allUsers(),
            'allOrdersWithBooks' => $this->allOrdersWithBooks(),
            'allBooks' => $books,
            'userAll' => User::all()
        ]);
    }
    public function getData(Request $request)
    {
        $data = Book::where('book_name', 'like', '%' . $request->searchItem . '%')
            ->orWhere('id', 'like', '%' . $request->searchItem . '%')
            ->orWhere('book_author', 'like', '%' . $request->searchItem . '%')
            ->orWhere('book_year', 'like', '%' . $request->searchItem . '%')
            ->paginate(10, ['*'], 'page', $request->page);
        return $data;
    }

    public function getUsersData(Request $request)
    {
        $data = User::where('name', 'like', '%' . $request->searchItem . '%')
            ->orWhere('student_id_number', 'like', '%' . $request->searchItem . '%')
            ->paginate(10, ['*'], 'page', $request->page);
        return $data;
    }

    public function all_orders_post(Request $request)
    {
        if ($request->_for_what == 'orderReject') {
            $currOrder = Order::find($request->order_id);
            if ($currOrder && $currOrder->order_user_id == $request->order_user_id) {
                $currOrder->delete();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['answer' => 'empty']);
            }
        }
        if ($request->_for_what == 'orderReady') {
            $currOrder = Order::find($request->order_id);
            if ($currOrder && $currOrder->order_user_id == $request->order_user_id) {
                $currOrder->order_status = "ready";
                $currOrder->save();
                return response()->json(['answer' => 'success']);
            } else {
                return response()->json(['answer' => 'empty']);
            }
        }
        if ($request->_for_what == 'orderTake') {
            $currOrder = Order::find($request->order_id);
            $currentBook = Book::find($currOrder->order_book_id);
            if ($currOrder && $currOrder->order_user_id == $request->order_user_id) {
                $currentDate = Carbon::now();
                $borrowDate = Carbon::createFromFormat('Y-m-d', $request->borrow_date);
                $gtCheck = $borrowDate->gt($currentDate);
                if ($currentBook->book_copy_count_now > 0) {
                    if ($gtCheck) {
                        $newBorrow = new Borrow();
                        $newBorrow->borrow_book_id = $currOrder->order_book_id;
                        $newBorrow->borrow_user_id = $request->order_user_id;
                        $newBorrow->borrow_university_id = $currOrder->order_university_id;
                        $newBorrow->borrow_confirmed_admin_id = Auth::id();
                        $newBorrow->borrow_book_inv_number = $request->inv_number;
                        $newBorrow->borrow_when_return = Carbon::createFromFormat('Y-m-d', $request->borrow_date);
                        $newBorrow->save();
                        $currentBook->book_copy_count_now = ($currentBook->book_copy_count_now - 1);
                        $currentBook->save();
                        $currOrder->delete();
                        $temp = User::find($request->order_user_id);
                        $temp->user_borrow_count = ($temp->user_borrow_count + 1);
                        $temp->save();
                        return response()->json(['answer' => 'success']);
                    } else {
                        return response()->json(['answer' => 'invalid-time']);
                    }
                } else {
                    return response()->json(['answer' => 'no-copy']);
                }

            } else {
                return response()->json(['answer' => 'empty']);
            }
        }
        if ($request->_for_what == 'student_search') {
            if ($request->student_id_number != "") {
                $url = 'https://student.andmiedu.uz/rest/v1/data/student-list?search=' . $request->student_id_number;
                $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();
                return response()->json(['answer' => 'success', 'student' => $response]);
            } else {
                return response()->json(['answer' => 'empty']);
            }

        }

        if ($request->_for_what == "orderSave") {
            // dd($request->all());
            if ($request->book_id != "") {
                foreach ($request->book_id as $key => $item) {
                    $nO = new Order();
                    $nO->order_book_id = $item;
                    $nO->order_user_id = $request->user_id;
                    $nO->order_university_id = 13;
                    //                    return response()->json(['answer'=>$currentUser]);
                    $nO->save();
                    $temp = User::find($request->user_id);
                    $temp->user_borrow_count = ($temp->user_borrow_count + 1);
                    $temp->save();
                }
                return back()->with('order_success', 'Buyurtma muvaffaqiyatli shakilantirildi');
            } else {
                return back();
            }
        }

        return response()->json(['answer' => 'empty']);
    }

    public function new_users()
    {

        return view('admin.new_users', [
            'currentAdmin' => $this->currentAdmin(),
            'allNewUsers' => $this->allNewUsers(),
            'allFaculties' => $this->allFaculties(),
            'allSpecialties' => $this->allSpecialties(),
            'allGroups' => $this->allGroups()
        ]);
    }
    public function new_users_post(Request $request)
    {
        if ($request->_for_what == 'userReject') {
            $currentUser = User::find($request['user_id']);
            $currentUser->user_profile_status = 'inactive';
            if ($request->message) {
                $findPrevMsg = $this->rejectedMessage($currentUser->id);
                if ($findPrevMsg) {
                    $newMsg = RejectedUserMessage::find($findPrevMsg[0]->id);
                    $newMsg->message = $request->message;
                    $newMsg->admin_id = Auth::id();
                    $newMsg->save();
                } else {
                    $newMsg = new RejectedUserMessage();
                    $newMsg->message = $request->message;
                    $newMsg->admin_id = Auth::id();
                    $newMsg->user_id = $currentUser->id;
                    $newMsg->save();
                }
            }
            $currentUser->save();
            return response()->json(['answer' => 'success']);
        }
        if ($request->_for_what == 'userAccept') {
            $currentUser = User::find($request['user_id']);
            if ($currentUser) {
                if ($currentUser->user_profile_status == 'pending') {
                    $currentUser->user_profile_status = 'active';
                    $currentUser->hashed_user_id = Hash::make($currentUser->id);
                    $currentUser->save();
                    return response()->json(['answer' => 'success']);
                } else {
                    return response()->json(['answer' => 'empty']);
                }
            } else {
                return response()->json(['answer' => 'empty']);
            }
        }
        if ($request->_for_what == 'student_search') {
            if ($request->student_id_number != "") {
                if ($request->user_type == "student") {
                    $url = 'https://student.andmiedu.uz/rest/v1/data/student-list?search=' . $request->student_id_number;
                    $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();
                    return response()->json(['answer' => 'success', 'student' => $response, 'user_type' => $request->user_type]);
                }

                if ($request->user_type == "teacher") {
                    $url = 'https://student.andmiedu.uz/rest/v1/data/employee-list?type=teacher&search=' . $request->student_id_number;
                    $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();
                    return response()->json(['answer' => 'success', 'student' => $response, 'user_type' => $request->user_type]);
                }
                if ($request->user_type == "employee") {
                    $url = 'https://student.andmiedu.uz/rest/v1/data/employee-list?type=employee&search=' . $request->student_id_number;
                    $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();
                    return response()->json(['answer' => 'success', 'student' => $response, 'user_type' => $request->user_type]);
                }
            } else {
                return response()->json(['answer' => 'empty']);
            }

        }
        if ($request->_for_what == 'user_save') {
            if ($request->student_id_number != "") {
                $user = new User();
                $user->name = $request->name;
                $user->student_id_number = $request->student_id_number;
                $user->email = $request->student_id_number;
                $user->password = $request->student_id_number;
                $user->user_faculty_name = $request->student_faculty_name;
                $user->user_specialty_name = $request->student_specialty_name;
                $user->user_course_name = $request->student_course_name;
                $user->user_group_name = $request->student_group_name;
                $user->user_profile_image = $request->image;
                $user->user_profile_status = "pending";
                $user->user_type = $request->user_type;

                $user->save();
            }
            return back()->with("success", "Kitobxon muvaffaqiyatli qo‘shish");
        }
        return response()->json(['answer' => 'empty']);
    }

    public function all_users()
    {
        return view('admin.all_users', [
            'currentAdmin' => $this->currentAdmin(),
            'allUsers' => $this->allUsers(),
            'allGroups' => $this->allGroups(),
            'allSpecialties' => $this->allSpecialties(),
            'allFaculties' => $this->allFaculties()
        ]);
    }
    public function all_users_post(Request $request)
    {
        if ($request->_for_what == 'user_sync') {
            if ($request->user_type == "student") {
                // Получаем всех студентов с нужным уровнем
                $AllUser = User::where('user_type', 'student')
                    ->where('user_course_name', $request->level)
                    ->get();

                if ($AllUser) {
                    foreach ($AllUser as $index => $currentUser) {
                        // Добавляем каждого студента в очередь с задержкой, чтобы избежать превышения лимита
                        $delay = intval($index / 10); // Задержка для каждого десятого запроса (10 запросов в секунду)
                        \App\Jobs\UpdateStudentDataJob::dispatch($currentUser)->delay(now()->addSeconds($delay));
                    }

                    return response()->json(['answer' => 'success', 'message' => 'Синхронизация студентов началась.']);
                }
            }

            if ($request->user_type == "teacher") {
                $url = 'https://student.andmiedu.uz/rest/v1/data/employee-list?type=teacher&search=' . $request->student_id_number;
                $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();
                return response()->json(['answer' => 'success', 'student' => $response, 'user_type' => $request->user_type]);
            }

            if ($request->user_type == "employee") {
                $url = 'https://student.andmiedu.uz/rest/v1/data/employee-list?type=employee&search=' . $request->student_id_number;
                $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();
                return response()->json(['answer' => 'success', 'student' => $response, 'user_type' => $request->user_type]);
            }
        }
        if ($request->_for_what == 'userDelete') {
            $currUser = User::find($request->user_id);
            if ($currUser && $currUser->user_university_id == $this->currentUniversity()->id) {
                $borrowSearch = DB::select('SELECT * FROM libsense_uz.borrows WHERE borrow_user_id = ?', [$currUser->id]);
                $orderSearch = DB::select('SELECT * FROM libsense_uz.orders WHERE order_user_id = ?', [$currUser->id]);
                if ($borrowSearch || $orderSearch) {
                    return response()->json(['answer' => 'user-borrowed']);
                } else {
                    $currUser->delete();
                    return response()->json(['answer' => 'success']);
                }
            } else {
                return response()->json(['answer' => 'empty']);
            }
        }
    }

    public function borrowed_users()
    {
        $currentDate = Carbon::now();
        DB::table('borrows')->where('borrow_when_return', '<', $currentDate)->update(['borrow_status' => 'invalid']);

        return view('admin.all_borrowed_users', [
            'currentAdmin' => $this->currentAdmin(),
            'allCampuses' => $this->allCampuses(),
            'allBorrows' => $this->allBorrows()
        ]);
    }
    public function borrowed_users_post(Request $request)
    {
        if ($request->_for_what == 'borrowDelete') {
            $currentBorrow = Borrow::find($request->borrow_id);
            if ($currentBorrow) {
                $currentBook = Book::find($currentBorrow->borrow_book_id);
                if ($currentBorrow->borrow_university_id == $this->currentUniversity()->id) {
                    $currentBook->book_copy_count_now = ($currentBook->book_copy_count_now + 1);
                    $currentBook->save();

                    $newHistory = new BorrowHistory();
                    $newHistory->borrow_book_id = $currentBorrow->borrow_book_id;
                    $newHistory->borrow_user_id = $currentBorrow->borrow_user_id;
                    $newHistory->borrow_university_id = $currentBorrow->borrow_university_id;
                    $newHistory->borrow_status = 'complete';
                    $newHistory->borrow_returned_admin_id = Auth::id();
                    $newHistory->borrow_book_inv_number = $currentBorrow->borrow_book_inv_number;
                    $newHistory->borrow_when_take = $currentBorrow->created_at;
                    $newHistory->borrow_when_must_return = $currentBorrow->borrow_when_return;
                    $newHistory->save();
                    $currentBorrow->delete();
                    return response()->json(['answer' => 'success']);
                } else {
                    return response()->json(['answer' => 'hacked']);
                }
            } else {
                return response()->json(['answer' => 'empty']);
            }
        }
    }

    public function borrowed_history()
    {
        $currentDate = Carbon::now();
        // $borrow_histories = DB::table('borrow_histories')->where('borrow_status',"complete")->get();
        $borrow_histories = DB::table('borrow_histories')
            ->join('users', 'users.id', '=', 'borrow_histories.borrow_user_id')
            ->join('books', 'books.id', '=', 'borrow_histories.borrow_book_id')
            ->join('admins', 'admins.id', '=', 'borrow_histories.borrow_returned_admin_id')
            ->where('borrow_histories.borrow_status', '=', 'complete')
            ->select('users.id as user_id', 'users.user_profile_image as user_image', 'users.name as user_name', 'users.user_phone', 'users.user_faculty_name', 'users.user_specialty_name', 'users.user_course_name', 'users.user_group_name', 'books.id as book_id', 'books.book_name', 'books.book_author', 'books.book_year', 'admins.id as admins_id', 'admins.name as admin_name', 'borrow_histories.borrow_book_inv_number as inv_number', 'borrow_histories.borrow_when_take', 'borrow_histories.borrow_when_must_return', 'borrow_histories.created_at', 'borrow_histories.id as borrow_history_id')
            ->get();

        // dd ($borrow_histories);

        return view('admin.all_history_users', [
            'currentAdmin' => $this->currentAdmin(),
            'allCampuses' => $this->allCampuses(),
            'allBorrowHistory' => $borrow_histories
        ]);
    }

    public function kundalik()
    {

        return view('admin.kundalik', [
            'currentAdmin' => $this->currentAdmin(),
            'allCampuses' => $this->allCampuses()
        ]);
    }
    public function kundalik_post(Request $request)
    {
        if ($request->_for_what == 'campus_kundalik') {
            $campusID = $request->campus_id;
            $currentCampus = ARM::find($campusID);
            $campus_type = $currentCampus->campus_type;

            if ($campus_type == 'abonement') {
                $allFaculties = $this->allFaculties();
                $allGroups = $this->allGroups();
                $filteredData = DB::select("SELECT abonements.id, abonements.ab_campus_id, abonements.ab_status, abonements.created_at, abonements.updated_at, users.user_faculty_id as 'ab_user_faculty_id', users.user_course_number as 'ab_user_course', users.user_group_id as 'ab_user_group_id' ,users.name as 'ab_user_name' FROM libsense_uz.abonements INNER JOIN libsense_uz.users ON abonements.ab_user_id = users.id WHERE abonements.ab_campus_id = ? AND abonements.ab_university_id = ? ORDER BY abonements.id DESC ", [$campusID, $this->currentUniversity()->id]);
                if ($filteredData) {
                    return response()->json([
                        'answer' => 'success',
                        'cType' => 'ab',
                        'allFaculties' => $allFaculties,
                        'allGroups' => $allGroups,
                        'filteredData' => $filteredData
                    ]);
                } else {
                    return response()->json(['answer' => 'empty']);
                }
            }
            if ($campus_type == 'oquvzal') {
                $allFaculties = $this->allFaculties();
                $allGroups = $this->allGroups();
                $filteredData = DB::select("SELECT oquv_zalis.id, oquv_zalis.oz_campus_id, oquv_zalis.oz_status, oquv_zalis.created_at, oquv_zalis.updated_at, users.user_faculty_id as 'oz_user_faculty_id', users.user_course_number as 'oz_user_course', users.user_group_id as 'oz_user_group_id' ,users.name as 'oz_user_name' FROM libsense_uz.oquv_zalis INNER JOIN libsense_uz.users ON oquv_zalis.oz_user_id = users.id WHERE oquv_zalis.oz_campus_id = ? AND oquv_zalis.oz_university_id = ?  ORDER BY oquv_zalis.id DESC", [$campusID, $this->currentUniversity()->id]);
                if ($filteredData) {
                    return response()->json([
                        'answer' => 'success',
                        'cType' => 'oz',
                        'allFaculties' => $allFaculties,
                        'allGroups' => $allGroups,
                        'filteredData' => $filteredData
                    ]);
                } else {
                    return response()->json(['answer' => 'empty']);
                }
            }

            return response()->json(['answer' => 'empty']);
        }
    }

    public function kiosk()
    {
        //        $abExst = DB::table('abonements')->select('id')->where('ab_user_id',1)->where('ab_campus_id',1)->where('ab_university_id',$this->currentUniversity()->id)->first();
//        $cA = Abonement::find($abExst[0]->id);
//        dd($abExst->id);
        return view('admin.kiosk.index', [
            'currentUniversity' => $this->currentUniversity(),
            'allCampuses' => $this->allCampuses()
        ]);
    }
    public function kiosk_post(Request $request)
    {
        if ($request->_for_what == 'userCheck') {
            $usrHashedID = $request['user_hashed_id'];
            $campusID = $request['campus_id'];
            $usrSearchExists = DB::table('users')->select('id')->where('hashed_user_id', $usrHashedID)->exists();
            if ($usrSearchExists) {
                $usrSearchID = DB::table('users')->select('id')->where('hashed_user_id', $usrHashedID)->get()->first();
                $cUser = User::find($usrSearchID->id);
                $cCampus = ARM::find($campusID);
                if ($cCampus->campus_type == 'abonement') {
                    //$abExst = DB::table('abonements')->select('id')->where('ab_user_id',$cUser->id)->where('ab_campus_id',$cCampus->id)->where('ab_status','=','1')->where('ab_university_id',$this->currentUniversity()->id)->exists();
                    $abExst1 = DB::select("SELECT id FROM libsense_uz.abonements WHERE ab_user_id = ? AND ab_campus_id = ? AND ab_university_id = ? AND ab_status = '1'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                    $abExst2 = DB::select("SELECT id FROM libsense_uz.abonements WHERE ab_user_id = ? AND ab_campus_id = ? AND ab_university_id = ? AND ab_status = '2'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                    if ($abExst1) {
                        $abExst = DB::select("SELECT id FROM libsense_uz.abonements WHERE ab_user_id = ? AND ab_campus_id = ? AND ab_university_id = ? AND ab_status = '1'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                        $cA = Abonement::find($abExst[0]->id);
                        $cA->ab_status = '2';
                        $cA->save();
                        return response()->json(['answer' => 'success', 'status' => '2']);
                    } else if ($abExst2) {
                        $nA = new Abonement();
                        $nA->ab_user_id = $cUser->id;
                        $nA->ab_campus_id = $campusID;
                        $nA->ab_university_id = $this->currentUniversity()->id;
                        $nA->ab_status = '1';
                        $nA->save();

                        return response()->json(['answer' => 'success', 'status' => '1']);
                    } else {
                        $nA = new Abonement();
                        $nA->ab_user_id = $cUser->id;
                        $nA->ab_campus_id = $campusID;
                        $nA->ab_university_id = $this->currentUniversity()->id;
                        $nA->ab_status = '1';
                        $nA->save();

                        return response()->json(['answer' => 'success', 'status' => '1']);
                    }
                }
                if ($cCampus->campus_type == 'oquvzal') {
                    $abExst1 = DB::select("SELECT id FROM libsense_uz.oquv_zalis WHERE oz_user_id = ? AND oz_campus_id = ? AND oz_university_id = ? AND oz_status = '1'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                    $abExst2 = DB::select("SELECT id FROM libsense_uz.oquv_zalis WHERE oz_user_id = ? AND oz_campus_id = ? AND oz_university_id = ? AND oz_status = '2'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                    if ($abExst1) {
                        $abExst = DB::select("SELECT id FROM libsense_uz.oquv_zalis WHERE oz_user_id = ? AND oz_campus_id = ? AND oz_university_id = ? AND oz_status = '1'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                        $cA = OquvZali::find($abExst[0]->id);
                        $cA->oz_status = '2';
                        $cA->save();
                        return response()->json(['answer' => 'success', 'status' => '2']);
                    } else if ($abExst2) {
                        $nA = new OquvZali();
                        $nA->oz_user_id = $cUser->id;
                        $nA->oz_campus_id = $campusID;
                        $nA->oz_university_id = $this->currentUniversity()->id;
                        $nA->oz_status = '1';
                        $nA->save();

                        return response()->json(['answer' => 'success', 'status' => '1']);
                    } else {
                        $nA = new OquvZali();
                        $nA->oz_user_id = $cUser->id;
                        $nA->oz_campus_id = $campusID;
                        $nA->oz_university_id = $this->currentUniversity()->id;
                        $nA->oz_status = '1';
                        $nA->save();

                        return response()->json(['answer' => 'success', 'status' => '1']);
                    }
                }

            } else {
                return response()->json(['answer' => 'userNotFound']);
            }
        }

        return response()->json(['answer' => $request->all()]);
    }

    public function kiosk_kundalik()
    {
        return view('admin.kiosk.auth');
    }
    public function kiosk_news()
    {
        return view('admin.kiosk.news');
    }

    public function infokiosk_index()
    {
        $uImage = 'placeholder.png';
        if ($this->currentUniversity()->univer_logo) {
            $uImage = $this->currentUniversity()->univer_logo;
        }
        return view('admin.infokiosk.index', ['uImage' => $uImage, 'allCampuses' => $this->allCampuses()]);
    }
    public function infokiosk_index_post(Request $request)
    {
        // return response()->json(['answer'=>$request->all()]);
        if ($request->_for_what == 'userCheck') {
            $usrHashedID = $request['user_hashed_id'];
            $campusID = $request['campus_id'];
            $usrSearchExists = DB::table('users')->select('id')->where('hashed_user_id', $usrHashedID)->exists();
            if ($usrSearchExists) {
                $usrSearchID = DB::table('users')->select('id')->where('hashed_user_id', $usrHashedID)->get()->first();
                $cUser = User::find($usrSearchID->id);
                $cCampus = ARM::find($campusID);
                if ($cCampus->campus_type == 'abonement') {
                    //$abExst = DB::table('abonements')->select('id')->where('ab_user_id',$cUser->id)->where('ab_campus_id',$cCampus->id)->where('ab_status','=','1')->where('ab_university_id',$this->currentUniversity()->id)->exists();
                    $abExst1 = DB::select("SELECT id FROM libsense_uz.abonements WHERE ab_user_id = ? AND ab_campus_id = ? AND ab_university_id = ? AND ab_status = '1'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                    $abExst2 = DB::select("SELECT id FROM libsense_uz.abonements WHERE ab_user_id = ? AND ab_campus_id = ? AND ab_university_id = ? AND ab_status = '2'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                    if ($abExst1) {
                        $abExst = DB::select("SELECT id FROM libsense_uz.abonements WHERE ab_user_id = ? AND ab_campus_id = ? AND ab_university_id = ? AND ab_status = '1'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                        $cA = Abonement::find($abExst[0]->id);
                        $cA->ab_status = '2';
                        $cA->save();
                        return response()->json(['answer' => 'success', 'status' => '2']);
                    } else if ($abExst2) {
                        $nA = new Abonement();
                        $nA->ab_user_id = $cUser->id;
                        $nA->ab_campus_id = $campusID;
                        $nA->ab_university_id = $this->currentUniversity()->id;
                        $nA->ab_status = '1';
                        $nA->save();

                        return response()->json(['answer' => 'success', 'status' => '1']);
                    } else {
                        $nA = new Abonement();
                        $nA->ab_user_id = $cUser->id;
                        $nA->ab_campus_id = $campusID;
                        $nA->ab_university_id = $this->currentUniversity()->id;
                        $nA->ab_status = '1';
                        $nA->save();

                        return response()->json(['answer' => 'success', 'status' => '1']);
                    }
                }
                if ($cCampus->campus_type == 'oquvzal') {
                    $abExst1 = DB::select("SELECT id FROM libsense_uz.oquv_zalis WHERE oz_user_id = ? AND oz_campus_id = ? AND oz_university_id = ? AND oz_status = '1'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                    $abExst2 = DB::select("SELECT id FROM libsense_uz.oquv_zalis WHERE oz_user_id = ? AND oz_campus_id = ? AND oz_university_id = ? AND oz_status = '2'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                    if ($abExst1) {
                        $abExst = DB::select("SELECT id FROM libsense_uz.oquv_zalis WHERE oz_user_id = ? AND oz_campus_id = ? AND oz_university_id = ? AND oz_status = '1'", [$cUser->id, $cCampus->id, $this->currentUniversity()->id]);
                        $cA = OquvZali::find($abExst[0]->id);
                        $cA->oz_status = '2';
                        $cA->save();
                        return response()->json(['answer' => 'success', 'status' => '2']);
                    } else if ($abExst2) {
                        $nA = new OquvZali();
                        $nA->oz_user_id = $cUser->id;
                        $nA->oz_campus_id = $campusID;
                        $nA->oz_university_id = $this->currentUniversity()->id;
                        $nA->oz_status = '1';
                        $nA->save();

                        return response()->json(['answer' => 'success', 'status' => '1']);
                    } else {
                        $nA = new OquvZali();
                        $nA->oz_user_id = $cUser->id;
                        $nA->oz_campus_id = $campusID;
                        $nA->oz_university_id = $this->currentUniversity()->id;
                        $nA->oz_status = '1';
                        $nA->save();

                        return response()->json(['answer' => 'success', 'status' => '1']);
                    }
                }

            } else {
                return response()->json(['answer' => 'userNotFound']);
            }
        }
    }

    public function infokiosk_books()
    {
        return view('admin.infokiosk.books', ['allCampuses' => $this->allCampuses()]);
    }
    public function infokiosk_books_post(Request $request)
    {

    }

    public function infokiosk_selected_category($cat_id)
    {
        $sName = "";
        switch ($cat_id) {
            case 'cat1':
                $cat_id = "1";
                $sName = "Umumiy va sohalaroro bilimlar";
                break;
            case 'cat2':
                $cat_id = "2";
                $sName = "Umumiy tabiiy fanlar";
                break;
            case 'cat3':
                $cat_id = "3";
                $sName = "Fizika-matematika fanlari";
                break;
            case 'cat4':
                $cat_id = "4";
                $sName = "Kimyo fanlari";
                break;
            case 'cat5':
                $cat_id = "5";
                $sName = "Yer haqidagi fanlar";
                break;
            case 'cat6':
                $cat_id = "6";
                $sName = "Biologiya fanlari";
                break;
            case 'cat7':
                $cat_id = "7";
                $sName = "Texnika fanlari";
                break;
            case 'cat8':
                $cat_id = "8";
                $sName = "Badiiy adabiyotlar";
                break;
            case 'cat9':
                $cat_id = "9";
                $sName = "Sog'liqni saqlash. Tibbiyot fanlari";
                break;
            case 'cat10':
                $cat_id = "10";
                $sName = "Sotsiologiya";
                break;
            case 'cat11':
                $cat_id = "11";
                $sName = "Tarix. Tarix fanlari";
                break;
            case 'cat12':
                $cat_id = "12";
                $sName = "Iqtisod. Iqtisodiy fanlar";
                break;
            case 'cat13':
                $cat_id = "13";
                $sName = "Siyosat. Siyosiy fanlar";
                break;
            case 'cat14':
                $cat_id = "14";
                $sName = "Huquq. Yuridik fanlar";
                break;
            case 'cat15':
                $cat_id = "15";
                $sName = "Harbiy fan. Harbiy ish";
                break;
            case 'cat16':
                $cat_id = "16";
                $sName = "San'at";
                break;
            case 'cat17':
                $cat_id = "17";
                $sName = "Din. Dinshunoslik";
                break;
            case 'cat18':
                $cat_id = "18";
                $sName = "Falsafa. Falsafa fanlari";
                break;
            case 'cat19':
                $cat_id = "19";
                $sName = "Pedagogika va Psixologiya fanlari";
                break;
            case 'cat20':
                $cat_id = "20";
                $sName = "Jismoniy tarbiya va sport fanlari";
                break;
            case 'cat21':
                $cat_id = "21";
                $sName = "Universal mazmunli adabiyotlar";
                break;
            case 'cat22':
                $cat_id = "22";
                $sName = "Tilshunoslik adabiyotlar";
                break;
            case 'cat999':
                $cat_id = "999";
                $sName = "Boshqa";
                break;
        }

        $filteredBooks = DB::select("SELECT * FROM libsense_uz.books WHERE book_science_type = ? AND book_for_home = 1 AND book_university_id = ?", [$cat_id, $this->currentUniversity()->id]);
        return view('admin.infokiosk.selected_cat', ['sName' => $sName, 'allCampuses' => $this->allCampuses(), 'books' => $filteredBooks]);
    }
    public function infokiosk_selected_category_post(Request $request, $cat_id)
    {
        if ($request->_for_what == 'bookData') {
            $currentBook = Book::find($request->book_id);
            if ($currentBook->book_university_id == $this->currentUniversity()->id) {
                return response()->json(['answer' => 'success', 'bookData' => $currentBook]);
            }
        }
        if ($request->_for_what == 'bookBorrow') {
            $bookID = $request->book_id;
            $userHashID = $request->user_hashed_id;

            $user = DB::table('users')->where('hashed_user_id', $userHashID)->first();
            $book = Book::find($bookID);
            if ($user) {
                if ($user->user_university_id == $this->currentUniversity()->id) {
                    if ($book) {
                        if ($book->book_copy_count_now == 0) {
                            return response()->json(['answer' => 'empty-copy']);
                        } else {
                            return response()->json(['answer' => 'success']);
                        }
                    } else {
                        return response()->json(['answer' => 'empty-book']);
                    }
                    return response()->json(['answer' => $user]);
                } else {

                    return response()->json(['answer' => 'alien']);
                }
            } else {
                return response()->json(['answer' => "empty-user"]);
            }

        }
    }
    ////////////////////////////////////// Custom Functions /////////////////////////////////
    private function currentUniversity()
    {
        $currentAdmin = Admin::find(Auth::id());
        $adminUID = $currentAdmin->admin_university_id;
        $currentUniversity = null;
        $currentUniversity = University::find($adminUID);
        return $currentUniversity;
    }

    private function currentAdmin()
    {
        $currentAdmin = Admin::find(Auth::id());
        return $currentAdmin;
    }
    private function allAdmins()
    {
        $allAdmins = DB::table('admins')->where('admin_university_id', $this->currentAdmin()->admin_university_id)->get();
        return $allAdmins;
    }
    private function allCampuses()
    {
        $allCampuses = DB::select('SELECT * FROM libsense_uz.a_r_m_s WHERE campus_university_id = ?', [$this->currentAdmin()->admin_university_id]);
        return $allCampuses;
    }
    private function allFaculties()
    {
        $allFaculties = DB::select('SELECT * FROM libsense_uz.faculties WHERE faculty_university_id = ?', [$this->currentAdmin()->admin_university_id]);
        return $allFaculties;
    }
    private function allSpecialties()
    {
        $allSpecialties = DB::select('SELECT * FROM libsense_uz.specialties WHERE specialty_university_id = ?', [$this->currentAdmin()->admin_university_id]);
        return $allSpecialties;
    }
    private function allGroups()
    {
        $allGroups = DB::select('SELECT * FROM libsense_uz.groups WHERE group_university_id = ?', [$this->currentAdmin()->admin_university_id]);
        return $allGroups;
    }
    private function allBooks()
    {
        $allBooks = DB::select('SELECT * FROM libsense_uz.books WHERE book_university_id = ?', [$this->currentAdmin()->admin_university_id]);
        return $allBooks;
    }
    private function allEBooks()
    {
        $allEBooks = DB::select('SELECT * FROM libsense_uz.e_books WHERE ebook_university_id = ?', [$this->currentAdmin()->admin_university_id]);
        return $allEBooks;
    }
    private function allEBooksCount()
    {
        $allEBooks = DB::select("SELECT COUNT(*) AS 'all_ebooks_count' FROM libsense_uz.e_books WHERE ebook_university_id = ?", [$this->currentAdmin()->admin_university_id]);
        return $allEBooks[0]->all_ebooks_count;
    }
    private function allEBooksPrimCount()
    {
        $allEBooks = DB::select("SELECT COUNT(*) AS 'all_ebooks_prim_count' FROM libsense_uz.e_books WHERE is_book_primary=1 AND ebook_university_id = ?", [$this->currentAdmin()->admin_university_id]);
        return $allEBooks[0]->all_ebooks_prim_count;
    }
    private function allUsers()
    {
        $allUsers = DB::select('SELECT * FROM libsense_uz.users WHERE user_profile_status = ?', ['active']);
        return $allUsers;
    }
    private function allNewUsers()
    {
        $allNewUsers = DB::select('SELECT * FROM libsense_uz.users WHERE user_profile_status = ?', ['pending']);
        return $allNewUsers;
    }
    private function allOrders()
    {
        $allOrders = DB::select('SELECT orders.*,users.id as "user_id" ,users.name,users.user_borrow_count,users.user_profile_image,users.user_passport_id,users.user_phone, users.user_course_number, users.user_group_id FROM libsense_uz.orders,libsense_uz.users WHERE order_university_id = ? AND order_user_id = users.id ORDER BY orders.id DESC', [$this->currentUniversity()->id]);
        return $allOrders;
    }
    private function allOrdersWithBooks()
    {
        $allOrders = DB::select('SELECT orders.*,books.id as "book_id" ,books.book_name,books.book_campus_id,books.book_copy_count, books.book_copy_count_now  FROM libsense_uz.orders,libsense_uz.books WHERE order_university_id = ? AND order_book_id = books.id', [$this->currentUniversity()->id]);
        return $allOrders;
    }
    private function rejectedMessage($id)
    {
        $rejectedMessage = DB::select('SELECT * FROM libsense_uz.rejected_user_messages WHERE user_id = ?', [$id]);
        return $rejectedMessage;
    }
    private function allBorrows()
    {
        $allBorrows = DB::select("SELECT libsense_uz.borrows.id,libsense_uz.borrows.borrow_status,libsense_uz.borrows.borrow_book_inv_number,libsense_uz.borrows.borrow_when_return,libsense_uz.borrows.created_at,libsense_uz.users.id AS 'user_id', libsense_uz.users.name AS 'user_name',libsense_uz.users.user_passport_id,libsense_uz.users.user_phone,libsense_uz.users.user_profile_image,libsense_uz.books.id AS 'book_id', libsense_uz.books.book_name,libsense_uz.books.book_campus_id
        FROM ((libsense_uz.borrows INNER JOIN libsense_uz.users ON libsense_uz.borrows.borrow_user_id = libsense_uz.users.id)
          INNER JOIN libsense_uz.books ON libsense_uz.borrows.borrow_book_id = libsense_uz.books.id) WHERE libsense_uz.borrows.borrow_university_id = ? ORDER BY libsense_uz.borrows.id DESC", [$this->currentUniversity()->id]);
        return $allBorrows;
    }
    private function bookCategoryCount()
    {
        $bokCatCount = DB::select("SELECT book_category , COUNT(*) AS 'book_category_count', sum(book_copy_count) as 'book_copy_count' FROM libsense_uz.books WHERE book_category>0 AND book_university_id = ? GROUP BY book_category ORDER BY book_category", [$this->currentUniversity()->id]);
        return $bokCatCount;
    }
    private function allCategories()
    {
        $temp = array(
            1 => 'Darslik',
            2 => "O'quv qo'llanma",
            3 => "O'quv uslubiy qo'llanma",
            4 => "Monografiya",
            5 => "Risola",
            6 => "Dastur",
            7 => "To'plam",
            8 => "Ensiklopediya",
            9 => "Lug'at",
            10 => "Qonunlar",
            11 => "Ma'lumotnoma",
            12 => "Avtoreferat",
            13 => "Dissertatsiya",
            999 => "Boshqa"
        );
        return $temp;
    }
    private function allCampusTMsCount()
    {
        $temp = DB::select("SELECT libsense_uz.a_r_m_s.id as 'campus_id', libsense_uz.a_r_m_s.campus_name , COUNT(*) AS 'tm_count' FROM libsense_uz.a_r_m_s,libsense_uz.books WHERE a_r_m_s.id=books.book_campus_id AND books.book_file != '' AND a_r_m_s.campus_university_id = ? GROUP BY campus_id", [$this->currentUniversity()->id]);
        return $temp;
    }
    private function eachCampusStat()
    {
        $temp = DB::select("SELECT a_r_m_s.id AS 'campus_id', a_r_m_s.campus_name, COUNT(books.id) AS 'book_nomda' ,SUM(books.book_copy_count) AS 'book_nusxada' FROM libsense_uz.a_r_m_s, libsense_uz.books
        WHERE a_r_m_s.id = books.book_campus_id AND book_type = 1 AND book_university_id = ? GROUP BY campus_id", [$this->currentUniversity()->id]);
        return $temp;
    }

}
