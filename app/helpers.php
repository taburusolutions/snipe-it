<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function ParseFloat($floatString){

    // use comma for thousands until local info is property used
    $LocaleInfo = localeconv();
    //$thousands = isset($LocaleInfo["mon_thousands_sep"]) ? $LocaleInfo["mon_thousands_sep"] : ",";
    //$floatString = str_replace($LocaleInfo["mon_thousands_sep"] , "", $floatString);
    //$floatString = str_replace($LocaleInfo["decimal_point"] , ".", $floatString);
    $floatString = str_replace("," , "", $floatString);
    $floatString = str_replace($LocaleInfo["decimal_point"] , ".", $floatString);
    return floatval($floatString);
}

function modelList() {
    $model_list = array('' => Lang::get('general.select_model')) + DB::table('models')
    ->select(DB::raw('COALESCE(concat(name, " / ",modelno),name) as name, id'))->orderBy('name', 'asc')
    ->orderBy('modelno', 'asc')
    ->whereNull('deleted_at')
    ->lists('name', 'id');
    return $model_list;
}

function categoryList() {
    $category_list = array('' => '') + DB::table('categories')->whereNull('deleted_at')->lists('name', 'id');
    return $category_list;
}

function suppliersList() {
    $supplier_list = array('' => Lang::get('general.select_supplier')) + Supplier::orderBy('name', 'asc')->lists('name', 'id');
    return $supplier_list;
}

function assignedToList() {
    $assigned_to = array('' => Lang::get('general.select_user')) + DB::table('users')->select(DB::raw('concat(first_name," ",last_name) as full_name, id'))->whereNull('deleted_at')->lists('full_name', 'id');
    return $assigned_to;
}

function statusLabelList() {
    $statuslabel_list = Statuslabel::lists('name', 'id');
    return $statuslabel_list;
}

function locationsList() {
    $location_list = array('' => Lang::get('general.select_location')) + Location::lists('name', 'id');
    return $location_list;
}

function manufacturerList() {
    $manufacturer_list = array('' => 'Select One') + Manufacturer::lists('name', 'id');
    return $manufacturer_list;
}