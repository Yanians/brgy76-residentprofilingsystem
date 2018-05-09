<template>
<div>
    <button @click="addnewsocialpension()" class="btn btn-md bg-navy white dv-addbtn pull-right">Add New</button>
    <br class="clear-fix">
  <div class="dv">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h4>Social Pension Data</h4>
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
                    <th  @click="toggleOrder('status')">
                        <span>Status</span>
                        <span class="dv-table-column" v-if="'status' === query.column">
                          <span v-if="query.direction === 'desc'">&darr;</span> 
                          <span v-else>&uarr;</span>
                        </span>
                    </th>
                     <th  @click="toggleOrder('dateofbirth')">
                        <span>Date of birth</span>
                        <span class="dv-table-column" v-if="'dateofbirth' === query.column">
                          <span v-if="query.direction === 'desc'">&darr;</span> 
                          <span v-else>&uarr;</span>
                        </span>
                    </th>
                     <th  @click="toggleOrder('address')">
                        <span>Address</span>
                        <span class="dv-table-column" v-if="'address' === query.column">
                          <span v-if="query.direction === 'desc'">&darr;</span> 
                          <span v-else>&uarr;</span>
                        </span>
                    </th>
                     <th  @click="toggleOrder('yearresident')">
                        <span>Year Resident</span>
                        <span class="dv-table-column" v-if="'yearresident' === query.column">
                          <span v-if="query.direction === 'desc'">&darr;</span> 
                          <span v-else>&uarr;</span>
                        </span>
                    </th>
                     <th  @click="toggleOrder('purpose')">
                        <span>Purpose</span>
                        <span class="dv-table-column" v-if="'purpose' === query.column">
                          <span v-if="query.direction === 'desc'">&darr;</span> 
                          <span v-else>&uarr;</span>
                        </span>
                    </th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in model.data">
                    <td>{{row.status}}</td>
                    <td>{{row.dateofbirth}}</td>
                    <td>{{row.address}}</td>
                    <td>{{row.yearresident}}</td>
                    <td>{{row.purpose}}</td>
                    <td><button  class="btn btn-sm btn-primary" v-on:click="editsocialpension(row.id)"> <i class="fa  fa-edit"> </i></button> | <button  class="btn btn-sm btn-danger"  v-on:click="deletesocialpension(row.id)"> <i class="fa  fa-trash"> </i></button></td>
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
       <div class="modal fade in" id="addsocialpensionmodal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <form action="post" enctype="multipart/form-data" v-on:submit.prevent="addsocialpension">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Add new Social Pension</h4>
                        <small class="font-bold">please fill up all the field.</small>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                             <div class="col-md-4">
                                <div class="form-group">
                                   <label for=""> <p> Address : </p> </label>
                                   <input type="text" name="owneraddress" v-model="address" class="form-control">                 
                                </div>
                             </div>
                             <div class="col-md-4">
                                <div class="form-group">  
                                  <label for=""> <p> Date of Birth : </p> </label>
                                  <input type="date" name="dateofbirth" v-model='dateofbirth' class="form-control">                
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
                                  <label for=""> <p>Year of residency : </p> </label>
                                   <v-select v-model="yearresident_selected" :value.sync="yearresident_selected" :options="yearresident_options"></v-select>
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
                                   <textarea name="purpose" v-model='purpose' class="form-control" cols="30" rows="2"></textarea>
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
         <div class="modal fade in" id="socialpensionmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Editing Social Pension</h4>
                        <small class="font-bold">please fill up all the field.</small>
                    </div>
                    <div class="modal-body">
                              <input type="hidden"  v-model="pensionId" class="form-control">                 
                             
                             <div class="row">
                               <div class="col-md-6">
                                  <div class="form-group">
                                    <label for=""> <p> Status : </p> </label>
                                    <input type="text" v-model="edit_status" name="status" class="form-control">                 
                                  </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="form-group">
                                     <label for=""> <p> Address : </p> </label>
                                     <input type="text" name="owneraddress" v-model="edit_address" class="form-control">                 
                                  </div>
                               </div>
                             </div>
                            <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">  
                                      <label for=""> <p> Date of Birth : </p> </label>
                                      <input type="date" name="dateofbirth" v-model='edit_dateofbirth' class="form-control">                
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for=""> <p>Year of residency : </p> </label>
                                     <v-select v-model="edit_yearresident_selected" :value.sync="yearresident_selected" :options="yearresident_options"></v-select>
                                  </div>
                              </div>
                            </div>
                              <div class="row">
                                <div class="col-md-12">
                                     <div class="form-group">
                                        <label for=""> <p>Purpose : </p> </label>
                                        <div class="form-group">
                                         <textarea name="purpose" v-model='edit_purpose' class="form-control" cols="30" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for=""> <p>Name of purok leader : </p> </label>
                                         <v-select v-model="edit_purokleader_id"  label="fullname" :options="purokleader"></v-select>
                                    </div>
                                </div>
                              </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" v-on:click="editsocialpensionSave">Save changes</button>
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
        purokleader: [],
        purokleader_id:'',
        purpose:'',
        yearresident_selected:null,
        yearresident_options:[],
        status:'',
        dateofbirth:'',
        address:'',

        pensionId:'',
        edit_purokleader_id:'',
        edit_purpose:'',
        edit_yearresident_selected:null,
        edit_status:'',
        edit_dateofbirth:'',
        edit_address:'',
        content:false,
        editcontent:false,

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
        addnewsocialpension()
        {
           $('#addsocialpensionmodal').modal();

        }, 
        addsocialpension()
        { 

            const vm = this;
            axios.post(base_url_api+'resident/socialpension/save', {
                userid         : vm.user_id,
                purokleader_id : vm.purokleader_id,
                purpose        : vm.purpose,
                yearresident   : vm.yearresident_selected,
                status         : vm.status,
                dateofbirth    : vm.dateofbirth,
                address        : vm.address,
               
            })
            .then(function (response) {
                $('#addsocialpensionmodal').modal('toggle');

                if (response.data == 1) {
                  $.toaster('Social pension saved success!','Success', 'success');
                  vm.fetchData();
                }else{
                    $.toaster('Social pension  not saved!','Error', 'danger');
                }

            })
            .catch(function (error) {
                $('#addsocialpensionmodal').modal('toggle');
            
                $.toaster('Social pension  not saved! Please fillup all fields','Error', 'danger');
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

              for (var i = 0; i <= 200; i++) {
                   vm.yearresident_options.push(i.toString());
              }

              

        },
         deletesocialpension(id)
        {
            let vm = this;
            var r = confirm("Are you sure you want to delete this pension data?");
            if (r == true) {
                $.ajax({
                  url: base_url_api+"resident/socialpension/delete/"+id,
                 }).done(function(data) {
                    if (data == 1) { 
                         $.toaster('socialpension deleted success!','Success', 'success');
                         vm.fetchData() 
                     }
                    else if(data == 0){ $.toaster('Something went wrong socialpension not deleted!','Error', 'danger');  }  
                    else { $.toaster('Something went wrong socialpension data not deleted!','Error', 'danger'); }  
                });
            } 

        },
        editsocialpension(id)
        {
           $('#socialpensionmodal').modal();
              const vm = this;
              axios.get(base_url_api+'resident/socialpension/edit/'+id)
              .then(function (response) {
                  let obj = response.data;
                   for (var prop in obj) {
                        let address = obj[prop]['address'];
                        let purpose = obj[prop]['purpose'];
                        let status = obj[prop]['status'];
                        let yearresident = obj[prop]['yearresident'];
                        let dateofbirth = obj[prop]['dateofbirth'];
                        let purokleader= obj[prop]['firstname']+' '+obj[prop]['middlename']+' '+obj[prop]['lastname'];
                        let id = obj[prop]['id'];
                        vm.edit_address = address;
                        vm.edit_purpose = purpose;
                        vm.edit_dateofbirth = dateofbirth;
                        vm.edit_yearresident_selected = yearresident;
                        vm.edit_status = status;
                        vm.purokleader_id = purokleader;
                        vm.pensionId = id;
                  } 
            })
            .catch(function (error) {
              $.toaster('Unable to fetch '+error,'Error', 'danger');
            }); 
        },
        editsocialpensionSave()
        {
            const vm = this;
            axios.post(base_url_api+'resident/socialpension/edit/save', {
                edit_id        : vm.pensionId,
                userid         : vm.user_id,
                purokleader_id : vm.edit_purokleader_id,
                purpose        : vm.edit_purpose,
                yearresident   : vm.edit_yearresident_selected,
                status         : vm.edit_status,
                dateofbirth    : vm.edit_dateofbirth,
                address        : vm.edit_address,
               
            })
            .then(function (response) {
                if (response.data == 1) {
                    $.toaster('Social pension editted success!','Success', 'success');
                }else{
                    $.toaster('Social pension  not editted!','Error', 'danger');
                }
            })
            .catch(function (error) {
                $.toaster('Social pension  not editted! Please fillup all fields','Error', 'danger');
            });
        },
    }
  }

</script>