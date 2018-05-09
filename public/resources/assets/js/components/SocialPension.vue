<template>
    <div>
      <div class="col-md-4">
        <div class="panel panel-primary">
        <div class="panel-heading">
          <h4>Request For Social Pension</h4>
        </div>
        <div class="panel-body">
        <form action="post" enctype="multipart/form-data" v-on:submit.prevent="addPension">
            <div class="form-group">
               <label for=""> <p> Address : </p> </label>
               <input type="text" name="owneraddress" v-model="address" class="form-control">                 
            </div>


            <div class="form-group">  
              <label for=""> <p> Date of Birth : </p> </label>
          <input type="date" name="dateofbirth" v-model='dateofbirth' class="form-control">                
            </div>

            <div class="form-group">
              <label for=""> <p> Status : </p> </label>
              <input type="text" v-model="status" name="status" class="form-control">                 
            </div>

            <div class="form-group">
                <label for=""> <p>Year of residency : </p> </label>
                 <v-select v-model="yearresident_selected" :value.sync="yearresident_selected" :options="yearresident_options"></v-select>
            </div>

            <div class="form-group">
                <label for=""> <p>Purpose : </p> </label>
                <div class="form-group">
                 <textarea name="purpose" v-model='purpose' class="form-control" cols="30" rows="2"></textarea>
                </div>
            </div>
  
            <div class="form-group">
                <label for=""> <p>Name of purok leader : </p> </label>
                 <v-select v-model="purokleader_id"  label="fullname" :options="purokleader"></v-select>
            </div>
            

            <div class="form-group">
            <input type="submit" value="submit" class="btn btn-primary">
            </div>
          </form>
        </div>
       </div>
       </div>
       <div class="col-md-8">
         <div class="panel panel-primary" v-if="content != false">
            <div class="panel-heading">
                Social Pension
            </div>
            <div class="panel-body">
                        <table class="table">
                          <thead>
                            <tr><th>Year Resident</th><th>Purpose</th><th>Address</th><th>Status</th><th>Actions</th></tr>
                          </thead>
                          <tbody>
                            <tr v-for='c in content'>
                                <td>{{c.yearresident}}</td>
                                <td> <span class="purposetable-wrapper"><p>{{c.purpose}}</p></span></td>
                                <td>{{c.address}}</td>
                                <td>{{c.status}}</td>
                                <td>
                                   <button  class="btn btn-sm btn-primary" v-on:click="editPension(c.id)"> <i class="fa  fa-edit"> </i></button> | 
                                   <button class="btn btn-sm btn-danger"  v-on:click="deletePension(c.id)"><i class=" fa  fa-trash-o"></i></button>
                                </td>
                            </tr>
                          </tbody>
                        </table>                        
            </div>
         </div>
       </div>

        <!-- Start Modal -->
        <div class="modal fade in" id="socialpensionmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Editing Social Pension</h4>
                        <small class="font-bold">please fill up all the field.</small>
                    </div>
                    <div class="modal-body">
                              <input type="hidden"  v-model="pensionId" class="form-control">                 
                           
                              <div class="form-group">
                                 <label for=""> <p> Address : </p> </label>
                                 <input type="text" name="owneraddress" v-model="edit_address" class="form-control">                 
                              </div>


                              <div class="form-group">  
                                <label for=""> <p> Date of Birth : </p> </label>
                            <input type="date" name="dateofbirth" v-model='edit_dateofbirth' class="form-control">                
                              </div>

                              <div class="form-group">
                                <label for=""> <p> Status : </p> </label>
                                <input type="text" v-model="edit_status" name="status" class="form-control">                 
                              </div>

                           

                              <div class="form-group">
                                  <label for=""> <p>Year of residency : </p> </label>
                                   <v-select v-model="edit_yearresident_selected" :value.sync="yearresident_selected" :options="yearresident_options"></v-select>
                              </div>

                              <div class="form-group">
                                  <label for=""> <p>Purpose : </p> </label>
                                  <div class="form-group">
                                   <textarea name="purpose" v-model='edit_purpose' class="form-control" cols="30" rows="2"></textarea>
                                  </div>
                              </div>
                    
                              <div class="form-group">
                                  <label for=""> <p>Name of purok leader : </p> </label>
                                   <v-select v-model="edit_purokleader_id"  label="fullname" :options="purokleader"></v-select>
                              </div>
                              

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" v-on:click="editPensionSave">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

     </div>
</template>

<script>
   import axios from 'axios'
   import vSelect from "vue-select"   
   
   export default {
      components: {vSelect},
      data: function() {
        return {
              userid: $('#userid').val(),
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
          }
      },
      mounted() {
          this.populatePurokLeader();
          this.getData($('#userid').val());
      },
      watch:{
         content:function(value){
            var vm = this;
            setTimeout(function(){
              vm.getData(vm.userid)
            },1000);
         } 
      },
      methods: {
        addPension()
        { 

            const vm = this;
            axios.post(base_url_api+'resident/socialpension/save', {
                userid         : vm.userid,
                purokleader_id : vm.purokleader_id,
                purpose        : vm.purpose,
                yearresident   : vm.yearresident_selected,
                status         : vm.status,
                dateofbirth    : vm.dateofbirth,
                address        : vm.address,
               
            })
            .then(function (response) {
                if (response.data == 1) {
                  $.toaster('Social pension saved success!','Success', 'success');
                }else{
                    $.toaster('Social pension  not saved!','Error', 'danger');
                }
            })
            .catch(function (error) {
                $.toaster('Social pension  not saved! Please fillup all fields','Error', 'danger');
            });
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
        getData(userid)
        {
              const vm = this;
              axios.get(base_url_api+'resident/socialpension/user/'+userid)
              .then(function (response) {
                 let obj = response.data;
                 vm.content = obj;
                
              })
              .catch(function (error) {

                $.toaster('Unaible to fetch social pension data ','Error', 'danger');
                  
              });
        },
        editPension(id)
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
                        let dateofbirth = obj[prop]['dateofbirth'];
                        let userid = obj[prop]['userid'];
                        let id = obj[prop]['id'];
                        vm.edit_address = address;
                        vm.edit_purpose = purpose;
                        vm.edit_dateofbirth = dateofbirth;
                        vm.edit_status = status;
                        vm.pensionId = id;
                  } 
            })
            .catch(function (error) {
              $.toaster('Unable to fetch '+error,'Error', 'danger');
            }); 
        },
        editPensionSave()
        {
            const vm = this;
            axios.post(base_url_api+'resident/socialpension/edit/save', {
                edit_id        : vm.pensionId,
                userid         : vm.userid,
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
        deletePension(id)
        {
            var r = confirm("Are you sure you want to delete this pension data?");
            if (r == true) {
                $.ajax({
                  url: base_url_api+"resident/socialpension/delete/"+id,
                 }).done(function(data) {
                    if (data == 1) {  $.toaster('Social pension deleted success!','Success', 'success'); }
                    else if(data == 0){ $.toaster('Something went wrong social pension not deleted!','Error', 'danger');  }  
                    else { $.toaster('Something went wrong social pension data not deleted!','Error', 'danger'); }  
                });
            } 

        },

      }

    }
</script>

<style scoped>
  .purposetable-wrapper{
    width:300px !important;
  }
</style>

