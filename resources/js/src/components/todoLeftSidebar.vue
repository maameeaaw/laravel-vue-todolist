<template>
  <div>
    <b-sidebar
      id="sidebar-no-header"
      aria-labelledby="sidebar-no-header-title"
      no-header
      backdrop
      shadow
    >
      <template #default="{ hide }">
        <div class="p-3">
          <b-button variant="primary" block @click="hide">Add task</b-button>

          <nav>
            <b-nav class="mb-3 mt-3" vertical>
              <b-nav-item active @click="hide">
                <b-icon class="mr-3" icon="card-checklist"></b-icon>
                myTasks</b-nav-item
              >
              <b-nav-item href="#link-1" @click="hide">
                <b-icon class="mr-3" icon="check2-square"></b-icon>
                Completed</b-nav-item
              >
            </b-nav>
          </nav>
        </div>
      </template>
    </b-sidebar>
  </div>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import {
  BButton,
  BListGroup,
  BListGroupItem,
  BIcon,
  BSidebar,
  VBToggle,
} from "bootstrap-vue";
import Ripple from "vue-ripple-directive";
export default {
  name: "todoLeftSidebar",
  directives: {
    Ripple,
  },
  components: {
    BButton,
    BListGroup,
    BListGroupItem,
    BIcon,
    VuePerfectScrollbar,
    BSidebar,
    VBToggle,
  },
  data() {
    return {
      taskFilters: [
        { title: "My Task", icon: "list-task", route: { name: "home" } },
        {
          title: "Important",
          icon: "star",
          route: { name: "home", params: { filter: "important" } },
        },
        {
          title: "Completed",
          icon: "check2",
          route: { name: "home", params: { filter: "completed" } },
        },
        {
          title: "Deleted",
          icon: "trash",
          route: { name: "home", params: { filter: "deleted" } },
        },
      ],
      perfectScrollbarSettings: {
        maxScrollbarLength: 60,
      },
    };
  },
};
</script>

<style>
</style>
