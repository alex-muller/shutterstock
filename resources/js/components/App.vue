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
          placeholder="Search images"></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-file v-model="file" :state="Boolean(file)" placeholder="Choose a file..."></b-form-file>
      </b-form-group>
    </b-col>
  </b-row>
  <b-row class="justify-content-center">
    <b-col lg="3" md="3" sm="3" xs="6" v-for="n in 20" :key="n" class="mb-2">
      <b-img thumbnail fluid src="https://picsum.photos/250/250/?image=54" alt="Thumbnail" />
    </b-col>
  </b-row>
</b-container>
</template>

<script>

</script>
