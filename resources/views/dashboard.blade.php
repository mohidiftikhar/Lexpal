<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box rounded custom-box" style="padding: 26px; background-color: #0a58ca ">
                        <div class="inner">
                            <h3 style="color: white">{{$user}}</h3>

                            <p style="color:white">Users</p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box p-5 rounded" style="background-color: #2f264f">
                        <div class="inner">
                            <h3 style="color:white">{{$language}}</h3>

                            <p style="color:white">Language</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('languages.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box p-5 rounded" style="background-color: #3a2434">
                        <div class="inner">
                            <h3 style="color:white">{{$app_link}}</h3>

                            <p style="color:white">App Links</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('app_links.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box p-5 rounded" style="background-color: #2b3b4e">
                        <div class="inner">
                            <h3 style="color:white">{{$slider}}</h3>

                            <p style="color:white">Slider</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{route('sliders.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box p-5 rounded" style="background-color: navy">
                        <div class="inner">
                            <h3 style="color:white">{{$question}}</h3>

                            <p style="color:white">Questions</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{route('question.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box p-5 rounded" style="background-color: #621f26">
                        <div class="inner">
                            <h3 style="color: white">{{$product}}</h3>

                            <p style="color:white">Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('products.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box bg-dark p-5 rounded">
                        <div class="inner">
                            <h3 style="color:white">{{$CSV}}</h3>

                            <p style="color:white">CSV</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('csv.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box p-5 rounded" style="background-color: #0c4128">
                        <div class="inner">
                            <h3 style="color:white">{{$plan}}</h3>

                            <p style="color:white">Plans</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('plans.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box p-5 rounded" style="background-color: #0b0e18">
                        <div class="inner">
                            <h3 style="color:white">{{$navigation}}</h3>

                            <p style="color:white">Nav Items</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('navigation.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6 mt-5">
                    <!-- small box -->
                    <div class="small-box p-5 rounded" style="background-color: #003c5e">
                        <div class="inner">
                            <h3 style="color:white">{{$page}}</h3>

                            <p style="color:white">Pages</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{route('pages.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</x-app-layout>
