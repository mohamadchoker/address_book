<?php
$current_params = Route::currentRouteAction();
$path = \Illuminate\Support\Facades\Request::segment(1);

?>
<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="https://images.assetsdelivery.com/compings_v2/thesomeday123/thesomeday1231709/thesomeday123170900021.jpg" alt="..."
                         class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
									<span>
										{!! auth()->user()->name !!}

									</span>
                    </a>
                    <div class="clearfix"></div>

                </div>
            </div>
            <ul class="nav nav-primary">


            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

