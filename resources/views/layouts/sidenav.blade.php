@if (request()->is('dashboard') || request()->is('dashboard/edas*') || request()->is('dashboard/journal'))
@include('layouts.sidebar.dashboard')
@else
@include('layouts.sidebar.dashboard2')
@endif