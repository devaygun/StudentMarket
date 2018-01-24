<div id="messageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Message {{$item->user->first_name}}</h4>
            </div>
            <form method="POST" action="/messages/{{$item->user_id}}" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                    <div class="form-group">
                        <label for="message" class="control-label">Max characters: 1000</label>
                        <textarea class="form-control" name="message" rows="2" id="message" style="max-width: 100%; max-height: 400px; resize: vertical; min-height: 100px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: left;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>