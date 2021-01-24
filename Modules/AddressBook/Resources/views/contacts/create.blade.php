@extends('layouts.app')
@section('title',trans('strings.contacts.create'))

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{!! trans('strings.contacts.name') !!}</h4>
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
                        <a href="#">{!! trans('strings.contacts.create') !!}</a>
                    </li>

                </ul>
            </div>
            @include('addressbook::shared.crop_modal')
            <form id="contact_store"   novalidate>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">{!! trans('strings.contacts.create') !!}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <h2>Basic info</h2>
                                <input type="hidden" id="avatar_img_name" name="avatar_img_name" value="">

                                <div class="d-flex align-content-center justify-content-center">
                                    <div class="">
                                        <div class="input-file input-file-image">
                                            <img class="img-upload-preview img-circle m10-auto" width="120" height="120" src="https://images.assetsdelivery.com/compings_v2/thesomeday123/thesomeday1231709/thesomeday123170900021.jpg" id="default_avatar"  alt="preview">
                                            <input type="file" class="form-control form-control-file" id="uploadImg" name="uploadImg" accept="image/*"                        onchange="initCropper('default_avatar','image','uploadImg','avatar_img_name');" >
                                            <label for="uploadImg" class="btn btn-primary btn-round btn-sm"><i class="fa fa-file-image"></i> Upload  Image</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('strings.first_name') !!} <span class="required-label">*</span></label>
                                            <input type="text" autocomplete="off" class="form-control" name="first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('strings.last_name') !!} <span class="required-label">*</span></label>
                                            <input type="text" autocomplete="off" class="form-control" name="last_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('auth.email') !!} <span class="required-label">*</span></label>
                                            <input type="email" autocomplete="off" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{!! trans('strings.birth_date') !!}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="birth_date" name="birth_date" autocomplete="off" >
                                                <div class="input-group-append">
														<span class="input-group-text">
															<i class="fa fa-calendar-check"></i>
														</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{!! trans('strings.gender') !!}   <span class="required-label">*</span></label>
                                            <div class="col-lg-4 col-md-9 col-sm-8 d-flex align-items-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="male" name="gender" class="custom-control-input" value="Male" required>
                                                    <label class="custom-control-label" for="male">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="female" value="Female" name="gender" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="female">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{!! trans('strings.location') !!} </label>
                                            <input type="text" autocomplete="off" class="form-control" name="location">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{!! trans('strings.job_title') !!} </label>
                                            <input type="text" autocomplete="off" class="form-control" name="job_title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{!! trans('strings.company') !!} </label>
                                            <input type="text" autocomplete="off" class="form-control" name="company">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label>{!! trans('strings.groups.name') !!}</label>
                                          {!! Form::select('group',$groups,null,['class'=>'select2 form-control group','id'=>'group']) !!}
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('strings.tags.name') !!}</label>
                                            {!! Form::select('tags[]',$tags,null,['class'=>'select2 multi form-control tags','id'=>'tags','multiple'=>'multiple']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="separator-solid"></div>
                                <h2>Phone numbers</h2>
                                <div class="position-relative">
                                    <div class="phones" id="phones">
                                        <div class="row phone">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>{!! trans('strings.contacts.table.phone_number') !!} <span class="required-label">*</span></label>
                                                    <input type="tel" class="form-control" name="number" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <select class="form-control" name="type">
                                                        <option>mobile</option>
                                                        <option>home</option>
                                                        <option>fax</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="remove-item remove-phone d-none">
                                                <i class="fa fa-trash-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-item add-phone">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                </div>

                                <div class="separator-solid"></div>
                                <h2>Addresses</h2>
                                <div class="position-relative">
                                    <div class="addresses" id="addresses">
                                        <div class="row address">
                                            <div class="row col-md-10">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{!! trans('strings.title') !!} <span class="required-label">*</span></label>
                                                        <input type="text" autocomplete="off" class="form-control" name="title" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{!! trans('strings.line_1') !!} <span class="required-label">*</span></label>
                                                        <input type="text" autocomplete="off" class="form-control" name="line1" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{!! trans('strings.line_2') !!} </label>
                                                        <input type="text" autocomplete="off" class="form-control" name="line2">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{!! trans('strings.state') !!} </label>
                                                        <input type="text" autocomplete="off" class="form-control" name="state">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{!! trans('strings.city') !!} <span class="required-label">*</span></label>
                                                        <input type="text" autocomplete="off" class="form-control" name="city" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{!! trans('strings.street') !!} </label>
                                                        <input type="text" autocomplete="off" class="form-control" name="street">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{!! trans('strings.zip') !!} </label>
                                                        <input type="text" autocomplete="off" class="form-control" name="zip">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{!! trans('strings.country') !!} <span class="required-label">*</span></label>
                                                        <div class="select2-input">
                                                            {{ Form::select('country', $countries, null, array('id'=>'country','name'=>'country', 'class' => 'select2 form-control','required'=>'true')) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-md-2 align-content-center">

                                                <div class="remove-item remove-address d-none">
                                                    <i class="fa fa-trash-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-item add-address">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                </div>

                                <div class="separator-solid"></div>
                                <h2>Social</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('strings.facebook') !!} </label>
                                            <div class="input-group">
                                                <div class="input-group-append">
														<span class="input-group-text">
															<i class="fab fa-facebook"></i>
														</span>
                                                </div>
                                                <input type="url" class="form-control" name="facebook_link" id="facebook_link">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('strings.twitter') !!} </label>
                                            <div class="input-group">
                                                <div class="input-group-append">
														<span class="input-group-text">
															<i class="fab fa-twitter"></i>
														</span>
                                                </div>
                                                <input type="url" class="form-control" name="twitter_link" id="twitter_link">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('strings.linkedin') !!} </label>
                                            <div class="input-group">
                                                <div class="input-group-append">
														<span class="input-group-text">
															<i class="fab fa-linkedin"></i>
														</span>
                                                </div>
                                                <input type="url" class="form-control" name="linkedin_link" id="linkedin_link">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('strings.instagram') !!} </label>
                                            <div class="input-group">
                                                <div class="input-group-append">
														<span class="input-group-text">
															<i class="fab fa-instagram"></i>
														</span>
                                                </div>
                                                <input type="url" class="form-control" name="instagram_link" id="instagram_link">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action text-right">
                                <button class="btn btn-success" id="btn-client-submit" type="submit">Submit</button>
                                <button class="btn btn-danger" type="button"
                                        onclick="window.location.href='{{url('contacts')}}'">Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page-js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.full.min.js"
            integrity="sha256-vdvhzhuTbMnLjFRpvffXpAW9APHVEMhWbpeQ7qRrhoE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"
            integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
            integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
    <script src="https://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
    <script src="{{url('js/vendor/noitify.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.min.js"></script>
@endsection
@section('custom-js')
    @include('addressbook::tmpl.phone')
    @include('addressbook::tmpl.address')
    <script>
        var contactCreate = new ContactCreate('create');
        contactCreate.init()
    </script>
@endsection
