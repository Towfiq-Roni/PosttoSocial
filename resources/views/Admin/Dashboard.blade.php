@extends('layouts.app')
@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center pt-5">
        <div class="col-md-12">
                   <h3 class="text-center"> MySpace {{Auth::user()->role}} </h3>
                   <div class="row ">
                   <div class="card text-white bg-secondary m-3 col-5" style="max-width: 18rem;">
                    <div class="card-header">Total Posts <span class="badge bg-dark">({{ count ($posts)}})</span> </div>
                    <div class="card-body">
                     <a href="{{route('Posts')}}" type="button" class="btn btn-primary" > Détails</a>
                    </div>
                  </div>
                  <div class="card text-white bg-black m-3 col-5" style="max-width: 18rem;">
                    <div class="card-header">Total Comments <span class="badge bg-secondary">({{ count ($comments)}})</span>  </div>
                    <div class="card-body">
                     <a href="{{ route ('touscomments')}}" type="button" class="btn btn-primary" > Détails</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
