{{--WARNING MODAL FOR DELETE ITEM--}}
<!-- Modals -->
<div id="removeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure you want to remove this item?</h4>
            </div>
            <div class="modal-body">
                <label>This item will permanently be removed from Student Market</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                <form method="POST" action="/item/{{$item->id}}/remove">
                    {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                    <button type="submit" class="btn btn-danger" style="float:right">Remove item</button>
                </form>
            </div>
        </div>

    </div>
</div>