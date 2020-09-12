.@extends('layouts.dashboard')

@section('content')


    <div class="app-content content">
        {{-- <div class="content-overlay"></div> --}}
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Pending Products</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Products</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pending Products</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content-body">
                <!-- Statistics card section start -->
                <section id="statistics-card">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Products List</h4>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive mt-1">
                                <table class="table table-hover-animation mb-0">
                                    <thead>
                                    <tr>
                                        <th>PHOTO & ID</th>
                                        <th>TITLE</th>
                                        <th>STATUS</th>
                                        <th>CATEGORY</th>
                                        <th>PRICE</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                    </thead>
                                    @foreach($pendingProducts as $pendingProduct)
                                        <tbody>
                                        <tr>
                                            <td>#{{$pendingProduct->id}} - <img class="media-object rounded-circle" src="{{count($pendingProduct->images) > 0 ? $pendingProduct->images[0]->url : 'https://via.placeholder.com/150'}}" alt="Avatar" height="35" width="35"></td>
                                            <td>{{ \Illuminate\Support\Str::limit($pendingProduct -> title, 25, $end='...') }}</td>
                                            <td>
                                                @if($pendingProduct -> getStatus() == 'Pending')
                                                    <i class="fa fa-circle font-small-3 text-warning mr-50"></i>{{$pendingProduct -> getStatus()}}
                                                @else
                                                    <i class="fa fa-circle font-small-3 text-success mr-50"></i>{{$pendingProduct -> getStatus()}}
                                                @endif
                                            </td>
                                            <td >{{$pendingProduct->category->category_name}} </td>
                                            <td>{{$pendingProduct->price}} </td>

                                            <td>
                                                <div class="row" style="align-content: space-between">
                                                    <a class="todo-item-info primary" href=""><i class="feather icon-settings" style="padding: 8px"></i></a>
                                                    <a class="todo-item-favorite danger" href="{{route('admin.destroy' , $pendingProduct -> id)}}"><i class="feather icon-trash"  style="padding: 8px"></i></a>
                                                    <a class="todo-item-delete warning" href="{{route('admin.change-status' , $pendingProduct -> id)}}"><i class="feather icon-refresh-ccw"  style="padding: 8px"></i></a>


                                                </div>
                                            </td>


                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <ul class="pagination justify-content-center mt-2">
                        {{ $pendingProducts->links() }}
                    </ul>
                </section>
                <!-- // Statistics Card section end-->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


@endsection
