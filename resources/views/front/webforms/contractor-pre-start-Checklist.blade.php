@extends('front.layouts.app')

@section('content')
<style>
    .review-checklist-QA .answer-wrap input {
    margin: 5px;
}
.uploadSize{color:red;}
</style>
<div class="multi-form-sections">
<h1 class="fs-title" style="text-align:center">PRE-START CHECKLIST</h1>
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
      <form name="preStartChecklistSave" id="msform" class="multistep-forms form1" method="POST" action="{{route('preStartChecklistSave')}}" enctype="multipart/form-data">
      @csrf  

        <!-- fieldsets -->
        <fieldset>
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name">
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
            <div class="form-group">
              <label>ABN / CAN</label>
              <input type="text" name="abn_can">
            </div>
          </div>
          <div class="col-xl-12 col-lg-12 col-md-13 mb-30">
            <div class="form-group">
              <label>Address:</label>
              <input type="text" name="address">
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
            <div class="form-group">
              <label>Phone:</label>
              <input type="text" name="phone_no">
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
            <div class="form-group">
              <label>Email:</label>
              <input type="text" name="email">
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
            <div class="form-group">
              <label>Website:</label>
              <input type="text" name="website">
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
            <div class="form-group">
              <label>Product / Service / Work:</label>
              <select name="product">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
            <div class="form-group">
              <label>Representative</label>
              <input type="text" name="representative">
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
            <div class="form-group">
              <label>Representative Name:</label>
              <input type="text" name="representative_name">
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
            <div class="form-group">
              <label>Representative Phone:</label>
              <input type="text" name="representative_phone">
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
            <div class="form-group">
              <label>Representative Email:</label>
              <input type="text" name="representative_email"> 
            </div>
          </div>
        </div>
        <div class="review-checklist-wrap">
          <table>
            <tr>
              <th colspan="4" class="main-th">Pre-Start Checklist</th>
            </tr>
          </table>
          <div class="review-checklist-QA">
              
    
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                  <h4>Insurance</h4>
                <p>1. Current public liability insurance policy (copies required).</p>
                <div id="secq-Quality_Assurance" class="answer-wrap">
                  <input type="radio" id="certified-yes" name="insurance_policy" class="toggle-Quality_Assurance"
                    value="1"><label for="yes">Yes</label>
                  <input type="radio" id="certified-no" name="insurance_policy" class="toggle-Quality_Assurance" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="certified-notapplicable" name="insurance_policy" class="toggle-Quality_Assurance" value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-Quality_Assurance" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>

                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" name="insurance_policy_doc[]" id="insurance_policy_doc" multiple />
                      <label for="insurance_policy_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>2. Current workers compensation policy (copies required)</p>
                <div id="eighthq-worker_competency" class="answer-wrap">
                  <input type="radio" id="worker_competency-yes" name="compensation_policy"
                    class="toggle-worker_competency" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="worker_competency-no" name="compensation_policy" class="toggle-worker_competency" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="worker_competency-notapplicable" name="compensation_policy" class="toggle-worker_competency"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-worker_competency" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>

                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="verify_worker_competency_doc" name="compensation_policy_doc[]" multiple />
                      <label for="verify_worker_competency_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                  <h4>Licences / Qualifications</h4>
                <p>3. Are licences/qualifications required for the tasks being undertaken? E.g. Contractor Licence, induction card, high risk work licence (e.g. forklift), first aid (copies required)
                </p>
                <div id="tenthq-organisation_docs" class="answer-wrap">
                  <input type="radio" id="organisation_docs-yes" name="qualifications"
                    class="toggle-organisation_docs" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="organisation_docs-no" name="qualifications" class="toggle-organisation_docs" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="organisation_docs-notapplicable" name="qualifications" class="toggle-organisation_docs"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-organisation_docs" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="organisation_insurances_licences_qualifications_doc" name="qualifications_doc[]" multiple />
                      <label for="organisation_insurances_licences_qualifications_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                  <h4>Risks Assessments / SWMS / SOPs</h4>
                <p>4. Is the work being undertaken medium to high risk where there is a risk of a severe or permanent injury? (if yes, evidence of risk assessments and/or safe procedures such as a safe operating procedure (SOP) or a safe work method statement (SWMS) must be provided)</p>
                <div id="twelvethq-been_fined" class="answer-wrap">
                  <input type="radio" id="been_fined-yes" name="risk_injury" class="toggle-been_fined" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="been_fined-no" name="risk_injury" class="toggle-been_fined" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="been_fined-notapplicable" name="risk_injury" class="toggle-been_fined" value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-been_fined" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="prosecuted_issue_doc" name="risk_injury_doc[]" multiple />
                      <label for="prosecuted_issue_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>5. Has contractor provided all necessary emergency contact details?</p>
                <div id="fifth-necessary_resources" class="answer-wrap">
                  <input type="radio" name="necessary_emergency" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" name="necessary_emergency" value="0">
                  <label for="no">No</label>
                  <input type="radio" name="necessary_emergency"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>6. Has the reporting requirements: incidents, inductions, hazard, risk management, communication and consultation processes been explained? </p>
                <div id="sixth-reporting_requirements" class="answer-wrap">
                  <input type="radio" name="reporting_requirements" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" name="reporting_requirements" value="0">
                  <label for="no">No</label>
                  <input type="radio" name="reporting_requirements"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>7. Does the task require a specific emergency plan? eg. working in remote or isolated areas, working with harnesses, rescue from heights plan (copies required) </p>
                <div id="thirteenthq-under_investigation" class="answer-wrap">
                  <input type="radio" id="under_investigation-yes" name="specific_emergency_plan"
                    class="toggle-under_investigation" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="under_investigation-no" class="toggle-under_investigation" name="specific_emergency_plan" value="0"> 
                  <label for="no">No</label>
                  <input type="radio" id="under_investigation-notapplicable" class="toggle-under_investigation" name="specific_emergency_plan"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-under_investigation" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="under_investigation_environmental_laws_doc" name="specific_emergency_plan_doc[]" multiple />
                      <label for="under_investigation_environmental_laws_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                  <h4>Plant & Equipment</h4>
                <p>8. Provided all registration, insurances, maintenance and service records for plant and equipment.</p>
                <div id="fourteenthq-criminal_offence" class="answer-wrap">
                  <input type="radio" id="criminal_offence-yes" name="records_plant_equipment" class="toggle-criminal_offence"
                    value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="criminal_offence-no" name="records_plant_equipment" class="toggle-criminal_offence" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="criminal_offence-notapplicable" name="records_plant_equipment" class="toggle-criminal_offence"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-criminal_offence" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="company_officers_criminal_offence_doc" name="records_plant_equipment_doc[]" multiple />
                      <label for="company_officers_criminal_offence_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>9. Is all plant / equipment in good working condition? eg. plant includes machinery, equipment and tools</p>
                <div id="fifteenthq-necessary_resources" class="answer-wrap">
                  <input type="radio" name="plant_working_condition" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" name="plant_working_condition" value="0">
                  <label for="no">No</label>
                  <input type="radio" name="plant_working_condition"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>10. Is there a maintenance register of the plant being brought to site? (copies required).</p>

                <div id="sixteenthq-mgt_procedures" class="answer-wrap">
                  <input type="radio" id="mgt_procedures-yes" name="plant_brought_site" class="toggle-mgt_procedures"
                    value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="mgt_procedures-no" name="plant_brought_site" class="toggle-mgt_procedures" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="mgt_procedures-notapplicable" name="plant_brought_site" class="toggle-mgt_procedures" value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-mgt_procedures" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="procedures_systems_doc" name="plant_brought_site_doc[]" multiple />
                      <label for="procedures_systems_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <h4>Hazardous substances</h4>
                <p>11. Will the task involve the use of hazardous chemicals/substances? </p>
                <div id="eleventhq-inspection_processes" class="answer-wrap"> 
                   <input type="radio" name="hazardous_chemicals" value="1">
                    <label for="yes">Yes</label>
                    <input type="radio" name="hazardous_chemicals" value="0">
                    <label for="no">No</label>
                    <input type="radio" name="hazardous_chemicals" value="2">
                    <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>12. Will exposure standards be met? Please provide details </p>
                <div id="seventhq-workforce" class="answer-wrap">
                  <input type="radio" name="exposure_standards" class="toggle-workforce" value="1">
                    <label for="yes">Yes</label>
                    <input type="radio" name="exposure_standards" class="toggle-workforce" value="0">
                    <label for="no">No</label>
                    <input type="radio" name="exposure_standards" class="toggle-workforce" value="2">
                    <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-workforce" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="staff_qualified_administering_first_aid_doc" name="exposure_standards_doc[]" multiple />
                      <label for="staff_qualified_administering_first_aid_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>13. Are containers clearly labelled and relevant safety data sheets (SDS) available? </p>
                <div id="thirteenthq-inspection_processes" class="answer-wrap"> 
                  <input type="radio" name="containers_labelled" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" name="containers_labelled" value="0">
                  <label for="no">No</label>
                  <input type="radio" name="containers_labelled"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                  <h4>Electrical</h4>
                <p>14. Will electrical equipment be brought to site? </p>
                <div id="fourteenthq-inspection_processes" class="answer-wrap"> 
                  <input type="radio" name="electrical_equipment" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" name="electrical_equipment" value="0">
                  <label for="no">No</label>
                  <input type="radio" name="electrical_equipment"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>15. Are copies of testing records available?(copies required)</p>
                <div id="fifteenthq-returns_policy" class="answer-wrap">
                  <input type="radio" id="returns_policy-yes" name="testing_records" class="toggle-returns_policy"
                    value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="returns_policy-no" name="testing_records" class="toggle-returns_policy" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="returns_policy-notapplicable" name="testing_records" class="toggle-returns_policy" value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-returns_policy" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" name="testing_records_doc[]" id="materials_return_credit_policy_doc" multiple  />
                      <label for="materials_return_credit_policy_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                  <h4>Worker Training / Competency</h4> 
                <p>16. Will other workers be brought to site?</p>
                <div id="sixteenthq-inspection_processes" class="answer-wrap"> 
                  <input type="radio" name="workers_brought_site" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" name="workers_brought_site" value="0">
                  <label for="no">No</label>
                  <input type="radio" name="workers_brought_site"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>17. Are training and competency records related to the tasks being undertaken available? (copies required)</p>
                <div id="seventeenthq-trade_references" class="answer-wrap">
                  <input type="radio" id="trade_references-yes" name="training_competency" class="toggle-trade_references"
                    value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="trade_references-no" name="training_competency" class="toggle-trade_references" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="trade_references-notapplicable" class="toggle-trade_references" name="training_competency"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-trade_references" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" name="training_competency_doc[]" id="trade_references_doc" multiple />
                      <label for="trade_references_doc">
                        <div>
                          <span class="formbold-drop-file"> Drop files here </span>
                          <span class="formbold-or"> Or </span>
                          <span class="formbold-browse"> Browse </span>
                          <p class="uploadSize"> You Can Upload Max File Size 4MB. </p>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>18. Worker white cards provided?</p>
                <div id="eighteenth-workers_white_card" class="answer-wrap"> 
                  <input type="radio" name="workers_white_card" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" name="workers_white_card" value="0">
                  <label for="no">No</label>
                  <input type="radio" name="workers_white_card"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>19. Worker high risk work licences provided</p>
                <div id="ninteenth-workers_risk_licences" class="answer-wrap"> 
                  <input type="radio" name="workers_risk_licences" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" name="workers_risk_licences" value="0">
                  <label for="no">No</label>
                  <input type="radio" name="workers_risk_licences"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>20. Worker – other licences, VOC, training evidence provided</p>
                <div id="twenty-workers_training_evidence" class="answer-wrap"> 
                  <input type="radio" name="workers_training_evidence" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" name="workers_training_evidence" value="0">
                  <label for="no">No</label>
                  <input type="radio" name="workers_training_evidence"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
          <h2 class="fs-title">General / additional comments & notations</h2>
          <table class="table">
            <thead class="main-thead">
              <th class="main-th"></th>
            </thead>
            <tbody>
              <tr>
                <td data-label="general_comment">
                  <div class="form-group">
                    <textarea id="general_comment" name="general_comment" rows="4" cols="50"></textarea>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
          <h2 class="fs-title">Sign-off</h2>

          <table class="table">
            <thead class="main-thead">
              <th colspan="4" class="main-th">To be signed by the person responsible for reviewing and confirming all of the above.</th>
            </thead>
            <thead>
              <th>Manager Name</th>
              <th>Signature</th>
              <th>Date</th>
            </thead>
            <tbody>
              <tr>
                <td data-label="name">
                  <div class="form-group">
                    <input type="text" name="manager_name">
                  </div>
                </td>
                
                <td data-label="Signature">
                    
                    <div class="form-group">
					<canvas width="400" height="100" id="signatureCanvas"></canvas>
					<div id="signaturebox"></div>
                <button type="button" id="clearButton" class="clearButton">Clear</button>
				<input type="hidden" id="manager_signature" name="manager_signature">
					</div>
                  
                </td>
                <td data-label="Date">
                  <div class="form-group">
                    <input type="date" id="manager_date" name="manager_date">
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <input type="submit" name="submit" class="action-button" value="Submit">
      </fieldset>
        
         </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.4/signature_pad.js"></script>
    <script src="{{asset('public/front/js/preStartChecklist.js')}}"></script>

