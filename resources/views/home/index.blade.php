@extends('layouts.main')

@section('content')
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Home</h1>
    </div>

    <section class="section dashboard">
      <div class="row">
        @foreach ($books as $book)
          <div class="col-lg-3">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">{{ $book->judul }}</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $book->author->name }}</h6>
                    <span class="text-success small pt-1 fw-bold">{{ $book->category->kategori }}</span>
                  </div>
                </div>
              </div>

            </div>
          </div>
        @endforeach
        {{ $books->links() }}
      </div>
    </section>

  </main>
@endsection