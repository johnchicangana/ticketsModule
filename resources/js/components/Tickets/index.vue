<template>
    <h1 class=" text-3xl text-center">Tickets Management</h1>
    <section class="container mx-auto flex justify-end">
        <button @click="newTicket" class="rounded bg-green-700 text-white py-3 px-5 mb-4">Create</button>
    </section>
    <section class="container mx-auto">
        <table class="table-auto w-full border-separate border-spacing-2">
            <thead>
                <tr class="text-center text-white bg-gray-800">
                    <th class="border border-slate-600">Type</th>
                    <th class="border border-slate-600">Status</th>
                    <th class="border border-slate-600">Priority</th>
                    <th colspan="3" class="border border-slate-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ticket in tickets" :key="ticket.id" class="text-center">
                    <td>{{ ticket.type }}</td>
                    <td>{{ ticket.status === 'Progreso' ? 'En Progreso' : ticket.status  }}</td>
                    <td>{{ ticket.priority }}</td>
                    <td><button class="rounded bg-cyan-700 px-5 py-3 text-white" @click="openModal(ticket.id)" >Interactions</button></td>
                    <td><button class="rounded bg-cyan-900 px-5 py-3 text-white" @click="updateTicket(ticket.id)" :disabled="ticket.status ==='Finalizado' ? true : false" >Edit</button></td>
                    <td><button class="rounded bg-red-700 px-5 py-2 text-white" @click="deleteTicket(ticket.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
        <div class="container mx-auto flex justify-center py-4">
            <a 
                href="#"
                class="px-4 "
                v-for="(link, index) in paginate"
                :key="index"
                v-html="link.label"
                :class="{ active: link.active, disabled: !link.url }"
                @click="changePage(link)"
            >
            </a>
        </div>
    </section>
    <section v-if="active" class="modal">
        <div class="modal-content">
            <div class="text-red-800 flex justify-end">
                <button @click="active = false">X</button>
            </div>
            <h2 class="text-2xl">Interactions</h2>
            <div v-for="interaction in ticketModal.interactions" :key="interaction.id" class="border-teal-800 border-2 rounded p-4 mb-2">
                <div class="flex flex-row justify-around">
                    <div class=" w-1/2">Message: {{ interaction.interaction.message }}</div>
                    <div class=" w-1/6">User: {{ interaction.interaction.user.name }} {{ interaction.interaction.user.last_name }}</div>
                    <div class=" w-1/5">Create On: {{ formatDate(interaction.interaction.created_at) }} </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
    import { ref, onMounted, onBeforeMount, reactive } from 'vue'
    import { useRouter } from 'vue-router';
    import axios from 'axios';

    const router = useRouter();

    let tickets = ref([])
    let paginate = ref([])
    let active = ref(false)
    const ticketModal = reactive({
        interactions: '',
    })

    onMounted(async() =>{
        getTickets()
    })

    const newTicket = () => {
        router.push({ name: 'tickets.create' });
    }

    const updateTicket = (id) => {
        router.push(`tickets/update/${id}`);
    }

    const getTickets = async () => {
        let response = await axios.get('/api/tickets')
        .then((response) => {
            tickets.value = response.data.data.data;
            paginate.value = response.data.data.links;
        });
        
    }

    const changePage = (link) => {
        if(!link.url || link.active){
            return 
        }

        axios.get(link.url)
        .then((response) => {
            tickets.value = response.data.data.data;
            paginate.value = response.data.data.links;
        })
    }

    const deleteTicket = (id) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/tickets/${id}`)
                .then(() => {
                    getTickets();
                    Swal.fire(
                        "Deleted!",
                        "Your ticket has been deleted.",
                        "success"
                    );
                });
            }
        });
    }

    const openModal = async (id) => {
        active.value = true
        let response = await axios.get(`/api/tickets/${id}`)
        .then(response => {
            ticketModal.interactions = response.data.data.ticket_interactions
        })
        .catch((error) => {
            console.log(error)
            if(error.response.status === 422){
                errors = error.response.data.error
            }
        })
    }

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        return new Intl.DateTimeFormat('default', {dateStyle: 'long'}).format(date);
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

    button:disabled {
        /* background-color: #164e63 transparent; */
        opacity: 0.5;
        cursor: no-drop;
    }
</style>
