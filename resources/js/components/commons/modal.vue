<template>
    <section class="">
        <h1>{{ user.name }}</h1>
        <h2>Rol</h2>
        <p>{{ user.roles }}</p>
        <h2>Interaction</h2>
        <p>{{ user.interactions }}</p>
    </section>
</template>
<script setup>
    const props = defineProps(['user', 'active']);
</script>