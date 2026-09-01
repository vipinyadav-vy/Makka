@extends('front.layouts.app')

@section('content')

<div class="multi-form-sections">

<h1 class="fs-title" style="text-align:center">Site Induction Record</h1>

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

      <form name="msform" id="msform" class="multistep-forms form1" method="POST" action="{{route('siteInductionRecordSave')}}" enctype="multipart/form-data">
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
          <!-- <li></li> -->
        </ul>
        <!-- fieldsets -->
        <fieldset class="firstStep">
          <h2 class="fs-title">Project details</h2>
          <div class="form-group">
            <label>Project / Site:</label>
            <select name="project" id="project">
            <option value="">Select Project</option>
             <?php if($projects){
              foreach($projects as $projectsVal){ ?> 
                <option value="<?php echo $projectsVal->id; ?> "><?php echo $projectsVal->name; ?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Site Induction Number:</label>
            <?php
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

// Shuffle the characters and select the first 8 to generate the random string
$random_string = substr(str_shuffle($characters), 0, 8);


            ?>
            <input type="text" name="inductionNumber" value="<?php echo $random_string; ?>" maxlength="250" readonly>
          </div>
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset class="secondStep">
          <h2 class="fs-title">Inductee details</h2>
          <div class="form-group">
            <label>Name of worker inducted:</label>
            <input type="text" name="workerName" maxlength="250">
          </div>
          <div class="form-group">
            <label>Address:</label>
            <textarea name="workerAddress" class="form-control" rows="4" maxlength="500"></textarea>
          </div>
          <div class="form-group">
            <label>Contact No.:</label>
            <input type="text" name="phone_no" maxlength="10">
          </div>
          <div class="form-group">
          <label>Identification Type.: </label>
            <select name="identityType" id="identityType">
            <option value="">Select Identity</option>
              <option value="Driver Licence">Driver Licence</option>
              <option value="Passport">Passport</option>
              <option value="Others">Others</option>
            </select>
            <div id="otherIdentity"></div>
            <label>Identification No.: </label>
            <span>(e.g. driver licence, passport)</span>
            <input type="text" name="identityNo"  maxlength="250" >
          </div>
          <div class="form-group">
            <label>Attach the photo of the selected document: </label>
            <input type="file" name="imageDocument" id="imageDocument" onchange="readURL(this);" accept="image/png, image/gif, image/jpeg">
            <input type="hidden" id="identityDocument" name="identityDocument" >
          </div>
          <div class="form-group">
            <label>General Construction Induction Card No.:</label>
            <span>(to be verified by inductor)</span>
            <input type="text" name="inductionCardNo"  maxlength="250" >
          </div>
          <div class="form-group">
            <label>Trade / Occupation:</label>
            <input type="text" name="occupation"  maxlength="250" >
          </div>
          <div class="form-group">
            <label>Qualifications / Tickets / Licences: </label>
            <span>(to be verified by inductor)</span>
            <input type="text" name="qualification"  maxlength="250" >
          </div>
          <div class="form-group slide2checkbox">
            <label>Are you an Australian Citizen / Resident:</label>
            <div class="slide2check">
              <div class="slide2check1">
                <input type="radio" name="citizen" value="1">
                <span>Yes</span>
              </div>
              <div class="slide2check2">
                <input type="radio" name="citizen" value="0">
                <span>No – If no, what is your work via type:</span>
              </div>
              <div id="otherCitizen"></div>
            </div>
          </div>
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset class="thirdStep">
          <h2 class="fs-title">Employer details</h2>
          <div class="form-group">
            <label>Who is your employer / write </label>
            <span>(i.e. who pays your wages / Type N/A if self-employed)</span>
            <input type="text" name="employerName"  maxlength="250" >
          </div>
          <div class="form-group">
            <label>What is your ABN </label>
            <span>(if self-employed / Type N/A if you are working other company)</span>
            <input type="text" name="abnNumber"  maxlength="250" >
          </div>
          <div class="form-group">
            <label>Employer Representative:</label>
            <input type="text" name="employerrepresentative"  maxlength="250" >
          </div>
          <div class="form-group">
            <label>Employer Contact No.:</label>
            <input type="text" name="employerPhone"  maxlength="10" >
          </div>
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Induction Agenda Items</h2>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Site management personnel – informed of site managers, supervisors, representatives</label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="siteManagement" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Site hours of operation and security requirements</label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="siteHours" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Site safety rules – taken through site safety rules </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="siteSafety" value="1">
              </div>
            </div>
          </div>
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title"> Site Induction Record</h2>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Minimum PPE required for the site – Hard hat, high-vis clothing, safety boots </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="minimumPpe" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>WHS Management Plan – show a copy explain that it is available on site to be viewed if requested </label>
              </div>
              <div class="slide4check">
                <input type="checkbox"  name="whsManagementPlan" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Health & Safety Representatives / Committees – informed of who they are (if applicable) </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="healthSafetyRepresentatives" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Worker duties – explained each worker has a legal duty to: </label>
                <span>
                  <ul>
                    <li> take reasonable care for his/ her own health and safety while on site; and </li>
                    <li> take reasonable care that his/ her actions do not create a danger to another worker / persons health and safety on the site; and </li>
                    <li> comply with any reasonable instruction given by site management representative or his/ her employer about health and safety on the site </li>
                    <li> Safety is everyone’s responsibility so we can all be safe at work and go home to our families </li>
                  </ul>
                </span>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="workerDuties" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>First Aid – informed who First Aid officers are + location of first aid equipment / facilities </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="firstAid" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Emergency response – informed who emergency wardens are + firefighting equipment and locations on the site </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="emergencyResponse" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Emergency evacuation procedures – explained </label>
                <span>
                  <ul>
                    <li> Emergency evacuation alerts – e.g. horn, speaker phone </li>
                    <li> Assembly points / evacuation routes </li>
                    <li> Emergency evacuation procedures </li>
                    <li> Where emergency evacuation information is displayed </li>
                  </ul>
                </span>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="emergencyEvacuation" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Traffic management – informed of any designated parking areas + flow of traffic / trucks / mobile plant in and out of the site </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="trafficManagement" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Exclusion zones – informed of the requirements to follow any designated exclusion zones and not to enter those zones unless they are authorised to do so. </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="exclusiveZones" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Mobile plant – beware of mobile plant on the site (e.g. forklifts, excavators, cranes) and stay out their way at all times. </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="mobilePlant" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Scaffold safety - informed of the requirements not to tamper with scaffold under any circumstances (e.g. do not remove any scaffold parts) + follow safe working loads of the scaffold. </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="scaffoldSafety" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Site amenities – e.g. toilet, drinking water facilities, lunchroom (if applicable) </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="siteAmenities" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Site access and exit points – informed of location </label>
              </div>
              <div class="slide4check">
                <input type="checkbox"  name="siteAccess" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Daily sign-in / out register – informed of requirements to sign in & out each day using applicable register + its location </label>
              </div>
              <div class="slide4check">
                <input type="checkbox"  name="dailySign" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Site noticeboard – informed of location of site noticeboard and workers responsibility to review it daily for important updates about the site </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="siteNoticeboard" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Site no smoking policy – explained that no smoking is permitted whilst on the site </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="siteNoSmoking" value="1">
              </div>
            </div>
          </div>
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Site Induction Record</h2>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Site drug and alcohol policy – explained that no worker is allowed to be working on the site if they are under the influence of drugs or alcohol </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="siteDrug" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Site violence, bullying and harassment policy – explained that any violence, bullying or harassment is not allowed and will not be tolerated on the site </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="siteViolence" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Hazard + incident reporting process – explained of that workers must report all hazards incidents, injuries to site management personnel immediately. </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="hazardIncidentReport" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Stop Work Policy – explained that workers are to stop work immediately if they feel unsafe and report it to site management representative. </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="stopWorkPolicy" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Induction to SWMS, safety procedures / instructions relevant to work / job – worker informed that they must be inducted on their employer’s SWMS + any other applicable safety procedures BEFORE they start work on the site </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="swmsSafety" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Housekeeping – workers to maintain a clean work site (clean up after themselves daily) </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="housekeepingPolicy" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Electrical safety – all electrical equipment / tools to be tested & tagged (every 3 months) + be connected to RCD when being used on site + electrical leads to be elevated on stands </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="electricSafety" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>Non-compliance with any site requirements / rules – informed that if found to be breaching any of the site rules or requirements may face disciplinary action including being banned from site. </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="nonCompliance" value="1">
              </div>
            </div>
          </div>
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Confirmation by inductee</h2>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>I confirm that I have received, and been inducted into, the Safe Work Method Statements and any other applicable safe work procedures / instructions provided to me, by my employer. </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="safeWorkMethodConfirmation" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>I confirm that I have the necessary skills, training, qualifications and/or experience to carry out the work/ job on the site. </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="skillsConfirmation" value="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="slide4checkbox">
              <div class="slide4label">
                <label>I confirm that I am able to speak, read and write English OR I have had the site induction translated / explained to me in a language that I can understand. </label>
              </div>
              <div class="slide4check">
                <input type="checkbox" name="englishConfirmation" value="1">
              </div>
            </div> 
          </div>
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Declaration by inductee</h2>
          <h3 class="fs-subtitle last-slide-text">I acknowledge that I have been advised on all of the above listed items and understand the points discussed. I hereby agree to follow the site policies, procedures, rules, and special conditions outlined during the site induction or that are in place from time to time. I accept that compliance to safe work practices is a condition of my continued access to the site and also a requirement under the health and safety legislation. I will also comply with any reasonable instruction given to me by site management or their representatives.</h3>
            <div class="row declarationSection">
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Inductee’s Name </label>
                <input type="text" name="inducteeName"  maxlength="250" >
                <div id="inducteeNameErr"></div>
              </div>
              <div class="form-group">
                <label>Date </label>
                <input type="date" name="applyDate" id="applyDate">
                <div id="applyDateErr"></div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Signature </label>
                <canvas id="signatureCanvas"></canvas>
                <div id="signaturebox"></div>
                <button type="button" id="clearButton" class="clearButton">Clear</button>
                <input type="hidden" id="inducteeSignature" name="inducteeSignature">
              </div>
            </div>
            </div>
          <input type="button" name="previous" class="previous clearButton action-button" value="Previous" />
          <input type="button" name="next" class="signatureSection  action-button" value="Overview" />
        </fieldset>
        <fieldset>
          <h2 class="fs-title">Overview</h2>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-overview-left">
                  <table width="100%">
                    <tr>
                      <th>Title </th>
                      <th></th>
                    </tr>
                  <tr>  
                    <td> Project / Site:</td>
                    <td class="viewProject"></td>
                  </tr>
                  <tr>
                    <td> Site Induction Number:</td>
                    <td class="viewinductionNumber"> </td>
                  </tr>
                  <tr>
                    <td> Name of worker inducted:</td>
                    <td class="viewWorkerName"> </td>
                  </tr>
                  <tr>
                    <td> Address:</td>
                    <td class="viewWorkerAddress"> </td>
                  </tr>
                  <tr>
                    <td> Contact No.:</td>
                    <td class="viewphone_no"> </td>
                  </tr>
                  <tr>
                    <td> Identification Type.:</td>
                    <td class="viewidentityType"> </td>
                  </tr>
                  <tr>
                    <td> Identification No.:</td>
                    <td class="viewidentityNo"> </td>
                  </tr>
                  
                  <tr>
                    <td> Identification Document.:</td>
                    <td><img id="blah" src="#" /></td>
                  </tr>
                  <tr>
                    <td> General Construction Induction Card No.:</td>
                    <td class="viewinductionCardNo"> </td>
                  </tr>
                  <tr>
                    <td> Trade / Occupation:</td>
                    <td class="viewoccupation"> </td>
                  </tr>
                  <tr>
                    <td> Qualifications / Tickets / tdcences:</td>
                    <td class="viewqualification"> </td>
                  </tr>
                  <tr>
                    <td> Are you an Austratdan Citizen / Resident:</td>
                    <td class="viewCitizen"> </td>
                  </tr>
                  <tr>
                    <td> Who is your employer</td>
                    <td class="viewemployerName"> </td>
                  </tr>
                  <tr>
                    <td> What is your ABN</td>
                    <td class="viewabnNumber"> </td>
                  </tr>
                  <tr>
                    <td> Employer Representative:</td>
                    <td class="viewemployerrepresentative"> </td>
                  </tr>
                  <tr>
                    <td> Contact No.:</td>
                    <td class="viewemployerPhone"> </td>
                  </tr>
                  <tr>
                    <td> Site management personnel – informed of site managers, supervisors, representatives</td>
                    <td class="viewsiteManagement"> </td>
                  </tr>
                  <tr>
                    <td> Site hours of operation and security requirements</td>
                    <td class="viewsiteHours"> </td>
                  </tr>
                  <tr>
                    <td> Site safety rules – taken through site safety rules</td>
                    <td class="viewsiteSafety"> </td>
                  </tr>
                  <tr>
                    <td> Minimum PPE required for the site – Hard hat, high-vis clothing, safety boots</td>
                    <td class="viewminimumPpe"> </td>
                  </tr>
                  <tr>
                    <td> WHS Management Plan – show a copy explain that it is available on site to be viewed if requested</td>
                    <td class="viewwhsManagementPlan"> </td>
                  </tr>
                  <tr>
                    <td> Health & Safety Representatives / Committees – informed of who they are (if apptdcable)</td>
                    <td class="viewhealthSafetyRepresentatives"> </td>
                  </tr>
                  <tr>
                    <td> Worker duties – explained each worker has a legal duty to:</td>
                    <td class="viewworkerDuties"> </td>
                  </tr>
                  <tr>
                    <td> First Aid – informed who First Aid officers are + location of first aid equipment / facitdties</td>
                    <td class="viewfirstAid"> </td>
                  </tr>
                  <tr>
                    <td> Emergency response – informed who emergency wardens are + firefighting equipment and locations on the site</td>
                    <td class="viewemergencyResponse"> </td>
                  </tr>
                  <tr>
                    <td> Emergency evacuation procedures – explained</td>
                    <td class="viewemergencyEvacuation"> </td>
                  </tr>
                  <tr>
                    <td> Traffic management – informed of any designated parking areas + flow of traffic / trucks / mobile plant in and out of the site</td>
                    <td class="viewtrafficManagement"> </td>
                  </tr>
                  <tr>
                    <td> Exclusion zones – informed of the requirements to follow any designated exclusion zones and not to enter those zones unless they are authorised to do so.</td>
                    <td class="viewexclusiveZones"> </td>
                  </tr>
                  <tr>
                    <td> Mobile plant – beware of mobile plant on the site (e.g. forktdfts, excavators, cranes) and stay out their way at all times.</td>
                    <td class="viewmobilePlant"> </td>
                  </tr>
                  <tr>
                    <td> Scaffold safety - informed of the requirements not to tamper with scaffold under any circumstances (e.g. do not remove any scaffold parts) + follow safe working loads of the scaffold.</td>
                    <td class="viewscaffoldSafety"> </td>
                  </tr>
                  <tr>
                    <td> Site amenities – e.g. toilet, drinking water facitdties, lunchroom (if apptdcable)</td>
                    <td class="viewsiteAmenities"> </td>
                  </tr>
                  <tr>
                    <td> Site access and exit points – informed of location</td>
                    <td class="viewsiteAccess"> </td>
                  </tr>
                  <tr>
                    <td> Daily sign-in / out register – informed of requirements to sign in & out each day using apptdcable register + its location</td>
                    <td class="viewdailySign"> </td>
                  </tr>
                  <tr>
                    <td> Site noticeboard – informed of location of site noticeboard and workers responsibitdty to review it daily for important updates about the site</td>
                    <td class="viewsiteNoticeboard"> </td>
                  </tr>
                  <tr>
                    <td> Site no smoking potdcy – explained that no smoking is permitted whilst on the site</td>
                    <td class="viewsiteNoSmoking"> </td>
                  </tr>
                  <tr>
                    <td> Site drug and alcohol potdcy – explained that no worker is allowed to be working on the site if they are under the influence of drugs or alcohol</td>
                    <td class="viewsiteDrug"> </td>
                  </tr>
                  <tr>
                    <td> Site violence, bullying and harassment potdcy – explained that any violence, bullying or harassment is not allowed and will not be tolerated on the site</td>
                    <td class="viewsiteViolence"> </td>
                  </tr>
                  <tr>
                    <td> Hazard + incident reporting process – explained of that workers must report all hazards incidents, injuries to site management personnel immediately.</td>
                    <td class="viewhazardIncidentReport"> </td>
                  </tr>
                  <tr>
                    <td> Stop Work Potdcy – explained that workers are to stop work immediately if they feel unsafe and report it to site management representative.</td>
                    <td class="viewstopWorkPolicy"> </td>
                  </tr>
                  <tr>
                    <td> Induction to SWMS, safety procedures / instructions relevant to work / job – worker informed that they must be inducted on their employer’s SWMS + any other apptdcable safety procedures BEFORE they start work on the site</td>
                    <td class="viewswmsSafety"> </td>
                  </tr>
                  <tr>
                    <td> Housekeeping – workers to maintain a clean work site (clean up after themselves daily)</td>
                    <td class="viewhousekeepingPolicy"> </td>
                  </tr>
                  <tr>
                    <td> Electrical safety – all electrical equipment / tools to be tested & tagged (every 3 months) + be connected to RCD when being used on site + electrical leads to be elevated on stands</td>
                    <td class="viewelectricSafety"> </td>
                  </tr>
                  <tr>
                    <td> Non-compliance with any site requirements / rules – informed that if found to be breaching any of the site rules or requirements may face disciplinary action including being banned from site.</td>
                    <td class="viewnonCompliance"> </td>
                  </tr>
                  <tr>
                    <td> I confirm that I have received, and been inducted into, the Safe Work Method Statements and any other applicable safe work procedures / instructions provided to me, by my employer.</td>
                    <td class="viewsafeWorkMethodConfirmation"> </td>
                  </tr>
                  <tr>
                    <td> I confirm that I have the necessary skills, training, qualifications and/or experience to carry out the work/ job on the site.</td>
                    <td class="viewskillsConfirmation"> </td>
                  </tr>
                  <tr>
                    <td> I confirm that I am able to speak, read and write English OR I have had the site induction translated / explained to me in a language that I can understand.</td>
                    <td class="viewenglishConfirmation"> </td>
                  </tr>
                  <tr>
                    <td>Inductee’s Name</td>
                    <td class="viewInducteeName"> </td>
                  </tr>

                  <tr>
                    <td>Apply Date</td>
                    <td class="viewapplyDate"> </td>
                  </tr>

                  <tr>
                    <td>Signature</td>
                    <td class="viewinducteeSignature">
                      
                  </td>
                  </tr>
                  </table>
                  
                </div>
              </div>
              
            </div>
          </div>
         
          <input type="button" name="previous" class="previous action-button" value="Previous" />
          <input type="submit" name="submit" class="submit action-button" value="Submit" />

        </fieldset>
        
         </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.4/signature_pad.js"></script>
    <script src="{{asset('public/front/js/siteInductionRecord.js')}}"></script>

    @endsection
