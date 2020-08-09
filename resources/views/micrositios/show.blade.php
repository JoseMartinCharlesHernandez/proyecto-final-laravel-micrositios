@extends('layouts.app')
@section('content')

<div class="card card-solid">
  <div class="text-center">
    <img src="{{$banner_url}}" class="rounded" alt="Responsive image">

  </div>
  <div class="card-body pb-0">
      <div class="row d-flex align-items-stretch">
        @foreach ($productos as $item)
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            <div class="card bg-light">
              <div class="card-header text-muted border-bottom-0">
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                  <h2 class="lead"><b>{{$item->nombre}}</b></h2>
                  </div>
                   <div class="col-7">
                   <h3>${{$item->precio}}</h3>   
                  </div> 
                  <div class="col-4 text-center">
                  <img src="{{$item->imagen_url}}" alt="" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                <a href="{{route('ventas.create',['id'=>$item->id])}}" class="btn btn-sm btn-warning">
                    <i class="fa fa-shopping-cart"></i> Comprar
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <nav aria-label="Contacts Page Navigation">
        <ul class="pagination justify-content-center m-0">
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">..</a></li>

        </ul>
      </nav>
    </div>
    <!-- /.card-footer -->
  </div>

@endsection