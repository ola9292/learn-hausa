<script setup>
        import { computed} from "vue";
        import Nav  from '../Shared/Nav.vue'
        const props = defineProps({ lesson: Object })

        const parsedReply = computed(() => {
                return typeof props.lesson.reply === 'string'
                        ? JSON.parse(props.lesson.reply)
                        : props.lesson.reply
                });
</script>


<template>
        <Nav />
        <div class="container mt-4">
                <div>
                        <h3>{{ parsedReply.prompt }}</h3>
                        <ol class="list-group list-group-numbered">
                                <h4>Vocabulary</h4>
                                <p>{{parsedReply.reply}}</p>
                                <li v-for="vocabulary in parsedReply.vocabulary" :key="vocabulary" class="list-group-item d-flex justify-content-between align-items-start mb-2">
                                        <div class="ms-2 me-auto">
                                                <div class="fw-bold">{{vocabulary.phrase}}</div>
                                                {{vocabulary.translation}}
                                        </div>
                                        <!-- <span class="badge bg-primary rounded-pill">14</span> -->
                                </li> 
                                <h4>Examples</h4>   
                                <li v-for="example in parsedReply.examples" :key="example" class="list-group-item d-flex justify-content-between align-items-start mb-2">
                                        <div class="ms-2 me-auto">
                                                <div class="fw-bold">{{example.hausa}}</div>
                                                {{example.english}}
                                        </div>
                                        <!-- <span class="badge bg-primary rounded-pill">14</span> -->
                                </li> 
                        </ol>
                        <h4>Explanation</h4>
                        <div class="card">
                                <div class="card-body">
                                {{parsedReply.explanation}}
                                </div>
                        </div>
                </div>
        </div>
        
</template>