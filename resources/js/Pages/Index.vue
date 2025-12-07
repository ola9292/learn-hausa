<script setup>
import { ref } from "vue"
import Nav  from '../Shared/Nav.vue'

const question = ref("")

const reply = ref(null)
const loading = ref(false)
const exists = ref(false)

const sendPrompt = () => {
        loading.value = true
        axios.post('/learn', {
                prompt: question.value,
                })
                .then(function (response) {
                        console.log(response.data);
                        reply.value = JSON.parse(response.data.lesson);
                        question.value = ""
                        loading.value = false
                        exists.value = response.data.exists
                })
                .catch(function (error) {
                        console.log(error);
                });

}

const customPrompt = (payload) => {
        question.value = payload
        sendPrompt()
}
</script>

<template>
        <Nav />
        <div class="container py-4">
                <h1>What do you want to learn in Hausa today?</h1>
               
                <div class="input-group mb-3">
                        <input type="text" v-model="question" class="form-control" placeholder="E.g Teach me greetings in hausa" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button @click="sendPrompt" class="btn btn-outline-secondary" type="button" id="button-addon2">Send</button>
                </div>

                <div class="mt-3 mb-3">
                      <p>Suggestions</p>  
                      <div>
                        <div class="row">
                                <div class="col border pt-2 pb-2">
                                        <!-- <span @click="customPrompt('Teach me basic Hausa greetings')">Basic Greetings</span> -->
                                        <button @click="customPrompt('Teach me basic Hausa greetings')" type="button" class="btn btn-outline-success">Basic Greetings</button>
                                </div>
                                <div class="col border pt-2 pb-2">
                                        <!-- <span @click="customPrompt('Teach me common daily Hausa verbs')">Daily Verbs</span> -->
                                        <button @click="customPrompt('Teach me common daily Hausa verbs')" type="button" class="btn btn-outline-primary">Daily Verbs</button>
                                </div>
                                <div class="col border pt-2 pb-2">
                                        <!-- <span @click="customPrompt('Teach me simple everyday Hausa sentences')">Everyday Sentences</span> -->
                                        <button @click="customPrompt('Teach me simple everyday Hausa sentences')" type="button" class="btn btn-outline-success">Everyday Sentences</button>
                                </div>
                                <div class="col border pt-2 pb-2">
                                        <!-- <span @click="customPrompt('Teach me Hausa phrases for the marketplace')">Market Phrases</span> -->
                                        <button @click="customPrompt('Teach me Hausa phrases for the marketplace')" type="button" class="btn btn-outline-primary">Market Phrases</button>
                                </div>
                        </div>
                      </div>
                </div>

                <div v-if=loading>
                        <p>loading</p>
                </div>
                <div v-else-if="reply">
                        <h3>{{ reply.title }}</h3>
                        <ol class="list-group list-group-numbered">
                                <h4>Vocabulary</h4>
                                <li v-for="vocabulary in reply.vocabulary" :key="vocabulary" class="list-group-item d-flex justify-content-between align-items-start mb-2">
                                        <div class="ms-2 me-auto">
                                                <div class="fw-bold">{{vocabulary.phrase}}</div>
                                                {{vocabulary.translation}}
                                        </div>
                                        <!-- <span class="badge bg-primary rounded-pill">14</span> -->
                                </li> 
                                <h4>Examples</h4>   
                                <li v-for="example in reply.examples" :key="example" class="list-group-item d-flex justify-content-between align-items-start mb-2">
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
                                {{reply.explanation}}
                                </div>
                        </div>
                </div>
                <div v-else-if="exists">
                        <p>You have this already, check your <a href="/past-lessons">past lessons</a>!</p>
                </div>
                <div v-else>
                        <p>Type something to start learning.</p>
                </div>
        </div>
</template>