<script setup>
import { ref } from "vue"
import Nav  from '../Shared/Nav.vue'
</script>


<template>
        <Nav/>
    
        <div class="px-4 py-5 text-center p-3 text-white bg-dark" style="height:100%">
                <img class="d-block mx-auto mb-4" src="" alt="" width="72" height="57">
                <h1 class="display-5 fw-bold">Learn Hausa the Smart & Easy Way</h1>
                <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Learn Hausa through simple, interactive lessons generated just for you. Explore greetings, common verbs, everyday sentences, and real-life phrases — all powered by AI and tailored to your learning pace.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <button type="button" class="btn btn-primary btn-lg px-4 gap-3"><a href="/learn" style="text-decoration:none; color:white">Start Learning</a></button>
                        <!-- <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
                </div>
                </div>
        </div>     
</template>