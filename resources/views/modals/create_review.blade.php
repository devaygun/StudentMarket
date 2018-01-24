<div id="reviewModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Write Review</h4>
            </div>
            <form method="POST" action="/view/1/reviews" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                    <label class="control-label rating-title">Rating</label>
                    <div class="form-group star-rating-form">
                        <input type="radio" class="form-control" id="star5" value="5" name="rating" required="required">
                        <label for="star5" class="control-label" title="Excellent - 5 Stars"></label>

                        <input type="radio" class="form-control" id="star4" value="4" name="rating" >
                        <label for="star4" class="control-label" title="Good - 4 Stars"></label>

                        <input type="radio" class="form-control" id="star3" value="3" name="rating" >
                        <label for="star3" class="control-label" title="Okay - 3 Stars"></label>

                        <input type="radio" class="form-control" id="star2" value="2" name="rating" >
                        <label for="star2" class="control-label" title="Poor - 2 Stars"></label>

                        <input type="radio" class="form-control" id="star1" value="1" name="rating" >
                        <label for="star1" class="control-label" title="Terrible - 1 Star"></label>
                    </div>
                    <div class="form-group">
                        <label for="review" class="control-label review-title">Review</label>
                        <textarea class="form-control" name="review" rows="4" id="review" style="max-height: 500px; max-width: 100%; min-height: 90px" required></textarea>
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

<style>

    .rating-title,
    .review-title{
        display: block;
        float: left;
        clear: both;
    }

    .star-rating-form {
        width: auto;
        float: left;
        clear: none;
        padding-left: 30px;
    }

    .star-rating-form input {
        height: 0 !important;
        width: 0 !important;
        position: absolute;
        z-index: -1;
    }

    .star-rating-form label {
        float: right;
    }

    .star-rating-form label:before {
        display: inline;
        width: auto;
        margin-right: 5px;
        content: "\f005";
        font: normal normal normal 14px/1 FontAwesome;
    }

    .star-rating-form input:hover ~ label:before {
        color: orange;
        cursor: pointer;
    }

    .star-rating-form input:checked ~ label:before {
        color: orange;
    }

    .star-rating-form > input:checked ~ label:hover:before,
    .star-rating-form > input:checked ~ label:hover ~label:before {
        color: #ffc966;
    }

</style>