<script lang="ts">
import axios from 'axios';
import { onMount } from 'svelte';
import Cookies from 'js-cookie';

let { name, csrf, message } = $state("");

onMount(async () => {
    csrf = Cookies.get('XSRF-TOKEN');
    
})

async function create() {
    event.preventDefault();
    const response = await axios.post('http://localhost:8000/api/game/create', {
        name: name
    }, {
        withCredentials: true,
        headers: {
            'X-XSRF-TOKEN': csrf
        }
    }).then((response) => {
        console.log(response.data.message);
        message = response.data.message;
    }).catch((error) => {
        console.log(error.response.data.message);
        message = error.response.data.message;
    });
}
</script>

<main>
    <h1>Create a game</h1>
    <form action="" method="post" onsubmit="{create}">
        <input type="hidden" name="csrf" value={csrf}>
        <label for="">
            Game Name:
            <input name="name" type="text" bind:value={name}>
        </label>
        {#if message}
            <p>{message}</p>
        {/if}
        <button>Create</button>
    </form>
</main>