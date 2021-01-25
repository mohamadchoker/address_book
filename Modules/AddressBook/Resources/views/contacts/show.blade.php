@extends('layouts.app')
@section('title', $contact->full_name)

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{!! $contact->full_name !!}</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{url('/')}}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('contacts')}}">{!! trans('strings.contacts.name') !!}</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">{!! trans('strings.contacts.view') !!}</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-with-nav">
                        <div class="card-header">
                            <div class="row row-nav-line">
                                <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                                                            href="#basic_info" role="tab"
                                                            aria-selected="true">{!! trans('strings.contacts.basic_info') !!}</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#phones" role="tab"
                                                            aria-selected="false">{!! trans('strings.contacts.phones') !!}</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#addresses"
                                                            role="tab"
                                                            aria-selected="false">{!! trans('strings.contacts.addresses') !!}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content mt-2 mb-3" id="">
                                <div class="tab-pane fade active show" id="basic_info" role="tabpanel"
                                     aria-labelledby="basic_info">
                                   <div class="container">
                                       <div class="row mb-5">
                                           <div class="col-md-4">
                                               <div class="fw-bold mr-2">
                                                   {!! trans('strings.location') !!}
                                               </div>
                                               <span>{!! $contact->location !!}</span>
                                           </div>
                                           <div class="col-md-4">
                                               <div class="fw-bold mr-2">
                                                   {!! trans('strings.company') !!}
                                               </div>
                                               <span>{!! $contact->company !!}</span>
                                           </div>
                                           <div class="col-md-4">
                                               <div class="fw-bold mr-2">
                                                   {!! trans('strings.job_title') !!}
                                               </div>
                                               <span>{!! $contact->job_title !!}</span>
                                           </div>
                                       </div>
                                       <div class="row mb-5">
                                           <div class="col-md-4">
                                               <div class="fw-bold mr-2">
                                                   {!! trans('strings.birth_date') !!}
                                               </div>
                                               <span>{!! $contact->birth_date !!}</span>
                                           </div>
                                           <div class="col-md-4">
                                               <div class="fw-bold mr-2">
                                                   {!! trans('strings.gender') !!}
                                               </div>
                                               <span>{!! $contact->gender !!}</span>
                                           </div>
                                           @if(!is_null($contact->group_id))
                                           <div class="col-md-3">
                                               <div class="fw-bold mr-2">
                                                   {!! trans('strings.group') !!}
                                               </div>
                                               <span>{!! $contact->group->name !!}</span>
                                           </div>
                                           @endif
                                       </div>
                                       @if(count($contact->tags) > 0)
                                           <div class="row">
                                               <div class="col-md-4">
                                                   <div class="fw-bold mr-2 mb-2">
                                                       {!! trans('strings.tags.name') !!}
                                                   </div>
                                                   @foreach($contact->tags as $tag)
                                                       <span class="badge badge-count fw-bold">{!! $tag->tag->name !!}</span>
                                                   @endforeach
                                               </div>
                                           </div>
                                       @endif
                                   </div>
                                </div>


                                <div class="tab-pane fade " id="phones" role="tabpanel"
                                     aria-labelledby="phones">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Number</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($contact->phones as $phone)
                                            <tr>
                                                <td>{{ $phone->number }}</td>
                                                <td>{{ $phone->type }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a class="btn btn-md btn-link" href="tel:{!! $phone->number !!}"><span class="btn-label just-icon"><i class="icon-phone"></i> </span> </a>
                                                          @if($phone->type == 'mobile')
                                                            <a class="btn btn-success btn-md btn-link" href="https://wa.me/{!! $phone->number !!}" target="_blank"><span class="btn-label just-icon"><i class="flaticon-whatsapp"></i> </span> </a>
                                                          @endif
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <div class="tab-pane fade " id="addresses" role="tabpanel"
                                     aria-labelledby="addresses">
                                    <table class="table table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th scope="col">{!! trans('strings.title') !!}</th>
                                            <th scope="col">{!! trans('strings.line_1') !!}</th>
                                            <th scope="col">{!! trans('strings.line_2') !!}</th>
                                            <th scope="col">{!! trans('strings.state') !!}</th>
                                            <th scope="col">{!! trans('strings.city') !!}</th>
                                            <th scope="col">{!! trans('strings.street') !!}</th>
                                            <th scope="col">{!! trans('strings.zip') !!}</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($contact->addresses as $address)
                                            <tr>
                                                <td>{!! $address->title !!}</td>
                                                <td>{!! $address->line1 !!}</td>
                                                <td>{!! $address->line2 !!}</td>
                                                <td>{!! $address->state !!}</td>
                                                <td>{!! $address->city !!}</td>
                                                <td>{!! $address->street !!}</td>
                                                <td>{!! $address->zip !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    <img src="{{(!is_null($contact->photo)) ? Storage::url($contact->photo) : url('avatar?name='.$contact->full_name.'')}}"
                                         alt="..." class="avatar-img rounded-circle">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">{!! $contact->full_name !!}</div>
                                <div class="job"><a href="mailto:{!! $contact->email !!}">{!! $contact->email !!}</a></div>
                                <div class="job">{!! $contact->job_title !!}</div>
                                <div class="social-media">
                                    @if(!is_null($contact->twitter_link))
                                        <a class="btn btn-info btn-twitter btn-sm btn-link"
                                           href="{{$contact->twitter_link}}" target="_blank">
                                            <span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
                                        </a>
                                    @endif
                                    @if(!is_null($contact->facebook_link))
                                        <a class="btn btn-primary btn-sm btn-link" href="{{$contact->facebook_link}}"
                                           target="_blank">
                                            <span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
                                        </a>
                                    @endif
                                    @if(!is_null($contact->instagram_link))
                                        <a class="btn btn-danger btn-sm btn-link" href="{{$contact->instagram_link}}"
                                           target="_blank">
                                            <span class="btn-label just-icon"><i class="flaticon-instagram"></i> </span>
                                        </a>
                                    @endif
                                    @if(!is_null($contact->linkedin_link))
                                        <a class="btn btn-primary btn-sm btn-link" href="{{$contact->linkedin_link}}"
                                           target="_blank">
                                            <span class="btn-label just-icon"><i class="flaticon-linkedin"></i> </span>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
