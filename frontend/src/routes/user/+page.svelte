<script lang="ts">
    import axios from 'axios';
    import { onMount } from 'svelte';
    let user = $state("");
    import { goto } from '$app/navigation';
    onMount(async () => {
        axios.get('http://localhost:8000/api/user',  {
            withCredentials: true
        }).then((response) => {
            console.log(response.data);
            user = response.data;
        }).catch((error) => {
            console.log(error);
            goto('/login');
        })
    })
</script>

<main>
    <h1>User</h1>
    <p>Sveiki {user.name}!</p>
</main>