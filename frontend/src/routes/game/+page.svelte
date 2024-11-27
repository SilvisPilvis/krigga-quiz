<script lang="ts">
    // import type { PageData } from './$types';
    import { onMount } from 'svelte';
    import axios from 'axios';
    import Cookies from 'js-cookie';

    // let { data }: { data: PageData } = $props();

    let { csrf, games } = $state("");

    onMount(async () => {
        csrf = Cookies.get('XSRF-TOKEN');
        const response = await axios.get('http://localhost:8000/api/game', {
            withCredentials: true,
            headers: {
                'X-XSRF-TOKEN': csrf,
            }
        });
        games = response.data;
    });
</script>

<main>
<h1>Games</h1>
{#each games as game}
    <a href="/game/{game.id}">{game.name}</a>
{/each}
</main>