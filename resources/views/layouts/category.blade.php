<select class="form-control" id="category" name="id" onchange="categoryChange(this)">
        <option value="0">選択</option> 
    <?php foreach($category as $s){?>
        <option value="{{$s->id}}" {{Request::get('category') == $s->id ? 'selected' : ''}}>{{$s->cat_name}}</option>
    <?php } ?>
</select>
