@extends('layouts.public')

@section('title', 'Galeri Yayasan')

@push('styles')
<style>
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .gallery-item {
        position: relative;
        cursor: pointer;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.03);
    }

    .gallery-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .modal-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        padding: 20px;
        box-sizing: border-box;
    }

    .modal-content {
        width: 100%;
        max-width: 1100px;
        max-height: 90vh;
        overflow-y: auto;
        background: white;
        color: black;
        border-radius: 12px;
        padding: 30px;
        position: relative;
        text-align: center;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);
    }

    .modal-content img {
        max-width: 100%;
        max-height: 500px;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .modal-description {
        font-size: 1rem;
        color: #333;
        line-height: 1.6;
    }

    .modal-close {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        font-size: 2rem;
        color: #333;
        cursor: pointer;
    }

    .modal-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2rem;
        background: rgba(255, 255, 255, 0.7);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        z-index: 10000;
    }

    .modal-nav.left {
        left: 10px;
    }

    .modal-nav.right {
        right: 10px;
    }
</style>
@endpush

@section('content')
<div style="text-align: center; padding: 40px;">
    <h2 style="color: black;">Galeri Kegiatan Yayasan</h2>
    <p style="max-width: 600px; margin: 10px auto; color: #000;">
        Berikut dokumentasi foto kegiatan yang dilakukan oleh yayasan.
    </p>
</div>

<div class="gallery-grid">
    @foreach($galleries as $index => $item)
        <div class="gallery-item"
             data-index="{{ $index }}"
             data-image="{{ asset('storage/' . $item->gambar) }}"
             data-description="{{ $item->deskripsi ?? '' }}"
             onclick="openModal({{ $index }})">
            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul ?? 'Gambar' }}">
        </div>
    @endforeach
</div>

<!-- Modal -->
<div class="modal-overlay" id="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        <button class="modal-nav left" onclick="navigate(-1)">&#8592;</button>
        <button class="modal-nav right" onclick="navigate(1)">&#8594;</button>
        <img id="modal-image" src="" alt="">
        <p id="modal-description" class="modal-description"></p>
    </div>
</div>

<script>
    const modal = document.getElementById('modal');
    const imageEl = document.getElementById('modal-image');
    const descEl = document.getElementById('modal-description');
    const items = document.querySelectorAll('.gallery-item');
    let currentIndex = 0;

    function openModal(index) {
        currentIndex = index;
        showModalByIndex(index);
        modal.style.display = 'flex';
    }

    function showModalByIndex(index) {
        const item = items[index];
        if (!item) return;
        imageEl.src = item.dataset.image;
        descEl.innerHTML = item.dataset.description;
    }

    function navigate(direction) {
        currentIndex += direction;
        if (currentIndex < 0) currentIndex = items.length - 1;
        if (currentIndex >= items.length) currentIndex = 0;
        showModalByIndex(currentIndex);
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    document.addEventListener('keydown', function (e) {
        if (modal.style.display === 'flex') {
            if (e.key === 'ArrowLeft') navigate(-1);
            if (e.key === 'ArrowRight') navigate(1);
            if (e.key === 'Escape') closeModal();
        }
    });
</script>
@endsection
