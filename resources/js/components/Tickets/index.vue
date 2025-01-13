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
                    <th colspan="2" class="border border-slate-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ticket in tickets" :key="ticket.id" class="text-center">
                    <td>{{ ticket.type }}</td>
                    <td>{{ ticket.status }}</td>
                    <td>{{ ticket.priority }}</td>
                    <td><button class="rounded bg-cyan-700 px-5 py-3 text-white" @click="updateTicket(ticket.id)">Edit</button></td>
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
</template>

<script setup>
    import { ref, onMounted, onBeforeMount } from 'vue'
    import { useRouter } from 'vue-router';
    import axios from 'axios';

    const router = useRouter();

    let tickets = ref([])
    let paginate = ref([])

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
</script>