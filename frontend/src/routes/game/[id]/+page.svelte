<script lang="ts">
    import { onMount } from 'svelte';
    import axios from 'axios';
    import Cookies from 'js-cookie';
    import Table from '$lib/Table.svelte';

    let { csrf, game, questionCount, answerCount } = $state("");
    questionCount = 0;
    answerCount = 4;
    let { answers, questions } = $state([]);
    answers = new Map<Number, Array<string>>;
    questions = [];
    let { data } = $props();
    

    onMount(async () => {
        csrf = Cookies.get('XSRF-TOKEN');
        const response = await axios.get(`http://localhost:8000/api/game/${data.id}`, {
            withCredentials: true,
            headers: {
                'X-XSRF-TOKEN': csrf,
            }
        });
        game = response.data;
    });

    function addQuestion() {
        questionCount++;
        // console.log(`Question count: ${questionCount}`);
    }

    function setQuestion(index, value) {
        questions[index] = value;
        console.log(questions);
    }

    function setAnswer(question, index, value) {
        // answers[question] = answers[question] || [];
        answers[question][index] = value;
        console.log(answers);
    }

    function create() {
        event.preventDefault();
    }

</script>

<main class="flex flex-col items-center justify-center h-screen">
    {#if game}
        <h1>Quiz: {game.name}</h1>
    {/if}

    <label for="">
       Answer count for question:
       <input type="number" bind:value={answerCount} min="1" max="4" step="1" class="bg-gray-200 p-2 rounded-md">
    </label>

    {#key questionCount}
    <div class="m-2 flex flex-col justify-center items-center">
        {#each Array(questionCount) as k, v1}
            <label class="flex flex-col justify-center items-center gap-2">Question {v1 + 1}
                <input type="text" name={`question${v1}`} placeholder="Question" class="bg-gray-200 p-2 rounded-md" onchange={() => setQuestion(v1, questions[v1])}  bind:value={questions[v1]}>
                {#key answerCount}
                <div class="grid grid-rows-2 grid-cols-2 w-[80%] gap-2">
                    {#each Array(answerCount) as k, v}
                        <input type="text" name={`answer${v}`} placeholder="Answer" class="bg-gray-200 p-2 py-6 rounded-md w-full" onchange={() => setAnswer(v1, v, answers[v])} bind:value={answers[v]}>
                    {/each}
                </div>
                {/key}
            </label>
        {/each}
    </div>
    {/key}
    <button onclick={addQuestion} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Question</button>
    <button onclick={create} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Game</button>
</main>