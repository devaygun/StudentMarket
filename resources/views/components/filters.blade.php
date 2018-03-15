<div class="row">
    <form action="/items" method="GET">
        <div class="col-sm-12">
            <div class="col-xs-12 col-sm-5">
                <div>Item type:</div>
                <label class="checkbox-inline"><input type="checkbox" name="item_type[sell]" value="sell" @if(array_key_exists("sell", $item_type)) checked @endif> <i class="fa fa-gbp fa-pad" aria-hidden="true"></i> Sell</label>

                <label class="checkbox-inline"><input type="checkbox" name="item_type[swap]" value="swap" @if(array_key_exists("swap", $item_type)) checked @endif> <i class="fa fa-exchange fa-pad" aria-hidden="true"></i> Swap</label>

                <label class="checkbox-inline"><input type="checkbox" name="item_type[part-exchange]" value="part-exchange" @if(array_key_exists("part-exchange", $item_type)) checked @endif> <i class="fa fa-gbp  fa-pad" aria-hidden="true"></i><span> + </span>
                    <i class="fa fa-exchange" aria-hidden="true"></i>  Part-Exchange</label>
            </div>
            <div class="col-xs-12 col-sm-5 form-group">
                <label for="sort" class="control-label">Sort by:</label>
                <select class="form-control" id="sort" name="sort">
                    <option value="created_at|DESC" @if($order_by[0] == "recent") selected @endif>Most recent first</option>
                    <option value="price|ASC" @if($order_by[0] == "price" && $order_by[1] == "ASC") selected @endif>Price (low to high)</option>
                    <option value="price|DESC" @if($order_by[0] == "price" && $order_by[1] == "DESC") selected @endif>Price (high to low)</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-2">
                <br>
                <button class="btn btn-primary pull-right" style="width: 100%;"><i class="fa fa-check"></i> Apply</button>
            </div>
        </div>
    </form>
</div>
<hr>