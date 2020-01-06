<?php
                                
$count = 1;
foreach ($list as $record) {?>
<tr class="odd gradeX">

<td data-id="{{$record->id}}">{{$count++}}</td>
<td> {{$record->name}} </td>
<td> {{$record->email}} </td>
<td> {{$record->fee_after_vat}} </td>
<td> {{$record->discount_amount}} </td>
<td> {{$record->paid_amount}} </td>
<td> {{$record->due_amount}} </td>
<td><div class="dropdown show">
        <a class="btn btn-secondary green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Actions
          <i class="fa fa-angle-down"></i>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li>
            <a href="{{admin_url("edu-anannt/customer/")}}/{{$record->id}}/edit">
            <i class="icon-pencil"></i> Edit </a>
        </li>
        
        <li>
            <a href="{{admin_url('edu-anannt/invoice/create')}}/{{$record->id}}">
            <i class="icon-plus"></i> Add Invoice </a>
        </li>
        <li>
            <a href="{{admin_url('edu-anannt/invoice/view-all/')}}/{{$record->id}}">
            <i class="icon-eye"></i> View All Invoice </a>
        </li>
        <li><a href="javascript:{}" onclick="document.getElementById('my_form{{$record->id}}').submit();">
        <i class="icon-trash"></i> Delete </a></li>
        <form action="{{admin_url("edu-anannt/customer/")}}/{{$record->id}}" method="post" id="my_form{{$record->id}}">
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
<td colspan="8" align="center">
{{ $list->links()}}
</td>
</tr>
@else
<tr>
<td colspan="8" style="text-align:left;padding-left:20px;">
    <h4>No Results Found</h4>
</td>
</tr>

@endif