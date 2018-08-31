@extends('layouts.admin')
@section('content')
    <div class="admin_main_container">
        <Home 
            back_count=@json($data['count'])
        />
    </div>
@endsection