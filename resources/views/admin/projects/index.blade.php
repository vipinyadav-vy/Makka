@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S. No</th>
                    <th scope="col">Project Name</th>
                    
                </tr>
            </thead>
            <tbody>
                @if(count($projects) > 0)
                @php $i = 0; @endphp
                @foreach($projects as $projectsval)
                @php $i++; @endphp
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $projectsval->name }}</td>
                    
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
            {!! $projects->links() !!}
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
            url:"{{ route('status.update.user_project') }}",
            data:{id:id, status:status, _token: CSRF_TOKEN},
            success:function(data){
                if(data.success){
                    toastr.success(data.message, {
                        positionClass: 'toast-top-right',
                        iconClass:'toast-success',
                    });
                }
                else{
                    toastr.error(data.message, {
                        positionClass: 'toast-top-right',
                        iconClass:'toast-error',
                    });
                    //table.ajax.reload(null, false);
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
