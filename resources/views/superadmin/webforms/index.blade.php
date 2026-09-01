@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       WebForm List
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S. No</th>
                    <th scope="col">Form Title</th>
                    <th scope="col">To Mail</th>
                    <th scope="col">CC Mail</th>
                    <th scope="col">Status </th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($webforms) > 0)
                @php $i = 0; @endphp
                @foreach($webforms as $webformsval)
                @php $i++; @endphp
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $webformsval->title }}</td>
                    <td>{{ $webformsval->toMail }}</td>
                    <td>{{ $webformsval->ccMail != Null ? $webformsval->ccMail : "NA" }}</td>
                    <td>
                        <div class="">
                            <label class="switch">
                                <input type="checkbox" <?php if($webformsval->status == 1){ echo "checked"; } ?>  id="is-attribute-chk" data-id="{{ $webformsval->id }}">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                    <td><a class="btn btn-sm  btn-success my-1" href="{{ route('webforms.edit', $webformsval->id) }}" title="Edit"><i class="fa fa-gear"></i></a>
                    <?php if($webformsval->id == 10){ ?>
                    <a class="btn btn-sm  btn-success my-1" href="{{ route('supplierContractorEvaluation') }}" target="_blank" title="Share"><i class="fa fa-share"></i></a>
                    <?php } ?>
                    <?php if($webformsval->id == 12){ ?>
                    <a class="btn btn-sm  btn-success my-1" href="{{ route('preStartChecklist') }}" target="_blank" title="Share"><i class="fa fa-share"></i></a>
                    <?php } ?>
                    
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td style="text-align: center;" colspan="4">No Record Found</td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $webforms->links() !!}
        </div>
    </div>
</div>
<input type="hidden"  id="csrf_token" value="{{ csrf_token() }}">

<script type="text/javascript">
   $(document).on('click','#is-attribute-chk', function(){
               var id =  $(this).attr('data-id');
               var CSRF_TOKEN = $('#csrf_token').val();
               var status = '';
               if ($(this).is(':checked')) {status = 1;}
               else{ status = 0;}
               $.ajax({
                   type:'POST',
                   url:"{{ route('webformUpdate') }}",
                   data:{id:id, status:status, _token: CSRF_TOKEN},
                   success:function(data){
                       if(data.success){
                           toastr.success(data.message,{
                           positionClass: 'toast-top-right',
                           iconClass:'toast-success',
                           });
                       }
                       else{
                           toastr.error(data.message,{
                           positionClass: 'toast-top-right',
                           iconClass:'toast-error',
                           });
                           table.ajax.reload(null, false);
                       }
                   },
                   error : function(err){
                       toastr.error(data.message,{
                           positionClass: 'toast-top-center',
                           iconClass:'toast-error',
                       });
                   }
               });
           });
</script>
@endsection
    
    


