<template>
    <h1 class="text-lg">Desde aqui podras ver los datos fijos para esta prueba</h1>
    <section class="flex flex-row justify-around">
        <div><p>Users</p></div>
        <div>
            {{ users }}
        </div>
    </section>
    <section class="flex flex-row justify-around">
        <div><p>Roles</p></div>
        <div>
            {{ roles }}
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
