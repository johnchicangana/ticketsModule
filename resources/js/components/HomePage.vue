<template>
    <h1 class="text-lg">Desde aqui podras ver los datos fijos para esta prueba</h1>
    <section class="flex flex-row justify-center mb-4">
        <div class=" w-1/2 border-r-gray-500 border-r-2"><p>Users</p></div>
        <div class=" w-1/2">
            <table class="table-auto w-full border-separate border-spacing-2">
                <thead>
                    <tr class="text-center text-white bg-gray-800">
                        <th class="border border-slate-600">Nombre</th>
                        <th class="border border-slate-600">Apellido</th>
                        <th class="border border-slate-600">Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id" class="text-center">
                        <td>
                            <a href="#" @click="openModal(user.id)">
                                {{ user.name }}
                            </a>
                        </td>
                        <td>{{ user.last_name }}</td>
                        <td>{{ user.email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="flex flex-row justify-center">
        <div class=" w-1/2 border-r-gray-500 border-r-2"><p>Roles</p></div>
        <div class=" w-1/2">
            <table class="table-auto w-full border-separate border-spacing-2">
                <thead>
                    <tr class="text-center text-white bg-gray-800">
                        <th class="border border-slate-600">Nombre</th>
                        <th class="border border-slate-600">Permisos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="rol in roles" :key="rol.id" class="text-center">
                        <td>{{ rol.name }}</td>
                        <td>{{ rol.permits }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section v-if="active" class="modal">
        <div class="modal-content">
            <div class="text-red-800 flex justify-end">
                <button @click="active = false">X</button>
            </div>
            <h1 class="text-2xl">
                <span>{{ userModal.name }}</span>
                <span>({{ userModal.roles[0].name }})</span>
            </h1>
            <h2 class="text-xl">Interactions</h2>
            <div v-for="interaction in userModal.interactions" :key="interaction.id" class="border-teal-800 border-2 rounded p-4 mb-2">
                <div>
                    <h3>Ticket {{ interaction.ticket_interactions[0].ticket.id }}</h3>
                    <div class="flex flex-row justify-around">
                        <div class=" w-1/4">Type: {{ interaction.ticket_interactions[0].ticket.type }}</div>
                        <div class=" w-1/4">Status: {{ interaction.ticket_interactions[0].ticket.status }}</div>
                        <div class=" w-1/4">Priority: {{ interaction.ticket_interactions[0].ticket.priority }}</div>
                    </div>
                </div>
                <div>message: {{ interaction.message }}</div>
            </div>
        </div>
    </section>
</template>
<script setup>
    import axios from 'axios';
    import { onMounted, reactive, ref } from "vue"

    let users = ref([])
    let roles = ref([])
    let active = ref(false)
    const userModal = reactive({
        name: '',
        roles: '',
        interactions: '',
    })

    onMounted(async() => {
        axios.get('/api/users')
            .then(response => {
                users.value = response.data.data.data;
            });
    
        axios.get('/api/roles')
            .then(response => {
                roles.value = response.data.data.data;
            });
    })

    const openModal = async (id) => {
        active.value = true
        let response = await axios.get(`/api/users/${id}`)
        .then(response => {
            userModal.name = `${response.data.data.name} ${response.data.data.last_name}`
            userModal.roles = response.data.data.roles
            userModal.interactions = response.data.data.interactions
        })
        .catch((error) => {
            console.log(error)
            if(error.response.status === 422){
                errors = error.response.data.error
            }
        })
    }
</script>
<style>
    .modal {
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
