<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $campaigns = Campaign::with('donations')->latest()->paginate(10);
        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        $this->authorize('create', Campaign::class);


        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Campaign::class);


        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'target_donasi' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date|before_or_equal:tanggal_selesai',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only([
            'judul', 'deskripsi', 'target_donasi', 'tanggal_mulai', 'tanggal_selesai'
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kampanye', 'public');
            $data['gambar'] = $path;
        }

        Campaign::create($data);

        return redirect()->route('campaigns.index')->with('success', 'Kampanye berhasil dibuat.');
    }

    public function show($id)
    {
        $campaign = Campaign::with('donations')->findOrFail($id);

        if (auth()->check() && in_array(auth()->user()->role, ['admin', 'bendahara'])) {
            return view('campaigns.show', compact('campaign'));
        }

        return view('public.campaign_detail', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
       $this->authorize('update', $campaign);


        return view('campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $this->authorize('update', $campaign);


        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'target_donasi' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date|before_or_equal:tanggal_selesai',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only([
            'judul', 'deskripsi', 'target_donasi', 'tanggal_mulai', 'tanggal_selesai'
        ]);

        if ($request->hasFile('gambar')) {
            if ($campaign->gambar && Storage::disk('public')->exists($campaign->gambar)) {
                Storage::disk('public')->delete($campaign->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('kampanye', 'public');
        }

        $campaign->update($data);

        return redirect()->route('campaigns.index')->with('success', 'Kampanye berhasil diperbarui.');
    }

    public function destroy(Campaign $campaign)
    {
        $this->authorize('delete', $campaign);


        if ($campaign->gambar && Storage::disk('public')->exists($campaign->gambar)) {
            Storage::disk('public')->delete($campaign->gambar);
        }

        $campaign->delete();

        return redirect()->route('campaigns.index')->with('success', 'Kampanye berhasil dihapus.');
    }

    public function donate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'nominal' => 'required|numeric|min:1000',
            'pesan' => 'nullable|string|max:500',
        ]);

        $campaign = Campaign::findOrFail($id);

        $campaign->donations()->create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'nominal' => $request->nominal,
            'pesan' => $request->pesan,
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas donasi Anda!');
    }
}
