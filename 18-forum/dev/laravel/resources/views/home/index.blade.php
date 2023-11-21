@extends('layouts.main')

@section('pagetitle')
    Home
@endsection

@section('content')
{{--    @foreach($threads as $thread)--}}
    <div class="row first-row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Threads</span>
                    <div class="collection">
                        <!-- BEGIN VAN EEN THREAD -->
                        <a href="thread.html" class="collection-item avatar collection-link">
                            <img src="img/icon-php.png" alt="" class="circle">
                            <div class="row">
                                <div class="col s9">
                                    <div class="row last-row">
                                        <div class="col s12">
                                            <span class="title">
{{--                                                {{ $thread->title }}--}}
                                            </span>
                                            <p>
{{--                                                {{ $thread->description }}--}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row last-row">
                                        <div class="col s12 post-timestamp">
{{--                                            Moderator: {{$thread->user->name}}--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col s3">
                                    <h6 class="title center-align">Statistieken</h6>
                                    <p class="center-align">
{{--                                        {{ $thread->topics_count }}--}}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    @endforeach--}}
@endsection
