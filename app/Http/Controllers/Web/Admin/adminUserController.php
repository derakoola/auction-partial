<?php

namespace App\Http\Controllers\Web\Admin;

use App\Helpers\Admin\AdminHelper;
use App\Helpers\Admin\MakeResponse;
use App\Http\Requests\Admin\User\SaveUserRequest;
use App\Models\Admin\Auction;
use App\Models\Api\V1\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class adminUserController extends Controller
{
    public function index(Request $request)
    {
        $q = trim(Input::get('q'));

        $users = User::orderBy('created_at');
        if ($request->query()) {
            if (strlen($q) > 0) {
                $users = $users->where(function ($query) use ($q) {
                    $query
                        ->where('firstName', 'like', '%' . $q . '%')
                        ->orWhere('lastName', 'like', '%' . $q . '%')
                        ->orWhere('_email', 'like', '%' . $q . '%');
                });
            }
        }
        $users = $users->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.users.show', compact('user'));
    }

    public function bids($user_id)
    {
        $auctions = Auction::all();
        foreach($auctions as $auction) {
            if(isset($auction->lots)) {
                foreach ($auction->lots as $lot) {
                    if(isset($lot['bids'])) {
                        foreach($lot['bids'] as $bid) {
                            if($bid['bidder']['user']['userId'] == $user_id) {
                                $bid['auction'] = $auction->title['fa'];
                                $bidded[] = $bid;
                            }
                        }
                    }

                }
            }
        }
        if(isset($bidded)) {
            $bidded = AdminHelper::paginate($bidded,10);

        }
//dd($bidded);
        return view('admin.users.bidded', compact('bidded'));
    }

    public function autocomplete(Request $request)
    {

        $users = User::orderBy('created_at');
        if ($request->query('filter_name')) {
            $q = $request->query('filter_name');
            $users = $users->where(function ($query) use ($q) {
                $query
                    ->orWhere('firstName', 'like', '%' . $q . '%')
                    ->orWhere('lastName', 'like', '%' . $q . '%')
                    ->orWhere('username', 'like', '%' . $q . '%')
                    ->orWhere('_phone', 'like', '%' . $q . '%');
            });
        }

        $data = $users->offset(0)->limit(5)->get();
        return response()->json($data);

    }

    public function userPermissions($user_id)
    {
        $user = User::find($user_id);
        $permissions = $user->_permissions;
        return view('admin.users.permissions', compact('permissions'));
    }

    public function add()
    {
        return view('admin.users.add');
    }

    public function save(SaveUserRequest $request)
    {
        $data = $request->all();
        User::create($data);
        Session::flash('message', 'کاربر جدید با موفقیت افزوده شد');
        return redirect('admin/users/index');
    }


    public function auctionPermissions($user_id,$auction_id)
    {

    }

    public function permissions()
    {
        return view('admin.users.AddPermissions');
    }
}
