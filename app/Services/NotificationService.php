<?php
namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Str;

class NotificationService
{
    public function getAllNotifications()
    {
        return Notification::all();
    }

    public function createNotification(array $data)
    {
        $data['id'] = Str::uuid();
        return Notification::create($data);
    }

    public function getNotificationById($id)
    {
        return Notification::findOrFail($id);
    }

    public function updateNotification(Notification $notification, array $data)
    {
        $notification->update($data);
        return $notification;
    }

    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
    }
}
