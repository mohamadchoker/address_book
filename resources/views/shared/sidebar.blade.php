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
                    <img src="{{url('avatar?name='.auth()->user()->name.'')}}" alt="..."
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

                <li class="nav-item  submenu  <?= ($path == 'contacts' || $path == 'groups' || $path == 'tags') ? 'active' : ''; ?> ">
                    <a data-toggle="collapse" href="#address_book">
                        <i class="fas fa-address-book"></i>
                        <p>{!! trans('strings.address_book') !!}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse  <?= (strpos($current_params,
                            'ContactsController@index') || strpos($current_params,
                            'GroupsController@index') || strpos($current_params,
                            'TagsController@index')) ? 'show' : ''; ?>  "
                         id="address_book">

                        <ul class="nav nav-collapse">
                            <li class=" <?= (strpos($current_params, 'ContactsController@index')) ? 'active' : ''; ?> ">
                                <a href="{{url('contacts')}}">
                                    <span class="sub-item">{!! trans('strings.contacts.list') !!}</span>
                                </a>
                            </li>
                            <li class=" <?= (strpos($current_params,
                                'GroupsController@index')) ? 'active' : ''; ?> ">
                                <a href="{{url('groups')}}">
                                    <span class="sub-item">{!! trans('strings.groups.list') !!}</span>
                                </a>
                            </li>

                            <li class=" <?= (strpos($current_params,
                                'TagsController@index')) ? 'active' : ''; ?> ">
                                <a href="{{url('tags')}}">
                                    <span class="sub-item">{!! trans('strings.tags.list') !!}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

