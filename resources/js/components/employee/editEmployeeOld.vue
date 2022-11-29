<template>
  <div class="card">
    <div class="row card-body">
      <div class="col-lg-12">
        <form v-loading="loading" @submit.prevent="editEmployee" method="POST">
          <div class="tab-content profile-tab-content">
            <!-- personal_info Tab -->
            <div v-if="step === 0" id="personal_info" class="">
              <div style="margin-bottom: 50px">
                <h2>Staff Details</h2>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >SAP Number <span class="text-danger">*</span></label
                    >
                    <input
                      v-model="sap"
                      class="form-control"
                      required
                      name="sap"
                      autocomplete="sap"
                      type="text"
                      autofocus
                      id="sap"
                    />
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >First Name <span class="text-danger">*</span></label
                    >
                    <input
                      v-model="fName"
                      class="form-control"
                      required
                      name="f_name"
                      autocomplete="f_name"
                      type="text"
                      autofocus
                      id="f_name"
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Middle Name <span class="text-danger"></span
                    ></label>
                    <input
                      v-model="mName"
                      class="form-control"
                      required
                      name="m_name"
                      autocomplete="m_name"
                      type="text"
                      autofocus
                      id="m_name"
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Last Name <span class="text-danger">*</span></label
                    >
                    <input
                      v-model="lName"
                      class="form-control"
                      required
                      name="l_name"
                      autocomplete="l_name"
                      type="text"
                      autofocus
                      id="l_name"
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Date of birth <span class="text-danger">*</span></label
                    >
                    <input
                      v-model="dob"
                      class="form-control"
                      required
                      name="dob"
                      autocomplete="dob"
                      type="date"
                      id="dob"
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label">Gender</label>
                    <select
                      v-model="gender"
                      class="form-control"
                      required
                      name="gender_id"
                    >
                      <option
                        :value="gender.id"
                        v-for="(gender, index) in genderData"
                        :key="index"
                      >
                        {{ gender.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="class form-group">
                    <label class="col-form-label">Marital Status</label>
                    <select
                      v-model="marital_status"
                      class="form-control"
                      required
                      name="marital_status_id"
                    >
                      <option
                        :value="marital_status.id"
                        v-for="(marital_status, index) in marital_statusData"
                        :key="index"
                      >
                        {{ marital_status.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label">Country</label>
                    <select
                      v-model="country"
                      class="form-control"
                      required
                      name="country_id"
                    >
                      <option
                        :value="country.id"
                        v-for="(country, index) in countryData"
                        :key="index"
                      >
                        {{ country.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Work Email<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="workEmail"
                      class="form-control"
                      required
                      autocomplete="username"
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Personal Email<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="personalEmail"
                      class="form-control"
                      required
                      autocomplete="username"
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Residence<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="residence"
                      class="form-control"
                      required
                      type="text"
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Permanent Address<span class="text-danger"
                        >*</span
                      ></label
                    >
                    <input
                      v-model="pAddress"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Primary Phone<span class="text-danger">*</span></label
                    >
                    <vue-phone-number-input
                      v-model="phone1"
                      default-country-code="KE"
                      color="#FF0000"
                      :only-countries="[
                        'KE',
                        'UG',
                        'TZ',
                        'MW',
                        'GH',
                        'ET',
                        'ZM',
                      ]"
                    ></vue-phone-number-input>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Secondary Phone<span class="text-danger">*</span></label
                    >
                    <vue-phone-number-input
                      v-model="phone2"
                      default-country-code="KE"
                      color="#FF0000"
                      :only-countries="[
                        'KE',
                        'UG',
                        'TZ',
                        'MW',
                        'GH',
                        'ET',
                        'ZM',
                      ]"
                    ></vue-phone-number-input>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row">
                  <div class="col-12">
                    <button
                      @click="goToContractDetails"
                      class="btn btn-success submit-btn col-12"
                    >
                      Next
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- contract details Tab -->

            <div v-if="step === 1">
              <div style="margin-bottom: 50px">
                <h2>Contract Details</h2>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label">Contract Type</label>
                    <select
                      v-model="contract"
                      class="form-control"
                      required
                      name="contract"
                    >
                      <option
                        :value="contract.id"
                        v-for="(contract, index) in contracts"
                        :key="index"
                      >
                        {{ contract.type }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Start Date<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="contractStart"
                      class="form-control"
                      required
                      type="date"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Expiry Date<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="contractExpiry"
                      class="form-control"
                      required
                      type="date"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Basic Salary<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="basic_salary"
                      class="form-control"
                      required
                      type="number"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label">Department</label>
                    <select
                      v-model="department"
                      class="form-control"
                      required
                      name="department"
                    >
                      <option
                        :value="department.id"
                        v-for="(department, index) in departmentData"
                        :key="index"
                      >
                        {{ department.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label">Designation</label>
                    <select
                      v-model="designation"
                      class="form-control"
                      required
                      name="designation"
                    >
                      <option
                        :value="designation.id"
                        v-for="(designation, index) in designationData"
                        :key="index"
                      >
                        {{ designation.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label">Project</label>
                    <select
                      v-model="project"
                      class="form-control"
                      name="designation"
                    >
                      <option
                        :value="project.id"
                        v-for="(project, index) in projectsData"
                        :key="index"
                      >
                        {{ project.name }}
                      </option>
                    </select>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label">Reports To</label>
                    <select
                      v-model="report_to"
                      class="form-control"
                      name="designations"
                    >
                      <option
                        :value="employee.id"
                        v-for="(employee, index) in employeeData"
                        :key="index"
                      >
                        {{ employee.first_name }} {{ employee.middle_name }}
                        {{ employee.last_name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row">
                  <div class="col">
                    <button
                      @click="back"
                      class="btn btn-primary submit-btn col-12"
                    >
                      BACK
                    </button>
                  </div>
                  <div class="col">
                    <button
                      @click="goToStatutoryDetails"
                      class="btn btn-success submit-btn col-12"
                    >
                      Next
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="step === 2">
              <div style="margin-bottom: 50px">
                <h2>Statutory Details</h2>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >National ID<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="national_id"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label">Passport Number</label>
                    <input
                      v-model="passport_number"
                      class="form-control"
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label">Huduma Number</label>
                    <input
                      v-model="huduma_number"
                      class="form-control"
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Tax PIN<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="taxPin"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >NSSF<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="nssf"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >NHIF<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="nhif"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row">
                  <div class="col">
                    <button
                      @click="back"
                      class="btn btn-primary submit-btn col-12"
                    >
                      BACK
                    </button>
                  </div>
                  <div class="col">
                    <div class="col-12">
                      <button
                        @click="goToEducationDetails"
                        class="btn btn-success submit-btn col-12"
                      >
                        Next
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="step === 3">
              <button @click="addEducationLevel" class="btn btn-primary btn-sm">
                ADD EDUCATION DETAILS
              </button>
              <div
                v-if="educationLevelsDataArray.length > 0"
                v-for="(input, index) in educationLevelsDataArray"
                :key="index"
                class="row"
              >
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label">Education Level</label>
                    <select
                      v-model="input.educationLevel"
                      class="form-control"
                      required
                      name="educationLevel"
                    >
                      <option
                        :value="level.id"
                        v-for="(level, index) in educationLevelsData"
                        :key="index"
                      >
                        {{ level.name }}
                      </option>
                    </select>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Institution<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="input.educationInstitution"
                      name="educationInstitution"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Field of Study<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="input.educationFieldOfStudy"
                      name="educationFieldOfStudy"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Start Date<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="input.educationStart"
                      class="form-control"
                      name="educationStart"
                      required
                      type="date"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label"
                      >End Date<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="input.educationEnd"
                      class="form-control"
                      name="educationEnd"
                      required
                      type="date"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-12 col-lg-4 col-md-4 col-xl-4">
                  <button
                    class="btn btn-danger col-12"
                    type="button"
                    @click="removeEducation(index)"
                  >
                    REMOVE
                  </button>
                </div>
              </div>

              <div style="margin-top: 30px" class="col-12">
                <div class="row justify-content-between">
                  <div class="col-4">
                    <button
                      @click="back"
                      class="btn btn-primary submit-btn col-12"
                    >
                      BACK
                    </button>
                  </div>
                  <div class="col-4">
                    <button
                      @click="gotToBankDetails"
                      class="btn btn-success submit-btn col-12"
                    >
                      Next
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="step === 4">
              <div style="margin-bottom: 50px">
                <h2>Bank Details</h2>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Bank Name<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="bankName"
                      class="form-control"
                      name="bankName"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label">
                      Branch Name<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="branchName"
                      class="form-control"
                      name="branchName"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Branch Code<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="branchCode"
                      class="form-control"
                      name="branchCode"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Account Name<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="accountName"
                      class="form-control"
                      name="accountName"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Account Number<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="accountNumber"
                      class="form-control"
                      name="accountNumber"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row justify-content-between">
                  <div class="col">
                    <button
                      @click="back"
                      class="btn btn-primary submit-btn col-12"
                    >
                      BACK
                    </button>
                  </div>
                  <div class="col-4">
                    <button
                      @click="goToHealthDetails"
                      class="btn btn-success submit-btn col-12"
                    >
                      Next
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="step === 5">
              <div style="margin-bottom: 50px">
                <h2>Health Details</h2>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-form-label">Blood Group</label>
                    <select
                      v-model="bloodGroup"
                      class="form-control"
                      required
                      name="level"
                    >
                      <option
                        :value="group.id"
                        v-for="(group, index) in bloodGroupsData"
                        :key="index"
                      >
                        {{ group.name }}
                      </option>
                    </select>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-form-label">Disability</label>
                    <el-switch
                      v-model="disabilityStatus"
                      active-color="#13ce66"
                      inactive-color="#ff4949"
                    >
                    </el-switch>
                  </div>
                </div>

                <div v-if="disabilityStatus" class="col-sm-12">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Disability Details<span class="text-danger"
                        >*</span
                      ></label
                    >
                    <input
                      v-model="disabilityDetails"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-form-label">Health Condition</label>
                    <el-switch
                      v-model="healthStatus"
                      active-color="#13ce66"
                      inactive-color="#ff4949"
                    >
                    </el-switch>
                  </div>
                </div>

                <div v-if="healthStatus" class="col-sm-12">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Health Details<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="healthDetails"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row justify-content-between">
                  <div class="col-4">
                    <button
                      @click="back"
                      class="btn btn-primary submit-btn col-12"
                    >
                      BACK
                    </button>
                  </div>
                  <div class="col-4">
                    <button
                      @click="goToNextOfKin"
                      class="btn btn-success submit-btn col-12"
                    >
                      Next
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="step === 6">
              <button @click="addNextOfKin" class="btn btn-primary btn-sm">
                ADD NEXT OF KIN
              </button>
              <div
                v-if="nextOfKinArray.length > 0"
                v-for="(input, index) in nextOfKinArray"
                :key="index"
                class="row"
              >
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Full Name<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="input.nextOfKinFullName"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Relationship<span class="text-danger">*</span></label
                    >
                    <input
                      v-model="input.nextOfKinRelationship"
                      class="form-control"
                      required
                      type="text"
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Contact<span class="text-danger">*</span></label
                    >
                    <vue-phone-number-input
                      v-model="input.nextOfKinPhone"
                      default-country-code="KE"
                      color="#FF0000"
                    ></vue-phone-number-input>
                  </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <button
                    class="btn btn-danger col-12"
                    type="button"
                    @click="removeNextOfKin(index)"
                  >
                    REMOVE
                  </button>
                </div>
              </div>

              <div style="margin-top: 40px" class="col-12">
                <div class="row justify-content-between">
                  <div class="col-4">
                    <button
                      @click="back"
                      class="btn btn-primary submit-btn col-12"
                    >
                      BACK
                    </button>
                  </div>
                  <div class="col-4">
                    <button
                      @click="gotToLanguages"
                      class="btn btn-success submit-btn col-12"
                    >
                      Next
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="step === 7">
              <div style="margin-bottom: 50px">
                <h2>Select Language</h2>
              </div>

              <!-- <div class="col-sm-12">
                <div class="form-group">
                  <input
                    v-model="selectedLanguages"
                    type="text"
                    class="form-control"
                    list="languageData"
                    id="languageData"
                    size="50"
                    name="languages"
                    placeholder="Type languages"
                    required
                    autofocus
                  />
                  <small>Type languages and separate with comma</small>
                  <datalist id="languageData">
                    <option
                      v-for="item in languageData"
                      :key="item.name"
                      :label="item.name"
                      :value="item.name"
                    ></option>
                  </datalist>
                </div>
              </div> -->
  <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Language 1 <span class="text-danger">*</span></label
                    >
                    <input
                      v-model="language1"
                      class="form-control"
                      required
                      name="language1"
                      autocomplete="language1"
                      type="text"
                      autofocus
                      id="language1"
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Language 2 <span class="text-danger">*</span></label
                    >
                    <input
                      v-model="language2"
                      class="form-control"
                      name="language2"
                      autocomplete="language2"
                      type="text"
                      autofocus
                      id="language2"
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Language 3 <span class="text-danger">*</span></label
                    >
                    <input
                      v-model="language3"
                      class="form-control"
                      name="language3"
                      autocomplete="language3"
                      type="text"
                      autofocus
                      id="language3"
                    />
                  </div>
                </div>
                   <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Language 4 <span class="text-danger">*</span></label
                    >
                    <input
                      v-model="language3"
                      class="form-control"
                      name="language4"
                      autocomplete="language4"
                      type="text"
                      autofocus
                      id="language4"
                    />
                  </div>
                </div>
                   <div class="col-sm-3">
                  <div class="form-group">
                    <label class="col-form-label"
                      >Language 5 <span class="text-danger">*</span></label
                    >
                    <input
                      v-model="language5"
                      class="form-control"
                      name="language5"
                      autocomplete="language5"
                      type="text"
                      autofocus
                      id="language5"
                    />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row justify-content-between">
                  <div class="col-4">
                    <button
                      @click="back"
                      class="btn btn-primary submit-btn col-12"
                    >
                      BACK
                    </button>
                  </div>
                  <div class="col-4">
                    <button
                      @click="editEmployee"
                      class="btn btn-success submit-btn col-12"
                      type="submit"
                    >
                      UPDATE
                    </button>
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
export default {
  name: "editEmployee",
  props: {
    current: Object,
    employees: Array,
    countries: Array,
    genders: Array,
    marital_statuses: Array,
    statuses: Array,
    contracts: Array,
    departments: Array,
    designations: Array,
    projects: Array,
    groups: Array,
    disability_statuses: Array,
    health_statuses: Array,
    languages: Array,
    education_levels: Array,
  },
  data() {
    return {
      loading: false,
      employeeData: this.employees,
      step: 0,
      countryData: this.countries,
      genderData: this.genders,
      marital_statusData: this.marital_statuses,
      statusData: this.statuses,
      educationLevelsData: this.education_levels,
      contractData: this.contracts,
      departmentData: this.departments,
      designationData: this.designations,
      projectsData: this.projects,
      bloodGroupsData: this.groups,
      disabilityData: this.disability_statuses,
      healthData: this.health_statuses,
      languageData: this.languages,
      sap: null,
      fName: null,
      lName: null,
      mName: null,
      dob: null,
      gender: null,
      marital_status: null,
      country: null,
      workEmail: null,
      personalEmail: null,
      residence: null,
      pAddress: null,
      status: null,
      contract: null,
      contractStart: null,
      contractExpiry: null,
      basic_salary: null,
      department: null,
      designation: null,
      report_to: null,
      project: null,
      national_id: null,
      passport_number: null,
      huduma_number: null,
      taxPin: null,
      nssf: null,
      nhif: null,
      phone1: "",
      phone2: "",
      educationLevelsDataArray: [],

      bankName: null,
      branchName: null,
      branchCode: null,
      accountName: null,
      accountNumber: null,

      bloodGroup: null,
      disabilityStatus: false,
      disabilityDetails: null,
      healthStatus: false,
      healthDetails: null,

      nextOfKinArray: [],

      selectedLanguages: [],
    };
  },
  mounted() {
    this.sap = this.current.sap;
    this.fName = this.current.first_name;
    this.lName = this.current.last_name;
    this.mName = this.current.middle_name;
    this.dob = this.current.dob;
    this.gender = this.current.gender_id;
    this.marital_status = this.current.marital_status_id;
    this.country = this.current.country_id;
    this.workEmail = this.current.work_email;
    this.personalEmail = this.current.personal_email;
    this.residence = this.current.residence;
    this.pAddress = this.current.permanent_address;
    this.contract = this.current.contract_id;
    this.contractStart = this.current.contract_start;
    this.contractExpiry = this.current.contract_expiry;
    this.basic_salary = this.current.basic_salary;
    this.department = this.current.department_id;
    this.designation = this.current.designation_id;
    this.project = this.current.project_id;
    this.report_to = this.current.report_to;
    this.national_id = this.current.national_id;
    this.passport_number = this.current.passport_number;
    this.huduma_number = this.current.huduma_number;
    this.taxPin = this.current.kra_pin;
    this.nssf = this.current.nssf;
    this.nhif = this.current.nhif;
    this.bankName = this.current.bank_name;
    this.branchCode = this.current.branch_code;
    this.branchName = this.current.bank_branch;
    this.accountName = this.current.account_name;
    this.accountNumber = this.current.account_number;
    this.bloodGroup = this.current.blood_group_id;
    this.disabilityStatus = this.current.disability_status_id;
    this.disabilityDetails = this.current.disability_details;
    this.healthStatuses = this.current.health_statuses;
    this.healthDetails = this.current.health_details;
    this.educationLevelsDataArray = this.current.educations;
    this.nextOfKinArray = this.current.nextOfKins;
    this.phone1 = this.current.phone1;
    this.phone2 = this.current.phone2;
  },
  watch: {
    fName: function (val) {
      this.workEmail =
        val.toLowerCase() +
        "." +
        this.lName.toLowerCase() +
        "@technobrainbpo.com";
    },
    mName: function (val) {
      this.workEmail =
        this.fName.toLowerCase() +
        "." +
        val.toLowerCase() +
        "@technobrainbpo.com";
    },
  },
  methods: {
    removeEducation(index) {
      this.educationLevelsDataArray.splice(index, 1);
    },

    removeNextOfKin(index) {
      this.nextOfKinArray.splice(index, 1);
    },

    back() {
      if (this.step !== 0) {
        this.step--;
      } else {
        this.step = 0;
      }
    },

    goToContractDetails() {
      if (!this.sap) {
        this.$message.error("Please enter SAP.");
      } else if (!this.fName) {
        this.$message.error("Please enter first name.");
      } else if (!this.mName) {
        this.$message.error("Please enter middle name.");
      } else if (!this.lName) {
        this.$message.error("Please enter last name.");
      } else if (!this.dob) {
        this.$message.error("Please enter date of birth.");
      } else if (!this.gender) {
        this.$message.error("Please select gender.");
      } else if (!this.marital_status) {
        this.$message.error("Please select marital status.");
      } else if (!this.country) {
        this.$message.error("Please select country.");
      } else if (!this.workEmail) {
        this.$message.error("Please enter work email.");
      } else if (!this.personalEmail) {
        this.$message.error("Please enter personal email.");
      } else if (!this.residence) {
        this.$message.error("Please enter residence.");
      } else if (!this.pAddress) {
        this.$message.error("Please enter permanent address.");
      } else if (!this.phone1) {
        this.$message.error("Please enter primary phone number.");
      } else {
        this.step = 1;
      }
    },

    goToStatutoryDetails() {
      if (!this.contract) {
        this.$message.error("Please select contract type.");
      } else if (!this.contractStart) {
        this.$message.error("Please select contract start date.");
      } else if (!this.contractExpiry) {
        this.$message.error("Please select contract expiry date.");
      } else if (!this.basic_salary) {
        this.$message.error("Please enter the basic salary.");
      } else if (!this.department) {
        this.$message.error("Please select department.");
      } else if (!this.designation) {
        this.$message.error("Please select designation.");
      } else if (!this.report_to) {
        this.$message.error(
          "Please select the person the employee reports to."
        );
      }
      // else if (!this.project){
      //this.$message.error('Please select project.');
      //}
      else {
        this.step = 2;
      }
    },

    goToEducationDetails() {
      if (!this.national_id) {
        this.$message.error("Please enter national ID");
      } else if (!this.taxPin) {
        this.$message.error("Please enter TAX PIN ");
      } else if (!this.nssf) {
        this.$message.error("Please enter NSSF ");
      } else if (!this.nhif) {
        this.$message.error("Please enter NHIF ");
      } else {
        this.step = 3;
      }
    },
    addEducationLevel() {
      this.educationLevelsDataArray.push({
        educationLevels: null,
        educationInstitution: null,
        educationFieldOfStudy: null,
        educationStart: null,
        educationEnd: null,
      });
    },
    gotToBankDetails() {
      if (this.educationLevelsDataArray <= 0) {
        this.$message.error("Please add staff education history");
      } else {
        this.step = 4;
      }
    },
    goToHealthDetails() {
      if (!this.bankName) {
        this.$message.error("Please enter bank name");
      } else if (!this.branchName) {
        this.$message.error("Please enter branch name");
      } else if (!this.branchCode) {
        this.$message.error("Please enter branch code");
      } else if (!this.accountName) {
        this.$message.error("Please enter account name");
      } else if (!this.accountNumber) {
        this.$message.error("Please enter account number");
      } else {
        this.step = 5;
      }
    },
    goToNextOfKin() {
      if (!this.bloodGroup) {
        this.$message.error("Please select blood group");
      } else {
        this.step = 6;
      }
    },
    addNextOfKin() {
      this.nextOfKinArray.push({
        nextOfKinFullName: null,
        nextOfKinRelationship: null,
        nextOfKinPhone: null,
      });
    },
    gotToLanguages() {
      if (this.nextOfKinArray <= 0) {
        this.$message.error("Please add staff next of KIN");
      } else {
        this.step = 7;
      }
    },
    editEmployee() {
      if (!this.selectedLanguages.length <= 0) {
        this.$message.error("Please type languages");
      } else {
        event.preventDefault();

        this.loading = true;

        const config = {
          headers: {},
        };

        if (!this.report_to) {
          const formData = new FormData();

          formData.append("sap", this.sap);
          formData.append("f_name", this.fName);
          formData.append("m_name", this.mName);
          formData.append("l_name", this.lName);
          formData.append("dob", this.dob);
          formData.append("gender_id", this.gender);
          formData.append("marital_status_id", this.marital_status);
          formData.append("country_id", this.country);
          formData.append("language_name", this.selectedLanguages);

          formData.append("phone1", this.phone1);
          formData.append("phone2", this.phone2);
          formData.append("work_email", this.workEmail);
          formData.append("personal_email", this.personalEmail);
          formData.append("residence", this.residence);
          formData.append("permanent_address", this.pAddress);

          formData.append("contract_id", this.contract);
          formData.append("contract_start", this.contractStart);
          formData.append("contract_expiry", this.contractExpiry);
          formData.append("basic_salary", this.basic_salary);
          formData.append("department_id", this.department);
          formData.append("designation_id", this.designation);
          formData.append("project_id", this.project);
          formData.append("report_to", this.report_to);

          formData.append("passport_number", this.passport_number);
          formData.append("huduma_number", this.huduma_number);
          formData.append("national_id", this.national_id);
          formData.append("kra_pin", this.taxPin);
          formData.append("nssf", this.nssf);
          formData.append("nhif", this.nhif);

          formData.append("bank_name", this.bankName);
          formData.append("branch_code", this.branchCode);
          formData.append("bank_branch", this.branchName);
          formData.append("account_name", this.accountName);
          formData.append("account_number", this.accountNumber);

          formData.append("blood_group", this.bloodGroup);
          formData.append("medical_condition_description", this.healthDetails);
          formData.append("nextOfKin", JSON.stringify(this.nextOfKinArray));
          formData.append(
            "educationDetails",
            JSON.stringify(this.educationLevelsDataArray)
          );
          console.log(JSON.stringify(this.selectedLanguages));
          formData.append("languages", JSON.stringify(this.selectedLanguages));
          if (this.disabilityStatus) {
            formData.append("disability", "1");
          } else {
            formData.append("disability", "0");
          }
          formData.append("disability_details", this.disabilityDetails);

          if (this.disabilityStatus) {
            formData.append("medical_condition", "1");
          } else {
            formData.append("medical_condition", "0");
          }

          axios.post("/create_employee", formData, config).then((resp) => {
            this.loading = false;
            if (resp.data.status) {
              this.$message.success(resp.data.message);

              setTimeout(function () {
                window.location.href = "/view_employees";
              }, 1000);
            } else {
              this.$message.error(resp.data.message);
            }
          });
        }
        else {
          const formData = new FormData();

          formData.append("sap", this.sap);
          formData.append("f_name", this.fName);
          formData.append("m_name", this.mName);
          formData.append("l_name", this.lName);
          formData.append("dob", this.dob);
          formData.append("gender_id", this.gender);
          formData.append("marital_status_id", this.marital_status);
          formData.append("country_id", this.country);
          formData.append("language_name", this.selectedLanguages);

          formData.append("phone1", this.phone1);
          formData.append("phone2", this.phone2);
          formData.append("work_email", this.workEmail);
          formData.append("personal_email", this.personalEmail);
          formData.append("residence", this.residence);
          formData.append("permanent_address", this.pAddress);

          formData.append("contract_id", this.contract);
          formData.append("contract_start", this.contractStart);
          formData.append("contract_expiry", this.contractExpiry);
          formData.append("basic_salary", this.basic_salary);
          formData.append("department_id", this.department);
          formData.append("designation_id", this.designation);
          formData.append("project_id", this.project);
          formData.append("report_to", this.report_to);

          formData.append("passport_number", this.passport_number);
          formData.append("huduma_number", this.huduma_number);
          formData.append("national_id", this.national_id);
          formData.append("kra_pin", this.taxPin);
          formData.append("nssf", this.nssf);
          formData.append("nhif", this.nhif);

          formData.append("bank_name", this.bankName);
          formData.append("branch_code", this.branchCode);
          formData.append("bank_branch", this.branchName);
          formData.append("account_name", this.accountName);
          formData.append("account_number", this.accountNumber);

          formData.append("blood_group", this.bloodGroup);
          formData.append("medical_condition_description", this.healthDetails);
          formData.append("nextOfKin", JSON.stringify(this.nextOfKinArray));
          formData.append(
            "educationDetails",
            JSON.stringify(this.educationLevelsDataArray)
          );
          console.log(JSON.stringify(this.selectedLanguages));
          formData.append("languages", JSON.stringify(this.selectedLanguages));
          if (this.disabilityStatus) {
            formData.append("disability", "1");
          } else {
            formData.append("disability", "0");
          }
          formData.append("disability_details", this.disabilityDetails);

          if (this.disabilityStatus) {
            formData.append("medical_condition", "1");
          } else {
            formData.append("medical_condition", "0");
          }
        axios
          .post("/edit_employee/" + this.current.id, formData, config)
          .then((resp) => {
            console.log("The employee error response" + resp);

            this.loading = false;
            if (resp.data.status) {
              this.$message.success(resp.data.message);

              setTimeout(function () {
                window.location.href = "/view_employees";
              }, 1000);
            } else {
              this.$message.error(resp.data.message);
            }
          });
      }
      }
    },
  },
};
</script>

<style scoped>
</style>
