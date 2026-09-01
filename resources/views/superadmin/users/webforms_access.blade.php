@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       <h4><strong>Report View Access</strong></h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S. No</th>
                    <th scope="col">Project</th>
                    <th scope="col">WebForm</th>
                    <th scope="col">View Report</th>
                </tr>
            </thead>
            <tbody>
                @if(count($webforms) > 0)
                @php $i = 0; @endphp
                @foreach($webforms as $webformsval)
                @php $i++; @endphp
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $webformsval->pname }}</td>
                    <td>{{ $webformsval->fname }}</td>
                    <td>
                        <div class="">
                            <label class="switch">
                                <input type="checkbox" {{ $webformsval->form_view == 1 ? 'checked' : '' }} id="is-attribute-chk" data-id="{{$webformsval->id}}">
                                <span class="slider round"></span>
                            </label>
                        </div>
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

               var form_view = '';
               if ($(this).is(':checked')) {form_view = 1;}
               else{ form_view = 0;}

               $.ajax({
                   type:'POST',
                   url:"{{ route('status.update.user.report') }}",
                   data:{id:id, form_view:form_view, _token: CSRF_TOKEN},
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