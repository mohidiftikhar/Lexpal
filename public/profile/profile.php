<?php

$curl = curl_init();

//$after  =   "eyJvZmZzZXQiOjEwLCJmZWF0dXJlZExpc3RpbmdzIjpbXX0=";

$after  =   file_get_contents(__DIR__.'/cursor.txt');

$after  =   preg_replace('/\s+/', '', $after);

$data ='{"operationName":"FreeTextSearch","variables":{"appointmentDateEnd":null,"appointmentDateStart":null,"first":20,"location":null,"profile":{"gender":null,"interestsOrProcedures":null,"languages":null,"networkOnlineAppointments":true,"preferredHealthProviders":null,"preferredProviderPrograms":null,"specialists":["GP"],"vaccines":null},"query":"","specialist":"GP","includeTestProfiles":false,"after":"'.$after.'"},"extensions":{},"query":"query FreeTextSearch($after: String, $appointmentDateEnd: Date, $appointmentDateStart: Date, $first: Int, $location: LocationFilters, $profile: ProfileFilters, $query: String!, $specialist: String, $tags: [PracticeTag!], $time: TimePreset, $includeTestProfiles: Boolean) {\\n  searchSpecialty: specialty(specialist: $specialist) {\\n    name\\n    __typename\\n  }\\n  searchProfiles(id: \\"FreeTextSearch\\", search: {appointmentDateEnd: $appointmentDateEnd, appointmentDateStart: $appointmentDateStart, location: $location, profile: $profile, query: $query, tags: {include: $tags}, appointmentTimePreset: $time, test: $includeTestProfiles}, first: $first, after: $after) {\\n    results {\\n      ...RawSearchResultFragment\\n      __typename\\n    }\\n    totalCount\\n    pageInfo {\\n      endCursor\\n      __typename\\n    }\\n    facetsWithCounts {\\n      governmentSchemes {\\n        count\\n        __typename\\n      }\\n      paymentMethods {\\n        count\\n        values {\\n          term\\n          count\\n          __typename\\n        }\\n        __typename\\n      }\\n      suburbStatePostcode {\\n        count\\n        __typename\\n      }\\n      types {\\n        count\\n        values {\\n          term\\n          count\\n          __typename\\n        }\\n        __typename\\n      }\\n      languagesName {\\n        count\\n        __typename\\n      }\\n      preferredHealthProviders {\\n        count\\n        __typename\\n      }\\n      tags {\\n        values {\\n          term\\n          count\\n          __typename\\n        }\\n        __typename\\n      }\\n      __typename\\n    }\\n    __typename\\n  }\\n}\\n\\nfragment RawSearchResultFragment on SearchProfileResult {\\n  appointmentSummary {\\n    ...RawAppointmentSummary\\n    __typename\\n  }\\n  profile {\\n    ...SearchPracticeFragment\\n    ...SearchPractitionerFragment\\n    __typename\\n  }\\n  __typename\\n}\\n\\nfragment RawAppointmentSummary on AppointmentSummary {\\n  id\\n  appointment {\\n    ...SearchAppointmentFragment\\n    __typename\\n  }\\n  appointmentCountOnSameDay\\n  bookingMethod\\n  __typename\\n}\\n\\nfragment SearchAppointmentFragment on Appointment {\\n  id\\n  appointmentPractitionerId\\n  date\\n  time\\n  specialty\\n  __typename\\n}\\n\\nfragment SearchPracticeFragment on Practice {\\n  __typename\\n  featured\\n  id\\n  name\\n  phoneNumber\\n  address {\\n    state\\n    street\\n    streetNumber\\n    suburb\\n    suite\\n    __typename\\n  }\\n  tagline\\n  images {\\n    link\\n    __typename\\n  }\\n  logo {\\n    link\\n    __typename\\n  }\\n  tags\\n  interests {\\n    name\\n    __typename\\n  }\\n  procedures {\\n    name\\n    __typename\\n  }\\n  specialties {\\n    name\\n    __typename\\n  }\\n  preferredProviders {\\n    name\\n    __typename\\n  }\\n  preferredProviderPrograms {\\n    name\\n    __typename\\n  }\\n  rating {\\n    count\\n    rating\\n    disabled\\n    disabledReason\\n    __typename\\n  }\\n  practitioners {\\n    id\\n    title\\n    firstName\\n    lastName\\n    profilePhoto {\\n      link\\n      __typename\\n    }\\n    url\\n    __typename\\n  }\\n  url\\n  treatments {\\n    importedAt\\n    price\\n    treatment {\\n      code\\n      codeType\\n      name\\n      __typename\\n    }\\n    __typename\\n  }\\n  rankingInfo {\\n    geoDistance\\n    __typename\\n  }\\n}\\n\\nfragment SearchPractitionerFragment on Practitioner {\\n  __typename\\n  id\\n  title\\n  firstName\\n  lastName\\n  gender\\n  specialties {\\n    specialist\\n    __typename\\n  }\\n  practices {\\n    id\\n    address {\\n      state\\n      street\\n      streetNumber\\n      suburb\\n      suite\\n      __typename\\n    }\\n    phoneNumber\\n    tags\\n    __typename\\n  }\\n  primaryPractice {\\n    id\\n    address {\\n      state\\n      street\\n      streetNumber\\n      suburb\\n      suite\\n      __typename\\n    }\\n    phoneNumber\\n    __typename\\n  }\\n  interests {\\n    name\\n    __typename\\n  }\\n  profilePhoto {\\n    link\\n    __typename\\n  }\\n  url\\n  rankingInfo {\\n    geoDistance\\n    __typename\\n  }\\n}\\n"}';
$new_data = '{"operationName":"FreeTextSearch","variables":{"appointmentDateEnd":null,"appointmentDateStart":null,"first":10,"location":null,"profile":{"gender":null,"interestsOrProcedures":null,"languages":null,"networkOnlineAppointments":true,"preferredHealthProviders":null,"preferredProviderPrograms":null,"specialists":["GP"],"vaccines":null},"query":"","specialist":"GP","includeTestProfiles":false,"after":"'.$after.'"},"extensions":{},"query":"query FreeTextSearch($after: String, $appointmentDateEnd: Date, $appointmentDateStart: Date, $first: Int, $location: LocationFilters, $profile: ProfileFilters, $query: String!, $specialist: String, $tags: [PracticeTag!], $time: TimePreset, $includeTestProfiles: Boolean) {  searchSpecialty: specialty(specialist: $specialist) {    name    __typename  }  searchProfiles(id: \\"FreeTextSearch\\", search: {appointmentDateEnd: $appointmentDateEnd, appointmentDateStart: $appointmentDateStart, location: $location, profile: $profile, query: $query, tags: {include: $tags}, appointmentTimePreset: $time, test: $includeTestProfiles}, first: $first, after: $after) {    results {      ...RawSearchResultFragment      __typename    }    totalCount    pageInfo {      endCursor      __typename    }    facetsWithCounts {      governmentSchemes {        count        __typename      }      paymentMethods {        count        values {          term          count          __typename        }        __typename      }      suburbStatePostcode {        count        __typename      }      types {        count        values {          term          count          __typename        }        __typename      }      languagesName {        count        __typename      }      preferredHealthProviders {        count        __typename      }      tags {        values {          term          count          __typename        }        __typename      }      __typename    }    __typename  }}\\nfragment RawSearchResultFragment on SearchProfileResult {   profile {    ...SearchPracticeFragment    ...SearchPractitionerFragment    __typename  }  __typename}\\nfragment SearchPracticeFragment on Practice {  __typename  featured  id  name  phoneNumber  address {    state    street    streetNumber    suburb    suite    __typename  }  tagline  images {    link    __typename  }  logo {    link    __typename  }  tags  interests {    name    __typename  }  procedures {    name    __typename  }  specialties {    name    __typename  }  preferredProviders {    name    __typename  }  preferredProviderPrograms {    name    __typename  }  rating {    count    rating    disabled    disabledReason    __typename  }  practitioners {    id    title    firstName    lastName    profilePhoto {      link      __typename    }    url    __typename  }  url  treatments {    importedAt    price    treatment {      code      codeType      name      __typename    }    __typename  }  rankingInfo {    geoDistance    __typename  }}\\nfragment SearchPractitionerFragment on Practitioner {  __typename  id  title  firstName  lastName  gender  specialties {    specialist    __typename  }  practices {    id    address {      state      street      streetNumber      suburb      suite      __typename    }    phoneNumber    tags    __typename  }  primaryPractice {    id    address {      state      street      streetNumber      suburb      suite      __typename    }    phoneNumber    __typename  }  interests {    name    __typename  }  profilePhoto {    link    __typename  }  url  rankingInfo {    geoDistance    __typename  }}"}';
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.healthengine.com.au/graphql',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>$new_data,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json; charset=utf-8'
    ),
));

