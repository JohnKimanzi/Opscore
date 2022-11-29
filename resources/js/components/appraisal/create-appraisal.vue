<template>
<div class="card">
<div class="card-body">
    <form v-loading="loading" @submit.prevent="" method='POST'>
      <div v-if="designationData===1">
          <div v-if="step===0">
              <h3>SECTION A: Technical Competencies:</h3>
              <el-collapse v-model="activeNames" >
                  <div v-for="(section,index) in sectionAData">

                      <el-collapse-item  v-bind:title="section.KRA" v-bind:name="index">
                          <div>{{section.KPI}}</div>
                          <div v-if="index+1===1">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA1" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===2">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA2" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5">5.5</option>
                                  </select>
                              </div>
                          </div>


                          <div v-if="index+1===3">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA3" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===4">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA4" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5">5.5</option>
                                  </select>
                              </div>
                          </div>


                          <div v-if="index+1===5">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA5" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5">5.5</option>
                                  </select>
                              </div>
                          </div>
                          <div v-if="index+1===6">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA6" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5">5.5</option>
                                  </select>
                              </div>
                          </div>
                          <div v-if="index+1===7">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA7" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5">5.5</option>
                                  </select>
                              </div>
                          </div>
                      </el-collapse-item>
                  </div>

              </el-collapse>
              <div v-if="step===0">
                  <button @click="proceedToSectionB" class="col-12 btn btn-primary">NEXT</button>
              </div>
          </div>
      </div>
      <div v-if="designationData===3 || designationData===4">
        <div v-if="step===0">
            <h3>SECTION A: Technical Competencies:</h3>
            <el-collapse v-model="activeNames" >
                <div v-for="(section,index) in sectionAData">

                    <el-collapse-item  v-bind:title="section.KRA" v-bind:name="index">
                        <div>{{section.KPI}}</div>
                        <div v-if="index+1===1">
                            <div class="form-group">
                                <label class="col-form-label">Select Rating</label>
                                <select  v-model="sectionAKRA1" class="form-control" required >
                                    <option value="1">1</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="5">5.5</option>
                                </select>
                            </div>
                        </div>

                        <div v-if="index+1===2">
                            <div class="form-group">
                                <label class="col-form-label">Select Rating</label>
                                <select  v-model="sectionAKRA2" class="form-control" required >
                                    <option value="1">1</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="5.5">5.5</option>
                                </select>
                            </div>
                        </div>


                        <div v-if="index+1===3">
                            <div class="form-group">
                                <label class="col-form-label">Select Rating</label>
                                <select  v-model="sectionAKRA3" class="form-control" required >
                                    <option value="1">1</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="5.5">5.5</option>
                                </select>
                            </div>
                        </div>

                        <div v-if="index+1===4">
                            <div class="form-group">
                                <label class="col-form-label">Select Rating</label>
                                <select  v-model="sectionAKRA4" class="form-control" required >
                                    <option value="1">1</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="5.5">5.5</option>
                                </select>
                            </div>
                        </div>


                        <div v-if="index+1===5">
                            <div class="form-group">
                                <label class="col-form-label">Select Rating</label>
                                <select  v-model="sectionAKRA5" class="form-control" required >
                                    <option value="1">1</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="5.5">5.5</option>
                                </select>
                            </div>
                        </div>
                    </el-collapse-item>
                </div>

            </el-collapse>
            <div v-if="step===0">
                <button @click="proceedToSectionB" class="col-12 btn btn-primary">NEXT</button>
            </div>
        </div>
    </div>


      <div v-if="designationData===23">
          <div v-if="step===0">
              <h3>SECTION A: Technical Competencies:</h3>
              <el-collapse v-model="activeNames" >
                  <div v-for="(section,index) in sectionAData">

                      <el-collapse-item  v-bind:title="section.KRA" v-bind:name="index">
                          <div>{{section.KPI}}</div>
                          <div v-if="index+1===1">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA1" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===2">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA2" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>


                          <div v-if="index+1===3">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA3" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===4">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA4" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>


                          <div v-if="index+1===5">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA5" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>
                      </el-collapse-item>
                  </div>

              </el-collapse>
              <div v-if="step===0">
                  <button @click="proceedToSectionB" class="col-12 btn btn-primary">NEXT</button>
              </div>
          </div>
      </div>
      <div v-if="designationData===5 || designationData===6 ||
