@extends('layouts.sepuh')

@section('content')
<div class="container mt-1">
    {{-- show pdf without automatically download it --}}
    <iframe src="{{asset('docs')}}/4393-Article-Text-16664-1-10-20231022.pdf" height="800vh" width="100%"></iframe>
</div>
@endsection