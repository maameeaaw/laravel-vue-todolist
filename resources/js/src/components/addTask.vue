<template>
  <div class="px-3 py-2">
    <b-form class="mb-3" @submit.prevent="addTask()">
      <b-input-group>
        <b-input-group-prepend>
          <b-button variant="outline-info" type="submit">Add</b-button>
        </b-input-group-prepend>
        <b-form-input
          id="input-1"
          v-model="newTask"
          type="text"
          placeholder="Enter your new task"
          required
        ></b-form-input>
      </b-input-group>
    </b-form>
    <b-list-group>
      <b-list-group-item button @click="fetchTask"
        ><b-icon class="mr-3" icon="card-checklist"></b-icon>
        tasks</b-list-group-item
      >
      <b-list-group-item button @click="fetchDoneTask"
        ><b-icon icon="check2"></b-icon> Completed</b-list-group-item
      >
    </b-list-group>
    <!-- <a @click="fetchTask"><b-icon icon="card-checklist"></b-icon>tasks</a>
    <a @click="fetchDoneTask"><b-icon icon="check2"></b-icon>Completed</a> -->
  </div>
</template>

<script>
import store from "../store/index";
import {
  BButton,
  BFormInput,
  BSidebar,
  BInputGroup,
  BForm,
  BIcon,
  BListGroup,
} from "bootstrap-vue";
export default {
  name: "addTask",
  components: {
    BButton,
    BFormInput,
    BSidebar,
    BInputGroup,
    BForm,
    BIcon,
    BListGroup,
  },
  data() {
    return {
      newTask: null,
    };
  },
  computed: {
    taskList: () => {
      return store.state.app.taskList;
    },
  },
  methods: {
    async fetchTask() {
      await this.$store.dispatch("app/fetchTask"); // เรียกดูข้อมูลใหม่หลังจากเพิ่มไปแล้ว
    },
    async fetchDoneTask() {
      await this.$store.dispatch("app/fetchDoneTask");
    },
    async addTask() {
      console.log("add task clicked");
      await this.$store
        .dispatch("app/addTask", this.newTask)
        .then(async (res) => {
          // check instert True ?
          if (res.data.data) {
            this.newTask = null; // เคลียค่า newTask
            await this.fetchTask();
          }
        })
        .catch((err) => {
          console.log("Add Fail : " + err);
        });
    },
  },
  created() {},
  async mounted() {
    await this.fetchTask();
  },
};
</script>
