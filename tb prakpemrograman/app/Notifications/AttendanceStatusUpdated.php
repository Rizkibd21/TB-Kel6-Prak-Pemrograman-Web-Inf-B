<?php

namespace App\Notifications;

use App\Models\Attendance;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AttendanceStatusUpdated extends Notification
{
    use Queueable;

    public $attendance;

    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Attendance $attendance, $customMessage = null)
    {
        $this->attendance = $attendance;
        $this->message = $customMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'schedule_id' => $this->attendance->schedule_id,
            'subject_name' => $this->attendance->schedule->subject->name ?? 'Unknown',
            'status' => $this->attendance->status,
            'date' => $this->attendance->date,
            'message' => $this->message ?? "Status absensi Anda untuk mata kuliah {$this->attendance->schedule->subject->name} pada tanggal {$this->attendance->date} adalah: ".ucfirst($this->attendance->status),
        ];
    }
}
