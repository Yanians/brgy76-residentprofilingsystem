<template>
<div>
    <div class="col-md-4">
               <button class="btn btn-md bg-navy white dv-addbtn pull-right" @click="addnewChat">New</button>
               <br class="clear-fix">
          <div class="box-footer box-comments" style="height: 500px;overflow:scroll;">
                  <div class="box-comment">
                    <!-- User image -->
                    <img src="http://localhost/clearance/storage/app/photos/J5uBGTjrj5binsNkLB30LARV0693bnwC0LUky4Ie.jpeg" alt="User Image" class="img-circle center">

                    <div class="comment-text">
                          <span class="username">
                            Maria Gonzales
                            <span class="text-muted pull-right">8:03 PM Today</span>
                          </span><!-- /.username -->
                      It is a long established fact that a reader will be distracted
                      by the readable content of a page when looking at its layout.
                    </div>
                    <!-- /.comment-text -->
                  </div>
                  <!-- /.box-comment -->
            </div>
            </div>
          <div class="col-md-8">
              <!-- DIRECT CHAT -->
              <div class="box box-info direct-chat direct-chat-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Direct Chat</h3>

                  <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">{{conversation.length}}</span>
                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                      <i class="fa fa-comments"></i></button>
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" style="height: 450px;">
                    <!-- Message. Default to the left -->
                    <span  v-for="value in conversation">
                        <div class="direct-chat-msg">
                          <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">{{value.current_firstname+' '+value.current_lastname}}</span>
                            <span class="direct-chat-timestamp pull-right">{{value.created_at}}</span>
                          </div>
                          <!-- /.direct-chat-info -->
                          <img v-if="value.current_profilepic == null" src="http://localhost/clearance/storage/app/photos/J5uBGTjrj5binsNkLB30LARV0693bnwC0LUky4Ie.jpeg" alt="User Image" class="img-circle center direct-chat-img">
                          <img v-else v-bind:src="'http://localhost/clearance/storage/app/'+value.current_profilepic" alt="User Image" class="img-circle center direct-chat-img">

                          <div class="direct-chat-text">
                            {{value.message}}
                          </div>
                          <!-- /.direct-chat-text -->
                        </div>
                    </span>
                    <!-- /.direct-chat-msg -->
                   
                  </div>
                  <!--/.direct-chat-messages-->

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <form method="post" @submit.prevent="">
                    <div class="input-group">
                      <input type="hidden" v-model="reciever">
                      <input type="text" name="message" v-model="message" placeholder="Type Message ..." class="form-control">
                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-info btn-flat" @click="sendmessage">Send</button>
                          </span>
                    </div>
                  </form>
                </div>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
            </div>

            <!-- Start Modal -->
         <!-- New Certification Modal -->
         <div class="modal fade in" id="chatModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Select New User To Chat</h4>
                    </div>
                    <div class="modal-body">
                         <form method="post" @submit.prevent="">
                          <input type="text" v-model="searchuser" name="usersearched" class="form-control" placeholder="Search User" @keyup="submitsearch">
                        </form>  
                           <ul class="user-nav">
                             <li v-for="value in users"  @click="toggleUser(value.id)"> 
                             <img v-if="value.profilepic != null" v-bind:src="'/clearance/storage/app/'+value.profilepic" class="img-circle user-profile-50">
                             <img v-else src="/clearance/storage/app/photos/default.png"  class="img-circle user-profile-50">
                              {{value.firstname+'  '+value.lastname}}</li>
                           </ul>
                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
         </div>
        <!-- End modal  -->
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
        users:'',
        conversation:'',
        reciever:'',
        message:'',
        messagesenders:'',
        searchuser: '',
      }
    },
    mounted(){
       this.fetchData();
    },
    computed:{
        userMessages () {
        return uniq(this.messagesenders.map(p => p.category))
      } 
    },
    watch:{
      conversation()
      {
        const vm = this
        setInterval(function(){
           vm.loadconversation();
        }, 3000);
      }
    },
    methods:{
        addnewChat()
        {
           $('#chatModal').modal();
           
        },
        submitsearch()
        {
           this.fetchData();
        },
        sendmessage()
        {
            let vm = this;
            axios.post(base_url_api+'resident/message/send',{
                message  : vm.message,
                reciever : vm.reciever,
                sender   : vm.user_id,
            })
            .then(function (response) {
                vm.loadconversation();
                vm.message = "";
            }).catch(function (error) {
            
            });
        },
        fetchData()
        {
          var vm = this;
          if (vm.searchuser === '') {
              axios.get(base_url_api+'resident/getall/users').then(function(response){
                    Vue.set(vm.$data,'users',response.data)
                    console.log(vm.users);
              }).catch(function(response){
                  console.log(response)
              })
          }else{
            
            axios.get(base_url_api+'resident/searched/users/'+vm.searchuser)
            .then(function (response) {
                    Vue.set(vm.$data,'users',response.data)
            }).catch(function (error) {
            
            });
          }

           axios.get(base_url_api+'resident/message/senders/'+vm.user_id)
            .then(function (response) {
                    Vue.set(vm.$data,'messagesenders',response.data)
            }).catch(function (error) {
            
            });
        },
        loadconversation()
        { 
          let vm = this;
          axios.get(base_url_api+'resident/message/conversation/'+this.user_id+'/'+this.reciever)
            .then(function (response) {
                    Vue.set(vm.$data,'conversation',response.data)
            }).catch(function (error) {
            
            });
        },
        toggleUser(id)
        {
           this.reciever = id;
           this.loadconversation();
        } 
    }
  }

</script>

<style scoped>
   .dv-addbtn{
      margin-bottom:10px;
   }
   .user-nav li{
    list-style-type: none;
    padding: 10px;
    border-bottom:1px solid #999;
   }
   .user-nav li:hover{
    background: #999;
    transition: all .5s ease;
   }
  .modal-body{
    height: 400px;
    overflow: scroll;
  }
  .user-profile-50{
    width: 50px !important;
    height: 50px !important;
  }
</style>