<script type="text/javascript">	
// Wait for the document to be ready
$(document).ready(function() {
 
  $('.toggle-Quality_Assurance').click(function() {
    if ($(this).val() === '1') {
        $('#target-Quality_Assurance').slideDown('slow');
        $('#insurance_policy_doc').prop('required', true);
    } else {
        $('#target-Quality_Assurance').slideUp('slow');
        $('#insurance_policy_doc').prop('required', false);
    }
  });
  
  $('.toggle-worker_competency').click(function() {
    if ($(this).val() === '1') {
      $('#target-worker_competency').slideDown('slow');
      $('#verify_worker_competency_doc').prop('required', true);
    } else {
      $('#target-worker_competency').slideUp('slow');
      $('#verify_worker_competency_doc').prop('required', false);
    }
  });
  
  $('.toggle-organisation_docs').click(function() {
    if ($(this).val() === '1') {
      $('#target-organisation_docs').slideDown('slow');
      $('#organisation_insurances_licences_qualifications_doc').prop('required', true);
    } else {
      $('#target-organisation_docs').slideUp('slow');
      $('#organisation_insurances_licences_qualifications_doc').prop('required', false);
    }
  });
  
  $('.toggle-been_fined').click(function() {
    if ($(this).val() === '1') {
      $('#target-been_fined').slideDown('slow');
      $('#prosecuted_issue_doc').prop('required', true);
    } else {
      $('#target-been_fined').slideUp('slow');
      $('#prosecuted_issue_doc').prop('required', false);
    }
  });
  
  $('.toggle-under_investigation').click(function() {
    if ($(this).val() === '1') {
      $('#target-under_investigation').slideDown('slow');
      $('#under_investigation_environmental_laws_doc').prop('required', true);
    } else {
      $('#target-under_investigation').slideUp('slow');
      $('#under_investigation_environmental_laws_doc').prop('required', false);
    }
  });
  
  $('.toggle-criminal_offence').click(function() {
    if ($(this).val() === '1') {
      $('#target-criminal_offence').slideDown('slow');
      $('#company_officers_criminal_offence_doc').prop('required', true);
    } else {
      $('#target-criminal_offence').slideUp('slow');
      $('#company_officers_criminal_offence_doc').prop('required', false);
    }
  });
  
  $('.toggle-mgt_procedures').click(function() {
    if ($(this).val() === '1') {
      $('#target-mgt_procedures').slideDown('slow');
      $('#procedures_systems_doc').prop('required', true);
    } else {
      $('#target-mgt_procedures').slideUp('slow');
      $('#procedures_systems_doc').prop('required', false);
    }
  });
  
  $('.toggle-workforce').click(function() {
    if ($(this).val() === '1') {
      $('#target-workforce').slideDown('slow');
      $('#staff_qualified_administering_first_aid_doc').prop('required', true);
    } else {
      $('#target-workforce').slideUp('slow');
      $('#staff_qualified_administering_first_aid_doc').prop('required', false);
    }
  });
  
  $('.toggle-returns_policy').click(function() {
    if ($(this).val() === '1') {
      $('#target-returns_policy').slideDown('slow');
      $('#materials_return_credit_policy_doc').prop('required', true);
    } else {
      $('#target-returns_policy').slideUp('slow');
      $('#materials_return_credit_policy_doc').prop('required', false);
    }
  });
  
  $('.toggle-trade_references').click(function() {
    if ($(this).val() === '1') {
      $('#target-trade_references').slideDown('slow');
      $('#trade_references_doc').prop('required', true);
    } else {
      $('#target-trade_references').slideUp('slow');
      $('#trade_references_doc').prop('required', false);
    }
  });
  
  
    
    $('#insurance_policy_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
    
    $('#verify_worker_competency_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
    
    $('#organisation_insurances_licences_qualifications_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
    
    $('#prosecuted_issue_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
    
    $('#under_investigation_environmental_laws_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
    
    $('#company_officers_criminal_offence_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
    
    $('#procedures_systems_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
    
    $('#staff_qualified_administering_first_aid_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
    
    $('#materials_return_credit_policy_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
    
    $('#trade_references_doc').on('change', function() {
        var files = $(this)[0].files;
        var maxSize = 4 * 1024 * 1024; // 4 MB (you can adjust this value)

        // Check the number of selected files
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 files.');
            // Clear the file input
            $(this).val('');
            return;
        }

        // Check the size of each selected file
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('File size should not exceed 4 MB.');
                // Clear the file input
                $(this).val('');
                return;
            }
        }
    });
  
});

</script>
    @endsection
