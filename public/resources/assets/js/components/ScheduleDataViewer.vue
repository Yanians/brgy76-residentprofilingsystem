<template>
<div>
  <div class="dv">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h4>Schedule of Claims Data</h4>
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
                    <!-- <th>Actions</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in model.data">
                    <td >{{row.claim}}</td>
                    <td >{{row.datescheduled}}</td>
                    <td></td>
                   <!--  <td class="dv-td-action-btn-wrapper"><button  class="btn btn-sm btn-success" v-on:click="viewFeedback(row.id)"> <i class="fa  fa-bullhorn"> </i> Feedback</button> </td> -->
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


     <!-- Start Modal -->
         <div class="modal fade in" id="viewFeedbackModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="color-line"></div>
                   <!--  <div class="modal-header">
                        <h4 class="modal-title">Feedbacks</h4>
                    </div> -->
                    <div class="modal-body">
                          
                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    },
    methods:{
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
        viewFeedback()
        {
            $('#viewFeedbackModal').modal();
        }
    }
  }

</script>