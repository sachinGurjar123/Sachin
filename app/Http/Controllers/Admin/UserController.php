<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\UserExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\HelperService;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Services\ManagerLanguageService;
use App\Services\UserService;

class UserController extends Controller
{
    protected $mls, $change_password;

    public function __construct()
    {
        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages');
        //view files
        $this->change_password = 'admin.admin_profile.change_password';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = UserService::datatable();
            if (isset($request->name)) {
                $items = $items->where('name', 'like', "%{$request->name}%");
            }
            if (isset($request->email)) {
                $items = $items->where('email', 'like', "%{$request->email}%");
            }
            if (isset($request->mobile_no)) {
                $items = $items->where('mobile_no', $request->mobile_no);
            }
            if (isset($request->user_id)) {
                $items = $items->where('id', $request->user_id);
            }
            if (isset($request->status)) {
                $items = $items->where('is_active', $request->status);
            }
            if (isset($request->role)) {
                $items = $items->whereHas("roles", function ($q) use ($request) {
                    $q->where("name", $request->role);
                });
            }
            return datatables()->eloquent($items)->toJson();
        } else {
            $roles = Role::whereNotIn('name', ['Admin', 'Admin'])->pluck('name', 'name');
            return view('admin.user.index', compact('roles'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['Admin', 'Admin'])->pluck('name', 'name');
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $image = HelperService::imageUploader($request, 'image', 'files/users');
        if ($image != null) {
            $input['image'] = $image;
        }
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('admin.users.index')
            ->with('success', $this->mls->messageLanguage('created', 'user', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $lang_array = [
            'en' => 'English',
            'gr' => 'German',
        ];
        return view('admin.user.show', compact('user', 'lang_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::whereNotIn('name', ['Admin', 'Admin'])->pluck('name', 'name');
        $userRole = $user->roles->pluck('name', 'name');

        return view('admin.user.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        if (!empty($input['image'])) {
            $image = HelperService::imageUploader($request, 'image', 'files/users');
            if ($image != null) {
                $input['image'] = $image;
            }
        } else {
            $input = Arr::except($input, array('image'));
        }

        $user = User::find($id);
        $user->update($input);
        //model_has_roles hasn't its modal file, so we have to use DB.
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        // return redirect()->route('admin.users.index')
        return redirect()->back()
            ->with('success', $this->mls->messageLanguage('updated', 'user', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')
            ->with('success', $this->mls->messageLanguage('deleted', 'user', 1));
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = UserService::update(['is_active' => $status], $id);
        if ($result) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->messageLanguage('updated', 'status', 1),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->messageLanguage('not_updated', 'status', 1),
                'status_name' => 'error'
            ]);
        }
    }

    /**
     * Update the language in User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLanguage(User $user, $language)
    {
        $result = $user->update(['lang' => $language]);
        session()->put('locale', $language);
        if ($result) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->onlyNameLanguage('language_updated'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->onlyNameLanguage('language_not_updated'),
                'status_name' => 'error'
            ]);
        }
    }

    public function export(Request $request)
    {
        return (new UserExport($request))->download('users.xlsx');
    }
}
