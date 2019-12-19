@extends('admin.layouts.master')
@section('styles')
    <style>
        .name {
            font-weight: bolder;
        }
       .portlet-body .value {
            font-weight: 500;
        }
    </style>
@endsection
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->

            <!-- END PAGE HEAD-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">Application Detail</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Personal Information</div>
                                        <div class="panel-body">
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> First Name:</div>
                                                    <div class="col-md-7 value"> {{$list->first_name}}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Middle Name:</div>
                                                    <div class="col-md-7 value"> {{$list->middle_name}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Last Name:</div>
                                                    <div class="col-md-7 value">
                                                        {{$list->last_name}}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Gender:</div>
                                                    <div class="col-md-7 value"> {{$list->middle_name}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> DOB::</div>
                                                    <div class="col-md-7 value"> {{$list->dob}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Mobile Number:</div>
                                                    <div class="col-md-7 value"> {{$list->mobile}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Alternate Phone::</div>
                                                    <div class="col-md-7 value"> {{$list->mobile}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Email:</div>
                                                    <div class="col-md-7 value"> {{$list->email}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Marital Status:</div>
                                                    <div class="col-md-7 value"> {{$list->marital_status}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Nationality:</div>
                                                    <div class="col-md-7 value"> {{$list->nationality}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Emirates ID/Passport Number:</div>
                                                    <div class="col-md-7 value"> {{$list->emirates_id}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Contact Address:</div>
                                                    <div class="col-md-7 value">{{$list->contact_address}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Medical Education</div>
                                        <div class="panel-body">
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-12 name"><b> Primary Medical Qualifications</b></div>
                                                </div>
                                                <br/>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Degree Name:</div>
                                                    <div class="col-md-7 value"> {{$list->medical_degree}}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Training Body/ Institution:</div>
                                                    <div class="col-md-7 value"> {{$list->medical_school_name}} </div>
                                                </div>


                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Country Of Qualification:</div>
                                                    <div class="col-md-7 value">{{$list->country_qualification}}</div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Date Of Qualification:</div>
                                                    <div class="col-md-7 value"> {{$list->date_of_qualification}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <br/>
                                                    <div class="col-md-12 name"><b> Additional Supporting Qualifications (e.g. B
                                                            Sc, MSc Psych, PhD, etc…)</b></div>

                                                </div>
                                                <br/>

                                                <?php

                                                $total = count($medical_more_fields);
                                                $countries = helper_countries();
                                                foreach ($medical_more_fields as $fields) {
                                                ?>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Degree Name:</div>
                                                    <div class="col-md-7 value"> {{$fields['degree_name']['field_value']}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Training Body/ Institution:</div>
                                                    <div class="col-md-7 value"> {{$fields['medical_school_name']['field_value']}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Country Of Qualification:</div>
                                                    <div class="col-md-7 value"> {{$countries[$fields['country']['field_value']]}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Date Of Qualification:</div>
                                                    <div class="col-md-7 value"> {{$fields['date_of_qualification']['field_value']}} </div>
                                                </div>
                                                <hr/>
                                                <?php    }
                                                ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Professional Training Qualification</div>
                                        <div class="panel-body">
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-12 name"><b> Primary Medical Qualifications</b></div>
                                                </div>
                                                <br/>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Name Of Institution/ Program::</div>
                                                    <div class="col-md-7 value"> {{$list->medical_degree}}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Specialty:</div>
                                                    <div class="col-md-7 value"> {{$list->medical_school_name}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Type Of Training:</div>
                                                    <div class="col-md-7 value">{{$list->country_qualification}}</div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Start Date:</div>
                                                    <div class="col-md-7 value"> {{$list->date_of_qualification}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> End Date:</div>
                                                    <div class="col-md-7 value"> {{$list->date_of_qualification}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Name Of Programme Director:</div>
                                                    <div class="col-md-7 value"> {{$list->date_of_qualification}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Clinical Work Experience</div>
                                        <div class="panel-body">
                                            <div class="portlet-body">
                                                <?php

                                                foreach ($meta_employemnt as $fields) {
                                                ?>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Employer:</div>
                                                    <div class="col-md-7 value"> {{$fields['name_of_hospital']['field_value']}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Designation:</div>
                                                    <div class="col-md-7 value"> {{$fields['designation']['field_value']}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Start Date:</div>
                                                    <div class="col-md-7 value"> {{$fields['start_date']['field_value']}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> End Date:</div>
                                                    <div class="col-md-7 value"> {{$fields['end_date']['field_value']}} </div>
                                                </div>
                                                <hr/>
                                                <?php    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Membership in a Professional Body/Society</div>
                                        <div class="panel-body">
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Name Of Body/Society:</div>
                                                    <div class="col-md-7 value"> {{$list->membership_name_of_society}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Date Of Membership:</div>
                                                    <div class="col-md-7 value"> {{$list->membership_date}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Is Your Membership Active:</div>
                                                    <div class="col-md-7 value"> {{$list->membership_active}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Licensure</div>
                                        <div class="panel-body">
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Licensing Type:</div>
                                                    <div class="col-md-7 value"> {{$list->licensure_type}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> License Number:</div>
                                                    <div class="col-md-7 value"> {{$list->licensure_number}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">Date Of Medical Licensing:</div>
                                                    <div class="col-md-7 value"> {{$list->licensure_date_of_licensing}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">License Expiration Date:</div>
                                                    <div class="col-md-7 value"> {{$list->licensure_expiration_date}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name">Licensing Body Contact:</div>
                                                    <div class="col-md-7 value"> {{$list->licensure_contact}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Additional Information</div>
                                        <div class="panel-body">
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Language Fluency:</div>
                                                    <div class="col-md-7 value"> {{$list->additional_language_fluency}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> IELTS/TOEFL Score:</div>
                                                    <div class="col-md-7 value"> {{$list->additional_tofel_score}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-12 name">Medical Examination (USA Medical Exam USMLE,
                                                        Canadian Medical Exam MCCEE, MCCQE, UK Medical Exam PLAB Etc…):
                                                    </div>
                                                    <div class="col-md-12 value"> {{$list->additional_medical_examination}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-12 name">Has Your Medical License Ever Been
                                                        Suspended/Revoked/Voluntarily Terminated?:
                                                    </div>
                                                    <div class="col-md-12 value"> {{$list->additional_suspended_revoked}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-12 name">Have You Been Named In A Malpractice Case?</div>
                                                    <div class="col-md-12 value"> {{$list->additional_malpractice}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-12 name">Is There Anything In Your Past History That
                                                        Would Limit Your Ability To Be Licensed Or Would Limit Your Ability To
                                                        Receive Hospital Privileges?
                                                    </div>
                                                    <div class="col-md-12 value"> {{$list->additional_hospital_privileges}} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-12 name">Are You Able To Carry Out The Responsibilities
                                                        Of A Resident Or A Fellow In The Specialties And At The Specific
                                                        Training Programs To Which You Are Applying, Including The Functional
                                                        Requirements, Cognitive Requirements, Interpersonal And Communication
                                                        Requirements With Or Without Reasonable Accommodations?
                                                    </div>
                                                    <div class="col-md-12 value"> {{$list->additional_responsibilities}} </div>
                                                </div>
                                                @if($list->additional_responsibilities=="yes")
                                                    <div class="row static-info">
                                                        <div class="col-md-12 name">Detail</div>
                                                        <div class="col-md-12 value"> {{$list->additional_responsibilities_detail}} </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{admin_url('users')}}" class="btn grey">Back</a>

                        </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END DASHBOARD STATS 1-->

            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection