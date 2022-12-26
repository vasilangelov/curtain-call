{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('city') }}"><i class="nav-icon la la-th-list"></i> Cities</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('theater') }}"><i class="nav-icon la la-th-list"></i> Theaters</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('performance') }}"><i class="nav-icon la la-th-list"></i> Performances</a></li>