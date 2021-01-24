<div class="filter content-full" style="display: none;">
    <div class="separator-solid"></div>
    <h2>{!! trans('strings.filter_contacts') !!}</h2>
    <div class="row">

        <div class="form-group col-md-4">
            <label>{!! trans('strings.groups.name') !!}</label>
            {!! Form::select('group',$groups,null,['class'=>'select2 form-control group filter_value','id'=>'group']) !!}
        </div>
        <div class="form-group col-md-4">
            <label>{!! trans('strings.tags.name') !!}</label>
            {!! Form::select('tags[]',$tags,null,['class'=>'select2 multi form-control tags filter_value','id'=>'tags','multiple'=>'multiple']) !!}
        </div>
        <div class="form-group col-md-4">
            <label>{!! trans('strings.job_title') !!}</label>
            {!! Form::select('job',$jobs,null,['class'=>'select2 form-control job filter_value','id'=>'job']) !!}
        </div>
        <div class="form-group col-md-3">
            <label>{!! trans('strings.company') !!}</label>
            {!! Form::select('company',$companies,null,['class'=>'select2 form-control company filter_value','id'=>'company']) !!}
        </div>
        <div class="form-group col-md-3">
            <label>{!! trans('strings.location') !!}</label>
            {!! Form::select('location',$locations,null,['class'=>'select2 form-control filter_value  location','id'=>'location']) !!}
        </div>

        <div class="form-group col-md-3">
            <label>{!! trans('strings.favorite') !!}</label>
            {!! Form::select('favorite',['1'=> 'Yes'],null,['class'=>'select2 form-control filter_value  favorite','id'=>'favorite']) !!}
        </div>
        <div class="form-group col-md-3">
            <label>{!! trans('strings.country') !!}</label>
            {!! Form::select('country',$countries,null,['class'=>'select2 form-control filter_value  country','id'=>'country']) !!}
        </div>




    </div>
    <div class="pull-right">
        <button class="btn btn-danger form-button-action mt-2 clear" type="button">Clear
        </button>
        <button class="btn btn-primary form-button-action mt-2 filter_submit" type="button">
            Filter
        </button>
    </div>
</div>
