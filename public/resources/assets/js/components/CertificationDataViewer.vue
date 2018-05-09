<template>
<div>
  <button @click="addnewCertification()" class="btn btn-md bg-navy white dv-addbtn pull-right">Add New</button>
  <br class="clear-fix">
  <div class="dv">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h4>Certification Data</h4>
      </div>
       <div class="panel-body">
           <div class="dv-header">
              
              <span>Filter :</span>

              <div class="dv-header-columns">
                 <select class="dv-header-select" v-model="query.search_column">
                      <option  v-for="(value,key) in tblcolumns" :value="value">{{value}}</option>
                 </select>
              </div>
              <div class="dv-header-operators">
                 <select class="dv-header-select" v-model="query.search_operator">
                   <option  v-for="(value,key) in operators" :value="key">{{value}}</option>
                 </select>
              </div>
              <div class="dv-header-search">
                <input type="text" class="dv-header-input" v-model="query.search_input" placeholder="Search"  @keyup.enter="fetchData()">
              </div>
             <div class="dv-header-submit">
                 <button class="dv-header-btn"  @click="fetchData()">Filter</button>
              </div>

           </div>
           <div class="dv-body">
             <table class="dv-table">
                <thead>
                  <tr>
                    <th v-for="(value,key) in tblcolumns"  @click="toggleOrder(value)">
                        <span>{{columns[key]}}</span>
                        <span class="dv-table-column" v-if="value === query.column">
                          <span v-if="query.direction === 'desc'">&darr;</span> 
                          <span v-else>&uarr;</span>
                        </span>
                    </th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in model.data">
                    <td v-for="(value,key) in row">{{value}}</td>
                    <td class="dv-td-action-btn-wrapper"><button  class="btn btn-sm btn-primary" v-on:click="editCertification(row.id)"> <i class="fa  fa-edit"> </i></button> | <button  class="btn btn-sm btn-danger"  v-on:click="deleteCertification(row.id)"> <i class="fa  fa-trash"> </i></button></td>
                  </tr>
                </tbody>
             </table>
           </div>
           <div class="dv-footer">
              <div class="dv-footer-item">
                <span>Displaying {{model.from}} - {{model.to}} of {{model.total}} rows </span>
              </div>
            </div>
              <div class="dv-footer-item">
               <div class="footer-sub">
                 <span>Rows per page</span>
                 <input type="text" v-model="query.per_page" class="dv-footer-input" @keyup="fetchData()">
               </div>
               <div class="footer-sub">
                <button class="dv-footer-btn" @click="prev()">&laquo;</button>
                <button class="dv-footer-btn" @click="next()">&raquo;</button>
               </div>
              </div>
      </div>
    </div>

     <!-- New Certification Modal -->
         <div class="modal fade in" id="requestNewCertification" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Request For certification</h4>
                        <small class="font-bold">please fill up all the field.</small>
                    </div>
                   <form action="post" enctype="multipart/form-data" v-on:submit.prevent="addCertification">
                    <div class="modal-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label for=""> <p> Name of child : </p> </label>
                                   <input type="text" name="nameofchild" v-model="nameofchild" class="form-control">                 
                                </div>
                            </div>            
                            
                            <div class="col-md-6">
                                <div class="form-group">  
                                  <label for=""> <p> Date of Birth : </p> </label>
                                  <input type="date" name="dateofbirth" v-model='dateofbirth' class="form-control">                
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for=""> <p> Place of birth : </p> </label>
                                  <input type="text" v-model="placeofbirth" name="placeofbirth" class="form-control">                 
                                </div>
                            </div>    
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for=""> <p> Name of Hospital/Clinic/House : </p> </label>
                                <input type="text" v-model="hospitalname" name="hospitalname" class="form-control">                 
                              </div>    
                            </div>        
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for=""> <p>Name of Mother : </p> </label>
                                  <div class="form-group">
                                  <input type="text" v-model="mother" name="mother" class="form-control">                 
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> <p>Name of Father : </p> </label>
                                    <div class="form-group">
                                    <input type="text" v-model="father" name="father" class="form-control">                 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""> <p>Address : </p> </label>
                                    <div class="form-group">
                                    <input type="text" v-model="address" name="address" class="form-control">                 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group">
                                  <label for=""> <p>Name of purok leader : </p> </label>
                                   <v-select v-model="purokleader_id"  label="fullname" :options="purokleader"></v-select>
                              </div>
                            </div>
                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
         </div>
        <!-- End modal  -->

     <!-- Start Modal -->
         <div class="modal fade in" id="certificationmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Editing certification</h4>
                        <small class="font-bold">please fill up all the field.</small>
                    </div>
                    <div class="modal-body">
                              <input type="hidden"  v-model="edit_certification_id" class="form-control">                 
                              <div class="col-md-6">
                                <div class="form-group">  
                                  <label for=""> <p> Name of child : </p> </label>
                                  <input type="text" name="nameofchild" v-model='edit_nameofchild' class="form-control">                
                                </div>
                              </div>  
                              <div class="col-md-6">  
                                <div class="form-group">  
                                  <label for=""> <p> Name of mother : </p> </label>
                                  <input type="text" name="nameofmother" v-model='edit_nameofmother' class="form-control">                
                                </div>
                             </div>   
                              <div class="col-md-6">  
                                <div class="form-group">  
                                  <label for=""> <p> Name of father : </p> </label>
                                  <input type="text" name="nameoffather" v-model='edit_nameoffather' class="form-control">                
                                </div>
                              </div>

                              <div class="col-md-6">  
                                <div class="form-group">  
                                  <label for=""> <p> Date of Birth : </p> </label>
                                  <input type="date" name="dateofbirth" v-model='edit_dateofbirth' class="form-control">                
                                </div>
                              </div>

                              <div class="col-md-6">  
                                 <div class="form-group">  
                                  <label for=""> <p> Place of Birth : </p> </label>
                                  <input type="text" name="placeofbirth" v-model='edit_placeofbirth' class="form-control">                
                                 </div>
                              </div>

                              <div class="col-md-6">  
                                <div class="form-group">  
                                  <label for=""> <p> Name of Hospital: </p> </label>
                                  <input type="text" name="nameofhospital" v-model='edit_nameofhospital' class="form-control">                
                                </div>
                              </div>

                              <div class="col-md-12">  
                               <div class="form-group">
                                 <label for=""> <p> Address : </p> </label>
                                 <input type="text" name="owneraddress" v-model="edit_address" class="form-control">                 
                              </div>
                              </div>

                              <div class="col-md-12">  
                              <div class="form-group">
                                  <label for=""> <p>Name of purok leader : </p> </label>
                                   <v-select v-model="edit_purokleader_id"  label="fullname" :options="purokleader"></v-select>
                              </div>
                              </div>
                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" v-on:click="editCertificationSave">Save changes</button>
                    </div>
                </div>
            </div>
         </div>
        <!-- End modal  -->
      </div>  <!-- End dv  -->
  </div>