$response = curl_exec($curl);
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    echo "ERROR";
    echo '<pre>';
    print_r($error_msg);
    echo '</pre>';
}
else{
    $response      =   json_decode($response);
    $jsonData      =   [];
    $jsonDatas      =   file_get_contents(__DIR__.'/health.json');
    $jsonData       =   !empty($jsonDatas)?json_decode($jsonDatas):[];
    $countTotal =   0;
    if (!empty($response->data)){
        if (!empty($response->data->searchProfiles)){
            $searchProfiles    =   $response->data->searchProfiles;
            $newData           =   [];
            if (!empty($searchProfiles->results)){
                foreach ($searchProfiles->results as $row){
                    $jsonData[]     =   [
                        'name'             =>  $row->profile->name,
                        'phoneNumber'      =>  $row->profile->phoneNumber,
                        'address'          =>  json_encode($row->profile->address),
                        'url'              =>  "https://healthengine.com.au/".$row->profile->url,
                    ];
                }
                $countTotal        =   count($jsonData);
                $jsonData           =   json_encode($jsonData);
                file_put_contents(__DIR__.'/health.json',$jsonData);
            }
            if (!empty($searchProfiles->pageInfo)){
                $pageInfo          =   $searchProfiles->pageInfo;
                $endCursor         =   $pageInfo->endCursor;
                $fp = fopen(__DIR__."/cursor.txt", 'w');
                fwrite($fp, $endCursor);
                fwrite($fp, 'mice');
                fclose($fp);
            }
            echo "Total : ".$countTotal." import : ".count($searchProfiles->results)." Hello";
        }
        else{
            echo "HI";
        }
    }
    else{
        echo "HHHH";
    }

}
curl_close($curl);

