@extends('layouts.master')

@section('title', 'Tambah Kampanye Donasi')

@section('content')
<div class="container mt-4">
    <h2>➕ Tambah Kampanye Donasi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('campaigns._form', ['campaign' => null])
    </form>
</div>
@endsection
