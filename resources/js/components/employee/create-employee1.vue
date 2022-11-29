<template>
<div class="card">
    <div class="row card-body">
        <div class="col-lg-12">
            <form v-loading="loading" @submit.prevent="createEmployee" method='POST'>
                <div class="tab-content profile-tab-content">

                    <!-- personal_info Tab -->
                    <div v-if="step===0" id="personal_info" class="">
                        <div style="margin-bottom: 50px">
                            <h2>Staff Details</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                    <input v-model="fName" class="form-control"   required name="f_name" autocomplete="f_name"  type="text" autofocus id="f_name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Middle Name </label>
                                    <input v-model="mName" class="form-control"  name="m_name" autocomplete="m_name"  type="text" autofocus id="m_name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Last Name <span class="text-danger">*</span></label>
                                    <input v-model="lName" class="form-control" required  name="l_name" autocomplete="l_name"  type="text" autofocus id="l_name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Date of birth <span class="text-danger">*</span></label>
                                    <input v-model="dob" class="form-control"  required name="dob" autocomplete="dob"  type="date" id="dob">

                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Gender</label>
                                    <select  v-model="gender" class="form-control" required name="gender">
                                        <option :value="gender.id" v-for="(gender,index) in genderData">{{gender.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Country</label>
                                    <select v-model="country" class=" form-control" required name="country_id">
                                        <option :value="country.id" v-for="(country,index) in countryData">{{country.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Work Email<span class="text-danger">*</span></label>
                                    <input  v-model="workEmail"  class="form-control"  required  autocomplete="username"  type="text" autofocus >

                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Personal Email<span class="text-danger">*</span></label>
                                    <input v-model="personalEmail" class="form-control"  required  autocomplete="username"  type="text" autofocus >

                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Residence<span class="text-danger">*</span></label>
                                    <input v-model="residence" class="form-control"   required    type="text" >

                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Permanent Address<span class="text-danger">*</span></label>
                                    <input v-model="pAddress" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Primary phone<span class="text-danger">*</span></label>
                                    <input v-model="phone1" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">Secondary Phone<span class="text-danger">*</span></label>
                                    <input v-model="phone2" class="form-control"    type="text" autofocus >

                                </div>
                            </div>


                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <button @click="goToContractDetails" class="btn btn-success submit-btn col-12">Next</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- contract details Tab -->

                    <div v-if="step===1">
                        <div style="margin-bottom: 50px">
                            <h2>Contract Details</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Contract Type</label>
                                    <select  v-model="contract" class="form-control" required name="contract">
                                        <option :value="contract.id" v-for="(contract,index) in contracts">{{contract.type}}</option>
                                    </select>
                                </div>
                            </div>
                            <div v-if="contract===1 || contract===2" class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">SAP Number <span class="text-danger">*</span></label>
                                    <input v-model="sap" class="form-control"  required name="sap" autocomplete="sap"  type="text" autofocus id="sap">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Contract Start Date <span class="text-danger">*</span></label>
                                    <input v-model="contractStart" class="form-control"  required   type="date" autofocus >

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">

                                    <label class="col-form-label">Contract Expiry Date<span class="text-danger">*</span></label>
                                    <input v-model="contractExpiry" class="form-control"  required   type="date" autofocus >

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Department</label>
                                    <select  v-model="department" class="form-control" required name="department">
                                        <option :value="department.id" v-for="(department,index) in departmentData">{{department.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Designation</label>
                                    <select  v-model="designation" class="form-control" required name="designation">
                                        <option :value="designation.id" v-for="(designation,index) in designationData">{{designation.name}}</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Projects</label>
                                    <select  v-model="project" class="form-control" required name="project">
                                        <option :value="project.id" v-for="(project,index) in projectData">{{project.name}}</option>
                                        {{dd('project')}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Reports To</label>
                                    <select  v-model="report_to" class="form-control" required name="designation">
                                        <option :value="employee.id" v-for="(employee,index) in employeeData">{{employee.first_name}} {{employee.middle_name}} {{employee.last_name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-between">
                                <div class="col-4" style="float: left" >
                                    <button @click="back" class="btn btn-primary submit-btn col-12">BACK</button>
                                </div>
                                <div class="col-4" style="float: right">
                                    <button @click="goToStatutoryDetails" class="btn btn-success submit-btn col-12">Next</button>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div v-if="step===2">
                        <div style="margin-bottom: 50px">
                            <h2>Statutory Details</h2>
                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">National ID<span class="text-danger">*</span></label>
                                    <input v-model="nationalId" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Passport Number</label>
                                    <input v-model="passportNo" class="form-control"   type="text" autofocus >

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Huduma Number</label>
                                    <input v-model="hudumaNumber" class="form-control"  type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Tax PIN<span class="text-danger">*</span></label>
                                    <input v-model="taxPin" class="form-control" required  type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">NSSF<span class="text-danger">*</span></label>
                                    <input v-model="nssf" class="form-control" required  type="text" autofocus >

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">NHIF<span class="text-danger">*</span></label>
                                    <input v-model="nhif" class="form-control" required  type="text" autofocus >

                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="row justify-content-between">
                                <div class="col-4" >
                                    <button @click="back" class="btn btn-primary submit-btn col-12">BACK</button>
                                </div>
                                <div class="col-4">
                                    <div class="col-12">
                                        <button @click="goToEducationDetails" class="btn btn-success submit-btn col-12">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div v-if="step===3">
                        <button @click="addEducationLevel" class="btn btn-primary btn-sm">ADD EDUCATION DETAILS</button>
                        <div v-if="educationLevelsDataArray.length > 0 " v-for="(input,index) in educationLevelsDataArray" :key="index" class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Education Level</label>
                                    <select  v-model="input.educationLevel" class="form-control" required name="educationLevel">
                                        <option :value="level.id" v-for="(level,index) in educationLevelsData">{{level.name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Institution<span class="text-danger">*</span></label>
                                    <input v-model="input.educationInstitution" name="educationInstitution" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Field of Study<span class="text-danger">*</span></label>
                                    <input v-model="input.educationFieldOfStudy" name="educationFieldOfStudy" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Start Date<span class="text-danger">*</span></label>
                                    <input v-model="input.educationStart" class="form-control" name="educationStart"  required   type="date" autofocus >

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">End Date<span class="text-danger">*</span></label>
                                    <input v-model="input.educationEnd" class="form-control" name="educationEnd"  required   type="date" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                                <button class="btn btn-danger col-12" type="button" @click="removeEducation(index)">REMOVE</button>
                            </div>

                        </div>

                        <div style="margin-top: 30px" class="col-12">
                            <div class="row justify-content-between">
                                <div class="col-4" >
                                    <button @click="back" class="btn btn-primary submit-btn col-12">BACK</button>
                                </div>
                                <div class="col-4">
                                    <button @click="gotToBankDetails" class="btn btn-success submit-btn col-12">Next</button>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div v-if="step===4">
                        <div style="margin-bottom: 50px">
                            <h2>Bank Details</h2>
                        </div>
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Bank Name<span class="text-danger">*</span></label>
                                    <input v-model="bankName" class="form-control"  name="bankName"  required   type="text" autofocus >

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label"> Branch Name<span class="text-danger">*</span></label>
                                    <input v-model="branchName" class="form-control" name="branchName" required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Branch Code<span class="text-danger">*</span></label>
                                    <input v-model="branchCode" class="form-control" name="branchCode"  required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Account Name<span class="text-danger">*</span></label>
                                    <input v-model="accountName" class="form-control" name="accountName"  required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Account Number<span class="text-danger">*</span></label>
                                    <input v-model="accountNumber" class="form-control" name="accountNumber"  required   type="text" autofocus >

                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="row justify-content-between">
                                <div class="col-4" >
                                    <button @click="back" class="btn btn-primary submit-btn col-12">BACK</button>
                                </div>
                                <div class="col-4">
                                    <button @click="goToHealthDetails" class="btn btn-success submit-btn col-12" >Next</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="step===5">
                        <div style="margin-bottom: 50px">
                            <h2>Health Details</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Blood Group</label>
                                    <select  v-model="bloodGroup" class="form-control" required name="level">
                                        <option :value="group.id" v-for="(group,index) in bloodGroupsData">{{group.name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Disability</label>
                                    <el-switch
                                        v-model="disabilityStatus"
                                        active-color="#13ce66"
                                        inactive-color="#ff4949">
                                    </el-switch>
                                </div>
                            </div>

                            <div v-if="disabilityStatus" class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Disability Details<span class="text-danger">*</span></label>
                                    <input v-model="disabilityDetails" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Health Condition</label>
                                    <el-switch
                                        v-model="healthStatus"
                                        active-color="#13ce66"
                                        inactive-color="#ff4949">
                                    </el-switch>
                                </div>
                            </div>

                            <div v-if="healthStatus" class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Health Details<span class="text-danger">*</span></label>
                                    <input v-model="healthDetails" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="row justify-content-between">
                                <div class="col-4" >
                                    <button @click="back" class="btn btn-primary submit-btn col-12">BACK</button>
                                </div>
                                <div class="col-4">
                                    <button @click="goToNextOfKin" class="btn btn-success submit-btn col-12" >Next</button>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div v-if="step===6">
                        <button @click="addNextOfKin" class="btn btn-primary btn-sm">ADD NEXT OF KIN</button>
                        <div v-if="nextOfKinArray.length > 0" v-for="(input,index) in nextOfKinArray" :key="index" class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Full Name<span class="text-danger">*</span></label>
                                    <input v-model="input.nextOfKinFullName" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Relationship<span class="text-danger">*</span></label>
                                    <input v-model="input.nextOfKinRelationship" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Contact<span class="text-danger">*</span></label>
                                    <input v-model="input.nextOfKinPhone" class="form-control"  required   type="text" autofocus >

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <button class="btn btn-danger col-12" type="button" @click="removeNextOfKin(index)">REMOVE</button>
                            </div>
                        </div>

                        <div style="margin-top: 40px" class="col-12">
                            <div class="row justify-content-between">
                                <div class="col-4" >
                                    <button @click="back" class="btn btn-primary submit-btn col-12">BACK</button>
                                </div>
                                <div class="col-4">
                                    <button @click="gotToLanguages" class="btn btn-success submit-btn col-12" >Next</button>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div v-if="step===7">
                        <div style="margin-bottom: 50px">
                            <h2>Select Language</h2>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label">Languages</label>
                                <el-select v-model="selectedLanguages" multiple placeholder="Select">
                                    <el-option
                                        v-for="item in languageData"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row justify-content-between">
                                <div class="col-4" >
                                    <button @click="back" class="btn btn-primary submit-btn col-12">BACK</button>
                                </div>
                                <div class="col-4">
                                    <button @click="createEmployee" class="btn btn-success submit-btn col-12" type='submit'>SUBMIT DETAILS</button>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>

</div>
</template>

<script>
import ElementUI from "element-ui";

export default {
    name: "create-employee",
    props:{
        employees:Array,
        countries:Array,
        genders: Array,
        statuses:Array,
        contracts:Array,
        departments:Array,
        designations:Array,
        projects:Array,
        groups:Array,
        disability_statuses:Array,
        health_statuses:Array,
        languages:Array,
        education_levels:Array
    },
    created() {
        console.log('The data' +JSON.stringify(this.contracts));
    },
    data(){
       return{
           loading:false,
           employeeData:this.employees,
           step:0,
           countryData:this.countries,
           genderData:this.genders,
           statusData:this.statuses,
           educationLevelsData:this.education_levels,
           contractData:this.contracts,
           departmentData:this.departments,
           designationData:this.designations,
           projectData:this.projects,
           bloodGroupsData:this.groups,
           disabilityData:this.disability_statuses,
           healthData:this.health_statuses,
           languageData:this.languages,
           sap: null,
           fName:null,
           lName:null,
           mName:null,
           dob:null,
           gender:null,
           country:null,
           workEmail:null,
           personalEmail:null,
           residence:null,
           pAddress:null,
           status:null,
           contract:null,
           contractStart:null,
           contractExpiry:null,
           department:null,
           designation:null,
           report_to:null,
           project:null,
           nationalId:null,
           passportNo:null,
           hudumaNumber:null,
           taxPin:null,
           nssf:null,
           nhif:null,
           phone1:'',
           phone2:'',
           educationLevelsDataArray:[],

           bankName:null,
           branchName:null,
           branchCode:null,
           accountName:null,
           accountNumber:null,

           bloodGroup:null,
           disabilityStatus:false,
           disabilityDetails:null,
           healthStatus:false,
           healthDetails:null,

           nextOfKinArray:[

           ],


           selectedLanguages:[

           ]

       }
    },
    watch:{
        fName: function (val) {
            this.workEmail = val.toLowerCase()+ '.' + this.lName.toLowerCase()+'@technobrainbpo.com'
        },
        mName: function (val) {
            this.workEmail = this.fName.toLowerCase()+'.'  + val.toLowerCase()+'@technobrainbpo.com'
        }
    },
    methods:{

        removeEducation(index) {
            this.educationLevelsDataArray.splice(index, 1);
        },

        removeNextOfKin(index) {
            this.nextOfKinArray.splice(index, 1);
        },

        back(){
            if (this.step !==0){
                this.step --;
            }
            else{
                this.step=0;
            }

        },

        goToContractDetails(){

             if (!this.fName){
                this.$message.error('Please enter first name.');
            }
            else if (!this.mName){
                this.$message.error('Please enter middle name.');
            }
            else if (!this.dob){
                this.$message.error('Please enter date of birth.');
            }
            else if (!this.gender){
                this.$message.error('Please select gender.');
            }
            else if (!this.country){
                this.$message.error('Please select country.');
            }
            else if (!this.workEmail){
                this.$message.error('Please enter work email.');
            }
            else if (!this.personalEmail){
                this.$message.error('Please enter personal email.');
            }
             else if (!this.phone1){
                 this.$message.error('Please enter primary phone number.');
             }
            else if (!this.residence){
                this.$message.error('Please enter residence.');
            }
            else if (!this.pAddress){
                this.$message.error('Please enter permanent address.');
            }

            else{
                this.step=1
            }
        },

        goToStatutoryDetails(){
            if (!this.contract){
                this.$message.error('Please select contract type.');
            }
            else if (!this.contractStart){
                this.$message.error('Please select contract start date.');
            }
            else if (!this.contractExpiry){
                this.$message.error('Please select contract expiry date.');
            }
            else if (!this.department){
                this.$message.error('Please select department.');
            }
            else if (!this.designation){
                this.$message.error('Please select designation.');
            }

           else if (!this.project){
               this.$message.error('Please select project.');
            }
            else{
                this.step=2;
            }
        },

        goToEducationDetails(){
            if (!this.nationalId){
                this.$message.error('Please enter national ID');
            }
            else if (!this.taxPin){
                this.$message.error('Please enter TAX PIN ');
            }
            else if (!this.nssf){
                this.$message.error('Please enter NSSF ');
            }
            else if (!this.nhif){
                this.$message.error('Please enter NHIF ');
            }
            else{

                this.step=3;
            }
        },
        addEducationLevel(){

            this.educationLevelsDataArray.push({educationLevels:null,educationInstitution: null,
                educationFieldOfStudy: null,educationStart: null,educationEnd: null})
        },
        gotToBankDetails(){
            if(this.educationLevelsDataArray <= 0){
                this.$message.error("Please add staff education history");
            }

           else {
                this.step=4;

            }
        },
        goToHealthDetails(){
            if (!this.bankName){
                this.$message.error('Please enter bank name');
            }
            else  if (!this.branchName){
                this.$message.error('Please enter branch name');
            }
            else  if (!this.branchCode){
                this.$message.error('Please enter branch code');
            }
            else  if (!this.accountName){
                this.$message.error('Please enter account name');
            }
            else  if (!this.accountNumber){
                this.$message.error('Please enter account number')
            }
            else{
                this.step=5;

            }
        },
        goToNextOfKin(){
            if (!this.bloodGroup){
                this.$message.error('Please select blood group')

            }
            else{
                this.step=6;
            }
        },
        addNextOfKin(){
            this.nextOfKinArray.push({nextOfKinFullName:null,nextOfKinRelationship:null, nextOfKinPhone:null})
        },
        gotToLanguages(){
            if (this.nextOfKinArray <=0){
                this.$message.error("Please add staff next of KIN");
            }
            else{

                this.step=7;

            }
        },
        createEmployee(){
            if (this.selectedLanguages.length <=0){
                this.$message.error('Please select languages')

            }
            else{
                event.preventDefault();

                this.loading=true;

                const config = {
                    headers: {

                    }
                }



                if (!this.report_to){


                    const  formData=new FormData();

                    formData.append('sap',this.sap);
                    formData.append('f_name',this.fName);
                    formData.append('m_name',this.mName);
                    formData.append('l_name',this.lName);
                    formData.append('dob',this.dob);
                    formData.append('gender',this.gender);
                    formData.append('country_id',this.country);

                    formData.append('phone1',this.phone1);
                    formData.append('phone2',this.phone2);
                    formData.append('work_email',this.workEmail);
                    formData.append('personal_email',this.personalEmail);
                    formData.append('residence',this.residence);
                    formData.append('permanent_address',this.pAddress);

                    formData.append('contract_id',this.contract);
                    formData.append('contract_expiry',this.contractExpiry);
                    formData.append('contract_start',this.contractStart);
                    formData.append('department_id',this.department);
                    formData.append('designation_id',this.designation);
                    formData.append('project_id',this.project);

                    formData.append('passport_number',this.passportNo);
                    formData.append('huduma_number',this.hudumaNumber);
                    formData.append('national_id',this.nationalId);
                    formData.append('kra_pin',this.taxPin);
                    formData.append('nssf',this.nssf);
                    formData.append('nhif',this.nhif);

                    formData.append('bank_name',this.bankName);
                    formData.append('branch_code',this.branchCode);
                    formData.append('bank_branch',this.branchName);
                    formData.append('account_name',this.accountName);
                    formData.append('account_number',this.accountNumber);

                    formData.append('blood_group',this.bloodGroup);
                    formData.append('medical_condition_description',this.healthDetails);
                    formData.append('nextOfKin',JSON.stringify(this.nextOfKinArray));
                    formData.append('educationDetails',JSON.stringify(this.educationLevelsDataArray));
                    console.log(JSON.stringify(this.selectedLanguages));
                    formData.append('languages',JSON.stringify(this.selectedLanguages));
                    if (this.disabilityStatus){
                        formData.append('disability',   '1');
                    }
                    else{
                        formData.append('disability',   '0');
                    }
                    formData.append('disability_details',this.disabilityDetails);

                    if (this.disabilityStatus){
                        formData.append('medical_condition','1');
                    }
                    else{

                        formData.append('medical_condition','0');

                    }

                    axios.post('/create_employee',formData,config).then((resp)=>{
                        this.loading=false;
                        if (resp.data.status){

                            this.$message.success(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_employees";

                            },1000);

                        }
                        else{

                            this.$message.error(resp.data.message);

                        }
                    })

                }
                else{


                    const  formData=new FormData();

                    formData.append('sap',this.sap);
                    formData.append('f_name',this.fName);
                    formData.append('m_name',this.mName);
                    formData.append('l_name',this.lName);
                    formData.append('dob',this.dob);
                    formData.append('gender',this.gender);
                    formData.append('country_id',this.country);

                    formData.append('phone1',this.personalEmail);
                    formData.append('work_email',this.workEmail);
                    formData.append('personal_email',this.personalEmail);
                    formData.append('residence',this.residence);
                    formData.append('permanent_address',this.pAddress);

                    formData.append('contract_id',this.contract);
                    formData.append('contract_expiry',this.contractExpiry);
                    formData.append('contract_start',this.contractStart);
                    formData.append('department_id',this.department);
                    formData.append('designation_id',this.designation);
                    formData.append('project_id',this.project);
                    formData.append('report_to',this.report_to);

                    formData.append('passport_number',this.passportNo);
                    formData.append('huduma_number',this.hudumaNumber);
                    formData.append('national_id',this.nationalId);
                    formData.append('kra_pin',this.taxPin);
                    formData.append('nssf',this.nssf);
                    formData.append('nhif',this.nhif);

                    formData.append('bank_name',this.bankName);
                    formData.append('branch_code',this.branchCode);
                    formData.append('bank_branch',this.branchName);
                    formData.append('account_name',this.accountName);
                    formData.append('account_number',this.accountNumber);

                    formData.append('blood_group',this.bloodGroup);
                    formData.append('medical_condition_description',this.healthDetails);
                    formData.append('nextOfKin',JSON.stringify(this.nextOfKinArray));
                    formData.append('educationDetails',JSON.stringify(this.educationLevelsDataArray));
                    console.log(JSON.stringify(this.selectedLanguages));
                    formData.append('languages',JSON.stringify(this.selectedLanguages));
                    if (this.disabilityStatus){
                        formData.append('disability',   '1');
                    }
                    else{
                        formData.append('disability',   '0');
                    }
                    formData.append('disability_details',this.disabilityDetails);

                    if (this.disabilityStatus){
                        formData.append('medical_condition','1');
                    }
                    else{

                        formData.append('medical_condition','0');

                    }


                    axios.post('/create_employee',formData,config).then((resp)=>{
                        this.loading=false;
                        if (resp.data.status){

                            this.$message.success(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_employees";

                            },1000);

                        }
                        else{

                            this.$message.error(resp.data.message);

                        }
                    })


                }




            }

        }
    }
}
</script>

<style scoped>

</style>
