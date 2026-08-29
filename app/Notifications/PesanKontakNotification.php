<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PesanKontak;

class PesanKontakNotification extends Notification
{
    use Queueable;

    public function __construct(public PesanKontak $pesanKontak)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Pesan Baru dari Website SI UKRI: ' . $this->pesanKontak->subjek)
                    ->greeting('Halo Admin SI UKRI,')
                    ->line('Anda menerima pesan baru melalui form kontak website SI UKRI:')
                    ->line('Nama: ' . $this->pesanKontak->nama)
                    ->line('Email: ' . $this->pesanKontak->email)
                    ->line('Subjek: ' . $this->pesanKontak->subjek)
                    ->line('Pesan: ' . $this->pesanKontak->pesan)
                    ->action('Lihat di Admin Panel', url('/admin/pesan-kontaks/' . $this->pesanKontak->id . '/edit'));
    }
}
