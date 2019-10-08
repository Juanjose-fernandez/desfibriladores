<div class="modal {{$modal_id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-xs-10">
                <h5 class="modal-title">{{$title}}</h5>
                </div>
                <div class="col-xd-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            </div>
            <div class="modal-body" style="height: fit-content;">
                {{$slot}}
            </div>
            @if(isset($footer))
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            @endif
        </div>
    </div>
</div>
