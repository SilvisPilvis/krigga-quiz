<script lang="ts">
    let { rows, cols, data } = $props();
    rows = Array(rows).fill(0);
    cols = Array(cols).fill(0);

    console.log(`width: ${rows.length}, height: ${cols.length} data: ${data}`);

    function edit(answerIndex: number) {
        data[answerIndex] = 1;
        data = [...data]; // Trigger reactivity
    }

    
</script>

<table>
    {#each rows as _, i}
      <tr>
        {#each cols as _, j}
          <td>
            <input 
              type="text" 
              readonly 
              id={`cell-${i}-${j}`}
              value={data[i * cols + j]}
              on:dblclick={() => edit(i * cols + j)}
            />
          </td>
        {/each}
      </tr>
    {/each}
</table>

<!-- <table>
    {#each rows as i}
        <tr>
            {#each cols as j}
                 <input type="text" name="" readonly id={i} ondblclick={() => edit(j)} value={data[i]}>
            {/each}
        </tr>
    {/each}
</table> -->