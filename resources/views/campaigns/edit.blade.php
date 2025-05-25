@extends('layouts.master')

@section('title', 'Edit Kampanye Donasi')

@section('content')
<div class="container mt-4">
    <h2>✏️ Edit Kampanye Donasi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('campaigns._form', ['campaign' => $campaign])
    </form>
</div>
@endsection
