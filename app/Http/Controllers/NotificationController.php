<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use App\Http\Requests\NotificationRequest;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function index()
    {
        $notifications = $this->notificationService->getAllNotifications();
        return view('dashboard.notification.index', compact('notifications'));
    }
    public function create()
    {
        return view('dashboard.notification.create');
    }
    public function store(NotificationRequest $request)
    {
        $data = $request->validated();
        $this->notificationService->createNotification($data);
        return redirect(route('index-notification'))->with('success', 'Notifikasi berhasil dibuat.');
    }
    public function edit($id)
    {
        $notification = $this->notificationService->getNotificationById($id);
        return view('dashboard.notification.edit', compact('notification'));
    }
    public function update(NotificationRequest $request, $id)
    {
        $notification = $this->notificationService->getNotificationById($id);
        $data = $request->validated();
        $this->notificationService->updateNotification($notification, $data);
        return redirect(route('index-notification'))->with('success', 'Notifikasi berhasil diupdate.');
    }
    public function destroy($id)
    {
        $this->notificationService->deleteNotification($id);
        return redirect(route('index-notification'))->with('success', 'Notifikasi berhasil dihapus.');
    }
}
