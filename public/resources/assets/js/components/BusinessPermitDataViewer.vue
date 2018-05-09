<template>
<div>
    <button @click="addnewBusinesspermit()" class="btn btn-md bg-navy white dv-addbtn pull-right">Add New</button>
    <br class="clear-fix">
  <div class="dv">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h4>Businesspermit Data</h4>
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
                <input type="text" class="dv-header-input" v-model="query.search_input"  @keyup.enter="fetchData()">
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
                    <td><button  class="btn btn-sm btn-primary" v-on:click="editbusinesspermit(row.id)"> <i class="fa  fa-edit"> </i></button> | <button  class="btn btn-sm btn-danger"  v-on:click="deletebusinesspermit(row.id)"> <i class="fa  fa-trash"> </i></button></td>
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
        

        <!-- Start Add New Permit Modal -->
         <div class="modal fade in" id="addbusinesspermitmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                          <form action="post" enctype="multipart/form-data" v-on:submit.prevent="addBusinessPermit">

                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Add new Business Permit</h4>
                        <small class="font-bold">please fill up all the field.</small>
                    </div>
                    <div class="modal-body">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                 <label for=""> <p> Business Name: </p> </label>
                                 <input type="text" name="businessname" v-model="businessname" class="form-control">                 
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">  
                                <label for=""> <p> Business Address: </p> </label>
                            <input type="text" name="businessaddress" v-model='businessaddress' class="form-control">                
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for=""> <p> Status : </p> </label>
                                <input type="text" v-model="status" name="status" class="form-control">                 
                              </div>
                            </div>
                          </div>
                           <div class="row">
                             <div class="col-md-6">
                              <div class="form-group">
                                <label for=""> <p> Owner Address: </p> </label>
                                <input type="text" v-model="owneraddress" name="owneraddress" class="form-control">                 
                              </div>            
                             </div>            
                             <div class="col-md-6">
                              <div class="form-group">
                                  <label for=""> <p>Date of Birth : </p> </label>
                                  <div class="form-group">
                                  <input type="date" v-model="dateofbirth" name="dateofbirth" class="form-control">                 
                                  </div>
                              </div>
                            </div>
                            </div>            
                             <div class="row">
                                 <div class="col-md-6">
                                      <div class="form-group">
                                          <label for=""> <p>Place of birth : </p> </label>
                                          <div class="form-group">
                                          <input type="text" v-model="placeofbirth" name="placeofbirth" class="form-control">                 
                                          </div>
                                      </div>
                                  </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> <p>Name of purok leader : </p> </label>
                                         <v-select v-model="purokleader_id"  label="fullname" :options="purokleader"></v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for=""> <p>Purpose : </p> </label>
                                         <div class="form-group">
                                            <textarea v-model="purpose" name="purpose" class="form-control"></textarea>                 
                                         </div>
                                    </div>
                                 </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                            </form>

                </div>
            </div>
         </div>
        <!-- End modal  -->

       <!-- Start Modal -->
         <div class="modal fade in" id="businesspermitmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Editing Business Permit</h4>
                        <small class="font-bold">please fill up all the field.</small>
                    </div>
                    <div class="modal-body">
                              <input type="hidden"  v-model="edit_businesspermit_id" class="form-control">                 
                        <div class="row">
                             <div class="col-md-4">
                               <div class="form-group">
                                 <label for=""> <p> Business Name: </p> </label>
                                 <input type="text" name="edit_businessname" v-model="edit_businessname" class="form-control">                 
                               </div>
                             </div>
                             <div class="col-md-4">
                                <div class="form-group">  
                                  <label for=""> <p> Business Address: </p> </label>
                                  <input type="text" name="businessaddress" v-model='edit_businessaddress' class="form-control">              
                                </div>
                             </div>
                             <div class="col-md-4">
                               <div class="form-group">
                                  <label for=""> <p> Status : </p> </label>
                                  <input type="text" v-model="edit_status" name="edit_status" class="form-control">                 
                               </div>
                             </div>
                        </div>
                         <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                  <label for=""> <p> Owner Address: </p> </label>
                                  <input type="text" v-model="edit_owneraddress" name="edit_owneraddress" class="form-control">         
                                </div>            
                              </div>            
                             <div class="col-md-6">
                               <div class="form-group">
                                  <label for=""> <p>Date of Birth : </p> </label>
                                  <div class="form-group">
                                  <input type="date" v-model="edit_dateofbirth" name="edit_dateofbirth" class="form-control">                 
                                 </div>
                             </div>
                             </div>
                         </div>
                          <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> <p>Place of birth : </p> </label>
                                    <div class="form-group">
                                    <input type="text" v-model="edit_placeofbirth" name="edit_placeofbirth" class="form-control">                 
                                    </div>
                                </div>
                              </div>
                             <div class="col-md-6">
                               <div class="form-group">
                                  <label for=""> <p>Name of purok leader : </p> </label>
                                   <v-select v-model="edit_purokleader_id"  label="fullname" :options="purokleader"></v-select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""> <p>Purpose : </p> </label>
                                    <div class="form-group">
                                    <textarea v-model="edit_purpose" name="edit_purpose" class="form-control"></textarea>                 
                                    </div>
                                </div>
                            </div>
                          </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" v-on:click="editbusinesspermitSave">Save changes</button>
                    </div>
                </div>
            </div>
         </div>
        <!-- End modal  -->
  </div>
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
        purokleader_id:'',
        status : '' ,
        businessname: '',
        businessaddress : '', 
        owneraddress : '',
        dateofbirth : '',
        placeofbirth : '',
        purpose : '',
        content:false,

        edit_businesspermit_id:'',
        purokleader: [],
        edit_purokleader_id:'',
        edit_status : '' ,
        edit_businessname: '',
        edit_businessaddress : '', 
        edit_owneraddress : '',
        edit_dateofbirth : '',
        edit_placeofbirth : '',
        edit_purpose : '',

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
        addnewBusinesspermit()
        {
           $('#addbusinesspermitmodal').modal();

        }, 
        addBusinessPermit()
        { 

            const vm = this;
            axios.post(base_url_api+'resident/businesspermit/save', {
                userid           : vm.user_id,
                purokleader_id   : vm.purokleader_id,
                status           : vm.status ,
                businessname     : vm.businessname,
                businessaddress  : vm.businessaddress, 
                owneraddress     : vm.owneraddress,
                dateofbirth      : vm.dateofbirth,
                placeofbirth     : vm.placeofbirth,
                purpose          : vm.purpose,
               
            })
            .then(function (response) {
                if (response.data == 1) {
                    $.toaster('Business Permit saved success!','Success', 'success');
                    vm.fetchData()
                }else{
                    $.toaster('Business Permit  not saved!','Error', 'danger');
                }
            })
            .catch(function (error) {
                $.toaster('Business Permit  not saved! Please fillup all fields','Error', 'danger');
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
         deletebusinesspermit(id)
        {
            let vm = this;
            var r = confirm("Are you sure you want to delete this pension data?");
            if (r == true) {
                $.ajax({
                  url: base_url_api+"resident/businesspermit/delete/"+id,
                 }).done(function(data) {
                    if (data == 1) { 
                         $.toaster('businesspermit deleted success!','Success', 'success');
                         vm.fetchData() 
                     }
                    else if(data == 0){ $.toaster('Something went wrong businesspermit not deleted!','Error', 'danger');  }  
                    else { $.toaster('Something went wrong businesspermit data not deleted!','Error', 'danger'); }  
                });
            } 

        },
        editbusinesspermit(id)
        {
           $('#businesspermitmodal').modal();
              const vm = this;
              axios.get(base_url_api+'resident/businesspermit/edit/'+id)
              .then(function (response) {
                  let obj = response.data;
                   for (var prop in obj) {
                        let businesspermit_id = obj[prop]['id'];
                        let purokleader_id = obj[prop]['firstname']+' '+obj[prop]['middlename']+' '+obj[prop]['lastname'];
                        let status = obj[prop]['status'];
                        let businessname = obj[prop]['businessname'];
                        let businessaddress = obj[prop]['businessaddress'];
                        let owneraddress = obj[prop]['owneraddress'];
                        let dateofbirth = obj[prop]['dateofbirth'];
                        let placeofbirth = obj[prop]['placeofbirth'];
                        let purpose = obj[prop]['purpose'];

                        vm.edit_businesspermit_id = businesspermit_id;
                        vm.edit_purokleader_id    = purokleader_id;
                        vm.edit_status            = status;
                        vm.edit_businessname      = businessname;
                        vm.edit_businessaddress   = businessaddress;
                        vm.edit_owneraddress      = owneraddress;
                        vm.edit_dateofbirth       = dateofbirth;
                        vm.edit_placeofbirth      = placeofbirth;
                        vm.edit_purpose           = purpose;
                  } 
            })
            .catch(function (error) {
              $.toaster('Unable to fetch '+error,'Error', 'danger');
            }); 
        },
        editbusinesspermitSave()
        {
            const vm = this;
            axios.post(base_url_api+'resident/businesspermit/edit/save', {
                edit_id             : vm.edit_businesspermit_id,
                purokleader_id      : vm.edit_purokleader_id,
                status              : vm.edit_status,
                businessname         : vm.edit_businessname,
                businessaddress        : vm.edit_businessaddress,
                owneraddress      : vm.edit_owneraddress,
                dateofbirth        : vm.edit_dateofbirth,
                placeofbirth        : vm.edit_placeofbirth,
                purpose             : vm.edit_purpose,
            })
            .then(function (response) {
                if (response.data == 1) {
                    $.toaster('businesspermit editted success!','Success', 'success');
                    vm.fetchData() 

                }else{
                    $.toaster('businesspermit  not editted!','Error', 'danger');
                }
            })
            .catch(function (error) {
                $.toaster('businesspermit  not editted! Please fillup all fields','Error', 'danger');
            });
        },
    }
  }

</script>