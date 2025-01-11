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
                        <td>{{ user.name }}</td>
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
</template>
<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                users: [],
                roles: [],
                permissions: []
            }
        },
        mounted() {
            axios.get('/api/users')
                .then(response => {
                    this.users = response.data.data.data;
                });
        
            axios.get('/api/roles')
                .then(response => {
                    this.roles = response.data.data.data;
                });
        }
    }
</script>
