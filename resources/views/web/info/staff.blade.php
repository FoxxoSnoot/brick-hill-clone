<!--
MIT License

Copyright (c) 2021-2022 FoxxoSnoot

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

@extends('layouts.default', [
    'title' => 'Staff'
])

@section('content')
    <div class="col-10-12 push-1-12">
        <div class="card">
            <div class="top blue">Staff</div>
            <div class="content">
                <div class="col-1-1" style="padding-right:0;">
                    @forelse ($staffUsers as $staffUser)
                        <a href="{{ route('users.profile', $staffUser->user->id) }}">
                            <div class="search-user-card ellipsis">
                                <img src="{{ $staffUser->user->thumbnail() }}">
                                <div class="data">
                                    <div class="ellipsis">
                                        <b>{{ $staffUser->user->username }}</b>
                                        <span style="float:right;" class="status-dot {{ ($staffUser->user->online()) ? 'online' : '' }}"></span>
                                    </div>
                                    <span class="ellipsis">{!! nl2br(e($staffUser->user->description)) !!}</span>
                                </div>
                            </div>
                        </a>
                        <hr>
                    @empty
                        <span>There are currently no staff.</span>
                    @endforelse
                    <div class="pages">{{ $staffUsers->onEachSide(1) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
