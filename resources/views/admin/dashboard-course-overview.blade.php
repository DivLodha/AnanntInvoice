<?php
$fmt = new NumberFormatter($locale = 'en_IN', NumberFormatter::DECIMAL);
if($list && $total != 0){
$count = 1;
foreach ($list as $record) 
{   
   ?>

<tr>
<td data-id="{{$record->id}}">{{$count++}}</td>
<td> {{$record->name}} </td>
<td> {{$record->invoice_no}} </td>
<td> {{$record->invoice_date}} </td>
<td> {{$record->course_name}} </td>
<td> {{$record->course_fee}} </td>
<td> {{$record->total_fee}} </td>
<td> {{$record->paid_amount}} </td>
</tr>
<?php }
?>
<tr>
<td colspan="7" align="center">
<strong>Total Revenue</strong>
</td>

<td>
{{$fmt->format($total)}}
</td>
</tr>
<?php
} ?>

@if($total == 0)
<tr>
<td colspan="8" style="text-align:left;padding-left:20px;">
    <h4>No Results Found</h4>
</td>
</tr>
@endif