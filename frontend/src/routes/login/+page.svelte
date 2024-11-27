<script lang="ts">
import axios from 'axios';
import { onMount } from 'svelte';
import Cookies from 'js-cookie';

let { name, password, csrf } = $state("");

onMount(async () => {
    // axios.get('http://localhost:8000/api/csrf', {
    //     withCredentials: true
    // }).then((response) => {
    //     console.log(response.data.csrf);
    //     csrf = response.data.csrf;
    // }).catch((error) => {
    //     console.log(error);
    // })
    // console.log(Cookies.get('XSRF-TOKEN'));
    csrf = Cookies.get('XSRF-TOKEN');
    
})

async function login() {
    event.preventDefault();
    const response = await axios.post('http://localhost:8000/api/login', {
        name: name,
        password: password
    }, {
        withCredentials: true,
        headers: {
            'X-XSRF-TOKEN': csrf
        }
    }).then((response) => {
        console.log(response);
    }).catch((error) => {
        console.log(error.response.data.message);
    });
    // console.log(response.data.message);
}

</script>

<main>
    <h1>Login</h1>
    <form action="" method="post" onsubmit={login}>
        <input type="hidden" name="csrf" value={csrf}>
        <label for="">
            Username
            <input name="name" type="text" bind:value={name}>
        </label>
        <label>
            Password
            <input type="text" name="password" bind:value={password}>
        </label>
        <button>Login</button>
    </form>
</main>