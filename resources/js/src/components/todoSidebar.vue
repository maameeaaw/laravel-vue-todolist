<template>
  <div>
    <b-sidebar
      @hidden="setSidebarState()"
      :visible="visible"
      id="todo-edit-sidebar"
      title="Edit Task"
      no-header-close
      backdrop
      right
    >
      <div class="px-3 py-2">
        <b-form @submit.prevent="updateTask">
          <b-form-group class="mb-3" label="Task" label-for="task">
            <b-form-input id="task" v-model="taskItem.task"></b-form-input>
          </b-form-group>
          <b-button type="submit">update</b-button>
        </b-form>
      </div>
    </b-sidebar>
  </div>
</template>

<script>
import store from "../store/index";
import {
  BSidebar,
  BFormInput,
  BButton,
  BFormGroup,
  BIcon,
  BForm,
} from "bootstrap-vue";
export default {
  name: "todo-sidebar",
  components: {
    BSidebar,
    BFormInput,
    BButton,
    BFormGroup,
    BIcon,
    BForm,
  },
  props: {
    id: {
      type: Number,
      default: null,
    },
    visible: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      taskItem: {
        id: null,
        task: null,
        task_status: null,
      },
    };
  },
  computed: {
    taskList: () => {
      return store.state.app.taskList;
    },
    sidebarOpen: () => {
      return this.visible;
    },
  },
  methods: {
    save() {
      console.log("save");
    },
    cancel() {
      console.log("cancel");
    },
    setSidebarState() {
      console.log("setSidebarState");
      this.$emit("onSidebarClose");
    },
    async fetchTask() {
      await this.$store.dispatch("app/fetchTask"); // เรียกดูข้อมูลใหม่หลังจากเพิ่มไปแล้ว
    },
    async updateTask() {
      console.log("update task clicked");
      console.log(this.taskItem.id);
      console.log(this.taskItem.task);
      await this.$store
        .dispatch("app/updateTask", {
          Id: this.taskItem.id,
          task: this.taskItem.task,
        })
        .then(async (res) => {
          // check instert True ?
          if (res.data.data) {
            this.taskList.id = null; // เคลียค่า newTask
            this.taskList.task = null; // เคลียค่า newTask
            this.taskList.task_status = null; // เคลียค่า newTask
            await this.fetchTask();
          }
          this.setSidebarState();
        })
        .catch((err) => {
          console.log("update Fail : " + err);
        });
    },
  },

  watch: {
    visible: function (open = false) {
      if (this.id && open) {
        const taskData = this.taskList.find((item) => item.id === this.id);
        this.taskItem = JSON.parse(JSON.stringify(taskData));
      }
    },
  },
  mounted() {},
};
</script>

<style>
</style>