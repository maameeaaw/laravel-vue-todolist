export default [
    {
        path: '/apps/todolist',
        name: 'todo-page',
        component: () => import('../../App.vue')
    },
    {
        path: '/apps/test-addpage',
        name: 'add-page',
        component: () => import('../../components/addTask.vue')
    },

]