</template>
<script>
   import Vue from 'vue'
   import axios from 'axios'
   import vSelect from "vue-select"   


  export default{
    props:['source','title'],
    components: {vSelect},
    data(){
      return {
        user_id:$('#userid').val(),
        edit_certification_id:'',
        purokleader: [],
        purokleader_id:'',
        edit_purokleader_id:'',
        edit_nameofchild:'',
        edit_dateofbirth:'',
        edit_placeofbirth:'',
        edit_nameofhospital:'',
        edit_nameofmother:'',
        edit_nameoffather:'',
        edit_address:'',
        nameofchild:'',
        dateofbirth:'',
        placeofbirth:'',
        hospitalname:'',
        mother:'',
        father:'',
        address:'',
        content:false,
        model:{},
        columns:{},
        tblcolumns:{},
        query:{
          page:1,
          column:'id',
          direction:'desc',
          per_page:5,
          search_column:'id',
          search_operator:'equal' ,
          search_input:''
        },
        operators:{
           equal : '=',
           not_equal : '<>',
           less_than : '<',
           greater_than : '>',
           less_than_or_equal_to : '<=',
           greater_than_or_equal_to : '>='
        }
      }
    },
    mounted(){
      this.fetchData()
      this.populatePurokLeader()
    },
    methods:{
        addnewCertification()
        {
           $('#requestNewCertification').modal();
        },
        addCertification()
        { 

            const vm = this;
            axios.post(base_url_api+'resident/certification/save', {
                userid         : vm.user_id,
                purokleader_id : vm.purokleader_id,
                nameofchild        : vm.nameofchild,
                hospitalname   : vm.hospitalname,
                placeofbirth   : vm.placeofbirth,
                dateofbirth    : vm.dateofbirth,
                mother        : vm.mother,
                father        : vm.father,
                address        : vm.address,
               
            })
            .then(function (response) {
                if (response.data == 1) {
                  $.toaster('certification saved success!','Success', 'success');
                  vm.fetchData()

                }else{
                    $.toaster('certification  not saved!','Error', 'danger');
                }
            })
            .catch(function (error) {
                $.toaster('certification  not saved! Please fillup all fields','Error', 'danger');
            });
        },
        next()
        {
           if (this.model.next_page_url) {
              this.query.page++
              this.fetchData() 
           }
        },
        prev()
        {
           if (this.model.prev_page_url) {
              this.query.page--
              this.fetchData() 
           }
        },
        toggleOrder(value)
        {
            if (value === this.query.column) {
                 if (this.query.direction === 'desc') {
                     this.query.direction = 'asc'
                 }else{
                  this.query.direction = 'desc'
                 }
            }else{
              this.query.column = value
              this.query.direction  = 'asc '
            }
            this.fetchData()
        },
        fetchData()
        {
            var vm = this;
            axios.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&search_column=${this.query.search_column}&search_operator=${this.query.search_operator}&search_input=${this.query.search_input}&user_id=${this.user_id}`).then(function(response){
              
                  Vue.set(vm.$data,'model',response.data.model)
                  Vue.set(vm.$data,'columns',response.data.columns)
                  Vue.set(vm.$data,'tblcolumns',response.data.tblcolumns)

            }).catch(function(response){
                console.log(response)
            })
        },
        populatePurokLeader()
        {
              const vm = this;
              axios.get(base_url_api+'admin/officials')
              .then(function (response) {
                 let obj = response.data;
                 for (var prop in obj) {
                    let fullname_obj = obj[prop]['firstname']+' '+obj[prop]['middlename']+' '+obj[prop]['lastname'];
                    let newobjs = {id:obj[prop]['id'].toString(),fullname:fullname_obj};
                    vm.purokleader.push(newobjs);
                } 
              })
              .catch(function (error) {
                $.toaster('Unable to fetch ','Error', 'danger');
                  
              }); 
              

        },
         deleteCertification(id)
        {
            let vm = this;
            var r = confirm("Are you sure you want to delete this pension data?");
            if (r == true) {
                $.ajax({
                  url: base_url_api+"resident/certification/delete/"+id,
                 }).done(function(data) {
                    if (data == 1) { 
                         $.toaster('certification deleted success!','Success', 'success');
                         vm.fetchData() 
                     }
                    else if(data == 0){ $.toaster('Something went wrong certification not deleted!','Error', 'danger');  }  
                    else { $.toaster('Something went wrong certification data not deleted!','Error', 'danger'); }  
                });
            } 

        },
        editCertification(id)
        {
           $('#certificationmodal').modal();
              const vm = this;
              axios.get(base_url_api+'resident/certification/edit/'+id)
              .then(function (response) {
                  let obj = response.data;
                   for (var prop in obj) {
                        let certification_id = obj[prop]['id'];
                        let purokleader_id = obj[prop]['firstname']+' '+obj[prop]['middlename']+' '+obj[prop]['lastname'];
                        let nameofchild = obj[prop]['nameofchild'];
                        let dateofbirth = obj[prop]['dateofbirth'];
                        let placeofbirth = obj[prop]['placeofbirth'];
                        let nameofhospital = obj[prop]['nameofhospital'];
                        let nameofmother = obj[prop]['nameofmother'];
                        let nameoffather = obj[prop]['nameoffather'];
                        let address = obj[prop]['address'];

                        vm.edit_certification_id = certification_id
                        vm.edit_purokleader_id   = purokleader_id
                        vm.edit_nameofchild      = nameofchild
                        vm.edit_nameofhospital   = nameofhospital
                        vm.edit_placeofbirth     = placeofbirth
                        vm.edit_dateofbirth      = dateofbirth
                        vm.edit_nameofmother   = nameofmother
                        vm.edit_nameoffather   = nameoffather
                        vm.edit_dateofbirth    = dateofbirth
                        vm.edit_address        = address
                  } 
            })
            .catch(function (error) {
              $.toaster('Unable to fetch '+error,'Error', 'danger');
            }); 
        },
        editCertificationSave()
        {
            const vm = this;
            axios.post(base_url_api+'resident/certification/edit/save', {
                edit_id             : vm.edit_certification_id,
                purokleader_id      : vm.edit_purokleader_id,
                nameofchild         : vm.edit_nameofchild,
                dateofbirth         : vm.edit_dateofbirth,
                placeofbirth        : vm.edit_placeofbirth,
                nameofhospital      : vm.edit_nameofhospital,
                nameofmother        : vm.edit_nameofmother,
                nameoffather        : vm.edit_nameoffather,
                address             : vm.edit_address,
            })
            .then(function (response) {
                if (response.data == 1) {
                    $.toaster('certification editted success!','Success', 'success');
                    vm.fetchData() 

                }else{
                    $.toaster('certification  not editted!','Error', 'danger');
                }
            })
            .catch(function (error) {
                $.toaster('certification  not editted! Please fillup all fields','Error', 'danger');
            });
        },
    }
  }

</script>