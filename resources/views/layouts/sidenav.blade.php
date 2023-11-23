@if (request()->is('dashboard') || request()->is('dashboard/edas*'))
@include('layouts.sidebar.dashboard')
@else
@include('layouts.sidebar.dashboard2')
@endif