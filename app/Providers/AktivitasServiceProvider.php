<?php

namespace App\Providers;

use App\Models\Aktivitas;
use App\Models\Pelanggan;
use App\Models\Toko;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AktivitasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Log Pelanggan activities
        Pelanggan::created(function ($pelanggan) {
            $this->logActivity('create', 'pelanggan', $pelanggan->id);
        });

        Pelanggan::updated(function ($pelanggan) {
            $this->logActivity('update', 'pelanggan', $pelanggan->id);
        });

        Pelanggan::deleted(function ($pelanggan) {
            $this->logActivity('delete', 'pelanggan', $pelanggan->id);
        });

        // Log Toko activities
        Toko::created(function ($toko) {
            $this->logActivity('create', 'toko', $toko->id);
        });

        Toko::updated(function ($toko) {
            $this->logActivity('update', 'toko', $toko->id);
        });

        Toko::deleted(function ($toko) {
            $this->logActivity('delete', 'toko', $toko->id);
        });

        // Log Transaksi activities
        Transaksi::created(function ($transaksi) {
            $this->logActivity('create', 'transaksi', $transaksi->id);
        });

        Transaksi::updated(function ($transaksi) {
            $this->logActivity('update', 'transaksi', $transaksi->id);
        });

        Transaksi::deleted(function ($transaksi) {
            $this->logActivity('delete', 'transaksi', $transaksi->id);
        });

        // Log User activities
        User::created(function ($user) {
            $this->logActivity('create', 'user', $user->id);
        });

        User::updated(function ($user) {
            $this->logActivity('update', 'user', $user->id);
        });

        User::deleted(function ($user) {
            $this->logActivity('delete', 'user', $user->id);
        });
    }

    /**
     * Log activity
     */
    private function logActivity(string $aksi, string $entitas, int $entitasId): void
    {
        // Skip logging if no user is authenticated (like during seeding)
        if (!Auth::check()) {
            return;
        }

        Aktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => $aksi,
            'entitas' => $entitas,
            'entitas_id' => $entitasId,
            'waktu' => now(),
        ]);
    }
}
