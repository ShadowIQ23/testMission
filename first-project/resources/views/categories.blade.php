@extends('vendor.backpack.base.inc.sidebar_content')
<?php
$results = DB::select('select * from categories');
$result = json_decode(json_encode($results), true);
print_r($result);
?>
<form action="addCategorie" method="post">
    @csrf
    <input type="text" name="name">
    <button type="submit">Add</button>
</form>
