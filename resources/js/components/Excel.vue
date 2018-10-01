<template>
  <div class="container">
    <form enctype="multipart/form-data" novalidate>
      <div class="btn btn-md btn-excel" v-if="!loading && !isFailed" style="">
        <input type="hidden" :value="userid" name="user_id">
        <input :name="uploadFieldName" @change="filesChange($event.target.name, $event.target.files, userid);" id="file" type="file" :disabled="loading"  style="z-index: 1; opacity: 0; padding: 10px">
        <div class="excel-inner-btn">
          <img style="width: 35px;" :src="exceliconurl" alt="">&nbsp &nbspВыгрузить товары из excel
        </div>
        
      </div>

      <div v-if="loading" class="loading btn btn-md">
        <img :src="loadingurl" />
      </div>
    </form>

     <div v-if="isFailed">
         <h4>Ошибка при загрузке файла.</h4>
         <p>
             <a class="btn btn-default" href="javascript:void(0)" @click="reset()">Попробовать снова</a>
         </p>
         <pre>{{error}}</pre>
     </div>
  </div>
</template>
<style>
  div.loading {
    padding: 7px;
    border: 2px solid lightgrey;
  }
</style>
<script>

import { upload } from './file-upload.service';

const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;

export default {
  props: ['loadingurl', 'exceliconurl', 'userid'],
  name: 'app',

  data() {
    return {
      file: null,
      error: null,
      currentStatus: null,
      uploadFieldName: 'excelfile'
    }
  },

  computed: {
    isInitial() {
      return this.currentStatus === STATUS_INITIAL;
    },
    loading() {
      return this.currentStatus === STATUS_SAVING;
    },
    isSuccess() {
      return this.currentStatus === STATUS_SUCCESS;
    },
    isFailed() {
      return this.currentStatus === STATUS_FAILED;
    }
  },

  methods: {
    reset() {
      // reset form to initial state
      this.currentStatus = STATUS_INITIAL;
      this.error = null;
    },

    save(formData, userid) {
      // upload data to the server
      this.currentStatus = STATUS_SAVING;
      formData.append('user_id', userid);
      // var BASE_URL = window.location.pathname;
      upload(formData)
        .then(x => {
          location.reload(); 
          // this.currentStatus = STATUS_SUCCESS;
        })
        .catch(err => {
          this.error = err.response; // err.data.message[0]
          this.currentStatus = STATUS_FAILED;
        });
    },

    filesChange(fieldName, fileList, userid) {
      // handle file changes
      const formData = new FormData();

      if (!fileList.length) return;

        // append the files to FormData
        Array
          .from(Array(fileList.length).keys())
          .map(x => {
            formData.append(fieldName, fileList[x], fileList[x].name);
          });
      // save it
      this.save(formData, userid);
    }

    // upload(){
    //   app.loading = true;
    //   app.error = null;
    //   axios.post('belook.test/public/uploadGoods', {file: this.file}).then(res => {
    //     console.log(res.data);
    //     app.loading = false;  
    //   }).catch(e => {
    //     alert('На сервере произошла ошибка. Попробуйте повторить запрос позже.');  
    //     console.log(e);
    //     app.error = true;
    //     app.loading = false;
    //   });
    // }

  },
  mounted() {
    this.reset();
  },
}
</script>
