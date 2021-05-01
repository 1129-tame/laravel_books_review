@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <h1 class='pagetitle'>レビュー詳細ページ</h1>
  <div class="card">
    <div class="card-body d-flex">
      <section class='review-main'>
        <h2 class='h2'>本のタイトル</h2>
        <p class='h2 mb20'>「{{ $review->title }}」</p>
        <h2 class='h4'>◯レビュー本文</h2>
        <p>{{ $review->body }}</p>
      </section>  
      <aside class='review-image'>
@if(!empty($review->image))
        <img class='book-image' src="{{ asset('storage/images/'.$review->image) }}">
@else
        <img class='book-image' src="{{ asset('images/dummy.png') }}">
@endif
      </aside>
    </div>
    <div class="container">
        <div class="row justify-content-center">
          <a href="{{ route('index') }}" class='col-2 btn btn-info btn-back mb20 mx-5'>一覧へ戻る</a>
          <!-- <img src="{{ asset('images/nicebutton.png') }}" width="30px"> -->
      @if ($like)

          <a href="{{ route('unlike', ['id' => $review->id ]) }}" class='col-2 btn btn-danger btn-back mb20 mx-5'>いいねを外す <span class="badge badge-light badge-pill">{{ $like_count }}</span></a>
          

      @else
          <a href="{{ route('like', ['id' => $review->id ]) }}" class='col-2 btn btn-success btn-back mb20 mx-5'>いいねを押す <span class="badge badge-light badge-pill">{{ $like_count }}</span></a>
          
      @endif
        </div>
   
    </div>
    
  </div>
</div>
@endsection