designationData===7 || designationData===8">
          <div v-if="step===0">
              <h3>SECTION A: Technical Competencies:</h3>
              <el-collapse v-model="activeNames" >
                  <div v-for="(section,index) in sectionAData">

                      <el-collapse-item  v-bind:title="section.KRA" v-bind:name="index">
                          <div>{{section.KPI}}</div>
                          <div v-if="index+1===1">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA1" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===2">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA2" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>


                          <div v-if="index+1===3">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA3" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===4">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA4" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>


                          <div v-if="index+1===5">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA5" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===6">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA6" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>
                      </el-collapse-item>
                  </div>

              </el-collapse>
              <div v-if="step===0">
                  <button @click="proceedToSectionB" class="col-12 btn btn-primary">NEXT</button>
              </div>
          </div>
      </div>
      <div v-if="designationData===17">
          <div v-if="step===0">
              <h3>SECTION A: Technical Competencies:</h3>
              <el-collapse v-model="activeNames" >
                  <div v-for="(section,index) in sectionAData">

                      <el-collapse-item  v-bind:title="section.KRA" v-bind:name="index">
                          <div>{{section.KPI}}</div>
                          <div v-if="index+1===1">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA1" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===2">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA2" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>


                          <div v-if="index+1===3">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA3" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===4">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA4" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>


                          <div v-if="index+1===5">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA5" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===6">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA6" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>
                      </el-collapse-item>
                  </div>

              </el-collapse>
              <div v-if="step===0">
                  <button @click="proceedToSectionB" class="col-12 btn btn-primary">NEXT</button>
              </div>
          </div>
      </div>
      <div v-if="designationData===11">
          <div v-if="step===0">
              <h3>SECTION A: Technical Competencies:</h3>
              <el-collapse v-model="activeNames" >
                  <div v-for="(section,index) in sectionAData">

                      <el-collapse-item  v-bind:title="section.KRA" v-bind:name="index">
                          <div>{{section.KPI}}</div>
                          <div v-if="index+1===1">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA1" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===2">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA2" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===3">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA3" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===4">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA4" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                      </el-collapse-item>
                  </div>

              </el-collapse>
              <div v-if="step===0">
                  <button @click="proceedToSectionB" class="col-12 btn btn-primary">NEXT</button>
              </div>
          </div>
      </div>
      <div v-if="designationData===10">
          <div v-if="step===0">
              <h3>SECTION A: Technical Competencies:</h3>
              <el-collapse v-model="activeNames" >
                  <div v-for="(section,index) in sectionAData">

                      <el-collapse-item  v-bind:title="section.KRA" v-bind:name="index">
                          <div>{{section.KPI}}</div>
                          <div v-if="index+1===1">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA1" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===2">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA2" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===3">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA3" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                          <div v-if="index+1===4">
                              <div class="form-group">
                                  <label class="col-form-label">Select Rating</label>
                                  <select  v-model="sectionAKRA4" class="form-control" required >
                                      <option value="1">1</option>
                                      <option value="1.5">1.5</option>
                                      <option value="2">2</option>
                                      <option value="2.5">2.5</option>
                                      <option value="3">3</option>
                                      <option value="3.5">3.5</option>
                                      <option value="4">4</option>
                                      <option value="4.5">4.5</option>
                                      <option value="5">5</option>
                                      <option value="5.5">5.5</option>
                                  </select>
                              </div>
                          </div>

                      </el-collapse-item>
                  </div>

              </el-collapse>
              <div v-if="step===0">
                  <button @click="proceedToSectionB" class="col-12 btn btn-primary">NEXT</button>
              </div>
          </div>
      </div>
      <div v-if="step===1">
          <h3>Section B: Assessment of Behavioural Competencies</h3>
          <el-collapse v-model="activeNamesB" >
              <div v-for="(section,index) in sectionBData">

                  <el-collapse-item v-bind:title="section.name" v-bind:name="index">
                      <div>{{section.description}}</div>
                      <div v-if="index+1===1">
                          <div class="form-group">
                              <label class="col-form-label">Select Rating</label>
                              <select  v-model="sectionB1Rating" class="form-control" required >
                                  <option value="1">1</option>
                                  <option value="1.5">1.5</option>
                                  <option value="2">2</option>
                                  <option value="2.5">2.5</option>
                                  <option value="3">3</option>
                                  <option value="3.5">3.5</option>
                                  <option value="4">4</option>
                                  <option value="4.5">4.5</option>
                                  <option value="5">5</option>
                                  <option value="5.5">5.5</option>
                              </select>
                          </div>
                      </div>
                      <div v-if="index+1===2">
                          <div class="form-group">
                              <label class="col-form-label">Select Rating</label>
                              <select  v-model="sectionB2Rating" class="form-control" required >
                                  <option value="1">1</option>
                                  <option value="1.5">1.5</option>
                                  <option value="2">2</option>
                                  <option value="2.5">2.5</option>
                                  <option value="3">3</option>
                                  <option value="3.5">3.5</option>
                                  <option value="4">4</option>
                                  <option value="4.5">4.5</option>
                                  <option value="5">5</option>
                                  <option value="5.5">5.5</option>
                              </select>
                          </div>
                      </div>
                      <div v-if="index+1===3">
                          <div class="form-group">
                              <label class="col-form-label">Select Rating</label>
                              <select  v-model="sectionB3Rating" class="form-control" required >
                                  <option value="1">1</option>
                                  <option value="1.5">1.5</option>
                                  <option value="2">2</option>
                                  <option value="2.5">2.5</option>
                                  <option value="3">3</option>
                                  <option value="3.5">3.5</option>
                                  <option value="4">4</option>
                                  <option value="4.5">4.5</option>
                                  <option value="5">5</option>
                                  <option value="5.5">5.5</option>
                              </select>
                          </div>
                      </div>
                      <div v-if="index+1===4">
                          <div class="form-group">
                              <label class="col-form-label">Select Rating</label>
                              <select  v-model="sectionB4Rating" class="form-control" required>
                                  <option value="1">1</option>
                                  <option value="1.5">1.5</option>
                                  <option value="2">2</option>
                                  <option value="2.5">2.5</option>
                                  <option value="3">3</option>
                                  <option value="3.5">3.5</option>
                                  <option value="4">4</option>
                                  <option value="4.5">4.5</option>
                                  <option value="5">5</option>
                                  <option value="5.5">5.5</option>
                              </select>
                          </div>
                      </div>
                  </el-collapse-item>
              </div>

          </el-collapse>
          <div v-if="step===1 && !isManager">
              <button @click="proceedToSectionD" class="col-12 btn btn-primary">NEXT</button>
          </div>
          <div v-else>
              <button @click="proceedToSectionC" class="col-12 btn btn-primary">NEXT</button>
          </div>
      </div>
      <div v-if="step===2 && isManager">
          <h3>Section C: Assessment of Leadership Competencies</h3>
          <el-collapse v-model="activeNamesC" >
              <div v-for="(section,index) in sectionCData">

                  <el-collapse-item v-bind:title="section.name" v-bind:name="index">
                      <div>{{section.desctiption}}</div>
                      <div v-if="section.id===1">
                          <div class="form-group">
                              <label class="col-form-label">Select Rating</label>
                              <select  v-model="sectionC1Rating" class="form-control" required >
                                  <option value="1">1</option>
                                  <option value="1.5">1.5</option>
                                  <option value="2">2</option>
                                  <option value="2.5">2.5</option>
                                  <option value="3">3</option>
                                  <option value="3.5">3.5</option>
                                  <option value="4">4</option>
                                  <option value="4.5">4.5</option>
                                  <option value="5">5</option>
                                  <option value="5.5">5.5</option>
                              </select>
                          </div>
                      </div>

                      <div v-if="section.id===2">
                          <div class="form-group">
                              <label class="col-form-label">Select Rating</label>
                              <select  v-model="sectionC2Rating" class="form-control" required >
                                  <option value="1">1</option>
                                  <option value="1.5">1.5</option>
                                  <option value="2">2</option>
                                  <option value="2.5">2.5</option>
                                  <option value="3">3</option>
                                  <option value="3.5">3.5</option>
                                  <option value="4">4</option>
                                  <option value="4.5">4.5</option>
                                  <option value="5">5</option>
                                  <option value="5.5">5.5</option>
                              </select>
                          </div>
                      </div>


                      <div v-if="section.id===3">
                          <div class="form-group">
                              <label class="col-form-label">Select Rating</label>
                              <select  v-model="sectionC3Rating" class="form-control" required >
                                  <option value="1">1</option>
                                  <option value="1.5">1.5</option>
                                  <option value="2">2</option>
                                  <option value="2.5">2.5</option>
                                  <option value="3">3</option>
                                  <option value="3.5">3.5</option>
                                  <option value="4">4</option>
                                  <option value="4.5">4.5</option>
                                  <option value="5">5</option>
                                  <option value="5.5">5.5</option>
                              </select>
                          </div>
                      </div>

                      <div v-if="section.id===4">
                          <div class="form-group">
                              <label class="col-form-label">Select Rating</label>
                              <select  v-model="sectionC4Rating" class="form-control" required >
                                  <option value="1">1</option>
                                  <option value="1.5">1.5</option>
                                  <option value="2">2</option>
                                  <option value="2.5">2.5</option>
                                  <option value="3">3</option>
                                  <option value="3.5">3.5</option>
                                  <option value="4">4</option>
                                  <option value="4.5">4.5</option>
                                  <option value="5">5</option>
                                  <option value="5.5">5.5</option>
                              </select>
                          </div>
                      </div>

                  </el-collapse-item>
              </div>

          </el-collapse>
          <div>
              <button @click="managerProceedToSectionD" class="col-12 btn btn-primary">Next</button>
          </div>
      </div>
      <div v-if="step===3">
          <h3>Section D: Personal Development</h3>
          <el-collapse v-model="activeNamesD" >
              <div v-for="(section,index) in sectionDData">

                  <el-collapse-item v-bind:title="section.name" v-bind:name="index">
                      <div>{{section.name}}</div>
                      <div v-if="section.id===1">
                          <div class="form-group">
                              <label class="col-form-label">Enter Comment</label>
                              <input  type="text" class="form-control" name="test" v-model="keyStrengthComment"
                                     id="exampleInputEmail1" aria-describedby="emailHelp">
                          </div>
                      </div>
                      <div v-if="section.id===2">
                          <div class="form-group">
                              <label class="col-form-label">Enter Comment</label>
                              <input name="test2"
                                     type="text" class="form-control"
                                     v-model="keyDevelopmentAreasComment" id="exampleInputEmail2"
                                     aria-describedby="emailHelp">
                          </div>
                      </div>
                  </el-collapse-item>
              </div>

          </el-collapse>
          <div v-if="isManager">
              <button @click="submitManager" class="col-12 btn btn-primary">SUBMIT APPRAISAL</button>
          </div>
          <div v-else>
              <button @click="submit" class="col-12 btn btn-primary">SUBMIT</button>
          </div>
      </div>

      <div>

    </div>

  </form>

