<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DataRPP;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Livewire\WithPagination;

class DaftarRpp extends Component
{
    use WithPagination;

    // Menggunakan tema pagination Tailwind
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        // 1. Ambil data dengan pagination
        $list = DataRPP::select('id', 'materi_pokok', 'tahun_pelajaran', 'mata_pelajaran', 'status', 'created_at', 'core_type')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // 2. Transformasi koleksi untuk menambahkan hashid & hapus id asli demi keamanan
        $list->getCollection()->transform(function ($item) {
            $item->hashid = Hashids::encode($item->id);
            unset($item->id);
            return $item;
        });

        return view('livewire.daftar-rpp', [
            'list' => $list
        ]);
    }
}
