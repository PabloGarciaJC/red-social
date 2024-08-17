@extends('layouts.app')

@section('dynamic-content')
    <main id="main" class="main">

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">

                        @include('includes.home.createPublication')

                        @include('includes.home.showPublication')
                    </div>
                </div>

                @include('includes.contacts')
            </div>
        </section>
    </main>
@endsection

