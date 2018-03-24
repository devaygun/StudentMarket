<div id="messageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                {{--CHECKS IF MODAL IS USED ON ITEM PAGE OR PROFILE PAGE--}}
                @if( ! empty($item))
                    <h4 class="modal-title">Message {{$item->user->first_name}}</h4>
                @else
                    <h4 class="modal-title">Message {{$viewUser->first_name}}</h4>
                @endif
            </div>
            {{--CHECKS IF MODAL IS USED ON ITEM PAGE OR PROFILE PAGE--}}
            @if( ! empty($item))
                <form method="POST" action="/messages/{{$item->user->id}}" enctype="multipart/form-data">
            @else
                <form method="POST" action="/messages/{{$viewUser->id}}" enctype="multipart/form-data">
            @endif
                <div class="modal-body">
                    {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                    <div class="form-group">
                        <label for="message" class="control-label">Characters remaining: <span id="charCount"></span></label>
                        <textarea class="form-control" name="message" oninput="validateMsg()" rows="2" id="message" minLength="1" maxlength="255" required style="max-width: 100%; max-height: 400px; resize: vertical; min-height: 100px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="msgSend" class="btn btn-success">Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: left;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--SCRIPT--}}
<script>

//    ON PAGE LOAD
    $( document ).ready(function() {
        validateMsg();
    });

//    CALLED WHEN MESSAGE BOX INPUT CHANGES
    function validateMsg() {
        getMessageCount();
//        disableSend();
    }

//    GETS REMAINING CHARACTERS AVAILABLE IN MESSAGE
    function getMessageCount() {
        var $msgBoxCount = 255 - $("#message").val().length;
        $("#charCount").text($msgBoxCount);
    }

//    DISABLES SEND BUTTON IF MESSAGE IS EMPTY
    function disableSend() {

        if (!$.trim($("#message").val())) {
            $("#msgSend").attr("disabled", "disabled");
        } else {
            $("#msgSend").removeAttr("disabled");
        }
    }

</script>