<!-- @if(Session::has('error'))
    <script type="text/javascript">
        swal({
            title: "Error",
            text: "{{{ Session::get('error') }}}",
            type: "error",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif
@if(Session::has('success'))
    <script type="text/javascript">
        swal({
            title: "Success",
            text: "{{{ Session::get('success') }}}",
            type: "success",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif
@if(Session::has('warning'))
    <script type="text/javascript">
        swal({
            title: "Warning",
            text: "{{{ Session::get('warning') }}}",
            type: "warning",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif -->
<!-- @if(session()->has('success'))
    <script type="text/javascript">
        $(function () {
            swal("Deleted!", "Data has been Deleted.", "success"),
                swal({
                    title: {{ session()->get('success') }},
                    text: "Your Custom or Dynamic SUccess message put here",
                    type: "success"})

        });
    </script>
@endif -->
@if(session()->has('success'))
    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger">
        {{session()->get('error')}}
    </div>
@endif