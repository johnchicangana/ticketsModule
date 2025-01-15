<template>
    <h1 class=" text-3xl text-center">Create Ticket</h1>
    <div>
        <Form typeButon="Create" @sendValidate="sendRedirect"></Form>
    </div>
</template>
<script setup>
    import Form from './Form.vue';
    import { useRouter } from 'vue-router';
    const router = useRouter();

    function sendRedirect (val) {
        router.push('/tickets');
        toast.fire({
            icon: 'success',
            title: `Ticket ${val} successfully`
        });
    }
</script>