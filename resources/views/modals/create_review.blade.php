<div id="reviewModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sell Item</h4>
            </div>
            <form method="POST" action="/view/1/reviews" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                    <div class="form-group">
                        <label for="rating" class="control-label">Rating</label>
                        <input type="number" class="form-control" id="review" min="1" max="5" value="" name="rating" required>
                    </div>
                    <div class="form-group">
                        <label for="review" class="control-label">Review</label>
                        <textarea class="form-control" rows="4" id="review" style="max-height: 500px; max-width: 100%; min-height: 90px"></textarea>
                        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Review</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: left;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

