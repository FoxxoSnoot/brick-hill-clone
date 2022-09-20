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
    'title' => $game->name,
    'image' => $game->thumbnail()
])

@section('meta')
    <meta
        name="game-info"
        data-id="{{ $game->id }}"
        @if ($game->is_active && Auth::check())
            data-launch="{{ Auth::user()->gameLaunch($game->id, 'client') }}"
        @endif
    >
@endsection

@section('js')
    <script src="{{ js_file('games/view') }}"></script>
@endsection

@section('content')
    <div class="col-10-12 push-1-12">
        <div class="card" style="margin-bottom:20px;">
            <div class="top blue">{{ $game->name }}</div>
            <div class="content" style="position:relative;">
                <div class="col-5-12" style="padding-right:0;">
                    <div class="box game-img">
                        <img src="{{ $game->thumbnail() }}">
                    </div>
                </div>
                <div class="col-4-12" style="padding-left:10px;padding-right:0;">
                    @if (!$game->is_active)
                        <div class="red-text mb2">This server is currently offline.</div>
                    @else
                        <div class="red-text mb2">{{ $game->playing }} {{ ($game->playing == 1) ? 'player' : 'players' }}</div>
                        <button class="blue mb2" {!! (Auth::check()) ? 'id="play"' : '' !!}>PLAY</button>
                    @endif

                    @if (Auth::check() && $game->creator->id == Auth::user()->id)
                        <a href="{{ route('games.edit', $game->id) }}" class="button orange smaller-text">EDIT</a>
                        <button class="red smaller-text" data-modal-open="host">HOST</button>
                        <div class="modal" style="display:none;" data-modal="host">
                            <div class="modal-content">
                                <span class="close" data-modal-close="host">×</span>
                                <span>Hosting</span>
                                <hr>
                                <span>Hosting from the legacy server has been disabled. You can now only host using the Node-Hill server.</span>
                                <br>
                                <a href="https://brickhill.gitlab.io/open-source/node-hill/">Instructions to download are available <b>here.</b></a>
                                <div class="modal-buttons">
                                    <button type="button" class="cancel-button" data-modal-close="host">Cancel</button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="agray-text bold mt2" style="word-wrap:break-word;">{!! nl2br(e($game->description)) !!}</div>
                    <div class="small-text mt6 mb2">
                        <div class="item-stats">
                            <span class="agray-text">Created:</span>
                            <span class="darkest-gray-text" title="{{ $game->created_at->format('D, M d Y h:i A') }}">{{ $game->created_at->format('Y/m/d') }}</span>
                        </div>
                        <div class="item-stats">
                            <span class="agray-text">Updated:</span>
                            <span class="darkest-gray-text" title="{{ $game->updated_at->format('D, M d Y h:i A') }}">{{ $game->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="item-stats">
                            <span class="agray-text">Visits:</span>
                            <span class="darkest-gray-text">{{ $game->visits }}</span>
                        </div>
                    </div>
                    <span class="hover-cursor favorite-text" id="favorite">
                        <i class="far fa-star" {!! (Auth::check()) ? 'id="favoriteIcon"' : '' !!}></i>
                        <span style="font-size: 0.9rem;" id="favoriteCount">0</span>
                    </span>
                    @if (Auth::check() && $game->creator->id != Auth::user()->id && !$game->creator->isStaff())
                        <a href="{{ route('report.index', ['set', $game->id]) }}" class="red-text" style="margin-left:15px;">
                            <i class="far fa-flag"></i>
                            <span style="font-size: 0.9rem;">Report</span>
                        </a>
                    @endif
                </div>
                <div class="col-3-12 center-text">
                    <a href="{{ route('users.profile', $game->creator->id) }}">
                        <div class="game-creator-img">
                            <img class="width-100" src="{{ $game->creator->thumbnail() }}">
                            <span class="bold">{{ $game->creator->username }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="top blue">Comments</div>
            <div class="content">
                <span>Coming soon.</span>
            </div>
        </div>
    </div>
@endsection
