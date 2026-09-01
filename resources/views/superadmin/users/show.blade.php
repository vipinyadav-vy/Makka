@extends('layouts.admin')
@section('content')
<div class="card">

<ul class="nav nav-tabs new-tab-set" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Admin Profile</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Shopping Center</a>
	</li>
   <li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Cleaners</a>
	</li>
   <li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Questions</a>
	</li>
</ul><!-- Tab panes -->
<div class="tab-content new-content-set">
	<div class="tab-pane active" id="tabs-1" role="tabpanel">
		<p><div class="card">
         <div class="card-header">
            Admin Profile
         </div>
         <div class="card-body">
            <table cellpadding="6" cellspacing="0">
               <tbody>
                  <tr>
                     <td>Name</td>
                     <td>:</td>
                     <td>{{$userData->user_name}}</td>
                  </tr>
                  <tr>
                     <td>E-mail</td>
                     <td>:</td>
                     <td>{{$userData->email}}</td>
                  </tr>
                  <tr>
                     <td>Contact No</td>
                     <td>:</td>
                     <td>{{$userData->mobile}}</td>
                  </tr>
                  <tr>
                     <td>Address</td>
                     <td>:</td>
                     <td>{{$userData->address}}</td>
                  </tr>
   
               </tbody>
            </table>
         </div>
     </div>
   </p>
	</div>
	<div class="tab-pane" id="tabs-3" role="tabpanel">
		<p>
         <div class="card">
            <div class="card-header">
               Sopping Centre List
            </div>
            <div class="card-body">
                <table  id="example_user_soping" class=" table table-bordered table-striped table-hover  datatable ">
                    <thead class="thead-dark">
                        <tr class="text-center">                  
                            <th>
                               Name
                            </th>
                            <th>
                              E-mail
                           </th> 
                            <th>
                               Contact Number
                            </th> 
                            <th>
                              Cleaner Login QR
   
                              </th> 
                              <th>
                                 Issue Report QR
                              </th> 
                            
                           <th>
                              Created Date
                         </th> 
                        </tr>
                    </thead>
                    <tbody id="customer">
                     @foreach ($shopingCenter as $key => $shoping)
                     <tr class="new-text-left">
                        <td>{{$shoping->user_name}}</td>
                        <td>{{$shoping->email}}</td>
                        <td>{{$shoping->mobile}}</td>
                        <td>
                           @php $loginQr =  "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".urlencode(url('shoppingCentre/api/scanQrLogin?shoppingid=').$shoping->id."&latitude=".$shoping->latitude."&longitude=".$shoping->longitude."&login=".$shoping->created_by."&choe=UTF-8");
@endphp
                           <div class="text-center" ><img style="width: 60px; height: 60px;" src="{{$loginQr}}" title="Link to Google.com" class="addd" /></div>
                           </td>
                           <td>
                              @php $issue_cleaner =  "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".urlencode(url('issue-report?shoppingid=').$shoping->id."&login=".$shoping->created_by."&choe=UTF-8");
   @endphp
                              <div class="text-center" ><img style="width: 60px; height: 60px;" src="{{$issue_cleaner}}" title="Link to Google.com" class="addd" /></div>
                              </td>
                        <td>{{$shoping->created_at}}</td>
                     </tr>
                     @endforeach
                  </tbody>
                </table>
            </div>
        </div>
      </p>
	</div>
   <div class="tab-pane" id="tabs-4" role="tabpanel">
		<p>
         <div class="card">
            <div class="card-header">
               Cleaner Company List
            </div>
            <div class="card-body">
                <table id="example_user_cleaner"  class=" table table-bordered table-striped table-hover  datatable ">
                  <thead class="thead-dark">
                     <tr class="text-center">                  
                         <th>
                            Name
                         </th>
                         <th>
                           E-mail
                        </th> 
                         <th>
                            Contact Number
                         </th> 
                        
                        <th>
                           Created Date
                      </th> 
                     </tr>
                 </thead>
                 <tbody id="customer">
                  @foreach ($cleanerUser as $key => $cleaner)
                  <tr class="new-text-left">
                     <td>{{$cleaner->user_name}}</td>
                     <td>{{$cleaner->email}}</td>
                     <td>{{$cleaner->mobile}}</td>
                     <td>{{$cleaner->created_at}}</td>
                  </tr>
                  @endforeach
               </tbody>
                </table>
            </div>
        </div>
      </p>
	</div>
   <div class="tab-pane" id="tabs-5" role="tabpanel">
		<p>
         <div class="card">
            <div class="card-header">
               Questions List
            </div>
            <div class="card-body">
                <table id="example_user_questions"  class=" table table-bordered table-striped table-hover  datatable ">
                    <thead class="thead-dark">
                        <tr class="text-center">                  
                            <th>
                              Questions

                            </th>
                            <th>
                              Questions ID

                           </th> 
                            <th>
                              Created Date
                            </th> 
                        </tr>
                    </thead>
                    <tbody id="customer">
                     @foreach ($questions as $key => $questionval)
                     <tr class="new-text-left">
                        <td>{{$questionval->name}}</td>
                        <td>{{$questionval->questions_id}}</td>
                        <td>{{$questionval->created_at}}</td>
                     </tr>
                     @endforeach
                  </tbody>
                </table>
            </div>
        </div>
      </p>
	</div>
</div>
</div>
<script>
   $(document).ready(function () {
   $('#example_user').DataTable();
   $('#example_user_soping').DataTable();
   $('#example_user_cleaner').DataTable();
   $('#example_user_questions').DataTable();


   });
</script>
@endsection