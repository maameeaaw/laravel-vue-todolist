<template>
  <div class="row justify-content-center p-5">
    <b-card>
      <todoSidebar
        :visible="showSidebar"
        :id="editId"
        @onSidebarClose="setSidebarState()"
      />
      <b-row>
        <b-col cols="4"><addTask></addTask></b-col>
        <b-col cols="8">
          <b-table
            :items="taskList"
            :fields="fields"
            :borderless="true"
            :outlined="true"
            :hover="true"
            sticky-header="500px"
          >
            <template #cell(task)="data">
              {{ data.item.task }}
            </template>

            <template #cell(id)="data">
              <a
                v-if="data.item.task_status === 'doing'"
                class="mr-3 action__button"
                @click="doneTask(data.item.id)"
                data-mdb-toggle="tooltip"
                title="Done"
                ><b-icon icon="check2"></b-icon
              ></a>
              <a
                v-if="data.item.task_status === 'doing'"
                class="mr-3 action__button"
                @click="editTask(data.item.id)"
                data-mdb-toggle="tooltip"
                title="Edit"
                style="margin-left: 0.5rem"
                ><b-icon icon="pencil-square"></b-icon
              ></a>
              <a
                class="mr-3 action__button"
                @click="deleteTask(data.item.id)"
                data-mdb-toggle="tooltip"
                title="Delete"
                style="margin-left: 0.5rem"
                ><b-icon icon="trash"></b-icon
              ></a>
              <!-- <b-button><b-icon icon="pencil-square"></b-icon></b-button>
                <b-button><b-icon icon="trash"></b-icon></b-button>
                <b-button @click="editTask(data.item.id)"> Edit </b-button> -->
            </template>
          </b-table>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
import store from "../store/index";

import addTask from "./addTask.vue";
import todoSidebar from "./todoSidebar.vue";
import {
  BButton,
  BTable,
  BRow,
  BCol,
  BPagination,
  BContainer,
  BNav,
  VBToggle,
  BSidebar,
  BCard,
  BIcon,
} from "bootstrap-vue";
export default {
  name: "todoTable",
  data() {
    return {
      fields: [
        { key: "task", label: "Task" },
        { key: "id", label: "Actions" },
      ],
      editId: null,
      showSidebar: false,
    };
  },
  components: {
    todoSidebar,
    addTask,
    BButton,
    BTable,
    BRow,
    BCol,
    BPagination,
    BContainer,
    BNav,
    VBToggle,
    BSidebar,
    BCard,
    BIcon,
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
    editTask(id) {
      this.editId = id;
      this.showSidebar = true;
    },
    setSidebarState() {
      this.editId = null;
      this.showSidebar = false;
    },
    async doneTask(id) {
      console.log("done click");
      console.log(id);
      await this.$store
        .dispatch("app/doneTask", id)
        .then(async (res) => {
          // check instert True ?
          if (res.data.data) {
            await this.fetchTask();
          }
          this.setSidebarState();
        })
        .catch((err) => {
          console.log("done Fail : " + err);
        });
    },
    async deleteTask(id) {
      console.log("delete task clicked");
      console.log(id);
      await this.$store
        .dispatch("app/deleteTask", id)
        .then(async (res) => {
          // check instert True ?
          if (res.data.data) {
            await this.fetchTask();
          }
          this.setSidebarState();
        })
        .catch((err) => {
          console.log("delete Fail : " + err);
        });
    },
  },
  created() {},
  async mounted() {
    await this.fetchTask();
  },
};
</script>
<style>
a {
  color: black;
  cursor: pointer;
  font-size: 1.25rem;
}
.action__button:hover {
  color: blueviolet;
}
</style>