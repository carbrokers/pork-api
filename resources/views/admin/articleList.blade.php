@extends('layouts.admin')
@section('content')
  <div class="article_list">
    <article-list
        :art-list="{{$articleList}}"
    >
    </article-list>
  </div>
@endsection