import axios from 'axios'
export default {
  namespaced: true,
  state: {
    taskList: []
  },
  getters: {

  },
  mutations: {
    SET_TASK_LIST(state, data) {
      state.taskList = data
    }
  },
  actions: {
    fetchTask({ commit }) {
      return new Promise((resolve, reject) => {
        axios.get("/api/tasks")
          .then((response) => {
            resolve(response)
            if (response.data.data) {
              commit('SET_TASK_LIST', response.data.data)
            }

          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    fetchDoneTask({ commit }) {
      return new Promise((resolve, reject) => {
        axios.get("/api/task/doneList")
          .then((response) => {
            resolve(response)
            if (response.data.data) {
              commit('SET_TASK_LIST', response.data.data)
            }

          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    addTask({ commit }, newTask) {
      return new Promise((resolve, reject) => {
        axios.post("/api/tasks", { task: newTask })
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    updateTask({ commit }, task) {
      const taskId = task.Id
      const upTask = task.task
      return new Promise((resolve, reject) => {
        axios.put("/api/tasks/" + taskId, { task: upTask })
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    deleteTask({ commit }, taskId) {
      return new Promise((resolve, reject) => {
        axios.delete("/api/tasks/" + taskId)
          .then((response) => {
            console.log(response);
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    doneTask({ commit }, taskId) {
      return new Promise((resolve, reject) => {
        axios.post("/api/task/done/" + taskId)
          .then((response) => {
            console.log(response);
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
  }
}
