
@extends('front.layouts.app')
@section('content')
<div class="multi-form-sections form2-main-section">
<div class="container">
      @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
      @endif
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
        <li>Some Required field are missing</li>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
</div>
      <form id="msform" class="multistep-forms form2" method="POST" action="{{route('siteSafetyInspectionSave')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="formId" value="{{ $webForm->id }}"/>
        <!-- progressbar -->
        <ul id="progressbar">
          <li class="active"></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <!--  <li></li><li></li> -->
        </ul>
        <!-- fieldsets -->
        <fieldset>
          <h2 class="fs-title">Inspection Details</h2>
          <div class="form-group">
            <label>Project/ job reference:</label>
            <select name="project_reference" id="project_reference">
            <option value="">Select Project</option>
             <?php if($projects){
              foreach($projects as $projectsVal){ ?> 
                <option value="<?php echo $projectsVal->id; ?> "><?php echo $projectsVal->name; ?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Location:</label>
            <input type="text" name="location" maxlength="250">
          </div>
          <div class="form-group">
            <label>Area inspected:</label>
            <input type="text" name="area_inspected" maxlength="250">
          </div>
          <div class="form-group">
            <label>Inspected by:</label>
            <input type="text" name="inspected_by" maxlength="250">
          </div>
          <div class="form-group">
            <label>Date:</label>
            <input type="date" name="date">
          </div>
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Inspection Checklist</h2>
          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Site Documents</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="site_document" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="site_document" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="site_document" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="site_document_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Site signage displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="site_signage" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="site_signage" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="site_signage" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="site_signage_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Safety signs displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="safety_signs" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="safety_signs" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="safety_signs" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="safety_signs_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Mandatory PPE displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="mandatory_ppe" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="mandatory_ppe" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="mandatory_ppe" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="mandatory_ppe_comments" maxlength="250">
          </div>
           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Policies displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="policies" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="policies" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="policies" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="policies_comments" maxlength="250">
          </div>
           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Site rules displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="site_rules" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="site_rules" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="site_rules" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="site_rules_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Emergency information displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="emergency_information" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_information" value="2" >
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_information" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="emergency_information_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>First Aid officers displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="first_aid_officers" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_officers" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_officers" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="first_aid_officers_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Sign in / our register present</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="sign_in" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="sign_in" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="sign_in" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="sign_in_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
                <label>Site Security</label>
              </div>
              <div class="form2-checkbox">
                <div class="form2checks">
                  <input type="radio" name="site_security" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="site_security" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="site_security" value="0">
                  <span>N/A</span>
                </div>
              </div>
            </div>
            <input type="text" name="site_security_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Site fence / hoarding present</label>
          </div>
          <div class="form2-checkbox">
                <div class="form2checks">
                  <input type="radio" name="site_fence" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="site_fence" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="site_fence" value="0">
                  <span>N/A</span>
                </div>
              </div>
            </div>
            <input type="text" name="site_fence_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Appropriate barricades in place</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="appropriate_barricades" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="appropriate_barricades" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="appropriate_barricades" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="appropriate_barricades_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Site access is controlled</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="site_access" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="site_access" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="site_access" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="site_access_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Public access is controlled</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="public_access" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="public_access" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="public_access" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="public_access_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Safe access and egress in place</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="safe_access" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="safe_access" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="safe_access" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="safe_access_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Site Processes</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="site_processes" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="site_processes" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="site_processes" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="site_processes_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>All workers inducted on site</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="all_workers_inducted_on_site" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="all_workers_inducted_on_site" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="all_workers_inducted_on_site" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="all_workers_inducted_on_site_comments" maxlength="250">
          </div>
          
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Inspection Checklist</h2>
          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>All workers inducted onto their SWMS / SOPS</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="workers_inducted_swms_sops" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="workers_inducted_swms_sops" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="workers_inducted_swms_sops" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="workers_inducted_swms_sops_comments" maxlength="250">
          </div>
          
          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>All workers have white cards</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="workers_white_cards" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="workers_white_cards" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="workers_white_cards" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="workers_white_cards_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>All workers following site processes</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="workers_following_site_processes" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="workers_following_site_processes" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="workers_following_site_processes" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="workers_following_site_processes_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Daily pre-start meetings being held</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="daily_pre_start_meetings" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="daily_pre_start_meetings" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="daily_pre_start_meetings" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="daily_pre_start_meetings_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Toolbox talks regularly conducted</label>
          </div>
            <div class="form2-checkbox">
            <div class="form2checks">
                  <input type="radio" name="toolbox_talks_regularly_conducted" value="1">
                    <span>Yes</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="toolbox_talks_regularly_conducted" value="2">
                  <span>No</span>
                </div>
                <div class="form2checks">
                  <input type="radio" name="toolbox_talks_regularly_conducted" value="0">
                  <span>N/A</span>
                </div>
            </div>
          </div>
            <input type="text" name="toolbox_talks_regularly_conducted_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Housekeeping</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="housekeeping" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="housekeeping" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="housekeeping" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="housekeeping_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Site generally clean</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="site_generally_clean" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="site_generally_clean" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="site_generally_clean" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="site_generally_clean_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Walkways are clear of obstruction</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="walkways_clear_obstruction" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="walkways_clear_obstruction" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="walkways_clear_obstruction" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="walkways_clear_obstruction_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Materials are safely stowed away</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="materials_safely_stowed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="materials_safely_stowed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="materials_safely_stowed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="materials_safely_stowed_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Rubbish and debris is disposed of</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="rubbish_debris_disposed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="rubbish_debris_disposed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="rubbish_debris_disposed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="rubbish_debris_disposed_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Slurry, water and dust removed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="slurry_water_dust_removed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="slurry_water_dust_removed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="slurry_water_dust_removed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="slurry_water_dust_removed_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Amenities</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="amenities" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="amenities" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="amenities" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="amenities_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Sufficient toilets / bubblers provided</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="sufficient_toilets_bubblers_provided" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="sufficient_toilets_bubblers_provided" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="sufficient_toilets_bubblers_provided" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="sufficient_toilets_bubblers_provided_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Lunchroom and facilities provided</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="lunchroom_facilities_provided" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="lunchroom_facilities_provided" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="lunchroom_facilities_provided" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="lunchroom_facilities_provided_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Amenities are clean and tidy</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="amenities_clean_tidy" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="amenities_clean_tidy" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="amenities_clean_tidy" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="amenities_clean_tidy_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Electrical</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="electrical" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="electrical_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Temporary power boards present</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="temporary_power_boards_present" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_power_boards_present" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_power_boards_present" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="temporary_power_boards_present_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Temporary power boards fitted with RCD</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="temporary_power_boards_fitted_rcd" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_power_boards_fitted_rcd" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_power_boards_fitted_rcd" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="temporary_power_boards_fitted_rcd_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Temporary power board secured to the ground / base</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="temporary_power_board_secured_ground" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_power_board_secured_ground" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_power_board_secured_ground" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="temporary_power_board_secured_ground_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Temporary power board compliant with AS/NZS 3012:2010</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="temporary_power_board_compliant_AS_NZS" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_power_board_compliant_AS_NZS" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_power_board_compliant_AS_NZS" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="temporary_power_board_compliant_AS_NZS_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Electrical equipment has current test tag</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="electrical_equipment_current_test_tag" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical_equipment_current_test_tag" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical_equipment_current_test_tag" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="electrical_equipment_current_test_tag_comments" maxlength="250">
          </div>

          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Inspection Checklist</h2>
          
          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Electrical equipment connected to RCDs</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="electrical_equipment_connected_RCD" value="2">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical_equipment_connected_RCD" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical_equipment_connected_RCD" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="electrical_equipment_connected_RCD_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Extension leads have current test tag</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="extension_leads_current_test_tag" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_leads_current_test_tag" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_leads_current_test_tag" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="extension_leads_current_test_tag_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Electrical leads are elevated off the ground with lead stands / hooks</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="electrical_leads_elevated_ground_lead_stands" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical_leads_elevated_ground_lead_stands" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical_leads_elevated_ground_lead_stands" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="electrical_leads_elevated_ground_lead_stands_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Electrical equipment and leads are in good condition</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="electrical_equipment_leads_good_condition" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical_equipment_leads_good_condition" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="electrical_equipment_leads_good_condition" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="electrical_equipment_leads_good_condition_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Working at Heights</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="working_heights" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="working_heights" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="working_heights" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="working_heights_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>All falls 2m or more are protected</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="all_falls_2m_protected" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="all_falls_2m_protected" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="all_falls_2m_protected" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="all_falls_2m_protected_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Temporary edge protection (handrails, mid-rails, toe boards) installed at all leading edges</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="temporary_edge_protection" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_edge_protection" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="temporary_edge_protection" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="temporary_edge_protection_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Extension ladders secured at top and bottom before use</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="extension_ladders_secured" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_ladders_secured" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_ladders_secured" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="extension_ladders_secured_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Height safety equipment has current test tag</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="height_safety_equipment" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="height_safety_equipment" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="height_safety_equipment" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="height_safety_equipment_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Penetrations and Voids</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="penetrations_voids" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="penetrations_voids" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="penetrations_voids" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="penetrations_voids_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Penetration covers are mechanically fixed and marked</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="penetration_covers_mechanically" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="penetration_covers_mechanically" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="penetration_covers_mechanically" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="penetration_covers_mechanically_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Where necessary cast in mesh is installed into slab</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="necessary_cast_mesh" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="necessary_cast_mesh" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="necessary_cast_mesh" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="necessary_cast_mesh_comment" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Lift shafts / service voids have covers or barriers installed, secured and marked</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="lift_shafts" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="lift_shafts" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="lift_shafts" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="lift_shafts_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Guards in place over stair voids</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="guards_place_stair_voids" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="guards_place_stair_voids" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="guards_place_stair_voids" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="guards_place_stair_voids_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Areas delineated / barricaded</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="areas_delineated" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="areas_delineated" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="areas_delineated" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="areas_delineated_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Materials fall protection</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="materials_fall_protection" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="materials_fall_protection" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="materials_fall_protection" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="materials_fall_protection_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Netting covers all perimeter scaffolding</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="netting_covers_perimeter_scaffolding" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="netting_covers_perimeter_scaffolding" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="netting_covers_perimeter_scaffolding" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="netting_covers_perimeter_scaffolding_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Toe boards installed on all guard rails</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="toe_boards_installed_all_guard_rails" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="toe_boards_installed_all_guard_rails" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="toe_boards_installed_all_guard_rails" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="toe_boards_installed_all_guard_rails_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Core holes / penetrations / voids covered and mechanically fixed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="core_holes" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="core_holes" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="core_holes" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="core_holes_comments" maxlength="250">
          </div>

          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Scaffolds</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="scaffolds" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="scaffolds" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="scaffolds" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="scaffolds_comments" maxlength="250">
          </div>

          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title"> Inspection Checklist</h2>
          
           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Scaffold has current test and tag at all entry points</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="scaffold_current_test_tag_entry_points" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="scaffold_current_test_tag_entry_points" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="scaffold_current_test_tag_entry_points" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="scaffold_current_test_tag_entry_points_comments" maxlength="250">
          </div>


           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Handover certificate available </label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="handover_certificate_available" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="handover_certificate_available" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="handover_certificate_available" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="handover_certificate_available_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Adequately braced / tied</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="adequately_braced" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="adequately_braced" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="adequately_braced" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="adequately_braced_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Gaps between scaffold and working face do not exceed 225mm</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="scaffold_working_face_exceed_225mm" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="scaffold_working_face_exceed_225mm" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="scaffold_working_face_exceed_225mm" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="scaffold_working_face_exceed_225mm_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>All scaffold components are intact</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="all_scaffold_components_intact" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="all_scaffold_components_intact" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="all_scaffold_components_intact" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="all_scaffold_components_intact_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Access ladders / stairs free of debris, materials etc.</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="access_ladders" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="access_ladders" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="access_ladders" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="access_ladders_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Bays free from obstruction</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="bays_free_obstruction" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="bays_free_obstruction" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="bays_free_obstruction" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="bays_free_obstruction_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Minimum 450mm wide gap available on bays for worker access</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="minimum_450mm_wide_gap" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="minimum_450mm_wide_gap" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="minimum_450mm_wide_gap" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="minimum_450mm_wide_gap_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Bays are not being point loaded</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="Bays_not_point_loaded" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="Bays_not_point_loaded" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="Bays_not_point_loaded" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="Bays_not_point_loaded_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Bays are not being overloaded</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="bays_being_overloaded" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="bays_being_overloaded" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="bays_being_overloaded" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="bays_being_overloaded_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>No missing scaffold planks</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="no_missing_scaffold_planks" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="no_missing_scaffold_planks" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="no_missing_scaffold_planks" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="no_missing_scaffold_planks_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Sole plates founded on solid base</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="sole_plates_founded_solid_base" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="sole_plates_founded_solid_base" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="sole_plates_founded_solid_base" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="sole_plates_founded_solid_base_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Lapboards are mechanically secured</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="lapboards_mechanically_secured" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="lapboards_mechanically_secured" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="lapboards_mechanically_secured" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="lapboards_mechanically_secured_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Incomplete scaffold has been barricaded and closed off + signs erected</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="incomplete_scaffold_barricaded_closed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="incomplete_scaffold_barricaded_closed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="incomplete_scaffold_barricaded_closed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="incomplete_scaffold_barricaded_closed_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>PPE</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="ppe" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ppe" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ppe" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="ppe_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Workers are wearing mandatory PPE</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="workers_wearing_mandatory_ppe" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="workers_wearing_mandatory_ppe" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="workers_wearing_mandatory_ppe" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="workers_wearing_mandatory_ppe_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Workers observed using PPE correctly for their tasks (e.g. face masks)</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="workers_observed_ppe_correctly_tasks" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="workers_observed_ppe_correctly_tasks" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="workers_observed_ppe_correctly_tasks" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="workers_observed_ppe_correctly_tasks_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>PPE complies with regulatory requirements</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="ppe_complies_regulatory_requirements" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ppe_complies_regulatory_requirements" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ppe_complies_regulatory_requirements" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="ppe_complies_regulatory_requirements_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Ladders</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="ladders" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ladders" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ladders" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="ladders_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Only industrial strength ladders used</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="industrial_strength_ladder" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="industrial_strength_ladder" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="industrial_strength_ladder" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="industrial_strength_ladder_comments" maxlength="250">
          </div>
          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Ladders are in good condition and free of damage</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="ladders_good_condition" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ladders_good_condition" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ladders_good_condition" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="ladders_good_condition_comments" maxlength="250">
          </div>

          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Inspection Checklist</h2>
           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Safety labels are intact</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="safety_labels_intact" value="2">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="safety_labels_intact" value="1">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="safety_labels_intact" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="safety_labels_intact_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Extension ladders secured at top and bottom</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="extension_adders_secured_top_bottom" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_adders_secured_top_bottom" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_adders_secured_top_bottom" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="extension_adders_secured_top_bottom_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Extension ladders extend 1m past top of landing</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="extension_ladders_extend_1m_past_top_landing" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_ladders_extend_1m_past_top_landing" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_ladders_extend_1m_past_top_landing" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="extension_ladders_extend_1m_past_top_landing_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Extension ladders placed at correct angle (1:4)</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="extension_ladders_placed_correct_angle_1_4" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_ladders_placed_correct_angle_1_4" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="extension_ladders_placed_correct_angle_1_4" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="extension_ladders_placed_correct_angle_1_4_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Ladders not used on scaffold / near fall risks</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="ladders_not_used_scaffold" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ladders_not_used_scaffold" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ladders_not_used_scaffold" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="ladders_not_used_scaffold_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Ladders not used in entrance ways / paths of travel without exclusion zone</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="ladders_not_used_entrance_ways" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ladders_not_used_entrance_ways" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="ladders_not_used_entrance_ways" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="ladders_not_used_entrance_ways_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Trenches and Excavations</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="trenches_xcavations" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="trenches_xcavations" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="trenches_xcavations" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="trenches_xcavations_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>DBYD been obtained before work</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="DBYD_been_obtained_before_work" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="DBYD_been_obtained_before_work" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="DBYD_been_obtained_before_work" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="DBYD_been_obtained_before_work_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Services have been located and potholed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="services_have_been_located_potholed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="services_have_been_located_potholed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="services_have_been_located_potholed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="services_have_been_located_potholed_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Excavations / trenches barricaded and sign posted</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="excavations_trenches_barricaded_sign_posted" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="excavations_trenches_barricaded_sign_posted" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="excavations_trenches_barricaded_sign_posted" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="excavations_trenches_barricaded_sign_posted_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Correct trench support used where necessary</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="correct_trench_support_used_where_necessary" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="correct_trench_support_used_where_necessary" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="correct_trench_support_used_where_necessary" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="correct_trench_support_used_where_necessary_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Trenches greater than 1.5m have edge protection and safe access / egress</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="trenches_greater_than_1_5m_have_edge_protection" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="trenches_greater_than_1_5m_have_edge_protection" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="trenches_greater_than_1_5m_have_edge_protection" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="trenches_greater_than_1_5m_have_edge_protection_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Edges of excavations / trenches clear of spoil / materials</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="edges_excavations" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="edges_excavations" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="edges_excavations" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="edges_excavations_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Hazardous substances</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="hazardous_substances" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="hazardous_substances" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="hazardous_substances" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="hazardous_substances_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Register is kept on site and up to date</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="register_kept_on_site_and_up_to_date" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="register_kept_on_site_and_up_to_date" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="register_kept_on_site_and_up_to_date" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="register_kept_on_site_and_up_to_date_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>SDS available for all hazardous substances</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="SDS_available_hazardous_substances" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="SDS_available_hazardous_substances" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="SDS_available_hazardous_substances" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="SDS_available_hazardous_substances_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Appropriate signage displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="appropriate_signage_displayed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="appropriate_signage_displayed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="appropriate_signage_displayed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="appropriate_signage_displayed_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>adequately stored and ventilated</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="adequately_stored_ventilated" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="adequately_stored_ventilated" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="adequately_stored_ventilated" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="adequately_stored_ventilated_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Kept in original containers with labels</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="kept_original_containers_with_labels" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="kept_original_containers_with_labels" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="kept_original_containers_with_labels" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="kept_original_containers_with_labels_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Spill kit available on site</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="spill_kit_available_site" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="spill_kit_available_site" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="spill_kit_available_site" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="spill_kit_available_site_comments" maxlength="250">
          </div>

          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Inspection Checklist</h2>
          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Emergency and First Aid</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="emergency_first_aid" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_first_aid" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_first_aid" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="emergency_first_aid_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Emergency access kept clear at all times</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="emergency_access_kept_all_times" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_access_kept_all_times" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_access_kept_all_times" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="emergency_access_kept_all_times_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Emergency exit points clearly marked</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="emergency_exit_points_clearly_marked" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_exit_points_clearly_marked" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_exit_points_clearly_marked" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="emergency_exit_points_clearly_marked_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Emergency evacuation plan displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="emergency_evacuation_plan_displayed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_evacuation_plan_displayed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_evacuation_plan_displayed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="emergency_evacuation_plan_displayed_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Emergency assembly point displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="emergency_assembly_point_displayed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_assembly_point_displayed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_assembly_point_displayed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="emergency_assembly_point_displayed_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Emergency contact details displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="emergency_contact_details_displayed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_contact_details_displayed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_contact_details_displayed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="emergency_contact_details_displayed_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Adequate firefighting equipment available</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="adequate_firefighting_equipment_available" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="adequate_firefighting_equipment_available" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="adequate_firefighting_equipment_available" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="adequate_firefighting_equipment_available_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Firefighting equipment has current test tag</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="firefighting_equipment_current_test_tag" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="firefighting_equipment_current_test_tag" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="firefighting_equipment_current_test_tag" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="firefighting_equipment_current_test_tag_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>First Aid officer & contact displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="first_aid_officer_contact_displayed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_officer_contact_displayed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_officer_contact_displayed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="first_aid_officer_contact_displayed_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>First aid signage displayed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="first_aid_signage_displayed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_signage_displayed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_signage_displayed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="first_aid_signage_displayed_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>First aid kit fully stocked</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="first_aid_kit_fully_stocked" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_kit_fully_stocked" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_kit_fully_stocked" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="first_aid_kit_fully_stocked_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>First aid and emergency personnel are trained / current certificates</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="first_aid_emergency_personnel_trained" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_emergency_personnel_trained" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="first_aid_emergency_personnel_trained" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="first_aid_emergency_personnel_trained_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Injury register maintained on site</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="injury_register_maintained_site" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="injury_register_maintained_site" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="injury_register_maintained_site" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="injury_register_maintained_site_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Hot works are approved and adequately controls / emergency response measures in place</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="hot_works_approved_adequately_controls" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="hot_works_approved_adequately_controls" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="hot_works_approved_adequately_controls" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="hot_works_approved_adequately_controls_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Cranes</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="cranes" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="cranes" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="cranes" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="cranes_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Certificate of registration available</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="certificate_registration_available" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="certificate_registration_available" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="certificate_registration_available" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="certificate_registration_available_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Insurances available</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="insurances_available" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="insurances_available" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="insurances_available" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="insurances_available_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Maintenance and service records available and up to date</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="maintenance_service_records_available_and_up_to_date" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="maintenance_service_records_available_and_up_to_date" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="maintenance_service_records_available_and_up_to_date" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="maintenance_service_records_available_and_up_to_date_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Pre-start inspection are being completed</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="pre_start_inspection_being_completed" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="pre_start_inspection_being_completed" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="pre_start_inspection_being_completed" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="pre_start_inspection_being_completed_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Crane crew hold appropriate licences / competency</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="crane_crew_hold_appropriate_licences" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="crane_crew_hold_appropriate_licences" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="crane_crew_hold_appropriate_licences" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="crane_crew_hold_appropriate_licences_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Exclusion being used during movement of loads</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="exclusion_being_used_during_movement_loads" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="exclusion_being_used_during_movement_loads" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="exclusion_being_used_during_movement_loads" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="exclusion_being_used_during_movement_loads_comments" maxlength="250">
          </div>

          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>

        <fieldset>
          <h2 class="fs-title">Inspection Checklist</h2>
          <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Emergency response measures in place</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="emergency_response_measures_place" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_response_measures_place" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_response_measures_place" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="emergency_response_measures_place_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Mobile Plant</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="mobile_plant" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="mobile_plant" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="mobile_plant" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="mobile_plant_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Certificate of registration available</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="certificate_registration_available1" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="certificate_registration_available1" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="certificate_registration_available1" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="certificate_registration_available_comments1" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Insurances available</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="insurances_available1" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="insurances_available1" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="insurances_available1" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="insurances_available_comments1" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Maintenance and service records available and up to date</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="maintenance_service_records_available_and_up_to_date1" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="maintenance_service_records_available_and_up_to_date1" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="maintenance_service_records_available_and_up_to_date1" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="maintenance_service_records_available_and_up_to_date_comments1" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Operators hold appropriate licences / competency</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="operators_hold_appropriate_licences" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="operators_hold_appropriate_licences" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="operators_hold_appropriate_licences" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="operators_hold_appropriate_licences_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Exclusion being used where necessary</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="exclusion_being_used_where_necessary" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="exclusion_being_used_where_necessary" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="exclusion_being_used_where_necessary" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="exclusion_being_used_where_necessary_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Emergency response measures in place</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="emergency_response_measures_place1" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_response_measures_place1" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="emergency_response_measures_place1" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="emergency_response_measures_place_comments1" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Lifting Equipment</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="lifting_equipment" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="lifting_equipment" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="lifting_equipment" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="lifting_equipment_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Register available and maintained on site</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="register_available_maintained_site" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="register_available_maintained_site" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="register_available_maintained_site" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="register_available_maintained_site_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Equipment has current test tag</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="equipment_has_current_test_tag" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="equipment_has_current_test_tag" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="equipment_has_current_test_tag" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="equipment_has_current_test_tag_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Equipment correctly stored</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="equipment_correctly_stored" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="equipment_correctly_stored" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="equipment_correctly_stored" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="equipment_correctly_stored_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Equipment inspected before use</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="equipment_inspected_before_use" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="equipment_inspected_before_use" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="equipment_inspected_before_use" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="equipment_inspected_before_use_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Traffic Control / Public Safety</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="traffic_control" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="traffic_control" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="traffic_control" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="traffic_control_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Traffic Management/ Control plan in place</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="traffic_management" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="traffic_management" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="traffic_management" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="traffic_management_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Fencing / barriers to stop public access to site</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="fencing_barriers_to_stop_public_access_to_site" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="fencing_barriers_to_stop_public_access_to_site" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="fencing_barriers_to_stop_public_access_to_site" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="fencing_barriers_to_stop_public_access_to_site_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Public areas kept clear of materials / rubbish / operations</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="public_areas_kept_clear_of_materials" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="public_areas_kept_clear_of_materials" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="public_areas_kept_clear_of_materials" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="public_areas_kept_clear_of_materials_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Traffic controllers certified</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="traffic_controllers_certified" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="traffic_controllers_certified" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="traffic_controllers_certified" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="traffic_controllers_certified_comments" maxlength="250">
          </div>

           <div class="form-group">
            <div class="form2-labels-part">
              <div class="form2-label">
            <label>Signs and devices in use</label>
          </div>
            <div class="form2-checkbox">
              <div class="form2checks">
                <input type="radio" name="signs_and_devices_in_use" value="1">
                <span>Yes</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="signs_and_devices_in_use" value="2">
                <span>No</span>
              </div>
              <div class="form2checks">
                <input type="radio" name="signs_and_devices_in_use" value="0">
                <span>N/A</span>
              </div>
            </div>
          </div>
            <input type="text" name="signs_and_devices_in_use_comments" maxlength="250">
          </div>

          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Declaration by inductee</h2>
         
          <div class="form-group">
            <label>General / additional comments & notations </label>
            <textarea name="general_additional_comments_notations" class="form-control" rows="4" maxlength="250"></textarea>
          </div>
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="submit" name="submit" class="submit action-button" value="Submit" />

        </fieldset>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('public/front/js/siteSafety.js')}}"></script>
    @endsection