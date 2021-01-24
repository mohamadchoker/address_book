<script id="tmpl-address" type="text/x-jquery-tmpl">

<div class="row address">
 <div class="separator-solid"></div>
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
                <input type="text" autocomplete="off" class="form-control" name="street">
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

</script>
