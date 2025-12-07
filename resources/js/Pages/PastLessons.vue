<script setup>
        import Nav  from '../Shared/Nav.vue'
        defineProps({ past_lessons: Array })
</script>


<template>
        <Nav />
        <div class="container mt-4">
                <ul class="list-group">
                        <a :href="`/past-lessons/${lesson.id}`" class=mb-2 v-for="lesson in past_lessons" :key="lesson.id">
                                <li class="list-group-item">{{ lesson.prompt }}</li>
                        </a>
                </ul>
        </div>
        
</template>