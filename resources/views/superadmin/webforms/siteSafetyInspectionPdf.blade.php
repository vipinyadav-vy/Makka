<!DOCTYPE html>
<html>
   <head>
      <title>Site Safety Inspection Record</title>
   </head>
   <body>
      <style>
         table {
            border-collapse: collapse; /* Merge borders for a cleaner look */
            width: 100%;
         }
        .half-column td {
            border: 1px solid #000; /* Add a 1px solid black border */
            padding: 8px; /* Add padding for spacing within cells */
            text-align: left;
            width: 50%; /* Set both columns to equal width */

         }
        .half-column th {
            padding: 8px; /* Add padding for spacing within cells */
            text-align: left;
            width: 50%; /* Set both columns to equal width */

         }
        .third-one .title{
             border: 1px solid #000; /* Add a 1px solid black border */
            padding: 8px; /* Add padding for spacing within cells */
            text-align: left;
            width: 80%; /* Set both columns to equal width */
        }
        .third-one .title-desc{
             border: 1px solid #000; /* Add a 1px solid black border */
            padding: 8px; /* Add padding for spacing within cells */
            text-align: left;
            width: 20%; /* Set both columns to equal width */

        }
        .headlines{
          color: #fff;
          padding: 10px;
        }
        .bootomNone{
            border-bottom: 0px !important;
        }
      </style>
      
      <table class="half-column bootomNone" width="100%" style="border-spacing: 0; border:1px solid #000;">
         <tr>
            <th>
                <img style="width:200px;" src="{{ public_path('front/images/logo.png') }}"/>
                </th>
            <th >
               <h2>Site Safety Inspection</h2>
            </th>
         </tr>
         <tr>
            <td colspan="2" style="padding-left: 0; background-color:gray;"><span class="headlines">Inspection Details</span></td>
         </tr>
         <tr>
            <td>Project/ job reference:</td>
            <td>@if($data->projectname) {{ $data->projectname }} @endif</td>
         </tr>
         <tr> 
            <td> Location:</td>
            <td> @if($data->location) {{ $data->location }} @endif</td>
         </tr>
         <tr>
            <td> Area inspected:</td>
            <td> @if($data->area_inspected) {{ $data->area_inspected }} @endif </td>
         </tr>
         <tr>
            <td> Inspected by:</td>
            <td> @if($data->inspected_by) {{ $data->inspected_by }} @endif </td>
         </tr>
         <tr>
            <td> Date:</td>
            <td> @if($data->date) {{ $data->date }} @endif </td>
         </tr>
           </table>
        <table class="third-one bootomNone" width="100%" style="border-spacing: 0; border:1px solid #000;">
        
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">Inspection Checklist</span></td>
         </tr>
        <tr>
            <td class="title"> Site Documents </td>
            <td class="title-desc"> 
            {{ $data->site_document == 1 ? 'YES' : ($data->site_document == 2 ? 'NO' : ($data->site_document == 0 ? 'N/A' : '')) }}            
         </td>
         </tr>
         @if($data->site_document_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->site_document_comments }} </td>
         </tr>
         @endif
         <tr>
            <td class="title"> Site signage displayed </td>
            <td class="title-desc">  {{ $data->site_signage == 1 ? 'YES' : ($data->site_signage == 2 ? 'NO' : ($data->site_signage == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->site_signage_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->site_signage_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> Safety signs displayed </td>
            <td class="title-desc"> {{ $data->safety_signs == 1 ? 'YES' : ($data->safety_signs == 2 ? 'NO' : ($data->safety_signs == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->safety_signs_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->safety_signs_comments }} </td>
         </tr>
         @endif


         <tr>
            <td class="title"> Mandatory PPE displayed</td>
            <td class="title-desc"> {{ $data->mandatory_ppe == 1 ? 'YES' : ($data->mandatory_ppe == 2 ? 'NO' : ($data->mandatory_ppe == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->mandatory_ppe_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->mandatory_ppe_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> Policies displayed</td>
            <td class="title-desc">  {{ $data->policies == 1 ? 'YES' : ($data->policies == 2 ? 'NO' : ($data->policies == 0 ? 'N/A' : '')) }}  </td>
         </tr>
         @if($data->policies_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->policies_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> Site rules displayed</td>
            <td class="title-desc"> {{ $data->site_rules == 1 ? 'YES' : ($data->site_rules == 2 ? 'NO' : ($data->site_rules == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->site_rules_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->site_rules_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> Emergency information displayed</td>
            <td class="title-desc"> {{ $data->emergency_information == 1 ? 'YES' : ($data->emergency_information == 2 ? 'NO' : ($data->emergency_information == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->emergency_information_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->emergency_information_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> First Aid officers displayed</td>
            <td class="title-desc">{{ $data->first_aid_officers == 1 ? 'YES' : ($data->first_aid_officers == 2 ? 'NO' : ($data->first_aid_officers == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->first_aid_officers_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->first_aid_officers_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> Sign in / our register present</td>
            <td class="title-desc"> {{ $data->sign_in == 1 ? 'YES' : ($data->sign_in == 2 ? 'NO' : ($data->sign_in == 0 ? 'N/A' : '')) }}  </td>
         </tr>
         @if($data->sign_in_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->sign_in_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> Site Security</td>
            <td class="title-desc"> {{ $data->site_security == 1 ? 'YES' : ($data->site_security == 2 ? 'NO' : ($data->site_security == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->site_security_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->site_security_comments }} </td>
         </tr>
         @endif


         <tr>
            <td class="title"> Site fence / hoarding present</td>
            <td class="title-desc">{{ $data->site_fence == 1 ? 'YES' : ($data->site_fence == 2 ? 'NO' : ($data->site_fence == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->site_fence_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->site_fence_comments }} </td>
         </tr>
         @endif


         <tr>
            <td class="title"> Appropriate barricades in place</td>
            <td class="title-desc"> {{ $data->appropriate_barricades == 1 ? 'YES' : ($data->appropriate_barricades == 2 ? 'NO' : ($data->appropriate_barricades == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->appropriate_barricades_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->appropriate_barricades_comments }} </td>
         </tr>
         @endif


         <tr>
            <td class="title"> Site access is controlled</td>
            <td class="title-desc"> {{ $data->site_access == 1 ? 'YES' : ($data->site_access == 2 ? 'NO' : ($data->site_access == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->site_access_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->site_access_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> Public access is controlled</td>
            <td class="title-desc">{{ $data->public_access == 1 ? 'YES' : ($data->public_access == 2 ? 'NO' : ($data->public_access == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->public_access_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->public_access_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> Safe access and egress in place</td>
            <td class="title-desc">{{ $data->safe_access == 1 ? 'YES' : ($data->safe_access == 2 ? 'NO' : ($data->safe_access == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->safe_access_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->safe_access_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> Site Processes</td>
            <td class="title-desc">{{ $data->site_processes == 1 ? 'YES' : ($data->site_processes == 2 ? 'NO' : ($data->site_processes == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->site_processes_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->site_processes_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title"> All workers inducted on site</td>
            <td class="title-desc">{{ $data->all_workers_inducted_on_site == 1 ? 'YES' : ($data->all_workers_inducted_on_site == 2 ? 'NO' : ($data->all_workers_inducted_on_site == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->all_workers_inducted_on_site_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->all_workers_inducted_on_site_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">All workers inducted onto their SWMS / SOPS</td>
            <td class="title-desc">{{ $data->workers_inducted_swms_sops == 1 ? 'YES' : ($data->workers_inducted_swms_sops == 2 ? 'NO' : ($data->workers_inducted_swms_sops == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->workers_inducted_swms_sops_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->workers_inducted_swms_sops_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">All workers have white cards</td>
            <td class="title-desc"> {{ $data->workers_white_cards == 1 ? 'YES' : ($data->workers_white_cards == 2 ? 'NO' : ($data->workers_white_cards == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->workers_white_cards_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->workers_white_cards_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">All workers following site processes</td>
            <td class="title-desc"> {{ $data->workers_following_site_processes == 1 ? 'YES' : ($data->workers_following_site_processes == 2 ? 'NO' : ($data->workers_following_site_processes == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->workers_following_site_processes_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->workers_following_site_processes_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Daily pre-start meetings being held</td>
            <td class="title-desc">{{ $data->daily_pre_start_meetings == 1 ? 'YES' : ($data->daily_pre_start_meetings == 2 ? 'NO' : ($data->daily_pre_start_meetings == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->daily_pre_start_meetings_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->daily_pre_start_meetings_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Toolbox talks regularly conducted</td>
            <td class="title-desc">{{ $data->toolbox_talks_regularly_conducted == 1 ? 'YES' : ($data->toolbox_talks_regularly_conducted == 2 ? 'NO' : ($data->toolbox_talks_regularly_conducted == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->toolbox_talks_regularly_conducted_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->toolbox_talks_regularly_conducted_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Housekeeping</td>
            <td class="title-desc">{{ $data->housekeeping == 1 ? 'YES' : ($data->housekeeping == 2 ? 'NO' : ($data->housekeeping == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->housekeeping_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->housekeeping_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Site generally clean</td>
            <td class="title-desc">{{ $data->site_generally_clean == 1 ? 'YES' : ($data->site_generally_clean == 2 ? 'NO' : ($data->site_generally_clean == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->site_generally_clean_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->site_generally_clean_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Walkways are clear of obstruction</td>
            <td class="title-desc">{{ $data->walkways_clear_obstruction == 1 ? 'YES' : ($data->walkways_clear_obstruction == 2 ? 'NO' : ($data->walkways_clear_obstruction == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->walkways_clear_obstruction_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->walkways_clear_obstruction_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Materials are safely stowed away</td>
            <td class="title-desc"> {{ $data->materials_safely_stowed == 1 ? 'YES' : ($data->materials_safely_stowed == 2 ? 'NO' : ($data->materials_safely_stowed == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->materials_safely_stowed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->materials_safely_stowed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Rubbish and debris is disposed of</td>
            <td class="title-desc"> {{ $data->rubbish_debris_disposed == 1 ? 'YES' : ($data->rubbish_debris_disposed == 2 ? 'NO' : ($data->rubbish_debris_disposed == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->rubbish_debris_disposed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->rubbish_debris_disposed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Slurry, water and dust removed</td>
            <td class="title-desc">{{ $data->slurry_water_dust_removed == 1 ? 'YES' : ($data->slurry_water_dust_removed == 2 ? 'NO' : ($data->slurry_water_dust_removed == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->slurry_water_dust_removed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->slurry_water_dust_removed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Amenities</td>
            <td class="title-desc">{{ $data->amenities == 1 ? 'YES' : ($data->amenities == 2 ? 'NO' : ($data->amenities == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->amenities_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->amenities_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Sufficient toilets / bubblers provided</td>
            <td class="title-desc"> {{ $data->sufficient_toilets_bubblers_provided == 1 ? 'YES' : ($data->sufficient_toilets_bubblers_provided == 2 ? 'NO' : ($data->sufficient_toilets_bubblers_provided == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->sufficient_toilets_bubblers_provided_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->sufficient_toilets_bubblers_provided_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Lunchroom and facilities provided</td>
            <td class="title-desc">{{ $data->lunchroom_facilities_provided == 1 ? 'YES' : ($data->lunchroom_facilities_provided == 2 ? 'NO' : ($data->lunchroom_facilities_provided == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->lunchroom_facilities_provided_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->lunchroom_facilities_provided_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Amenities are clean and tidy</td>
            <td class="title-desc"> {{ $data->amenities_clean_tidy == 1 ? 'YES' : ($data->amenities_clean_tidy == 2 ? 'NO' : ($data->amenities_clean_tidy == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->amenities_clean_tidy_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->amenities_clean_tidy_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Electrical</td>
            <td class="title-desc">{{ $data->electrical == 1 ? 'YES' : ($data->electrical == 2 ? 'NO' : ($data->electrical == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->electrical_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->electrical_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Temporary power boards present</td>
            <td class="title-desc"> {{ $data->temporary_power_boards_present == 1 ? 'YES' : ($data->temporary_power_boards_present == 2 ? 'NO' : ($data->temporary_power_boards_present == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->temporary_power_boards_present_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->temporary_power_boards_present_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Temporary power boards fitted with RCD</td>
            <td class="title-desc"> {{ $data->temporary_power_boards_fitted_rcd == 1 ? 'YES' : ($data->temporary_power_boards_fitted_rcd == 2 ? 'NO' : ($data->temporary_power_boards_fitted_rcd == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->temporary_power_boards_fitted_rcd_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->temporary_power_boards_fitted_rcd_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Temporary power board secured to the ground / base</td>
            <td class="title-desc">{{ $data->temporary_power_board_secured_ground == 1 ? 'YES' : ($data->temporary_power_board_secured_ground == 2 ? 'NO' : ($data->temporary_power_board_secured_ground == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->temporary_power_board_secured_ground_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->temporary_power_board_secured_ground_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Temporary power board compliant with AS/NZS 3012:2010</td>
            <td class="title-desc"> {{ $data->temporary_power_board_compliant_AS_NZS == 1 ? 'YES' : ($data->temporary_power_board_compliant_AS_NZS == 2 ? 'NO' : ($data->temporary_power_board_compliant_AS_NZS == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->temporary_power_board_compliant_AS_NZS_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->temporary_power_board_compliant_AS_NZS_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Electrical equipment has current test tag</td>
            <td class="title-desc">{{ $data->electrical_equipment_current_test_tag == 1 ? 'YES' : ($data->electrical_equipment_current_test_tag == 2 ? 'NO' : ($data->electrical_equipment_current_test_tag == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->electrical_equipment_current_test_tag_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->electrical_equipment_current_test_tag_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Electrical equipment connected to RCDs</td>
            <td class="title-desc"> {{ $data->electrical_equipment_connected_RCD == 1 ? 'YES' : ($data->electrical_equipment_connected_RCD == 2 ? 'NO' : ($data->electrical_equipment_connected_RCD == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->electrical_equipment_connected_RCD_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->electrical_equipment_connected_RCD_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Extension leads have current test tag</td>
            <td class="title-desc"> {{ $data->extension_leads_current_test_tag == 1 ? 'YES' : ($data->extension_leads_current_test_tag == 2 ? 'NO' : ($data->extension_leads_current_test_tag == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->extension_leads_current_test_tag_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->extension_leads_current_test_tag_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Electrical leads are elevated off the ground with lead stands / hooks</td>
            <td class="title-desc">{{ $data->electrical_leads_elevated_ground_lead_stands == 1 ? 'YES' : ($data->electrical_leads_elevated_ground_lead_stands == 2 ? 'NO' : ($data->electrical_leads_elevated_ground_lead_stands == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->electrical_leads_elevated_ground_lead_stands_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->electrical_leads_elevated_ground_lead_stands_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Electrical equipment and leads are in good condition</td>
            <td class="title-desc"> {{ $data->electrical_equipment_leads_good_condition == 1 ? 'YES' : ($data->electrical_equipment_leads_good_condition == 2 ? 'NO' : ($data->electrical_equipment_leads_good_condition == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->electrical_equipment_leads_good_condition_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->electrical_equipment_leads_good_condition_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Working at Heights</td>
            <td class="title-desc">{{ $data->working_heights == 1 ? 'YES' : ($data->working_heights == 2 ? 'NO' : ($data->working_heights == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->working_heights_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->working_heights_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">All falls 2m or more are protected</td>
            <td class="title-desc"> {{ $data->all_falls_2m_protected == 1 ? 'YES' : ($data->all_falls_2m_protected == 2 ? 'NO' : ($data->all_falls_2m_protected == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->all_falls_2m_protected_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->all_falls_2m_protected_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Temporary edge protection (handrails, mid-rails, toe boards) installed at all leading edges</td>
            <td class="title-desc">{{ $data->temporary_edge_protection == 1 ? 'YES' : ($data->temporary_edge_protection == 2 ? 'NO' : ($data->temporary_edge_protection == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->temporary_edge_protection_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->temporary_edge_protection_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Extension ladders secured at top and bottom before use</td>
            <td class="title-desc">{{ $data->extension_ladders_secured == 1 ? 'YES' : ($data->extension_ladders_secured == 2 ? 'NO' : ($data->extension_ladders_secured == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->extension_ladders_secured_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->extension_ladders_secured_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Height safety equipment has current test tag</td>
            <td class="title-desc">  {{ $data->height_safety_equipment == 1 ? 'YES' : ($data->height_safety_equipment == 2 ? 'NO' : ($data->height_safety_equipment == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->height_safety_equipment_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->height_safety_equipment_comments }} </td>
         </tr>
         @endif
         
         <tr>
            <td class="title">Penetrations and Voids</td>
            <td class="title-desc">{{ $data->penetrations_voids == 1 ? 'YES' : ($data->penetrations_voids == 2 ? 'NO' : ($data->penetrations_voids == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->penetrations_voids_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->penetrations_voids_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Penetration covers are mechanically fixed and marked</td>
            <td class="title-desc">{{ $data->penetration_covers_mechanically == 1 ? 'YES' : ($data->penetration_covers_mechanically == 2 ? 'NO' : ($data->penetration_covers_mechanically == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->penetration_covers_mechanically_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->penetration_covers_mechanically_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Where necessary cast in mesh is installed into slab</td>
            <td class="title-desc">{{ $data->necessary_cast_mesh == 1 ? 'YES' : ($data->necessary_cast_mesh == 2 ? 'NO' : ($data->necessary_cast_mesh == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->necessary_cast_mesh_comment)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->necessary_cast_mesh_comment }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Lift shafts / service voids have covers or barriers installed, secured and marked</td>
            <td class="title-desc">{{ $data->lift_shafts == 1 ? 'YES' : ($data->lift_shafts == 2 ? 'NO' : ($data->lift_shafts == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->lift_shafts_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->lift_shafts_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Guards in place over stair voids</td>
            <td class="title-desc">{{ $data->guards_place_stair_voids == 1 ? 'YES' : ($data->guards_place_stair_voids == 2 ? 'NO' : ($data->guards_place_stair_voids == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->guards_place_stair_voids_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->guards_place_stair_voids_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Areas delineated / barricaded</td>
            <td class="title-desc">{{ $data->areas_delineated == 1 ? 'YES' : ($data->areas_delineated == 2 ? 'NO' : ($data->areas_delineated == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->areas_delineated_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->areas_delineated_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Materials fall protection</td>
            <td class="title-desc"> {{ $data->materials_fall_protection == 1 ? 'YES' : ($data->materials_fall_protection == 2 ? 'NO' : ($data->materials_fall_protection == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->materials_fall_protection_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->materials_fall_protection_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Netting covers all perimeter scaffolding</td>
            <td class="title-desc"> {{ $data->netting_covers_perimeter_scaffolding == 1 ? 'YES' : ($data->netting_covers_perimeter_scaffolding == 2 ? 'NO' : ($data->netting_covers_perimeter_scaffolding == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->netting_covers_perimeter_scaffolding_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->netting_covers_perimeter_scaffolding_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Toe boards installed on all guard rails</td>
            <td class="title-desc"> {{ $data->toe_boards_installed_all_guard_rails == 1 ? 'YES' : ($data->toe_boards_installed_all_guard_rails == 2 ? 'NO' : ($data->toe_boards_installed_all_guard_rails == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->toe_boards_installed_all_guard_rails_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->toe_boards_installed_all_guard_rails_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Core holes / penetrations / voids covered and mechanically fixed</td>
            <td class="title-desc">{{ $data->core_holes == 1 ? 'YES' : ($data->core_holes == 2 ? 'NO' : ($data->core_holes == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->core_holes_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->core_holes_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Scaffolds</td>
            <td class="title-desc"> {{ $data->scaffolds == 1 ? 'YES' : ($data->scaffolds == 2 ? 'NO' : ($data->scaffolds == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->scaffolds_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->scaffolds_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Scaffold has current test and tag at all entry points</td>
            <td class="title-desc"> {{ $data->scaffold_current_test_tag_entry_points == 1 ? 'YES' : ($data->scaffold_current_test_tag_entry_points == 2 ? 'NO' : ($data->scaffold_current_test_tag_entry_points == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->scaffold_current_test_tag_entry_points_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->scaffold_current_test_tag_entry_points_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Handover certificate available </td>
            <td class="title-desc"> {{ $data->handover_certificate_available == 1 ? 'YES' : ($data->handover_certificate_available == 2 ? 'NO' : ($data->handover_certificate_available == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->handover_certificate_available_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->handover_certificate_available_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Adequately braced / tied</td>
            <td class="title-desc">{{ $data->adequately_braced == 1 ? 'YES' : ($data->adequately_braced == 2 ? 'NO' : ($data->adequately_braced == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->adequately_braced_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->adequately_braced_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Gaps between scaffold and working face do not exceed 225mm</td>
            <td class="title-desc"> {{ $data->scaffold_working_face_exceed_225mm == 1 ? 'YES' : ($data->scaffold_working_face_exceed_225mm == 2 ? 'NO' : ($data->scaffold_working_face_exceed_225mm == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->scaffold_working_face_exceed_225mm_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->scaffold_working_face_exceed_225mm_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">All scaffold components are intact</td>
            <td class="title-desc"> {{ $data->all_scaffold_components_intact == 1 ? 'YES' : ($data->all_scaffold_components_intact == 2 ? 'NO' : ($data->all_scaffold_components_intact == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->all_scaffold_components_intact_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->all_scaffold_components_intact_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Access ladders / stairs free of debris, materials etc.</td>
            <td class="title-desc"> {{ $data->access_ladders == 1 ? 'YES' : ($data->access_ladders == 2 ? 'NO' : ($data->access_ladders == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->access_ladders_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->access_ladders_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Bays free from obstruction</td>
            <td class="title-desc"> {{ $data->bays_free_obstruction == 1 ? 'YES' : ($data->bays_free_obstruction == 2 ? 'NO' : ($data->bays_free_obstruction == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->bays_free_obstruction_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->bays_free_obstruction_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Minimum 450mm wide gap available on bays for worker access</td>
            <td class="title-desc">{{ $data->minimum_450mm_wide_gap == 1 ? 'YES' : ($data->minimum_450mm_wide_gap == 2 ? 'NO' : ($data->minimum_450mm_wide_gap == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->minimum_450mm_wide_gap_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->toe_boards_installed_all_guard_rails_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Bays are not being point loaded</td>
            <td class="title-desc">{{ $data->Bays_not_point_loaded == 1 ? 'YES' : ($data->Bays_not_point_loaded == 2 ? 'NO' : ($data->Bays_not_point_loaded == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->Bays_not_point_loaded_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->Bays_not_point_loaded_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Bays are not being overloaded</td>
            <td class="title-desc"> {{ $data->bays_being_overloaded == 1 ? 'YES' : ($data->bays_being_overloaded == 2 ? 'NO' : ($data->bays_being_overloaded == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->bays_being_overloaded_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->bays_being_overloaded_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">No missing scaffold planks</td>
            <td class="title-desc"> {{ $data->no_missing_scaffold_planks == 1 ? 'YES' : ($data->no_missing_scaffold_planks == 2 ? 'NO' : ($data->no_missing_scaffold_planks == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->no_missing_scaffold_planks_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->no_missing_scaffold_planks_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Sole plates founded on solid base</td>
            <td class="title-desc"> {{ $data->sole_plates_founded_solid_base == 1 ? 'YES' : ($data->sole_plates_founded_solid_base == 2 ? 'NO' : ($data->sole_plates_founded_solid_base == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->sole_plates_founded_solid_base_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->sole_plates_founded_solid_base_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Lapboards are mechanically secured</td>
            <td class="title-desc"> {{ $data->lapboards_mechanically_secured == 1 ? 'YES' : ($data->lapboards_mechanically_secured == 2 ? 'NO' : ($data->lapboards_mechanically_secured == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->lapboards_mechanically_secured_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->lapboards_mechanically_secured_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Incomplete scaffold has been barricaded and closed off + signs erected</td>
            <td class="title-desc"> {{ $data->incomplete_scaffold_barricaded_closed == 1 ? 'YES' : ($data->incomplete_scaffold_barricaded_closed == 2 ? 'NO' : ($data->incomplete_scaffold_barricaded_closed == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->incomplete_scaffold_barricaded_closed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->incomplete_scaffold_barricaded_closed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">PPE</td>
            <td class="title-desc"> {{ $data->ppe == 1 ? 'YES' : ($data->ppe == 2 ? 'NO' : ($data->ppe == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->ppe_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->ppe_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Workers are wearing mandatory PPE</td>
            <td class="title-desc"> {{ $data->workers_wearing_mandatory_ppe == 1 ? 'YES' : ($data->workers_wearing_mandatory_ppe == 2 ? 'NO' : ($data->workers_wearing_mandatory_ppe == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->workers_wearing_mandatory_ppe_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->workers_wearing_mandatory_ppe_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Workers observed using PPE correctly for their tasks (e.g. face masks)</td>
            <td class="title-desc"> {{ $data->workers_observed_ppe_correctly_tasks == 1 ? 'YES' : ($data->workers_observed_ppe_correctly_tasks == 2 ? 'NO' : ($data->workers_observed_ppe_correctly_tasks == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->workers_observed_ppe_correctly_tasks_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->workers_observed_ppe_correctly_tasks_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">PPE complies with regulatory requirements</td>
            <td class="title-desc"> {{ $data->ppe_complies_regulatory_requirements == 1 ? 'YES' : ($data->ppe_complies_regulatory_requirements == 2 ? 'NO' : ($data->ppe_complies_regulatory_requirements == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->ppe_complies_regulatory_requirements_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->ppe_complies_regulatory_requirements_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Ladders</td>
            <td class="title-desc">{{ $data->ladders == 1 ? 'YES' : ($data->ladders == 2 ? 'NO' : ($data->ladders == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->ladders_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->ladders_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Only industrial strength ladders used</td>
            <td class="title-desc">{{ $data->industrial_strength_ladder == 1 ? 'YES' : ($data->industrial_strength_ladder == 2 ? 'NO' : ($data->industrial_strength_ladder == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->industrial_strength_ladder_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->industrial_strength_ladder_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Ladders are in good condition and free of damage</td>
            <td class="title-desc"> {{ $data->ladders_good_condition == 1 ? 'YES' : ($data->ladders_good_condition == 2 ? 'NO' : ($data->ladders_good_condition == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->ladders_good_condition_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->ladders_good_condition_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Safety labels are intact</td>
            <td class="title-desc">{{ $data->safety_labels_intact == 1 ? 'YES' : ($data->safety_labels_intact == 2 ? 'NO' : ($data->safety_labels_intact == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->safety_labels_intact_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->safety_labels_intact_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Extension ladders secured at top and bottom</td>
            <td class="title-desc"> {{ $data->extension_adders_secured_top_bottom == 1 ? 'YES' : ($data->extension_adders_secured_top_bottom == 2 ? 'NO' : ($data->extension_adders_secured_top_bottom == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->extension_adders_secured_top_bottom_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->extension_adders_secured_top_bottom_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Extension ladders extend 1m past top of landing</td>
            <td class="title-desc"> {{ $data->extension_ladders_extend_1m_past_top_landing == 1 ? 'YES' : ($data->extension_ladders_extend_1m_past_top_landing == 2 ? 'NO' : ($data->extension_ladders_extend_1m_past_top_landing == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->extension_ladders_extend_1m_past_top_landing_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->extension_ladders_extend_1m_past_top_landing_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Extension ladders placed at correct angle (1:4)</td>
            <td class="title-desc"> {{ $data->extension_ladders_placed_correct_angle_1_4 == 1 ? 'YES' : ($data->extension_ladders_placed_correct_angle_1_4 == 2 ? 'NO' : ($data->extension_ladders_placed_correct_angle_1_4 == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->extension_ladders_placed_correct_angle_1_4_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->extension_ladders_placed_correct_angle_1_4_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Ladders not used on scaffold / near fall risks</td>
            <td class="title-desc"> {{ $data->ladders_not_used_scaffold == 1 ? 'YES' : ($data->ladders_not_used_scaffold == 2 ? 'NO' : ($data->ladders_not_used_scaffold == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->ladders_not_used_scaffold_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->ladders_not_used_scaffold_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Ladders not used in entrance ways / paths of travel without exclusion zone</td>
            <td class="title-desc"> {{ $data->ladders_not_used_entrance_ways == 1 ? 'YES' : ($data->ladders_not_used_entrance_ways == 2 ? 'NO' : ($data->ladders_not_used_entrance_ways == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->ladders_not_used_entrance_ways_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->ladders_not_used_entrance_ways_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Trenches and Excavations</td>
            <td class="title-desc"> {{ $data->trenches_xcavations == 1 ? 'YES' : ($data->trenches_xcavations == 2 ? 'NO' : ($data->trenches_xcavations == 0 ? 'N/A' : '')) }}  </td>
         </tr>
         @if($data->trenches_xcavations_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->trenches_xcavations_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">DBYD been obtained before work</td>
            <td class="title-desc"> {{ $data->DBYD_been_obtained_before_work == 1 ? 'YES' : ($data->DBYD_been_obtained_before_work == 2 ? 'NO' : ($data->DBYD_been_obtained_before_work == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->DBYD_been_obtained_before_work_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->DBYD_been_obtained_before_work_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Services have been located and potholed</td>
            <td class="title-desc">{{ $data->services_have_been_located_potholed == 1 ? 'YES' : ($data->services_have_been_located_potholed == 2 ? 'NO' : ($data->services_have_been_located_potholed == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->services_have_been_located_potholed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->services_have_been_located_potholed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Excavations / trenches barricaded and sign posted</td>
            <td class="title-desc">{{ $data->excavations_trenches_barricaded_sign_posted == 1 ? 'YES' : ($data->excavations_trenches_barricaded_sign_posted == 2 ? 'NO' : ($data->excavations_trenches_barricaded_sign_posted == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->excavations_trenches_barricaded_sign_posted_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->excavations_trenches_barricaded_sign_posted_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Correct trench support used where necessary</td>
            <td class="title-desc"> {{ $data->correct_trench_support_used_where_necessary == 1 ? 'YES' : ($data->correct_trench_support_used_where_necessary == 2 ? 'NO' : ($data->correct_trench_support_used_where_necessary == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->correct_trench_support_used_where_necessary_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->correct_trench_support_used_where_necessary_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Trenches greater than 1.5m have edge protection and safe access / egress</td>
            <td class="title-desc"> {{ $data->trenches_greater_than_1_5m_have_edge_protection == 1 ? 'YES' : ($data->trenches_greater_than_1_5m_have_edge_protection == 2 ? 'NO' : ($data->trenches_greater_than_1_5m_have_edge_protection == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->trenches_greater_than_1_5m_have_edge_protection_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->trenches_greater_than_1_5m_have_edge_protection_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Edges of excavations / trenches clear of spoil / materials</td>
            <td class="title-desc">{{ $data->edges_excavations == 1 ? 'YES' : ($data->edges_excavations == 2 ? 'NO' : ($data->edges_excavations == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->edges_excavations_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->edges_excavations_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Hazardous substances</td>
            <td class="title-desc">{{ $data->hazardous_substances == 1 ? 'YES' : ($data->hazardous_substances == 2 ? 'NO' : ($data->hazardous_substances == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->hazardous_substances_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->hazardous_substances_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Register is kept on site and up to date</td>
            <td class="title-desc"> {{ $data->register_kept_on_site_and_up_to_date == 1 ? 'YES' : ($data->register_kept_on_site_and_up_to_date == 2 ? 'NO' : ($data->register_kept_on_site_and_up_to_date == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->register_kept_on_site_and_up_to_date_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->register_kept_on_site_and_up_to_date_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">SDS available for all hazardous substances</td>
            <td class="title-desc"> {{ $data->SDS_available_hazardous_substances == 1 ? 'YES' : ($data->SDS_available_hazardous_substances == 2 ? 'NO' : ($data->SDS_available_hazardous_substances == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->SDS_available_hazardous_substances_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->SDS_available_hazardous_substances_comments }} </td>
         </tr>
         @endif

         

         <tr>
            <td class="title">Appropriate signage displayed</td>
            <td class="title-desc"> {{ $data->appropriate_signage_displayed == 1 ? 'YES' : ($data->appropriate_signage_displayed == 2 ? 'NO' : ($data->appropriate_signage_displayed == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->appropriate_signage_displayed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->appropriate_signage_displayed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">adequately stored and ventilated</td>
            <td class="title-desc"> {{ $data->adequately_stored_ventilated == 1 ? 'YES' : ($data->adequately_stored_ventilated == 2 ? 'NO' : ($data->adequately_stored_ventilated == 0 ? 'N/A' : '')) }}  </td>
         </tr>
         @if($data->adequately_stored_ventilated_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->adequately_stored_ventilated_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Kept in original containers with labels</td>
            <td class="title-desc"> {{ $data->kept_original_containers_with_labels == 1 ? 'YES' : ($data->kept_original_containers_with_labels == 2 ? 'NO' : ($data->kept_original_containers_with_labels == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->kept_original_containers_with_labels_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->kept_original_containers_with_labels_comments }} </td>
         </tr>
         @endif
         
         <tr>
            <td class="title">Spill kit available on site</td>
            <td class="title-desc"> {{ $data->spill_kit_available_site == 1 ? 'YES' : ($data->spill_kit_available_site == 2 ? 'NO' : ($data->spill_kit_available_site == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->spill_kit_available_site_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->spill_kit_available_site_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Emergency and First Aid</td>
            <td class="title-desc"> {{ $data->emergency_first_aid == 1 ? 'YES' : ($data->emergency_first_aid == 2 ? 'NO' : ($data->emergency_first_aid == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->emergency_first_aid_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->emergency_first_aid_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Emergency access kept clear at all times</td>
            <td class="title-desc"> {{ $data->emergency_access_kept_all_times == 1 ? 'YES' : ($data->emergency_access_kept_all_times == 2 ? 'NO' : ($data->emergency_access_kept_all_times == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->emergency_access_kept_all_times_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->emergency_access_kept_all_times_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Emergency exit points clearly marked</td>
            <td class="title-desc">{{ $data->emergency_exit_points_clearly_marked == 1 ? 'YES' : ($data->emergency_exit_points_clearly_marked == 2 ? 'NO' : ($data->emergency_exit_points_clearly_marked == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->emergency_exit_points_clearly_marked_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->emergency_exit_points_clearly_marked_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Emergency evacuation plan displayed</td>
            <td class="title-desc">{{ $data->emergency_evacuation_plan_displayed == 1 ? 'YES' : ($data->emergency_evacuation_plan_displayed == 2 ? 'NO' : ($data->emergency_evacuation_plan_displayed == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->emergency_evacuation_plan_displayed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->emergency_evacuation_plan_displayed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Emergency assembly point displayed</td>
            <td class="title-desc">{{ $data->emergency_assembly_point_displayed == 1 ? 'YES' : ($data->emergency_assembly_point_displayed == 2 ? 'NO' : ($data->emergency_assembly_point_displayed == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->emergency_assembly_point_displayed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->emergency_assembly_point_displayed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Emergency contact details displayed</td>
            <td class="title-desc">{{ $data->emergency_contact_details_displayed == 1 ? 'YES' : ($data->emergency_contact_details_displayed == 2 ? 'NO' : ($data->emergency_contact_details_displayed == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->emergency_contact_details_displayed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->emergency_contact_details_displayed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Adequate firefighting equipment available</td>
            <td class="title-desc">{{ $data->adequate_firefighting_equipment_available == 1 ? 'YES' : ($data->adequate_firefighting_equipment_available == 2 ? 'NO' : ($data->adequate_firefighting_equipment_available == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->adequate_firefighting_equipment_available_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->adequate_firefighting_equipment_available_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Firefighting equipment has current test tag</td>
            <td class="title-desc"> {{ $data->firefighting_equipment_current_test_tag == 1 ? 'YES' : ($data->firefighting_equipment_current_test_tag == 2 ? 'NO' : ($data->firefighting_equipment_current_test_tag == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->firefighting_equipment_current_test_tag_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->firefighting_equipment_current_test_tag_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">First Aid officer & contact displayed</td>
            <td class="title-desc"> {{ $data->first_aid_officer_contact_displayed == 1 ? 'YES' : ($data->first_aid_officer_contact_displayed == 2 ? 'NO' : ($data->first_aid_officer_contact_displayed == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->first_aid_officer_contact_displayed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->first_aid_officer_contact_displayed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">First aid signage displayed</td>
            <td class="title-desc">{{ $data->first_aid_signage_displayed == 1 ? 'YES' : ($data->first_aid_signage_displayed == 2 ? 'NO' : ($data->first_aid_signage_displayed == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->first_aid_signage_displayed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->first_aid_signage_displayed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">First aid kit fully stocked</td>
            <td class="title-desc"> {{ $data->first_aid_kit_fully_stocked == 1 ? 'YES' : ($data->first_aid_kit_fully_stocked == 2 ? 'NO' : ($data->first_aid_kit_fully_stocked == 0 ? 'N/A' : '')) }}  </td>
         </tr>
         @if($data->first_aid_kit_fully_stocked_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->first_aid_kit_fully_stocked_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">First aid and emergency personnel are trained / current certificates</td>
            <td class="title-desc">{{ $data->first_aid_emergency_personnel_trained == 1 ? 'YES' : ($data->first_aid_emergency_personnel_trained == 2 ? 'NO' : ($data->first_aid_emergency_personnel_trained == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->first_aid_emergency_personnel_trained_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->first_aid_emergency_personnel_trained_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Injury register maintained on site</td>
            <td class="title-desc"> {{ $data->injury_register_maintained_site == 1 ? 'YES' : ($data->injury_register_maintained_site == 2 ? 'NO' : ($data->injury_register_maintained_site == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->injury_register_maintained_site_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->injury_register_maintained_site_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Hot works are approved and adequately controls / emergency response measures in place</td>
            <td class="title-desc">{{ $data->hot_works_approved_adequately_controls == 1 ? 'YES' : ($data->hot_works_approved_adequately_controls == 2 ? 'NO' : ($data->hot_works_approved_adequately_controls == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->hot_works_approved_adequately_controls_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->hot_works_approved_adequately_controls_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Cranes</td>
            <td class="title-desc">{{ $data->cranes == 1 ? 'YES' : ($data->cranes == 2 ? 'NO' : ($data->cranes == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->cranes_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->cranes_comments }} </td>
         </tr>
         @endif
         
         <tr>
            <td class="title">Certificate of registration available</td>
            <td class="title-desc"> {{ $data->certificate_registration_available == 1 ? 'YES' : ($data->certificate_registration_available == 2 ? 'NO' : ($data->certificate_registration_available == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->certificate_registration_available_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->certificate_registration_available_comments }} </td>
         </tr>
         @endif


         <tr>
            <td class="title">Insurances available</td>
            <td class="title-desc">{{ $data->insurances_available == 1 ? 'YES' : ($data->insurances_available == 2 ? 'NO' : ($data->insurances_available == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->insurances_available_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->insurances_available_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Maintenance and service records available and up to date</td>
            <td class="title-desc"> {{ $data->maintenance_service_records_available_and_up_to_date == 1 ? 'YES' : ($data->maintenance_service_records_available_and_up_to_date == 2 ? 'NO' : ($data->maintenance_service_records_available_and_up_to_date == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->maintenance_service_records_available_and_up_to_date_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->maintenance_service_records_available_and_up_to_date_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Pre-start inspection are being completed</td>
            <td class="title-desc"> {{ $data->pre_start_inspection_being_completed == 1 ? 'YES' : ($data->pre_start_inspection_being_completed == 2 ? 'NO' : ($data->pre_start_inspection_being_completed == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->pre_start_inspection_being_completed_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->pre_start_inspection_being_completed_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Crane crew hold appropriate licences / competency</td>
            <td class="title-desc"> {{ $data->crane_crew_hold_appropriate_licences == 1 ? 'YES' : ($data->crane_crew_hold_appropriate_licences == 2 ? 'NO' : ($data->crane_crew_hold_appropriate_licences == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->crane_crew_hold_appropriate_licences_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->crane_crew_hold_appropriate_licences_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Exclusion being used during movement of loads</td>
            <td class="title-desc">{{ $data->exclusion_being_used_during_movement_loads == 1 ? 'YES' : ($data->exclusion_being_used_during_movement_loads == 2 ? 'NO' : ($data->exclusion_being_used_during_movement_loads == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->exclusion_being_used_during_movement_loads_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->exclusion_being_used_during_movement_loads_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Emergency response measures in place</td>
            <td class="title-desc">{{ $data->emergency_response_measures_place == 1 ? 'YES' : ($data->emergency_response_measures_place == 2 ? 'NO' : ($data->emergency_response_measures_place == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->emergency_response_measures_place_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->emergency_response_measures_place_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Mobile Plant</td>
            <td class="title-desc">{{ $data->mobile_plant == 1 ? 'YES' : ($data->mobile_plant == 2 ? 'NO' : ($data->mobile_plant == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->mobile_plant_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->mobile_plant_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Certificate of registration available</td>
            <td class="title-desc">{{ $data->certificate_registration_available1 == 1 ? 'YES' : ($data->certificate_registration_available1 == 2 ? 'NO' : ($data->certificate_registration_available1 == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->certificate_registration_available_comments1)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->certificate_registration_available_comments1 }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Insurances available</td>
            <td class="title-desc"> {{ $data->insurances_available1 == 1 ? 'YES' : ($data->insurances_available1 == 2 ? 'NO' : ($data->insurances_available1 == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->insurances_available_comments1)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->insurances_available_comments1 }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Maintenance and service records available and up to date</td>
            <td class="title-desc"> {{ $data->maintenance_service_records_available_and_up_to_date1 == 1 ? 'YES' : ($data->maintenance_service_records_available_and_up_to_date1 == 2 ? 'NO' : ($data->maintenance_service_records_available_and_up_to_date1 == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->maintenance_service_records_available_and_up_to_date_comments1)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->maintenance_service_records_available_and_up_to_date_comments1 }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Operators hold appropriate licences / competency</td>
            <td class="title-desc"> {{ $data->operators_hold_appropriate_licences == 1 ? 'YES' : ($data->operators_hold_appropriate_licences == 2 ? 'NO' : ($data->operators_hold_appropriate_licences == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->operators_hold_appropriate_licences_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->operators_hold_appropriate_licences_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Exclusion being used where necessary</td>
            <td class="title-desc"> {{ $data->exclusion_being_used_where_necessary == 1 ? 'YES' : ($data->exclusion_being_used_where_necessary == 2 ? 'NO' : ($data->exclusion_being_used_where_necessary == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->exclusion_being_used_where_necessary_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->exclusion_being_used_where_necessary_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Emergency response measures in place</td>
            <td class="title-desc"> {{ $data->emergency_response_measures_place1 == 1 ? 'YES' : ($data->emergency_response_measures_place1 == 2 ? 'NO' : ($data->emergency_response_measures_place1 == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->emergency_response_measures_place_comments1)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->emergency_response_measures_place_comments1 }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Lifting Equipment</td>
            <td class="title-desc"> {{ $data->lifting_equipment == 1 ? 'YES' : ($data->lifting_equipment == 2 ? 'NO' : ($data->lifting_equipment == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->lifting_equipment_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->lifting_equipment_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Register available and maintained on site</td>
            <td class="title-desc">{{ $data->register_available_maintained_site == 1 ? 'YES' : ($data->register_available_maintained_site == 2 ? 'NO' : ($data->register_available_maintained_site == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->register_available_maintained_site_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->register_available_maintained_site_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Equipment has current test tag</td>
            <td class="title-desc">{{ $data->equipment_has_current_test_tag == 1 ? 'YES' : ($data->equipment_has_current_test_tag == 2 ? 'NO' : ($data->equipment_has_current_test_tag == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->equipment_has_current_test_tag_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->equipment_has_current_test_tag_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Equipment correctly stored</td>
            <td class="title-desc">{{ $data->equipment_correctly_stored == 1 ? 'YES' : ($data->equipment_correctly_stored == 2 ? 'NO' : ($data->equipment_correctly_stored == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->equipment_correctly_stored_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->equipment_correctly_stored_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Equipment inspected before use</td>
            <td class="title-desc"> {{ $data->equipment_inspected_before_use == 1 ? 'YES' : ($data->equipment_inspected_before_use == 2 ? 'NO' : ($data->equipment_inspected_before_use == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->equipment_inspected_before_use_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->equipment_inspected_before_use_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Traffic Control / Public Safety</td>
            <td class="title-desc"> {{ $data->traffic_control == 1 ? 'YES' : ($data->traffic_control == 2 ? 'NO' : ($data->traffic_control == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->traffic_control_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->traffic_control_comments }} </td>
         </tr>
         @endif

         <tr>
            <td class="title">Traffic Management/ Control plan in place</td>
            <td class="title-desc">{{ $data->traffic_management == 1 ? 'YES' : ($data->traffic_management == 2 ? 'NO' : ($data->traffic_management == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->traffic_management_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->traffic_management_comments }} </td>
         </tr>
         @endif
         <tr>
            <td class="title">Fencing / barriers to stop public access to site</td>
            <td class="title-desc"> {{ $data->fencing_barriers_to_stop_public_access_to_site == 1 ? 'YES' : ($data->fencing_barriers_to_stop_public_access_to_site == 2 ? 'NO' : ($data->fencing_barriers_to_stop_public_access_to_site == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->fencing_barriers_to_stop_public_access_to_site_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->fencing_barriers_to_stop_public_access_to_site_comments }} </td>
         </tr>
         @endif
         <tr>
            <td class="title">Public areas kept clear of materials / rubbish / operations</td>
            <td class="title-desc"> {{ $data->public_areas_kept_clear_of_materials == 1 ? 'YES' : ($data->public_areas_kept_clear_of_materials == 2 ? 'NO' : ($data->public_areas_kept_clear_of_materials == 0 ? 'N/A' : '')) }} </td>
         </tr>
         @if($data->public_areas_kept_clear_of_materials_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->public_areas_kept_clear_of_materials_comments }} </td>
         </tr>
         @endif
         <tr>
            <td class="title">Traffic controllers certified</td>
            <td class="title-desc"> {{ $data->traffic_controllers_certified == 1 ? 'YES' : ($data->traffic_controllers_certified == 2 ? 'NO' : ($data->traffic_controllers_certified == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->traffic_controllers_certified_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->traffic_controllers_certified_comments }} </td>
         </tr>
         @endif
         <tr>
            <td class="title">Signs and devices in use</td>
            <td class="title-desc"> {{ $data->signs_and_devices_in_use == 1 ? 'YES' : ($data->signs_and_devices_in_use == 2 ? 'NO' : ($data->signs_and_devices_in_use == 0 ? 'N/A' : '')) }}</td>
         </tr>
         @if($data->signs_and_devices_in_use_comments)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->signs_and_devices_in_use_comments }} </td>
         </tr>
         @endif
         <tr>
            <td colspan="2" class="title" style="padding-left: 0; background-color:gray;"><span class="headlines">General / additional comments & notations</span></td>
         </tr>
         @if($data->general_additional_comments_notations)
         <tr>
            <td colspan="2" class="title-desc"> {{ $data->general_additional_comments_notations }} </td>
         </tr>
         @endif
         </table>
        
   </body>
</html>