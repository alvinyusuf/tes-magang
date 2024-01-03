@extends('layouts.main')

@section('content')
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Home</h1>
      @if (Request::is('dashboard'))
        <a href="/dashboard/create"><button class="btn btn-success">Tambah Buku</button></a>
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
        @foreach ($books as $book)
          @if (Request::is('dashboard'))
            <a href="/dashboard/{{ $book->id }}">
          @else
            <a href="/home/{{ $book->id }}">
          @endif
            <div class="col">
              <div class="card h-100">
                <img src="{{ asset("storage/$book->cover") }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $book->judul }}</h5>
                  <span class="text-success small pt-1 fw-bold">{{ $book->category->kategori }}</span>
                  <p class="card-text">{{ $book->author->name }}</p>
                </div>
              </div>
            </div>
          </a>
        @endforeach
        {{ $books->links() }}
      </div>
    </section>

  </main>
@endsection