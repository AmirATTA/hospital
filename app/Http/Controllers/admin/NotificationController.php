<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Traits\RedirectNotify;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class NotificationController extends Controller
{
    use RedirectNotify;
    
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view notifications')->only('index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::orderBy('id', 'desc')->paginate(15);
        return view('admin.notification.index')->with([
            'notifications' => $notifications,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $notification = Notification::findOrFail($id);

        $previousUrl = $request->headers->get('referer');
        
        if (strpos($previousUrl, route('dashboard.index')) !== false) {
            if($notification->viewed_at == null) {
                $notification->update([
                    'viewed_at' => Carbon::now(),
                ]); 
            }
        }

        return view('admin.notification.show')->with([
            'notification' => $notification,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
