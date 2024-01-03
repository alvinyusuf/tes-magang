@extends('layouts.main')

@section('content')
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-4">
              <img src="{{ asset("storage/$data->cover") }}" alt="" width="250">
            </div>
            <div class="col-8">
              @if (Request::is('dashboard*'))
                <a href="/dashboard/{{ $data->id }}/edit"><button class="btn btn-warning">Edit</button></a>
                <form action="/dashboard/{{ $data->id }}" method="POST" class="my-2">
                  @method('delete')
                  @csrf
                  <input type="hidden" value="{{ $data->id }}">
                  <button class="btn btn-danger">Delete</button>
                </form>
                <a href="/download/{{ $data->id }}"><button class="btn btn-primary">Download</button></a>
              @endif
              <h1>{{ $data->judul }}</h1>
              <h3>Kategori: {{ $data->category->kategori }}</h3>
              <h3>Author: {{ $data->author->name }}</h3>
              <p>{{ $data->deskripsi }}</p>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
@endsection