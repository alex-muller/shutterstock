<template>
<b-container>
  <b-row>
    <b-col>
      <b-jumbotron header="Shutterstock Image Sender" lead="Don't use for spam :)" >
      </b-jumbotron>
    </b-col>
  </b-row>
  <b-row>
    <b-col>
      <b-form-group>
        <b-form-input
          type="text"
          v-model="search"
          placeholder="Start type to search images..."></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-file v-model="file" placeholder="Choose a file..."></b-form-file>
      </b-form-group>
      <b-button @click="uploadEmails" variant="primary">Submit</b-button>
    </b-col>
  </b-row>
  <b-row class="justify-content-center mt-4">
    <b-col v-for="image in images" :key="image.id"  lg="3" md="3" sm="3" xs="6" class="mb-2">
      <a :href="'https://www.shutterstock.com/image/' + image.id" target="_blank">
        <div class="img-thumbnail img-fluid" :style="{'background-image': 'url('+image.assets.huge_thumb.url+')'}"></div>
      </a>
    </b-col>
  </b-row>
</b-container>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      search: '',
      timer: null,
      images: [],
      file: null
    }
  },
  created () {
    this.startSearch()
  },
  methods: {
    startSearch () {
      //let authHeader = 'Basic ' + window.btoa(shutterKey + ':' + shutterSecret);
      axios({
        method: 'get',
        url: 'https://api.shutterstock.com/v2/images/search',
        params: {
          query: this.search
        },
        auth: {
          username: shutterKey,
          password: shutterSecret
        },
        headers: {
          'Content-Type': 'application/json',
        }
      }).then(({data}) => {
        this.images = data.data
      })
    },
    uploadEmails () {
      var data = new FormData();
      data.append('images', this.getImageIds())
      //data.append('_token', token)
      data.append('file', this.file)

      var config = {
        onUploadProgress: function(progressEvent) {
          var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
        }
      };

      axios.post('/upload', data, config)
    },
    getImageIds(){
      let ids = []

      this.images.forEach((image) => {
        ids.push(image.id)
      })

      return ids
    }
  },
  watch: {
    search () {
      clearTimeout(this.timer)
      this.timer = setTimeout(() => {
        this.startSearch()
      }, 800)
    }
  }
}
</script>

<style>
  .img-thumbnail {
    height: 200px;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: contain;
  }
</style>
