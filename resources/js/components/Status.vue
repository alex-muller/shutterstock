<template>
  <div>
    <b-container>
      <div v-for="file in files" :key="file.id" class="mt-5">
        <b-row>
          <b-col>
            <h3>File: <span class="text-primary">{{ file.name }}</span></h3>
            <p>
              <strong>Status:</strong>
              <span v-if="file.status" class="text-success">Processed</span>
              <span v-else class="text-warning">Not Processed</span>
            </p>
            <p><strong>Uploaded:</strong> {{ file.uploaded_at }}</p>
            <p v-if="file.status"><strong>Processed:</strong> {{ file.processed_at }}</p>

          </b-col>
        </b-row>
        <b-row v-if="file.status">
          <b-col>
            <table class="table">
              <thead>
              <th>Email</th>
              <th>Sent</th>
              <th>Status</th>
              <th>Message</th>
              </thead>
              <tbody>
              <tr v-for="email in file.emails" :key="email.id">
                <td>{{ email.email }}</td>
                <td>{{ email.sent }}</td>
                <td>
                  <span v-if="email.status" class="badge badge-success">Success</span>
                  <span v-else class="badge badge-danger">Fail</span>
                </td>
                <td>
                  <span v-if="email.status" class="text-success">{{ email.status_message }}</span>
                  <span v-else class="text-danger">{{ email.status_message }}</span>
                </td>
              </tr>
              </tbody>
            </table>
          </b-col>
        </b-row>
      </div>
    </b-container>
  </div>
</template>

<script>
  import axios from 'axios'
  export default {
    data () {
      return {
        files: []
      }
    },
    created () {
      this.getStatus()
    },
    methods: {
      getStatus() {
        axios.get('/status/get')
          .then(({data}) => {
            this.files = data.data
          })
      }
    }
  }
</script>

<style scoped>

</style>