<script id="tmpl-phone" type="text/x-jquery-tmpl">
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
            <select class="form-control" name="number">
                <option value="mobile" >mobile</option>
                <option value="home" >home</option>
                <option value="fax">fax</option>
            </select>
        </div>
    </div>

    <div class="remove-item remove-phone d-none">
        <i class="fa fa-trash-alt"></i>
    </div>
</div>
</script>
