<?php use App\Model\Country;
$countries = Country::orderBy('name')->get();
?>

<select name="country">
  @foreach ($countries as $country)
  @if ($country->name == $selected)
  <option value="{{$country->idcountry}}" selected>{{$country->name}}</option>
  @else
  <option value="{{$country->idcountry}}">{{$country->name}}</option>
  @endif
  @endforeach
</select>
