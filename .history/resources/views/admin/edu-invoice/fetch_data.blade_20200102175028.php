<?php
                                
$count = 1;
foreach ($list as $record) 
{
$email = $customer->where('id',$record->fk_customer_id)->first()->email;
$name = $customer->where('id',$record->fk_customer_id)->first()->name;
?>
<tr class="odd gradeX">
    
    <td data-id="{{$record->id}}">{{$count++}}</td>
    <td> {{$record->invoice_no}} </td>
    <td> {{$name}} </td>
    <td> {{$email}} </td>
    <td> {{$record->paid_amount}} </td>
    @if($record->vat_amount)
    <td> {{$record->vat_amount}} </td>
    @else
    <td> NO VAT </td>
    @endif
    <td><div class="dropdown show">
            <a class="btn btn-secondary green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Actions
              <i class="fa fa-angle-down"></i>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li>
                <a href="{{admin_url("invoice/")}}/{{$record->id}}/edit">
                <i class="icon-pencil"></i> Edit </a>
            </li>
            <li>
              <a href="{{admin_url("invoice/pdf/")}}/{{$record->invoice_no}}" target="_blank">
                <i class="icon-eye"></i> Generate Invoice PDF </a>
          </li>
            
            <!-- <li><a href="javascript:{}" onclick="document.getElementById('my_form{{$record->id}}').submit();">
            <i class="icon-trash"></i> Delete </a></li> -->
            <form action="{{admin_url("customer/")}}/{{$record->id}}" method="post" id="my_form{{$record->id}}">
                {!! method_field('delete') !!}
                {!! csrf_field() !!}    
              </form>
            </div>
          </div>
    </td>
</tr>
<?php } ?>

@if(count($list))
<tr>
<td colspan="7" align="center">
{{ $list->links()}}
</td>
</tr>
@else
<tr>
<td colspan="7" style="text-align:left;padding-left:20px;">
    <h4>No Results Found</h4>
</td>
</tr>

@endif