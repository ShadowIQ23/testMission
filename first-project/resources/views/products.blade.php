@extends('vendor.backpack.base.inc.sidebar_content')
<?php
$results = DB::select('select * from categories');
$result = json_decode(json_encode($results), true);

$results1 = DB::select('select * from products');
$result1 = json_decode(json_encode($results1), true);
print_r($result1);
?>
<form action="addProduct" method="post">
    @csrf
    <select name="category_id">
        <?php foreach($result as $res){
            ?>
        <option value="<?php echo $res['id'] ?>"><?php echo $res['name'] ?></option>
        <?php
        } ?>
    </select>
    <input type="text" name="name">
    <input type="number" name="price" min="0">
    <button type="submit">Add</button>
</form>
