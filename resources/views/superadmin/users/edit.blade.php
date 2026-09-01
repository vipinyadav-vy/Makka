@extends('layouts.admin')
@section('content')
<style>
    button.multiselect.dropdown-toggle.custom-select.text-center {
    min-width: 300px;
    max-width: 300px;
} 
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-white">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary float-right text-white">Back</a>
                    </div>
                    <form name="accountManager" method="POST" action="{{ route('users.update', [$createuser_edit->id]) }}" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="conatiner">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="user_name">User Name</label>
                                                <input type="text" class="form-control" name="user_name" id="user_name" value="{{ $createuser_edit->user_name }}" autocomplete="off" placeholder="User Name" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control" name="email" id="email" value="{{ $createuser_edit->email }}" autocomplete="off" placeholder="E-mail" readonly required>
                                            </div>
                                        </div>
                                        <!-- <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="qualification">Qualification</label>
                                                <input id="txtNumber" type="text" class="form-control" value="{{ $createuser_edit->qualification }}" name="qualification" required />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="signature">Signature</label>
                                                <input type="text" class="form-control" name="signature" id="signature" value="{{ $createuser_edit->signature }}" autocomplete="off" placeholder="Signature" required>
                                            </div>
                                        </div> -->
                                        <div class="form-row"><div class="form-group col-12"><hr></div></div>
                                        <div class="form-row"><div class="form-group col-12"><h5 class="card-title font-weight-bold">Access Permission on Projects</h5></div></div>
                                        @foreach($projects as $projectsval)
                                            @php
                                                $projectDetails = [];
                                                $formIds = [];
                                            @endphp

                                            @foreach($createuser_edit->userProjects as $userProject)
                                                @if ($userProject->project_id == $projectsval->id)
                                                    @php
                                                        $projectDetails = $userProject;
                                                    @endphp

                                                    @isset($createuser_edit->userWebforms)
                                                        @foreach($createuser_edit->userWebforms as $webform)
                                                            @if ($webform->project_id == $projectsval->id)
                                                                @php
                                                                    $formIds[] = $webform->webform_id;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                    @break
                                                @endif
                                            @endforeach

                                            <div class="form-row mb-4">
                                                <div class="form-group col-3 pl-4">
                                                    <div class="form-check icheck-primary form-check-inline">
                                                        <input name="projects[{{ $projectsval->id }}][project]" {{ !empty($projectDetails) ? 'checked' : '' }} class="form-check-input project-checkbox" type="checkbox" id="project_access_{{ $projectsval->id }}" value="{{ $projectsval->id }}" data-project-id="{{ $projectsval->id }}">
                                                        <label class="form-check-label pl-2" for="project_access_{{ $projectsval->id }}">{{ $projectsval->name }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-5">
                                                    <div class="form-check icheck-primary form-check-inline">
                                                        <input name="projects[{{ $projectsval->id }}][program]" {{ !empty($projectDetails) && $projectDetails->program_access == 1 ? 'checked' : '' }} {{ !empty($projectDetails) ? '' : 'disabled' }} class="form-check-input program-access-checkbox" type="checkbox" id="program_access_{{ $projectsval->id }}" value="1" data-project-id="{{ $projectsval->id }}">
                                                        <label class="form-check-label pl-2" for="program_access_{{ $projectsval->id }}">Program Access</label>
                                                    </div>
                                                    <div class="form-check icheck-primary form-check-inline pl-2">
                                                        <input name="projects[{{ $projectsval->id }}][diary]" {{ !empty($projectDetails) && $projectDetails->diary_access == 1 ? 'checked' : '' }} {{ !empty($projectDetails) ? '' : 'disabled' }} class="form-check-input diary-access-checkbox" type="checkbox" id="diary_access_{{ $projectsval->id }}" value="1" data-project-id="{{ $projectsval->id }}">
                                                        <label class="form-check-label pl-2" for="diary_access_{{ $projectsval->id }}">Diary Access</label>
                                                    </div>
                                                    <div class="form-check icheck-primary form-check-inline pl-2">
                                                        <input name="projects[{{ $projectsval->id }}][webforms]" {{ !empty($projectDetails) && $projectDetails->webforms_access == 1 ? 'checked' : '' }} {{ !empty($projectDetails) ? '' : 'disabled' }} class="form-check-input webforms-access-checkbox" type="checkbox" id="webforms_access_{{ $projectsval->id }}" value="1" data-project-id="{{ $projectsval->id }}">
                                                        <label class="form-check-label pl-2" for="webforms_access_{{ $projectsval->id }}">Webforms Access</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-4">
                                                @php $webforms = App\Http\Controllers\SuperAdmin\UserControllerSuperAdmin::getProjectWebForms($projectsval->id) @endphp
                                                        <select name="projects[{{ $projectsval->id }}][webform_ids][]" class="webFormAccess"  multiple="multiple">
                                                            @foreach($webforms as $webformsval)
                                                                @php
                                                                    $isSelected = in_array($webformsval->id, $formIds) ? 'selected' : '';
                                                                @endphp
                                                                 <option value="{{ $webformsval->id }}" {{ $isSelected }}>{{ $webformsval->title }}</option>
                                                               @endforeach
                                                            </select>
                                                </div>
                                            </div>
                                        @endforeach
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group text-center">
                                    <button type="submit" name="usersubmit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('.webFormAccess').multiselect();
    });
</script>
<script>
    $(function() {
        $("form[name='accountManager']").validate({
            rules: {
                user_name: "required",
            },
            messages: {
                user_name: "Please enter User Name"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

    $('.project-checkbox').change(function () {
        const projectId = $(this).data('project-id');
        const isChecked = $(this).prop('checked');
        const selectBoxId = "webforms-select-" + projectId;

        if (!isChecked) {
            $('.program-access-checkbox[data-project-id="' + projectId + '"]').prop('checked', false);
            $('.diary-access-checkbox[data-project-id="' + projectId + '"]').prop('checked', false);
            $('.webforms-access-checkbox[data-project-id="' + projectId + '"]').prop('checked', false);
            $('#' + selectBoxId).css('display', 'none');
        } else {
            // $('#' + selectBoxId).css('display', 'block');
        }


        $('.program-access-checkbox[data-project-id="' + projectId + '"]').prop('disabled', !isChecked);
        $('.diary-access-checkbox[data-project-id="' + projectId + '"]').prop('disabled', !isChecked);
        $('.webforms-access-checkbox[data-project-id="' + projectId + '"]').prop('disabled', !isChecked);
    });

    $('.webforms-access-checkbox').change(function () {
        const projectId = $(this).data('project-id');
        const isChecked = $(this).prop('checked');
        const selectBoxId = "webforms-select-" + projectId;

        if (isChecked) {
            $('#' + selectBoxId).css('display', 'block');
        } else {
            $('#' + selectBoxId).css('display', 'none');
        }
    });
</script>
@endsection
