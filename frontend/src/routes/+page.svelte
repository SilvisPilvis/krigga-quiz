<script lang="ts">
    import { goto } from '$app/navigation';
    import { onMount } from 'svelte';
    import axios from 'axios';
</script>

<h1>Welcome to SvelteKit</h1>
<p>Visit <a href="https://svelte.dev/docs/kit">svelte.dev/docs/kit</a> to read the documentation</p>
<button onclick={() => goto('/game/create')}>Create a game</button>
<!-- <button onclick={() => goto(`/game/${id}`)}>Play a game</button> -->
