@extends('front.layouts.app')

@section('content')
<style>
    .review-checklist-QA .answer-wrap input {
    margin: 5px;
}
.uploadSize{color:red;}

</style>
<div class="multi-form-sections">

<h1 class="fs-title" style="text-align:center">SUPPLIER / CONTRACTOR EVALUATION</h1>

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
      <form name="suppliercontractorevalution" id="msform" class="multistep-forms form1" method="POST" action="{{route('supplierContractorEvalutionSave')}}" enctype="multipart/form-data">
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
              <label>Inspected by:</label>
              <input type="text" name="inspected_by">
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
              <th colspan="4" class="main-th">Evaluation Criteria</th>
            </tr>
          </table>
          <div class="review-checklist-QA">
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>1. Does your company have a certified quality, safety or environmental management system? If Yes
                  please attach copies of certificates and management system index.</p>

                <div id="firstq-certified_quality" class="answer-wrap">
                  <input type="radio" id="certified-yes" name="certified_quality" class="toggle-certified_quality" value="1"><label for="yes">Yes</label>
                  <input type="radio" id="certified-no" class="toggle-certified_quality" name="certified_quality" value="0"><label for="no">No</label>
                  <input type="radio" id="certified-notapplicable" class="toggle-certified_quality" name="certified_quality" value="2"><label for="notapplicable">Not Applicable</label><br>
                </div>
                <div id="target-certified_quality" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input"> 
                      <input type="file" name="certified_quality_doc[]" id="certified_quality_doc" multiple />
                      <label for="certified_quality_doc">
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
                <p>2. Is there a published Quality Assurance; Safety; Environmental Policy? If Yes, please attach copies
                  of relevant policies.</p>

                <div id="secq-Quality_Assurance" class="answer-wrap">
                  <input type="radio" id="certified-yes" name="quality_assurance" class="toggle-Quality_Assurance"
                    value="1"><label for="yes">Yes</label>
                  <input type="radio" id="certified-no" name="quality_assurance" class="toggle-Quality_Assurance" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="certified-notapplicable" name="quality_assurance" class="toggle-Quality_Assurance" value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-Quality_Assurance" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>

                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" name="quality_assurance_doc[]" id="quality_assurance_doc" multiple />
                      <label for="quality_assurance_doc">
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
                <p>3. Is there a documented WHSMP, risk assessments, SWMS, ITP and an EMP for company operations?</p>
                <div id="thirdq-company_operations" class="answer-wrap">
                  <input type="radio" id="company_operations-yes" name="whsmp_risk_assessments" value="1">
                    <label for="yes">Yes</label>
                    <input type="radio" id="company_operations-no" name="whsmp_risk_assessments" value="0">
                    <label for="no">No</label>
                    <input type="radio" id="company_operations-notapplicable" name="whsmp_risk_assessments"
                    value="2">
                    <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>4. Are there documented Quality, WHS and Environmental management procedures that are known to all
                  employees?</p>

                <div id="forthq-documented_Quality" class="answer-wrap">
                  <input type="radio" id="documented_Quality-yes" name="quality_whs_environmental" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="documented_Quality-no" name="quality_whs_environmental" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="documented_Quality-notapplicable" name="quality_whs_environmental"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>5. Are there elected employee Health and Safety Representatives?</p>

                <div id="fifthq-elected_employee" class="answer-wrap">
                  <input type="radio" id="elected_employee-yes" name="elected_employee_health_safety" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="elected_employee-no" name="elected_employee_health_safety" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="elected_employee-notapplicable" name="elected_employee_health_safety"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>6. Have quality, safety and environmental roles, responsibilities and authorities been defined?</p>

                <div id="sixthq-safety_roles" class="answer-wrap">
                  <input type="radio" id="safety_roles-yes" name="quality_safety_environmental_responsibilities" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="safety_roles-no" name="quality_safety_environmental_responsibilities" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="safety_roles-notapplicable" name="quality_safety_environmental_responsibilities" value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>7. Are all personnel inducted and trained for their work activities?</p>

                <div id="seventhq-inducted_trained" class="answer-wrap">
                  <input type="radio" id="inducted_trained-yes" name="personnel_inducted" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="inducted_trained-no" name="personnel_inducted" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="inducted_trained-notapplicable" name="personnel_inducted"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>8. Does your company verify worker competency? If so, how?</p>

                <div id="eighthq-worker_competency" class="answer-wrap">
                  <input type="radio" id="worker_competency-yes" name="verify_worker_competency"
                    class="toggle-worker_competency" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="worker_competency-no" name="verify_worker_competency" class="toggle-worker_competency" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="worker_competency-notapplicable" name="verify_worker_competency" class="toggle-worker_competency"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-worker_competency" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>

                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="verify_worker_competency_doc" name="verify_worker_competency_doc[]" multiple />
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
                <p>9. Are safety meetings regularly conducted and documented?</p>

                <div id="ninethq-safety_meetings" class="answer-wrap">
                  <input type="radio" id="safety_meetings-yes" name="safety_meetings_regularly_conducted" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="safety_meetings-no" name="safety_meetings_regularly_conducted" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="safety_meetings-notapplicable" name="safety_meetings_regularly_conducted"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>10. Does the organisation have appropriate insurances, licences and qualifications? Provide copies.
                </p>

                <div id="tenthq-organisation_docs" class="answer-wrap">
                  <input type="radio" id="organisation_docs-yes" name="organisation_insurances_licences_qualifications"
                    class="toggle-organisation_docs" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="organisation_docs-no" name="organisation_insurances_licences_qualifications" class="toggle-organisation_docs" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="organisation_docs-notapplicable" name="organisation_insurances_licences_qualifications" class="toggle-organisation_docs"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-organisation_docs" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="organisation_insurances_licences_qualifications_doc" name="organisation_insurances_licences_qualifications_doc[]" multiple />
                      <label for="file">
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
                <p>11. Do your personnel have the required licences, training, qualifications and/ or competencies to
                  perform the work?</p>
                <div id="eleventhq-safety_meetings" class="answer-wrap">
                  <input type="radio" id="safety_meetings-yes" name="personnel_licences_qualifications" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="safety_meetings-no" name="personnel_licences_qualifications" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="safety_meetings-notapplicable" name="personnel_licences_qualifications"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>12. Has your organisation previously been fined, prosecuted, issued with a prohibition or improvement
                  notice by the applicable Safety or environmental regulator? If ‘Yes’, please provide details.</p>

                <div id="twelvethq-been_fined" class="answer-wrap">
                  <input type="radio" id="been_fined-yes" name="prosecuted_issue" class="toggle-been_fined" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="been_fined-no" name="prosecuted_issue" class="toggle-been_fined" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="been_fined-notapplicable" name="prosecuted_issue" class="toggle-been_fined" value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-been_fined" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="prosecuted_issue_doc" name="prosecuted_issue_doc[]" multiple />
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
                <p>13. Is your company currently under investigation for a breach of safety and/or environmental laws? if yes, specify. </p>
                <div id="thirteenthq-under_investigation" class="answer-wrap">
                  <input type="radio" id="under_investigation-yes" name="under_investigation_environmental_laws"
                    class="toggle-under_investigation" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="under_investigation-no" class="toggle-under_investigation" name="under_investigation_environmental_laws" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="under_investigation-notapplicable" class="toggle-under_investigation" name="under_investigation_environmental_laws"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-under_investigation" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="under_investigation_environmental_laws_doc" name="under_investigation_environmental_laws_doc[]" multiple />
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
                <p>14. Have any of your company officers previously been charged or convicted of a criminal offence? If
                  Yes, please specify.</p>
                <div id="fourteenthq-criminal_offence" class="answer-wrap">
                  <input type="radio" id="criminal_offence-yes" name="company_officers_criminal_offence" class="toggle-criminal_offence"
                    value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="criminal_offence-no" name="company_officers_criminal_offence" class="toggle-criminal_offence" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="criminal_offence-notapplicable" name="company_officers_criminal_offence" class="toggle-criminal_offence"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-criminal_offence" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="company_officers_criminal_offence_doc" name="company_officers_criminal_offence_doc[]" multiple />
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
                <p>15. Does the company have the necessary resources to fulfill potential work requirements?</p>
                <div id="fifteenthq-necessary_resources" class="answer-wrap">
                  <input type="radio" id="necessary_resources-yes" name="company_necessary_resources" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="necessary_resources-no" name="company_necessary_resources" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="necessary_resources-notapplicable" name="company_necessary_resources"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>16. Does the company have procedures / systems in place for the management and supervision of their
                  workers and/or contractors? If Yes, please specify and provide examples.</p>

                <div id="sixteenthq-mgt_procedures" class="answer-wrap">
                  <input type="radio" id="mgt_procedures-yes" name="procedures_systems" class="toggle-mgt_procedures"
                    value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="mgt_procedures-no" name="procedures_systems" class="toggle-mgt_procedures" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="mgt_procedures-notapplicable" name="procedures_systems" class="toggle-mgt_procedures" value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-mgt_procedures" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="procedures_systems_doc" name="procedures_systems_doc[]" multiple />
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
                <p>17. Are any of your staff qualified in administering First Aid? If ‘Yes’, what % of your workforce?
                </p>
                <div id="seventhq-workforce" class="answer-wrap">
                  <input type="radio" id="workforce-yes" name="staff_qualified_administering_first_aid" class="toggle-workforce" value="1">
                    <label for="yes">Yes</label>
                    <input type="radio" id="workforce-no" name="staff_qualified_administering_first_aid" class="toggle-workforce" value="0">
                    <label for="no">No</label>
                    <input type="radio" id="workforce-notapplicable" name="staff_qualified_administering_first_aid" class="toggle-workforce" value="2">
                    <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-workforce" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" id="staff_qualified_administering_first_aid_doc" name="staff_qualified_administering_first_aid_doc[]" multiple />
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
                <p>18. If supplying materials, products, plant or equipment do you have a returns and/or credit policy?
                  If ‘Yes’, please provide a copy.</p>
                <div id="eighteenthq-returns_policy" class="answer-wrap">
                  <input type="radio" id="returns_policy-yes" name="materials_return_credit_policy" class="toggle-returns_policy"
                    value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="returns_policy-no" name="materials_return_credit_policy" class="toggle-returns_policy" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="returns_policy-notapplicable" name="materials_return_credit_policy" class="toggle-returns_policy" value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-returns_policy" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" name="materials_return_credit_policy_doc[]" id="materials_return_credit_policy_doc" multiple  />
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
                <p>19. Does your organisation use Inspection and Test Processes to ensure materials and/or workmanship
                  meet specified requirements? </p>
                <div id="ninteenthq-inspection_processes" class="answer-wrap"> 
                  <input type="radio" id="inspection_processes-yes" name="organisation_inspection" value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="inspection_processes-no" name="organisation_inspection" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="inspection_processes-notapplicable" name="organisation_inspection"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                <p>20. Provide details of three trade references that we may contact to get more information about your
                  company</p>
                <div id="twentythq-trade_references" class="answer-wrap">
                  <input type="radio" id="trade_references-yes" name="trade_references" class="toggle-trade_references"
                    value="1">
                  <label for="yes">Yes</label>
                  <input type="radio" id="trade_references-no" name="trade_references" class="toggle-trade_references" value="0">
                  <label for="no">No</label>
                  <input type="radio" id="trade_references-notapplicable" class="toggle-trade_references" name="trade_references"
                    value="2">
                  <label for="notapplicable">Not Applicable</label>
                </div>
                <div id="target-trade_references" class="target">
                  <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                      Upload File
                    </label>
                    <div class="formbold-mb-5 formbold-file-input">
                      <input type="file" name="trade_references_doc[]" id="trade_references_doc" multiple />
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
              <th colspan="4" class="main-th">By signing here below I hereby acknowledge that the answers I have
                provided on behalf of the supplier / contractororganisation are true, accurate and correct</th>
            </thead>
            <thead>
              <th>Name</th>
              <th>Position</th>
              <th>Signature</th>
              <th>Date</th>
            </thead>
            <tbody>
              <tr>
                <td data-label="name">
                  <div class="form-group">
                    <input type="text" name="supplier_name">
                  </div>
                </td>
                <td data-label="Position">
                  <div class="form-group">
                    <input type="text" name="supplier_position">
                  </div>
                </td>
                <td data-label="Signature">
                    
                    <div class="form-group">
					<canvas width="400" height="100" id="signatureCanvas"></canvas>
					<div id="signaturebox"></div>
                <button type="button" id="clearButton" class="clearButton">Clear</button>
				<input type="hidden" id="supplier_signature" name="supplier_signature">
					</div>
                  
                </td>
                <td data-label="Date">
                  <div class="form-group">
                    <input type="date" id="supplier_date" name="supplier_date">
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
          <h2 class="fs-title">Evaluation & Recommendations</h2>

          <table class="table">
            <thead class="main-thead">
              <th colspan="3" class="main-th">To be completed by Management and submitted to Director for Approval</th>
            </thead>
            <tbody>
              <tr>
                <td data-label="evaluation_description">
                  <div class="form-group">
                    <textarea id="evaluation_description" name="evaluation_description" rows="4" cols="50"></textarea>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
          <h2 class="fs-title">Organisation sign-off</h2>

          <table class="table">
            <thead>
              <th>Approved / Rejected:</th>
              <th>Reasons</th>
              <th>Name</th>
              <th>Position</th>
              <th>Date</th>
            </thead>
            <tbody>
              <tr>
                <td data-label="Approved-Rejected">
                  <div class="form-group">
                    <input type="text" name="organisation_approved">
                  </div>
                </td>
                <td data-label="Reasons">
                  <div class="form-group">
                    <input type="text" name="organisation_reason">
                  </div>
                </td>
                <td data-label="Name">
                  <div class="form-group">
                    <input type="text" name="organisation_name">
                  </div>
                </td>
                <td data-label="Position">
                  <div class="form-group">
                    <input type="text" name="organisation_position">
                  </div>
                </td>
                <td data-label="Date">
                  <div class="form-group">
                    <input type="date" id="organisation_date" name="organisation_date">
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
    <script src="{{asset('public/front/js/suppliercontractorevalution.js')}}"></script>

<script type="text/javascript">	
// Wait for the document to be ready
$(document).ready(function() {
  $('.toggle-certified_quality').click(function() {
    if ($(this).val() === '1') {
        $('#target-certified_quality').slideDown('slow');
        $('#certified_quality_doc').prop('required', true);
    } else {
        $('#target-certified_quality').slideUp('slow');
        $('#certified_quality_doc').prop('required', false);
    }
  });
  
  
  $('.toggle-Quality_Assurance').click(function() {
    if ($(this).val() === '1') {
        $('#target-Quality_Assurance').slideDown('slow');
        $('#quality_assurance_doc').prop('required', true);
    } else {
        $('#target-Quality_Assurance').slideUp('slow');
        $('#quality_assurance_doc').prop('required', false);
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
  
  
  $('#certified_quality_doc').on('change', function() {
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
    
    $('#quality_assurance_doc').on('change', function() {
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
