@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       User List
      <a class="btn btn-primary float-right"  href="{{ route('users.create') }}">
        Add User
      </a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S. No</th>
                    <th scope="col">User Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Status</th>
                    <th scope="col" width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($users) > 0)
                @php $i = 0; @endphp
                @foreach($users as $usersval)
                @php $i++; @endphp
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $usersval->user_name }}</td>
                    <td>{{ $usersval->email }}</td>
                    <td>
                        <div class="">
                            <label class="switch">
                                <input type="checkbox" {{ $usersval->status == 1 ? 'checked' : '' }} id="is-attribute-chk" data-id="{{$usersval->id}}">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-sm  btn-success my-1" href="{{ route('users.edit', $usersval->id) }}" title="Edit"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-sm  btn-success my-1" href="{{ route('get_user_form_access', $usersval->id) }}" title="Form Access"><i class="fas fa-eye"></i></a>
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
            {!! $users->links() !!}
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
                   url:"{{ route('status.update.user') }}",
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

