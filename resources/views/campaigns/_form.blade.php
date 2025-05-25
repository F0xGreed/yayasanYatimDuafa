<div class="mb-3">
    <label for="judul" class="form-label">Judul Kampanye <span class="text-danger">*</span></label>
    <input type="text" id="judul" name="judul" class="form-control"
           value="{{ old('judul', $campaign->judul ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="gambar" class="form-label">Gambar Kampanye</label>
    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">

    @if(isset($campaign) && $campaign->gambar)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $campaign->gambar) }}" alt="Gambar Kampanye"
                 class="img-thumbnail" style="max-width: 200px;">
        </div>
    @endif
</div>

<div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $campaign->deskripsi ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="target_donasi" class="form-label">Target Donasi (Rp) <span class="text-danger">*</span></label>
    <input type="number" id="target_donasi" name="target_donasi" class="form-control" min="0"
           value="{{ old('target_donasi', $campaign->target_donasi ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
           value="{{ old('tanggal_mulai', isset($campaign) && $campaign->tanggal_mulai ? $campaign->tanggal_mulai->format('Y-m-d') : '') }}" required>
</div>

<div class="mb-3">
    <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
    <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control"
           value="{{ old('tanggal_selesai', isset($campaign) && $campaign->tanggal_selesai ? $campaign->tanggal_selesai->format('Y-m-d') : '') }}" required>
</div>

<div class="d-flex justify-content-between">
    <button type="submit" class="btn btn-primary">💾 Simpan</button>
    <a href="{{ route('campaigns.index') }}" class="btn btn-secondary">← Kembali</a>
</div>
