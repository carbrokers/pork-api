@extends('layouts.admin')
@section('content')
  <div class="edit_article_container">
       <edit-article 
        {{--  selected-catgs="[]"  --}}
        article-id={{$articleId}}
        user-id={{Auth::user()->id}}>
       </edit-article>
  </div>

@endsection