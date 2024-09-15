@extends('layouts.app')

@section('core-content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @include('publication.create')
                        @include('publication.show')
                    </div>
                </div>
                @include('home.contacts')
            </div>
        </section>
    </main>
@endsection

