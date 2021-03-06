<div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <span class="fw-mediumbold">{!! trans('strings.groups.edit') !!}</span>

                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="editGroupForm"   novalidate>
                <div class="modal-body">

                    <input type="hidden" id="group_id" name="group_id" >
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>{!! trans('strings.name') !!}</label>
                                <input id="editName" type="text" name="name"
                                       class="form-control"
                                       autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>{!! trans('strings.description') !!}</label>
                                <textarea class="form-control"  name="description" id="editDescription"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="addRowButton" class="btn btn-primary">Update
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
