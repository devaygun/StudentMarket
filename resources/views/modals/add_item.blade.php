<div id="sellModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sell Item</h4>
            </div>
            <form method="POST" action="/items/add" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" value="" name="name" minlength="2" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" value="" name="description" minlength="2" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="select" >Select a category</label>
                        <select class="form-control" id="select" name="category_id">
                            @foreach (\App\Category::all() as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="display: inline-block">
                        <label class="radio-inline"><input onchange="createCheckedSellType()" value="sell" type="radio" name="type" checked>Sell</label>
                    </div>
                    <div class="form-group" style="display: inline-block">
                        <label class="radio-inline"><input onchange="createCheckedSwapType()" value="swap" type="radio" name="type">Swap</label>
                    </div>
                    <div class="form-group" style="display: inline-block">
                        <label class="radio-inline"><input onchange="createCheckedPEType()" value="part-exchange" type="radio" name="type">Part-Exchange</label>
                    </div>

                    <div id="modalCreatePriceForm" class="form-group" style="display: none">
                        <label for="price">Price (£)</label>
                        <input type="number" class="form-control" id="modalCreatePrice" min="1" max="100000" value="" name="price" required>
                    </div>
                    <div id="modalCreateSwapForm" class="form-group" style="display: none">
                        <label for="trade">Swap for</label>
                        <input type="text" class="form-control" id="modalCreateSwap" min="1" max="255" value="" name="trade">
                    </div>

                    <div class="form-group">
                        <label for="images">Select Images</label>
                        <p>Press <kbd>Ctrl</kbd> or <kbd>command ⌘</kbd> to select multiple images.</p>
                        <input type="file" accept="image/*" class="form-control" id="images" value="{{old('images')}}" name="images[]" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add item</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: left;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                </div>
            </form>


            <!-- Script -->
            <script>

                window.onload = function() {
                    createCheckedSellType();
                }

                function createCheckedSellType() {
                    document.getElementById('modalCreatePriceForm').style.display = "block";
                    document.getElementById('modalCreatePrice').required = true;
                    document.getElementById('modalCreateSwap').value = "";
                    document.getElementById('modalCreateSwap').required = false;
                    document.getElementById('modalCreateSwapForm').style.display = "none";
                }
                function createCheckedSwapType() {
                    document.getElementById('modalCreatePrice').value = "";
                    document.getElementById('modalCreatePrice').required = false;
                    document.getElementById('modalCreatePriceForm').style.display = "none";
                    document.getElementById('modalCreateSwap').value = "";
                    document.getElementById('modalCreateSwap').required = true;
                    document.getElementById('modalCreateSwapForm').style.display = "block";
                }
                function createCheckedPEType() {
                    document.getElementById('modalCreatePriceForm').style.display = "block";
                    document.getElementById('modalCreatePrice').required = true;
                    document.getElementById('modalCreateSwap').value = "";
                    document.getElementById('modalCreateSwap').required = true;
                    document.getElementById('modalCreateSwapForm').style.display = "block";
                }
            </script>
        </div>
    </div>
</div>