<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\InviteMail;
use App\Models\Invite;
use Illuminate\Support\Str;

class UserController extends Controller {
    
    /**
     * Display user members of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $title = "User Members";
        $description = "Some description for the page";
        return view('pages.applications.user.member',compact('title','description'));
    }

    /**
     * Display user grid of the resource.
     *
     * @return \Illuminate\View\View
     */




    public function grid(){
        $title = "User List";
    $description = "Some description for the page";
    $hotelId = auth()->user()->hotel_id;

    $users = User::where('hotel_id', $hotelId)->where('id', '!=', auth()->id())->get();

    return view('pages.applications.user.grid', compact('title', 'description', 'users', 'hotelId'));

    }


    public function removeUser(Request $request, $userId)
{
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['error' => 'Kullanıcı bulunamadı'], 404);
    }

    // Kullanıcının gerçekten çıkarmak istediğinden emin olmak için onay kontrolü
    if ($request->has('confirm') && $request->input('confirm')) {
        $user->update(['hotel_id' => Null]); // veya $user->update(['hotel_id' => 0]);

        return response()->json(['message' => 'Kullanıcının hotel_id bilgisi başarıyla silindi']);
    }

    return response()->json(['message' => 'Hotel_id bilgisini silmek istediğinizden emin misiniz?']);
}

public function sendInviteEmail(Request $request)
{
    $email = $request->input('email');

    if ($email === auth()->user()->email) {
        return redirect()->back()->with('error', 'Kendi e-posta adresinize davet gönderemezsiniz.');
    }

    $existingUser = User::where('email', $email)->first();

    if ($existingUser) {
        if ($existingUser->hotel_id !== null) {
            return redirect()->back()->with('error', 'Kullanıcı bir işletmeye kayıtlı.');
        }

        // Bekleyen davet var mı kontrol et
        $existingPendingInvite = Invite::where('user_id', $existingUser->id)
            ->where('accepted', false)
            ->first();

        if ($existingPendingInvite) {
            return redirect()->back()->with('warning', 'Bu kullanıcının zaten bekleyen bir daveti var.');
        }

        $inviteLink = 'https://admin.chattrip.net';


        
        $hotelName = auth()->user()->hotel->hotel_name;
        Mail::to($email)->send(new InviteMail($inviteLink, $hotelName));

        Invite::create([
            'inviter_id' => auth()->user()->id,
            'user_id' => $existingUser->id,
            'hotel_id' => auth()->user()->hotel_id,
            'token' => Str::random(32),
            'accepted' => false,
        ]);

        return redirect()->back()->with('success', 'Davet gönderildi!');
    } else {
        return redirect()->back()->with('error', 'Davet edilen kullanıcı henüz Chattrip üyesi değil.');
    }
}

public function acceptInvite($language , $userId)
{
    $user = User::find($userId);

    if ($user) {
        $invite = Invite::where('user_id', $userId)->where('accepted', false)->first();

        if ($invite) {
            // Davet kabul edildiği zaman yapılacak işlemler
            $invite->update([
                'accepted' => true,
            ]);

            // Kullanıcının hotel_id'sini güncelle
            $user->update([
                'hotel_id' => $invite->hotel_id,
            ]);

            return redirect()->back()->with('success', 'Davet kabul edildi.');
        }
    }

    return redirect()->back()->with('error', 'Davet kabul edilemedi.');
}

public function rejectInvite($language , $userId)
{
    // Davet reddedildiği zaman yapılacak işlemler
    $invite = Invite::where('user_id', $userId)->where('accepted', false)->first();

    if ($invite) {
        $invite->delete();

        return redirect()->back()->with('success', 'Davet reddedildi.');
    }

    return redirect()->back()->with('error', 'Davet reddedilemedi.');
}



    /**
     * Display user list of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function list(){
        $title = "User List";
        $description = "Some description for the page";
        return view('pages.applications.user.list',compact('title','description'));
    }

    /**
     * Display user grid style of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function gridStyle(){
        $title = "User Grid Style List";
        $description = "Some description for the page";
        return view('pages.applications.user.grid_style',compact('title','description'));
    }

    /**
     * Display user group of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function userGroup(){
        $title = "User Group List";
        $description = "Some description for the page";
        return view('pages.applications.user.user_group',compact('title','description'));
    }

    /**
     * Display user add of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function add(){
        $title = "User Add";
        $description = "Some description for the page";
        return view('pages.applications.user.add',compact('title','description'));
    }

    /**
     * Display user table of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function table(){
        $title = "User Data Table";
        $description = "Some description for the page";
        return view('pages.applications.user.data_table',compact('title','description'));
    }
}