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

@extends('layouts.admin', [
    'title' => "Edit {$user->user->username}'s Staff Permissions"
])

@section('js')
    <script>
        var toggled = false;

        $(() => {
            $('#toggle').click(function() {
                toggled = !toggled;

                $('#toggle').removeClass('green red');
                $('#toggle i').removeClass('fa-toggle-on fa-toggle-off');

                if (!toggled) {
                    $('#toggle').addClass('red');
                    $('#toggle i').addClass('fa-toggle-off');
                    $('input:checkbox').prop('checked', false);
                } else {
                    $('#toggle').addClass('green');
                    $('#toggle i').addClass('fa-toggle-on');
                    $('input:checkbox').prop('checked', true);
                }
            });
        });
    </script>
@endsection

@section('header')
    <button class="red small" id="toggle"><i class="fas fa-toggle-off"></i> Toggle All</button>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Edit {{ $user->user->username }}'s Staff Permissions</div>
        <div class="card-body">
            <form action="{{ route('admin.manage.staff.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $user->user->id }}">
                <div class="row">
                    @foreach ($permissions as $title => $options)
                        <div class="col-md-3">
                            <label style="margin-bottom:0;">{{ $title }}</label>
                            @foreach ($options as $title => $option)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="{{ $option }}" {{ ($user->$option) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $option }}">{{ $title }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="row mt-1">
                    <div class="col">
                        <button class="green w-100" type="submit">Update</button>
                    </div>
                    <div class="col">
                        <button class="orange w-100" name="password">Reset Password</button>
                    </div>
                    @if ($user->user->id != staffUser()->id)
                        <div class="col">
                            <button class="red w-100" name="delete">Delete</button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
