<script lang="ts">
    import axios from 'axios';
    
    let { name, password, again } = $state("");
    
    async function register() {
        if (password !== again) {
            alert("Passwords don't match");
            return;
        }

        event.preventDefault();
        const response = await axios.post('http://localhost:8000/api/register', {
            name: name,
            password: password
        });
        console.log(response);
    }
    
    </script>
    
    <main>
        <h1>Register</h1>
        <form action="" method="post" onsubmit={register}>
            <label for="">
                Username
                <input name="name" type="text" bind:value={name}>
            </label>
            <label>
                Password
                <input type="password" name="password" bind:value={again}>
            </label>
            <label>
                Repeat password
                <input type="password" name="password" bind:value={password}>
            </label>
            <button>Login</button>
        </form>
    </main>