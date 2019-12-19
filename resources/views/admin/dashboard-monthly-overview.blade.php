<?php
$fmt = new NumberFormatter($locale = 'en_IN', NumberFormatter::DECIMAL);
if($list && $total != 0){
$count = 1;
foreach ($list as $record) {
    $courses_name = [];
    if(!$record->course_name){
      
       foreach($course as $item){
           if($item->fk_customer_id == $record->id){
            $courses_name[] = $item->course_name;
           }
       }
       $course_opted = implode(',',$courses_name);
    }
    
    ?>

<tr>
<td data-id="{{$record->id}}">{{$count++}}</td>
<td> {{$record->name}} </td>
<td> {{$record->invoice_no}} </td>
@if($record->course_name)
<td> {{$record->course_name}} </td>
@else
<td> {{$course_opted}} </td>
@endif
<td> {{$record->paid_amount}} </td>
</tr>
<?php }
?>
<tr>
<td colspan="4" align="center">
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
<td colspan="5" style="text-align:left;padding-left:20px;">
    <h4>No Results Found</h4>
</td>
</tr>
@endif