</div>
</div>
</template>


<script>
export default {
    name: "create-appraisal",
    props:{
        section_a:Array,
        section_b:Array,
        section_c:Array,
        section_d:Array,
        is_manager:Boolean,
        designation:Number
    },
    data(){
        return{
          loading: false,
            designationData:this.designation,
            step:0,
            isManager:this.is_manager,
            sectionAData: this.section_a,
            sectionCData: this.section_c,
            sectionDData: this.section_d,
             activeNames: ['1'],
             activeNamesB: ['1'],
             activeNamesC: ['1'],
            activeNamesD: ['1'],
            sectionBData:this.section_b,

            sectionAKRA1:null,
            sectionAKRA1Remarks:null,

            sectionAKRA2:null,
            sectionAKRA2Remarks:null,

          sectionAKRA3:null,
          sectionAKRA3Remarks:null,

          sectionAKRA4:null,
          sectionAKRA4Remarks:null,

          sectionAKRA5:null,
          sectionAKRA5Remarks:null,

          sectionAKRA6:null,
          sectionAKRA6Remarks:null,
          sectionAKRA7:null,
          sectionAKRA7Remarks:null,

          sectionB1Rating:null,
          sectionB1Remarks:null,

          sectionB2Rating:null,
          sectionB2Remarks:null,

          sectionB3Rating:null,
          sectionB3Remarks:null,

          sectionB4Rating:null,
          sectionB4Remarks:null,


          sectionC1Rating:null,
          sectionC1Remarks:null,

          sectionC2Rating:null,
          sectionC2Remarks:null,

          sectionC3Rating:null,
          sectionC3Remarks:null,

          sectionC4Rating:null,
          sectionC4Remarks:null,

          keyStrengthComment: null,
          keyDevelopmentAreasComment: null,



        }
    },
    mounted() {
      console.log("Section A" +this.section_a)
    },
    methods:{

      proceedToSectionB(){

          if (this.designationData===3|| this.designation===4){
            if (!this.sectionAKRA1){
                this.$message.error('Please rate  project excellence.');
            }
            else  if (!this.sectionAKRA2){
                this.$message.error('Please rate customer satisfaction .');

            }
            else if (!this.sectionAKRA3){
                this.$message.error('Please rate resource management.');

            }
            else  if (!this.sectionAKRA4){
                this.$message.error('Please rate governance.');

            }
            else  if (!this.sectionAKRA5){
                this.$message.error('Please rate individual stretch.');

            }
            else{
                this.step=1;
            }
        }
          else if (this.designationData===23){
              if (!this.sectionAKRA1){
                  this.$message.error('Please rate  Service Delivery.');
              }
              else  if (!this.sectionAKRA2){
                  this.$message.error('Please rate Stakeholder engagement.');

              }
              else if (!this.sectionAKRA3){
                  this.$message.error('Please rate governance.');

              }
              else  if (!this.sectionAKRA4){
                  this.$message.error('Please rate reporting.');

              }
              else  if (!this.sectionAKRA5){
                  this.$message.error('Please rate individual stretch.');

              }
              else{
                  this.step=1;
              }
          }
          else if (this.designationData===5|| this.designation===6 ||
              this.designationData===7|| this.designation===8){
              if (!this.sectionAKRA1){
                  this.$message.error('Please rate  project excellence.');
              }
              else  if (!this.sectionAKRA2){
                  this.$message.error('Please rate customer satisfaction .');

              }
              else if (!this.sectionAKRA3){
                  this.$message.error('Please rate resource management.');

              }
              else  if (!this.sectionAKRA4){
                  this.$message.error('Please rate quality of delivery.');

              }
              else  if (!this.sectionAKRA5){
                  this.$message.error('Please rate governance.');

              }
              else  if (!this.sectionAKRA6){
                  this.$message.error('Please rate individual stretch.');

              }
              else{
                  this.step=1;
              }
          }
          else if (this.designationData===17){
              if (!this.sectionAKRA1){
                  this.$message.error('Please rate  Sales Order booking Target.');
              }
              else  if (!this.sectionAKRA2){
                  this.$message.error('Please rate Pipeline Generation.');

              }
              else if (!this.sectionAKRA3){
                  this.$message.error('Please rate Win-Loss Ratio.');

              }
              else  if (!this.sectionAKRA4){
                  this.$message.error('Please rate Sales Reporting.');

              }
              else  if (!this.sectionAKRA5){
                  this.$message.error('Please rate governance.');

              }
              else  if (!this.sectionAKRA6){
                  this.$message.error('Please rate individual stretch.');

              }
              else{
                  this.step=1;
              }
          }
          else if (this.designationData===11){
              if (!this.sectionAKRA1){
                  this.$message.error('Please rate Operations service delivery.');
              }
              else  if (!this.sectionAKRA2){
                  this.$message.error('Please rate Quality & Reporting.');

              }
              else if (!this.sectionAKRA3){
                  this.$message.error('Please rate governance.');

              }
              else  if (!this.sectionAKRA4){
                  this.$message.error('Please rate individual stretch.');

              }
              else{
                  this.step=1;
              }
          }
          else if (this.designationData===10){
              if (!this.sectionAKRA1){
                  this.$message.error('Please rate reports and analytics.');
              }
              else  if (!this.sectionAKRA2){
                  this.$message.error('Please rate customer satisfaction.');

              }
              else if (!this.sectionAKRA3){
                  this.$message.error('Please rate governance.');

              }
              else  if (!this.sectionAKRA4){
                  this.$message.error('Please rate individual stretch.');

              }
              else{
                  this.step=1;
              }
          }
          else if (this.designationData===1){
            if (!this.sectionAKRA1){
                this.$message.error('Please rate  Development Project Delivery.');
            }
            else  if (!this.sectionAKRA2){
                this.$message.error('Please rate Development Project Acceptance .');

            }
            else if (!this.sectionAKRA3){
                this.$message.error('Please rate Apps Security and Integrity.');

            }
            else  if (!this.sectionAKRA4){
                this.$message.error('Please rate Quality and Processing of Apps.');

            }
            else  if (!this.sectionAKRA5){
                this.$message.error('Please rate reporting.');

            }
            else  if (!this.sectionAKRA6){
                this.$message.error('Please rate governance.');

            }
            else  if (!this.sectionAKRA7){
                this.$message.error('Please rate individual stretch.');

            }
            else{
                this.step=1;
            }
        }

      },
      proceedToSectionD(){
            if (!this.sectionB1Rating){
                this.$message.error('Please rate  Delivering Outstanding Customer Service:.');
            }
            else if (!this.sectionB2Rating){
                this.$message.error('Please rate  Cost Control & Minimisation.');
            }
            else if (!this.sectionB3Rating){
                this.$message.error('Please rate  Working Collaboratively.');
            }
            else if (!this.sectionB4Rating){
                this.$message.error('Please rate Planning Efficiently.');
            }else{
                this.step=3;
            }
        },
      managerProceedToSectionD(){
            if (!this.sectionC1Rating){
                this.$message.error('Please rate  Embracing change.');
            }
            else if (!this.sectionC2Rating){
                this.$message.error('Please rate  building trusted relationship.');
            }
            else if (!this.sectionC3Rating){
                this.$message.error('Please rate  managing customers and teams.');
            }
            else if (!this.sectionC4Rating){
                this.$message.error('Please rate thinking strategically.');
            }else{
                this.step=3;
            }
        },
      proceedToSectionC(){
          if (!this.sectionB1Rating){
              this.$message.error('Please rate  Delivering Outstanding Customer Service:.');
          }
          else if (!this.sectionB2Rating){
              this.$message.error('Please rate  Cost Control & Minimisation.');
          }
          else if (!this.sectionB3Rating){
              this.$message.error('Please rate  Working Collaboratively.');
          }
          else if (!this.sectionB4Rating){
              this.$message.error('Please rate Planning Efficiently.');
          }else{
              this.step=2;
          }
      },
      submit(){
          event.preventDefault();
          if (!this.keyStrengthComment){
              this.$message.error('Please comment on your key strengths.');
          }
          else if (!this.keyDevelopmentAreasComment){
              this.$message.error('Please comment on your key development areas.');
          }
          else{
          this.loading=true;
              if (this.designationData===3 || this.designationData===4) {
                  axios.post('/manager_create_appraisal',{

                      sectionAKRA1:this.sectionAKRA1,
                      sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                      sectionAKRA2:this.sectionAKRA2,
                      sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                      sectionAKRA3:this.sectionAKRA3,
                      sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                      sectionAKRA4:this.sectionAKRA4,
                      sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                      sectionAKRA5:this.sectionAKRA5,
                      sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                      sectionB1Rating:this.sectionB1Rating,
                      sectionB1Remarks:this.sectionB1Remarks,

                      sectionB2Rating:this.sectionB2Rating,
                      sectionB2Remarks:this.sectionB2Remarks,

                      sectionB3Rating:this.sectionB3Rating,
                      sectionB3Remarks:this.sectionB3Remarks,

                      sectionB4Rating:this.sectionB4Rating,
                      sectionB4Remarks:this.sectionB4Remarks,

                      keyStrengthComment:this.keyStrengthComment,
                      keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                  }).then((resp)=>{
                      this.loading=false
                      if (resp.data.status){
                          this.$message.success(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }
                      else{

                          this.$message.error(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }

                  })
              }
              else if (this.designationData===11) {
                  axios.post('/create_appraisal',{

                      sectionAKRA1:this.sectionAKRA1,
                      sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                      sectionAKRA2:this.sectionAKRA2,
                      sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                      sectionAKRA3:this.sectionAKRA3,
                      sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                      sectionAKRA4:this.sectionAKRA4,
                      sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                      sectionB1Rating:this.sectionB1Rating,
                      sectionB1Remarks:this.sectionB1Remarks,

                      sectionB2Rating:this.sectionB2Rating,
                      sectionB2Remarks:this.sectionB2Remarks,

                      sectionB3Rating:this.sectionB3Rating,
                      sectionB3Remarks:this.sectionB3Remarks,

                      sectionB4Rating:this.sectionB4Rating,
                      sectionB4Remarks:this.sectionB4Remarks,

                      keyStrengthComment:this.keyStrengthComment,
                      keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                  }).then((resp)=>{
                      this.loading=false
                      if (resp.data.status){
                          this.$message.success(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }
                      else{

                          this.$message.error(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }

                  })
              }
              else if (this.designationData===10) {
                  axios.post('/create_appraisal',{

                      sectionAKRA1:this.sectionAKRA1,
                      sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                      sectionAKRA2:this.sectionAKRA2,
                      sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                      sectionAKRA3:this.sectionAKRA3,
                      sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                      sectionAKRA4:this.sectionAKRA4,
                      sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                      sectionB1Rating:this.sectionB1Rating,
                      sectionB1Remarks:this.sectionB1Remarks,

                      sectionB2Rating:this.sectionB2Rating,
                      sectionB2Remarks:this.sectionB2Remarks,

                      sectionB3Rating:this.sectionB3Rating,
                      sectionB3Remarks:this.sectionB3Remarks,

                      sectionB4Rating:this.sectionB4Rating,
                      sectionB4Remarks:this.sectionB4Remarks,

                      keyStrengthComment:this.keyStrengthComment,
                      keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                  }).then((resp)=>{
                      this.loading=false
                      if (resp.data.status){
                          this.$message.success(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }
                      else{

                          this.$message.error(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }

                  })
              }
              else if (this.designationData===1) {
                  axios.post('/create_appraisal',{

                      sectionAKRA1:this.sectionAKRA1,
                      sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                      sectionAKRA2:this.sectionAKRA2,
                      sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                      sectionAKRA3:this.sectionAKRA3,
                      sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                      sectionAKRA4:this.sectionAKRA4,
                      sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                      sectionAKRA5:this.sectionAKRA5,
                      sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                      sectionAKRA6:this.sectionAKRA6,
                      sectionAKRA6Remarks:this.sectionAKRA6Remarks,

                      sectionAKRA7:this.sectionAKRA7,
                      sectionAKRA7Remarks:this.sectionAKRA7Remarks,

                      sectionB1Rating:this.sectionB1Rating,
                      sectionB1Remarks:this.sectionB1Remarks,

                      sectionB2Rating:this.sectionB2Rating,
                      sectionB2Remarks:this.sectionB2Remarks,

                      sectionB3Rating:this.sectionB3Rating,
                      sectionB3Remarks:this.sectionB3Remarks,

                      sectionB4Rating:this.sectionB4Rating,
                      sectionB4Remarks:this.sectionB4Remarks,

                      keyStrengthComment:this.keyStrengthComment,
                      keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                  }).then((resp)=>{
                      this.loading=false
                      if (resp.data.status){
                          this.$message.success(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }
                      else{

                          this.$message.error(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }

                  })
              }
              else if (this.designationData===5 || this.designationData===6 ||
                  this.designationData===7 || this.designationData===8) {
                  axios.post('/create_appraisal',{

                      sectionAKRA1:this.sectionAKRA1,
                      sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                      sectionAKRA2:this.sectionAKRA2,
                      sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                      sectionAKRA3:this.sectionAKRA3,
                      sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                      sectionAKRA4:this.sectionAKRA4,
                      sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                      sectionAKRA5:this.sectionAKRA5,
                      sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                      sectionAKRA6:this.sectionAKRA6,
                      sectionAKRA6Remarks:this.sectionAKRA6Remarks,

                      sectionB1Rating:this.sectionB1Rating,
                      sectionB1Remarks:this.sectionB1Remarks,

                      sectionB2Rating:this.sectionB2Rating,
                      sectionB2Remarks:this.sectionB2Remarks,

                      sectionB3Rating:this.sectionB3Rating,
                      sectionB3Remarks:this.sectionB3Remarks,

                      sectionB4Rating:this.sectionB4Rating,
                      sectionB4Remarks:this.sectionB4Remarks,

                      keyStrengthComment:this.keyStrengthComment,
                      keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                  }).then((resp)=>{
                      this.loading=false
                      if (resp.data.status){
                          this.$message.success(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }
                      else{

                          this.$message.error(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }

                  })
              }
              else if (this.designationData===17) {
                  axios.post('/create_appraisal',{

                      sectionAKRA1:this.sectionAKRA1,
                      sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                      sectionAKRA2:this.sectionAKRA2,
                      sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                      sectionAKRA3:this.sectionAKRA3,
                      sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                      sectionAKRA4:this.sectionAKRA4,
                      sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                      sectionAKRA5:this.sectionAKRA5,
                      sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                      sectionAKRA6:this.sectionAKRA6,
                      sectionAKRA6Remarks:this.sectionAKRA6Remarks,

                      sectionB1Rating:this.sectionB1Rating,
                      sectionB1Remarks:this.sectionB1Remarks,

                      sectionB2Rating:this.sectionB2Rating,
                      sectionB2Remarks:this.sectionB2Remarks,

                      sectionB3Rating:this.sectionB3Rating,
                      sectionB3Remarks:this.sectionB3Remarks,

                      sectionB4Rating:this.sectionB4Rating,
                      sectionB4Remarks:this.sectionB4Remarks,

                      keyStrengthComment:this.keyStrengthComment,
                      keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                  }).then((resp)=>{
                      this.loading=false
                      if (resp.data.status){
                          this.$message.success(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }
                      else{

                          this.$message.error(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }

                  })
              }
              else if (this.designationData===23) {
                  axios.post('/create_appraisal',{

                      sectionAKRA1:this.sectionAKRA1,
                      sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                      sectionAKRA2:this.sectionAKRA2,
                      sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                      sectionAKRA3:this.sectionAKRA3,
                      sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                      sectionAKRA4:this.sectionAKRA4,
                      sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                      sectionAKRA5:this.sectionAKRA5,
                      sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                      sectionB1Rating:this.sectionB1Rating,
                      sectionB1Remarks:this.sectionB1Remarks,

                      sectionB2Rating:this.sectionB2Rating,
                      sectionB2Remarks:this.sectionB2Remarks,

                      sectionB3Rating:this.sectionB3Rating,
                      sectionB3Remarks:this.sectionB3Remarks,

                      sectionB4Rating:this.sectionB4Rating,
                      sectionB4Remarks:this.sectionB4Remarks,

                      keyStrengthComment:this.keyStrengthComment,
                      keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                  }).then((resp)=>{
                      this.loading=false
                      if (resp.data.status){
                          this.$message.success(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }
                      else{

                          this.$message.error(resp.data.message);

                          setTimeout(function () {
                              window.location.href="/view_appraisals";

                          },1000);

                      }

                  })
              }


          }
      },
      submitManager(){
            event.preventDefault();
            if (!this.keyStrengthComment){
                this.$message.error('Please comment on your key strengths.');
            }
            else if (!this.keyDevelopmentAreasComment){
                this.$message.error('Please comment on your key development areas.');
            }
            else{
                this.loading=true;

                if (this.designationData===3 || this.designationData===4){
                    axios.post('/manager_create_appraisal',{

                        sectionAKRA1:this.sectionAKRA1,
                        sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                        sectionAKRA2:this.sectionAKRA2,
                        sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                        sectionAKRA3:this.sectionAKRA3,
                        sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                        sectionAKRA4:this.sectionAKRA4,
                        sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                        sectionAKRA5:this.sectionAKRA5,
                        sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                        sectionB1Rating:this.sectionB1Rating,
                        sectionB1Remarks:this.sectionB1Remarks,

                        sectionB2Rating:this.sectionB2Rating,
                        sectionB2Remarks:this.sectionB2Remarks,

                        sectionB3Rating:this.sectionB3Rating,
                        sectionB3Remarks:this.sectionB3Remarks,

                        sectionB4Rating:this.sectionB4Rating,
                        sectionB4Remarks:this.sectionB4Remarks,

                        sectionC1Rating:this.sectionC1Rating,
                        sectionC1Remarks:this.sectionC1Remarks,

                        sectionC2Rating:this.sectionC2Rating,
                        sectionC2Remarks:this.sectionC2Remarks,

                        sectionC3Rating:this.sectionC3Rating,
                        sectionC3Remarks:this.sectionC3Remarks,

                        sectionC4Rating:this.sectionC4Rating,
                        sectionC4Remarks:this.sectionC4Remarks,

                        keyStrengthComment:this.keyStrengthComment,
                        keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                    }).then((resp)=>{
                        this.loading=false
                        if (resp.data.status){
                            this.$message.success(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }
                        else{

                            this.$message.error(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }

                    })
                }
                else if (this.designationData===11){
                    axios.post('/create_appraisal',{

                        sectionAKRA1:this.sectionAKRA1,
                        sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                        sectionAKRA2:this.sectionAKRA2,
                        sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                        sectionAKRA3:this.sectionAKRA3,
                        sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                        sectionAKRA4:this.sectionAKRA4,
                        sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                        sectionB1Rating:this.sectionB1Rating,
                        sectionB1Remarks:this.sectionB1Remarks,

                        sectionB2Rating:this.sectionB2Rating,
                        sectionB2Remarks:this.sectionB2Remarks,

                        sectionB3Rating:this.sectionB3Rating,
                        sectionB3Remarks:this.sectionB3Remarks,

                        sectionB4Rating:this.sectionB4Rating,
                        sectionB4Remarks:this.sectionB4Remarks,

                        sectionC1Rating:this.sectionC1Rating,
                        sectionC1Remarks:this.sectionC1Remarks,

                        sectionC2Rating:this.sectionC2Rating,
                        sectionC2Remarks:this.sectionC2Remarks,

                        sectionC3Rating:this.sectionC3Rating,
                        sectionC3Remarks:this.sectionC3Remarks,

                        sectionC4Rating:this.sectionC4Rating,
                        sectionC4Remarks:this.sectionC4Remarks,

                        keyStrengthComment:this.keyStrengthComment,
                        keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                    }).then((resp)=>{
                        this.loading=false
                        if (resp.data.status){
                            this.$message.success(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }
                        else{

                            this.$message.error(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }

                    })
                }
                else if (this.designationData===10){
                    axios.post('/create_appraisal',{

                        sectionAKRA1:this.sectionAKRA1,
                        sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                        sectionAKRA2:this.sectionAKRA2,
                        sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                        sectionAKRA3:this.sectionAKRA3,
                        sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                        sectionAKRA4:this.sectionAKRA4,
                        sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                        sectionB1Rating:this.sectionB1Rating,
                        sectionB1Remarks:this.sectionB1Remarks,

                        sectionB2Rating:this.sectionB2Rating,
                        sectionB2Remarks:this.sectionB2Remarks,

                        sectionB3Rating:this.sectionB3Rating,
                        sectionB3Remarks:this.sectionB3Remarks,

                        sectionB4Rating:this.sectionB4Rating,
                        sectionB4Remarks:this.sectionB4Remarks,

                        sectionC1Rating:this.sectionC1Rating,
                        sectionC1Remarks:this.sectionC1Remarks,

                        sectionC2Rating:this.sectionC2Rating,
                        sectionC2Remarks:this.sectionC2Remarks,

                        sectionC3Rating:this.sectionC3Rating,
                        sectionC3Remarks:this.sectionC3Remarks,

                        sectionC4Rating:this.sectionC4Rating,
                        sectionC4Remarks:this.sectionC4Remarks,

                        keyStrengthComment:this.keyStrengthComment,
                        keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                    }).then((resp)=>{
                        this.loading=false
                        if (resp.data.status){
                            this.$message.success(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }
                        else{

                            this.$message.error(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }

                    })
                }
                else if (this.designationData===1){
                    axios.post('/create_appraisal',{

                        sectionAKRA1:this.sectionAKRA1,
                        sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                        sectionAKRA2:this.sectionAKRA2,
                        sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                        sectionAKRA3:this.sectionAKRA3,
                        sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                        sectionAKRA4:this.sectionAKRA4,
                        sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                        sectionAKRA5:this.sectionAKRA5,
                        sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                        sectionAKRA6:this.sectionAKRA6,
                        sectionAKRA6Remarks:this.sectionAKRA6Remarks,

                        sectionAKRA7:this.sectionAKRA7,
                        sectionAKRA7Remarks:this.sectionAKRA7Remarks,

                        sectionB1Rating:this.sectionB1Rating,
                        sectionB1Remarks:this.sectionB1Remarks,

                        sectionB2Rating:this.sectionB2Rating,
                        sectionB2Remarks:this.sectionB2Remarks,

                        sectionB3Rating:this.sectionB3Rating,
                        sectionB3Remarks:this.sectionB3Remarks,

                        sectionB4Rating:this.sectionB4Rating,
                        sectionB4Remarks:this.sectionB4Remarks,

                        sectionC1Rating:this.sectionC1Rating,
                        sectionC1Remarks:this.sectionC1Remarks,

                        sectionC2Rating:this.sectionC2Rating,
                        sectionC2Remarks:this.sectionC2Remarks,

                        sectionC3Rating:this.sectionC3Rating,
                        sectionC3Remarks:this.sectionC3Remarks,

                        sectionC4Rating:this.sectionC4Rating,
                        sectionC4Remarks:this.sectionC4Remarks,

                        keyStrengthComment:this.keyStrengthComment,
                        keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                    }).then((resp)=>{
                        this.loading=false
                        if (resp.data.status){
                            this.$message.success(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }
                        else{

                            this.$message.error(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }

                    })
                }
                else if (this.designationData===5 || this.designationData===6 ||
                    this.designationData===7 || this.designationData===8){
                    axios.post('/create_appraisal',{

                        sectionAKRA1:this.sectionAKRA1,
                        sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                        sectionAKRA2:this.sectionAKRA2,
                        sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                        sectionAKRA3:this.sectionAKRA3,
                        sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                        sectionAKRA4:this.sectionAKRA4,
                        sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                        sectionAKRA5:this.sectionAKRA5,
                        sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                        sectionAKRA6:this.sectionAKRA6,
                        sectionAKRA6Remarks:this.sectionAKRA6Remarks,

                        sectionB1Rating:this.sectionB1Rating,
                        sectionB1Remarks:this.sectionB1Remarks,

                        sectionB2Rating:this.sectionB2Rating,
                        sectionB2Remarks:this.sectionB2Remarks,

                        sectionB3Rating:this.sectionB3Rating,
                        sectionB3Remarks:this.sectionB3Remarks,

                        sectionB4Rating:this.sectionB4Rating,
                        sectionB4Remarks:this.sectionB4Remarks,

                        sectionC1Rating:this.sectionC1Rating,
                        sectionC1Remarks:this.sectionC1Remarks,

                        sectionC2Rating:this.sectionC2Rating,
                        sectionC2Remarks:this.sectionC2Remarks,

                        sectionC3Rating:this.sectionC3Rating,
                        sectionC3Remarks:this.sectionC3Remarks,

                        sectionC4Rating:this.sectionC4Rating,
                        sectionC4Remarks:this.sectionC4Remarks,

                        keyStrengthComment:this.keyStrengthComment,
                        keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                    }).then((resp)=>{
                        this.loading=false
                        if (resp.data.status){
                            this.$message.success(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }
                        else{

                            this.$message.error(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }

                    })
                }
                else if (this.designationData===17){
                    axios.post('/create_appraisal',{

                        sectionAKRA1:this.sectionAKRA1,
                        sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                        sectionAKRA2:this.sectionAKRA2,
                        sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                        sectionAKRA3:this.sectionAKRA3,
                        sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                        sectionAKRA4:this.sectionAKRA4,
                        sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                        sectionAKRA5:this.sectionAKRA5,
                        sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                        sectionAKRA6:this.sectionAKRA6,
                        sectionAKRA6Remarks:this.sectionAKRA6Remarks,

                        sectionB1Rating:this.sectionB1Rating,
                        sectionB1Remarks:this.sectionB1Remarks,

                        sectionB2Rating:this.sectionB2Rating,
                        sectionB2Remarks:this.sectionB2Remarks,

                        sectionB3Rating:this.sectionB3Rating,
                        sectionB3Remarks:this.sectionB3Remarks,

                        sectionB4Rating:this.sectionB4Rating,
                        sectionB4Remarks:this.sectionB4Remarks,

                        sectionC1Rating:this.sectionC1Rating,
                        sectionC1Remarks:this.sectionC1Remarks,

                        sectionC2Rating:this.sectionC2Rating,
                        sectionC2Remarks:this.sectionC2Remarks,

                        sectionC3Rating:this.sectionC3Rating,
                        sectionC3Remarks:this.sectionC3Remarks,

                        sectionC4Rating:this.sectionC4Rating,
                        sectionC4Remarks:this.sectionC4Remarks,

                        keyStrengthComment:this.keyStrengthComment,
                        keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                    }).then((resp)=>{
                        this.loading=false
                        if (resp.data.status){
                            this.$message.success(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }
                        else{

                            this.$message.error(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }

                    })
                }
                else if (this.designationData===23){
                    axios.post('/create_appraisal',{

                        sectionAKRA1:this.sectionAKRA1,
                        sectionAKRA1Remarks:this.sectionAKRA1Remarks,

                        sectionAKRA2:this.sectionAKRA2,
                        sectionAKRA2Remarks:this.sectionAKRA2Remarks,

                        sectionAKRA3:this.sectionAKRA3,
                        sectionAKRA3Remarks:this.sectionAKRA3Remarks,

                        sectionAKRA4:this.sectionAKRA4,
                        sectionAKRA4Remarks:this.sectionAKRA4Remarks,

                        sectionAKRA5:this.sectionAKRA5,
                        sectionAKRA5Remarks:this.sectionAKRA5Remarks,

                        sectionB1Rating:this.sectionB1Rating,
                        sectionB1Remarks:this.sectionB1Remarks,

                        sectionB2Rating:this.sectionB2Rating,
                        sectionB2Remarks:this.sectionB2Remarks,

                        sectionB3Rating:this.sectionB3Rating,
                        sectionB3Remarks:this.sectionB3Remarks,

                        sectionB4Rating:this.sectionB4Rating,
                        sectionB4Remarks:this.sectionB4Remarks,

                        sectionC1Rating:this.sectionC1Rating,
                        sectionC1Remarks:this.sectionC1Remarks,

                        sectionC2Rating:this.sectionC2Rating,
                        sectionC2Remarks:this.sectionC2Remarks,

                        sectionC3Rating:this.sectionC3Rating,
                        sectionC3Remarks:this.sectionC3Remarks,

                        sectionC4Rating:this.sectionC4Rating,
                        sectionC4Remarks:this.sectionC4Remarks,

                        keyStrengthComment:this.keyStrengthComment,
                        keyDevelopmentAreasComment:this.keyDevelopmentAreasComment

                    }).then((resp)=>{
                        this.loading=false
                        if (resp.data.status){
                            this.$message.success(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

                        }
                        else{

                            this.$message.error(resp.data.message);

                            setTimeout(function () {
                                window.location.href="/view_appraisals";

                            },1000);

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
