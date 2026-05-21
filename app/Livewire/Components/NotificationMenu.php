<?php

namespace App\Livewire\Components;

use App\Models\UserNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationMenu extends Component
{
    public function markAsRead(int $notificationId): void
    {
        UserNotification::query()
            ->where('user_id', Auth::id())
            ->whereKey($notificationId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public function markAllAsRead(): void
    {
        UserNotification::query()
            ->where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public function openNotification(int $notificationId): void
    {
        $notification = UserNotification::query()
            ->with(['actor', 'activity.user'])
            ->where('user_id', Auth::id())
            ->whereKey($notificationId)
            ->firstOrFail();

        if ($notification->read_at === null) {
            $notification->forceFill(['read_at' => now()])->save();
        }

        $this->redirect($this->notificationUrl($notification));
    }

    public function message(UserNotification $notification): string
    {
        return match ($notification->type) {
            UserNotification::TYPE_ACTIVITY_LIKED => "{$notification->actor?->name}さんがあなたの記録にいいねしました",
            UserNotification::TYPE_FOLLOWED => "{$notification->actor?->name}さんにフォローされました",
            default => '新しい通知があります',
        };
    }

    public function notificationUrl(UserNotification $notification): string
    {
        if ($notification->type === UserNotification::TYPE_FOLLOWED && $notification->actor) {
            return route('users.show', $notification->actor);
        }

        if ($notification->activity?->user) {
            return route('users.show', $notification->activity->user);
        }

        return route('home');
    }

    public function render(): View
    {
        $notifications = UserNotification::query()
            ->with(['actor', 'activity.user', 'activity.song'])
            ->where('user_id', Auth::id())
            ->latest()
            ->limit(10)
            ->get();

        return view('livewire.components.notification-menu', [
            'notifications' => $notifications,
            'unreadCount' => $this->unreadCount(),
        ]);
    }

    private function unreadCount(): int
    {
        return UserNotification::query()
            ->where('user_id', Auth::id())
            ->whereNull('read_at')
            ->count();
    }
}
