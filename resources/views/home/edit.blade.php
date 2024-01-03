@extends('layouts.main')

@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Tambah Buku Baru</h1>
  </div>

  <section class="section dashboard">
    <div class="my-3">
      <img src="{{ asset("storage/$data->cover") }}" alt="" width="250">
    </div>
    <form action="/dashboard/{{ $data->id }}" method="POST" class="mb-5" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
        <div class="col-sm-10">
          <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ $data->judul }}">
          @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
          <select class="form-select @error('kategori') is-invalid @enderror" aria-label="Default select example" name="category_id">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ $category->id == $data->category->id ? 'selected' : '' }}>{{ $category->kategori }}</option>
            @endforeach
          </select>
          @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row mb-3">
        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
          <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" style="height: 100px">{{ $data->deskripsi }}</textarea>
          @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row mb-3">
        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Buku</label>
        <div class="col-sm-10">
          <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ $data->jumlah }}">
          @error('jumlah')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row mb-3">
        <label for="file" class="col-sm-2 col-form-label">File Buku (PDF)</label>
        <div class="col-sm-10">
          <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file">
          @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row mb-3">
        <label for="cover" class="col-sm-2 col-form-label">Cover Buku (jpeg/jpg/png)</label>
        <div class="col-sm-10">
          <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" name="cover">
          @error('cover')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form>
  </section>
@endsection