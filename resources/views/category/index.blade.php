@extends('layouts.main')

@section('content')
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Kategori</h1>
      @if (auth()->user()->role === 'admin')
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahKategori">
          Tambah Kategori
        </button>
        <div class="modal fade" id="tambahKategori" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="/kategori" method="POST" class="mb-5">
                  @csrf
                  <div class="row mb-3">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="judul" name="kategori" value="{{ old('kategori') }}">
                      @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    
    @if (session()->has('fail'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <section class="section dashboard">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($categories as $category)
        <div class="col-4">
          @if (Request::is('home'))
          <form action="/home">
          @else    
          <form action="/dashboard">
          @endif
            <input type="hidden" value="{{ $category->id }}" name="kategori">
            <span><button class="btn btn-primary">{{ $category->kategori }}</button></span>
          </form>
          <span>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKategori">
              Edit
            </button>
          </span>
          <span>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusKategori">
              Hapus
            </button>
          </span>
          <div class="modal fade" id="editKategori" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Kategori</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="/kategori/{{ $category->id }}" method="POST" class="mb-5">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                      <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $category->kategori }}">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="hapusKategori" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Hapus Kategori</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Yakin ingin menghapus kategori {{ $category->kategori }}?</p>
                  <form action="/kategori/{{ $category->id }}" method="POST" class="mb-5">
                    @csrf
                    @method('DELETE')
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </section>
  </main>
@endsection